<?php
/**
 *	[����ۺ�(zgxsh_app_center.uninstall)] (C)2019-2099 Powered by �����ǳ����.
 *	Version: 1.0
 *	Date: 2019-3-24 23:28
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS cdb_zgxsh_app_center;
EOF;

runquery($sql);

$finish = true;
?>