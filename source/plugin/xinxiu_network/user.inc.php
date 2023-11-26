<?php

if (! defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('function/user', 'plugin/xinxiu_network', false);

$api = new function_user();

switch ($api->action) {
    case 'user_info':
        $api->user_info();
        break;
    case 'user_avatar':
        $size = $api->safe_check('size', false);
        $api->user_avatar($size);
        break;
    case 'user_count':
        $api->user_count();
        break;
    case 'user_credist':
        $int = $api->safe_check('int', true);
        $ruletxt = $api->safe_check('ruletxt', false);
        $customtitle = $api->safe_check('customtitle', false);
        $custommemo = $api->safe_check('custommemo', false);
        $api->user_credist($int,$ruletxt,$customtitle,$custommemo);
        break;
    case 'user_uc_pm_send':
        $msgto = $api->safe_check('msgto', true);
        $message = $api->safe_check('message', true);
        $api->user_uc_pm_send($msgto,$message);
        break;
    case 'user_getsafe':
        $safe = $api->safe_check('safe', true);
        $api->user_getsafe($safe);
        break;
    case 'user_setsafe':
        $newsafe = $api->safe_check('newsafe', true);
        $oldsafe = $api->safe_check('oldsafe', false);
        $api->user_setsafe($newsafe,$oldsafe);
        break;
    case 'user_get_kz':
        $int = $api->safe_check('int', true);
        $api->user_get_kz($int);
        break;
    case 'user_set_kz':
        $int = $api->safe_check('int', true);
        $kz = $api->safe_check('kz', true);
        $api->user_set_kz($int,$kz);
        break;
    default:
        break;
}