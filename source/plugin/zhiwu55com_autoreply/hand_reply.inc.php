<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$imgUrl=$_G['siteurl'] . 'source/plugin/zhiwu55com_autoreply/template/help.png';
$htmlcode='<img src="' . $imgUrl . '" width="1026" height="1086">';
include template('zhiwu55com_autoreply:hand_reply');