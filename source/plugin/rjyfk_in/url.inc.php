<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
if(empty($_G['uid'])) showmessage('to_login', 'member.php?mod=logging&action=login', array(), array('showmsg' => true, 'login' => 1));
if(empty($rjyfk_in['switch_integral']) && !defined('IN_MOBILE')) showmessage(lang('plugin/rjyfk_in', 'Prompt51'));
$titlename = $_G['setting']['extcredits'][$rjyfk_in['rj_type']]['title'];
$rj_ratio = $rjyfk_in['rj_ratio']?intval($rjyfk_in['rj_ratio']):10;
$rj_minimum = $rjyfk_in['rj_minimum']?intval($rjyfk_in['rj_minimum']):10;
$rj_dayumum = $rjyfk_in['rj_dayumum']?intval($rjyfk_in['rj_dayumum']):10;
$rj_title = $rjyfk_in['rj_title'];
$rj_flname = $rjyfk_in['rj_flname'];
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
$bank_type = unserialize($rjyfk_in['bank_type']);
$bank_types = array();
foreach($bank_type as $b){
$data = array();
$data['id'] = $b;
$data['lang'] = $language['pay_type_'.$b];
$bank_types[] = $data;
}
include template('rjyfk_in:url');