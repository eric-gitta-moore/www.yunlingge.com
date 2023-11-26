<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if($_GET['act']=='delete'){
	$uid = dintval($_GET['uid']);
	$user = getuserbyuid($uid);
	if(empty($user))cpmsg(plang('vipiderr'), '', 'error');
	if(submitcheck('confirmed')){
		C::t('#dc_vip#dc_vip')->delete($uid);
		cpmsg(plang('delok'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=user', 'succeed');
	}
	cpmsg(plang('deletechk'),'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=user&act=delete&uid='.$uid,'form', array('username' => $user['username']));
}
$perpage = 20;
$start = ($page-1)*$perpage;
$vgdata = C::t('#dc_vip#dc_vip_group')->getdata();
$vus = C::t('#dc_vip#dc_vip')->range($start,$perpage,'DESC');
$count = C::t('#dc_vip#dc_vip')->count();
$uids = array();
foreach($vus as $v)$uids[]=$v['uid'];
$user = C::t('common_member')->fetch_all($uids);
showtableheader(plang('vipuser'), '');
showsubtitle(array(plang('username'),plang('isend'), plang('viplevel'),plang('growth'),plang('timejoin'),plang('caozuo')));
foreach($vus as $v){
	showtablerow('', array(), array(
		'<a href="home.php?mod=space&uid='.$v['uid'].'" target="_blank">'.$user[$v['uid']]['username'].'</a>',
		'<img src="source/plugin/dc_vip/images/common/'.(TIMESTAMP<$v['exptime']?'vip.gif':'novip.gif').'">',
		'<img src="source/plugin/dc_vip/images/icon/'.($vgdata[$v['vgid']]['icon']&&TIMESTAMP<$v['exptime']?$vgdata[$v['vgid']]['icon']:'novip.gif').'">',
		
		$v['growth'],
		dgmdate($v['jointime'], 'dt'),
		'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=search&act=update&uid='.$v['uid'].'">'.plang('edit').'</a> [<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=user&act=delete&uid='.$v['uid'].'"><font color="#FF0000">'.plang('delete').'</font></a>]')
	);
}
$mpurl = ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=user';
$multipage = multi($count, $perpage, $page, $mpurl);
showsubmit('', '', '', '', $multipage);
showtablefooter();
function plang($str) {
	return lang('plugin/dc_vip', $str);
}
?>