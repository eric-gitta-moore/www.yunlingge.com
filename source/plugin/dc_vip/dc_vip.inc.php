<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//$_G['disabledwidthauto'] = true;
$action = $_GET['action'] ? $_GET['action'] : 'index';
$cvar = $_G['cache']['plugin']['dc_vip'];
$version ='Ver 1.0.5';
if (!$_G['uid']) showmessage('not_loggedin','member.php?mod=logging&action=login');
if(!$_G['cache']['plugin']['dc_vip']['open'])showmessage('plugin_nonexistence');
if(defined('IN_MOBILE'))$action='pay';
if(!preg_match("/^[a-z0-9_\-]+$/i", $action))showmessage('undefined_action');
//if(md5_file($cvar['chk'])!=$cvar['hash'])showmessage('plugin_nonexistence');
$file = DISCUZ_ROOT.'./source/plugin/dc_vip/module/'.$action.'.inc.php';
if (!file_exists($file)) showmessage('undefined_action');
loadcache(array('dc_vipextend'));
$dh = array(
	'index'=>lang('plugin/dc_vip','vip_index'),
	'my'=>lang('plugin/dc_vip','vip_my'),
	'tq'=>lang('plugin/dc_vip','vip_tq'),
	'pay' => lang('plugin/dc_vip','vip_pay'),
	'top' => lang('plugin/dc_vip','vip_top'),
);
$vipnav = @include DISCUZ_ROOT.'./source/plugin/dc_vip/data/nav.php';
if(!empty($vipnav)&&is_array($vipnav)){
	$dh =array_merge($dh,$vipnav);
}
if($_G['dc_plugin']['vip']['user'])
	$dh['pay'] = lang('plugin/dc_vip','vip_xf');
$myvip = $_G['dc_plugin']['vip']['obj']->getvipinfo($_G['uid'],true);
if($_G['cache']['dc_vipextend']['rmcopy']){
	$rmcopy = @include DISCUZ_ROOT.'./source/plugin/dc_vip/data/rmcopy.config.php';
}
@include $file;
include template('dc_vip:vipcenter');
?>