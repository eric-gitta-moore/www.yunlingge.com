<?php

/**
 * Copyright 2001-2099 1314 学习.网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: rewrite.inc.php 4365 2019-12-09 02:47:41
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue（备用 http://t.cn/RU4FEnD）
 * 应用售前咨询：QQ 153.26.940
 * 应用定制开发：QQ 64.330.67.97
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com ver 2.0
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('Access Denied');
}
define('STUDY_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.dhtmlspecialchars($_GET['identifier']).'&pmod=rewrite');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   $_statInfo = array();$_statInfo['pluginName'] = $plugin['identifier'];$_statInfo['pluginVersion'] = $plugin['version'];$_statInfo['bbsVersion'] = DISCUZ_VERSION;$_statInfo['bbsRelease'] = DISCUZ_RELEASE;$_statInfo['timestamp'] = TIMESTAMP;$_statInfo['bbsUrl'] = $_G['siteurl'];$_statInfo['SiteUrl'] = 'http://www.yun-ling.cn/';$_statInfo['ClientUrl'] = 'http://www.yun-ling.cn/';$_statInfo['SiteID'] = '60DF4F84-4325-8E2C-A68B-78184AFF8D9A';$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];//  正版： http://t.cn/hbdjxV
loadcache('plugin');
$splugin_setting = $_G['cache']['plugin']['study_seo_sitemap'];
$splugin_lang = lang('plugin/zzbuluo_seo_gidrewrite');
$type1314 = in_array($_GET['type1314'], array('config', 'icon', 'category', 'slide', 'rewrite', 'seo')) ? $_GET['type1314'] : 'config';
$splugin_setting['0'] = array('0' => '2020012206vj7JR8bYYb', '1' => '11950','2' => '1575832284', '3' => 'http://www.yun-ling.cn/', '4' => 'http://www.yun-ling.cn/', '5' => '60DF4F84-4325-8E2C-A68B-78184AFF8D9A', '6' => '87810FE7-AAAE-55ED-A938-30D35972DF05', '7' => 'e04ab8ac0278f39ce4854ee58558801a');/*https://dwz.cn/aF4yHhDG*/
require_once libfile('include/rewrite', 'plugin/study_seo_sitemap/source');

//Copyright 2001-2099 .1314.学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: rewrite.inc.php 4828 2019-12-08 18:47:41
//应用售后问题：http://www.1314study.com/services.php?mod=issue （备用 http://t.cn/EUPqQW1）
//应用售前咨询：QQ 15.3269.40
//应用定制开发：QQ 643.306.797
//本插件为 131.4学习网（www.1314Study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。