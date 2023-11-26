<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $_G;
$Search = getgpc('Search');
$rjyfk_invite = $_G['cache']['plugin']['rjyfk_invite'];
if(empty($rjyfk_invite['switch_invite']) && !defined('IN_MOBILE')) showmessage(lang('plugin/rjyfk_invite', 'Prompt3'));
if($_GET['t']=="error") {
	$urls = $_G['siteurl']."/plugin.php?id=rjyfk_invite:in";
	showmessage('&#38750;&#27861;&#25805;&#20316;&#33;',$urls);
	exit;
}

if($rjyfk_invite['uppay_ok']=="1") {
$uid = $_G['uid'];
if($uid) showmessage('rjyfk_invite:Prompt4', '', array(), array('showmsg' => true));
}
$rj_title = $rjyfk_invite['rj_title'];
$rj_attention = $rjyfk_invite['rj_information'];
$op_mail = $rjyfk_invite['switch_mail'];
$rj_money = intval($rjyfk_invite['rj_money']);
$rj_day = intval($rjyfk_invite['rj_day']);
if ($Search == 'find') {
	$orderid = getgpc('orderid');
	if (empty($orderid)) {
		showmessage('rjyfk_invite:Prompt5');
	}
	$query = C::t('#rjyfk_invite#rjyfk_invite')->fetch_all_orderid($orderid);
	include template('rjyfk_invite:invite');
exit;
} 
include template('rjyfk_invite:invite');
