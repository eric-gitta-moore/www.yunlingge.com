<?php
/*
 * 主页：http://addon.dismall.com/?@72763.developer
 * 苏州众器良匠网络科技有限公司 出品
 * 插件定制 联系QQ281688302
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<SQL
DROP TABLE IF EXISTS pre_zqlj_clearavatar_logs;
SQL;
runquery($sql);
$finish = TRUE;
?>