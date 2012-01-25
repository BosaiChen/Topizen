<?php
class Post_lib
{

	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->model('post_dao');
		$this->ci->load->model('topic_dao');
		$this->ci->load->library('user_lib');
		$this->ci->load->library('utility_lib');
		$this->ci->load->library('topic_lib');
		date_default_timezone_set('America/New_York');
	}

	
	//add by yuanye
	
	public function addPost($uid,$tid,$pid,$post_content,$post_title,$post_type){
		if(!$this->ci->topic_lib->check_final_topic_exist($tid)){
			$result['no']=-2;
			$result['msg']='topic not exist';
			return $result;
		}
		$re = $this->ci->post_dao->add_post($uid,$tid,$pid,$post_content,$post_title,$post_type);
		
		if($re==false){
			$result['no']=-1;
			$result['msg']='system error';
		}else{
			$result['no']=1;
			$result['msg']='success';
		}
		return $result;
	}
	
	public function get_topic_posts($tid,$post_type){
		$post_query['tid']=$tid;
		$post_query['type']=$post_type;
		$result = $this->ci->post_dao->get_posts($post_query);
		if($result==null){
			return array();
		}
		//append author avatar
		foreach ($result as $key=>$row){
			//TODO: needs to be improved
			$result[$key]['author_img']='/includes/images/default_medium.png';
		}
		//append post num
		foreach ($result as $key=>$row){
			//TODO: needs to be improved
			$post_num = $this->ci->post_dao->get_post_num($row['pid']);
			if($post_num!=null){
				$result[$key]['num']=$post_num;
			}else{
				return array();
			}
		}
		//return posts info
		return $result;
	}
	
	public function get_single_post($pid){
		$post_query['pid']=$pid;
		$result = $this->ci->post_dao->get_posts($post_query);
		if($result==null){
			return array();
		}
		//append author avatar
		foreach ($result as $key=>$row){
			//TODO: needs to be improved
			$result[$key]['author_img']='/includes/images/default_medium.png';
		}
		//append post num
		foreach ($result as $key=>$row){
			//TODO: needs to be improved
			$post_num = $this->ci->post_dao->get_post_num($row['pid']);
			if($post_num!=null){
				$result[$key]['num']=$post_num;
			}else{
				return array();
			}
		}
		//return posts info
		return $result;
	}
	
	public function attitude_post($uid,$pid,$tid,$flag){
		$this->ci->load->library('relation_lib');
		if(!$this->ci->relation_lib->is_follow_topic($uid,$tid)){
			return false;
		}
		if($flag==1){
			return $this->ci->post_dao->like_post($uid,$pid);
		}elseif($flag==-1){
			return $this->ci->post_dao->unlike_post($uid,$pid);
		}else{
			return false;
		}
	}
/*	
	public function get_post_page_info($pid,$uid){
		$result=array();
		$post_info=$this->ci->post_dao->get_post_info($pid);
		if($post_info==false){
			return false;
		}
		$result['post_title']=$post_info['title'];
		$result['post_time']=$post_info['time'];
		$result['post_content']=$post_info['content'];
		$topic_info=$this->ci->topic_dao->get_topic_info($post_info['tid']);
		if($topic_info==false){
			return false;
		}
		$result['topic_title']=$topic_info['title'];
		$authorUid=$post_info['uid'];
		$users_info=$this->ci->user_lib->get_users_base_info(array($authorUid));
		if($users_info==false){
			return false;
		}
		$author_info=$users_info[$post_info['uid']];
		$head_pic=$this->ci->user_lib->get_user_headPic($authorUid);
		if($head_pic==false){
			return false;
		}
		$author_info['head_pic']=$head_pic;	
		$author_info['interest']=$this->_decode_interestId($authorUid);
		unset($author_info['interestId']);
		$author_info['post_num']=$this->ci->user_lib->get_user_post_num($authorUid);
		if($author_info['post_num']==false){
			return false;
		}
		$author_info['question_num']=$this->ci->user_lib->get_user_question_num($authorUid);
		if($author_info['question_num']==false){
			return false;
		}
		$is_follow=$this->ci->relation_lib->is_follow_user($uid,$authorUid);
		$author_info['is_follow']=$is_follow;
		$result['author_info']=$author_info;
		if($uid==$authorUid){
			$result['is_author']=true;
		}else{
			$result['is_author']=false;
		}
		$repost_info=$this->ci->post_dao->get_repost_info($pid);
		if($repost_info==false){
			return false;
		}
		if(!empty($repost_info)){
			$repost_uids=array();
			$repost_id=array();
			foreach ($repost_info as $repost){
				$repost_uids[]=$repost['uid'];
				$repost_id[]=$repost['rpid'];
			}
			$repost_users_info=$this->ci->user_lib->get_users_base_info($repost_uids);
			$repost_users_head_info=$this->ci->user_lib->get_users_headPic($repost_uids);
			$repost_users=array_merge($repost_users_info,$repost_users_head_info);
			$repost_num=$this->ci->post_dao->get_repost_num($repost_id);
			foreach ($repost_num as $rpid=>$num){
				$repost_info[$rpid]['like']=$num;
			}
			$popular_repost=key(array_shift(arsort($repost_num)));
			$result['repost_info']=$repost_info;
			$result['repost_user_info']=$repost_users;
			$result['popular_repost']=$popular_repost;
		}else{
			$result['repost_info']=array();
			$result['repost_user_info']=array();
			$result['popular_repost']=array();
		}
		return $result;
		
	}
	*/
	
	public function check_post_exist($pid){
		$re=$this->ci->post_dao->get_post_info($pid);
		return $re==false?false:true;
	}
	
	public function create_repost($pid,$uid,$content){
		if(!$this->check_post_exist($pid)){
			$result['no']=-2;
			$result['msg']='post not exist';
			return $result;
		}
		$this->ci->load->library('generater_lib');
		$rpid = $this->ci->generater_lib->id_generater('repost');
		if($rpid==false){
			return false;
		}
		$re=$this->ci->post_dao->create_repost($rpid,$pid,$uid,$content);
		if($re==false){
			$result['no']=-1;
			$result['msg']='system error';
		}else{
			$result['no']=1;
			$result['msg']='success';
		}
		return $result;
	}
	
	public function get_reposts_by_pid($pid){
		$repost_query['pid']=$pid;
		$result = $this->ci->post_dao->get_repost_info($repost_query);
		if($result==null){
			return array();
		}
		//append author avatar
		foreach ($result as $key=>$row){
			//TODO: needs to be improved
			$result[$key]['author_img']='/includes/images/default_medium.png';
		}
		//append post num
		foreach ($result as $key=>$row){
			//TODO: needs to be improved
			$repost_num = $this->ci->post_dao->get_repost_num($row['rpid']);
			if($repost_num!=null){
				$result[$key]['num']=$repost_num;
			}else{
				return array();
			}
		}
		//return posts info
		return $result;
	}
	
	public function attitude_repost($uid,$rpid,$pid,$flag){
		$post_info=$this->ci->post_dao->get_post_info($pid);
		$this->ci->load->library('relation_lib');
		if(!$this->ci->relation_lib->is_follow_topic($uid,$post_info['tid'])){
			return false;
		}
		if($flag==1){
			return $this->ci->post_dao->like_repost($uid,$rpid);
		}else{
			return false;
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
	
	
}