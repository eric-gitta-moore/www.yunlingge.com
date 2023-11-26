<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-5-27 11:48
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
DROP TABLE IF EXISTS `pre_ya_lucky_event`;
DROP TABLE IF EXISTS `pre_ya_lucky_log`;
DROP TABLE IF EXISTS `pre_ya_lucky_userstat`;
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