<?php

/**
 *      $author: ณหมน $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF

CREATE TABLE IF NOT EXISTS `cdb_plugin_vipvideo_record` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL DEFAULT 0,
  `username` varchar(32) NOT NULL DEFAULT '',
  `linkurl` varchar(255) NOT NULL DEFAULT '',
  `credit_item` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `credit_num` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `postip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

EOF;

runquery($sql);

updatecache('vipvideo:interface');

$finish = TRUE;

?>