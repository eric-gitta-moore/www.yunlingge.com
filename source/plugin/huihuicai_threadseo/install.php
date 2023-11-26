<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


$sql = <<<EOF

CREATE TABLE IF NOT EXISTS `pre_forum_thread_seo_edited` (
  `tid` mediumint(8) unsigned NOT NULL,
  `seo_title` char(200) NOT NULL DEFAULT '',
  `edited_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `pre_forum_thread_seo_ignored` (
  `tid` mediumint(8) unsigned NOT NULL,
  `ignored_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM;

EOF;

runquery($sql);

$finish = TRUE;
?>