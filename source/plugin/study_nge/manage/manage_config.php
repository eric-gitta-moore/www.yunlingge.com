<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
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
	$operation = '';
	if($pluginvars) {
		// $_statInfo = array();$_statInfo['pluginName'] = $plugin['identifier'];$_statInfo['pluginVersion'] = $plugin['version'];$_statInfo['bbsVersion'] = DISCUZ_VERSION;$_statInfo['bbsRelease'] = DISCUZ_RELEASE;$_statInfo['timestamp'] = TIMESTAMP;$_statInfo['bbsUrl'] = $_G['siteurl'];$_statInfo['SiteUrl'] = 'http://www.ymg6.com/';$_statInfo['ClientUrl'] = 'http://127.0.0.1/';$_statInfo['SiteID'] = '0000000000000';$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];$_statInfo['genuine'] = splugin_genuine($plugin['identifier']);
		showformheader("plugins&operation=config&do=$pluginid");
		showtableheader();
		// echo '<script src="http://www.discuz.1314study.com/services.php?mod=product&ac=js&op=manage&timestamp='.$_G['timestamp'].'&info='.base64_encode(serialize($_statInfo)).'&md5check='.md5(base64_encode(serialize($_statInfo))).'"></script>';
		showtitle($lang['plugins_config']);

		$extra = array();
		foreach($pluginvars as $var) {
			if(strexists($var['type'], '_')) {
				continue;
			}
			$var['variable'] = 'varsnew['.$var['variable'].']';
			if($var['type'] == 'number') {
				$var['type'] = 'text';
			} elseif($var['type'] == 'select') {
				$var['type'] = "<select name=\"$var[variable]\">\n";
				foreach(explode("\n", $var['extra']) as $key => $option) {
					$option = trim($option);
					if(strpos($option, '=') === FALSE) {
						$key = $option;
					} else {
						$item = explode('=', $option);
						$key = trim($item[0]);
						$option = trim($item[1]);
					}
					$var['type'] .= "<option value=\"".dhtmlspecialchars($key)."\" ".($var['value'] == $key ? 'selected' : '').">$option</option>\n";
				}
				$var['type'] .= "</select>\n";
				$var['variable'] = $var['value'] = '';
			} elseif($var['type'] == 'selects') {
				$var['value'] = dunserialize($var['value']);
				$var['value'] = is_array($var['value']) ? $var['value'] : array($var['value']);
				$var['type'] = "<select name=\"$var[variable][]\" multiple=\"multiple\" size=\"10\">\n";
				foreach(explode("\n", $var['extra']) as $key => $option) {
					$option = trim($option);
					if(strpos($option, '=') === FALSE) {
						$key = $option;
					} else {
						$item = explode('=', $option);
						$key = trim($item[0]);
						$option = trim($item[1]);
					}
					$var['type'] .= "<option value=\"".dhtmlspecialchars($key)."\" ".(in_array($key, $var['value']) ? 'selected' : '').">$option</option>\n";
				}
				$var['type'] .= "</select>\n";
				$var['variable'] = $var['value'] = '';
			} elseif($var['type'] == 'date') {
				$var['type'] = 'calendar';
				$extra['date'] = '<script type="text/javascript" src="static/js/calendar.js"></script>';
			} elseif($var['type'] == 'datetime') {
				$var['type'] = 'calendar';
				$var['extra'] = 1;
				$extra['date'] = '<script type="text/javascript" src="static/js/calendar.js"></script>';
			} elseif($var['type'] == 'forum') {
				require_once libfile('function/forumlist');
				$var['type'] = '<select name="'.$var['variable'].'"><option value="">'.cplang('plugins_empty').'</option>'.forumselect(FALSE, 0, $var['value'], TRUE).'</select>';
				$var['variable'] = $var['value'] = '';
			} elseif($var['type'] == 'forums') {
				$var['description'] = ($var['description'] ? (isset($lang[$var['description']]) ? $lang[$var['description']] : $var['description'])."\n" : '').$lang['plugins_edit_vars_multiselect_comment']."\n".$var['comment'];
				$var['value'] = dunserialize($var['value']);
				$var['value'] = is_array($var['value']) ? $var['value'] : array();
				require_once libfile('function/forumlist');
				$var['type'] = '<select name="'.$var['variable'].'[]" size="10" multiple="multiple"><option value="">'.cplang('plugins_empty').'</option>'.forumselect(FALSE, 0, 0, TRUE).'</select>';
				foreach($var['value'] as $v) {
					$var['type'] = str_replace('<option value="'.$v.'">', '<option value="'.$v.'" selected>', $var['type']);
				}
				$var['variable'] = $var['value'] = '';
			} elseif(substr($var['type'], 0, 5) == 'group') {
				if($var['type'] == 'groups') {
					$var['description'] = ($var['description'] ? (isset($lang[$var['description']]) ? $lang[$var['description']] : $var['description'])."\n" : '').$lang['plugins_edit_vars_multiselect_comment']."\n".$var['comment'];
					$var['value'] = dunserialize($var['value']);
					$var['type'] = '<select name="'.$var['variable'].'[]" size="10" multiple="multiple"><option value=""'.(@in_array('', $var['value']) ? ' selected' : '').'>'.cplang('plugins_empty').'</option>';
				} else {
					$var['type'] = '<select name="'.$var['variable'].'"><option value="">'.cplang('plugins_empty').'</option>';
				}
				$var['value'] = is_array($var['value']) ? $var['value'] : array($var['value']);

				$query = C::t('common_usergroup')->range_orderby_credit();
				$groupselect = array();
				foreach($query as $group) {
					$group['type'] = $group['type'] == 'special' && $group['radminid'] ? 'specialadmin' : $group['type'];
					$groupselect[$group['type']] .= '<option value="'.$group['groupid'].'"'.(@in_array($group['groupid'], $var['value']) ? ' selected' : '').'>'.$group['grouptitle'].'</option>';
				}
				$var['type'] .= '<optgroup label="'.$lang['usergroups_member'].'">'.$groupselect['member'].'</optgroup>'.
					($groupselect['special'] ? '<optgroup label="'.$lang['usergroups_special'].'">'.$groupselect['special'].'</optgroup>' : '').
					($groupselect['specialadmin'] ? '<optgroup label="'.$lang['usergroups_specialadmin'].'">'.$groupselect['specialadmin'].'</optgroup>' : '').
					'<optgroup label="'.$lang['usergroups_system'].'">'.$groupselect['system'].'</optgroup></select>';
				$var['variable'] = $var['value'] = '';
			} elseif($var['type'] == 'extcredit') {
				$var['type'] = '<select name="'.$var['variable'].'"><option value="">'.cplang('plugins_empty').'</option>';
				foreach($_G['setting']['extcredits'] as $id => $credit) {
					$var['type'] .= '<option value="'.$id.'"'.($var['value'] == $id ? ' selected' : '').'>'.$credit['title'].'</option>';
				}
				$var['type'] .= '</select>';
				$var['variable'] = $var['value'] = '';
			}

			s_showsetting(isset($lang[$var['title']]) ? $lang[$var['title']] : dhtmlspecialchars($var['title']), $var['variable'], $var['value'], $var['type'], '', 0, isset($lang[$var['description']]) ? $lang[$var['description']] : nl2br(dhtmlspecialchars($var['description'])), dhtmlspecialchars($var['extra']), '', true);
		}
		showsubmit('editsubmit');
		showtablefooter();
		showformfooter();
		echo implode('', $extra);
	}

} else {

	if(is_array($_GET['varsnew'])) {
		foreach($_GET['varsnew'] as $variable => $value) {
			if(isset($pluginvars[$variable])) {
				if($pluginvars[$variable]['type'] == 'number') {
					$value = (float)$value;
				} elseif(in_array($pluginvars[$variable]['type'], array('forums', 'groups', 'selects'))) {
					$value = serialize($value);
				}
				$value = (string)$value;
				C::t('common_pluginvar')->update_by_variable($pluginid, $variable, array('value' => $value));
			}
		}
	}

	updatecache(array('plugin', 'setting', 'styles'));
	cleartemplatecache();
	cpmsg('plugins_setting_succeed', 'action=plugins&operation=config&do='.$pluginid.'&anchor='.$anchor, 'succeed');

}