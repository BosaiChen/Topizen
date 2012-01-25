<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Email_lib{
	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	public function send_active_email($user_email){
		$expiration = 60*60*24*5;
		$this->ci->load->library('memcached_lib');
		$active_key=md5($user_email.rand());
		//$mc_keys_prefix = $this->config->item('mc_prefix');
		//$mc_key_prefix = $mc_keys_prefix['user_active'];
		//$key=$mc_key_prefix.".".$user_email;
		var_dump($active_key);
		//if(!$this->ci->memcached_lib->setMC('default', $key, $active_key, $expiration)){
		//	return false;
		//}
		// do send email
		return true;
		
	}
	
	public function check_email($user_email){
		$pattern = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
		return preg_match($pattern,$user_email);
	}
	
}
?>