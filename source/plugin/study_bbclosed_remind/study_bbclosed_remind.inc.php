<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: study_bbclosed_remind.inc.php 745 2019-11-26 12:41:36Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
$splugin_setting = $_G['cache']['plugin']['study_bbclosed_remind'];
if($splugin_setting['study_radio'] && $_GET['formhash'] == $_G['formhash']){
//仅论坛管理员可用
if($_G['adminid'] == '1'){
$settings = array();
$settings['bbclosed'] = 0;
C::t('common_setting')->update_batch($settings);
require_once libfile('function/cache');/*1.3.1.4.学.习.网*/
updatecache('setting');
showmessage('&#x8BBA;&#x575B;&#x5F00;&#x542F;&#x6210;&#x529F;&#xFF01;',dreferer());
}else{
showmessage('&#x4F60;&#x6CA1;&#x6709;&#x6743;&#x9650;&#x4F7F;&#x7528;&#x672C;&#x529F;&#x80FD;');/*www_discuz_1314study_com*/
}//3014
}else{
showmessage('&#x63D2;&#x4EF6;&#x5DF2;&#x5173;&#x95ED;');
}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: study_bbclosed_remind.inc.php 1205 2019-11-26 04:41:36Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。