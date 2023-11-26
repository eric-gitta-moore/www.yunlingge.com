<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class paycredit{
	public function donotify($orderid,$param,$uid,$username){
		$this->dodeal($orderid,$param,$uid,$username);
	}
	public function doreturn($orderid,$param,$uid,$username){
		global $_G;
		$this->dodeal($orderid,$param,$uid,$username);
	}
	private function dodeal($orderid,$param,$uid,$username){
		global $_G;
		if($_G['setting']['version']=='X2.5'){
			updatemembercount($uid, array($param['extcredit'] => $param['credit']), true, '', 0, '');
		}else{
			updatemembercount($uid, array($param['extcredit'] => $param['credit']), true, '', 0, '',lang('plugin/dc_pay','buycredit'),str_replace('{amount}',$param['amount'],lang('plugin/dc_pay','buycredit_msg')));
		}
	}
}
?>