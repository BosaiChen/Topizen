<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['memcached'] = array(
	'default' => array(
		array('10.73.14.176', 11211)
	)
	//'user' => array()
);

$config['mc_prefix'] = array(
	'user_active' => '00_00_00',
	'user_base_info' => '00_01_00',
	'user_recomm' => '00_02_00',
	'user_followed_num' => '00_03_00',
	'user_following_num' => '00_04_00',
);

/* End of file memcached.php */
/* Location: ./application/config/memcached.php */