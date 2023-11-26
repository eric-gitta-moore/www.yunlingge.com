<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$xhkj5com_dashang= DB::table("xhkj5com_dashang");
$sql = <<<EOF
CREATE TABLE `pre_xhkj5com_dashang` (
  `uid` int(11) NOT NULL,
  `picurl` varchar(50) NOT NULL default '',
  `picurla` varchar(50) NOT NULL default '0',
  `text` varchar(50) NOT NULL default '0',
  `bz` varchar(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `endtime` (`bz`)
) ENGINE=MyISAM;
EOF;
runquery($sql);
$finish = true;
?>