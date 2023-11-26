<?php
/*
 *源     码  哥 y     m    g     6  .  c   o   m
 *更多商业插件/模版免费下载 就在源     码     哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
@set_time_limit(0);
include_once DISCUZ_ROOT.'/source/plugin/iplus_sitemap/libs/sitemap.class.php';
if(!$_GET['op']||$_GET['op']!=formhash()){
	cpmsg(lang('plugin/iplus_sitemap','loading'),'action=plugins&operation=config&do='.$pluginid.'&identifier=iplus_sitemap&pmod=task&op='.FORMHASH,'succeed');
}else{
	loadcache('plugin');
	$var=$_G['cache']['plugin']['iplus_sitemap'];
	$var['urls']=unserialize($var['urls']);
	$var['forums']=unserialize($var['forums']);
	$priority=array(
		'index'=>$var['freq_index'],
		'forum'=>$var['freq_forum'],
		'thread'=>$var['freq_thread'],
		'article'=>$var['freq_article'],
	);
	$single_num=intval($var['single_num']);
	$sitemap=new sitemap(1,array('siteurl'=>$_G['siteurl'],'urls'=>$var['urls'],'single_num'=>$single_num,'priority'=>$priority,'forums'=>$var['forums']));
	showtableheader(lang('plugin/iplus_sitemap','tips'));
	showtablerow('', array('class="td_k"', 'class="td_k"', 'class="td_l"'), array(
		lang('plugin/iplus_sitemap','all_num').$sitemap->all_num,
	));	
	showtablerow('', array('class="td_k"', 'class="td_k"', 'class="td_l"'), array(
		lang('plugin/iplus_sitemap','xml_num').($sitemap->xml_num-1),
	));
	showtablerow('', array('class="td_k"', 'class="td_k"', 'class="td_l"'), array(
		lang('plugin/iplus_sitemap','xmllist').xmllist($sitemap->xml_num),
	));	
	showtablerow('', array('class="td_k"', 'class="td_k"', 'class="td_l"'), array(
		lang('plugin/iplus_sitemap','help'),
	));		
	showtablefooter();
}

function xmllist($xml_num){
	global $_G;
	if($xml_num<=2){
		return $_G['siteurl'].'sitemapindex.xml';
	}else{
		$str='';
		for($i=1;$i<$xml_num;$i++){
			$str.='<br>'.$_G['siteurl'].'sitemap'.$i.'.xml';
		}
		return $str;
	}
}
?>