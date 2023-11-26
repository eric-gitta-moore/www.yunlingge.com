<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS `pre_dc_vip`;
DROP TABLE IF EXISTS `pre_dc_vip_group`;
EOF;
runquery($sql);
$finish = TRUE;
?>