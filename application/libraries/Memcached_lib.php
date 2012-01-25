<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Memcached_lib{
	
	function __construct()
	{
		$this->ci =& get_instance();
		$params = array('adapter' => 'memcached');
		$this->ci->load->driver('cache', $params);
	}
	
	public function getMC($alias, $key) {		
		return $this->ci->cache->memcached->getMC($alias, $key);
	}
	
	public function getMultiMC($alias, $keys) {
		return $this->ci->cache->memcached->getMultiMC($alias, $keys);
	}
	
	public function setMC($alias, $key, $value, $expiration = 0) {
		if(($re=$this->ci->cache->memcached->setMC($alias, $key, $value, $expiration))==false){
			return $this->ci->cache->memcached->setMC($alias, $key, $value, $expiration);
		}
		return $re;
	}
	
	public function setMultiMC($alias, $items, $expiration = 0) {
		return $this->ci->cache->memcached->setMultiMC($alias, $items, $expiration);
	}
	
	public function addMC($alias, $key, $value, $expiration = 0) {
		return $this->ci->cache->memcached->addMC($alias, $key, $value, $expiration);
	}
	
	public function deleteMC($alias, $key) {
		return $this->ci->cache->memcached->deleteMC($alias, $key) ;
	}
}
/* End of file User_lib.php */
/* Location: ./application/libraries/User_lib.php */