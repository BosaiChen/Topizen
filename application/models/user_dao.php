<?php
class User_dao extends CI_Model{
	//********* add by yuanye
	private $login_table='login_info';
	private $base_table='user_base';
	private $ext_table='user_ext';
	private $following_num_table = 'following_num';
	private $followed_num_table='followed_num';
	private $head_image_table='user_image';
	private $user_pots_num_table='user_post_num';
	private $user_question_num_table='user_question_num';
	
	function __construct(){
		parent::__construct();
		$ci =& get_instance();
	}
	
	
// add by yuanye
	public function init_user_base_info(){
		$user_base_info['active']=0;
		if($this->db->insert($this->base_table,$user_base_info)){
			$id = $this->db->insert_id();
			$update_info['uid']=$id+9999;
			$this->db->where('id', $id);
			if($this->db->update($this->base_table,$update_info)){
				return $update_info['uid'];
			}else{
				
				return false;
			}			
		}else{
			return false;
		}
	}
	
	public function insert_reg_info($login_info,$ext_info){
		$this->db->trans_start();
		$this->db->insert($this->login_table, $login_info);
		$this->db->insert($this->ext_table, $ext_info);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;	
	}
	
	
	public function update_login_info($login_info){//by bosai 
		$this->db->where('uid', $login_info['uid']);
		$this->db->update($this->login_table,$login_info);
		return true;
	}
	
	public function update_base_info($base_info){
		$user['uid']=$base_info['uid'];
		$this->db->where('uid', $base_info['uid']);
	//	$this->db->trans_start();
		$this->db->update($this->base_table,$base_info);
	//	$this->db->insert($this->followed_num_table,$user);
	//	$this->db->insert($this->following_num_table,$user);
		return true;
	}

	public function update_avatar($base_info){//by bosai
		$user['uid']=$base_info['uid'];
		$this->db->where('uid', $base_info['uid']);
		return $this->db->update($this->base_table,$base_info);
	}
	
	
	
	
	public function get_user_interestId($user_id){
		$this->db->where('uid',$user_id);
		$this->db->from($this->base_table);
		$this->db->select('interestId');
		return $this->db->get();
	}

	
	
	public function get_login_info($user_email){
		$sql='select uid,pwd,active from '.$this->login_table." where email='".$user_email."'";
		return $this->db->query($sql);
	}
	
	public function get_login_info_by_id($uid){
		$sql='select email,uid,pwd,active from '.$this->login_table." where uid='".$uid."'";
		return $this->db->query($sql);
	}
	
