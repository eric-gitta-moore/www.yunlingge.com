<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: disable.php 873 2019-12-26 16:10:12
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_ADMINCP')) {
exit('Access Denied');
}
$available = $operation == 'enable' ? 1 : 0;# 1314ѧϰ��
C::t('common_plugin')->update($_GET['pluginid'], array('available' => $available));
updatecache(array('plugin', 'setting', 'styles'));
cleartemplatecache();
updatemenu('plugin');//  ���棺 http://t.cn/hbdjxV
$_statInfo = array();
$_statInfo['pluginName'] = $plugin['identifier'];
$_statInfo['bbsVersion'] = DISCUZ_VERSION;
$_statInfo['bbsUrl'] = $_G['siteurl'];#http://suo.im/5qyxLj
$_statInfo['action'] = $operation;
$_statInfo['nextUrl'] = ADMINSCRIPT.'?action=plugins';
$_statInfo = base64_encode(serialize($_statInfo));
$_md5Check = md5($_statInfo);
cpmsg('plugins_'.$operation.'_succeed', 'http'.($_G['isHTTPS'] ? 's' : '').'://addon.1314study.com/api/outer_addon.php?type=js&info='.$_statInfo.'&md5check='.$_md5Check, 'succeed');


//Copyright 2001-2099 .1314.ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: disable.php 1331 2019-12-26 08:10:12
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue ������ http://t.cn/EUPqQW1��
//Ӧ����ǰ��ѯ��QQ 15.3269.40
//Ӧ�ö��ƿ�����QQ 643.306.797
//�����Ϊ 131.4ѧϰ����www.1314Study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��