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