<?php
/**
 * 
 * ���׳�Ʒ ������Ʒ
 * ������ƹ����� ��Ȩ���� http://www.Comiis.com
 * רҵ��̳��ҳ���������, ҳ���������, ���ݰ��/����, ������ο���, ��վЧ��ͼ���, ҳ���׼DIV+CSS����, �������С����ҵ��վ���...
 * ����������Ϊ��ҵ�ṩ������վ���衢��վ�ƹ㡢��վ�Ż������򿪷�������ע�ᡢ���������ȷ���
 * һ����ƺͽ������Ϊ��ҵ��������ʺ��Լ��������վ��Ӫƽ̨������޶ȵ�ʹ��ҵ����Ϣʱ�����������̻���
 *
 *   �绰: 0668-8810200
 *   �ֻ�: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * ����ʱ��: ��һ����������09:00-11:00, ����03:00-05:00, ����08:30-10:30(����������Ϣ)
 * ��������û�����Ⱥ: ��Ⱥ83667771 ��Ⱥ83667772 ��Ⱥ83667773 ��Ⱥ110900020 ��Ⱥ110900021 ��Ⱥ70068388 ��Ⱥ110899987
 * 
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/comiis_app_color/language/language.'.currentlang().'.php';
$sql = <<<EOF
DROP TABLE IF EXISTS `pre_comiis_app_style`;
CREATE TABLE `pre_comiis_app_style` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `displayorder` smallint(6) NOT NULL default '0',
  `name` varchar(30) NOT NULL,
  `default` tinyint(1) NOT NULL default '0',
  `show` tinyint(1) NOT NULL default '0',
  `css` text NOT NULL,
  `color1` varchar(10) NOT NULL,
  `color2` varchar(10) NOT NULL,
  `color3` varchar(10) NOT NULL,
  `color4` varchar(10) NOT NULL,
  `color5` varchar(10) NOT NULL,
  `color6` varchar(10) NOT NULL,
  `color7` varchar(10) NOT NULL,
  `color8` varchar(10) NOT NULL,
  `color9` varchar(10) NOT NULL,
  `color10` varchar(10) NOT NULL,
  `color11` varchar(10) NOT NULL,
  `color12` varchar(10) NOT NULL,
  `color13` varchar(10) NOT NULL,
  `color14` varchar(10) NOT NULL,
  `color15` varchar(10) NOT NULL,
  `color16` varchar(10) NOT NULL,
  `color17` varchar(10) NOT NULL,
  `color18` varchar(10) NOT NULL,
  `color19` varchar(10) NOT NULL,
  `color20` varchar(10) NOT NULL,
  `color21` varchar(10) NOT NULL,
  `color22` varchar(10) NOT NULL,
  `color23` varchar(10) NOT NULL,
  `color24` varchar(10) NOT NULL,
  `color25` varchar(10) NOT NULL,
  `color26` varchar(10) NOT NULL,
  `color27` varchar(10) NOT NULL,
  `color28` varchar(10) NOT NULL,
  `color29` varchar(10) NOT NULL,
  `color30` varchar(10) NOT NULL,
  `color31` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
DROP TABLE IF EXISTS `pre_comiis_app_userstyle`;
CREATE TABLE `pre_comiis_app_userstyle` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `uid` mediumint(8) NOT NULL default '0',
  `css` mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (`id`,`uid`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM;
EOF;
$sql .= $comiis_app_color_install_lang;
runquery($sql);
$finish = TRUE;
