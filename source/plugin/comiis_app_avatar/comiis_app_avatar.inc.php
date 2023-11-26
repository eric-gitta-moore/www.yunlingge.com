<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if (submitcheck('comiis_submit') && $_G['uid'] && $_GET['formhash'] == FORMHASH) {
    $plugin_id = 'comiis_app_avatar';
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
            if (!function_exists('comiis_app_load_app_avatar_data')) {
                if (!file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis.php')) {
                    return false;
                }
                include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis.php';
            }
            if (!function_exists('comiis_app_load_app_avatar_data')) {
                return false;
            }
            comiis_app_load_app_avatar_data($plugin_id);
            save_syscache($plugin_id . '_up', array('up' => 0));
        }
    }
    if (!file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php')) {
        return false;
    }
    include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php';
    $avatarpath = $_G['setting']['attachdir'];
    $base64 = htmlspecialchars($_GET['str']);
    if (preg_match('/^(data:\\s*image\\/(\\w+);base64,)/', $base64, $result)) {
        $type = $result[2];
        $tmpavatar = $avatarpath . './temp/twt' . time() . '.jpg';
        include DISCUZ_ROOT . './source/plugin/comiis_app_avatar/comiis_app_avatar.fun.php';
    }
}