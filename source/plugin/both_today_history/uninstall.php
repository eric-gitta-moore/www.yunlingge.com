<?php
/**
 *	[��ʷ�ϵĽ���������(both_today_history.uninstall)] (C)2019-2099 Powered by ��ʿ���.
 *	Version: v1.0.0
 *	Date: 2019-11-22 11:26
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE pre_both_today_history;
EOF;

runquery($sql);
$finish = true;
?>