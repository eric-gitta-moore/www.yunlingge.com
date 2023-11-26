<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS `pre_xinxiu_network_jiaoyi`;
DROP TABLE IF EXISTS `pre_xinxiu_network_log`;
DROP TABLE IF EXISTS `pre_xinxiu_network_member`;
DROP TABLE IF EXISTS `pre_xinxiu_network_tixian`;
DROP TABLE IF EXISTS `pre_xinxiu_network_token`;
EOF;

runquery($sql);

$finish = TRUE;
?>
