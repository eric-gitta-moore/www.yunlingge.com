<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']){//游客
	showmessage(lang('plugin/iplus_gezi', 'userlogin'), '', array(), array('login' => true));
}
//showmessage(lang('plugin/iplus_gezi','norebuy'));//free
$aid = intval($_GET['adid']);
$adinfo = DB::fetch_first("SELECT * FROM ".DB::table('iplus_gezi')." WHERE uid=".$_G['uid']." and id='$aid'");
if(!$adinfo){
	showmessage(lang('plugin/iplus_gezi','aderror'));//不存在
}
if($adinfo['lastdate']<TIMESTAMP) showmessage(lang('plugin/iplus_gezi','timeerror'));//已经过期，不能续费
loadcache('plugin');
$vars=$_G['cache']['plugin']['iplus_gezi'];
$styleid=intval($vars['styleid']);
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
	if($_POST['adlong']<=0){
		showmessage(lang('plugin/iplus_gezi','editerror'));//时间有误
	}	
	$data=array();
	$data['dateline']=$_G['timestamp'];
	$_POST['adstyle']=intval($_POST['adstyle']);
	if($_POST['adstyle']!=1&&$_POST['adstyle']!=2){
		showmessage(lang('plugin/iplus_gezi','adstyle_error'));
	}
	if(($_POST['adstyle']==1&&$timetype==3)||($_POST['adstyle']==2&&$timetype==2)){//时长类型不符
		showmessage(lang('plugin/iplus_gezi','adstyle_error'));
	}	
	if($_POST['adstyle']==1){
		$data['lastdate']=86400*$_POST['adlong']+$adinfo['lastdate'];
		$total=$dcredits*$_POST['adlong'];
	}
	if($_POST['adstyle']==2){
		$data['lastdate']=2592000*$_POST['adlong']+$adinfo['lastdate'];
		$total=$mcredits*$_POST['adlong'];
	}
	if($total<=0||$total>$jf) showmessage(lang('plugin/iplus_gezi','crediterror'));//积分有误
	$data['status']=0;
	updatemembercount($_G['uid'], array($vars['credits']=>-$total),true,'',$_G['uid'],lang('plugin/iplus_gezi','appname').lang('plugin/iplus_gezi','adrebuy'),lang('plugin/iplus_gezi','appname').lang('plugin/iplus_gezi','adrebuy'),lang('plugin/iplus_gezi','appname').lang('plugin/iplus_gezi','adrebuy'));
	DB::update('iplus_gezi',$data,array('id'=>$aid));
	updateadlist();
	showmessage(lang('plugin/iplus_gezi','buy1').date('Y-m-d H:i:s',$adinfo['dateline']).'-'.date('Y-m-d H:i:s',$data['lastdate']).lang('plugin/iplus_gezi', 'buy2').$total.lang('plugin/iplus_gezi', 'buy3').$jfname, dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' =>20));		
}else{
	if(file_exists(DISCUZ_ROOT.'./source/plugin/iplus_gezi/lib/font0424.lib.php')) $fonttip=1;
	else $fonttip=0;
	include template("iplus_gezi:rebuy");
}
?>