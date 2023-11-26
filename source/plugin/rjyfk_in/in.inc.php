<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $_G;
$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
if(empty($rjyfk_in['switch_integral']) && !defined('IN_MOBILE')) showmessage(lang('plugin/rjyfk_in', 'Prompt51'));
$titlename = $_G['setting']['extcredits'][$rjyfk_in['rj_type']]['title'];
$rj_ratio = $rjyfk_in['rj_ratio']?intval($rjyfk_in['rj_ratio']):10;
$rj_minimum = $rjyfk_in['rj_minimum']?intval($rjyfk_in['rj_minimum']):10;
$rj_dayumum = $rjyfk_in['rj_dayumum']?intval($rjyfk_in['rj_dayumum']):1000;
$rj_title = $rjyfk_in['rj_title'];
$bank_type = unserialize($rjyfk_in['bank_type']);
$bank_types = array();
foreach($bank_type as $b){
$data = array();
$data['id'] = $b;
$data['lang'] = $language['pay_type_'.$b];
$bank_types[] = $data;
}