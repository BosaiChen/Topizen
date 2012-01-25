<?php
class relation_dao extends CI_Model{
	
	private $following_table='following_info';
	private $followed_table='followed_info';
	private $following_num='following_num';
	private $followed_num='followed_num';
	private $following_topic_num='following_topic_num';
	private $topic_num='topic_num';
	private $topic_user_table='topic_user_info';
	private $user_topic_table='user_topic_info';
	private $feed_table = 'feed';
	private $user_post_num_table = 'user_post_num';
	private $user_repost_num_table = 'user_repost_num';
	private $user_question_num_table = 'user_question_num';
	private $user_answer_num_table = 'user_answer_num';
	private $user_topic_num_table = 'user_topic_num';
	 
	function __construct(){
		parent::__construct();
		$ci =& get_instance();
	}
	
	// user - user relation
	
	public function add_follow_user($user_id,$follow_uid){
		$following_info['fuid']=$user_id;
		$following_info['tuid']=$follow_uid;
		
		$followed_info['fuid']=$follow_uid;
		$followed_info['tuid']=$user_id;
		
		$update_followed_num='update '.$this->followed_num.' set num=num+1 where uid= '.$follow_uid;
		$update_following_num='update '.$this->following_num.' set num=num+1 where uid= '.$user_id;   
		$this->db->trans_start();
		$this->db->insert($this->following_table, $following_info);
		$this->db->insert($this->followed_table, $followed_info);
		$this->db->query($update_followed_num);
		$this->db->query($update_following_num);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
    		return false;
		}else{
			return true;
		}
	}
	
	public function delete_follow_user($user_id,$follow_uid){
		$following_info['fuid']=$user_id;
		$following_info['tuid']=$follow_uid;
		
		$followed_info['fuid']=$follow_uid;
		$followed_info['tuid']=$user_id;
		
		$update_followed_num='update '.$this->followed_num.' set num=num-1 where uid= '.$follow_uid;
		$update_following_num='update '.$this->following_num.' set num=num-1 where uid= '.$user_id;   
		$this->db->trans_start();
		$this->db->delete($this->following_table, $following_info);
		$this->db->delete($this->followed_table, $followed_info);
		$this->db->query($update_followed_num);
		$this->db->query($update_following_num);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
    		return false;
		}else{
			return true;
		}
	}
	
	public function is_follow_user($fuid,$tuid){
		$this->db->where('fuid',$fuid);
		$this->db->where('tuid',$tuid);
		$query= $this->db->get($this->following_table);
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
	public function get_user_followings($uid){
		$sql='select tuid from '.$this->following_table.' where fuid='.$uid.' order by time desc';
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return array();
		}
		$result=array();
		foreach ($query->result() as $row){
			$result[] = $row->tuid;
		}
		return $result;
	}
	
	public function get_user_followers($uid){
		$sql='select tuid from '.$this->followed_table.' where fuid='.$uid.' order by time desc';
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return array();
		}
		$result=array();
		foreach ($query->result() as $row){
			$result[] = $row->tuid;
		}
		return $result;
	}
	
	//user topic relation
	public function add_follow_topic($user_id,$tid,$user_type=0){
		$time=date('Y-m-d H:i:s');
		$topic_user_info['tid']=$tid;
		$topic_user_info['uid']=$user_id;
		$topic_user_info['time']=$time;
		$topic_user_info['user_type']=$user_type;
		
		$user_topic_info['tid']=$tid;
		$user_topic_info['uid']=$user_id;
		$user_topic_info['time']=$time;
		$user_topic_info['topic_type']=$user_type;
		
		$update_following_topic_num='update '.$this->following_topic_num.' set num=num+1 where uid='.$user_id;
		$update_topic_num='update '.$this->topic_num.' set f_num=f_num+1 where tid='.$tid;   
		
		$feed_info['fromid']=$user_id;
		$feed_info['toid']=$tid;
		$feed_info['type']=2;
		$feed_info['time']=$time;
		
		$user_topic_num_info['uid']=$user_id;
		$user_topic_num_info['tid']=$tid;
		
		$check_sql='select * from '.$this->user_topic_num_table.' where uid='.$user_id.' and tid='.$tid;
		$query=$this->db->query($check_sql);
		if($query->num_rows()==0){
			$flag=0;
		}else{
			$flag=1;
		}
		
		$this->db->trans_start();
		if($flag == 0){
			$this->db->insert($this->user_topic_num_table,$user_topic_num_info);
		}
		$this->db->insert($this->topic_user_table, $topic_user_info);
		$this->db->insert($this->user_topic_table, $user_topic_info);
		$this->db->query($update_following_topic_num);
		$this->db->query($update_topic_num);
		$this->db->insert($this->feed_table,$feed_info);					//news feed
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
    		return false;
		}else{
			return true;
		}
	}
	
	public function delete_follow_topic($user_id,$tid,$user_type=0){
		$topic_user_info['tid']=$tid;
		$topic_user_info['uid']=$user_id;
		
		$user_topic_info['tid']=$tid;
		$user_topic_info['uid']=$user_id;
		
		$update_following_topic_num='update '.$this->following_topic_num.' set num=num-1 where uid='.$user_id;
		$update_topic_num='update '.$this->topic_num.' set f_num=f_num-1 where tid='.$tid;   
		
		$this->db->trans_start();
		$this->db->delete($this->topic_user_table, $topic_user_info);
		$this->db->delete($this->user_topic_table, $user_topic_info);
		$this->db->query($update_following_topic_num);
		$this->db->query($update_topic_num);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
    		return false;
		}else{
			return true;
		}
	}
	
	
	
	
	public function init_user_relation_num($user_id){
		$info['uid']=$user_id;
		$this->db->trans_start();
		$this->db->insert($this->followed_num,$info);
		$this->db->insert($this->following_num,$info);
		$this->db->insert($this->following_topic_num,$info);
		$this->db->insert($this->user_post_num_table,$info);
	//	$this->db->insert($this->user_repost_num_table,$info);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
    		return false;
		}else{
			return true;
		}
	}
	
/*	public function get_user_following($uid){
		$result=array();
		$this->db->where('fuid',$uid);
		$this->db->select('tuid');
		$query = $this->db->get($this->following_table);
		if($query==false){
			return array();
		}
		foreach ($query->result() as $row){
			$result[] = $row->tuid;
		}
		return $result;
	}*/
	
	public function get_topic_following($uid){
		$result=array();
		$this->db->where('uid',$uid);
		$this->db->select('tid');
		$query = $this->db->get($this->user_topic_table);
		if($query->num_rows()==0){
			return array();
		}
		foreach ($query->result() as $row){
			$result[] = $row->tid;
		}
		return $result;
	}
	
	public function get_user_count($uid){
		$result=array();
		$sql='select tn.num as topic,ed.num as followed,ing.num as following from '.$this->following_topic_num." as tn,".$this->followed_num." as ed,".$this->following_num." as ing where tn.uid=".$uid." and tn.uid=ed.uid and tn.uid=ing.uid";
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return array();
		}
		foreach ($query->result() as $row){
			$result['topic_num'] = $row->topic;
			$result['followed_num'] = $row->followed;
			$result['following_num'] = $row->following;
		}
		return $result;
	}
	
	
	
	public function get_topic_fans($tid){
		$this->db->where('tid',$tid);
		$this->db->select('uid');
		$query= $this->db->get($this->topic_user_table);
		if($query==false){
			return array();
		}
		$result=array();
		foreach ($query->result() as $row){
			$result[] = $row->uid;
		}
		return $result;
	}
	
	
}

?>