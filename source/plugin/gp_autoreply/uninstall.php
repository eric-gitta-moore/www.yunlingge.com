<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_last.php')) @unlink(DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_last.php');
$identifier = 'gp_autoreply';
if(!function_exists('cloudaddons_deltree')) require libfile('function/cloudaddons');
cloudaddons_deltree(DISCUZ_ROOT .'./source/plugin/'.$identifier.'/');
$finish = TRUE;
?>