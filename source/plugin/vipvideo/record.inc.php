<?php

/**
 *      $author: ³ËÁ¹ $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

define('IDENTIFIER','vipvideo');

$pluginurl = ADMINSCRIPT.'?action=plugins&identifier='.IDENTIFIER.'&pmod=record';

if(!submitcheck('submit')) {
	$perpage = 30;
	$start = ($page-1)*$perpage;
	showformheader('plugins&identifier='.IDENTIFIER.'&pmod=record');
	showtableheader(lang('plugin/'.IDENTIFIER, 'record_list'));
	showsubtitle(array('del', 'username', lang('plugin/'.IDENTIFIER, 'record_linkurl'), lang('plugin/'.IDENTIFIER, 'record_credit'), 'ip', 'dateline'));
	$count = C::t('#'.IDENTIFIER.'#vipvideo_record')->count_by_search_where($wherearr);
	$list = C::t('#'.IDENTIFIER.'#vipvideo_record')->fetch_all_by_search_where($wherearr,'order by createtime desc', $start, $perpage);
	foreach ($list as $value) {
		$value['createtime'] = dgmdate($value['createtime'], 'Y-n-j H:i');
		showtablerow('', array('class="td25"', 'class="td24"', '', 'class="td24"', 'class="td24"', 'class="td24"'), array(
			"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$value[id]\">",
			$value['username'],
			$value['linkurl'],
			$value['credit_num'].$_G['setting']['extcredits'][$value['credit_item']]['unit'].$_G['setting']['extcredits'][$value['credit_item']]['title'],
			$value['postip'],
			$value['createtime']
		));
	}
	$multipage = multi($count, $perpage, $page, $pluginurl);

	showsubmit('submit', 'submit', 'select_all', '', $multipage);
	showtablefooter();
	showformfooter();
} else {
	if(is_array($_GET['delete'])) {
		C::t('#'.IDENTIFIER.'#vipvideo_record')->delete_by_id($_GET['delete']);
	}
	cpmsg(lang('plugin/'.IDENTIFIER, 'record_updatesucceed'), 'action=plugins&identifier='.IDENTIFIER.'&pmod=record', 'succeed');
}


?>