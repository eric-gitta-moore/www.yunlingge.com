<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$zhiwu55_sql = <<<EOF

CREATE TABLE IF NOT EXISTS `pre_zhiwu55comautoreply_reguser` (

  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(200) DEFAULT NULL,
  `username_pwd` varchar(50) DEFAULT NULL,
  `username_mail` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`uid`)

) ENGINE=MyISAM;

EOF;
runquery($zhiwu55_sql);

$zhiwu55_sql = <<<EOF

CREATE TABLE IF NOT EXISTS `pre_zhiwu55comautoreply_auto` (

  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `showurl` varchar(500) DEFAULT NULL,
  `reply_message` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`id`)

) ENGINE=MyISAM;

EOF;
runquery($zhiwu55_sql);


$finish = TRUE;