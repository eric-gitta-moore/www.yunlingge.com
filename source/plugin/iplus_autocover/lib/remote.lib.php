<?php
/*
 *源     码     哥 y     m   g   6    .  c    o     m
 *更多商业插件/模版免费下载 就在源 码 哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$remote=trim($_G['cache']['plugin']['iplus_autocover']['remote']);
if(!$remote&&$_G['setting']['ftp']['on']) $remote=$_G['setting']['ftp']['attachurl'];								
if($remote){
	$_G['forum_threadlist'][$k]['cover']=1;
	$_G['forum_threadlist'][$k]['coverpath']=$remote.'/forum/'.$pic['attachment'];
	$coverset=1;
	break;
}

?>