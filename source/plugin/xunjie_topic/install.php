<?php
/**
 *	[根据浏览记录推荐主题(xunjie_topic.install)] (C)2019-2099 Powered by 迅捷.
 *	Version: 1.0
 *	Date: 2019-11-11 19:22
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
CREATE TABLE IF NOT EXISTS cdb_xunjietopic (
  `fronttid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `aftertid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` char(80) NOT NULL DEFAULT '',
  `browsedata` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fronttid`,`aftertid`)
) ENGINE=MyISAM;
EOF;

runquery($sql);
$finish = true;
?>