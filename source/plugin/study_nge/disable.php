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
C::t('common_plugin')->update($_GET['pluginid'], array('available' => 0));
updatecache(array('plugin', 'setting', 'styles'));
cleartemplatecache();
updatemenu('plugin');
cpmsg('&#x63d2;&#x4ef6;&#x5df2;&#x5173;&#x95ed;&#xff0c;&#x53bb;&#x6e90;&#x7801;&#x54e5;&#x770b;&#x770b;&#x5427;', 'http://www.ymg6.com', 'succeed');