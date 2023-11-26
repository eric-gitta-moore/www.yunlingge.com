<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
DB::query("DROP TABLE IF EXISTS ".DB::table('iplus_gezi')."");
$filepath=DISCUZ_ROOT.'./data/cache/cache_iplus_gezi.php';
if(file_exists($filepath)) @unlink($filepath);

$filepath=DISCUZ_ROOT.'./data/sysdata/cache_iplus_gezi.php';
if(file_exists($filepath)) @unlink($filepath);

$finish = TRUE;
?>