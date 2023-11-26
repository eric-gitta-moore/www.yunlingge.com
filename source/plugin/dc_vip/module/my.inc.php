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
$navtitle = lang('plugin/dc_vip','vip_center');
?>