<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']){//游客
	showmessage(lang('plugin/iplus_gezi', 'userlogin'), '', array(), array('login' => true));
}
loadcache('plugin');
$vars=$_G['cache']['plugin']['iplus_gezi'];
$mcredits=$vars['mcredits'];
$dcredits=$vars['dcredits'];
$timetype=intval($vars['timetype']);
if($timetype<1||$timetype>3) $timetype=1;
$lcredits=$vars['lcredits'];
$jfname=$_G['setting']['extcredits'][$vars['credits']]['title'];
$wzlen=intval($vars['wzlen']);
$mytips=$vars['mytips'];
$jf = getuserprofile('extcredits'.$_G['cache']['plugin']['iplus_gezi']['credits']);

if(submitcheck('applysubmit')){
	require_once libfile('function','plugin/iplus_gezi/');
	if (empty($_POST['links'])||!preg_match("/^(http:|https:)\/\/([0-9a-zA-Z][0-9a-zA-Z-]*\.)+[a-zA-Z]{2,}/", $_POST['links'])){
		showmessage(lang('plugin/iplus_gezi','errorurl'));//链接有误
	}
	if($_POST['adlong']<=0){
		showmessage(lang('plugin/iplus_gezi','editerror'));//时间有误
	}
	if(empty($_POST['title'])){
		showmessage(lang('plugin/iplus_gezi','biaotinoll'));//标题为空
	}	
	$fontarr=array();
	if(file_exists(DISCUZ_ROOT.'./source/plugin/iplus_gezi/lib/font0424.lib.php')){
		@include DISCUZ_ROOT . './source/plugin/iplus_gezi/lib/font0424.lib.php';
	}		
	$data=array();
	$data['style']=serialize($fontarr);
	$data['uid']=intval($_G['uid']);
	$data['username']=addslashes($_G['username']);
	if(substr_count($_POST['title'],'<')||substr_count($_POST['title'],'>')) showmessage(lang('plugin/iplus_gezi','texterror'));
	$data['title']=addslashes(trim($_POST['title']));
	$data['title']=dhtmlspecialchars($data['title']);
	$data['url']=addslashes($_POST['links']);
	$data['dateline']=$_G['timestamp'];
	$_POST['adstyle']=intval($_POST['adstyle']);
	if($_POST['adstyle']!=1&&$_POST['adstyle']!=2){
		showmessage(lang('plugin/iplus_gezi','adstyle_error'));
	}
	if(($_POST['adstyle']==1&&$timetype==3)||($_POST['adstyle']==2&&$timetype==2)){//时长类型不符
		showmessage(lang('plugin/iplus_gezi','adstyle_error'));
	}
	if($_POST['adstyle']==1){
		$data['lastdate']=86400*$_POST['adlong']+$data['dateline'];
		$total=$dcredits*$_POST['adlong'];
	}
	if($_POST['adstyle']==2){
		$data['lastdate']=2592000*$_POST['adlong']+$data['dateline'];
		$total=$mcredits*$_POST['adlong'];
	}
	if($total<=0||$total>$jf) showmessage(lang('plugin/iplus_gezi','crediterror'));//积分有误
	$data['status']=0;
	updatemembercount($_G['uid'], array($vars['credits']=>-$total),true,'',$_G['uid'],lang('plugin/iplus_gezi','appname'),lang('plugin/iplus_gezi','appname'),lang('plugin/iplus_gezi','appname'));
	DB::insert('iplus_gezi',$data);
	updateadlist();
	showmessage(lang('plugin/iplus_gezi','buy1').date('Y-m-d H:i',$data['dateline']).'-'.date('Y-m-d H:i',$data['lastdate']).lang('plugin/iplus_gezi', 'buy2').$total.lang('plugin/iplus_gezi', 'buy3').$jfname, dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' =>20));		
}else{
	if(file_exists(DISCUZ_ROOT.'./source/plugin/iplus_gezi/lib/font0424.lib.php')) $fonttip=1;
	else $fonttip=0;
	include template("iplus_gezi:buy");
}
?>