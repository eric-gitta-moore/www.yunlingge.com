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
$status=daddslashes($_POST['status']);
$customerid=daddslashes($_POST['customerid']);
$sdorderno=daddslashes($_POST['sdorderno']);
$total_fee=daddslashes($_POST['total_fee']);
$paytype=daddslashes($_POST['paytype']);
$sdpayno=daddslashes($_POST['sdpayno']);
$remark=daddslashes($_POST['remark']);
$server=daddslashes($_POST['server']);
$sign=daddslashes($_POST['sign']);
$mysign=md5('customerid='.$customerid.'&status='.$status.'&sdpayno='.$sdpayno.'&sdorderno='.$sdorderno.'&total_fee='.$total_fee.'&paytype='.$paytype.'&'.$userkey);
if($total_fee=='' ||$sdpayno==''||$sdorderno==''||$sign==''){ die('fail');}
if($status != '1'){ die ('fail');}
if($sign != $mysign){die ('signerr');}
		$date = array();
		$sdorderno = daddslashes(trim($sdorderno));
		$ctype = substr($sdorderno,0,1);
		$date = C::t('#rjyfk_url#rjy_log')->fetch_by_sdorderno($sdorderno);
		$order_price = $total_fee;
		if(!empty($date) && (floatval($order_price) == floatval($date['total_fee']))) { 
		if($date && $date['status']==10){
			  $uid = intval($date['uid']);
			  	 if(empty($date) || intval($date['total_fee'])!=intval($total_fee)) {
				  echo 'fail';
				  exit;
			  }
				$clsj = array(
                  'operation' => 'AFD',
                  'relatedid' =>$uid,
				  'uid' =>$uid,
                  'dateline' =>  $_G['timestamp']
				 );	
                 //     
			  $idtmp['sdpayno'] = $sdpayno;
			  $idtmp['paydate'] = TIMESTAMP;
			  $idtmp['paytype'] = $paytype;
			  $idtmp['status'] = 1;
			  C::t('#rjyfk_url#rjy_log')->update_by_sdorderno($sdorderno,$idtmp);
			  if($ctype=="U"){
					$groupid = intval($date['groupid']);
					$days = intval($date['groupenddate']);
					if($days>0) {
					 $member = C::t('common_member')->fetch($uid, false, 1);
         				if (count($member) == 0) {
          					       $isinarchive = '_inarchive';
         					    } else {
          					       $isinarchive = '';
         					    }
						$groupexpirynew = ($member['groupexpiry'] > TIMESTAMP && $member['groupid']==$groupid ? $member['groupexpiry'] : TIMESTAMP) + $days * 86400;
						
						C::t('common_member' . $isinarchive)->update($uid, array('groupid' => $groupid,'groupexpiry' => $groupexpirynew));
						$groupterms['main'] = array('time' => $groupexpirynew);
						$groupterms['ext'][$groupid] = $groupexpirynew;	
						C::t('common_member_field_forum' . $isinarchive)->update($uid, array('groupterms' => serialize($groupterms)));
					} else {
						C::t('common_member'. $isinarchive)->update($uid, array('groupid' => $groupid));
					}
			  }

			  //     
			if($date['extcredits'] && empty($date['extstatus'])){
				  $adddata = array();
				  $extcreditsarray = explode(',', $date['extcredits']);
				  foreach ($extcreditsarray as $value) {
					  $extcredits = explode(':', $value);
					  if($extcredits[0] && $extcredits[1]) {
						  $adddata[trim($extcredits[0])] = intval($extcredits[1]);
					  }
				  }
				  if($adddata) {
                 foreach ($adddata as $value =>$sz) 
				 {
                 $clsj[$value]= intval($sz);		  
                 $tz.='<p style="border-left: 1px solid #CDCDCD;padding: 1px 5px 1px 7px;margin: 2px 6px 5px 6px;">&#x6536;&#x5165;: '.intval($sz).$_G['setting']['extcredits'][number($value)]['title'].'</p>';	  
                   }	
                $idtmp['status'] = 1;
                 C::t('#rjyfk_url#rjy_log')->update_by_sdorderno($sdorderno,$idtmp);
               updatecreditbyaction('',$uid,$adddata);
               DB::insert('common_credit_log', $clsj);  
               $smsnotification='&#24050;&#32463;&#23384;&#20837;&#24744;&#30340;&#36134;&#25143;'.' <a href="home.php?mod=spacecp&ac=credit&op=base" class="ea55_onclicks" >&#x67E5;&#x770B;>></a><p style="border-left: 1px solid #CDCDCD;padding: 1px 5px 1px 7px;margin: 2px 6px 5px 6px;">&#x8BA2;&#x5355;&#x53F7;: '.$sdorderno.'</p><p style="border-left: 1px solid #CDCDCD;padding: 1px 5px 1px 7px;margin: 2px 6px 5px 6px;">&#x652F;&#x4ED8;: &#x4EBA;&#x6C11;&#x5E01;'.$total_fee.' &#x5143;</p>'.$tz;
               notification_add($uid, 'system',$smsnotification,  array(),1);
               DB::query("UPDATE ".DB::table('forum_order')." SET confirmdate='".$_G['timestamp']."' , status=2 WHERE orderid='".$sdorderno."' ", 'UNBUFFERED');				  
               $idtmp['extstatus'] = 1;
				  }
			  }
		}
				}
echo 'success';
function number($srts) {
    preg_match_all('/\d/S', $srts, $srts);
    return implode('', $srts[0]);
}