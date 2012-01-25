<?php

class relation extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->library('user_lib');
		$this->load->library('relation_lib');
	}
	
	public function follow_user(){
		$user_id = $this->session->userdata('uid');
		$following_id = htmlspecialchars($this->input->post('following_id'));
		$re = $this->relation_lib->add_follow_user($user_id,$following_id);
		if($re==true){//success
			echo true;
		}else{
			echo false;
		}
	}
	
	public function unfollow_user(){
		$user_id = $this->session->userdata('uid');
		$following_id = htmlspecialchars($this->input->post('following_id'));
		$re = $this->relation_lib->delete_follow_user($user_id,$following_id);
		if($re==true){//success
			echo true;
		}else{
			echo false;
		}
	}
	
	//user topic relation
	public function follow_topic(){
		$uid = $this->session->userdata('uid');
		$tid = htmlspecialchars($this->input->post('tid'));
		$re = $this->relation_lib->add_follow_topic($uid,$tid);
		if($re==true){//success
			echo true;
		}else{
			echo false;
		}
	}
	
	public function unfollow_topic(){
		$uid = $this->session->userdata('uid');
		$tid = htmlspecialchars($this->input->post('tid'));
		$re = $this->relation_lib->delete_follow_topic($uid,$tid);
		if($re==true){//success
			echo true;
		}else{
			echo false;
		}
	}
	
	
	
	public function follow_users(){
		$user_id = $this->session->userdata('uid');
		$following_ids = htmlspecialchars($this->input->post('following_id'));
		$following_id = array_unique(explode($following_ids,','));
		$re = $this->relation_lib->add_follow_user($user_id,$following_id);
		
		if($re==false){
			
			//system error
		}else{
			//success
		}
	}
	
	public function follow_topics(){
		$user_id = $this->session->userdata('uid');
		$topic_ids = htmlspecialchars($this->input->post('following_id'));
		$topic_id = array_unique(explode($topic_ids,','));
		$re = $this->relation_lib->add_follow_topic($user_id,$topic_id);
		if($re==false){
			//system error
		}else{
			//success
		}
	}	
	
}

?>