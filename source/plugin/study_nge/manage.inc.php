<?php

/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('http://www.ymg6.com/');
}
define('STUDY_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.dhtmlspecialchars($_GET['identifier']).'&pmod=manage');//1314ѧϰ��
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/manage.func.php';#��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/pluginvar.func.php';
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/setting_default.php';
$splugin_lang = lang('plugin/study_nge');
$type1314 = in_array($_GET['type1314'], array('common','left', 'middle','right','bottom')) ? $_GET['type1314'] : 'common';#1.3.1.4.ѧ.ϰ.��
echo '<link href="./source/plugin/study_nge/images/manage.css?'.VERHASH.'" rel="stylesheet" type="text/css" />';
study_subtitle(array(
array('&#x516C;&#x5171;&#x8BBE;&#x7F6E;', 'common'),
array('&#x56FE;&#x7247;&#x6A21;&#x5757;', 'left'),
array('&#x5E16;&#x5B50;&#x6A21;&#x5757;', 'middle'),
array('&#x4F1A;&#x5458;&#x6A21;&#x5757;', 'right'),
array('&#x5E95;&#x90E8;&#x6A21;&#x5757;', 'bottom'),
),$type1314);
if($type1314 == 'common'){
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/manage_common.php';
}else{
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/manage_mid.php';//www_discuz_1314study_com
}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: manage.inc.php 1834 2017-08-20 18:43:24Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��