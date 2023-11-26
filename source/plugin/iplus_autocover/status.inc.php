<?php
/*
 *源    码   哥 y  m g    6  .  c    o m
 *更多商业插件/模版免费下载 就在源     码    哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$libs=array(
	0=>'remote',
	1=>'img'
);
$ids=array(
	0=>'21723',
	1=>'21724',
);

showtableheader(lang('plugin/iplus_autocover','tips'));
showsubtitle(array(lang('plugin/iplus_autocover','name'),lang('plugin/iplus_autocover','info'),lang('plugin/iplus_autocover','status'),lang('plugin/iplus_autocover','down')));
foreach($libs as $k=>$lib) {
	if(file_exists(DISCUZ_ROOT.'./source/plugin/iplus_autocover/lib/'.$lib.'.lib.php')) $status='<font color="green">'.lang('plugin/iplus_autocover','status_1').'</font>';
	else $status='<font color="red">'.lang('plugin/iplus_autocover','status_2').'</font>';
	showtablerow('', array('class="td_k"', 'class="td_k"', 'class="td_l"'), array(
		lang('plugin/iplus_autocover',$lib),
		lang('plugin/iplus_autocover',$lib.'info'),	
		$status,
		'<a href="http://addon.discuz.com/?@iplus_autocover.plugin.'.$ids[$k].'">'.lang('plugin/iplus_autocover','down').'</a>',
	));
			
}
showtablefooter();
?>