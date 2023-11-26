<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/class/env.class.php';
try {
    $params = array(
		'ajaxapi' => mdown_env::get_plugin_path()."/index.php?module=admin&action=",
		'navmenu' => array(),
		'formhash' => $_G['formhash'],
	);
    $tplVars = array(
        'siteurl' => mdown_env::get_siteurl(),
        'plugin_path' => mdown_env::get_plugin_path(),
    );
    mdown_utils::loadtpl(dirname(__FILE__).'/template/views/z_downlog.tpl', $params, $tplVars);
} catch (Exception $e) {
    cpmsg($e->getMessage(),null,'error');
}