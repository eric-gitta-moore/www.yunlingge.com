<?php

/*
 *源     码     哥   y  m g     6    .   c    o   m
 *更多商业插件/模版免费下载 就在源     码  哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$querys = DB::query("SELECT message FROM ".DB::table('forum_post')." WHERE tid=".$v['tid']." and message like '%[/img]%' order by pid asc");
while(!$_G['forum_threadlist'][$k]['coverpath']&&$post=DB::fetch($querys)){
	 if(preg_match_all("/\[img[^\]]*\](.*)\[\/img\]/isU",$post['message'],$result)){//匹配[img]
		foreach ($result[1] as $key=>$src){
			$src=trim($src);
			if((stripos($src,$_G['siteurl'])==true)||substr($src,0,4)!='http') continue;//过滤本站图片
			$_G['forum_threadlist'][$k]['cover']=1;
			$_G['forum_threadlist'][$k]['coverpath']=$src;
			@require_once libfile('function/cache');
			$cacheArray .= "\$cover='".$_G['forum_threadlist'][$k]['coverpath']."';\n";
			writetocache('cover_'.$v['tid'], $cacheArray);
			break;
		}
	 }
}
?>