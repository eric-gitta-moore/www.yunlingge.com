<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: study_bbclosed_remind.inc.php 745 2019-11-26 12:41:36Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
$splugin_setting = $_G['cache']['plugin']['study_bbclosed_remind'];
if($splugin_setting['study_radio'] && $_GET['formhash'] == $_G['formhash']){
//����̳����Ա����
if($_G['adminid'] == '1'){
$settings = array();
$settings['bbclosed'] = 0;
C::t('common_setting')->update_batch($settings);
require_once libfile('function/cache');/*1.3.1.4.ѧ.ϰ.��*/
updatecache('setting');
showmessage('&#x8BBA;&#x575B;&#x5F00;&#x542F;&#x6210;&#x529F;&#xFF01;',dreferer());
}else{
showmessage('&#x4F60;&#x6CA1;&#x6709;&#x6743;&#x9650;&#x4F7F;&#x7528;&#x672C;&#x529F;&#x80FD;');/*www_discuz_1314study_com*/
}//3014
}else{
showmessage('&#x63D2;&#x4EF6;&#x5DF2;&#x5173;&#x95ED;');
}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: study_bbclosed_remind.inc.php 1205 2019-11-26 04:41:36Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��