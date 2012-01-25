<?php

class Recommend_lib {

	private $user_recomm_mc;
	
	function __construct(){
		$this->ci =& get_instance();
		//parent::__construct();
		$this->ci->load->library('user_lib');
		$this->ci->load->library('topic_lib');
		$this->ci->load->library('relation_lib');
		$this->ci->load->model('recommend_dao');
		//$mc_keys_prefix = $this->config->item('mc_prefix');
		//$this->user_recomm_mc = $mc_keys_prefix['user_recomm'];
	}
	
	public function get_user_recommend($user_id,$num){
		$this->ci->load->model('user_dao');
		$this->ci->load->library('relation_lib');
		//$interestId=$this->ci->user_dao->get_user_interestId($user_id);
		//$firstId=$this->user_recomm_mc.intval($interestId/100);
		//$secendId=$this->user_recomm_mc.intval(($interestId%100)/10);
		//$thirdId=$this->user_recomm_mc.intval($interestId%10);
		//$keys=array_unique(array($firstId,$secendId,$thirdId));
		//$interestArray=$this->ci->memcached_lib->getMultiMC('default',$keys);
		$result_uids=array();
		$rest_num=$num;
		//foreach($interestArray as $uidsArray){
		//	$unrelated_users=$this->ci->relation_lib->get_unrelated_user($user_id,$uidsArray);
		//	if(($n=count($unrelated_users))<$rest_num){
		//		$rest_num=$rest_num-$n;
		//		$result_uids=array_merge($result_uids,$unrelated_users);
		//	}else{
		//		$rest_num=0;
		//		$uids=array_rand($unrelated_users,$rest_num);
		//		$result_uids=array_merge($result_uids,$uids);
		//		break;
		//	}
		//}
		$result['user']=array();
		if($rest_num===0){
			foreach ($result_uids as $uid){
				$user_info=$this->user_lib->get_user_base_info(array('uid'=>$uid));
				$result['user'][$uid]=$user_info;
			}
			return $result;
		}
		$follow_array = $this->ci->user_dao->get_user_by_follow();
		if($follow_array==false){
			return false;
		}
		$unrelated_users = $this->ci->relation_lib->get_unrelated_user($user_id,$follow_array);
		if(count($unrelated_users)<$rest_num){
			//$rest_num=$rest_num-$n;
			$result_uids=array_merge($result_uids,$unrelated_users);
		}else{
			$uids=array_rand($unrelated_users,$rest_num);
			$result_uids=array_merge($result_uids,$uids);
		}
		foreach ($result_uids as $uid){
				$user_info=$this->ci->user_lib->get_user_base_info(array('uid'=>$uid));
				$result['user'][$uid]=$user_info;
		}
		return $result;
		/*$interestUids=$this->ci->memcached_lib->getMC('default',$firstId);
		if(count(array_unique($interestUids))<=50){
			$unrelated_users=$this->ci->user_lib->get_unrelated_user($user_id,$interestUids);
			$recom_num=count($unrelated_users);
			if($recom_num>=10){
				$final_user=array_rand($unrelated_users,10);
				foreach ($final_user as $uid){
					$user_info=$this->ci->user_lib->get_user_base_info($uid);
					$final_user_info[$uid]=$user_info;
				}
				return $final_user_info;
			}else{
				foreach ($unrelated_users as $uid){
					$user_info=$this->ci->user_lib->get_user_base_info($uid);
					$final_user_info[$uid]=$user_info;
				}
				$rest_num=10-$recom_num;
			}
		}
		$rand_array=array_rand($interestUids,50);*/
		
	}
	
	public function get_topic_recommend($user_id,$num){
		$this->ci->load->model('topic_dao');
		$follow_array = $this->ci->topic_dao->get_topic_by_follow();
		if($follow_array==false){
			return false;
		}
		$unrelated_topics = $this->ci->relation_lib->get_unrelated_topic($user_id,$follow_array);
		if(count($unrelated_topics)>$num){
			$topics=array_rand($unrelated_topics,$num);
		}else{
			$topics=$unrelated_topics;
		}
		if(empty($topics)){
			return $re['topic']=array();
		}
		$re=$this->ci->topic_dao->get_topics_recommend_info($topics);
		$result['topic']=$re;
		return $result;
	
	}
	
	
	public function set_user_interest_mc($user_id,$user_interestId){
		$firstId=$this->user_recomm_mc.intval($user_interestId/100);
		$secendId=$this->user_recomm_mc.intval(($user_interestId%100)/10);
		$thirdId=$this->user_recomm_mc.intval($user_interestId%10);
		$keys=array_unique(array($firstId,$secendId,$thirdId));
		//$key = $this->user_recomm_mc.".".$user_interestId;
		$interestArray=$this->ci->memcached_lib->getMultiMC('default',$keys);
		$values=array($user_id);
		if(isset($interestArray[$firstId])){
			$interestArray[$firstId][]=$user_id;
			$result=array_unique($interestArray[$firstId]);
			$this->ci->memcached_lib->setMC('default',$firstId,$result);
		}else{
			$this->ci->memcached_lib->addMC('default',$firstId,$values);
		}
		if(isset($interestArray[$secendId])){
			$interestArray[$secendId][]=$user_id;
			$result=array_unique($interestArray[$secendId]);
			$this->ci->memcached_lib->setMC('default',$secendId,$result);
		}else{
			$this->ci->memcached_lib->addMC('default',$secendId,$values);
		}
		if(isset($interestArray[$thirdId])){
			$interestArray[$thirdId][]=$user_id;
			$result=array_unique($interestArray[$thirdId]);
			$this->ci->memcached_lib->setMC('default',$thirdId,$result);
		}else{
			$this->ci->memcached_lib->addMC('default',$thirdId,$values);
		}
		return true;
				
	}
	
	public function topic_page_recomm($uid,$tid){
		$this->ci->load->library('relation_lib');
		$result=array();
		$user_followers=$this->ci->relation_lib->get_user_followers($uid);
		$topic_fans=$this->ci->relation_lib->get_topic_fans($tid);
		$intersect_users=array_intersect($user_followers,$topic_fans);
		if(count($intersect_users)>3){
			$recom_users=array_rand($intersect_users,3);
		}else{
			$recom_users=$intersect_users;
		}
		$recom_users_info=$this->ci->user_lib->get_users_base_info($recom_users);
		if($recom_users_info==false){return false;}//by bosai
		foreach ($recom_users_info as $uid =>$info){
			$recom_users_info[$uid]['interest']=$this->_decode_interestId($info['interestId']);
			unset($recom_users_info[$uid]['interestId']);
		}
		$result['recom_user']=$recom_users_info;
		return $result;
	}

/*	private function _decode_interestId($interestId){
		$first=intval($interestId/100);
		$second=intval(($interestId%100)/10);
		$third=intval($interestId%10);
		$result=array();
		$result[0]=array('id'=>$first);
		$result[1]=array('id'=>$second);
		$result[2]=array('id'=>$third);
		return $result;
	}*/
	
}
?>