	public function get_user_password($uid){ //by bosai
		$this->db->where('uid',$uid);
		$this->db->from($this->login_table);
		$query = $this->db->get();
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$pwd = $row->pwd;
			}
			return $pwd;
		}else{
			return false;
		}
	}
	
	public function get_user_base_info($info){
		foreach($info as $field=>$value){
			$this->db->where($field,$value);
		}
		return $this->db->get($this->base_table);
	}
	
	public function get_user_by_follow($num=50){
		$result=array();
		$sql='select uid from '.$this->followed_num_table.' order by num desc limit '.$num;
		$query=$this->db->query($sql);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$result[] = $row->uid;
		}
		return $result;
	}
	
	public function get_users_base_info($uids){
		if(empty($uids)){
			return false;
		}
		$result=array();
		$uid_str=implode(',',$uids);
		$sql='select * from '.$this->base_table.' where uid in ('.$uid_str.')';
		$query=$this->db->query($sql);
		if($query==false){
			return false;
		}
		foreach ($query->result() as $row){
			$result[$row->uid]['uid']=$row->uid;
			$result[$row->uid]['desc'] = $row->desc;
			$result[$row->uid]['interestId'] = $row->interestId;
			$result[$row->uid]['fullname'] = $row->fullname;
			$result[$row->uid]['image'] = $row->image;
			$result[$row->uid]['domain'] = $row->domain;
		}
		return $result;
	}
	
	
	//added by bosai
	function get_user_by_id($uid, $activated)
	{
		$this->db->where('uid', $user_id);
		$this->db->where('active', $activated ? 1 : 0);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Check if username available for registering
	 */
	function is_username_available($username)
	{
		$this->db->where('fullname', strtolower($username));

		$query = $this->db->get($this->base_table);
		return $query->num_rows() == 0;
	}
	
	/**
	 * Check if email available for registering
	 */
	function is_email_available($email)
	{
		$this->db->where('email', strtolower($email));
		$query = $this->db->get($this->login_table);
		return $query->num_rows() == 0;
	}
	
	
	public function active_user($user_email,$uid){
		$base_sql = 'update '.$this->base_table.' set active=1 where uid='.$uid;
		$login_sql = 'update '.$this->login_table." set active=1 where email='".$user_email."'";
		$active_time=date('Y-m-d H:i:s');
		$ext_sql = 'update '.$this->ext_table." set active_time ='".$active_time."' where uid=".$uid;
		$this->db->trans_start();
		$this->db->query($base_sql);
		$this->db->query($login_sql);
		$this->db->query($ext_sql);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;	
	}

	
	
	public function get_crazy_topic($uid){
		$tid=0;
		$this->db->select('crazy_topic');
		$this->db->where('uid',$uid);
		$query=$this->db->get($this->ext_table);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$tid = intval($row->crazy_topic);
		}
		return $tid;
	}

	
	
	
	public function is_crazy($uid,$tid){
		$result=array();
		$sql='select * from '.$this->ext_table.' where uid='.$uid.' and crazy_topic='.$tid;
		$query=$this->db->query($sql);
		if($query==false){
			return false;
		}
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
	public function get_user_headPic($uid){
		$this->db->where('user_id'.$uid);
		$query=$this->db->get($this->head_image_table);
		if($query==false || $query->num_rows()==0){
			return false;
		}
		$result=array();
		foreach ($query->result() as $row){
			$result['uid']=$row->user_id;
			$result['user_small_image'] = $row->user_small_image;
			$result['user_medium_image'] = $row->user_medium_image;
			$result['user_large_image'] = $row->user_large_image;
			$result['user_original_image'] = $row->user_original_image;
		}
		return $result;
	}
	
	public function get_users_headPic($uids){
		if(empty($uids) || !is_array($uids)){
			return false;
		}
		$result=array();
		$uid_str=implode(',',$uids);
		$sql='select * from '.$this->head_image_table.' where uid in ('.$uid_str.')';
		$query=$this->db->query($sql);
		if($query==false){
			return false;
		}
		foreach ($query->result() as $row){
			$result[$row->uid]['uid']=$row->user_id;
			$result[$row->uid]['user_small_image'] = $row->user_small_image;
			$result[$row->uid]['user_medium_image'] = $row->user_medium_image;
			$result[$row->uid]['user_large_image'] = $row->user_large_image;
			$result[$row->uid]['user_original_image'] = $row->user_original_image;
		}
		return $result;
	}
	
	
	
	/**
	 * Delete user record
	 */
	public function delete_user($uid)
	{
		$this->db->where('id', $uid);
		$this->db->trans_start();
		$this->db->delete($this->login_table);
		$this->db->delete($this->base_table);
		$this->db->delete($this->ext_table);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
				return false;		
		}
		return true;
	}
	
	public function get_user_post_num($uid){
		$this->db->where('uid',$uid);
		$query=$this->db->get($this->user_pots_num_table);
		if($query==false || $query->num_rows()==0){
			return false;
		}
		$result=0;
		foreach($query->result() as $row){
			$result=$row->num;
		}
		return $result;
	}
	
	public function get_user_question_num($uid){
		$this->db->where('uid',$uid);
		$query=$this->db->get($this->user_question_num_table);
		if($query==false || $query->num_rows()==0){
			return false;
		}
		$result=0;
		foreach($query->result() as $row){
			$result=$row->num;
		}
		return $result;
	}
	
}