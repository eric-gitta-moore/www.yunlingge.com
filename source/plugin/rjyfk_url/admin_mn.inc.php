<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache("plugin");
$tstile = $scriptlang['rjyfk_url'];
$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
if(submitcheck('submitadd')){
	if(empty($_GET['username']) || empty($_GET['groupid'])) 
	cpmsg($tstile['Prompt39'], 'action=plugins&operation=config&do='.$pluginid.'&pmod=admin_mn', 'error');
	$username = daddslashes(trim($_GET['username']));
	$groupid = intval($_GET['groupid']);
	$uid = C::t('common_member')->fetch_uid_by_username($username);
	if(empty($uid)) 
	cpmsg($tstile['Prompt38'], 'action=plugins&operation=config&do='.$pluginid.'&pmod=admin_mn', 'error');
	$usergroup = C::t('common_usergroup')->fetch_all_by_type();
	if(!$usergroup[$groupid]['grouptitle'])
	cpmsg($tstile['Prompt43'], 'action=plugins&operation=config&do='.$pluginid.'&pmod=admin_mn', 'error');
    //更新数据
	$total_fee = intval($_GET['total_fee']);
	$sdorderno = "mn".date("YmdHis").mt_rand(10000, 99999);
	$days = intval($_GET['groupenddate']);
    $mydata['uid'] = $uid;
	$mydata['username'] = $username;
	$mydata['listtype'] = 2;
	$mydata['groupid'] = $groupid;
	$mydata['groupenddate'] = $days;
	$mydata['sdorderno'] = $sdorderno;
	$mydata['status'] = 5;
	$mydata['paydate'] = TIMESTAMP;
	$mydata['paytime'] = TIMESTAMP;
	$mydata = daddslashes($mydata);
	C::t('#rjyfk_url#rjy_log')->insert($mydata);
	$xrforum = C::t('common_member_field_forum')->fetch($uid);
	$groupterms = dunserialize($xrforum['groupterms']);
	foreach($groupterms['ext'] as $k=>$v){
		$extgroupids[] = intval($k);
	}
	unset($xrforum);
	require_once libfile('function/forum');
	$extarry = array();
	foreach(array_unique(array_merge($extgroupids, array($groupid))) as $extgroupid) {
		if($extgroupid) {
			$extarry[] = $extgroupid;
		}
	}
	$gxxnew = implode("\t", $extarry);
	if($days>0) {
		$groupterms['ext'][$groupid] = ($groupterms['ext'][$groupid] > TIMESTAMP ? $groupterms['ext'][$groupid] : TIMESTAMP) + $days * 86400;
		$gxnew = groupexpiry($groupterms);
		C::t('common_member')->update($uid, array('groupexpiry' => $gxnew, 'extgroupids' => $gxxnew));
		C::t('common_member_field_forum')->update($uid, array('groupterms' => serialize($groupterms)));
	} else {
		C::t('common_member')->update($uid, array('extgroupids' => $gxxnew));
	}
	cpmsg($tstile['cnyinglan_success'], 'action=plugins&operation=config&do='.$pluginid.'&pmod=admin_mn', 'succeed');
}else{
	showtableheader(lang('plugin/rjyfk_url', 'Prompt31'));
	showformheader('plugins&operation=config&do='.$pluginid.'&pmod=admin_mn', 'testhd');
	showsetting( lang('plugin/rjyfk_url', 'Prompt32'),'username','','text','','',lang('plugin/rjyfk_url', 'Prompt42'));
	showsetting( lang('plugin/rjyfk_url', 'Prompt34'),'groupid','','text','','',lang('plugin/rjyfk_url', 'Prompt42'));
	showsetting( lang('plugin/rjyfk_url', 'Prompt35'),'groupenddate','','text','','',lang('plugin/rjyfk_url', 'Prompt40'));
	showsubmit('submitadd');
	showformfooter();
	showtablefooter();
}