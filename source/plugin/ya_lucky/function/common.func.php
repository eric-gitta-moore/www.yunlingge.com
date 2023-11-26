<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-5-23 16:26
 *      File: common.func.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function yl_lang($key, $vars = array(), $default = null)
{
    return lang('plugin/ya_lucky', $key, $vars, $default);
}

