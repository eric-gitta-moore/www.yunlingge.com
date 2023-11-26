<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/class/env.class.php';
try {
    $m_setting = C::m("#extavatar#extavatar_setting");
    $params = $m_setting->get();
    if (isset($_POST["reset"])) {
        if ($_POST["reset"]==1) {
            $params = array();
        } else {
            foreach ($params as $k => &$v) {
                if (isset($_POST[$k])) $v=$_POST[$k];
            }
        }
        C::t('common_setting')->update("extavatar_config",$params);
        updatecache('setting');
        $landurl = 'action=plugins&operation=config&do='.$pluginid.'&identifier=extavatar&pmod=z_setting';
        cpmsg('plugins_edit_succeed', $landurl, 'succeed');
    }
    $params["errtips"] = array();
    if (!function_exists("imagefttext")) {
        $params['errtips'][] = "can not find function imagefttext";
    }
    $params['ajaxapi'] = extavatar_env::get_plugin_path()."/index.php?version=4&module=";
    $tplVars = array(
        'siteurl' => extavatar_env::get_siteurl(),
        'plugin_path' => extavatar_env::get_plugin_path(),
    );
    extavatar_utils::loadtpl(dirname(__FILE__).'/template/views/z_setting.tpl', $params, $tplVars);
} catch (Exception $e) {
    cpmsg($e->getMessage(),null,'error');
}