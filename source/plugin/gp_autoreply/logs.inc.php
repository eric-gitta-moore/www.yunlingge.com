<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$pidlist=array();
if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_last.php')){
	@require_once DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_last.php';
}
$pidlist=array_reverse($pidlist,true);
showtableheader(lang('plugin/gp_autoreply','logs_title'));
showsubtitle(array('ID',lang('plugin/gp_autoreply','logs_m_info'),lang('plugin/gp_autoreply','logs_m_dateline')));
foreach($pidlist as $k=>$info) {
	$type = sprintf('%04b', $forumlink['type']);
	showtablerow('', array('class="td25"', 'class="td28"', '', '', ''), array(
		$k,
		'<a href="forum.php?mod=redirect&goto=findpost&ptid='.$info['tid'].'&pid='.$info['pid'].'">tid='.$info['tid'].'/pid='.$info['pid'].'</a>',
		dgmdate($info['dateline'],'Y-m-d H:i:s'),
	));
}
showtablefooter();
?>