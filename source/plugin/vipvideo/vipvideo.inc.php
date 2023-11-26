<?php

/**
 *      $author: 乘凉 $
 */

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$csspath = 'source/plugin/'.CURMODULE.'/css/';
$setconfig = $_G['cache']['plugin'][CURMODULE];
$setconfig['allow_user_group'] = (array)unserialize($setconfig['allow_user_group']);
if(in_array('', $setconfig['allow_user_group'])) {
	$setconfig['allow_user_group'] = array();
}

$navtitle = $setconfig['seo_title'];
$metakeywords = $setconfig['seo_keywords'];
$metadescription = $setconfig['seo_description'];

$ac = in_array($_GET['ac'], array('index','view','jump')) ? $_GET['ac'] : 'index';

loadcache('vipvideo_interface');
$interfaces = $_G['cache']['vipvideo_interface'];

if($ac == 'index') {

	$credit_tip = '';
	if($setconfig['allow_user_group'] && $setconfig['use_credit_item'] && $setconfig['use_credit_num'] && $setconfig['use_credit_num'] > 0) {
		$credit_tip = lang('plugin/'.CURMODULE, 'deduct_credit', array('credit_num' => $setconfig['use_credit_num'], 'credit_unit' => $_G['setting']['extcredits'][$setconfig['use_credit_item']]['unit'], 'credit_item' => $_G['setting']['extcredits'][$setconfig['use_credit_item']]['title']));
	}
	if(defined('IN_MOBILE')) {
		include template(CURMODULE.':'.CURMODULE.'_index');
	}else{
		include template('diy:'.CURMODULE.'_index', 0, 'source/plugin/'.CURMODULE.'/template');
	}

} elseif($ac == 'view') {

	$url = trim($_GET["url"]);
	if(empty($url)){
		showmessage(lang('plugin/'.CURMODULE, 'url_empty'));
	}
	if(!preg_match("/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/", $url)) {
		showmessage(lang('plugin/'.CURMODULE, 'url_error'));
	}
	$vid = intval($_GET['vid']);
	if(!$vid) {
		cpmsg(lang('plugin/'.CURMODULE, 'interface_nonexistence'), '', 'error');
	}
	$interface = $interfaces[$vid];
	if(!$interface || !$interface["status"]) {
		cpmsg(lang('plugin/'.CURMODULE, 'interface_nonexistence'), '', 'error');
	}
	if($setconfig['allow_user_group']){
		if(!in_array($_G['groupid'], $setconfig['allow_user_group'])){
			showmessage(lang('plugin/'.CURMODULE, 'no_permission'));
		}
		if($setconfig['use_credit_item'] && $setconfig['use_credit_num'] && $setconfig['use_credit_num'] > 0) {
			if(empty($_G['uid'])) {
				showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
			}
			if(getuserprofile('extcredits'.$setconfig['use_credit_item']) < $setconfig['use_credit_num']) {
				showmessage(lang('plugin/'.CURMODULE, 'credit_notenough', array('credit_item' => $_G['setting']['extcredits'][$setconfig['use_credit_item']]['title'])));
			}
			//查询同个视频是否有扣积分记录
			$wherearr = array();
			$wherearr[] = "uid = '".$_G['uid']."'";
			$wherearr[] = "linkurl = '".$url."'";
			$record = C::t('#'.CURMODULE.'#vipvideo_record')->count_by_search_where($wherearr);
			if(!$record){
				updatemembercount($_G['uid'], array ('extcredits'.$setconfig['use_credit_item'] => -$setconfig['use_credit_num']), 1, '', 0, '', lang('plugin/'.CURMODULE, 'view_video'), lang('plugin/'.CURMODULE, 'view_video'));
				$data = array(
					'uid' => $_G['uid'],
					'username' => $_G['username'],
					'linkurl' => $url,
					'credit_item' => $setconfig['use_credit_item'],
					'credit_num' => $setconfig['use_credit_num'],
					'createtime' => $_G['timestamp'],
					'postip' => $_G['clientip'],
				);
				C::t('#'.CURMODULE.'#vipvideo_record')->insert($data);
			}
		}
	}
	$hash = authcode("$interface[id]\t$url", 'ENCODE', md5(substr(md5($_G['config']['security']['authkey']), 0, 16)));
	showmessage('', dreferer(), array('url' => 'plugin.php?id='.CURMODULE.'&ac=jump&hash='.urlencode($hash)));

} elseif($ac == 'jump') {

	$vid = 0;
	$url = '';
	$_GET['hash'] = empty($_GET['hash']) ? '' : $_GET['hash'];
	if($_GET['hash']) {
		list($vid, $url) = explode("\t", authcode($_GET['hash'], 'DECODE', md5(substr(md5($_G['config']['security']['authkey']), 0, 16))));
		$vid = intval($vid);
	}

	if($vid && $url) {
		$interface = $interfaces[$vid];
		if(!$interface || !$interface["status"]) {
			cpmsg(lang('plugin/'.CURMODULE, 'interface_nonexistence'), '', 'error');
		}
		$url = $interface['url'].$url;

		//需要显示扣除积分提示
		if($setconfig['allow_user_group'] && $setconfig['use_credit_item'] && $setconfig['use_credit_num'] && $setconfig['use_credit_num'] > 0) {
			$topic['useheader'] = 0;
			$topic['usefooter'] = 0;
			include template(CURMODULE.':'.CURMODULE.'_jump');
		} else {
			dheader('location: '.$url);
		}
	} else {
		showmessage(lang('plugin/'.CURMODULE, 'interface_nonexistence'), 'index.php');
	}
}
