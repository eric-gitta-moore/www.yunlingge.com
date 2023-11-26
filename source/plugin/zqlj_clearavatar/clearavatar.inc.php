<?php
/*
 * 主页：http://addon.dismall.com/?@72763.developer
 * 苏州众器良匠网络科技有限公司 出品
 * 插件定制 联系QQ281688302
 */
 
if(!defined('IN_DISCUZ')) exit('Access Denied');
loadcache('plugin');
$vars = $_G['cache']['plugin']['zqlj_clearavatar'];
//free
if(!$_G['uid']||$_G['groupid']!=1) showmessage('zqlj_clearavatar:op_noright');
$clearuid=intval($_GET['clearuid']);
$op_uid=$_G['uid'];
if(empty($clearuid)||empty($op_uid)) showmessage('zqlj_clearavatar:op_error');
if(submitcheck('clearavatar_yes')||(intval($_GET['inmobile'])==1&&$_GET['formhash']==formhash())){
	clearavatarAction($clearuid);
	$msg=trim($vars['msg']);
	if($msg) notification_add($clearuid,'system',$msg);
	$reurl='home.php?mod=space&uid='.$clearuid;
	showmessage('zqlj_clearavatar:op_success',$reurl, array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' =>20));
}else{
	include(template('zqlj_clearavatar:clearavatar'));
}

function clearavatarAction($uid){
	global $_G;
	loaducenter();
	$tableext = '';
	$member = C::t('common_member')->fetch($uid, false, 1);
	if($member){
		$tableext = isset($member['_inarchive']) ? '_archive' : '';
		C::t('common_member'.$tableext)->update($member['uid'], array('avatarstatus'=>0));
		uc_user_deleteavatar($uid);
		C::t('common_member')->clear_cache($member['uid']);	
		DB::insert('zqlj_clearavatar_logs',array(
			'opuid'=>$_G['uid'],
			'opusername'=>$_G['username'],
			'uid'=>$member['uid'],
			'username'=>$member['username'],
			'dateline'=>TIMESTAMP,
		));
	}
}
?>