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
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_comiis_sms_log` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `tel` char(20) NOT NULL,
  `ip` char(15) NOT NULL,
  `type` smallint(1) NOT NULL default '0',
  `smscode` char(20) NOT NULL,
  `error` char(60) NOT NULL,
  `dateline` int(10) NOT NULL default '0',
  `province` char(80) NOT NULL,
  `ua` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
CREATE TABLE IF NOT EXISTS `pre_comiis_sms_temp` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `tel` char(20) NOT NULL,
  `ip` char(15) NOT NULL,
  `sid` char(10) NOT NULL,
  `code` char(20) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `type` smallint(1) NOT NULL default '0',
  `dateline` int(10) NOT NULL default '0',
  `state` smallint(1) NOT NULL default '0',
  `count` tinyint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
CREATE TABLE IF NOT EXISTS `pre_comiis_sms_user` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `tel` char(20) NOT NULL,
  `regip` char(15) NOT NULL,
  `type` smallint(1) NOT NULL default '0',
  `state` smallint(1) NOT NULL default '0',
  `dateline` int(10) NOT NULL default '0',
  `province` char(80) NOT NULL,
  `ua` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
EOF;
runquery($sql);
$finish = TRUE;