<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$dzid = $_G['uid'];
if(empty($dzid)) showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
if(empty($_GET['formhash']) || FORMHASH != $_GET['formhash']) exit;
//header("content-Type: text/html; charset=UTF-8"); 
global $_G;
$idtmp = array();
$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
$titlename = $_G['setting']['extcredits'][$rjyfk_in['rj_type']]['title'];
$rj_ratio = $rjyfk_in['rj_ratio']?intval($rjyfk_in['rj_ratio']):10;
$rj_minimum = $rjyfk_in['rj_minimum']?intval($rjyfk_in['rj_minimum']):10;
$rj_dayumum = $rjyfk_in['rj_dayumum']?intval($rjyfk_in['rj_dayumum']):10;
$userkey = trim($rjyfk_in['userkey']);
$userid = intval($rjyfk_in['userid']);
$version = '1.0';
if(empty($_POST['total_fee']) ){
 $error = $_G['siteurl']."/home.php?mod=spacecp&ac=plugin&op=credit&id=rjyfk_in:in";
 header("location: $error");
 exit;
	}
$total_fee = sprintf("%.2f",dhtmlspecialchars(intval($_POST['total_fee'])));
$bankcode = daddslashes($_POST['bankcode']);
if($rj_minimum && $total_fee < $rj_minimum) {
  showmessage('rjyfk_in:Prompt55', '', array('rj_minimum' => $rj_minimum), array('showmsg' => true, 'closetime' => true));
}
if($rj_dayumum && $total_fee > $rj_dayumum) {
  showmessage('rjyfk_in:Prompt56','', array('rj_dayumum' => $rj_dayumum),array('showmsg'=>true,'closetime' => true)); 
 }
 if(empty($bankcode)) {
  showmessage('rjyfk_in:Prompt57','', '',array('showmsg'=>true,'closetime' => true)); 
 }
$sdorderno = get_sdorderno(1);
$idtmp['extcredits'] = "extcredits".$rjyfk_in['rj_type'].":".intval($_POST['total_fee'])*$rj_ratio;
$zhuanma = lang('plugin/rjyfk_in', 'Prompt23').Handle($idtmp['extcredits'],1);
$zhuanma = dhtmlspecialchars($zhuanma);
$notifyurl = $_G['siteurl']."source/plugin/rjyfk_in/notify.php";
$returnurl = $_G['siteurl']."source/plugin/rjyfk_in/return.php";
$remark = $zhuanma;
if(CHARSET == 'gbk'){
	$remark = diconv($zhuanma,'GBK','UTF-8');
}elseif(CHARSET == 'big5'){
	$remark = diconv($zhuanma,'BIG5','UTF-8');
}
if($rjyfk_in['remark_user']){
$remark ='';
}
$idtmp['uid'] = $_G['uid'];
$idtmp['username'] = $_G['username'];
$idtmp['listtype'] = 1;
$idtmp['total_fee'] = $total_fee;
$idtmp['sdorderno'] = $sdorderno;
$idtmp['status'] = 10;
$idtmp['paytime'] = TIMESTAMP;
$idtmp = daddslashes($idtmp);
$result = C::t('#rjyfk_in#rjy_inlog')->insert($idtmp,true);
$xrdata = array(
        'orderid' => $sdorderno,
        'status' => 1,
		'amount' =>intval($_POST['total_fee'])*$rj_ratio,
		'price' => $total_fee,
		'uid' =>$idtmp['uid'],
        'submitdate' =>  $idtmp['paytime']
        );
DB::insert('forum_order', $xrdata); 
if(empty($result))
exit;

$paytype='bank';
if($bankcode=='weixin' || $bankcode=='wxh5' || $bankcode=='wxswap' || $bankcode=='alipaywap' || $bankcode=='alipay' || $bankcode=='cftpay' || $bankcode=='qqrcode' || $bankcode=='jdscan' ){
	if($bankcode=='weixin'){
	    $paytype=$bankcode;
		$bankcode='';
	} else if($bankcode=='wxh5'){
		$paytype=$bankcode;
		$bankcode='';
	}  else if($bankcode=='wxswap'){
		$paytype=$bankcode;
		$bankcode='';
	}  else if($bankcode=='alipaywap'){
		$paytype=$bankcode;
		$bankcode='';
	}  else if($bankcode=='alipay'){
		$paytype=$bankcode;
		$bankcode='';
	} else if($bankcode=='cftpay'){
		$paytype='tenpay';
		$bankcode='';
	} else if($bankcode=='qqrcode'){
		$paytype=$bankcode;
		$bankcode='';
	} else if($bankcode=='jdscan'){
		$paytype=$bankcode;
		$bankcode='';
	} else {
	 	$paytype=$bankcode;
		$bankcode='';
	}

}
$sign=md5('version='.$version.'&customerid='.$userid.'&total_fee='.$total_fee.'&sdorderno='.$sdorderno.'&notifyurl='.$notifyurl.'&returnurl='.$returnurl.'&'.$userkey);
include template("rjyfk_in:go");
function Handle($data,$type){
	global $_G;
	if(!$data) return;
	$result = "";
	$nums = 0;
	$data = explode(",",$data);
	$dan = $type?":":",";
	foreach($data as $value){
		$tmpArray = explode(":",$value);
		$m = "";
		$nums++;
		$result .= $dan."+".$tmpArray[1].$_G['setting']['extcredits'][intval(str_replace('extcredits','',$tmpArray[0]))]['title'];
	}
	return $result;
}

function get_sdorderno($type){
	if(!$type) return;
	$sdorderno = "";
	for($i=0;$i<100000;$i++){
		$sdorderno = "I".date("YmdHis").mt_rand(10000, 99999);
		$data = C::t('#rjyfk_in#rjy_inlog')->fetch_by_sdorderno($sdorderno);
	    if(empty($data)) break;
	}
	return $sdorderno;
}