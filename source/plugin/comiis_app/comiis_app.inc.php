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
if(!defined('IN_DISCUZ') && !$_G['uid']) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/comiis_app/language/language.'.currentlang().'.php';
if(empty($_GET['comiis']) || !in_array($_GET['comiis'], array('re_recommend', 're_hotreply', 're_forum_list_zhan'))) $_GET['comiis'] = '';
if($_GET['comiis'] != ''){
	include_once libfile('comiis_'. $_GET['comiis'], 'plugin/comiis_app/module/');
}
