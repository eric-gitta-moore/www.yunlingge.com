<?php
/**
 *	[历史上的今天最热帖(both_today_history.uninstall)] (C)2019-2099 Powered by 博士设计.
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