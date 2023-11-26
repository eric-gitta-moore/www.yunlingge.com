<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$tables = array (
    'mdown_category',
	'mdown_resource',
	'mdown_log',
);
foreach ($tables as $tb) {
    $sql = "DROP TABLE IF EXISTS `".DB::table($tb)."`";
    runquery($sql);
}
$finish = TRUE;
?>