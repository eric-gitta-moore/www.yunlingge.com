<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$scripturl = 'plugins&operation=config&identifier='.$plugin['identifier'].'&pmod='.$_GET['pmod'];
if(submitcheck('resetsubmit')){
	$userinfo = DB::fetch_first('SELECT * FROM %t WHERE '.($_GET['type']=='uid' ? ('uid='.dintval($_GET['uid'])) : ('username=\''.daddslashes($_GET['uid']).'\'')),array('common_member'));
	if(!$userinfo['uid']) cpmsg_error(lang('plugin/password', '384'));
	$uid = $userinfo['uid'];
	$user = C::t('#password#password')->fetch($uid);
	if(!$user['passwd']) cpmsg_error(lang('plugin/password', '385'));
	if(!$_GET['newpassword']) cpmsg_error(lang('plugin/password', '386'));
	$random = random(6);
	C::t('#password#password')->update($uid,array('update_dateline'=>TIMESTAMP,'passwd_hash'=>$random,'passwd'=>md5(md5(daddslashes($_GET['newpassword'])).$random)));
	$password = preg_replace("/^(.{".round(strlen($_GET['newpassword']) / 4)."})(.+?)(.{".round(strlen($_GET['newpassword']) / 6)."})$/s", "\\1***\\3", $_GET['newpassword']);
	$errorlog = dhtmlspecialchars(
		TIMESTAMP."\t".
		$userinfo['username']."(".$userinfo['uid'].")\t".
		$password."\t".
		lang('plugin/password', '387')."\t".
		$_G['username']."($_G[uid])\t".
		$_G['clientip']);
	writelog('password', $errorlog);
	cpmsg(lang('plugin/password', '388'),dreferer(),'succeed');
}
showformheader($scripturl);
showtableheader();
showsetting(lang('plugin/password', '389'),'uid','','text','','',lang('plugin/password', '390'));
showsetting(lang('plugin/password', '391'),array('type',array(array('uid','UID'),array('username',lang('plugin/password', '392')))),'','select');
showsetting(lang('plugin/password', '393'),'newpassword','','text');
showsubmit('resetsubmit');
showtablefooter();
showformfooter();
?>