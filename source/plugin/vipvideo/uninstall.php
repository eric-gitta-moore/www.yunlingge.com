<?php

/**
 *      $author: ���� $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF
	DROP TABLE IF EXISTS `cdb_plugin_vipvideo_interface`;
	DROP TABLE IF EXISTS `cdb_plugin_vipvideo_record`;
EOF;

runquery($sql);

$finish = TRUE;