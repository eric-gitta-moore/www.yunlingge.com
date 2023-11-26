<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$paytype = trim($_GET['paytype']);
$_lang = lang('plugin/dc_pay');
if(!preg_match("/^[a-z0-9_\-]+$/i", $paytype))showmessage('dc_pay:error');
require_once DISCUZ_ROOT.'./source/plugin/dc_pay/payment.lib.class.php';
$payobj = new PayMent('dc_pay');
$paytypes = $payobj->GetPayType();
if(!in_array($paytype,$paytypes))showmessage('dc_pay:error');
$payinfo = $payobj->GetPayInfo($paytype); 
$data = urldecode(authcode($_GET['data'],'DECODE'));
if(!$data)showmessage('dc_pay:error');
$orderid = $data;
$order = C::t('#dc_pay#dc_pay_order')->getbyorderid($orderid);
if(!$order||$order['status'])showmessage('dc_pay:error');
if(submitcheck('submit')){
	$param = dunserialize($order['param']);
	$param['payaccount'] = trim($_GET['account']);
	$orderdata = array(
		'status'=>2,
		'payorderid'=>$paytype.':'.trim($_GET['payid']),
		'param'=>serialize($param),
	);
	C::t('#dc_pay#dc_pay_order')->update($order['id'],$orderdata);
	showmessage('dc_pay:transferok',$_G['siteurl'],array(),array('alert'=>'right'));
}
$filepath = DISCUZ_ROOT.'/source/plugin/dc_pay/data/'.$paytype.'.config.php';
if(!file_exists($filepath))showmessage('dc_pay:error');
$str = @include $filepath;
$config = dunserialize(authcode($str['data'], 'DECODE', $_G['config']['security']['authkey']));
$config = dhtmlspecialchars($config);
if(strpos($config['qrcode'],'http')===false)$config['qrcode']=$_G['siteurl'].'data/attachment/common/'.$config['qrcode'];
include template('dc_pay:transfer');
?>