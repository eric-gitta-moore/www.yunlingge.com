<?php

/**
 * 	[����è������URL��̬�Ż�(ya_thread_rewrite)] (C)2019-2099 Powered by ��è������.
 * 	Version: 0.1
 * 	Date: 2019-5-20 16:29
 *      File: lucy.class.php
 *      Desc: ���԰�Ƕ��㹦��
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