<?php
class Citizens extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('user_lib');
		$this->load->library('topic_lib');
		$this->load->library('recommend_lib');
		$this->load->library('relation_lib');
		date_default_timezone_set('America/New_York');
	}
	
	public function show_profile_page($domain_name,$arg=array()){
		$data['sess_domain']=$this->session->userdata('domain');
		$data['domain'] = $domain_name;
		$data['css_external_links'] = $this->config->item('citizen_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('citizen_page_jscript');
		$uid = $this->user_lib->check_user_exist(array('domain'=>$domain_name));
		if($uid==false){
			show_404();
			return;
		}else{
			$sess_id=$this->session->userdata('uid');
			if($uid==$sess_id){ // view my own profile
				$data['on_my_page']=true;
			}else{//view others profile
				$data['on_my_page']=false;
			}
		}
		$data = array_merge_recursive($data,$arg);
		$data['jscript_constants_init'] = $this->parser->parse('/constants_js',$data,true);
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		
		$data['user_info'] = $this->user_lib->get_personal_page_info($uid);
		$data['is_following']=$this->relation_lib->is_follow_user($sess_id,$uid);
		$num=3;
		/*======= Recommendation coming soon======*/
	//	$re_users=$this->recommend_lib->get_user_recommend($sess_id,$num);
	//	$re_topics=$this->recommend_lib->get_topic_recommend($sess_id,$num);
		$re_users['user']=array();
		$re_topics['topic']=array();
		$data['recommend']=array_merge_recursive($re_topics,$re_users);
		/*============================================*/
		
		/*==================load posts======================*/
	//	$data["posts_list"]=$this->_get_posts($domain_name);
		/*===============================================*/
		/*==================load following======================*/
		$data["followings_list"]=$this->_get_following($domain_name);
		/*===============================================*/
		$data["title"] = $data['user_info']['fullname'].$this->lang->line('PERSONAL_PAGE_TITLE');
		$data["content"] = $this->parser->parse('/personal/personalContent',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
		return;
	}
	
	private function _get_topics($domain_name){
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$tids = $this->relation_lib->get_topic_following($uid);
		foreach($tids as $key=>$tid){
			$data[$key]=$this->topic_lib->get_topic_base_info(array('tid'=>$tid));
		}
		if(!empty($data)){
			return $data;
		}else{
			return array();
		}
	}
	
	private function _get_posts($domain_name){
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$this->load->library('post_lib');
		$data['item'] = $this->post_lib->get_topic_posts(array('uid'=>$uid));
		
		foreach($data['item'] as $key=>$row){
			$data['item'][$key]['author'] = $this->user_lib->get_user_base_info(array('uid'=>$uid));
			$data['count']=$key+1;
		}
		if(!empty($data['item'])){
			return $data;
		}else{
			return array();
		}
	}
	
	private function _get_following($domain_name){
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$following_uids = $this->relation_lib->get_user_followings($uid);
		foreach($following_uids as $key=>$following_uid){
			$data['item'][$key]=$this->user_lib->get_user_base_info(array('uid'=>$following_uid));
			$data['count']=$key+1;
		}
		if(isset($data)){
			return $data;
		}else{
			return array();
		}
	}
	
	private function _get_follower($domain_name){
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$followers_uids = $this->relation_lib->get_user_followers($uid);
		foreach($followers_uids as $key=>$follower_uid){
			$data['item'][$key]=$this->user_lib->get_user_base_info(array('uid'=>$follower_uid));
			$data['count']=$key+1;
		}
		if(isset($data)){
			return $data;
		}else{
			return array();
		}
	}
	
	//tabs
	public function following($domain_name){
		$data['tab_selected']='following';
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$following_uids = $this->relation_lib->get_user_followings($uid);
		foreach($following_uids as $key=>$following_uid){
			$data['followings_list'][$key]=$this->user_lib->get_user_base_info(array('uid'=>$following_uid));
		}
		$this->show_profile_page($domain_name,$data);
	}
	
	public function followers($domain_name){
		$data['tab_selected']='followers';
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$followers_uids = $this->relation_lib->get_user_followers($uid);
		foreach($followers_uids as $key=>$follower_uid){
			$data['followers_list'][$key]=$this->user_lib->get_user_base_info(array('uid'=>$follower_uid));
		}
		$this->show_profile_page($domain_name,$data);
	}
	
	public function my_topics($domain_name){
		$data['tab_selected']='my_topics';
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$tids = $this->relation_lib->get_topic_following($uid);
		foreach($tids as $key=>$tid){
			$data['topics_list'][$key]=$this->topic_lib->get_topic_base_info(array('tid'=>$tid));
		}
		$this->show_profile_page($domain_name,$data);
	}
	
	public function expressions($domain_name){
		$data['tab_selected']='expressions';
		$base_info=$this->user_lib->get_user_base_info(array('domain'=>$domain_name));
		$uid = $base_info['uid'];
		$this->load->library('post_lib');
		$data['posts_list'] = $this->post_lib->get_topic_posts(array('uid'=>$uid));
		foreach($data['posts_list'] as $key=>$row){
			$data['posts_list'][$key]['author'] = $this->user_lib->get_user_base_info(array('uid'=>$uid));
		}
		$this->show_profile_page($domain_name,$data);
	}
	
	public function ajax_get_following(){//by bosai
		$uid = $this->input->post('uid');
		$start = $this->input->post('start');
		$num_of_following = $this->input->post('personal_following_per_load');
		$following_uids = $this->relation_lib->get_user_following_by_limit($uid,$start,$num_of_following);
		foreach($following_uids as $key=>$following_uid){
			$data['following_list'][$key]=$this->user_lib->get_user_base_info(array('uid'=>$following_uid));
		}
		echo json_encode($data['following_list']);
		$this->session->set_userdata('personal_following_start',$start+$num_of_following);
		die();
	}
}
