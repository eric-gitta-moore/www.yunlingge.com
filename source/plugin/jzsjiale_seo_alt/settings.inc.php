<?php
/*
 * CopyRight  : [xhkj5.com!] (C)2014-2016
 * Document   : 讯幻网：www.xhkj5.com，www.xhkj5.com
 * Created on : 2016-01-06,09:53:15
 * Author     : 讯幻网(QQ：154606914) wWw.xhkj5.com $
 * Description: This is NOT a freeware, use is subject to license terms.
 *              讯幻网出品 必属精品。
 *              讯幻网 全网首发 http://www.xhkj5.com；
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$act = $_GET['act'];
global $_G, $lang;

$utilsfile = DISCUZ_ROOT.'./source/plugin/jzsjiale_seo_alt/utils.class.php';
require_once $utilsfile;
$utils = 'utils';

if($act=='add'){
	if(submitcheck('submit')){
	
		$setting = $_GET['setting'];
		$dsetting = array('dateline'=>TIMESTAMP);
		$dsetting['titlename'] = addslashes(trim($setting['titlename']));
		$dsetting['isopen'] = addslashes(trim($setting['isopen']));
		$dsetting['targets'] = json_encode($setting['targets']);
		$dsetting['huifu'] = addslashes(trim($setting['huifu']));
		$dsetting['alt'] = addslashes(trim($setting['alt']));
		$dsetting['title'] = addslashes(trim($setting['title']));
		$dsetting['isoverridealt'] = addslashes(trim($setting['isoverridealt']));
		$dsetting['isoverridetitle'] = addslashes(trim($setting['isoverridetitle']));
		$dsetting['istags'] = addslashes(trim($setting['istags']));
		$dsetting['starttime'] = addslashes($setting['starttime']) ? strtotime(addslashes($setting['starttime'])) : 0;
		$dsetting['endtime'] = addslashes($setting['endtime']) ? strtotime(addslashes($setting['endtime'])) : 0;	
		$dsetting['fids'] =  json_encode($setting['fids']);
		$dsetting['usergroup'] = json_encode($setting['groupid']);
		
		
		if(empty($dsetting['titlename'])){
			cpmsg('jzsjiale_seo_alt:settingnotitlename', '', 'error');
		}elseif(strlen($dsetting['titlename']) > 50) {
			cpmsg('jzsjiale_seo_alt:setting_titlename_more', '', 'error');
		}
		
		if(!empty($dsetting['starttime']) && !empty($dsetting['endtime'])) {
			if($dsetting['endtime'] <= TIMESTAMP || $dsetting['endtime'] <= $dsetting['starttime']) {
				cpmsg('jzsjiale_seo_alt:setting_endtime_invalid', '', 'error');
			}
		}
		if($setting['targets'] == NULL || empty($setting['targets'])){
			cpmsg('jzsjiale_seo_alt:settingnotargets', '', 'error');
		}
		
		
		
		if(C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->insert($dsetting,true)){
			cpmsg('jzsjiale_seo_alt:addok', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings', 'succeed');
		}else{
			cpmsg('jzsjiale_seo_alt:error', '', 'error');
		}
	}
	
	echo '<div class="colorbox"><h4>'.plang('aboutsettings').'</h4>'.
		 '<table cellspacing="0" cellpadding="3"><tr>'.
	     '<td valign="top">'.plang('settingsdescription').'</td></tr></table>'.
		 '<div style="width:95%" align="right">'.plang('copyright').'</div></div>';
	
	echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
	
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=add', 'enctype');
	showtableheader(plang('addsettingtitle'), '');
	showsetting(plang('settingtitlename'),'setting[titlename]','','text','','',plang('settingtitlename_msg'));
	showsetting(plang('settingisopen'),'setting[isopen]','1','radio','','',plang('settingisopen_msg'));
	showsetting(plang('settingtargets'), array('setting[targets]', array(
		array('1', plang('settingtargetspc')),
		array('2', plang('settingtargetswsq')),
		array('3', plang('settingtargetsmobile')),
	)), array('1','2','3'), 'mcheckbox');
	showsetting(plang('settinghuifu'),'setting[huifu]','1','radio','','',plang('settinghuifu_msg'));
	showsetting(plang('settingalt'),'setting[alt]','hello %title %imgdesc %tags %forum %name','text','','',plang('settingalt_msg'),'','settingalt');
	showsetting(plang('settingtitle'),'setting[title]','hello %title %imgdesc %tags %forum %name','text','','',plang('settingtitle_msg'),'','settingtitle');
	
	showsetting(plang('settingisoverridealt'),'setting[isoverridealt]','1','radio','','',plang('settingisoverridealt_msg'));
	showsetting(plang('settingisoverridetitle'),'setting[isoverridetitle]','1','radio','','',plang('settingisoverridetitle_msg'));
	showsetting(plang('settingistags'),'setting[istags]','0','radio','','',plang('settingistags_msg'));
	
	showsetting(plang('settingstarttime'),'setting[starttime]','','calendar','',0,plang('settingstarttime_msg'),1,'settingstarttime');
	showsetting(plang('settingendtime'),'setting[endtime]','','calendar','',0,plang('settingendtime_msg'),1,'settingendtime');


	if(class_exists($utils)) {
		$utils = new $utils();
		$utilssetting = $utils->getsetting();
		if(is_array($utilssetting)) {
			foreach($utilssetting as $settingvar => $setting) {
				if(!empty($setting['value']) && is_array($setting['value'])) {
					foreach($setting['value'] as $k => $v) {
						$setting['value'][$k][1] = plang($setting['value'][$k][1]);
					}
				}
				$varname = in_array($setting['type'], array('mradio', 'mcheckbox', 'select', 'mselect')) ?
				($setting['type'] == 'mselect' ? array('setting['.$settingvar.'][]', $setting['value']) : array('setting['.$settingvar.']', $setting['value']))
				: 'setting['.$settingvar.']';
				
				$comment = plang($setting['comment']);
				showsetting(plang($setting['title']).':', $varname, '', $setting['type'], '', 0, $comment);
			}
		}
	}
	//--
	$groupselect = array();
	//$query = C::t('common_usergroup')->fetch_all_not(array(6, 7), true);
	$query = C::t('common_usergroup')->fetch_all_not(array(), true);
	foreach($query as $group) {
		$group['type'] = $group['type'] == 'special' && $group['radminid'] ? 'specialadmin' : $group['type'];
		$groupselect[$group['type']] .= "<option value=\"$group[groupid]\" ".(in_array($group['groupid'], $usergroupid) ? 'selected' : '').">$group[grouptitle]</option>\n";
	}
	$groupselect = '<optgroup label="'.$lang['usergroups_member'].'">'.$groupselect['member'].'</optgroup>'.
		($groupselect['special'] ? '<optgroup label="'.$lang['usergroups_special'].'">'.$groupselect['special'].'</optgroup>' : '').
		($groupselect['specialadmin'] ? '<optgroup label="'.$lang['usergroups_specialadmin'].'">'.$groupselect['specialadmin'].'</optgroup>' : '').
		'<optgroup label="'.$lang['usergroups_system'].'">'.$groupselect['system'].'</optgroup>';
	
	showsetting(plang('settingusergroupstitle'), '', '', '<select name="setting[groupid][]" multiple="multiple" size="10">'.$groupselect.'</select>', '', 0, plang('settingusergroupscomment'));
	

	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
	
	
	dexit();
}elseif($act=='delete'){
	$id = dintval($_GET['id']);
	$setting = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->fetch($id);
	if(empty($setting))
		cpmsg('jzsjiale_seo_alt:empty', '', 'error');
	if(submitcheck('submit')){
		C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->delete($id);
		cpmsg('jzsjiale_seo_alt:delok', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings', 'succeed');
	}
	cpmsg('jzsjiale_seo_alt:delsetting','action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=delete&id='.$id.'&submit=yes','form',array('titlename' => $setting['titlename']));
}elseif($act=='details'){
	$id = dintval($_GET['id']);
	$setting = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->fetch($id);
	if(empty($setting))
		cpmsg('jzsjiale_seo_alt:empty', '', 'error');
	$utils = new $utils();
	echo "<strong>".plang("settingtitlename").":</strong>".$setting['titlename']."<br/>"
		 ."<strong>".plang("settingisopen").":</strong>".($setting['isopen']?plang('yes'):plang('no'))."<br/>"
		 ."<strong>".plang("settingtargets").":</strong>".$utils->gettargetsname(json_decode($setting['targets']))."<br/>"
		 ."<strong>".plang("settinghuifu").":</strong>".($setting['huifu']?plang('yes'):plang('no'))."<br/>"
		 ."<strong>".plang("settingalt").":</strong>".$setting['alt']."<br/>"
	     ."<strong>".plang("settingtitle").":</strong>".$setting['title']."<br/>"
	     ."<strong>".plang("settingisoverridealt").":</strong>".($setting['isoverridealt']?plang('yes'):plang('no'))."<br/>"
	     ."<strong>".plang("settingisoverridetitle").":</strong>".($setting['isoverridetitle']?plang('yes'):plang('no'))."<br/>"
	     ."<strong>".plang("settingistags").":</strong>".($setting['istags']?plang('yes'):plang('no'))."<br/>"
		 ."<strong>".plang("settingfidstitle").":</strong>".$utils->getforumsname(null,json_decode($setting['fids']),true)."<br/>"
		 ."<strong>".plang("settingusergroupstitle").":</strong>".$utils->getusergroupname(null,json_decode($setting['usergroup']),true)."<br/>"
		 ."<strong>".plang("settingstarttime").":</strong>".dgmdate($setting['starttime'])."<br/>"
		 ."<strong>".plang("settingendtime").":</strong>".dgmdate($setting['endtime'])."<br/>"
		 ."<strong>".plang("ddateline").":</strong>".dgmdate($setting['dateline'])."<br/>";
	dexit();
}elseif($act=='edit'){
	$id = dintval($_GET['id']);
	$setting = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->fetch($id);
	if(empty($setting))
		cpmsg('jzsjiale_seo_alt:empty', '', 'error');
	if(submitcheck('submit')){
	    $setting = $_GET['setting'];
		$dsetting = array('dateline'=>TIMESTAMP);
		$dsetting['titlename'] = addslashes(trim($setting['titlename']));
		$dsetting['isopen'] = addslashes(trim($setting['isopen']));
		$dsetting['targets'] = json_encode($setting['targets']);
		$dsetting['huifu'] = addslashes(trim($setting['huifu']));
		$dsetting['alt'] = addslashes(trim($setting['alt']));
		$dsetting['title'] = addslashes(trim($setting['title']));
		$dsetting['isoverridealt'] = addslashes(trim($setting['isoverridealt']));
		$dsetting['isoverridetitle'] = addslashes(trim($setting['isoverridetitle']));
		$dsetting['istags'] = addslashes(trim($setting['istags']));
		$dsetting['starttime'] = addslashes($setting['starttime']) ? strtotime(addslashes($setting['starttime'])) : 0;
		$dsetting['endtime'] = addslashes($setting['endtime']) ? strtotime(addslashes($setting['endtime'])) : 0;	
		$dsetting['fids'] =  json_encode($setting['fids']);
		$dsetting['usergroup'] = json_encode($setting['groupid']);
		
		
		if(empty($dsetting['titlename'])){
			cpmsg('jzsjiale_seo_alt:settingnotitlename', '', 'error');
		}elseif(strlen($dsetting['titlename']) > 50) {
			cpmsg('jzsjiale_seo_alt:setting_titlename_more', '', 'error');
		}
		
		if(!empty($dsetting['starttime']) && !empty($dsetting['endtime'])) {
			if($dsetting['endtime'] <= TIMESTAMP || $dsetting['endtime'] <= $dsetting['starttime']) {
				cpmsg('jzsjiale_seo_alt:setting_endtime_invalid', '', 'error');
			}
		}
		if($setting['targets'] == NULL || empty($setting['targets'])){
			cpmsg('jzsjiale_seo_alt:settingnotargets', '', 'error');
		}
		
		
		if(C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->update($id,$dsetting)){
			cpmsg('jzsjiale_seo_alt:editok', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings', 'succeed');
		}else{
			cpmsg('jzsjiale_seo_alt:error', '', 'error');
		}
		
	
	}
	echo '<script src="static/js/calendar.js" type="text/javascript"></script>';
	
	echo '<div class="colorbox"><h4>'.plang('aboutsettings').'</h4>'.
			'<table cellspacing="0" cellpadding="3"><tr>'.
			'<td valign="top">'.plang('settingsdescription').'</td></tr></table>'.
			'<div style="width:95%" align="right">'.plang('copyright').'</div></div>';
	
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=edit', 'enctype');
	echo'<input type="hidden" value="'.$setting['id'].'" name="id"/>';
	showtableheader(plang('editsetting'), '');
	
	
	showsetting(plang('settingtitlename'),'setting[titlename]',$setting['titlename'],'text','','',plang('settingtitlename_msg'));
	showsetting(plang('settingisopen'),'setting[isopen]',$setting['isopen'],'radio','','',plang('settingisopen_msg'));
	showsetting(plang('settingtargets'), array('setting[targets]', array(
	array('1', plang('settingtargetspc')),
	array('2', plang('settingtargetswsq')),
	array('3', plang('settingtargetsmobile')),
	)), json_decode($setting['targets']), 'mcheckbox');
	showsetting(plang('settinghuifu'),'setting[huifu]',$setting['huifu'],'radio','','',plang('settinghuifu_msg'));
	showsetting(plang('settingalt'),'setting[alt]',$setting['alt'],'text','','',plang('settingalt_msg'),'','settingalt');
	showsetting(plang('settingtitle'),'setting[title]',$setting['title'],'text','','',plang('settingtitle_msg'),'','settingtitle');
	
	showsetting(plang('settingisoverridealt'),'setting[isoverridealt]',$setting['isoverridealt'],'radio','','',plang('settingisoverridealt_msg'));
	showsetting(plang('settingisoverridetitle'),'setting[isoverridetitle]',$setting['isoverridetitle'],'radio','','',plang('settingisoverridetitle_msg'));
	showsetting(plang('settingistags'),'setting[istags]',$setting['istags'],'radio','','',plang('settingistags_msg'));
	
	showsetting(plang('settingstarttime'),'setting[starttime]',dgmdate($setting['starttime']),'calendar','',0,plang('settingstarttime_msg'),1,'settingstarttime');
	showsetting(plang('settingendtime'),'setting[endtime]',dgmdate($setting['endtime']),'calendar','',0,plang('settingendtime_msg'),1,'settingendtime');
	
	
	if(class_exists($utils)) {
		$utils = new $utils();
		$utilssetting = $utils->getsetting();
		if(is_array($utilssetting)) {
			foreach($utilssetting as $settingvar => $svar) {
				if(!empty($svar['value']) && is_array($svar['value'])) {
					foreach($svar['value'] as $k => $v) {
						$svar['value'][$k][1] = plang($svar['value'][$k][1]);
					}
				}
				$varname = in_array($svar['type'], array('mradio', 'mcheckbox', 'select', 'mselect')) ?
				($svar['type'] == 'mselect' ? array('setting['.$settingvar.'][]', $svar['value']) : array('setting['.$settingvar.']', $svar['value']))
				: 'setting['.$settingvar.']';
				$value = json_decode($setting[$settingvar]) != '' ? json_decode($setting[$settingvar]) : $svar['default'];
				$comment = plang($svar['comment']);
				showsetting(plang($svar['title']).':', $varname, $value, $svar['type'], '', 0, $comment);
			}
		}
	}
	//--
	$groupselect = array();
	//$query = C::t('common_usergroup')->fetch_all_not(array(6, 7), true);
	$query = C::t('common_usergroup')->fetch_all_not(array(), true);
	foreach($query as $group) {
		$group['type'] = $group['type'] == 'special' && $group['radminid'] ? 'specialadmin' : $group['type'];
		$groupselect[$group['type']] .= "<option value=\"$group[groupid]\" ".(in_array($group['groupid'], json_decode($setting['usergroup'])) ? 'selected' : '').">$group[grouptitle]</option>\n";
	}
	$groupselect = '<optgroup label="'.$lang['usergroups_member'].'">'.$groupselect['member'].'</optgroup>'.
		($groupselect['special'] ? '<optgroup label="'.$lang['usergroups_special'].'">'.$groupselect['special'].'</optgroup>' : '').
		($groupselect['specialadmin'] ? '<optgroup label="'.$lang['usergroups_specialadmin'].'">'.$groupselect['specialadmin'].'</optgroup>' : '').
		'<optgroup label="'.$lang['usergroups_system'].'">'.$groupselect['system'].'</optgroup>';
	
	showsetting(plang('settingusergroupstitle'), '', '', '<select name="setting[groupid][]" multiple="multiple" size="10">'.$groupselect.'</select>', '', 0, plang('settingusergroupscomment'));
	
	

	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
	dexit();
}
loadcache('plugin');

$page = intval($_GET['page']);
$page = $page > 0 ? $page : 1;
$pagesize = 15;
$start = ($page - 1) * $pagesize;

$allsettings = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->range($start,$pagesize,'DESC');
$count = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->count();
showtableheader(plang('lesettings').'(  <a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=add" style="color:red;">'.plang('addsetting').'</a>  )', '');
showsubtitle(plang('lesettingstitle'));
$utils = new $utils();

foreach($allsettings as $d){
	showtablerow('', array('width="80"'), array(
	$d['id'],
	'<span title="'.$d['titlename'].'">'.mb_substr($d['titlename'],0,20).'</span>',
	$d['isopen']?plang('yes'):plang('no'),
	'<span title="'.$utils->gettargetsname(json_decode($d['targets'])).'">'.mb_substr($utils->gettargetsname(json_decode($d['targets'])),0,20).'...</span>',
	'<span title="'.$utils->getforumsname(null,json_decode($d['fids']),true).'">'.mb_substr($utils->getforumsname(null,json_decode($d['fids']),true),0,20).'...</span>',
	'<span title="'.$utils->getusergroupname(null,json_decode($d['usergroup']),true).'">'.mb_substr($utils->getusergroupname(null,json_decode($d['usergroup']),true),0,20).'...</span>',
	dgmdate($d['dateline']),
	'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=details&id='.$d['id'].'">'.plang('details').'</a>&nbsp;<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=edit&id='.$d['id'].'">'.plang('edit').'</a>&nbsp;<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings&act=delete&id='.$d['id'].'">'.plang('delete').'</a>')
	);
}

$mpurl = ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=settings';
$multipage = multi($count, $pagesize, $page, $mpurl);
showsubmit('', '', '', '', $multipage);
showtablefooter();

function plang($str) {
	return lang('plugin/jzsjiale_seo_alt', $str);
}
//From:www_xhkj5_com
?>