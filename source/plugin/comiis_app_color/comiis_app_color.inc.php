<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$plugin_id = 'comiis_app_color';
$comiis_upload = 0;
$comiis_info = array();
$comiis_system_config = array();
$comiis_md5file = array();
$siteuniqueid = $_G['setting']['siteuniqueid'] ? $_G['setting']['siteuniqueid'] : C::t('common_setting')->fetch('siteuniqueid');
if (file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php')) {
    include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php';
} else {
    $comiis_upload = 1;
}
if ($_GET['comiis_up_sn'] === 'yes') {
    $comiis_upload = 1;
}
if ($comiis_upload == 1) {
    loadcache($plugin_id . '_up');
    if ($_G['cache'][$plugin_id . '_up']['up'] != 1) {
        save_syscache($plugin_id . '_up', array('up' => 1));
        if (!function_exists('comiis_app_load_app_color_data')) {
            if (!file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis.php')) {
                return false;
            }
            include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis.php';
        }
        if (!function_exists('comiis_app_load_app_color_data')) {
            return false;
        }
        comiis_app_load_app_color_data($plugin_id);
        save_syscache($plugin_id . '_up', array('up' => 0));
    }
}
if (!file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php')) {
    return false;
}
include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php';

require_once DISCUZ_ROOT . './source/plugin/comiis_app_color/language/language.' . currentlang() . '.php';
if (!$_G['uid']) {
    showmessage($comiis_app_color_lang['201'], 'member.php?mod=logging&action=login');
}
$plugin_url = 'plugins&operation=config&do=' . $pluginid . '&identifier=' . $plugin['identifier'];
if (!submitcheck('colorsubmit')) {
    loadcache(array('comiis_app_style', 'plugin'));
    $comiis_app_style = $_G['cache']['comiis_app_style'];
    $navtitle = $_G['cache']['plugin']['comiis_app_color']['name'];
    $comiis_head = array('left' => '', 'center' => $_G['cache']['plugin']['comiis_app_color']['name'], 'right' => '');
    include_once template('comiis_app_color:comiis_home_html');
} else {
    $id = intval($_GET['colorid']);
    $colorid = DB::fetch_first('SELECT id FROM %t WHERE id=\'%d\'', array('comiis_app_style', $id));
    if ($colorid['id'] == $id) {
        $data = DB::fetch_first('SELECT * FROM %t WHERE uid=\'%d\'', array('comiis_app_userstyle', $_G['uid']));
        if ($data['uid'] == $_G['uid']) {
            DB::update('comiis_app_userstyle', array('css' => $id), DB::field('uid', $_G['uid']));
        } else {
            DB::insert('comiis_app_userstyle', array('css' => $id, 'uid' => $_G['uid']));
        }
        dsetcookie('comiis_colorid_u' . $_G['uid'], $id . 's', 86400 * 360);
        showmessage($comiis_app_color_lang['202']);
    } else {
        showmessage($comiis_app_color_lang['203'], 'home.php?mod=space&uid=' . $_G['uid'] . '&do=profile');
    }
}