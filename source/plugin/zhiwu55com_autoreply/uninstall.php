<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
runquery('DROP TABLE IF EXISTS `pre_zhiwu55comautoreply_reguser`');
runquery('DROP TABLE IF EXISTS `pre_zhiwu55comautoreply_auto`');
$finish = true;