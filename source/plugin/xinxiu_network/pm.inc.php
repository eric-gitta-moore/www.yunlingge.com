<?php

if (! defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('function/pm', 'plugin/xinxiu_network', false);

$api = new function_pm();

switch ($api->action) {
    case 'pm_send':
        $msgto = $api->safe_check('msgto', true);
        $message = $api->safe_check('message', true);
        $api->pm_send($msgto,$message);
        break;
    case 'pm_checknew':
        $api->pm_checknew();
        break;
    default:
        break;
}