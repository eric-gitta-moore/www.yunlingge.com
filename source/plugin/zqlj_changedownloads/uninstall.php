<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$identifier = 'zqlj_changedownloads';
if(!function_exists('cloudaddons_deltree')) require libfile('function/cloudaddons');
cloudaddons_deltree(DISCUZ_ROOT .'./source/plugin/'.$identifier.'/');
$finish = TRUE;

?>