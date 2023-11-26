<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(empty($_GET['formhash']) || FORMHASH != $_GET['formhash']) exit;
global $_G;
$rjyfk_invite = $_G['cache']['plugin']['rjyfk_invite'];
if($rjyfk_invite['uppay_ok']=="1") {
$uid = $_G['uid'];
if($uid) showmessage('rjyfk_invite:Prompt4', '', array(), array('showmsg' => true));
}
$titlename = $rjyfk_invite['rj_title'];
$rj_money = $rjyfk_invite['rj_money'];
$rj_day = intval($rjyfk_invite['rj_day']);
$userkey = trim($rjyfk_invite['userkey']);
$userid = intval($rjyfk_invite['userid']);
$version = '1.0';
if(empty($_GET['total_fee']) ){
 $error = $_G['siteurl']."/plugin.php?id=rjyfk_invite:in&t=error";
 header("location: $error");
 exit;
	}
$sdorderno = get_sdorderno(1);
$total_fee = sprintf("%.2f",intval($_GET['total_fee']));
if(empty($_GET['remark']) ){
	$zhuanma = dhtmlspecialchars($titlename); 
 } else {
	$zhuanma = $_GET['remark'];
    }
$notifyurl = $_G['siteurl']."source/plugin/rjyfk_invite/checkout/notify.php";
$returnurl = $_G['siteurl']."source/plugin/rjyfk_invite/checkout/return.php";
//$remark = $zhuanma;

$server = $_GET['mail'];
if(CHARSET == 'gbk'){
	$remark = diconv($zhuanma,'GBK','UTF-8');
}elseif(CHARSET == 'big5'){
	$remark = diconv($zhuanma,'BIG5','UTF-8');
}
if($rjyfk_invite['remark_user']){
$remark ='';
}	
$sign=md5('version='.$version.'&customerid='.$userid.'&total_fee='.$total_fee.'&sdorderno='.$sdorderno.'&notifyurl='.$notifyurl.'&returnurl='.$returnurl.'&'.$userkey);
include template("rjyfk_invite:go");


function get_sdorderno($type){
	if(!$type) return;
	$sdorderno = "";
	for($i=0;$i<100000;$i++){
		$sdorderno = date("YmdHis").mt_rand(10000, 99999);
	}
	return $sdorderno;
}

