<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

 if (!$_G['uid']) {
       showmessage('not_loggedin', NULL, array(), array('login' => 1));
    }
//header("content-Type: text/html; charset=UTF-8"); 
global $_G;
$idtmp = array();
$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
$titlename = $_G['setting']['extcredits'][$rjyfk_url['rj_type']]['title'];
$userkey = trim($rjyfk_url['userkey']);
$userid = intval($rjyfk_url['userid']);
$version = '1.0';
$bank_type = unserialize($rjyfk_url['bank_type']);
$bank_types = array();
foreach($bank_type as $b){
$data = array();
$data['id'] = $b;
$data['lang'] = $language['pay_type_'.$b];
$bank_types[] = $data;
}
////
if ($_GET['action'] == 'buytrue') {
$groupname = dhtmlspecialchars($_GET['groupname']);
$total_fee = dhtmlspecialchars($_GET['total_fee']);
	if($_GET['mode']=="wap"){
    include template('rjyfk_url:wappay');
	die();
	}else{
    include template('common/header_ajax');
    include template('rjyfk_url:doPayment');
    include template('common/footer_ajax');
    die();
	}
die();
}
////
$bankcode = daddslashes($_POST['bankcode']);
if(empty($bankcode)) {
showmessage('rjyfk_url:Prompt51','', '',array('showmsg'=>true,'closetime' => true)); 
}
if ($_POST['action'] == 'writeData') {
	if(empty($_POST['formhash']) || FORMHASH != $_POST['formhash']) exit;
    $sdorderno = get_sdorderno(1);
	$groupname = trim($_POST['groupname']);
	$grouptmp = array();
	$mydata = splitdata(explode("\r\n",$rjyfk_url['up_buygroups']));
	$usergroup = C::t('common_usergroup')->fetch_all_by_type();
	foreach($mydata as $k=>$v){
	    if($usergroup[intval($v[1])]['groupid']==intval($v[1])){
		    $nametmp = dhtmlspecialchars(trim($v[0]));
			$grouptmp[$nametmp]['groupname'] = $nametmp;
			$grouptmp[$nametmp]['groupid'] = intval($v[1]);
			$grouptmp[$nametmp]['total_fee'] = intval($v[2]);
			$grouptmp[$nametmp]['groupenddate'] = intval($v[3]);
			$grouptmp[$nametmp]['postextcredits'] = dhtmlspecialchars(trim($v[4]));
		}
	}

	if(empty($grouptmp[$groupname]) || empty($grouptmp[$groupname]['groupname']) || empty($grouptmp[$groupname]['groupid']) || empty($grouptmp[$groupname]['total_fee']) || intval($_POST['total_fee'])!=$grouptmp[$groupname]['total_fee']){
		 $error = $_G['siteurl']."/plugin.php?id=rjyfk_url:url&t=error";
		 header("location: $error");
		 exit;
	}
	$idtmp['extcredits'] = $grouptmp[$groupname]['postextcredits'];
	$idtmp['groupid'] = intval($grouptmp[$groupname]['groupid']);
	$idtmp['groupenddate'] = intval($grouptmp[$groupname]['groupenddate']);
	$total_fee = sprintf("%.2f",intval($grouptmp[$groupname]['total_fee']));
}else{
	 $error = $_G['siteurl']."/plugin.php?id=rjyfk_url:url&t=error";
	 header("location: $error");
	 exit;
}
$groupenddate = intval($grouptmp[$groupname]['groupenddate'])?intval($grouptmp[$groupname]['groupenddate']).lang('plugin/rjyfk_url', 'Prompt25'):lang('plugin/rjyfk_url', 'Prompt47');
$zhuanma = $_GET['groupname']?lang('plugin/rjyfk_url', 'Prompt24').$groupname.",".$groupenddate:lang('plugin/rjyfk_url', 'Prompt23').Handle($idtmp['extcredits'],1);
$zhuanma = dhtmlspecialchars($zhuanma);
$notifyurl = $_G['siteurl']."source/plugin/rjyfk_url/notify.php";
$returnurl = $_G['siteurl']."source/plugin/rjyfk_url/return.php";
$remark = $zhuanma;
if(CHARSET == 'gbk'){
	$remark = diconv($zhuanma,'GBK','UTF-8');
}elseif(CHARSET == 'big5'){
	$remark = diconv($zhuanma,'BIG5','UTF-8');
}
if($rjyfk_url['remark_user']){
$remark ='';
}	

$idtmp['uid'] = $_G['uid'];
$idtmp['username'] = $_G['username'];
$idtmp['listtype'] = 2;
$idtmp['total_fee'] = $total_fee;
$idtmp['sdorderno'] = $sdorderno;
$idtmp['status'] = 10;
$idtmp['paytime'] = TIMESTAMP;
$idtmp = daddslashes($idtmp);
$result = C::t('#rjyfk_url#rjy_log')->insert($idtmp,true);
$adddata = array(
        'orderid' => $sdorderno,
        'status' => 1,
		'amount' =>intval($_GET['total_fee'])*$rj_ratio,
		'price' => $total_fee,
		'uid' =>$idtmp['uid'],
        'submitdate' =>  $idtmp['paytime']
        );
DB::insert('forum_order', $adddata); 
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
include template("rjyfk_url:go");
//生成订单号
function get_sdorderno($type){
	if(!$type) return;
	$sdorderno = "";
	for($i=0;$i<100000;$i++){
		$sdorderno = "U".date("YmdHis").mt_rand(10000, 99999);
		$data = C::t('#rjyfk_url#rjy_log')->fetch_by_sdorderno($sdorderno);
	    if(empty($data)) break;
	}
	return $sdorderno;
}
function splitdata($data){
	$ret = array();
	foreach($data as $value){
		$tmpArray = explode("||",$value);
		array_push($ret,$tmpArray);
	}
	return $ret;
}
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

