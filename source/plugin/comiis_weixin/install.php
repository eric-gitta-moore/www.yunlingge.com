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
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE IF EXISTS `pre_comiis_weixin`;

CREATE TABLE `pre_comiis_weixin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `key` varchar(32) NOT NULL,
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `openid` varchar(200) NOT NULL,
  `nickname` varchar(80) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `city` varchar(80) NOT NULL,
  `province` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `headimgurl` varchar(255) NOT NULL,
  `privilege` text NOT NULL,
  `unionid` varchar(255) NOT NULL,
  `dateline` int(10) NOT NULL,
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `pre_comiis_weixin_key`;

CREATE TABLE `pre_comiis_weixin_key` (
  `key` varchar(8) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`key`,`uid`)
) ENGINE=MyISAM;



EOF;

runquery($sql);

$finish = TRUE;

?>