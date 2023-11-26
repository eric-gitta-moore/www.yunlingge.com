<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS `pre_nimba_linkhelper`;
CREATE TABLE `pre_nimba_linkhelper` (
  `id` int(10) NOT NULL auto_increment,
  `sitename` varchar(100) NOT NULL,
  `siteurl` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `logo` varchar(255) NOT NULL,
  `uid` int(10) NOT NULL,
  `dateline` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
EOF;

runquery($sql);
$finish = TRUE;
?>
