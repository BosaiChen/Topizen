<?php
class Post_dao extends CI_Model
{	
	//add by yuanye
	private $feed_table = 'feed';
	private $topic_num_table = 'topic_num';
	private $post_info_table = 'post_create';
	private $post_attitude_table = 'post_attitude';
	private $post_num_table = 'post_num';
	private $user_post_num_table = 'user_post_num';
	private $user_topic_num_table = 'user_topic_num';
	private $repost_table='repost_create';
	private $repost_attitude_table='repost_attitude';
	private $repost_num_table = 'repost_num';
	

	function __construct(){
		parent::__construct();
		$ci =& get_instance();
		date_default_timezone_set('America/New_York');
	}
	// add by yuanye
	
	public function add_post($uid,$tid,$pid,$post_content,$post_title,$post_type){

		$time=date('Y-m-d H:i:s');
		$post_info['uid']=$uid;
		$post_info['tid']=$tid;
		$post_info['pid']=$pid;
		$post_info['content']=$post_content;
		$post_info['time']=$time;
		$post_info['title']=$post_title;
		$post_info['type']=$post_type;
		$post_info['ip']=sprintf("%u",ip2long($this->input->ip_address()));
		
		
		$feed_info_u['fromid']=$uid;
		$feed_info_u['toid']=$pid;
		$feed_info_u['type']=5;
		$feed_info_u['time']=$time;
		
		$feed_info_t['fromid']=$tid;
		$feed_info_t['toid']=$pid;
		$feed_info_t['type']=9;
		$feed_info_t['time']=$time;
		
		$post_num['pid']=$pid;
		
		$update_topic_num='update '.$this->topic_num_table.' set p_num=p_num+1 where tid='.$tid;
		$update_user_post_num='update '.$this->user_post_num_table.' set num=num+1 where uid='.$uid;
		$update_user_topic_num='update '.$this->user_topic_num_table.' set p_num=p_num+1 where uid='.$uid.' and tid='.$tid;
		$this->db->trans_start();
		$this->db->insert($this->post_info_table, $post_info);
		$this->db->insert($this->post_num_table,$post_num);
		$this->db->query($update_topic_num);
		$this->db->query($update_user_post_num);
		$this->db->query($update_user_topic_num);
		$this->db->insert($this->feed_table,$feed_info_u);
		$this->db->insert($this->feed_table,$feed_info_t);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			return false;		
		}
		return true;
	}
	
	public function create_repost($rpid,$pid,$uid,$content){
		$time=date('Y-m-d H:i:s');
		$repost_info['uid']=$uid;
		$repost_info['rpid']=$rpid;
		$repost_info['pid']=$pid;
		$repost_info['ip']=sprintf("%u",ip2long($this->input->ip_address()));
		$repost_info['content']=$content;
		$repost_info['time']=$time;
		
		$repost_num_info['rpid']=$rpid;
		
		$update_post_num='update '.$this->post_num_table.' set repost=repost+1 where pid='.$pid;
		$this->db->trans_start();
		$this->db->insert($this->repost_table, $repost_info);
		$this->db->insert($this->repost_num_table,$repost_num_info);
		$this->db->query($update_post_num);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
		
	public function get_posts($post_query){
		foreach($post_query as $field => $value){
			$this->db->where($field,$value);
		}
		$this->db->order_by('time', 'asc'); 
		$query=$this->db->get($this->post_info_table);
		if($query->num_rows()==0){
			return array();
		}
		foreach ($query->result() as $key=>$row){
			$result[$key]['pid'] = $row->pid;
			$result[$key]['tid'] = $row->tid;
			$result[$key]['uid']=$row->uid;
	//		$result[$key]['title']=$row->title;
			$result[$key]['content']=$row->content;
			$result[$key]['type']=$row->type;
			$result[$key]['time']=$row->time;
		}
		return $result;
	}
	
	
	public function like_post($uid,$pid){
		$sql='update '.$this->post_num_table.' set like=like+1 where pid='.$pid;
		$time=date('Y-m-d H:i:s');
		$post_attitude['pid']=$pid;
		$post_attitude['uid']=$uid;
		$post_attitude['time']=$time;
		$post_attitude['flag']=1;
		$this->db->trans_start();
		$this->db->query($sql);
		$this->db->insert($this->post_attitude_table,$post_attitude);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	public function like_repost($uid,$rpid){
		$sql='update '.$this->repost_num_table.' set like=like+1 where rpid='.$rpid;
		$time=date('Y-m-d H:i:s');
		$repost_attitude['rpid']=$rpid;
		$repost_attitude['uid']=$uid;
		$repost_attitude['time']=$time;
		$repost_attitude['flag']=1;
		$this->db->trans_start();
		$this->db->query($sql);
		$this->db->insert($this->repost_attitude_table,$repost_attitude);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	public function unlike_post($uid,$pid){
		$sql='update '.$this->post_num_table.' set unlike=unlike+1 where pid='.$pid;
		$time=date('Y-m-d H:i:s');
		$post_attitude['pid']=$pid;
		$post_attitude['uid']=$uid;
		$post_attitude['time']=$time;
		$post_attitude['flag']=-1;
		$this->db->trans_start();
		$this->db->query($sql);
		$this->db->insert($this->post_attitude_table,$post_attitude);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	public function get_post_info($pid){
		$this->db->where('pid',$pid);
		$query=$this->db->get($this->post_info_table);
		if($query->num_rows()==0){
			return false;
		}
		$result=array();
		foreach($query->result() as $row){
			$result['uid']=$row->uid;
			$result['tid']=$row->tid;
			$result['time']=$this->utility_lib->datetime_2_unit($row->time).' ago';
			$result['title']=$row->title;
			$result['content']=$row->content;
		}
		return $result;
	}

	public function get_repost_info($query){
		foreach($query as $field=>$value){
			$this->db->where($field,$value);
		}
		$query=$this->db->get($this->repost_table);
		$result=array();
		if($query->num_rows()==0 ){
			return $result;
		}
		foreach($query->result() as $key=>$row){
			$result[$key]['rpid']=$row->rpid;
			$result[$key]['uid']=$row->uid;
			$result[$key]['pid']=$row->pid;
			$result[$key]['time']=$this->utility_lib->datetime_2_unit($row->time).' ago';
			$result[$key]['content']=$row->content;
		}
		return $result;
	}

	public function get_post_num($post_id){
		$sql='select * from '.$this->post_num_table.' where pid='.$post_id;
		$query=$this->db->query($sql);
		$result=array();
		if($query->num_rows()==0){
			return $result;
		}
		foreach ($query->result() as $row){
			$result['like']=$row->like;
			$result['unlike']=$row->unlike;
		}
		return $result;
	}
	
	public function get_repost_num($rpid){
		$sql='select * from '.$this->repost_num_table.' where rpid='.$rpid;
		$query=$this->db->query($sql);
		$result=array();
		if($query->num_rows()==0){
			return $result;
		}
		foreach ($query->result() as $row){
			$result['like']=$row->like;
			$result['unlike']=$row->unlike;
		}
		return $result;
	}
}