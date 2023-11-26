<?php
define('APPTYPEID', 198);
define('CURSCRIPT', 'payr');
require substr(dirname(__FILE__), 0, -35).'/source/class/class_core.php';
$discuz = C::app();
$cachelist = array();
$discuz->cachelist = $cachelist;
$discuz->init();
runhooks();
global $_G;
loadcache("plugin");
$rjyfk_invite = $_G['cache']['plugin']['rjyfk_invite'];
$suss_ok = $rjyfk_invite['suss_ok'];
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
$_G['siteurl'] = str_replace("/source/plugin/rjyfk_invite/checkout","",$_G['dz']);
$reurl = $_G['dz']."/plugin.php?id=rjyfk_invite:in";
$reurl2 = $_G['setting']['siteurl']."member.php?mod=".$_G['setting']['regname'];
if($sign==$mysign){
    if($status=='1'){
	$invitequery =  DB::fetch_first("SELECT id,code FROM ".DB::table('common_invite')." WHERE orderid='".$sdorderno."'");
	if($suss_ok=="1"){
		dheader("location: /plugin.php?id=rjyfk_invite:in&Search=find&orderid={$sdorderno}");
	 }else {
		dheader("location: /plugin.php?id=rjyfk_invite:in&Search=find&orderid={$sdorderno}");
	   }
	 exit;
    } else {

	echo  "&#20805;&#20540;&#22833;&#36133;&#65292;&#35831;&#32852;&#31995;&#31649;&#29702;&#21592;&#22788;&#29702;&#33;!<a href='$reurl'>&#28857;&#20987;&#37325;&#26032;&#25903;&#20184;</a>";  
	 exit;
    }
} else {	

    echo "&#39564;&#35777;&#31614;&#21517;&#22833;&#36133;&#33;!<a href='$reurl'>&#28857;&#20987;&#37325;&#26032;&#25903;&#20184;</a>";
	exit;
}