<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$identifier = 'bansame';
if(!function_exists('cloudaddons_deltree')) require libfile('function/cloudaddons');
cloudaddons_deltree(DISCUZ_ROOT .'./source/plugin/'.$identifier.'/');
$finish = TRUE;

?>