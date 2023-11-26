<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
class vip_install extends extend_install{
	public function __construct(){
		$this->identify = 'dc_vip';
		parent::__construct();
		$this->title=$this->_lang['mall_title'];
		$this->des=$this->_lang['mall_des'];
		$this->author=$this->_lang['mall_author'];
		$this->version='v1.0.1';
		$this->data=array();
	}
	public function install(){
		return true;
	}
	
	public function uninstall(){
		return true;
	}
	
	public function upgrade($version){
		return true;
	}
}
?>