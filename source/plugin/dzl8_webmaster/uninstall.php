<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
$sql = "DROP TABLE IF EXISTS ".DB::table('dzl8_webmaster')."";
runquery($sql);
$finish = TRUE;

?>