<?php
/**
 *	[���������¼�Ƽ�����(xunjie_topic.uninstall)] (C)2019-2099 Powered by Ѹ��.
 *	Version: 1.0
 *	Date: 2019-11-11 19:22
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE cdb_xunjietopic;
EOF;

runquery($sql);
$finish = true;
?>