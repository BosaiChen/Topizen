<?php

class recommend_dao extends CI_Model{
	private $user_interest_table = '';	
	private $topic_interest_table = '';
	private $followed_num_table ='followed_num';
	
	
	public function insert_user_interest($interest_info){
		if($this->db->insert($this->user_interest_table, $interest_info)){
			return true;	
		}else{
			return false;
		}		
	}
	
}
	
?>