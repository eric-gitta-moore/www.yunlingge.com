<?php

/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
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