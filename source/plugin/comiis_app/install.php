<?php
/**
 * 
 * ��-��-�����ѣ�Ϊ��֤�ݸ�����Դ�ĸ���ά�����ϣ���ֹ�ݸ����׷���Դ�����ⷺ�ģ�
 *             ϣ���������زݸ�����Դ�Ļ�Ա��Ҫ����Ѳݸ����׷���Դ�ṩ��������;
 *             �类���֣���ȡ���ݸ���VIP��Ա�ʸ�ֹͣһ�к��ڸ���֧���Լ����в���BUG����������
 *          
 * ��.��.�ɳ�Ʒ ������Ʒ
 * �ݸ��� ȫ���׷� https://Www.Caogen8.co
 * ������www.Cgzz8.com (���ղر���!)
 * ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 * ����֧��/����ά����QQ 2575 163778
 * лл֧�֣���л���.�ݸ���.�Ĺ�ע������������   
 * 
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_comiis_app_nav` (
  `navid` mediumint(8) unsigned NOT NULL auto_increment,
  `displayor` smallint(6) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `bgcolor` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL default '#',
  `type` tinyint(1) NOT NULL default '0',
  `show` tinyint(1) NOT NULL default '0',
  `navtype` enum('lnav','mnav','tnav','fnav','ynav') NOT NULL,
  PRIMARY KEY  (`navid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `pre_comiis_app_switch` (
  `name` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM;
EOF;
runquery($sql);

include_once DISCUZ_ROOT.'./source/plugin/comiis_app/upgrade.php';
