<?php

/**
 * 	[【云猫】抖音解析视频(ya_douyin)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-10-26 21:50
 *      File: uninstall.php
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

C::import('admincp.func', "plugin/{$identifier}/function");
$request_url = str_replace('&step=' . $_GET['step'], '', $_SERVER['QUERY_STRING']);

switch ($_GET['step']) {
    case 'del':
	$sql = <<<EOF

EOF;
	runquery($sql);

	$finish = TRUE;

	break;
    case 'ok':
	$finish = TRUE;
	break;
    default:
	if (empty($_GET['deletedb'])) {
	    if ($_GET['operation'] == 'delete') {
		$plugin_exists = C::t('common_plugin')->fetch($pluginid);
		if (empty($plugin_exists)) {
		    C::t('common_plugin')->insert($plugin);
		}
	    }

	    cpmsg($installlang['delete_data_confirm'], "{$request_url}&step=del", 'form', array(), '', TRUE, ADMINSCRIPT . "?{$request_url}&step=ok");
	}
	break;
}

 ya_rmdir(realpath(DISCUZ_ROOT . "/source/plugin/{$identifier}"));
?>