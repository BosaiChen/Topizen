<?php
class relation_lib {

	private $user_followed_num;
	private $user_following_num;
	
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->library('user_lib');
		$this->ci->load->library('topic_lib');
		$this->ci->load->model('relation_dao');
		//$mc_keys_prefix = $this->config->item('mc_prefix');
		//$this->user_followed_num = $mc_keys_prefix['user_followed_num'];
		//$this->user_following_num = $mc_keys_prefix['user_following_num'];
	}
	
	//user - user relation
	public function add_follow_user($user_id,$following_id){
		if(!$this->ci->user_lib->check_user_exist(array('uid'=>$following_id))){return false;}	
		if($this->ci->relation_dao->add_follow_user($user_id,$following_id)){
			return true;
		}else{
			return false;
		}
	} 
	
	public function delete_follow_user($user_id,$following_id){
		if(!$this->ci->user_lib->check_user_exist(array('uid'=>$following_id))){return false;}	
		if($this->ci->relation_dao->delete_follow_user($user_id,$following_id)){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_follow_user($fuid,$tuid){
		return $this->ci->relation_dao->is_follow_user($fuid,$tuid);
	}
	
	public function get_user_followings($uid){
		$uids=$this->ci->relation_dao->get_user_followings($uid);
		return $uids;	
	}
	
	public function get_user_followers($uid){
		$uids=$this->ci->relation_dao->get_user_followers($uid);
		return $uids;	
	}
	
	
	
	//user topic relation
	
	public function add_follow_topic($uid,$tid){
		if(!$this->ci->topic_lib->check_topic_exist(array('tid'=>$tid))){return false;}	
		if($this->ci->relation_dao->add_follow_topic($uid,$tid)){
			return true;
		}else{
			return false;
		}
	} 
	
	public function delete_follow_topic($uid,$tid){
		if(!$this->ci->topic_lib->check_topic_exist(array('tid'=>$tid))){return false;}	
		if($this->ci->relation_dao->delete_follow_topic($uid,$tid)){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_follow_topic($uid,$tid){
		$tids=$this->ci->relation_dao->get_topic_following($uid);
		if(in_array($tid,$tids)){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_topic_following($uid){
		return $this->ci->relation_dao->get_topic_following($uid);
	}
	
	
	
	
	
	
	
	
	public function add_follow_users($user_id,$following_id){
		foreach ($following_id as $follow_uid){
			if($this->ci->user_lib->check_user_exist(array('uid'=>$follow_uid))){
				
				if($this->ci->relation_dao->add_follow_user($user_id,$follow_uid)){
					
				}else{
					return false;
				}
			}else{
				continue;
			}	
		}
		return true;
	}
	
	public function add_follow_topics($user_id,$topic_id){
		foreach ($topic_id as $tid){
			if($this->topic_lib->check_topic_exist($tid)){
				if($this->ci->relation_dao->add_follow_topic($user_id,$tid)){
					
				}else{
					return false;
				}
			}else{
				continue;
			}	
		}
		return true;
	}
	
	
	public function init_user_relation_num($user_id){
		return $this->ci->relation_dao->init_user_relation_num($user_id);
	}
	
	
	public function get_unrelated_user($uid,$uids){
//		$following_uids=$this->ci->relation_dao->get_user_following($uid);
		$following_uids[]=$uid;
		return array_diff($uids,$following_uids);	
	}
	
	public function get_unrelated_topic($uid,$topics){
		$following_topics=$this->ci->relation_dao->get_topic_following($uid);
		return array_diff($topics,$following_topics);		
	}
	
	public function get_user_count($uid){
		return $this->ci->relation_dao->get_user_count($uid);
	}
	
	
	
	
	
	public function get_topic_fans($tid){
		return $this->ci->relation_dao->get_topic_fans($tid);
	}
	
	
}
?>