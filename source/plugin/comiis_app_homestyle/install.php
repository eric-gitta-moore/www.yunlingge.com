<?php
/**
 * 
 * 克米出品 必属精品
 * 克米设计工作室 版权所有 http://www.Comiis.com
 * 专业论坛首页及风格制作, 页面设计美化, 数据搬家/升级, 程序二次开发, 网站效果图设计, 页面标准DIV+CSS生成, 各类大中小型企业网站设计...
 * 我们致力于为企业提供优质网站建设、网站推广、网站优化、程序开发、域名注册、虚拟主机等服务，
 * 一流设计和解决方案为企业量身打造适合自己需求的网站运营平台，最大限度地使企业在信息时代稳握无限商机。
 *
 *   电话: 0668-8810200
 *   手机: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作时间: 周一到周五早上09:00-11:00, 下午03:00-05:00, 晚上08:30-10:30(周六、日休息)
 * 克米设计用户交流群: ①群83667771 ②群83667772 ③群83667773 ④群110900020 ⑤群110900021 ⑥群70068388 ⑦群110899987
 * 
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/comiis_app_homestyle/language/language.'.currentlang().'.php';
$sql = <<<EOF
DROP TABLE IF EXISTS `pre_comiis_app_home`;
CREATE TABLE `pre_comiis_app_home` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `displayorder` tinyint(6) NOT NULL default '0',
  `name` char(80) NOT NULL,
  `dir` char(30) NOT NULL default '',
  `img` char(30) NOT NULL default '',
  `recommend` mediumint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
DROP TABLE IF EXISTS `pre_comiis_app_homestyle`;
CREATE TABLE `pre_comiis_app_homestyle` (
  `id` mediumint(8) unsigned NOT NULL default '0',
  `uid` mediumint(8) NOT NULL default '0',
  `img` varchar(80) NOT NULL default '',
  `img_id` mediumint(8) NOT NULL default '0'
) ENGINE=MyISAM;
EOF;
$sql .= $comiis_app_homestyle_install_lang;
runquery($sql);
$finish = TRUE;