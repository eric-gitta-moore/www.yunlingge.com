<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/class/env.class.php';
try {
	$pluginid = 'mdown';
    $pluginPath = mdown_env::get_plugin_path();
    $template = "$pluginid:index";
    include template($template);
} catch (Exception $e) {
    $msg = $e->getMessage();
	showmessage($msg);
}