<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: enable.php 624 2019-11-21 10:48:23Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_ADMINCP')) {
exit('Access Denied');
}
$addonid = $plugin['identifier'].'.plugin';//1.3.1.4.ѧ.ϰ.��
// $array = cloudaddons_getmd5($addonid);

// $available = $operation == 'enable' ? 0 : 1;
// C::t('common_plugin')->update($_GET['pluginid'], array('available' => 1));
// cpmsg('plugins_'.$operation.'_succeed', 'action=plugins'.(!empty($_GET['system']) ? '&system=1' : ''), 'succeed');
$finish = true;