<?php

/**

 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('');
}
define('STUDY_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.dhtmlspecialchars($_GET['identifier']).'&pmod=rewrite');$_statInfo = array();$_statInfo['pluginName'] = $plugin['identifier'];$_statInfo['pluginVersion'] = $plugin['version'];$_statInfo['bbsVersion'] = DISCUZ_VERSION;$_statInfo['bbsRelease'] = DISCUZ_RELEASE;$_statInfo['timestamp'] = TIMESTAMP;$_statInfo['bbsUrl'] = $_G['siteurl'];$_statInfo['SiteUrl'] = $_G['siteurl'];$_statInfo['ClientUrl'] = $_G['siteurl'];$_statInfo['SiteID'] = '';$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
loadcache('plugin');
$ek3m27kg = md5('http://127.0.0.1/');
$xo3exco1 = '';
if($ek3m27kg = $xo3exco1){}
$splugin_setting = $_G['cache']['plugin']['addon_seo_rewrite'];
$splugin_lang = lang('plugin/addon_seo_rewrite');#12747
$type1314 = in_array($_GET['type1314'], array('config', 'icon', 'category', 'slide', 'rewrite', 'seo')) ? $_GET['type1314'] : 'config';
$splugin_setting['0'] = array('0' => '2013090320ikG5iDN5qX', '1' => '62812','2' => '1536123601', '3' => 'http://127.0.0.1/', '4' => 'http://127.0.0.1/', '5' => '', '6' => '', '7' => '');

require_once libfile('include/config', 'plugin/addon_seo_rewrite/source');
