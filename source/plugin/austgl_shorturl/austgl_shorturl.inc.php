<?php
/**
 *	[新浪短网址(austgl_shorturl.{modulename})] (C)2014-2099 Powered by austgl.com|iganlei.cn 阿甘工作室.
 *	Version: v1.0
 *	Date: 2014-3-6 14:22
 */
// error_reporting(E_ALL);
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
// global $_G;
$austgl_config = $_G['cache']['plugin']['austgl_shorturl'];
if((!$config['austgl_navopen'])||(in_array($_G['groupid'], unserialize($config['austgl_user'])))){
	include template('austgl_shorturl:austgl_shorturl');
}else{
	showmessage(lang('plugin/austgl_shorturl','austgl_error'));
}
?>