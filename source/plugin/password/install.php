<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `cdb_password` (
	`uid` int(10) NOT NULL,
	`dateline` int(10) NOT NULL,
	`update_dateline` int(10) NOT NULL,
	`passwd_hash` varchar(6) NOT NULL,
	`passwd` varchar(32) NOT NULL,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB;
EOF;
runquery($sql);
$finish = true;
?>