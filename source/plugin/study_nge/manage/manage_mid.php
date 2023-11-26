<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
//This is NOT a freeware, use is subject to license terms
//From www.1314study.com
//应用售后问题：http://www.discuz.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('http://www.ymg6.com/');
}
$pluginvars = array();
foreach(C::t('common_pluginvar')->fetch_all_by_pluginid($pluginid) as $var) {
if(!strexists($var['type'], '_')) {
C::t('common_pluginvar')->update_by_variable($pluginid, $var['variable'], array('type' => $var['type'].'_1314'));/*1.3.1.4.学.习.网*/
}else{
$type = explode('_', $var['type']);
if($type[1] == '1314'){
$var['type'] = $type[0];#版权：www.1314study.com
}else{
continue;
}
}
$pluginvars[$var['variable']] = $var;#1.3.1.4.学.习.网
}/*1.3.1.4.学.习.网*/
$mid = $_GET['mid'] ? trim($_GET['mid']) : $pluginvars_array['modules'][$type1314][0][1];#1314学习网
if($mid){
if(strlen($mid) > 40 || !ispluginkey($mid) || !isset($pluginvars_array['mid'][$mid])) {
cpmsg('&#x6A21;&#x5757;'.$mid.'&#x4E0D;&#x5B58;&#x5728;&#x6216;&#x4E0D;&#x5408;&#x6CD5;', '', 'error');#版权：1314学习网，未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权
}
if(!submitcheck('editsubmit')) {
if ($pluginvars) {
showformheader(STUDY_MANAGE_URL.'&type1314='.$type1314.'&mid='.$mid);//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权
study_subtitle($pluginvars_array['modules'][$type1314],$type1314,$mid);
showtableheader();
//showtitle($lang['plugins_config']);
$extra = array();
$extra = s_showsettings($pluginvars,$pluginvars_array['mid'][$mid]);//From www.1314study.com
showsubmit('editsubmit');
showtablefooter();
showformfooter();
echo implode('', $extra);//版权：1314学习网，未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权
}
}else {
// 入库前处理
$postdata = daddslashes(dstripslashes($_POST['varsnew']));
$_1jt1o2d = "From www.1314study.com";
if (is_array($postdata)) {
foreach ($postdata as $variable => $value) {
if(isset($pluginvars[$variable])) {
if($pluginvars[$variable]['type'] == 'number') {
$value = (float)$value;
} elseif(in_array($pluginvars[$variable]['type'], array('forums', 'groups', 'selects'))) {
$value = addslashes(serialize($value));
$gqzb5_o7 = "版权：www.1314study.com";
}/*www_discuz_1314study_com*/
DB::query("UPDATE ".DB::table('common_pluginvar')." SET value='$value' WHERE pluginid='$pluginid' AND variable='$variable'");
}#版权：www.1314study.com
}
}/*1314学习网*/
s_updatecache($mid);
$nrovhkb1 = "1.3.1.4.学.习.网";
updatecache(array('plugin', 'setting', 'styles'));/*From www.1314study.com*/
cpmsg('plugins_setting_succeed', 'action='.STUDY_MANAGE_URL.'&type1314='.$type1314.'&mid='.$mid, 'succeed');
}#本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权
}else{
cpmsg('&#x53C2;&#x6570;&#x4E0D;&#x5408;&#x6CD5;&#xFF0C;&#x8BF7;&#x5230;www.1314study.com&#x53CD;&#x9988;', '', 'error');
}
$yoyarv9z = "版权：www.1314study.com";
$yoyarv9z = "版权：www.1314study.com";


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: manage_mid.php 3650 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。