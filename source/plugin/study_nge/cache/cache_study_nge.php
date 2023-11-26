<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/plugin');

function build_cache_plugin_study_nge() {
	global $_G;
	$dirname = explode(DIRECTORY_SEPARATOR, substr(dirname(__FILE__), 0, -6));
	$ident = end($dirname);
	if(ispluginkey($ident)){
			$cachekey = 'build_cache_splugin';
			loadcache(array($cachekey));
			$cachevalue = $_G['cache'][$cachekey];
			if($_G['timestamp'] - $cachevalue['cache'] > 300 || $_G['timestamp'] < $cachevalue['cache']){
				$cachevalue['cache'] = $_G['timestamp'];
				savecache('build_cache_splugin', $cachevalue);
		}
	}
}