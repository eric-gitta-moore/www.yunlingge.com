<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$paytypes = array();
if($cvar['extcredit'])
	$paytypes[] = 'credit';
$viptype = array('month','year');

$submitchk = false;
if($cvar['secopen'])
	$submitchk = submitcheck('submit',0,1);
else
	$submitchk = submitcheck('submit');
if($submitchk){
	if(in_array($_G['groupid'],array(4,5,6,7,8)))
		showmessage(lang('plugin/dc_vip','isbadgroup'));
	$payway = $_GET['payway'];
	$paytype = 'credit';
	$paylen = dintval($_GET['paylen']);
	if(($paylen<1||$paylen>10)||!in_array($payway,$viptype))showmessage('undefined_action');
	if($_G['dc_plugin']['vip']['user']['exptime']==2147454847)showmessage(lang('plugin/dc_vip','is_forevervip'));
	if($payway=='month'&&$paylen<$cvar['mplower'])
		showmessage(str_replace('{month}',$cvar['mplower'],lang('plugin/dc_vip','paylimint')));
	$order = array();
	if($payway=="month"){
		$paymoney = $paylen*$cvar['credit'];
		$order['month'] = $paylen;
	}else{
		$paymoney = $paylen*$cvar['yearcredit'];
		$order['month'] = $paylen*12;
	}
	$order['credit'] = $paymoney;
	$credit = C::t('common_member_count')->fetch($_G['uid']);
	if($credit['extcredits'.$cvar['extcredit']]<$paymoney){
		showmessage(str_replace('{credit}',$_G['setting']['extcredits'][$cvar['extcredit']]['title'],lang('plugin/dc_vip','nocredit')));
	}

	updatemembercount($_G['uid'], array('extcredits'.$cvar['extcredit'] => "-".$order['credit']), true, '', 0, '',lang('plugin/dc_vip','vippay'),str_replace('{month}',$order['month'],lang('plugin/dc_vip','vippaymsg')));
	
	$data = array();
	if($_G['dc_plugin']['vip']['user']){
		$data['exptime'] = strtotime('+'.$order['month'].' month',$_G['dc_plugin']['vip']['user']['exptime']);
		if($data['exptime']<10000000||$data['exptime']>2147454847)$data['exptime'] = 2147454847;
		C::t('#dc_vip#dc_vip')->update($_G['uid'],$data);
		showmessage(lang('plugin/dc_vip','xfsucceed'),dreferer(),array(),array('alert'=>'right'));
	}else{
		$data['exptime'] = strtotime('+'.$order['month'].' month',strtotime(dgmdate(TIMESTAMP, 'd')))+86399;
		if($myvip){
			if($data['exptime']<10000000||$data['exptime']>2147454847)$data['exptime'] = 2147454847;
			C::t('#dc_vip#dc_vip')->update($_G['uid'],$data);
		}else{
			if($data['exptime']<10000000||$data['exptime']>2147454847)$data['exptime'] = 2147454847;
			$data['jointime'] = TIMESTAMP;
			$data['uptime'] = TIMESTAMP;
			$data['growth'] = 0;
			$data['uid'] = $_G['uid'];
			$vgid = C::t('#dc_vip#dc_vip_group')->getvgid($data['growth']);
			$data['vgid'] = $vgid['id'];
			C::t('#dc_vip#dc_vip')->insert($data);
		}
		showmessage(lang('plugin/dc_vip','paysucceed'),dreferer(),array(),array('alert'=>'right'));
	}
}
if($_GET['getmoney']=='yes'){
	$payway = $_GET['payway'];
	$paytype = 'credit';
	$paylen = dintval($_GET['paylen']);
	include template('common/header_ajax');
	if(($paylen<1||$paylen>10)||!in_array($payway,$viptype)){
		echo 'error';
	}else{
		if($payway=="month"){
			$paymoney = $paylen*$cvar['credit'];
		}else{
			$paymoney = $paylen*$cvar['yearcredit'];
		}
		$paymoney = '<font style="color:#FF0000;font-size:22px">'.$paymoney.'</font>';
		$paymoney = $paymoney.$_G['setting']['extcredits'][$cvar['extcredit']]['title'];
		echo $paymoney;
	}
	include template('common/footer_ajax');
}
$vip_intro_array=explode("\n",$cvar['viptq']);
foreach ($vip_intro_array as $text){
	$vip_intro.=$text?"<li>".$text."</li>\r\n":"";
}
$paytimes = dintval($_GET['m']);
$paytimes = $paytimes ?$paytimes:1;

$vip_price_ext = $_G['setting']['extcredits'][$cvar['extcredit']]['unit'].$_G['setting']['extcredits'][$cvar['extcredit']]['title'];
$randstr = random(8);
$navtitle = lang('plugin/dc_vip','vip_center');
?>