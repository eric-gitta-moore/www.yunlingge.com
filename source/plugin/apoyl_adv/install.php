<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php  2019-06  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF

CREATE TABLE IF NOT EXISTS `pre_plugin_adv_count` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `advid` mediumint(8) unsigned NOT NULL,
  `url` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `pvcount` int(10) unsigned NOT NULL default '0',
  `showcount` int(10) unsigned NOT NULL default '0',
  `modtime` int(10) unsigned NOT NULL default '0',
  `addtime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `url` (`url`),
  KEY `advid` (`advid`)
) ENGINE=MyISAM;
EOF;
runquery($sql);

$finish = TRUE;
?>