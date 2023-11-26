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
    $imgs = array(
        "static/image/common/logom.png",
        "static/image/magic/bump.gif",
        "static/image/magic/bgimage.gif",
        "static/image/magic/call.gif",
        "static/image/magic/detector.gif",
        "static/image/magic/coupon.gif",
        "static/image/magic/hot.gif",
        "static/image/magic/ysk.gif",
        "static/image/magic/updateline.gif",
        "static/image/magic/thunder.gif",
        "static/image/magic/anonymous.gif",
        "static/image/task/email.gif",
        "static/image/task/gift.gif",
        "static/image/task/gold.gif",
    );
    $params['sysimgs'] = array();
    foreach ($imgs as $img) {
        $file = DISCUZ_ROOT."/$img";
        if (is_file($file)) $params['sysimgs'][] = $tplVars["siteurl"]."/$img";
    }
    mdown_utils::loadtpl(dirname(__FILE__).'/template/views/z_resource.tpl', $params, $tplVars);
} catch (Exception $e) {
    cpmsg($e->getMessage(),null,'error');
}