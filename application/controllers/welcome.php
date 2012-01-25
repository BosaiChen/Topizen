<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_lib');
		$this->load->helper('cookie');
	}
	
	function index()
	{
		//check cookie - if autologin
		if ($cookie = get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
				$data = unserialize($cookie);
				if (isset($data['uid'])) {
					$this->session->set_userdata(array(
						'uid'	=> $data['uid']
					));
					redirect(base_url().'explore'); //to public page
					return;
				}
		}
		//check session - if not autologin, check if session has expired
		$sess_uid = $this->session->userdata('uid');
		if($sess_uid){ // login via session
			redirect(base_url().'explore'); //to public page
			return;
		}
		//no cookie,no session -normal login
		$this->load->view('homepage');
	}	
}