<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


$sql = <<<EOF

DROP TABLE IF EXISTS `pre_forum_thread_seo_edited`;
DROP TABLE IF EXISTS `pre_forum_thread_seo_ignored`;

EOF;

runquery($sql);

$finish = TRUE;
?>