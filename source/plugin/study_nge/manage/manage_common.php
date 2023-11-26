<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('http://www.ymg6.com/');
}

$pluginvars = array();
foreach(C::t('common_pluginvar')->fetch_all_by_pluginid($pluginid) as $var) {
	if(!strexists($var['type'], '_')) {
		C::t('common_pluginvar')->update_by_variable($pluginid, $var['variable'], array('type' => $var['type'].'_1314'));
	}else{
		$type = explode('_', $var['type']);
		if($type[1] == '1314'){
			$var['type'] = $type[0];
		}else{
			continue;
		}
	}
	$pluginvars[$var['variable']] = $var;
}

if(!submitcheck('editsubmit')) {
    if ($pluginvars) {
    		// $_statInfo = array();$_statInfo['pluginName'] = $plugin['identifier'];$_statInfo['pluginVersion'] = $plugin['version'];$_statInfo['bbsVersion'] = DISCUZ_VERSION;$_statInfo['bbsRelease'] = DISCUZ_RELEASE;$_statInfo['timestamp'] = TIMESTAMP;$_statInfo['bbsUrl'] = $_G['siteurl'];$_statInfo['SiteUrl'] = 'http://www.ymg6.com/';$_statInfo['ClientUrl'] = 'http://127.0.0.1/';$_statInfo['SiteID'] = '0000000000000';$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];$_statInfo['genuine'] = splugin_genuine($plugin['identifier']);
				showformheader(STUDY_MANAGE_URL.'&type1314='.$type1314);
        showtableheader();
       	// echo '<div id="my_addonlist"></div>';
				showtitle($lang['plugins_config']);
        $extra = array();
        $extra = s_showsettings($pluginvars, $pluginvars_array[$type1314]);
        showsubmit('editsubmit');
        showtablefooter();
        showformfooter();
        echo implode('', $extra);
        // echo '<div id="my_addonlist_temp" style="display:none;"><script id="my_addonlist_js" src="http://www.discuz.1314study.com/services.php?mod=product&ac=js&op=manage&timestamp='.$_G['timestamp'].'&info='.base64_encode(serialize($_statInfo)).'&md5check='.md5(base64_encode(serialize($_statInfo))).'"></script></div>
				// <script type="text/javascript">$("my_addonlist_js").src= "";$("my_addonlist").innerHTML = $("my_addonlist_temp").innerHTML;</script>';
    }
}else {
	// 入库前处理
    $postdata = daddslashes(dstripslashes($_POST['varsnew']));
	if (is_array($postdata)) {
    foreach ($postdata as $variable => $value) {
        if(isset($pluginvars[$variable])) {
			if($pluginvars[$variable]['type'] == 'number') {
				$value = (float)$value;
			} elseif(in_array($pluginvars[$variable]['type'], array('forums', 'groups', 'selects'))) {
				$value = addslashes(serialize($value));
			}
			DB::query("UPDATE ".DB::table('common_pluginvar')." SET value='$value' WHERE pluginid='$pluginid' AND variable='$variable'");
		}
      }
    }
    updatecache(array('plugin', 'setting', 'styles'));
    cpmsg('plugins_setting_succeed', 'action='.STUDY_MANAGE_URL.'&type1314='.$type1314, 'succeed');
}

?>