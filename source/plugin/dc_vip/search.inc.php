<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<script src="static/js/calendar.js" type="text/javascript"></script>';
if($_GET['act']=='update'){
	$_GET['username'] = daddslashes(trim($_GET['username']));
	$uid = dintval($_GET['uid']);
	if(empty($uid)){
		$user = C::t('common_member')->fetch_by_username($_GET['username']);
	}else{
		$user = getuserbyuid($uid);
	}
	if(empty($user)) cpmsg(plang('searchuser_no_exist'), '', 'error', array('username' => $user['username']));
	C::import('class/vip','plugin/dc_vip',false);
	$vip = new class_vip();
	$uv = $vip->getvipinfo($user['uid'],true);
	if(submitcheck('submit')){
		if(empty($uv)){
			$vgid = C::t('#dc_vip#dc_vip_group')->getvgid();
			$timed = dintval($_GET['time']);
			$time = TIMESTAMP + $timed*86400;
			if($time>2147454847)$time = 2147454847;
			$data = array(
				'uid'=>$user['uid'],
				'jointime'=>TIMESTAMP,
				'exptime'=>$time,
				'vgid'=>$vgid['id'],
				'uptime'=>TIMESTAMP,
				'growth'=>0,
			);
			C::t('#dc_vip#dc_vip')->insert($data,false,true);
		}else{
			$growth = dintval($_GET['growth']);
			$exptime = strtotime($_GET['exptime']) + 86399;
			$vgid = C::t('#dc_vip#dc_vip_group')->getvgid($growth);
			$data = array(
				'exptime'=>$exptime,
				'growth'=>$growth,
				'vgid'=>$vgid['id'],
				'uptime'=>TIMESTAMP,
			);
			C::t('#dc_vip#dc_vip')->update($user['uid'],$data);
		}
		
		cpmsg(plang('setok'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=user', 'succeed');
	}
	showformheader('plugins&operation=config&identifier=dc_vip&pmod=search&act=update');
	if(empty($uv)){
		showtableheader(plang('help_pay'));
		showsetting(plang('username'), 'username', $user['username'], 'text', true);
		showsetting(plang('pay_time'), 'time', '30', 'text','','','');
		showsubmit('submit');
		showtablefooter();
	}else{
		showtableheader(plang('modify_vip_info'));
		showsetting(plang('username'), 'username', $user['username'], 'text', true);
		showsetting(plang('jointime'), 'jointime', dgmdate($uv['jointime'], 'dt'), 'text', true);
		showsetting(plang('exptime'), 'exptime', dgmdate($uv['exptime'], 'd'), 'calendar','','','');
		showsetting(plang('growth'), 'growth', $uv['growth'], 'number');
		showsubmit('submit');
		showformfooter();
		showtablefooter();
	}
	showformfooter();
	dexit();
}
if(submitcheck('search')){
	dheader('location:'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=search&act=update&username='.$_GET['username']);
}
showtableheader(plang('search_vip'));
showformheader('plugins&operation=config&identifier=dc_vip&pmod=search');
showsetting(plang('username'), 'username', '', 'text');
showsubmit('search', 'search');
showformfooter();
showtablefooter();
function plang($str) {
	return lang('plugin/dc_vip', $str);
}
?>