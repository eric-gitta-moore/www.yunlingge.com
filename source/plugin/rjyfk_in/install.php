<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS `pre_rjy_inlog`;
CREATE TABLE IF NOT EXISTS `pre_rjy_inlog` (
  `gid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  `listtype` tinyint(1) NOT NULL,
  `groupid` int(10) unsigned NOT NULL,
  `groupenddate` char(10) NOT NULL,
  `extcredits` varchar(255) NOT NULL,
  `total_fee` int(10) NOT NULL,
  `sdpayno` varchar(20) NOT NULL,
  `sdorderno` varchar(20) NOT NULL,
  `paydate` int(10) NOT NULL,
  `paytype` varchar(20) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `server` varchar(50) NOT NULL,
  `extstatus` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `paytime` int(10) NOT NULL,
  UNIQUE KEY `gid` (`gid`),
  KEY `sdorderno` (`sdorderno`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM
EOF;
runquery($sql);
$finish = TRUE;