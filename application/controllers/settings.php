<?php

Class Settings extends CI_Controller
{	
	function __construct(){
		parent::__construct();
		$this->load->library('user_lib');
		//********
		//date_default_timezone_set('America/New_York');
	}
	
	
	function account() {
		$data["title"]=$this->lang->line('account');
		$data["tab_selected"] = 'account';
		$this->load_settings_page($data);
	}
	
	function picture() {
		$data["title"]=$this->lang->line('picture');
		$data["tab_selected"] = 'picture';
		$this->load_settings_page($data);
	}
	
	
	function password() {
		$data["title"]=$this->lang->line('password');
		$data["tab_selected"] = 'password';
		$this->load_settings_page($data);
	}
	
	public function load_settings_page($arg=array()){
		$sess_id = $this->session->userdata('uid');
		$data['sess_domain']=$this->session->userdata('domain');
		$data['css_external_links'] = $this->config->item('settings_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('settings_page_jscript');
		/** get info **/
		$data['user']=$this->user_lib->get_user_base_info(array('uid'=>$sess_id));
		
		$data=array_merge_recursive($data,$arg);
		
		$data["header"] = $this->parser->parse('/layout/header',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$data["content"] = $this->parser->parse('/settings/settings_page',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	public function ajax_match_password(){
		$sess_id = $this->session->userdata('uid');
		$old_pwd = $this->input->post('old_password');
		if(!$this->user_lib->match_password($sess_id,$old_pwd)){
			$response = array(
	      		'code' => '0', 
	      		'msg' => "You current password does not match our record in database"
			);
		}else{
			$response = array(
		      'code' => '1', 
		      'msg' => "Correct current password"
			);
		}
		echo json_encode($response);
		exit;
	}
	
	public function ajax_update_password(){
		$sess_id = $this->session->userdata('uid');
		$new_pwd = $this->input->post('new_password');
		if(!$this->user_lib->update_password($sess_id,$new_pwd)){
			$response = array(
	      		'code' => '0', 
	      		'msg' => "System error"
			);
		}else{
			$response = array(
		      'code' => '1', 
		      'msg' => "Your new password has been saved"
			);
		}
		echo json_encode($response);
		exit;
	}
}