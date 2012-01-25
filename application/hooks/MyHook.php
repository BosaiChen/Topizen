<?php
/**
*  @FILE_NAME : hooks.php
*  @APPLICATION : www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: Jun 6, 2011
*  @AUTHOR: Sungjun Ma
*  @CONTACT: firegun17@gmail.com
*  @BRIEF_FILE_DESCRIPTION: descriptions here...
*
* Module Operations:
* ==================
* This module blah blah...
*
* Public Interface Usage:
* =================
*
* Maintenance History:
* ====================
* ver 1.0 : Jun 6, 2011
* - first release
*/
/*  
 * @FILE: MyHook.php
 * @DATE:Jun 6, 2011
 * @AUTHOR: SUNGJUN MA
 * @CONTACT: firegun17@gmail.com
 * @CLASS DESCRIPTION: BLAH BLAH..
*/
class MyHook{
	private $CI;
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: MyHook.php
	 * @DATE:Jun 6, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	public function __construct(){
		//parent::__construct();
		$this->CI = & get_instance();
		
        $this->CI->load->library('session');
        $this->CI->load->library('uri');
        //$this->CI->load->library('config');
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: MyHook.php
	 * @DATE:Jun 6, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:	
	 * @PARAM2:	
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	function post_controller_hook() {
		$this->CI = & get_instance();
		if($this->CI->uri->uri_string()=="topic"){
		
		}
	/*	$this->CI = & get_instance();
		if($this->CI->uri->uri_string()=="citizens"){
			redirect(base_url()."citizens/0");
			return;
		}
		if($this->CI->uri->uri_string()=="explore"){
			redirect(base_url()."explore");
			return;
		}
		if($this->CI->uri->uri_string()=="user_c/log_in"){
			return;
		}
		if($this->CI->uri->uri_string()=="user_c/show_register_page"){
		//	return;
		}
		if($this->CI->uri->uri_string()=="user_c/register"){
			return;
		}
		if($this->CI->uri->uri_string()=="user_c/check_email"){
			return;
		}
		if($this->CI->uri->uri_string()=="user_c/show_register_success"){
			return;
		}
		if($this->CI->uri->uri_string()=="user_c/upload_file"){
			//session_id($_POST["session_id"]);
			return;
		}
		if($this->CI->uri->uri_string()=="user_c/store_images"){
			//session_id($_POST["session_id"]);
			return;
		}
		if($this->CI->uri->uri_string()=="welcome/show_error_page/1"){
			return;
		}
		$pos = strpos($this->CI->uri->uri_string(),"admin");
		if(( $pos == false && // make sure uri does not contain "admin"
			(strlen($this->CI->session->userdata("user_id"))==0||
			$this->CI->session->userdata("user_id")==0))
		&&$this->CI->uri->total_segments()!=0){
			$this->_render_main_page();
		}*/
	}
	
}