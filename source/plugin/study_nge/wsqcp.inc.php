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
if(!file_exists(DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php')){
		cpmsg('<b style="color:red;font-size: 20px;">&#x672A;&#x5B89;&#x88C5;&#x3010;&#x5FAE;&#x4FE1;&#x767B;&#x5F55;&#x3011;&#x63D2;&#x4EF6;&#xFF0C;&#x65E0;&#x6CD5;&#x4F7F;&#x7528;&#x3010;&#x5FAE;&#x793E;&#x533A;&#x3011;&#x76F8;&#x5173;&#x529F;&#x80FD;</b>', 'http://www.ymg6.com/gg/addon.php?/?@wechat.plugin');
}

@require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
require_once libfile('function/var', 'plugin/study_nge/source');
echo '<link href="./source/plugin/study_nge/images/manage.css?'.VERHASH.'" rel="stylesheet" type="text/css" />';
echo '<div class="tip_div">&#x4EB2;&#xFF0C;&#x8FD9;&#x91CC;&#x6709;&#x4E13;&#x95E8;&#x4E3A;&#x5FAE;&#x793E;&#x533A;&#x8BBE;&#x8BA1;&#x7684;N&#x683C;&#x54E6;&#xFF1A;<a href="'.ADMINSCRIPT.'?action=cloudaddons&id=zzbuluo_wsq_nge.plugin" style="color: #39F709;text-decoration: underline;">&#x70B9;&#x51FB;&#x4E0B;&#x8F7D;</a><br>
	</div>';
if(submitcheck('submit')) {
	if($_POST['hook_forumdisplay_topBar_status'] == 1){
		$data[] = array('forumdisplay_topBar' => array('plugin' => 'study_nge', 'include' => 'wsq.class.php', 'class' => 'study_nge_api', 'method' => 'forumdisplay_topBar'));
	}else{
		$data[] = array('forumdisplay_topBar' => array('plugin' => 'study_nge'));
	}
	WeChatHook::updateAPIHook($data);
	cpmsg('&#x64CD;&#x4F5C;&#x6210;&#x529F;', "action=plugins&operation=config&do=$pluginid&identifier=study_nge&pmod=wsqcp", 'succeed');
}else{
	$apihook = WeChatHook::getAPIHook('study_nge');
	showtips('&#x63A5;&#x53E3;&#x662F;&#x5426;&#x542F;&#x7528;&#x4EE5; <a href="admin.php?action=plugins&operation=config&identifier=wechat&pmod=api_setting" target="_blank">&#x5FAE;&#x4FE1;&#x767B;&#x5F55;&#x63D2;&#x4EF6;</a> &#x63A5;&#x53E3;&#x83DC;&#x5355;&#x4E2D;&#x7684;&#x72B6;&#x6001;&#x4E3A;&#x51C6;&#xFF0C;&#x4E00;&#x822C;&#x60C5;&#x51B5;&#x5F00;&#x542F;&#x8BBE;&#x7F6E;&#x5373;&#x542F;&#x7528;&#x5BF9;&#x5E94;&#x63A5;&#x53E3;');
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=study_nge&pmod=wsqcp', 'enctype');
	showtableheader('&#x5FAE;&#x793E;&#x533A;&#x63A5;&#x53E3;&#x8BBE;&#x7F6E;');
	s_showsetting('&#x662F;&#x5426;&#x5728;&#x5FAE;&#x793E;&#x533A;&#x5217;&#x8868;&#x9875;&#x9876;&#x90E8;&#x533A;&#x57DF;&#x663E;&#x793A;', 'hook_forumdisplay_topBar_status', (($apihook['forumdisplay']['topBar']['study_nge']['allow'] == 1) ? 1 : 0), 'radio');
	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
}

//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: wsqcp.inc.php 3047 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。