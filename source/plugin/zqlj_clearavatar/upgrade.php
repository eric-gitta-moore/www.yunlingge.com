<?php
/*
 * 主页：http://addon.dismall.com/?@72763.developer
 * 苏州众器良匠网络科技有限公司 出品
 * 插件定制 联系QQ281688302
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_zqlj_clearavatar_logs` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `opuid` int(11) unsigned NOT NULL DEFAULT '0',
  `opusername` char(25) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` char(25) NOT NULL DEFAULT '',
  `dateline` int(11) unsigned NOT NULL DEFAULT '0',    
  PRIMARY KEY (`logid`)
);
EOF;

runquery($sql);
$finish = TRUE;

?>