<?php
class topic_dao extends CI_Model
{
	//add by yuanye
	private $topic_table		= 'topic_create';			// topic basic information
	private $topic_num_table = 'topic_num';
	private $topic_vote_num_table = 'topic_vote_num';
	private $topic_user_table = 'topic_user_info' ;
	private $user_topic_table = 'user_topic_info';
	private $feed_info = 'feed';
	private $vote_topic_table = 'vote_topic';
	private $following_topic_num_table	= 'following_topic_num';


	function __construct(){
		parent::__construct();
		$ci =& get_instance();
		date_default_timezone_set('America/New_York');
	}


	public function get_topic_base_info($array){
		foreach($array as $field=>$value){
			$this->db->where($field,$value);
		}
		return $this->db->get($this->topic_table);
	}
	
	
	public function get_voting_topics_by_limit($start=0,$num_of_topics=2){
		$sql='select * from '.$this->topic_table.' where type=0 AND status!=0 order by create_time desc limit '.$start.','.$num_of_topics;
		$result=$this->_get_topics_by_limit($start,$num_of_topics,$sql);
		foreach($result as $key=>$row){
			$result[$key]['v_num']=$this->get_topic_vote_num($row['tid']);
		}
		return $result;
	}
	
	public function get_all_topics_by_limit($start=0,$num_of_topics=2){
		$sql='select * from '.$this->topic_table.' where type=1 order by chosen_time desc limit '.$start.','.$num_of_topics;
		return $this->_get_topics_by_limit($start,$num_of_topics,$sql);
	}
	
