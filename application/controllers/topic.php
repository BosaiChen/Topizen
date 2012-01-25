<?php
class Topic extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->library('topic_lib');
		$this->load->library('post_lib');
		$this->load->library('user_lib');
		$this->load->library('recommend_lib');
		$this->load->library('relation_lib');
		date_default_timezone_set('America/New_York');
	}
	
	//tabs
	public function expressions($topic_id){
		$data['tab_selected']='expressions';
		//$data['posts_list'] = $this->post_lib->get_topic_posts(array('tid'=>$topic_id));
		foreach($data['posts_list'] as $key=>$row){
			$data['posts_list'][$key]['author'] = $this->user_lib->get_user_base_info(array('uid'=>$row['uid']));
		}
		$this->load_topic_page($topic_id,$data);
	}
	
	public function topizens($topic_id){
		$data['tab_selected']='topizens';
		$this->load_topic_page($topic_id,$data);
	}
	
	function load_topic_page($topic_id,$arg=array()) {
		$sess_id = $this->session->userdata('uid');
		$data['sess_domain'] = $this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('topic_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('topic_page_jscript');
		$data = array_merge_recursive($data,$arg);
		
		$data["title"] = $this->lang->line('TOPIC_PAGE_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		/*======================load user info ====================*/
		$data['is_following']=$this->relation_lib->is_follow_topic($sess_id,$topic_id);
		/*=======================load topic ====================*/
		$data['topic'] = $this->topic_lib->get_topic_base_info(array('tid'=>$topic_id));
		
		$data["content"] = $this->parser->parse('/topic/topicContentNew',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	public function add_topic_page(){
		$sess_id = $this->session->userdata('uid');
		$data['sess_domain'] = $this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('add_topic_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('add_topic_page_jscript');
	
		$data["title"] = $this->lang->line('TOPIC_PAGE_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		
		$data["content"] = $this->parser->parse('/topic/add_topic',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	

	public function add_topic(){
		$this->load->library('generater_lib');
		$uid = $this->session->userdata('uid');
		$topic_title = htmlspecialchars($this->input->post('title'));
		$topic_desc = htmlspecialchars($this->input->post('desc'));
		//TODO: feature of topic interest is currently disabled
		$topic_interest = 123;
		if(!is_numeric($topic_interest)){
			return false;
		}
		$topic_id = $this->generater_lib->id_generater('topic');
		if($topic_id==false){
			return false;
		}
		$re = $this->topic_lib->addTopic($uid,$topic_id,$topic_title,$topic_desc,$topic_interest);
		switch($re['no']){
			case -1:
				//system error
				break;
			case 1:
				//OK
				//$this->topic_lib->chosenTopic($topic_id);
				break;
			default:
				//system error
				break;
		}
		echo json_encode($re);
	}

	//add by yuanye
	public function suggest_topic(){
		$this->load->library('generater_lib');
		$uid = $this->session->userdata('uid');
		$topic_title = htmlspecialchars($this->input->post('title'));
		$topic_desc = htmlspecialchars($this->input->post('desc'));
		$topic_keyword = htmlspecialchars($this->input->post('keyword'));
		$topic_tag = htmlspecialchars($this->input->post('tag'));
		$topic_intere = $this->input->post('interestId');
		if(!is_numeric($topic_intere)){
			return false;
		}
		$topic_id = $this->generater_lib->id_generater('topic');
	//	var_dump('topic_id='.$topic_id);
		if($topic_id==false){
			return false;
		}
		$re = $this->topic_lib->addTopic($uid,$topic_id,$topic_title,$topic_desc,$topic_keyword,$topic_intere,$topic_tag);
		switch($re['no']){
			case -1:
				//system error
				break;
			case 1:
				//OK
				break;
			default:
				//system error
				break;
		}
		//sysem error
	}
	
	public function get_begining($tid){
		$data['tab_selected']='begining';
		$data['posts_list'] = $this->post_lib->get_topic_posts($tid,1);//'1' for posts of begining
		$this->load_topic_page($tid,$data);
	}
	
	public function get_development($tid){
		$data['tab_selected']='development';
		$data['posts_list'] = $this->post_lib->get_topic_posts($tid,2);//'2' for posts of development
		$this->load_topic_page($tid,$data);
	}
	
	public function get_future($tid){
		$data['tab_selected']='future';
		$data['posts_list'] = $this->post_lib->get_topic_posts($tid,3);//'3' for posts of future
		$this->load_topic_page($tid,$data);
	}
	
	
	
/*	public function chosen_topic(){
		$tid = 10;
		if(!is_int($tid)){
			return false;
		}
		$re=$this->topic_lib->chosenTopic($tid);
		switch($re['no']){
			case -2:
				//topic not exist
				break;
			case -1:
				//system error
				break;
			case 1:
				//OK
				break;
			default:
				//system error
				break;
		}
	}*/
	
	public function vote_topic(){
		$uid = $this->session->userdata('uid');
		$tid = htmlspecialchars($this->input->post('tid'));
//		if(!is_int($tid)){
//			return false;
//		}
		$re=$this->topic_lib->voteTopic($uid,$tid);
		switch($re['no']){
			case -1:
				//system error
				break;
			case 1:
				//OK
				break;
			default:
				//system error
				break;
		}
		echo json_encode($re);
		//sysem error
	}
}