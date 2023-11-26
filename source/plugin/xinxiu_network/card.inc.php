<?php



if (! defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('function/card', 'plugin/xinxiu_network', false);

$api = new function_card();

switch ($api->action) {
    case 'card_chongzhi':
        $card = $api->safe_check('card', true);
        $api->card_chongzhi($card);
        break;
    default:
        break;
}