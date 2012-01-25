<?php
/**
*  @FILE_NAME : utility_lib.php
*  @APPLICATION :  www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: Jun 2, 2011
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
* ver 1.0 : Jun 2, 2011
* - first release
*/
class Utility_lib
{

	function __construct(){
		
	}
	
	/*  
	 * @ACCESS:PUBLIC
	 * @FILE: utility_lib.php
	 * @DATE:Jun 2, 2011
	 * @AUTHOR: BOSAI CHEN
	 * @CONTACT: bchen04@syr.edu
	 * @PARAM1:
	 * @PARAM2:
	 * @RETURN: int/bool/object/array
	 * @FUNCTION DESCRIPTION: BLAH BLAH..
	*/
	 function datetime_2_unit($time) {
		$year = floor($time / 60 / 60 / 24 / 365);
		$time -= $year * 60 * 60 * 24 * 365;
		$month = floor($time / 60 / 60 / 24 / 30);
		$time -= $month * 60 * 60 * 24 * 30;
		$week = floor($time / 60 / 60 / 24 / 7);
		$time -= $week * 60 * 60 * 24 * 7;
		$day = floor($time / 60 / 60 / 24);
		$time -= $day * 60 * 60 * 24;
		$hour = floor($time / 60 / 60);
		$time -= $hour * 60 * 60;
		$minute = floor($time / 60);
		$time -= $minute * 60;
		$second = $time;
		$elapse = '';
		$unitArr = array(' year' =>'year', ' month'=>'month', ' week'=>'week', ' day'=>'day'
		,' hour'=>'hour', ' minute'=>'minute', ' second'=>'second');
		
		foreach($unitArr as $cn => $u ){
			if ( $$u > 0 ){
				$elapse = $$u . $cn;
				break;
			}else{
				$elapse = '0 seconds';  //return "0 seconds" when $time value is zero
			}
		}
		return $elapse;
	}
	
	//add by yuanye
	public function decode_interestId($interestId){
		$first=intval($interestId/100);
		$second=intval(($interestId%100)/10);
		$third=intval($interestId%10);
		$result=array();
		$result[0]=array('id'=>$first);
		$result[1]=array('id'=>$second);
		$result[2]=array('id'=>$third);
		return $result;
	}
	
	public function decode_interests($interestId){
		$interests = $this->decode_interestId($interestId);
		if(!is_array($interests)){
			return false;
		}
		foreach($interests as  $key =>$row){
			switch($row['id']){
				case 0:$interests[$key]['name']='Business';break;
				case 1:$interests[$key]['name']='Education';break;
				case 2:$interests[$key]['name']='Technology';break;
				case 3:$interests[$key]['name']='Sports';break;
				case 4:$interests[$key]['name']='Politics';break;
				case 5:$interests[$key]['name']='Culture';break;
				case 6:$interests[$key]['name']='Arts';break;
				case 7:$interests[$key]['name']='Media';break;
				case 8:$interests[$key]['name']='Health';break;
			}
		}
		return $interests;
	}
}