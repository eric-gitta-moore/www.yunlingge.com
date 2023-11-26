<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

global $_G;
$plugin = $_G['cache']['plugin']['viewui_tools'];
$navtitle = $plugin['name'];
$group = unserialize($plugin['group']);
if(in_array($_G['groupid'],$group) || $plugin['group']=="a:1:{i:0;s:0:\"\";}"){}else{showmessage(lang('plugin/viewui_tools', 'grouperror'));}
$plugin['qrcode'] = $plugin['qrcode']?$plugin['qrcode']:150;
$toolsname = addslashes($_GET['name']);

switch($toolsname){
	case "utf8":
	include template("viewui_tools:utf8");
	break;
	case "qrcode":
	include template("viewui_tools:qrcode");
	break;
	case "base64":
	include template("viewui_tools:base64");
	break;
	case "color":
	include template("viewui_tools:color");
	break;
	case "js":
	include template("viewui_tools:js");
	break;
	case "cssjb":
	include template("viewui_tools:cssjb");
	break;
	case "md5":
	include template("viewui_tools:md5");
	break;
	case "base64j":
	include template("viewui_tools:base64j");
	break;
	case "cy":
	include template("viewui_tools:cy");
	break;
	case "wechat":
	include template("viewui_tools:wechat");
	break;
	default:
	include template("viewui_tools:list");
}
?>