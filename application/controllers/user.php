<?php
class User extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->library('user_lib');
		$this->load->library('topic_lib');
		//******* add by yuanye
		$this->load->library('email_lib');
		//********
		//date_default_timezone_set('America/New_York');
	}
	
	public function log_in(){
		$user_email = htmlspecialchars($this->input->post('email'));
		$user_pwd = md5(htmlspecialchars($this->input->post('password')));
		$remember = $this->input->post('remember')=='on'?true:false;
		if(empty($user_email) || empty($user_pwd)){
			//system error 
			return;
		}
		$re = $this->user_lib->login($user_email,$user_pwd,$remember);
		switch ($re['no']){
			case 1: //ok, but need to fill profile first
   				redirect(base_url().'regprofile'); 
   				echo 1;
				break;
			case 2://success
				redirect(base_url().'explore');
				break;
			case -1: //user not exist
				echo -1;
				break;
			case -2://pwd error
				echo -2;
				break;
			case -3:
				//need to active
				echo -3;
				break;
			default:
				//system error
		}
		//system error
	}	
	
	
	function log_out() {
		//delete session
		$this->session->unset_userdata(array('uid' => ''));
		$this->session->sess_destroy();
		//delete cookie
		$this->load->helper('cookie');
		delete_cookie($this->config->item('autologin_cookie_name'));
		redirect(base_url());
	}
	
	public function set_user_base_info() {
		$uid=$this->session->userdata('uid');
		$base_info=array(
			'uid'=>$uid,
			'desc'=>htmlspecialchars($this->input->post('desc')),
			'fullname'=>htmlspecialchars($this->input->post('fullname')),
			'domain'=>htmlspecialchars($this->input->post('domain')),
			'u_interestId'=>123
		);
	//	if(empty($user_id) || empty($user_desc) || empty($user_fullname) || empty($domain)|| ($user_interestId<000 && $user_interestId>999)){
			//system error
	//	}
		if($this->user_lib->set_user_base_info($base_info)){
			$this->load->library('relation_lib');
			if($this->relation_lib->init_user_relation_num($uid)){
				echo 1;//success
			}else{
				echo 'fail';
			}
		}else{
			echo 'fail';
			//system error
		}
	}
	
	function show_regprofile_page() {
		$data['css_external_links'] = $this->config->item('regprofile_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('regprofile_page_jscript');
		$data["title"] = $this->lang->line('USER_REGISTER_TITLE');
		$data["header"] = $this->parser->parse('/layout/header2',$data,true);
		$data["content"] = $this->parser->parse('/user/regProfile',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	function show_regfollows_page() {
		$data['css_external_links'] = $this->config->item('regfollows_page_css');
		$data['global_jscript_external_links'] = $this->config->item('global_jscript');
		$data['jscript_external_links'] = $this->config->item('regfollows_page_jscript');
		$this->load->library('recommend_lib');
		$user_id=$this->session->userdata('uid');
		$num=10;
		$re_users=$this->recommend_lib->get_user_recommend($user_id,$num);
		$re_topics=$this->recommend_lib->get_topic_recommend($user_id,$num);
		$data=array_merge_recursive($data,$re_topics,$re_users);
		$data["title"] = $this->lang->line('USER_REGISTER_TITLE');
		$data["header"] = $this->parser->parse('/layout/header2',$data,true);
		$data["content"] = $this->parser->parse('/user/regFollows',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/layout/generalDisplay',$data);
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user.php
	 * @DATE:May 3, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @RETURN: NONE
	 * @FUNCTION DESCRIPTION: it will show sign up page
	*/
	function show_register_page() {
		$this->load->view('/user/userRegister');
	}

	
	
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:Jun 3, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: display register success page after initial registration step
	*/
	function show_register_success() {
		$this->load->view('user/userRegistSuccess.php');
		//sleep(10);
		
		//redirect(base_url().'regprofile');
	}
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:Jun 3, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	private function _create_image($user_data,$user_profile_data) {
		//make it bigger size( large image )
		
		//extract image file name, and check whether dst folder exists, if not,create the folder
		// and move files to that folder. create small image	
		/*$user_tmp_file_folder = "/includes/upload/";
		$user_final_file_foler = "/includes/user_upload/";
        if(!is_dir(".".$user_final_file_foler.md5($user_data["email"])."/img/")){
        	mkdir(".".$user_final_file_foler.md5($user_data["email"])."/img/",0777,true);
        }
        $user_default_small_image = base_url()."includes/images/image_default.png";
        $user_default_medium_image = base_url()."includes/images/default_medium.png";
        $user_default_large_image = base_url()."includes/images/default_lg.png";
        
        //create small image
        $user_image_file = basename(strlen($this->session->userdata('small_image_path'))>0?
        $this->session->userdata('small_image_path'):$user_default_small_image);
		$target_path = $user_final_file_foler.md5($user_data["email"])."/img/".$user_image_file;
		$user_img_data["user_small_image"] = $this->config->item('base_url').$target_path;
		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
        
        //create medium image $this->session->userdata('medium_image_path')
        $user_image_file = basename(strlen($this->session->userdata('medium_image_path'))>0?
        $this->session->userdata('medium_image_path'):$user_default_medium_image);
		$target_path = $user_final_file_foler.md5($user_data["email"])."/img/".$user_image_file;
		$user_img_data["user_medium_image"] = $this->config->item('base_url').$target_path; 
		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
        //create large image $this->session->userdata('large_image_path')
        $user_image_file = basename(strlen($this->session->userdata('large_image_path'))>0?
        $this->session->userdata('large_image_path'):$user_default_medium_image);
		$target_path = $user_final_file_foler.md5($user_data["email"])."/img/".$user_image_file;
		$user_img_data["user_large_image"] = $this->config->item('base_url').$target_path;
		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
        
        //create original image
        $user_image_file = basename($this->session->userdata('original_image_path'));
		$target_path = $user_final_file_foler.md5($user_data["email"])."/img/".$user_image_file;
		$user_img_data["user_original_image"] = $this->config->item('base_url').$target_path;  
		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);*/
	}
	


	/*
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:May 18, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: Browse button in userUploadFile.php would invoke upload_file function.
	 * it will convert all types of image(jpg,bmp,gif,png) to jpg image.
	 */
	function upload_file(){
		//session_id($this->input->post("session_id"));
	//	$this->session->set_userdata(array('session_id'=>$this->input->post("session_id")));
		
		//$large_obj = json_decode($large);
		
	//	$user_data = json_decode($this->input->post('user_data'));
		//echo $user_data;
	//	$this->session->set_userdata($user_data);
		//echo $this->input->post("session_id")." -- ".$this->session->userdata("session_id");
		//return;
		//session_id($this->input->post("session_id"));//re-generate session id;
		if(!empty($_FILES)){
			$tempFile = $_FILES["Filedata"]["tmp_name"];
			$targetPath = '/includes/upload/';
			list($width, $height, $type, $attr) = getimagesize($tempFile);
			if($width < 120 && $height < 120) {
				echo "2";//image size error;
				return;
			}
			
			//log_message("debug"," ff : ".$this->session->userdata('original_image_path'));
			//echo $this->session->userdata('original_image_path');
		//	if(is_file($this->session->userdata('original_image_path'))) unlink($this->session->userdata('original_image_path'));
		//	if(is_file($this->session->userdata('large_image_path')))	unlink($this->session->userdata('large_image_path'));
		//	if(is_file($this->session->userdata('medium_image_path')))	unlink($this->session->userdata('medium_image_path'));
		//	if(is_file($this->session->userdata('small_image_path')))	unlink($this->session->userdata('small_image_path'));
			$large_file = $targetPath.uniqid().strtolower($_FILES['Filedata']['name']);
			move_uploaded_file($tempFile,".".$large_file);
			
			//session_id($this->input->post("session_id"));
		//	$session_data["original_image_path"] = ".".$large_file;
		//	$this->session->set_userdata($session_data);
			
		//	$file_extention = end(explode('.',$large_file));
		//	$sum_file = "";
			//$targetFile file is original file
		//	$smaller_edge = min($width,$height);
		//	$bigger_edge = max($width,$height);
		//	if($width >= $height) $flag = 1;//$width is bigger than $height
	//		else $flag = 0;//$heigth is bigger than $width
			/****re-size of large image****/
	//		$newImageWidth = ceil($flag?($bigger_edge/$smaller_edge)*140:140);
	//		$newImageHeight = ceil(!$flag?($bigger_edge/$smaller_edge)*140:140);
	//		
	//		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	//		$image = ".".$large_file;
	//		$source = $this->_create_image_based_on_extention($file_extention,$image);
	//		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	//		imagejpeg($newImage,$image,90);
	//		chmod($image, 0777);
			
	//		$sum_file = $large_file;
     //   	echo $sum_file;//means success*/
        	
        //	$user_data_return = json_encode(array_slice($this->session->all_userdata(),4));
        //	echo "*".$user_data_return;
        	$data['path']=$large_file;
        	echo json_encode($data);
        	return;
    	}
   		echo "0";//0 means fail
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:May 22, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: create image based on its extension
	*/
	private function _create_image_based_on_extention($extention,$image) {
		switch(strtolower($extention)){
			case 'jpg':
				$source = imagecreatefromjpeg($image);
				break;
			case 'png':
				$source = imagecreatefrompng($image);
				break;
			case 'gif':
				$source = imagecreatefromgif($image);
				break;
			case 'bmp':
				$source = imagecreatefromwbmp($image);
				break;
		}
		return $source;
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:May 18, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: 1 on success ,0 failuer
	 * @FUNCTION DESCRIPTION: check email uniqueness
	*/
	function check_email() {
		$email = $this->input->post('email');
		if($this->user_lib->is_email_available($email)){
			echo "1";//able to register
			return;
		}
		echo "0";
	}
	
	
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:May 20, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @RETURN: path of re-sized image
	 * @FUNCTION DESCRIPTION: Handle Ajax Call from userUploadFile.php to upload re-sized image,(we press save button in userUploadFile.php)
	 */
	function store_images() {
		$orig_img_path = $this->input->post('img_path');
		$orig_img_name = end(explode('/',$orig_img_path));
	//	echo json_encode($orig_img_name);
//		$orig_img_obj = json_decode($orig_img);
		$file_extention = end(explode('.',$orig_img_name));
	//	if(is_file($this->session->userdata('large_image_path')))	unlink($this->session->userdata('large_image_path'));
	//	if(is_file($this->session->userdata('medium_image_path')))	unlink($this->session->userdata('medium_image_path'));
	//	if(is_file($this->session->userdata('small_image_path')))	unlink($this->session->userdata('small_image_path'));
		//You can alter these options, for large image
		$upload_dir = "/includes/upload"; 				// The directory for the images to be saved in	
		$upload_path = $upload_dir."/";				// The path to where the image will be saved
		$target_image_name = basename($orig_img_name); 		// New name of the large image
	//	$target_image_name = uniqid().basename($orig_img_name);;
	//	$max_file = "524288"; 						// 512 KB
	//	$max_width = "120";							// Max width allowed for the large image
		//Image Locations
	//	$large_image_location = ".".$upload_path.$large_image_name;
		$target_image_location = $upload_path.$target_image_name;
		//Create the upload directory with the right permissions if it doesn't exist
		if(!is_dir(".".$upload_dir)){
			mkdir(".".$upload_dir, 0777);
			chmod(".".$upload_dir, 0777);
		}
		/********** start of large image**********/
	//	$thumb_image_file_name = $thumb_image_name;// New name of the thumbnail image
		//Get the new coordinates to crop the image.
	//	$start_width = $orig_img_obj->{"x1"};
	//	$start_height = $orig_img_obj->{"y1"};
	//	$width = $orig_img_obj->{"w_image"};
	//	$height = $orig_img_obj->{"w_image"};	
	//	$thumb_image_name = $thumb_image_location;
	//	$image = $large_image_location;
		
	//	$newImageWidth = ceil($width);
	//	$newImageHeight = ceil($height);
	//	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	//	$source = imagecreatefromjpeg($image);
	//	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	//	imagejpeg($newImage,$thumb_image_name,90);
	//	chmod($thumb_image_name, 0777);
	//	$session_data["large_image_path"] = $thumb_image_name;
		/*****end of large image****/
		//unlink($large_image_location);//delete
	//	$session_data["original_image_path"] = $large_image_location;
		/****start of middle image resizeing***/
	//	$newImageResized = $upload_path.uniqid().basename($orig_img_obj->{"image_name"},$file_extention).$file_extention;
	//	$this->_resizeThumbnailImage(".".$newImageResized,$thumb_image_location,57,57,120,120,1);
	//	$session_data["medium_image_path"] = ".".$newImageResized;
		/*****start of small size image resizeing****/
	//	$newImageResized = $upload_path.uniqid().basename($orig_img_obj->{"image_name"},$file_extention).$file_extention;
	//	$this->_resizeThumbnailImage(".".$newImageResized,$thumb_image_location,38,38,120,120,1);
	//	$session_data["small_image_path"] = ".".$newImageResized;
		/****destroy image****/
	//	$this->session->set_userdata($session_data); 
		//echo $newImageResized;
		$this->_move_image_to_user_folder($target_image_location);
		echo "done";
	}
	
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:Jun 8, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	private function _move_image_to_user_folder($orig_image) {
		$uid = $this->session->userdata('uid');
		$email=$this->user_lib->get_user_email($uid);
		if($email==false){return false;}
		if(isset($email)){
			$user_tmp_file_folder = "/includes/upload/";
			$user_final_file_foler = "/includes/user_upload/";
	        if(!is_dir(".".$user_final_file_foler.md5($email)."/img/")){
	        	mkdir(".".$user_final_file_foler.md5($email)."/img/",0777,true);
	        }
	    //    $handle=opendir(".".$user_final_file_foler.md5($email)."/img/"."."); 
		//	while (false !== ($file = readdir($handle))){
		//		if ($file != "." && $file != "..") {
		//			echo $file;
		//			unlink(".".$user_final_file_foler.md5($email)."/img/".$file);
		//		}
		//	}
		//	closedir($handle); 
	        //create small image
	        $user_image_file = basename($orig_image);
			$target_path = $user_final_file_foler.md5($email)."/img/".$user_image_file;
		//	$target_location = $this->config->item('base_url').$target_path;
		//	rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
	        
	        //create medium image $this->session->userdata('medium_image_path')
	   //     $user_image_file = basename($this->session->userdata('medium_image_path'));
	//		$target_path = $user_final_file_foler.md5($email)."/img/".$user_image_file;
	//		$user_img_data["user_medium_image"] = $this->config->item('base_url').$target_path; 
	//		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
	        //create large image $this->session->userdata('large_image_path')
	  //      $user_image_file = basename($this->session->userdata('large_image_path'));
	//		$target_path = $user_final_file_foler.md5($email)."/img/".$user_image_file;
	//		$user_img_data["user_large_image"] = $this->config->item('base_url').$target_path;
	//		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
	        
	        //create original image
	  //      $user_image_file = basename($this->session->userdata('original_image_path'));
	//		$target_path = $user_final_file_foler.md5($email)."/img/".$user_image_file;
	//		$user_img_data["user_original_image"] = $this->config->item('base_url').$target_path;  
	//		rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
			
	//		$user_img_where["user_id"] = $this->session->userdata('user_id'); 
		//	rename($orig_image,$target_path);
			$this->user_lib->update_avatar($uid,$orig_image);
			return;
		}
	}
	
	//You do not need to alter these functions
	private function _resizeThumbnailImage($thumb_image_name, $image, $width, $height, $src_width, $src_height, $scale){
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$source = imagecreatefromjpeg($image);
		imagecopyresampled($newImage,$source,0,0,0,0,$width,$height,$src_width,$src_height);
		imagejpeg($newImage,$thumb_image_name,90);
		chmod($thumb_image_name, 0777);
		//return $thumb_image_name;
	}
	
	
	

	
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:Jun 6, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: update sessioin activity
	*/
	function update_session_last_activity() {
		$session_data["user_id"] = $this->session->userdata('uid');
		$this->session->set_userdata($session_data);
	}
	
	
	function show_system_busy_page(){
		$data["title"] = $this->lang->line('USER_REGISTER_TITLE');
		$data["header"] = $this->parser->parse('/layout/header_2',$data,true);
		$data["content"] = $this->parser->parse('/user/systemErrorPage.php',$data,true);
		$data["footer"] = $this->parser->parse('/layout/footer',$data,true);
		$this->parser->parse('/personal/personalDisplay',$data);
	}
	
	
	
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:Jun 10, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	function update_user_info() {
		$user_profile_query["user_id"] = $this->session->userdata('uid');
		$user_profile_update["first_name"] = $this->input->post('first_name');
		if(strlen($user_profile_update["first_name"]) > 0){
			//first name is not empty
			$this->user_lib->update_user_profile($user_profile_query,$user_profile_update);
		}
		$user_query["id"] = $this->session->userdata('uid');
		$user_query_update["password"] = md5($this->input->post('new_password'));
		if(strlen($this->input->post('new_password')) > 0){
			//password is not empty
			$this->user_lib->update_user($user_query,$user_query_update);
		}
		redirect(base_url()."index.php/user_c/show_edit_panel_page");
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user_c.php
	 * @DATE:Jun 10, 2011
	 * @AUTHOR: SUNGJUN MA
	 * @CONTACT: firegun17@gmail.com
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	function check_password() {
		$user_query["id"] = $this->session->userdata('uid');
		$user_query['password'] = hash('md5',$this->input->post('password'));
		if(($query = $this->user_lib->query_user($user_query))&&$query->num_rows()==1){
			echo "1";
		}else
			echo "2";
	}

	
	
	//******************added by yuan ye
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: user.php
	 * @DATE:07-25 2011
	 * @AUTHOR: Ye Yuan
	 * @CONTACT: win_g_ren@hotmail.com
	 * @FUNCTION DESCRIPTION: registering process and return user id in the database
	*/
	public function register() {
		$user_email = $this->input->post("email");
		$user_password = md5($this->input->post('password'));
		$user_reg_ip = ip2long($this->input->ip_address());
		
		$re = $this->user_lib->save_reg_userInfo($user_email,$user_password,$user_reg_ip);
		
		if($re===false){
			//set mc error
		}
		/*if(!$this->email_lib->send_active_email($user_email)){
			//send mail error
		}*/
		$uid = $this->user_lib->active_process($user_email);
		if($uid===false){
			return false;		//for active error
		}
	//	$this->_set_login_cookie($uid);
		redirect('/regsuccess'); 
	}
	
	public function active(){
		$user_email = htmlspecialchars($this->input->get('email'));
		if(!$this->email_lib->check_email($user_email)){
			//email format error
		}
		$active_key = htmlspecialchars($this->input->get('key'));
		//get memcached for check active process
		
		$uid = $this->user_lib->active_process($user_email,$active_key);
		if($uid===false){
			return false;		//for active error
		}
		
		//if($this->_set_login_cookie($uid)){
			//parse and redirect to the user base info input page
			redirect(base_url().'index.php/user_c/show_register_complete_page'); 
	//	}else{
			
	//	}
	}
	
	
		
	
	

	public function get_user_base_info(){
		$user_id = $this->session->userdata('uid');
		$base_info=$this->user_lib->get_user_base_info($user_id);
		if($base_info){
			$str=json_encode($base_info);
			return $str;
		}else{
			//system error
		}
	}
	
	
	
	private function _store_images($image_obj) {
		//$large = $this->input->post('large');
		//$large_obj = json_decode($large);
		$file_extention = end(explode('.',($image_obj->{"image_name"})));
		if(is_file($this->session->userdata('large_image_path')))       unlink($this->session->userdata('large_image_path'));
		if(is_file($this->session->userdata('medium_image_path')))      unlink($this->session->userdata('medium_image_path'));
		if(is_file($this->session->userdata('small_image_path')))       unlink($this->session->userdata('small_image_path'));
		//You can alter these options, for large image
		$upload_dir = "/includes/upload";                               // The directory for the images to be saved in  
		$upload_path = $upload_dir."/";                         // The path to where the image will be saved
		$large_image_name = basename($image_obj->{"image_name"});               // New name of the large image
		$thumb_image_name = uniqid().basename($large_obj->{"image_name"},$file_extention).$file_extention;
		$max_file = "524288";                                           // 512 KB
		$max_width = "120";                                                     // Max width allowed for the large image
		//Image Locations
		$large_image_location = ".".$upload_path.$large_image_name;
		$thumb_image_location = ".".$upload_path.$thumb_image_name;
		//Create the upload directory with the right permissions if it doesn't exist
		if(!is_dir(".".$upload_dir)){
			mkdir(".".$upload_dir, 0777);
			chmod(".".$upload_dir, 0777);
		}
		/********** start of large image**********/
		$thumb_image_file_name = $thumb_image_name;// New name of the thumbnail image
		//Get the new coordinates to crop the image.
		$start_width = $large_obj->{"x1"};
		$start_height = $large_obj->{"y1"};
		$width = $large_obj->{"w_image"};
		$height = $large_obj->{"w_image"};
		$thumb_image_name = $thumb_image_location;
		$image = $large_image_location;
		$newImageWidth = ceil($width);
		$newImageHeight = ceil($height);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$source = imagecreatefromjpeg($image);
		$source = imagecreatefromjpeg($image);
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		imagejpeg($newImage,$thumb_image_name,90);
		chmod($thumb_image_name, 0777);
		$session_data["large_image_path"] = $thumb_image_name;
		/*****end of large image****/
		//unlink($large_image_location);//delete
		$session_data["original_image_path"] = $large_image_location;
		/****start of middle image resizeing***/
		$newImageResized = $upload_path.uniqid().basename($large_obj->{"image_name"},$file_extention).$file_extention;
		$this->_resizeThumbnailImage(".".$newImageResized,$thumb_image_location,57,57,120,120,1);
		$session_data["medium_image_path"] = ".".$newImageResized;
		/*****start of small size image resizeing****/
		$newImageResized = $upload_path.uniqid().basename($large_obj->{"image_name"},$file_extention).$file_extention;
		$this->_resizeThumbnailImage(".".$newImageResized,$thumb_image_location,38,38,120,120,1);
		$session_data["small_image_path"] = ".".$newImageResized;
		/****destroy image****/
		$this->session->set_userdata($session_data); 
		//echo $newImageResized;
		if($this->_move_pic_to_user_folder($session_data)){
			return true;
		}else{
			return false;
		}
		//echo "done";
	}
	
	private function _move_pic_to_user_folder($image_info) {
		$uid = $this->session->userdata('uid');
		/*if(($query = $this->user_lib->query_user($user_data))&&$query->num_rows()==1){
			foreach($query->result() as $row){
				$email = $row->email;
			}
		}*/
		if(isset($uid)){
			$user_folder=md5($uid);
			$user_tmp_file_folder = "/includes/upload/";
			$user_final_file_foler = "/includes/user_upload/";
	        if(!is_dir(".".$user_final_file_foler.$user_folder."/img/")){
	        	mkdir(".".$user_final_file_foler.$user_folder."/img/",0777,true);
	        }
	        $handle=opendir(".".$user_final_file_foler.$user_folder."/img/"."."); 
			while (false !== ($file = readdir($handle))){
				if ($file != "." && $file != "..") {
					//echo $file;
					unlink(".".$user_final_file_foler.$user_folder."/img/".$file);
				}
			}
			closedir($handle); 
	        //create small image
	        $user_image_file = basename($image_info['small_image_path']);
			$target_path = $user_final_file_foler.$user_folder."/img/".$user_image_file;
			$user_img_data["user_small_image"] = $this->config->item('base_url').$target_path;
			rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
	        
	        //create medium image $this->session->userdata('medium_image_path')
	        $user_image_file = basename($image_info['medium_image_path']);
			$target_path = $user_final_file_foler.$user_folder."/img/".$user_image_file;
			$user_img_data["user_medium_image"] = $this->config->item('base_url').$target_path; 
			rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
	        //create large image $this->session->userdata('large_image_path')
	       $user_image_file = basename($image_info['large_image_path']);
			$target_path = $user_final_file_foler.$user_folder."/img/".$user_image_file;
			$user_img_data["user_large_image"] = $this->config->item('base_url').$target_path;
			rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
	        
	        //create original image
	       $user_image_file = basename($image_info['original_image_path']);
			$target_path = $user_final_file_foler.$user_folder."/img/".$user_image_file;
			$user_img_data["user_original_image"] = $this->config->item('base_url').$target_path;  
			rename(".".$user_tmp_file_folder.$user_image_file,".".$target_path);
			
			$user_img_where["user_id"] = $uid; 
			$this->user_lib->update_images($user_img_where,$user_img_data);
			return true;
		}else{
			return false;
		}
	}
	
/*	private function _set_login_cookie($uid){
		$session_data["user_id"] = $uid;
		$this->session->set_userdata($session_data);
   		$key = uniqid();
   		$this->user_autologin->purge($uid);
   		if ($this->user_autologin->set($uid, md5($key))){
   			set_cookie(array(
   			'name' => $this->config->item('autologin_cookie_name'),
   			'value' => serialize(array('user_id' => $uid, 'key' => $key)),
   			'expire' => $this->config->item('autologin_cookie_life'),
   			'path' => '/',
   			));
   			return true;
   		}else{
   			return false;
   		}
	}*/

}