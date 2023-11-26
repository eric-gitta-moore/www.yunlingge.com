<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

const PLUGIN_NAME = 'ror_threadverify';

require_once libfile('lib/admin', 'plugin/'.PLUGIN_NAME);

$admin = new lib_admin();

$admin->run();