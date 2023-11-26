<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$vipnews = C::t('#dc_vip#dc_vip')->gettop('new',$cvar['topno']);
$viptops = C::t('#dc_vip#dc_vip')->gettop('top',$cvar['topno']);
$uids = array();
foreach($vipnews as $v){
	$uids[] = $v['uid'];
}
foreach($viptops as $v){
	$uids[] = $v['uid'];
}
$member = C::t('common_member')->fetch_all($uids);

$vip_intro_array=explode("\n",$cvar['viptq']);
foreach ($vip_intro_array as $text){
	$vip_intro.=$text?"<li>".$text."</li>\r\n":"";
}
$navtitle = lang('plugin/dc_vip','vip_center');
?>