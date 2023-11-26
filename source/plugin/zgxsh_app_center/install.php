<?php
/**
 *	[插件聚合(zgxsh_app_center.install)] (C)2019-2099 Powered by 日月星辰软件.
 *	Version: 1.0
 *	Date: 2019-3-24 23:28
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS `cdb_zgxsh_app_center`;
CREATE TABLE `cdb_zgxsh_app_center` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `url` varchar(500) NOT NULL,
  `txt` varchar(2000) default NULL,
  `ico` varchar(500) NOT NULL,
  `label1` varchar(10) default NULL,
  `label2` varchar(10) default NULL,
  `label3` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT;
EOF;

runquery($sql);
$finish = true;
?>