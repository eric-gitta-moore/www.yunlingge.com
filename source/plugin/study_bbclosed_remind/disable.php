<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: disable.php 929 2019-11-26 12:41:36Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_ADMINCP')) {
exit('Access Denied');
}
$available = $operation == 'enable' ? 1 : 0;#1314ѧϰ��
C::t('common_plugin')->update($_GET['pluginid'], array('available' => $available));
updatecache(array('plugin', 'setting', 'styles'));#1314ѧϰ��
cleartemplatecache();
updatemenu('plugin');
$_statInfo = array();
$_statInfo['pluginName'] = $plugin['identifier'];#��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
$_statInfo['bbsVersion'] = DISCUZ_VERSION;
$_statInfo['bbsUrl'] = $_G['siteurl'];
$_statInfo['action'] = $operation;
$_statInfo['nextUrl'] = ADMINSCRIPT.'?action=plugins';
$_statInfo = base64_encode(serialize($_statInfo));#1314ѧϰ��
$_md5Check = md5($_statInfo);
cpmsg('plugins_'.$operation.'_succeed', 'http'.($_G['isHTTPS'] ? 's' : '').'://addon.1314study.com/api/outer_addon.php?type=js&info='.$_statInfo.'&md5check='.$_md5Check, 'succeed');


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: disable.php 1371 2019-11-26 04:41:36Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��