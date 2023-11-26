<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require './source/plugin/zhiwu55com_autoreply/function_common.php';
$server_url = 'action=plugins&operation=config&do=' . $pluginid . '&identifier=zhiwu55com_autoreply&pmod=auth&formhash=' . FORMHASH;
if ($_GET['formhash'] == FORMHASH && $_GET['update'] == 'yes') {

	$update_auth_ok = lang('plugin/zhiwu55com_autoreply', 'update_auth_ok');
	zhiwu55com_autoreply_appid(3);
	$zhiwu55com_autoreply_auth = dfsockopen("http://www.zhiwu55.com/authorization/zhiwu55com_autoreply_empowerment.php?zhiwu55_com_appid=" . $hzw_appid);
	setcookie('zhiwu55com_autoreply_auth',$zhiwu55com_autoreply_auth,time()+120);
	cpmsg($update_auth_ok,$server_url,"succeed");

}
$hzw_appid = zhiwu55com_autoreply_appid();
if(empty($_COOKIE['zhiwu55com_autoreply_auth']))
{
	$zhiwu55com_autoreply_auth = dfsockopen("http://www.zhiwu55.com/authorization/zhiwu55com_autoreply_empowerment.php?zhiwu55_com_appid=" . $hzw_appid);
	setcookie('zhiwu55com_autoreply_auth',$zhiwu55com_autoreply_auth,time()+120);
} else {
	$zhiwu55com_autoreply_auth = $_COOKIE['zhiwu55com_autoreply_auth'];
}
$authArr = dunserialize($zhiwu55com_autoreply_auth);
$version=$_G['setting']['plugins']['version']['zhiwu55com_autoreply'];
include template('zhiwu55com_autoreply:auth');