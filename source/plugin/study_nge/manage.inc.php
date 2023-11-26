<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('http://www.ymg6.com/');
}
define('STUDY_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.dhtmlspecialchars($_GET['identifier']).'&pmod=manage');//1314学习网
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/manage.func.php';#版权：1314学习网，未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/pluginvar.func.php';
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/setting_default.php';
$splugin_lang = lang('plugin/study_nge');
$type1314 = in_array($_GET['type1314'], array('common','left', 'middle','right','bottom')) ? $_GET['type1314'] : 'common';#1.3.1.4.学.习.网
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


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: manage.inc.php 1834 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。