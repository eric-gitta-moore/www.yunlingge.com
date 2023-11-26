<?php
/**
 *	[历史上的今天最热帖(both_today_history.install)] (C)2019-2099 Powered by 博士设计.
 *	Version: v1.0.0
 *	Date: 2019-11-22 11:26
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS pre_both_today_history;
CREATE TABLE pre_both_today_history (
tid mediumint(8) NOT NULL PRIMARY KEY,
authorid mediumint(8) NOT NULL,
author varchar(15) NOT NULL,
subject varchar(80) NOT NULL,
fid mediumint(8) NOT NULL,
name char(50) NOT NULL,
dateline  int(10) NOT NULL,
heats int(10) NOT NULL,
views int(10) NOT NULL
);
EOF;

runquery($sql);
$finish = true;
?>