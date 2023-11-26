<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
//if(empty($_G['uid'])) showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
if(empty($rjyfk_url['switch_user']) && !defined('IN_MOBILE')) showmessage(lang('plugin/rjyfk_url', 'Prompt48'));
if($_GET['t']=="error") {
	$urls = $_G['siteurl']."/plugin.php?id=rjyfk_url:url";
	showmessage('&#38750;&#27861;&#25805;&#20316;&#33;',$urls);
	exit;
}
$rj_attention =str_replace("\r\n","<br/>",$rjyfk_url['rj_attention']);
$up_buygroups = splitdata(explode("\r\n",$rjyfk_url['up_buygroups']));
$rj_noticenums = intval($rjyfk_url['rj_noticenums']);//调用数
$rj_notice = explode("\r\n",$rjyfk_url['rj_notice']);
$up_vipgg = intval($rjyfk_url['up_vipgg']);
$up_viptime = intval($rjyfk_url['up_viptime']);
$up_vipts = $rjyfk_url['up_vipts'];
$noteContent = str_replace("","",$rj_notice[0]);
$topname = $rjyfk_url['rj_flname'];
$gmname = $rjyfk_url['rj_gmbt'];
$spcolor = $rjyfk_url['spcolor'];
$zscolor = $rjyfk_url['zscolor'];
$qxcolor = $rjyfk_url['qxcolor'];
$jecolor = $rjyfk_url['jecolor'];
$rj_moneyys = $rjyfk_url['rj_moneyys'];
$usergroup = C::t('common_usergroup')->fetch_all_by_type();
$noticea = array();
foreach($up_buygroups as $k=>$v){
	if($usergroup[intval($v[1])]['groupid']==intval($v[1])){
	    $noticea[$k]['groupname'] = dhtmlspecialchars(trim($v[0]));
		$noticea[$k]['groupid'] = intval($v[1]);
		$noticea[$k]['total_fee'] = intval($v[2]);
		$noticea[$k]['groupenddate'] = intval($v[3]);
		$noticea[$k]['extcredits'] = dhtmlspecialchars(Handle($v[4]));
		$noticea[$k]['postextcredits'] = dhtmlspecialchars(trim($v[4]));
		$noticea[$k]['hot'] = trim($v[5]);
		$noticea[$k]['ince'] = trim($v[6]);//介绍
		$noticea[$k]['img'] = trim($v[7]);//img
		$useids[$v[1]] = $v[7];
	}
}
if($rj_noticenums>0 && $noteContent && $rj_noticenums && !defined('IN_MOBILE')){
	$rj_groupdata = C::t('#rjyfk_url#rjy_log')->fetch_by_group($rj_noticenums);
	if($rj_groupdata){
		foreach($rj_groupdata as $v){
		$hot = "<img src='source/plugin/rjyfk_url/template/img/new.gif'>";
		if($up_viptime){
	   	$noticet .= "<div class='dashed'>".str_replace(array('{datetime}','{username}','{usergroup}'),array(dgmdate($v['paydate'],'u','9999'),$v['username'],dhtmlspecialchars($usergroup[$v['groupid']]['grouptitle'])),$noteContent).$hot.'</div>';
	   }else{
	 	$noticet .= "<div class='dashed'>".str_replace(array('{datetime}','{username}','{usergroup}'),array($up_vipts,$v['username'],dhtmlspecialchars($usergroup[$v['groupid']]['grouptitle'])),$noteContent).$hot.'</div>';
	 	 }
		}
	}else{
		$noticet =  '<div class="dashed">'.lang('plugin/rjyfk_url', 'Prompt54').'</div>';
	}
}
//-------------------------------------------
    $mode="pc";
	if ( ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false  && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') === false)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
        $mode="wap";
        } else {
         $mode="pc";
          }	

    include template('rjyfk_url:url');

//-------------------------------------------
function Handle($data){
	global $_G;
	$nums = 0;
	$result = "";
	$data = explode(",",$data);
	foreach($data as $value){
		$tmpArray = explode(":",$value);
		$m = "";
		$nums++;
		if($nums>1) $m = ", ";
		$result .= $m.$_G['setting']['extcredits'][intval(str_replace('extcredits','',$tmpArray[0]))]['title'].":".$tmpArray[1];
	}
	return $result;
}
function splitdata($data){
	$ret = array();
	foreach($data as $value){
		$tmpArray = explode("||",$value);
		array_push($ret,$tmpArray);
	}
	return $ret;
}