<?php
/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

if(!defined('IN_ADMINCP')) {
exit('Access Denied');
}
C::t('common_plugin')->update($_GET['pluginid'], array('available' => 1));
cpmsg('&#x6e90;&#x7801;&#x54e5;&#x63d0;&#x9192;&#xff1a;&#x63d2;&#x4ef6;&#x5f00;&#x542f;&#x6210;&#x529f;', 'action=plugins'.(!empty($_GET['system']) ? '&system=1' : ''), 'succeed');