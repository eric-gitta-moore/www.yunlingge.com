<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']) showmessage('not_loggedin', NULL, array(), array('login' => 1));//用户登录校验
$var = $_G['cache']['plugin']['password'];
$user = C::t('#password#password')->fetch($_G['uid']);
if(submitcheck('passwordsubmit',0,$var['code'])){
	if($_GET['newpassword']!=$_GET['newpassword1']) showmessage(lang('plugin/password', '1'));
	if(!$_GET['newpassword']) showmessage(lang('plugin/password', '378'));
	if(!$user){
		$random = random(6);
		$errorlog = dhtmlspecialchars(
			TIMESTAMP."\t".
			$_G['username']."(".$_G['uid'].")\t".
			preg_replace("/^(.{".round(strlen($_GET['newpassword']) / 4)."})(.+?)(.{".round(strlen($_GET['newpassword']) / 6)."})$/s", "\\1***\\3", $_GET['newpassword'])."\t".
			lang('plugin/password', '379')."\t".
			$_G['username']."($_G[uid])\t".
			$_G['clientip']);
		writelog('password', $errorlog);
		C::t('#password#password')->insert(array('uid'=>$_G['uid'],'dateline'=>TIMESTAMP,'update_dateline'=>TIMESTAMP,'passwd_hash'=>$random,'passwd'=>md5(md5(daddslashes($_GET['newpassword'])).$random)));
	}else{
		if(md5(md5(daddslashes($_GET['oldpassword'])).$user['passwd_hash'])!=$user['passwd']&&$user['passwd']) {
			$errorlog = dhtmlspecialchars(
				TIMESTAMP."\t".
				$_G['username']."(".$_G['uid'].")\t".
				preg_replace("/^(.{".round(strlen($_GET['oldpassword']) / 4)."})(.+?)(.{".round(strlen($_GET['oldpassword']) / 6)."})$/s", "\\1***\\3", $_GET['oldpassword'])."\t".
				lang('plugin/password', '380')."\t".
				$_G['username']."($_G[uid])\t".
				$_G['clientip']);
			writelog('password', $errorlog);
			showmessage(lang('plugin/password', '381'));
		}
		$random = random(6);
		$errorlog = dhtmlspecialchars(
			TIMESTAMP."\t".
			$_G['username']."(".$_G['uid'].")\t".
			preg_replace("/^(.{".round(strlen($_GET['newpassword']) / 4)."})(.+?)(.{".round(strlen($_GET['newpassword']) / 6)."})$/s", "\\1***\\3", $_GET['newpassword'])."\t".
			lang('plugin/password', '382')."\t".
			$_G['username']."($_G[uid])\t".
			$_G['clientip']);
		writelog('password', $errorlog);
		C::t('#password#password')->update($_G['uid'],array('update_dateline'=>TIMESTAMP,'passwd_hash'=>$random,'passwd'=>md5(md5(daddslashes($_GET['newpassword'])).$random)));
	}
	showmessage(lang('plugin/password', '383'),dreferer(),array(), array('alert' => 'right', 'locationtime'=> true, 'msgtype' => 2, 'showdialog'=> true, 'showmsg' => true));
}
$seccodecheck = $var['code'];
if(defined('IN_MOBILE')){
	if(CURSCRIPT=='home'){
		dheader('location:plugin.php?id=password');
	}else{
		$navtitle = $var['title'];
		include template('password:password');
	}
}else{
	if(CURSCRIPT=='plugin'){
		dheader('location:home.php?mod=spacecp&ac=plugin&id=password:password');
	}
}
?>