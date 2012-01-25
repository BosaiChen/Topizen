<?php
class Organizor extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('user_lib');
		date_default_timezone_set('America/New_York');
	}
	
	public function show_topic_add_page(){
		$sess_uid = $this->session->userdata('uid');
		$data['sess_domain']=$this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('orgz_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('orgz_page_jscript');
		
		$data['jscript_constants_init'] = $this->parser->parse('/constants_js',$data,true);
		
		$data["title"] = $this->lang->line('PUBLIC_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		
		$data["content"] = $this->parser->parse('/organizor/orgz_add_topic',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	public function show_topic_all_page(){
		$sess_uid = $this->session->userdata('uid');
		$data['sess_domain']=$this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('orgz_all_topic_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('orgz_all_topic_jscript');
		
		$data['jscript_constants_init'] = $this->parser->parse('/constants_js',$data,true);
		
		$data["title"] = $this->lang->line('PUBLIC_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		
		$data["content"] = $this->parser->parse('/organizor/orgz_all_topic',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	public function show_topic_single_page(){
		$sess_uid = $this->session->userdata('uid');
		$data['sess_domain']=$this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('orgz_single_topic_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('orgz_single_topic_jscript');
		
		$data['jscript_constants_init'] = $this->parser->parse('/constants_js',$data,true);
		
		$data["title"] = $this->lang->line('PUBLIC_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		
		$data["content"] = $this->parser->parse('/organizor/orgz_topic_single',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	public function show_topic_voting_all_page(){
		$sess_uid = $this->session->userdata('uid');
		$data['sess_domain']=$this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('orgz_topic_voting_all_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('orgz_topic_voting_all_jscript');
		
		$data['jscript_constants_init'] = $this->parser->parse('/constants_js',$data,true);
		
		$data["title"] = $this->lang->line('PUBLIC_TITLE');
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		
		$data["content"] = $this->parser->parse('/organizor/orgz_topic_voting_all',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
}