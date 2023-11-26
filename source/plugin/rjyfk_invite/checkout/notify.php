<?php
define('APPTYPEID', 197);
define('CURSCRIPT', 'pay');
require substr(dirname(__FILE__), 0, -35).'/source/class/class_core.php';
$discuz = C::app();
$cachelist = array();
$discuz->cachelist = $cachelist;
$discuz->init();
runhooks();
global $_G;
loadcache("plugin");
$rjyfk_invite = $_G['cache']['plugin']['rjyfk_invite'];
$userkey=trim($rjyfk_invite['userkey']);
$status=daddslashes($_GET['status']);
$customerid=daddslashes($_GET['customerid']);
$sdorderno=daddslashes($_GET['sdorderno']);
$total_fee=daddslashes($_GET['total_fee']);
$paytype=daddslashes($_GET['paytype']);
$sdpayno=daddslashes($_GET['sdpayno']);
$remark=daddslashes($_GET['remark']);
$server=daddslashes($_GET['server']);
$sign=daddslashes($_GET['sign']);
$mysign=md5('customerid='.$customerid.'&status='.$status.'&sdpayno='.$sdpayno.'&sdorderno='.$sdorderno.'&total_fee='.$total_fee.'&paytype='.$paytype.'&'.$userkey);
if($sign==$mysign){
    if($status=='1'){
    $order = $sdorderno;
    $orderinfo = C::t('#rjyfk_invite#rjyfk_invite')->fetch_pay_orderid($order);
	if($orderinfo['orderid'] == ''){
	if (!is_numeric($rjyfk_invite['rj_day']) || $rjyfk_invite['rj_day'] < 1) {
		$rjyfk_invite['rj_day'] = 10;
	}
	$endtime = TIMESTAMP + $rjyfk_invite['rj_day'] * 86400;
	$invicode= strtolower(random(6));
	DB::insert('common_invite', array('uid'=>$rjyfk_invite['rj_uid'],'code'=>$invicode,'inviteip'=>$_G['clientip'],'dateline'=>TIMESTAMP,'endtime'=>$endtime,'email' => $server,'status'=>1,'orderid'=>$sdorderno));
	echo 'success';
	if($rjyfk_invite['switch_mail'] = '1'){
	 if(!function_exists('sendmail')) {
				require_once libfile('function/mail');
			}
			$add_member = $_G['setting']['bbname'].' - '.lang('forum/misc', 'invite_payment');
			$add_message = lang('email', 'invite_payment_email_message', array(
				'orderid' => $sdorderno,
				'codetext' => $invicode,
				'siteurl' => $_G['setting']['siteurl'],
				'bbname' => $_G['setting']['bbname'],
			));
			
			if(!sendmail($server, $add_member, $add_message)) {
				runlog('sendmail', "$server sendmail failed.");
			}
			}
			
	} else {
        echo 'success';
    }
		
    } else {
        echo 'fail';
    }
} else {
    echo 'signerr';
}