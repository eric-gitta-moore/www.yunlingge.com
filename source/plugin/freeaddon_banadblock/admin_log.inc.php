<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: admin_log.inc.php 1477 2019-11-26 12:51:05Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('60DF4F84-4325-8E2C-A68B-78184AFF8D9A');
}
define('STUDY_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.dhtmlspecialchars($_GET['identifier']).'&pmod=admin_log');
require_once libfile('function/var', 'plugin/freeaddon_banadblock/source');//1314学习网
require_once libfile('class/admin', 'plugin/freeaddon_banadblock/source');
loadcache('plugin');
$splugin_setting = $_G['cache']['plugin']['freeaddon_banadblock'];
$splugin_lang = lang('plugin/freeaddon_banadblock');
$type1314 = in_array($_GET['type1314'], array('list')) ? $_GET['type1314'] : 'list';
$splugin_setting['0'] = array('0' => '2020012615tUj3X333Jf', '1' => '76747','2' => '1575050982', '3' => 'http://www.yun-ling.cn/', '4' => 'http://www.yun-ling.cn/', '5' => '60DF4F84-4325-8E2C-A68B-78184AFF8D9A', '6' => '87810FE7-AAAE-55ED-A938-30D35972DF05', '7' => '54e5017498ecda3e25e71a5f287b1dc7');
echo '<link href="./source/plugin/freeaddon_banadblock/images/manage.css?'.VERHASH.'" rel="stylesheet" type="text/css" />';

if(!file_exists(DISCUZ_ROOT.'./source/plugin/freeaddon_banadblock/source/admin/admin_log_list.php')){
	cpmsg_error('&#x672C;&#x529F;&#x80FD;&#x9700;&#x8981;&#x5B89;&#x88C5;&#x3010;&#x65E5;&#x5FD7;&#x8BB0;&#x5F55;&#x3011;&#x7EC4;&#x4EF6;&#x624D;&#x80FD;&#x4F7F;&#x7528;', 'action=cloudaddons&id=freeaddon_banadblock.plugin.76748');
}

require_once libfile('admin/log_'.$type1314, 'plugin/freeaddon_banadblock/source');

//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: admin_log.inc.php 1926 2019-11-26 04:51:05Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。