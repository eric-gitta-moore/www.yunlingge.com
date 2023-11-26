<?php
/*
 * 应用中心主页：https://addon.dismall.com/?@1552.developer
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$_cachelist=array();
$filepath=DISCUZ_ROOT.'./data/sysdata/';
$handle=opendir($filepath); 
if($_GET['doupdate']=='yes'&&$_GET['hash']==formhash()){
	while(false!==($file=readdir($handle))){ 
		if(substr_count($file,'cache_nimba_forumdev_')){
			@unlink($filepath.$file);
		}
	}
	@file_get_contents($_G['siteurl'].'forum.php');
	cpmsg(lang('plugin/nimba_forumdev','m_ok'),'action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_forumdev&pmod=cache', 'succeed');
}else{
	showtableheader(lang('plugin/nimba_forumdev','title')."(<a href=\"".ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=nimba_forumdev&pmod=cache&doupdate=yes&hash=".FORMHASH."\"><font color=\"red\">".lang('plugin/nimba_forumdev','doupdate')."</font></a>)");
	showsubtitle(array(lang('plugin/nimba_forumdev','m_index'), lang('plugin/nimba_forumdev','m_file'),lang('plugin/nimba_forumdev','m_time')));
	$handle=opendir($filepath); 
	$index=1;
	while(false!==($file=readdir($handle))){ 
		if(substr_count($file,'cache_nimba_forumdev_')){
			$lasttime=@filemtime($filepath.$file);
			showtablerow('', array('class="td25"', 'class="td28"', '', '', ''), array(
				$index,
			   $file,
			   dgmdate($lasttime,'Y-m-d H:i:s'),
			));
			$index++;
		}
	}
	if($index==1){
		echo '<tr><td>'.lang('plugin/nimba_forumdev','m_nodata').'</td></tr>';
	}
	showtablefooter();	
}
?>