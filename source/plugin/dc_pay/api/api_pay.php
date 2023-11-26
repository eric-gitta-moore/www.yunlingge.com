<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
C::import('api/paybase','plugin/dc_pay',false);
class api_pay extends api_paybase{
	protected $_lang = array();
	protected $_args = array();
	public function __construct(){
		$this->_lang = @include DISCUZ_ROOT.'./source/plugin/dc_pay/language/'.$this->getextend().'.'.currentlang().'.php';
		if(empty($this->_lang))$this->_lang = @include DISCUZ_ROOT.'./source/plugin/dc_pay/language/'.$this->getextend().'.php';
	}
	public function setorder($orderid, $price, $subject, $body, $showurl){}
	public function create_payurl(){}
	public function getpayinfo(){}
	public function notifycheck(){}
}
?>