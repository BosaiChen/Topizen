<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Topic_lib
{
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->model('topic_dao');
		$this->ci->load->model('post_dao');
		$this->ci->load->model('user_dao');
		$this->ci->load->library('utility_lib');
		$this->ci->load->library('user_lib');
		date_default_timezone_set('America/New_York');
	}
	
	public function get_topic_base_info($info){//by bosai	
		$query=$this->ci->topic_dao->get_topic_base_info($info);
		if($query->num_rows()==0){
			return false;
		}
		$result=array();
		foreach ($query->result() as $row){
			$result['tid']=$row->tid;
			$result['uid']=$row->uid;
			$result['title']=$row->title;
			$result['interest']=$this->_decode_interestId($row->interestId);
			$result['chosen_date']=$row->chosen_time;
			$result['chosen_time']=$this->ci->utility_lib->datetime_2_unit(time() - strtotime($row->chosen_time));
			$result['desc']=$row->desc;
			$result['timg']=$row->bg_img;
			$result['bg_img']=$row->bg_img;
		}
		//get contributors
		$contributors=$this->ci->topic_dao->get_contributor($info['tid']);
		if($contributors!=false){
			$contri_info=$this->ci->user_lib->get_users_base_info($contributors);
			foreach ($contri_info as $uid =>$value){
				$contri_info[$uid]['interest']=$this->_decode_interestId($value['interestId']);
				unset($contri_info[$uid]['interestId']);
			}
		}else{
			$contri_info=false;
		}
		//get creator
		$creator_info=$this->ci->user_lib->get_users_base_info(array($result['uid']));
		foreach ($creator_info as $uid =>$value){
			$creator_info[$uid]['interest']=$this->_decode_interestId($value['interestId']);
			unset($creator_info[$uid]['interestId']);
		}
		$result['creator']=$creator_info;
		$result['contributor']=$contri_info;
		$topic_num=$this->ci->topic_dao->get_topic_num($info['tid']);
		$result['num']=$topic_num;
		//$re=array_merge_recursive($result,$topic_num);
		return $result;
	}
	
	
	
	
	public function get_voting_topics_by_limit($start=0,$num_of_topics=2){
		$result=$this->ci->topic_dao->get_voting_topics_by_limit($start,$num_of_topics);
		foreach($result as $row){
		//	$result['desc'] = strip_tags($row['desc']);
		}
		return $result;
	}
	
	public function get_all_topics_by_limit($start=0,$num_of_topics=2){
		$result=$this->ci->topic_dao->get_all_topics_by_limit($start,$num_of_topics);
		foreach($result as $row){
		//	$result['desc'] = strip_tags($row['desc']);
		}
		return $result;
	}
	
	
	// add by yuanye
	public function check_topic_exist($array){
		$query=$this->ci->topic_dao->get_topic_base_info($array);
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
	public function check_final_topic_exist($tid){
		$query=$this->ci->topic_dao->get_topic_base_info(array('tid'=>$tid));
		if($query->num_rows()==0){
			return false;
		}else{
			foreach ($query->result() as $row){
				$type=$row->type;
			}
			if($type==1){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	public function addTopic($uid,$tid,$topic_title,$topic_desc,$topic_interest){
		
		/*$topic_user_table['tid']=$topic_id;
		$topic_user_table['uid']=$uid;
		$topic_user_table['time']=time();
		$topic_user_table['user_type']=1;
		
		$user_topic_table['tid']=$topic_id;
		$user_topic_table['uid']=$uid;
		$user_topic_table['time']=time();
		$user_topic_table['topic_type']=1;
		*/		

		$this->ci->load->model('topic_dao');
		$topic_info=array(
			'tid'=>$tid,
			'uid'=>$uid,
			'title'=>$topic_title,
			'desc'=>$topic_desc,
			'interestId'=>$topic_interest
		);
		$re = $this->ci->topic_dao->addTopic($topic_info);
		if($re==false){
			$result['no']=-1;
			$result['msg']='system error';
		}else{
			$result['no']=1;
			$result['msg']='success';
		}
		return $result;
	}
	
	
	public function chosenTopic($tid){
		if(!$this->check_topic_exist(array('tid'=>$tid))){
			$result['no']=-2;
			$result['msg']='topic not exist';
			return $result;
		}
		
		$re = $this->ci->topic_dao->chosenTopic($tid);
		if($re==false){
			$result['no']=-1;
			$result['msg']='system error';
			
		}else{
			$query = $this->ci->topic_dao->get_topic_base_info(array('tid'=>$tid));
			foreach($query->result() as $row){
				$uid = $row->uid;
			}
			$this->ci->load->model('relation_dao');
			if(!$this->ci->relation_dao->add_follow_topic($uid,$tid,1)){
				return false;
			}
			$result['no']=1;
			$result['msg']='success';
		}
		return $result;
	}	
	
	public function voteTopic($uid,$tid){
		$this->ci->load->library('user_lib');
	
		//TODO: needs to be improved
		//	if(!$this->check_topic_exist($tid) || !$this->ci->user_lib->check_user_exist($uid)){
	//		$result['no']=-2;
	//		$result['msg']='topic or user not exist';
	//		return $result;
	//	}
		$re = $this->ci->topic_dao->voteTopic($uid,$tid);
		if($re==false){
			$result['no']=-1;
			$result['msg']='system error';
		}else{
			$result['no']=1;
			$result['msg']='success';
		}
		return $result;
	}
	
	public function get_crazy_topic_info($tid){
		return $this->ci->topic_dao->get_crazy_topic($tid);
	}
	
	public function get_new_topic($num=10){
		$topic_info=$this->ci->topic_dao->get_new_topic_info($num);
		if(empty($topic_info) || !$topic_info){
			return array();
		}
		//$tids=array();
		foreach ($topic_info as $tid=>$info){
			//$tids[]=$tid;
			$info['interest']=$this->_decode_interestId($info['interestId']);
			unset($info['interestId']);
		}
		/*$topic_num=$this->ci->topic_dao->get_topics_num($tids);
		if(empty($topic_num) || !$topic_num || count($topic_info)!=count($topic_num)){
			return array();
		}
		$re=array_merge($topic_info,$topic_num);
		if(count($re)!=count($topic_num)){
			return array();
		}else{*/
			return $topic_info;
		//}
	}
	
	
	public function get_feature_topic($uid){
		$topic_info=$this->ci->topic_dao->get_feature_topic_info();
		if(empty($topic_info) || !$topic_info){
			return array();
		}
		$tids=array();
		$this->ci->load->library('relation_lib');
		foreach ($topic_info as $tid=>$info){
			$tids[]=$tid;
			$topic_info[$tid]['relation']=$this->ci->relation_lib->is_follow_topic($uid,$tid);
			$topic_info[$tid]['interest']=$this->_decode_interestId($info['interestId']);
			unset($topic_info[$tid]['interestId']);
		}
		
		$topic_num=$this->ci->topic_dao->get_topics_num($tids);
		if(empty($topic_num) || !$topic_num || count($topic_info)!=count($topic_num)){
			return array();
		}
		
		$re=array_merge_recursive($topic_info,$topic_num);
		if(count($re)!=count($topic_num)){
			return array();
		}else{
			return $re;
		}
	}
	
	public function get_top_topic($uid,$num=10){
		$result=array();
		$this->ci->load->library('relation_lib');
		$re=$this->_get_topic_by_follow($uid,$num);
		if($re==false){
			return false;
		}else{
			$result['follow']=$re;
		}
		$re=$this->_get_topic_by_question($uid,$num);
		if($re==false){
			return false;
		}else{
			$result['question']=$re;
		}
		$re=$this->_get_topic_by_post($uid,$num);
		if($re==false){
			return false;
		}else{
			$result['post']=$re;
		}
		return $result;	
	}
	
	public function get_tab_topics($uid){//by bosai
		$topic_info=$this->ci->topic_dao->get_tab_topics_info();
		if(empty($topic_info) || !$topic_info){
			return array();
		}
		$tids=array();
		$this->ci->load->library('relation_lib');
		foreach ($topic_info as $tid=>$info){
			$tids[]=$tid;
			$topic_info[$tid]['relation']=$this->ci->relation_lib->is_follow_topic($uid,$tid);
			$topic_info[$tid]['interest']=$this->_decode_interestId($info['interestId']);
			unset($topic_info[$tid]['interestId']);
		}
		
		$topic_num=$this->ci->topic_dao->get_topics_num($tids);
		if(empty($topic_num) || !$topic_num || count($topic_info)!=count($topic_num)){
			return array();
		}
		
		$re=array_merge_recursive($topic_info,$topic_num);
		if(count($re)!=count($topic_num)){
			return array();
		}else{
			return $re;
		}
	}
	
	
	public function get_topic_info($tid){
		return $this->ci->topic_dao->get_topic_info($tid);
	}
	
	private function _get_topic_by_follow($uid,$num=10){
		$result=array();
		$follow_topic = $this->ci->topic_dao->get_topic_by_follow();
		if($follow_topic==false){
			return false;
		}
		$unrelated_topics = $this->ci->relation_lib->get_unrelated_topic($uid,$follow_topic);
		if(count($unrelated_topics)>$num){
			$topics=array_rand($unrelated_topics,$num);
		}else{
			$topics=$unrelated_topics;
		}
		if(empty($topics)){
			return $result;
		}else{
			$result=$this->ci->topic_dao->get_topics_recommend_info($topics);
			foreach ($result as $tid=>$info){
				$tids[]=$tid;
				$info['interest']=$this->_decode_interestId($info['interestId']);
				unset($info['interestId']);
			}
		}
		return $result;
	}
	
/*	private function _get_topic_by_question($uid,$num=10){
		$result=array();
		$follow_topic = $this->ci->topic_dao->get_topic_by_question();
		if($follow_topic==false){
			return false;
		}
		$unrelated_topics = $this->ci->relation_lib->get_unrelated_topic($uid,$follow_topic);
		if(count($unrelated_topics)>$num){
			$topics=array_rand($unrelated_topics,$num);
		}else{
			$topics=$unrelated_topics;
		}
		if(empty($topics)){
			return $result;
		}else{
			$result=$this->ci->topic_dao->get_topics_recommend_info($topics);
			foreach ($result as $tid=>$info){
				$tids[]=$tid;
				$info['interest']=$this->_decode_interestId($info['interestId']);
				unset($info['interestId']);
			}
		}
		return $result;
	}*/
	
	private function _get_topic_by_post($uid,$num=10){
		$result=array();
		$follow_topic = $this->ci->topic_dao->get_topic_by_post();
		if($follow_topic==false){
			return false;
		}
		$unrelated_topics = $this->ci->relation_lib->get_unrelated_topic($uid,$follow_topic);
		if(count($unrelated_topics)>$num){
			$topics=array_rand($unrelated_topics,$num);
		}else{
			$topics=$unrelated_topics;
		}
		if(empty($topics)){
			return $result;
		}else{
			$result=$this->ci->topic_dao->get_topics_recommend_info($topics);
			foreach ($result as $tid=>$info){
				$tids[]=$tid;
				$info['interest']=$this->_decode_interestId($info['interestId']);
				unset($info['interestId']);
			}
		}
		return $result;
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
	
	
}