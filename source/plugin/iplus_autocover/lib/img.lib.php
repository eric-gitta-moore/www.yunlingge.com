<?php

/*
 *Դ     ��     ��   y  m g     6    .   c    o   m
 *������ҵ���/ģ��������� ����Դ     ��  ��
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$querys = DB::query("SELECT message FROM ".DB::table('forum_post')." WHERE tid=".$v['tid']." and message like '%[/img]%' order by pid asc");
while(!$_G['forum_threadlist'][$k]['coverpath']&&$post=DB::fetch($querys)){
	 if(preg_match_all("/\[img[^\]]*\](.*)\[\/img\]/isU",$post['message'],$result)){//ƥ��[img]
		foreach ($result[1] as $key=>$src){
			$src=trim($src);
			if((stripos($src,$_G['siteurl'])==true)||substr($src,0,4)!='http') continue;//���˱�վͼƬ
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