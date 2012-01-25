<?php
class Public_c extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('topic_lib');
		$this->load->library('user_lib');
		date_default_timezone_set('America/New_York');
	}
	
	function index() {
		$this->topics();
	}
	
	public function show_public_page($arg=array()) {
		$sess_uid = $this->session->userdata('uid');
		$data['sess_domain']=$this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('public_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('public_page_jscript');
		//merge extra data
		$data = array_merge_recursive($data,$arg);
		$data['jscript_constants_init'] = $this->parser->parse('/constants_js',$data,true);
		
		$data["title"] = $this->lang->line('PUBLIC_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		
		//get new topic 
	//	$num=3;
	//	$new_topics=$this->topic_lib->get_new_topic($num);
	//	foreach ($new_topics as $tid => $info){
	//		$data["new_topic"][$tid]['title'] = $info['title'];
	//	}
		//get feature topics
		$data["feature_topic"]=$this->topic_lib->get_feature_topic($sess_uid);
		
		/*======= Recommendation coming soon======*/
	//	$data["top_user"]=$this->user_lib->get_top_user($sess_uid,$num);
	//	$data["top_topic"]=$this->topic_lib->get_top_topic($sess_uid,$num);
		$data["top_user"]=array();
		$data["top_topic"]=array();
		/*============================================*/
		$data["content"] = $this->parser->parse('/public/publicContentNew',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	
	public function topics(){
		$data['tab_selected']='topics';
		$start = 0;
		$num_topics_to_load =$this->session->userdata('public_topic_start');
		
		$data['public_topics_start']=$this->session->userdata('public_topic_start');
		$data['public_topics_num_per_load']=$this->session->userdata('public_topic_num');
		$data['topics_list']=$this->topic_lib->get_all_topics_by_limit($start,$num_topics_to_load);
		
		$this->show_public_page($data);
	}
	
	public function voting_topics(){
		$data['tab_selected']='voting_topics';
		$start = 0;
		$num_topics_to_load =$this->session->userdata('public_voting_topic_start');
		
		$data['public_voting_topics_start']=$this->session->userdata('public_voting_topic_start');
		$data['public_voting_topics_num_per_load']=$this->session->userdata('public_voting_topic_num');
		$data['topics_list']=$this->topic_lib->get_voting_topics_by_limit($start,$num_topics_to_load);
		$this->show_public_page($data);
	}
	
	
	public function ajax_get_topics(){//by bosai
		$start = $this->input->post('start');
		$desiredTopics = $this->input->post('desiredTopics');
		$result = $this->topic_lib->get_all_topics_by_limit($start,$desiredTopics);
		echo json_encode($result);
		$this->session->set_userdata('public_topic_start',$start+$desiredTopics);
		die();
	}
	
	public function ajax_get_voting_topics(){//by bosai
		$start = $this->input->post('start');
		$desiredTopics = $this->input->post('desiredTopics');
		$result = $this->topic_lib->get_voting_topics_by_limit($start,$desiredTopics);
		echo json_encode($result);
		$this->session->set_userdata('public_voting_topic_start',$start+$desiredTopics);
		die();
	}
	
}