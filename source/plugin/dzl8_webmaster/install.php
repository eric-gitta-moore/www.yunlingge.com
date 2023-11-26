<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_dzl8_webmaster` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `datatime` int(255) NOT NULL,
  `verify` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
EOF;

runquery($sql);
$finish = TRUE;

?>