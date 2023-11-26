<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Version: 0.1
 * 	Date: 2019-5-20 16:29
 *      File: mlucky.class.php
 *      Desc: 手机版嵌入点功能
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('base.class', 'plugin/ya_lucky/class');

class mobileplugin_ya_lucky extends plugin_ya_lucky_base
{

    public function __construct()
    {
        parent::__construct();
    }

}

class mobileplugin_ya_lucky_forum extends mobileplugin_ya_lucky
{

    public function post_ya_lucky_message($params)
    {
        global $_G, $displayorder, $pinvisible;

        list($message, $forword_url, $thread) = $params['param'];

        if ($this->ya_setting['is_open'] && $this->allow_group && $this->allow_fid && in_array($message, $this->trigger) && $displayorder != self::THREAD_DISPLAYORDER && $pinvisible != self::POST_INVISIBLE && $thread['pid']) {
            return $this->_run_lukcy_post($thread['tid'], $thread['pid']);
        }

        return true;
    }

    public function misc_ya_lucky_message($params)
    {
        global $_G;

        list($message) = $params['param'];
        if ($this->ya_setting['is_open'] && $this->allow_group && $this->allow_fid && $_GET['action'] == 'pubsave' && in_array($message, $this->trigger)) {
            return $this->_run_lukcy_post($_G['forum_thread']['tid'], self::EMPTY_PID);
        }

        return true;
    }

}

?>