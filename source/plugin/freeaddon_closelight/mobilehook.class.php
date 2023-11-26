<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: mobilehook.class.php 421 2019-11-26 12:38:59Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
if (!defined('IN_DISCUZ')) {
exit('60DF4F84-4325-8E2C-A68B-78184AFF8D9A');
}
class mobileplugin_freeaddon_closelight
{

}
class mobileplugin_freeaddon_closelight_forum extends mobileplugin_freeaddon_closelight
{
    public function forumdisplay_thread_mobile_output()
    {
          require_once libfile('function/core', 'plugin/freeaddon_closelight/source');
          return freeaddon_closelight_fun();
    }
}




//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: mobilehook.class.php 872 2019-11-26 04:38:59Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。