	private function _get_topics_by_limit($start=0,$num_of_topics=2,$sql){
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return array();
		}
		foreach ($query->result() as $key=>$row){
			$result[$key]['tid']=$row->tid;
			$result[$key]['uid']=$row->uid;
			$result[$key]['title']=$row->title;
			$result[$key]['interestId']=$row->interestId;
			$result[$key]['create_time']=$row->create_time;
			$result[$key]['chosen_time']=$row->chosen_time;
			$result[$key]['chosen_date']=$this->utility_lib->datetime_2_unit($row->chosen_time).' ago';
			$result[$key]['desc']=$row->desc;
			$result[$key]['extra_desc']=$row->extra_desc;
			$result[$key]['bg_img']=$row->bg_img;
			$result[$key]['status']=$row->status;
			$result[$key]['type']=$row->type;
		}
		return $result;
	}
	
	
	
	// add  by yuanye
	
	public function addTopic($topic_info){
		$time=date('Y-m-d H:i:s');
		$topic_table['tid']=$topic_info['tid'];
		$topic_table['uid']=$topic_info['uid'];
		$topic_table['ip']=sprintf("%u",ip2long($this->input->ip_address()));
		$topic_table['title']=$topic_info['title'];
		$topic_table['desc']=$topic_info['desc'];
		$topic_table['create_time']=$time;
		$topic_table['interestId']=$topic_info['interestId'];
		
		$feed_info['fromid']=$topic_info['uid'];
		$feed_info['toid']=$topic_info['tid'];
		$feed_info['type']=4;
		$feed_info['time']=$time;
		
		$topic_v_num['tid']=$topic_info['tid'];
		
		$this->db->trans_start();
		$this->db->insert($this->topic_table, $topic_table);
		$this->db->insert($this->topic_vote_num_table, $topic_v_num);
		$this->db->insert($this->topic_num_table, $topic_v_num);
		$this->db->insert($this->feed_info, $feed_info);				//news feed
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	
	
	public function chosenTopic($tid){
		$sql = 'select uid from '.$this->topic_table.' where tid='.$tid;
		$query = $this->db->query($sql);
		foreach ($query->result() as $row){
			$uid = $row->uid;
		}
		$time=date('Y-m-d H:i:s');
		$topic_info['type']=1;
		$topic_info['chosen_time']=$time;
		
		$feed_info['fromid']=$tid;
		$feed_info['type']=1;
		$feed_info['time']=$time;
		
		/*$topic_user_info['tid']=$tid;
		$topic_user_info['uid']=$uid;
		$topic_user_info['time']=$time;
		$topic_user_info['user_type']=1;
		
		$user_topic_info['tid']=$tid;
		$user_topic_info['uid']=$uid;
		$user_topic_info['time']=$time;
		$user_topic_info['topic_type']=1;*/
		
	//	$update_following_topic_num='update '.$this->following_topic_num_table.' set num=num+1 where uid='.$uid;
	//	$update_topic_num='update '.$this->topic_num_table.' set f_num=f_num+1 where tid='.$tid; 
		//$update_topic_num='update '.$this->topic_num_table.' set f_num=f_num+1 where tid='.$tid;
		
	//	$update_topic_tag='update '.$this->topic_tag_table.' set topic_type=1 where tid='.$tid;
				
		$this->db->where('tid',$tid);
		$this->db->trans_start();
		$this->db->update($this->topic_table,$topic_info);
		$this->db->insert($this->feed_info,$feed_info);				//news feed
		//$this->db->insert($this->topic_user_table, $topic_user_info);
		//$this->db->insert($this->user_topic_table, $user_topic_info);
	//	$this->db->query($update_following_topic_num);
	//	$this->db->query($update_topic_num);
	//	$this->db->query($update_topic_tag);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	public function voteTopic($uid,$tid){
		$update_topic_num='update '.$this->topic_vote_num_table.' set v_num=v_num+1 where tid='.$tid;
		$vote_topic_info['tid']=$tid;
		$vote_topic_info['uid']=$uid;
		$this->db->trans_start();
		$this->db->insert($this->vote_topic_table, $vote_topic_info);
		$this->db->query($update_topic_num);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	public function get_topic_by_follow($num=50){
		$result=array();
		$sql='select tid from '.$this->topic_num_table.' order by f_num desc limit '.$num;
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$result[] = $row->tid;
		}
		return $result;
	}
	
/*	public function get_topic_by_question($num=50){
		$result=array();
		$sql='select tid from '.$this->topic_num_table.' order by q_num desc limit '.$num;
		$query=$this->db->query($sql);
		if(!$query){
			return false;
		}
		foreach ($query->result() as $row){
			$result[] = $row->tid;
		}
		return $result;
	}*/
	
	public function get_topic_by_post($num=50){
		$result=array();
		$sql='select tid from '.$this->topic_num_table.' order by p_num desc limit '.$num;
		$query=$this->db->query($sql);
		if(!$query){
			return false;
		}
		foreach ($query->result() as $row){
			$result[] = $row->tid;
		}
		return $result;
	}
	
	public function get_topics_recommend_info($topics){
		$result=array();
		$tids=implode(',',$topics);
		$sql='select tid,title,interestId from '.$this->topic_table.' where tid in ('.$tids.')';
		$query=$this->db->query($sql);
		if(!$query){
			return false;
		}
		foreach ($query->result() as $row){
			$result[$row->tid]['tid'] = $row->tid;
			$result[$row->tid]['title'] = $row->title;
			$result[$row->tid]['interestId'] = $row->interestId;
		}
		return $result;
		
	}
	
/*	public function get_crazy_topic($tid){
		$result=array();
		$this->db->where('tid',$tid);
		$query=$this->db->get($this->topic_table);
		if(!$query){
			return false;
		}
		foreach ($query->result() as $row){
			$result['uid'] = $row->uid;
			$result['title']=$row->title;
			$result['desc']=$row->desc;
			$result['interestId']=$row->interestId;
			$result['best_post']=$row->best_post;
		}
		return $result;
	}*/
	
	public function get_new_topic_info($num=10){
		$result=array();
		$sql='select * from '.$this->topic_table.' where type=1 order by chosen_time limit '.$num;
		$query=$this->db->query($sql);
		if(!$query){
			return false;
		}
		foreach ($query->result() as $row){
			$result[$row->tid]['tid']=$row->tid;
			$result[$row->tid]['uid']=$row->uid;
			$result[$row->tid]['title']=$row->title;
			$result[$row->tid]['interestId']=$row->interestId;
			$result[$row->tid]['chosen_time']=$row->chosen_time;
			$result[$row->tid]['desc']=$row->desc;
		}
		return $result;
	}
	
	public function get_topics_num($tids){
		$result=array();
		if(!is_array($tids)){
			return false;
		}
		
		$sql_tid=implode(',',$tids);
		$sql='select * from '.$this->topic_num_table.' where tid in ('.$sql_tid.')';
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return false;
		}
		
		foreach ($query->result() as $row){
		//	$result[$row->tid]['tid']=$row->tid;
			$result[$row->tid]['fans']=$row->f_num;
			$result[$row->tid]['post']=$row->p_num;
			$result[$row->tid]['question']=$row->q_num;
		}
		return $result;
	}
	
	public function get_topic_num($tid){//by bosai
		$result=array();
		$sql='select * from '.$this->topic_num_table.' where tid ='.$tid;
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return false;
		}
		foreach($query->result() as $row){
			$result['fans']=$row->f_num;
			$result['post']=$row->p_num;
			$result['question']=$row->q_num;
		}
		return $result;
	}
	
	public function get_feature_topic_info(){
		$result=array();
		$sql='select * from '.$this->topic_table.' where status=2 and type=1';
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$result[$row->tid]['tid']=$row->tid;
			$result[$row->tid]['uid']=$row->uid;
			$result[$row->tid]['title']=$row->title;
			$result[$row->tid]['interestId']=$row->interestId;
			$result[$row->tid]['chosen_time']=$row->chosen_time;
			$result[$row->tid]['chosen_date']=$this->utility_lib->datetime_2_unit($row->chosen_time).' ago';
			$result[$row->tid]['desc']=$row->desc;
			$result[$row->tid]['bg_img']=$row->bg_img;
		}
		return $result;
	}
	
	public function get_tab_topics_info(){//by bosai
		$result=array();
		$sql='select * from '.$this->topic_table.' where type=1';
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$result[$row->tid]['tid']=$row->tid;
			$result[$row->tid]['uid']=$row->uid;
			$result[$row->tid]['title']=$row->title;
			$result[$row->tid]['interestId']=$row->interestId;
			$result[$row->tid]['chosen_time']=$row->chosen_time;
			$result[$row->tid]['chosen_date']=$this->utility_lib->datetime_2_unit($row->chosen_time).' ago';
			$result[$row->tid]['desc']=$row->desc;
			$result[$row->tid]['bg_img']=$row->bg_img;
		}
		return $result;
	}
	
	public function get_contributor($tid){
		$result= array();
		$sql='select uid from '.$this->topic_user_table.' where tid='.$tid.' and user_type=2';
		$query=$this->db->get($this->topic_user_table);
		if($query->num_rows()==0){
			return false;
		}
		$result=array();
		foreach($query->result() as $row){
			$result[]=$row->uid;
		}
		return $result;
	}
	
	public function get_topic_info($tid){
		$this->db->where('tid',$tid);
		$this->db->where('type',1);
		$query=$this->db->get($this->topic_table);
		if($query==false || $query->num_rows()==0){
			return false;
		}
		$result=array();
		foreach ($query->result() as $row){
			$result['uid'] = $row->uid;
			$result['title']=$row->title;
			$result['desc']=$row->desc;
			$result['interestId']=$row->interestId;
			$result['best_post']=$row->best_post;
			$result['chosen_date']=$this->utility_lib->datetime_2_unit($row->chosen_time).' ago';
			$result['bg_img']=$row->bg_img;
		}
		return $result;
	}
	
	public function get_topic_vote_num($tid){
		$this->db->where('tid',$tid);
		$query=$this->db->get($this->topic_vote_num_table);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$result = $row->v_num;
		}
		return $result;
	}
	
	
	
}