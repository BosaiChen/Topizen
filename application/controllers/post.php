<?php
class Post extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->library('post_lib');
		$this->load->library('topic_lib');
		$this->load->library('user_lib');
		date_default_timezone_set('America/New_York');
	}
	
/*	function load_post_page($post_id) {
		$data["title"] = $this->lang->line('POST_PAGE_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$data["post_id"] = $post_id;
		$data=$this->post_lib->get_post_page_info($post_id,$this->global_user_id);
		$data["content"] = $this->parser->parse('/post/postContent',$data,true);
		$this->parser->parse('/post/postDisplay',$data);
	}*/
	
	
	// add by yuanye
	public function create_post(){
		$this->load->library('generater_lib');
		$uid = $this->session->userdata('uid');
		$tid = htmlspecialchars($this->input->post('topicId'));
		$post_content = htmlspecialchars($this->input->post('content'));
		$post_type = htmlspecialchars($this->input->post('post_type'));
		switch($post_type){
			case 'begining':$post_type=1;break;
			case 'development':$post_type=2;break;
			case 'future':$post_type=3;
		}
		//feature of 'title' is currently disabled but the field in table is kept
		$post_title = 'untitled';
		
		if(!is_numeric($tid) || empty($post_content) || empty($post_title)){
			return false;
		}
		$pid = $this->generater_lib->id_generater('post');
		if($pid==false){
			return false;
		}
		$re = $this->post_lib->addPost($uid,$tid,$pid,$post_content,$post_title,$post_type);
		
		switch($re['no']){
			case -2://topic not exist
				break;
			case -1://system error
				break;
			case 1://OK
				$re['author']=$this->user_lib->get_user_base_info(array('uid'=>$uid));
				$re['time']=date('Y-m-d H:i:s');
				break;
		}
		echo json_encode($re);
	}
	
	public function get_single_post(){
		$pid = htmlspecialchars($this->input->post('pid'));
		$post_info = $this->post_lib->get_single_post($pid);//'3' for posts of future
		return json_encode($post_info);
	}
	
	public function attitude_post(){
		$pid = htmlspecialchars($this->input->post('postId'));
		$tid = htmlspecialchars($this->input->post('topicId'));
		$uid = $this->global_user_id;
		$flag= $this->input->post('flag');
		if($flag!=1 || $flag!=-1 || !is_numeric($pid)){
			return false;
		}
		$re=$this->post_lib->attitude_post($uid,$pid,$tid,$flag);
		if($re==false){
			return false;
		}else{
			return true;
		}
	}
	
	public function ajax_create_repost(){
		$pid=htmlspecialchars($this->input->post('postId'));
		$content=htmlspecialchars($this->input->post('content'));
		$uid=$this->session->userdata('uid');
		if(!is_numeric($pid)){
			return false;
		}
		$re=$this->post_lib->create_repost($pid,$uid,$content);
		switch($re['no']){
			case -2://topic not exist
				break;
			case -1://system error
				break;
			case 1://OK
				$re['author']=$this->user_lib->get_user_base_info(array('uid'=>$uid));
				$re['time']=date('Y-m-d H:i:s');
				break;
		}
		echo json_encode($re);
	}
	
	public function ajax_get_reposts(){
		$pid=htmlspecialchars($this->input->post('postId'));
		$repost = $this->post_lib->get_reposts_by_pid($pid);
		if($repost==null){
			echo false;
		}else{
			echo json_encode($repost);
		}
	}
	
	public function attitude_repost(){
		$rpid = htmlspecialchars($this->input->post('repid'));
		$pid=htmlspecialchars($this->input->post('postId'));
		$uid = $this->global_user_id;
		$flag= $this->input->post('flag');
		if($flag!=1 || $flag!=-1 || !is_numeric($rpid) || !is_numeric($pid)){
			return false;
		}
		$re=$this->post_lib->attitude_repost($uid,$rpid,$pid,$flag);
		if($re==false){
			return false;
		}else{
			return true;
		}
	}

}