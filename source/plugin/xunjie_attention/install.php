<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF

CREATE TABLE IF NOT EXISTS cdb_xunjieattention (
  `uid` mediumint(8) unsigned NOT NULL,
  `buid` mediumint(8) unsigned NOT NULL,
  `username` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`,`buid`)
) TYPE=MyISAM;
CREATE TABLE IF NOT EXISTS cdb_xunjieattentionv (
  `uid` mediumint(8) unsigned NOT NULL,
  `visit` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) TYPE=MyISAM;

EOF;

runquery($sql);

$finish = TRUE;

?>