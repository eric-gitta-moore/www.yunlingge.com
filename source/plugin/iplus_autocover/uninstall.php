<?php
/*
 *源    码    哥  y  m    g  6     .    c  o     m
 *更多商业插件/模版免费下载 就在源     码 哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$filepath=DISCUZ_ROOT.'./data/sysdata/cache_autoavatar.php';
if(file_exists($filepath)) @unlink($filepath);
require_once DISCUZ_ROOT.'./source/discuz_version.php';
$filepath=DISCUZ_ROOT.'./data/sysdata/';
if(DISCUZ_VERSION=='X2') $filepath=DISCUZ_ROOT.'./data/cache/';
$handle=opendir($filepath); 
while(false!==($file=readdir($handle))){ 
	if(substr_count($file,'cache_cover_')){
		@unlink($filepath.$file);
	}
}
$finish = TRUE;
?>