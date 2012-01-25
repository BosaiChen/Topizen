<?php
/**
*  @FILE_NAME : UserDAO.php
*  @APPLICATION : www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: May 3, 2011
*  @AUTHOR: Sungjun Ma
*  @CONTACT: firegun17@gmail.com
*  @BRIEF_FILE_DESCRIPTION: User Data Access Object
*
* Module Operations:
* ==================
* This module implements User Data Access Object
*
* Public Interface Usage:
* =================
*
* Maintenance History:
* ====================
* ver 1.0 : May 3, 2011
* - first release
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_lib{
	
	private $user_base_mc;
	private $user_active_mc;
	
	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('user_dao');
		$this->ci->load->library('topic_lib');
		$this->ci->load->library('utility_lib');
		$mc_keys_prefix = $this->ci->config->item('mc_prefix');
		$this->user_base_mc = $mc_keys_prefix['user_base_info'];
		$this->user_active_mc = $mc_keys_prefix['user_active'];
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: topic.php
	 * @DATE:Sep 1, 2011
	 * @AUTHOR: Ye Yuan (Modified by Bosai Chen)
	 * @CONTACT: bchen04@syr.edu
	 * @PARAM1:user's login email
	 * @PARAM2:user's login password
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: Check user's account status.
	 * 	status code: -1 for 'user not exist'
	 * 				 -2 for 'Password dismatch'
	 * 				 -3 for 'not activated via email link'
	 * 				 1  for 'alread activated,personal profile not filled'
	 * 				 2  for 'no problem, succefully log in'
	*/
	public function login($user_email,$user_pwd,$remember){
		if((!empty($user_email)) AND (!empty($user_pwd))){
			$query=$this->ci->user_dao->get_login_info($user_email);
			if($query->num_rows()==0){ // fail  -- user not exist
				$result['no']=-1;
				$result['msg']='User not exist';
				return $result;
			}else{
				foreach ($query->result() as $row){
					$uid=$row->uid;
					$pwd=$row->pwd;
					$active=$row->active;
					if($pwd==$user_pwd){ //fail - password not match
						$sess_data=array(
							'uid'=>$uid,
							'pwd'=>$pwd,
							'active'=>$active,
							'public_topic_start'=>$this->ci->config->item('topic_list_more'),//start of every load
							'public_topic_num'=>$this->ci->config->item('topic_list_more'),
							'public_voting_topic_start'=>$this->ci->config->item('voting_topic_list_more'),//start of every load
							'public_voting_topic_num'=>$this->ci->config->item('voting_topic_list_more')
						);
						if($active==0){ // fail -- not activated
							$result['no']=-3;
							$result['msg']='redirect to active info page';
						}elseif($active==1){ // success, but need to fill profile before login
							$result['no']=1;
							$result['msg']='redirect to base info page';
							$result['uid']=$uid;
							$this->ci->session->set_userdata($sess_data);
						}elseif($active==2){// success, login 
							if($remember){ //set cookie for autologin
								$this->ci->load->helper('cookie');
								set_cookie(array(
									'name' 		=> $this->ci->config->item('autologin_cookie_name'),
									'value'		=> serialize(array('uid' => $uid)),
									'expire'	=> $this->ci->config->item('autologin_cookie_life'),
									'path'      =>  '/',
								));
							}
							$result['no']=2;
							$result['msg']='login success';
							$result['uid']=$uid;
							$base_info = $this->get_user_base_info(array('uid'=>$uid));
							$sess_data['domain']=$base_info['domain'];
							$this->ci->session->set_userdata($sess_data);
						}else{
							return false;
						}
					}else{
						$result['no']=-2;
						$result['msg']='Password error';
					}
					return $result;
				}
			}
		}
	}
	
