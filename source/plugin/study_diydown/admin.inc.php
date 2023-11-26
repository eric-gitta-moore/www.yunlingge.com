<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('plugin');
$splugin_setting = $_G['cache']['plugin']['study_diydown'];
$splugin_lang = lang('plugin/study_diydown');
showformheader('plugins&operation=config&do='.$pluginid.'&identifier=study_diydown&pmod=admin');

//showtips('123');
$uid = intval($_GET['uid']);
$aid = intval($_GET['aid']);
$ip = daddslashes($_GET['ip']);
if($uid){
	$where = " AND uid = '$uid'";
	$member = C::t('common_member')->fetch_all_username_by_uid((array)$uid);
	$title = '&#x6B63;&#x5728;&#x67E5;&#x770B;&#x7528;&#x6237; '.dhtmlspecialchars($member[$uid]).' &#x7684;&#x4E0B;&#x8F7D;&#x8BB0;&#x5F55;';
}elseif($aid){
	$where = " AND aid = '$aid'";
	$tableid = 'aid:'.$aid;
	$attach[$aid] = C::t('forum_attachment_n')->fetch($tableid, $aid);
	$title = '&#x6B63;&#x5728;&#x67E5;&#x770B;&#x9644;&#x4EF6; '.dhtmlspecialchars($attach[$aid]['filename']).' &#x7684;&#x4E0B;&#x8F7D;&#x8BB0;&#x5F55;';
}elseif($ip){
	$where = " AND ip = '$ip'";
	$title = '&#x6B63;&#x5728;&#x67E5;&#x770B;IP&#x4E3A; '.$ip.' &#x7684;&#x4E0B;&#x8F7D;&#x8BB0;&#x5F55;';
}else{
	$title = '&#x6240;&#x6709;&#x9644;&#x4EF6;&#x4E0B;&#x8F7D;&#x8BB0;&#x5F55;';
}
showtableheader($title);
showsubtitle(array('&#x9644;&#x4EF6;&#x540D;&#x79F0;', '&#x4E0B;&#x8F7D;&#x8005;', 'IP &#x5730;&#x5740;', '&#x4E0B;&#x8F7D;&#x65F6;&#x95F4;'));

$num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('study_diydown_log')."  WHERE 1 $where ORDER BY id DESC");
$page = intval($_G['page']);
$limit = 20;
$max = 1000;
$page = ($page-1 > $num/$limit || $page > $max) ? 1 : $page;
$start_limit = ($page - 1) * $limit;
$multipage = multi($num, $limit, $page, ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=study_diydown&pmod=admin&aid='.$aid.'&uid='.$uid.'&ip='.$ip, $max);
$query = DB::query("SELECT * FROM ".DB::table('study_diydown_log')."  WHERE 1 $where ORDER BY id DESC limit $start_limit,$limit");
while($log = DB::fetch($query)) {
		$uid = intval($log['uid']);
		if(empty($member[$uid])){
				$member = C::t('common_member')->fetch_all_username_by_uid((array)$uid);
		}
		$aid = intval($log['aid']);
		if(empty($attach[$aid])){
				$tableid = 'aid:'.$aid;
				$attach[$aid] = C::t('forum_attachment_n')->fetch($tableid, $aid);
		}
		showtablerow('', array(), array(
			'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=study_diydown&pmod=admin&aid='.$aid.'">'.dhtmlspecialchars($attach[$aid]['filename']).'</a>',
			$member[$uid] ? '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=study_diydown&pmod=admin&uid='.$uid.'">'.dhtmlspecialchars($member[$uid]).'</a>' : '&#x6E38;&#x5BA2;',
			'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=study_diydown&pmod=admin&ip='.$log['ip'].'">'.dhtmlspecialchars($log['ip']).'</a>',
			gmdate('Y-m-d H:i:s', $log['dateline'] + $_G['setting']['timeoffset'] * 3600 ),
		));
}
showsubmit('', '', '', '', $multipage);
showtablefooter();
showformfooter();
?>