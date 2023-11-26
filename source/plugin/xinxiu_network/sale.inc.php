<?php

if (! defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('function/sale', 'plugin/xinxiu_network', false);

$api = new function_sale();

switch ($api->action) {
    case 'sale_connt':
        $price = $api->safe_check('price', true);
        $api->sale_connt($price);
        break;
    case 'sale_buy':
        $int = $api->safe_check('int', true);
        $price = $api->safe_check('price', true);
        $api->sale_buy($int,$price);
        break;
    case 'sale_ls':
        $do = $api->safe_check('do', false);
        $api->sale_ls($do);
        break;
    case 'sale_credits_bank':
        $price = $api->safe_check('price', true);
        $api->sale_credits_bank($price);
        break;
    case 'sale_credits_ls':
        $api->sale_credits_ls();
        break;
    case 'sale_credits_remit':
        $int = $api->safe_check('int', true);
        $admintext = $api->safe_check('admintext', false);
        $api->sale_credits_remit($int,$admintext);
        break;
    default:
        break;
}