//******** add by yuanye
	
	public function save_reg_userInfo($user_email,$user_password,$user_reg_ip,$reg_source=0){
		$uid=$this->ci->user_dao->init_user_base_info();
		if($uid===false){
			return false;
		}
		$login_info['email'] = $user_email;
		$login_info['pwd'] = $user_password;
		$login_info['uid'] = $uid;
		$login_info['active'] = 0;
		$ext_info['uid'] = $uid;
		$ext_info['reg_time'] = date('Y-m-d H:i:s');
		$ext_info['reg_ip'] = $user_reg_ip;
		$ext_info['reg_source'] = $reg_source;				//0 for web reg
		if($this->ci->user_dao->insert_reg_info($login_info,$ext_info)){
			return true;
		}else{
			return false;
		}
	}
	
	
	
	public function set_user_base_info($arg){
		$base_info['uid']=$arg['uid'];
		$base_info['desc']=$arg['desc'];
		$base_info['fullname']=$arg['fullname'];
		$base_info['domain']=$arg['domain'];
		$base_info['interestId']=$arg['u_interestId'];
		$base_info['active']=2;
		$login_info['uid']=$arg['uid'];
		$login_info['active']=2;
		if($this->ci->user_dao->update_base_info($base_info) && $this->ci->user_dao->update_login_info($login_info)){		
			//if($this->user_base_info_to_mc($uid)){
				return true;
			//}else{
			//	return false;
			//}
		}else{
			return false;
		}
	}
	
	public function active_process($user_email,$active_key=0){
		$query=$this->ci->user_dao->get_login_info($user_email);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$uid = $row->uid;
			$active = $row->active;
		}
		if($active != 0) {
			return false;
		}
		//
		//$key=$this->user_active_mc.".".$user_email;
		//$active_value=$this->ci->memcached_lib->getMC('default',$key);
		//if($active_value==$active_key){
			if($this->ci->user_dao->active_user($user_email,$uid)){
				//$this->ci->memcached_lib->deleteMC('default',$key);
				return $uid;
			}else{
				return false;
			}
		//}else{
			
		//}
	}
	
	
	
	
	public function get_user_base_info($info){
		//$key=$this->user_base_mc.".".$uid;
		//$user_info=$this->ci->memcached_lib->getMC('default',$key);
		//if($user_info===false || !is_array($user_info)){
			$user_info=$this->user_base_info_to_mc($info);
		//}
		return $user_info;
	}
	
	public function check_user_exist($info){ //by bosai
		$query=$this->ci->user_dao->get_user_base_info($info);
		if($query->num_rows()==0){
			return false;
		}else{
			foreach($query->result() as $row){
				$uid = $row->uid;
			}
			return $uid;
		}
	}
	
	
	private function user_base_info_to_mc($info){
		$query=$this->ci->user_dao->get_user_base_info($info);
		if($query->num_rows()==0){
			return false;
		}
		foreach ($query->result() as $row){
			$user_info['uid'] = $row->uid;
			$user_info['desc'] = $row->desc;
			$user_info['image'] = $row->image;
			$user_info['interestId']  = $row->interestId;
			$user_info['interests']  = $this->ci->utility_lib->decode_interests($row->interestId);
			$user_info['fullname'] = $row->fullname;
			$user_info['domain'] = $row->domain;
			$user_info['active'] = $row->active;
		}
		/*$query=$this->ci->user_dao->get_user_image_info($uid);
		if(!$query){
			return false;
		}		
		foreach ($query->result() as $row){
			$user_info['user_small_image'] = $row->user_small_image;
			$user_info['user_medium_image']  = $row->user_medium_image;
			$user_info['user_large_image'] = $row->user_large_image;
			$user_info['user_original_image'] = $row->user_original_image;
		}*/
		//$key=$this->user_base_mc.".".$uid;
		//$this->ci->memcached_lib->setMC('default',$key,$user_info);
		return $user_info;
	}

	
	
	public function get_personal_page_info($uid){
		//get user_base_info
		$user_base_info=$this->get_user_base_info(array('uid'=>$uid));
	
		$user_info['uid']=$uid;
		$user_info['fullname']=$user_base_info['fullname'];
		$user_info['desc']=$user_base_info['desc'];
		$user_info['image']=$user_base_info['image'];
		$user_info['interest']=$this->_decode_interestId($user_base_info['interestId']);
		//get crazy_topic_info
		
		$tid=$this->get_crazy_topic($uid);
		$user_info['crazy_tid']=$tid;
		if($tid!=0){
			$crazy_topic_info=$this->ci->topic_lib->get_crazy_topic_info($tid);
			$user_info['crazy_title']=$crazy_topic_info['title'];
			$user_info['has_crazy_topic'] = true;
		}else{
			$user_info['has_crazy_topic'] = false;
		}
		//get count info
		$this->ci->load->library('relation_lib');
		$user_info['count']=$this->ci->relation_lib->get_user_count($uid);
		return $user_info;
	}

	
	
	public function get_crazy_topic($uid){
		return $this->ci->user_dao->get_crazy_topic($uid);
	}
	
	public function get_top_user($uid,$num=10){
		$this->ci->load->library('relation_lib');
		$uids=$this->ci->user_dao->get_user_by_follow();
		$unrelated_users = $this->ci->relation_lib->get_unrelated_user($uid,$uids);
		if(count($unrelated_users) >$num){
			$re_uids=array_rand($unrelated_users,$num);
		}else{
			$re_uids=$unrelated_users;
		}
		$re=$this->ci->user_dao->get_users_base_info($re_uids);
		if($re==false){
			return false;
		}else{
			return $re;
		}
	}
	
	
	private function _decode_interestId($interestId){
		$first=intval($interestId/100);
		$second=intval(($interestId%100)/10);
		$third=intval($interestId%10);
		$result=array();
		$result[0]=array('id'=>$first);
		$result[1]=array('id'=>$second);
		$result[2]=array('id'=>$third);
		return $result;
	}
	
	public function match_password($uid,$pwd){//by bosai
		if(md5($pwd) == $this->ci->user_dao->get_user_password($uid)){
			return true;
		}else{
			return false;
		}
	}
	
	public function update_password($uid,$pwd){
		$login_info=array(
			'uid'=>$uid,
			'pwd'=>md5($pwd)
		);
		return $this->ci->user_dao->update_login_info($login_info);
	}
	
	public function update_avatar($uid,$img){//by bosai
		$base_info=array(
			'uid'=>$uid,
			'image'=>$img
		);
		return $this->ci->user_dao->update_avatar($base_info);
	}
	
	public function get_users_base_info($uids){
		return $this->ci->user_dao->get_users_base_info($uids);
	}
	
	public function is_crazy($uid,$tid){
		return $this->ci->user_dao->is_crazy($uid,$tid);
	}
	
	public function get_user_email($uid){
		$query = $this->ci->user_dao->get_login_info_by_id($uid);
		if($query->num_rows()!=1){
			return false;
		}
		foreach($query->result() as $row){
			$email = $row->email;
		}
		return $email;
	}
	
	
	public function get_user_headPic($uid){
		return $this->ci->user_dao->get_headPic($uid);
	}
	
	public function get_users_headPic($uids){
		return $this->ci->user_dao->get_headPic($uids);
	}

	public function get_user_post_num($uid){
		return $this->ci->user_dao->get_user_post_num($uid);
	}
	
	public function get_user_question_num($uid){
		return $this->ci->user_dao->get_user_question_num($uid);
	}
	
	public function is_email_available($email){
		return $this->ci->user_dao->is_email_available($email);
	}
	

}
/* End of file User_lib.php */
/* Location: ./application/libraries/User_lib.php */