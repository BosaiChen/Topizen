<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class generater_lib{
	private $ge_conf=array(
		'topic' => '10',
		'post' => '11',
		'question' => '12',
		'answer' => '13',
		'repost' => '14',
	);
	
	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	public function id_generater($type){
		$std_time=strtotime('2011-08-01');
		$type_id=$this->ge_conf[$type];
       $time=microtime(true);
       $timestamp=strval(floor(($time-$std_time)*1000));
       $rand_num=rand(10,99);
       $id=$type_id.$timestamp.$rand_num;
       return $id;
	}
	
	
}
?>