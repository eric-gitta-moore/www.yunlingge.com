<?php

/**
 * 	[【云猫】主题URL静态优化(ya_thread_rewrite)] (C)2019-2099 Powered by 云猫工作室.
 * 	Version: 0.1
 * 	Date: 2019-5-20 16:29
 *      File: lucy.class.php
 *      Desc: 电脑版嵌入点功能
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('base.class', 'plugin/ya_thread_rewrite/class');

class plugin_ya_thread_rewrite extends plugin_ya_thread_rewrite_base
{

    public function __construct()
    {
	parent::__construct();
    }

}

class plugin_ya_thread_rewrite_forum extends plugin_ya_thread_rewrite
{

    public function redirect_forum()
    {
	global $_G;

	$this->_redirect_forum();
    }

}

?>