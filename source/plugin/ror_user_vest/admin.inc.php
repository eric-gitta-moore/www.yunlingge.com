<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

define('PLUGIN_NAME', 'ror_user_vest');

require_once libfile('lib/admin', 'plugin/'.PLUGIN_NAME);

$admin = new lib_admin();

$admin->run();