<?php

/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
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