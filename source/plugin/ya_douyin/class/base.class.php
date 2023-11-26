<?php

/**
 * 	[【云猫】抖音解析视频(ya_douyin)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-10-26 21:50
 *      File: base.class.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_ya_douyin_base
{

    protected $has_douyin = false;

    protected function _get_header_mate()
    {
	$mate = '';
	if ($this->has_douyin) {
	    if (!function_exists('ydy_get_mate')) {
		include template('ya_douyin:module');
	    }
	    $mate = ydy_get_mate();
	}
	return $mate;
    }

}

?>