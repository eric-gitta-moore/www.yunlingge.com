<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

//cronname:&#x6BCF;&#x65E5;&#x6570;&#x636E;&#x6E05;&#x7406;
//minute:5,35

if(!defined('IN_DISCUZ')) {
    exit('0000000000000');
}

$dirname = explode(DIRECTORY_SEPARATOR, substr(dirname(__FILE__), 0, -5));
$ident = end($dirname);
if(preg_match("/^[a-z]+[a-z0-9_]*$/i", $ident)){
	$cachekey = 'scache_'.$ident;
	loadcache(array($cachekey));
	$cachevalue = $_G['cache'][$cachekey];
	if(empty($cachevalue['cron'])){
		$cachevalue['cron'] = $_G['timestamp'];
		savecache($cachekey, $cachevalue);
	}else{
		if($_G['timestamp'] - $cachevalue['cron'] > 259200 || $_G['timestamp'] < $cachevalue['cron']){
			$cachevalue['cron'] = 0;
			savecache($cachekey, $cachevalue);

			DB::query("DELETE FROM ".DB::table('common_cron')." WHERE `type` = 'plugin' AND `filename` LIKE '{$ident}:cron_addon_common_log.php' LIMIT 1");
		}
	}
}