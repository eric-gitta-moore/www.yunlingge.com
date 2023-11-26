<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class tool_regpayment{
	var $title='&#22312;&#32447;&#25903;&#20184;&#26381;&#21153;&#27880;&#20876;';
	var $des='&#25903;&#20184;&#25509;&#21475;&#27880;&#20876;&#20449;&#24687;&#20002;&#22833;&#26102;&#65292;&#29992;&#27492;&#24037;&#20855;';
	public function run(){
		global $pluginid,$_G;
		$chk = C::t('common_plugin')->fetch_by_identifier('dc_pay');
		if(!$chk){
			cpmsg('&#23545;&#19981;&#36215;&#65292;&#20320;&#36824;&#26410;&#23433;&#35013; &#34;[DC]&#36890;&#29992;&#25903;&#20184;API&#34;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool','error');
		}
		require_once DISCUZ_ROOT.'./source/plugin/dc_pay/payment.lib.class.php';
		$phr = array(
			'plugin'=>'dc_vip',
			'include'=>'payvip.class.php',
			'class'=>'payvip',
			'return'=>'doreturn',
			'notify'=>'donotify',
		);
		PayHook::Register($phr);
		cpmsg('&#27880;&#20876;&#25104;&#21151;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool','succeed');
	}
	public function setting(){
		global $pluginid,$_G;
		$chk = C::t('common_plugin')->fetch_by_identifier('dc_pay');
		if(!$chk){
			cpmsg('&#23545;&#19981;&#36215;&#65292;&#20320;&#36824;&#26410;&#23433;&#35013; &#34;[DC]&#93;&#36890;&#29992;&#25903;&#20184;API&#34;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool','error');
		}
		$tablecheck = C::t('#dc_pay#dc_pay_api')->fetch('dc_vip');
		if($tablecheck){
			cpmsg('&#24744;&#24050;&#32463;&#21521; &#34;[DC]&#93;&#36890;&#29992;&#25903;&#20184;API&#34;&#27880;&#20876;&#25903;&#20184;&#26381;&#21153;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool','succeed');
		}
		cpmsg('&#26159;&#21542;&#21521; &#34;[DC]&#93;&#36890;&#29992;&#25903;&#20184;API&#34;&#27880;&#20876;&#25903;&#20184;&#26381;&#21153;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool&f=regpayment&submit=yes','form');
	}
}
?>