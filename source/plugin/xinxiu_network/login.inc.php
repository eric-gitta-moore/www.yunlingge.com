<?php


if (! defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('function/login', 'plugin/xinxiu_network', false);

$api = new function_login();

switch ($api->action) {
    case 'login_user':
        $username = $api->safe_check('username', true);
        $password = $api->safe_check('password', true);
        $questionid = $api->safe_check('questionid', false);
        $answer = $api->safe_check('answer', false);
        $isuid = $api->safe_check('isuid', false);
        $api->login_user($username,$password,$questionid,$answer,$isuid);
        break;
    case 'login_config':
        $plugin = $api->safe_check('plugin', false);
        $api->login_config($plugin);
        break;
    case 'login_register':
        $username = $api->safe_check('username', true);
        $password = $api->safe_check('password', true);
        $email = $api->safe_check('email', true);
        $invite = $api->safe_check('invite', false);
        $api->login_register($username,$password,$email,$invite);
        break;
    case 'key':
        $api->key();
        break;
    default:
        break;
}



