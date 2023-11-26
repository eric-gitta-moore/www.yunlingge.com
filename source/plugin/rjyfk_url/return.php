<?php
define('IN_API', true);
define('CURSCRIPT', 'api');
require '../../../source/class/class_core.php';
$pd = false;
if(class_exists('C') && method_exists('C','app')){
    $discuz = C::app();
    $discuz->init();
    $pd = true;
}elseif(class_exists('discuz_core')){
    $discuz = & discuz_core::instance();
    $discuz->init();
	
}else{
    die();
}
loadcache("plugin");
$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
$userkey=trim($rjyfk_url['userkey']);
$status=daddslashes($_REQUEST['status']);
$customerid=daddslashes($_REQUEST['customerid']);
$sdorderno=daddslashes($_REQUEST['sdorderno']);
$total_fee=daddslashes($_REQUEST['total_fee']);
$paytype=daddslashes($_REQUEST['paytype']);
$sdpayno=daddslashes($_REQUEST['sdpayno']);
$remark=daddslashes($_REQUEST['remark']);
$server=daddslashes($_REQUEST['server']);
$sign=daddslashes($_REQUEST['sign']);
$mysign=md5('customerid='.$customerid.'&status='.$status.'&sdpayno='.$sdpayno.'&sdorderno='.$sdorderno.'&total_fee='.$total_fee.'&paytype='.$paytype.'&'.$userkey);
$_G['siteurl'] = str_replace("/source/plugin/rjyfk_url","",$_G['dz']);
$reurl = $_G['dz']."/plugin.php?id=rjyfk_url:url";
if($sign==$mysign){
    if($status=='1'){
		$date = array();
		$sdorderno = daddslashes(trim($sdorderno));
		$date = C::t('#rjyfk_url#rjy_log')->fetch_by_sdorderno($sdorderno);
		if(empty($date) || intval($date['total_fee'])>intval($total_fee)) {
			echo "&#25903;&#20184;&#37329;&#39069;&#24322;&#24120;&#44;&#35831;&#37325;&#26032;&#25903;&#20184;&#65281;<a href='$reurl'>&#28857;&#20987;&#37325;&#26032;&#25903;&#20184;</a>";
			exit;
		}
		header("location: $reurl");

    } else {
		echo "&#20805;&#20540;&#22833;&#36133;&#65292;&#35831;&#32852;&#31995;&#31649;&#29702;&#21592;&#22788;&#29702;&#33;!<a href='$reurl'>&#28857;&#20987;&#37325;&#26032;&#25903;&#20184;</a>";
		exit;
    }
} else {
	    echo "&#39564;&#35777;&#31614;&#21517;&#22833;&#36133;&#33;!<a href='$reurl'>&#28857;&#20987;&#37325;&#26032;&#25903;&#20184;</a>";
		exit;	
}