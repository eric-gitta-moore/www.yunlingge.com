<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

define('PLUGIN_NAME', 'ror_user_vest');

require_once libfile('lib/index', 'plugin/'.PLUGIN_NAME);

$index = new lib_index();

$index->run();