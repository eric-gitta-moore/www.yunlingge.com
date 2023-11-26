<?php

if (! defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('function/friends', 'plugin/xinxiu_network', false);

$api = new function_friends();

switch ($api->action) {
    case 'friend_add':
        $fuid = $api->safe_check('fuid', true);
        $note = $api->safe_check('note', false);
        $gid = $api->safe_check('gid', false);
        $api->friends_add($fuid,$note,$gid);
        break;
    case 'friends_request':
        $api->friends_request();
        break;
    case 'friends_ls':
        $api->friends_ls();
        break;
    case 'friends_add_uid':
        $fuid = $api->safe_check('fuid', true);
        $api->friends_add_uid($fuid);
        break;
    case 'friends_delete':
        $fuid = $api->safe_check('fuid', true);
        $api->friends_delete($fuid);
        break;
    default:
        break;
}