<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$upgrade = array();
if($_G['dc_plugin']['vip']['user']){
	foreach($_G['dc_plugin']['vip']['groupdata'] as $gd){
		if($gd['growthlower']>$_G['dc_plugin']['vip']['user']['growth']){
			$upgrade = $gd;
			break;
		}
	}
}
$vip_intro_array=explode("\n",$cvar['viptq']);
foreach ($vip_intro_array as $text){
	$vip_intro.=$text?"<li>".$text."</li>\r\n":"";
}
$navtitle = lang('plugin/dc_vip','vip_center');
?>