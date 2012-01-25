<?php
/**
*  @FILE_NAME : public_dao.php
*  @APPLICATION :  www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: May 24, 2011
*  @AUTHOR: Bosai Chen
*  @CONTACT: bchen04@syr.edu
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
* ver 1.0 : May 24, 2011
* - first release
*/
class public_dao extends CI_Model
{
	private $public_notizen_table			= 'public_notizen';			// public notizen table 
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: public_dao.php
	 * @DATE:May 24, 2011
	 * @AUTHOR: BOSAI CHEN
	 * @CONTACT: bchen04@syr.edu
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	function function_name($param) {
		parent::__construct();
		$ci =& get_instance();
		$this->public_notizen_table = $ci->config->item('db_table_prefix', 'MY_config').$this->public_notizen_table;
		date_default_timezone_set('America/New_York');
	}
	


	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: public_dao.php
	 * @DATE:May 29, 2011
	 * @AUTHOR: BOSAI CHEN
	 * @CONTACT: bchen04@syr.edu
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	function get_public_notizen() {
		$this->db->select('content,start_time');
		$this->db->order_by("start_time", "desc"); 
		$query = $this->db->get($this->public_notizen_table);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return NULL;
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: public_dao.php
	 * @DATE:May 24, 2011
	 * @AUTHOR: BOSAI CHEN
	 * @CONTACT: bchen04@syr.edu
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	
	function get_latest_public_notizen() {
		$query_array = $this->get_public_notizen();
		if ($query_array != NULL)
		{
			return $query_array[0];
		}
		return NULL;
	}
	*/
	
	
}