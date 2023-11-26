<?php
/**
 *      [Discuz!] (C)2015-2099 DARK Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: pay.lib.class.php 4042 2017-09-20 10:18:15Z wang11291895@163.com $
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class PayMent{
	protected $_plugin;
	protected $_paytype = array();
	protected $_paytypes = array();
	protected $_version = 'v1.0.9';
	protected $_orderid;
	protected $_ismobile = 0;
	public function __construct($plugin) {
		$this->PayMent($plugin);
	}
	public function PayMent($plugin){
		global $_G;
		loadcache('plugin');
		$this->_plugin = $plugin;
		if(!$_G['cache']['plugin']['dc_pay'])return;
		if(defined('IN_MOBILE')&&!$this->_ismobile)$this->_ismobile=1;
		$apichk = C::t('#dc_pay#dc_pay_api')->fetch($plugin);
		if(empty($apichk))dexit('Error:The '.$plugin.' plugin is not registered online payment service.');
		$paytypes = @include DISCUZ_ROOT.'/source/plugin/dc_pay/data/config.php';
		foreach($paytypes as $k => $p){
			if(!$this->_ismobile){
				if($p['enable'])$this->_paytypes[$k]=$p;
			}else{
				if($p['mobile']&&$p['mobileenable'])$this->_paytypes[$k]=$p;
			}
		}
	}
	public function version(){
		return $this->_version;
	}
	public function GetPayType(){
		$pt = array();
		foreach($this->_paytypes as $k=>$v)$pt[]=$k;
		return $pt;
	}
	public function GetPayInfo($pt){
		global $_G;
		$info = array();
		if($this->_paytypes[$pt]){
			$info = array(
				'title'=>$this->_paytypes[$pt]['alias']?$this->_paytypes[$pt]['alias']:$this->_paytypes[$pt]['title'],
				'logo'=>$_G['siteurl'].'source/plugin/dc_pay/api/'.$pt.'/'.$this->_paytypes[$pt]['logo'],
			);
		}
		return $info;
	}
	public function SetPayType($pt){
		if($this->_paytypes[$pt]){
			$this->_paytype[$pt] = $pt;
		}
	}
	public function SetOrder($orderid = '',$price = 0, $subject = 'test', $body = '', $showurl= '',$param = array()){
		global $_G;
		$order = array(
			'price'=>$price,
			'subject'=>$subject,
			'uid'=>$_G['uid'],
			'username'=>$_G['username'],
			'status'=>0,
			'dateline'=>TIMESTAMP,
			'plugin'=>$this->_plugin,
			'payorderid'=>'',
			'param'=>serialize($param),
		);
		$oinsert = true;
		if($orderid){
			$ord = C::t('#dc_pay#dc_pay_order')->getbyorderid($orderid);
			if($ord){
				$oinsert = false;
				C::t('#dc_pay#dc_pay_order')->update($ord['id'],$order);
			}
			$order['orderid'] = $orderid;
		}else{
			$order['orderid'] = dgmdate(TIMESTAMP, 'YmdHis').random(10,1);
		}
		
		if($oinsert){
			C::t('#dc_pay#dc_pay_order')->insert($order);
		}
		$this->_orderid = $order['orderid'];
		return $this->_orderid;
	}
	public function GetPayUrl(){
		global $_G;
		if(!$this->_paytype)return;
		$payurl = array();
		foreach($this->_paytype as $k => $pt){
			$paydata = $pt.'|'.$this->_orderid.'|'.$this->_ismobile.'|'.TIMESTAMP;
			$chk = substr(md5($paydata.FORMHASH),0,8);
			$payurl[$k] = $_G['siteurl'].'plugin.php?id=dc_pay:post&data='.$paydata.'&chk='.$chk;
		}
		return $payurl;
	}
}
class Mobile_PayMent extends PayMent{
	public function __construct($plugin) {
		$this->_ismobile = 1;
		parent::__construct($plugin);
		
	}
}
class PayHook{
	public static function Register($data) {
		$tablecheck=DB::result_first('show tables like \'%'.DB::table('dc_pay_api').'%\'');
		if(!$tablecheck)return;
		if($data['plugin'] && $data['include'] && $data['class'] && $data['return'] && $data['notify']) {
			$d = array(
				'plugin'=>$data['plugin'],
				'include'=>$data['include'],
				'class'=>$data['class'],
				'returnmethod'=>$data['return'],
				'notifymethod'=>$data['notify'],
				'ishand'=>0,
			);
			if($data['payok'])$d['payok']=$data['payok'];
			return C::t('#dc_pay#dc_pay_api')->insert($d,true,true);
		}
	}
	public static function UnRegister($plugin) {
		$tablecheck=DB::result_first('show tables like \'%'.DB::table('dc_pay_api').'%\'');
		if(!$tablecheck)return;
		return C::t('#dc_pay#dc_pay_api')->delete($plugin);
	}
}
?>