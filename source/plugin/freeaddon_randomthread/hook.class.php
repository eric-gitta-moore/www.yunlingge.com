<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 740 2020-01-09 11:22:42Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_DISCUZ')) {
exit('2020012607P4fFJ4U80g');
}
require_once libfile('function/core', 'plugin/freeaddon_randomthread/source');
class plugin_freeaddon_randomthread {
		function global_cpnav_extra1(){
				return show_randomthread('global_cpnav_extra1');
		}
		
		function global_cpnav_extra2(){
				return show_randomthread('global_cpnav_extra2');
		}
		
		function global_nav_extra(){
				return show_randomthread('global_nav_extra');
		}

}
class plugin_freeaddon_randomthread_forum extends plugin_freeaddon_randomthread{
		function index_status_extra(){
			 	return show_randomthread('index_status_extra');
		}
		function index_nav_extra(){
			 	return show_randomthread('index_nav_extra');
		}
}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1185 2020-01-09 03:22:42Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。