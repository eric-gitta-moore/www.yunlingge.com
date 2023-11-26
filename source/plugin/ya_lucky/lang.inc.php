<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-5-20 16:29
 *      File: lang.inc.php
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$ya_plugin = 'ya_lucky';
define('ADMINCPURL', "plugins&operation=config&do={$pluginid}&identifier={$ya_plugin}&pmod=lang");
define('CPMSGURL', "action=" . ADMINCPURL);

loadcache('pluginlanguage_script');

if (!submitcheck('langsubmit')) {

    showformheader(ADMINCPURL);
    showtableheader();
    foreach ($_G['cache']['pluginlanguage_script'][$ya_plugin] as $arr => $item) {
        showsetting($arr, 'lang[' . $arr . ']', $item, 'text', 0, 0);
    }
    showsubmit('langsubmit');
    showtablefooter();
    showformfooter();
} else {

    $cache = DB::result_first("select data from " . DB::table('common_syscache') . " where cname='pluginlanguage_template'");
    $data = unserialize($cache);

    $data[$ya_plugin] = $_GET['lang'];
    C::t('common_syscache')->update('pluginlanguage_template', $data);
    unset($data);

    $cache = DB::result_first("select data from " . DB::table('common_syscache') . " where cname='pluginlanguage_script'");
    $data = unserialize($cache);
    $data[$ya_plugin] = $_GET['lang'];
    C::t('common_syscache')->update('pluginlanguage_script', $data);

    cpmsg('groups_setting_succeed', CPMSGURL, 'succeed');
}
?>