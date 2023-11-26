<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 577 2019-11-26 12:29:39Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if (!defined('IN_DISCUZ')) {
exit('2020012608poyBwWUhyB');
}
class plugin_freeaddon_forumdisplay_rate
{

}

class plugin_freeaddon_forumdisplay_rate_forum extends plugin_freeaddon_forumdisplay_rate
{
    public function forumdisplay_thread_subject_output()
    {
        require_once libfile('function/core', 'plugin/freeaddon_forumdisplay_rate/source');
        $return = array();
        $return = freeaddon_forumdisplay_rate();
        return $return;
    }
}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1022 2019-11-26 04:29:39Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。