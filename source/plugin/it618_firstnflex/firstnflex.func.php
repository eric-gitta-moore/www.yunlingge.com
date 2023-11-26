<?php
/**
 *	开发团队：IT618资讯网
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="为站长提供学习资料">IT618资讯网</a>
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function it618_nflex_getcss_bgcolor($bgcolor){
	if($bgcolor==""){
		$bgcolor="";
	}
	else{
		$bgcolor="background-color:".$bgcolor.";";
	}
	return $bgcolor;
}

function it618_nflex_getcss_color($color){
	if($color==""){
		$color="";
	}
	else{
		$color="color:".$color.";";
	}
	return $color;
}

function it618_nflex_getcss_bgimage($bgimage,$bgimage_repeat){
	$repeat=array("no-repeat","repeat","repeat-x","repeat-y");
	if($bgimage==""){
		$bgimage="";
	}
	else{
		$bgimage="background:url(".$bgimage.") ".$repeat[$bgimage_repeat-1].";";
	}
	return $bgimage;
}

function it618_nflex_gettui($blockname){
	if(trim($blockname)=="")return "";
	$blockid=DB::result_first("select bid from ".DB::table('common_block')." where name='$blockname'");

	block_get_batch($blockid);
	$fl_html = block_fetch_content($blockid, true);
	//global $_G;
//	
//	$url=$_G['siteurl']."api.php?mod=js&bid=".$blockid;
//	$fl_html = file_get_contents($url);
//	$fl_html = str_replace("document.write('","",$fl_html);
//	$fl_html = str_replace("');","",$fl_html);
//	$fl_html = str_replace(array("\\r\\n", "\\r", "\\n","\\"),"",$fl_html);
	
	
	if(strpos($fl_html,"getico")>1){
		$tmparr=explode("it618_nflex",$fl_html);
		$fl_html="";
		foreach($tmparr as $key => $tmp){
			if(strpos($tmp,"etico")==1){
				$tmtid=str_replace("getico","",$tmp);
				$fl_html.=getico($tmtid);
			}else{
				$fl_html.=$tmp;
			}
		}
	}
	
	return it618_nflex_rewriteurl($fl_html);
}

function it618_nflex_rewriteurl($fl_html){
	global $_G;
	if($_G['cache']['plugin']['it618_firstnflex']['rewriteurl']==1){
		//	forum.php?mod=forumdisplay&fid=2
		//	forum-2-1.html
		$tmparr=explode("forum.php?mod=forumdisplay",$fl_html);
		if(count($tmparr)>1){
			$fl_html="";
			foreach($tmparr as $key => $tmp){
				if(strpos($tmp,"fid=")==1){
					$tmp=str_replace("&fid=","forum-",$tmp);
					$tmparr1=explode('"',$tmp,2);
					$fl_html.=$tmparr1[0].'-1.html"'.$tmparr1[1];
				}else{
					$fl_html.=$tmp;
				}
			}
		}
		//	forum.php?mod=viewthread&tid=43
		//	thread-43-1-1.html
		$tmparr=explode("forum.php?mod=viewthread",$fl_html);
		if(count($tmparr)>1){
			$fl_html="";
			foreach($tmparr as $key => $tmp){
				if(strpos($tmp,"tid=")==1){
					$tmp=str_replace("&tid=","thread-",$tmp);
					$tmparr1=explode('"',$tmp,2);
					$fl_html.=$tmparr1[0].'-1-1.html"'.$tmparr1[1];
				}else{
					$fl_html.=$tmp;
				}
			}
		}
		
		$tmparr=explode("do=album&id=",$fl_html);
		if(count($tmparr)>1){return $fl_html;}
		
		//	home.php?mod=space&uid=5
		//	space-uid-5.html
		$tmparr=explode("home.php?mod=space",$fl_html);
		if(count($tmparr)>1){
			$fl_html="";
			foreach($tmparr as $key => $tmp){
				if(strpos($tmp,"uid=")==1){
					$tmp=str_replace("&uid=","space-uid-",$tmp);
					$tmparr1=explode('"',$tmp,2);
					$fl_html.=$tmparr1[0].'.html"'.$tmparr1[1];
				}else{
					$fl_html.=$tmp;
				}
			}
		}
		//	space-uid-1&do=blog&id=1.html
		//	blog-1-1.html
		$tmparr=explode("&do=blog&id=",$fl_html);
		if(count($tmparr)>1){
			$tmparr=explode('"',$fl_html);
			$fl_html="";
			foreach($tmparr as $key => $tmp){
				if(strpos($tmp,"do=blog&id=")>1){
					$tmp=str_replace("space-uid-","blog-",$tmp);
					$tmp=str_replace("&do=blog&id=","-",$tmp);
					$fl_html.=$tmp;
				}else{
					$fl_html.=$tmp;
				}
			}
		}
	}
	return $fl_html;
}

function getico($tid){
	$query = DB::query("select * from ".DB::table('forum_thread')." where tid='$tid'");
	if($result = DB::fetch($query)) {
		if($result['attachment']==2)$tmpall.='<span style="padding-left:12px;background:url(static/image/filetype/image_s.gif) no-repeat center center;">&nbsp;</span>';
		
		if($result['displayorder']>0)$tmpall.='<span style="padding-left:15px;background:url(static/image/common/pin_'.$result['displayorder'].'.gif) no-repeat center top;"/>&nbsp;</span>';
		
		if($result['digest']>0)$tmpall.='<span style="padding-left:19px;background:url(static/image/common/digest_'.$result['digest'].'.gif) no-repeat center center;"/>&nbsp;</span>';
	}
	
	return $tmpall;
}

function it618_nflex_getimage_nv($image_content_titles){
	$i=1;
	
	foreach($image_content_titles as $key => $image_content_title)
	{
		if($i==1){
			$tmpflag='class="cli"';
		}else{
			$tmpflag='';
		}
		
		$tempstr .='<li onmouseover="it618_firstnflex_tabChange(this,\'it618_tabcontent_image\')" '.$tmpflag.'>'.$image_content_title.'</li>';
		$i=$i+1;
		
	}
	return '<ul><li class="it618_lifirst"></li>'.$tempstr.'</ul>';
}

function it618_nflex_getimage_list($image_content_lists){
	$i=1;

	foreach($image_content_lists as $key => $image_content_list)
	{
		if($i==1){
			$tmpflag='';
		}else{
			$tmpflag='class="hidden"';
		}
		$tempstr.='<div '.$tmpflag.' id="it618_tabcontent_image'.$i.'"><ul id="indexhdp'.$i.'">';
		
		if(strpos($image_content_list,"block")==1){
			$tmparr=explode(",",$image_content_list);
			$tempstr.=it618_nflex_gettui(str_replace("}","",$tmparr[1]));
		}
		$tempstr.='</ul></div><script type="text/javascript">new dk_slideplayer("#indexhdp'.$i.'",{width:"310px",height:"235px",fontsize:"12px",right:"6px",bottom:"4px",time:"5000"})</script>';
		$i=$i+1;
		
	}
	return $tempstr;
}

function it618_nflex_getthread_nv($thread_content_titles){
	$i=1;
	
	foreach($thread_content_titles as $key => $thread_content_title)
	{
		if($i==1){
			$tmpflag='class="cli"';
		}else{
			$tmpflag='';
		}
		
		$tempstr .='<li onmouseover="it618_firstnflex_tabChange(this,\'it618_tabcontent_thread\')" '.$tmpflag.'>'.$thread_content_title.'</li>';
		$i=$i+1;
		
	}
	return '<ul><li class="it618_lifirst"></li>'.$tempstr.'</ul>';
}

function it618_nflex_getthread_list($thread_content_lists){
	$i=1;

	foreach($thread_content_lists as $key => $thread_content_list)
	{
		if($i==1){
			$tmpflag='';
		}else{
			$tmpflag='class="hidden"';
		}
		$tempstr.='<div '.$tmpflag.' id="it618_tabcontent_thread'.$i.'"><ul class="it618_flex_list">';
		
		if(strpos($thread_content_list,"block")==1){
			$tmparr=explode(",",$thread_content_list);
			$tempstr.=it618_nflex_gettui(str_replace("}","",$tmparr[1]));
		}elseif(strpos($thread_content_list,"thread_newreply")==1){
			$tempstr.=it618_nflex_getblock($thread_content_list,"thread_newreply");
		}
		elseif(strpos($thread_content_list,"thread_newthreadreply")==1){
			$tempstr.=it618_nflex_getblock($thread_content_list,"thread_newthreadreply");
		}
		$tempstr.='</ul></div>';
		$i=$i+1;
		
	}
	return $tempstr;
}

function it618_nflex_getforum_nv($forum_content_titles){
	$i=1;
	
	foreach($forum_content_titles as $key => $forum_content_title)
	{
		if($i==1){
			$tmpflag='class="cli"';
		}else{
			$tmpflag='';
		}
		
		$tempstr .='<li onmouseover="it618_firstnflex_tabChange(this,\'it618_tabcontent_forum\')" '.$tmpflag.'>'.$forum_content_title.'</li>';
		$i=$i+1;
		
	}
	return '<ul><li class="it618_lifirst"></li>'.$tempstr.'</ul>';
}

function it618_nflex_getforum_list($forum_content_lists){
	$i=1;

	foreach($forum_content_lists as $key => $forum_content_list)
	{
		if($i==1){
			$tmpflag='';
		}else{
			$tmpflag='class="hidden"';
		}
		$tempstr.='<div '.$tmpflag.' id="it618_tabcontent_forum'.$i.'"><ul class="it618_flex_list">';
		
		if(strpos($forum_content_list,"block")==1){
			$tmparr=explode(",",$forum_content_list);
			$tempstr.=it618_nflex_gettui(str_replace("}","",$tmparr[1]));
		}elseif(strpos($forum_content_list,"member_todaypost")==1){
			$tempstr.=it618_nflex_getblock($forum_content_list,"member_todaypost");
		}elseif(strpos($forum_content_list,"member_daypost")==1){
			$tempstr.=it618_nflex_getblock($forum_content_list,"member_daypost");
		}elseif(strpos($forum_content_list,"member_monthpost")==1){
			$tempstr.=it618_nflex_getblock($forum_content_list,"member_monthpost");
		}
		$tempstr.='</ul></div>';
		$i=$i+1;
		
	}
	return $tempstr;
}

function it618_nflex_getnmember_nv($nmember_content_titles){
	$i=1;
	
	foreach($nmember_content_titles as $key => $nmember_content_title)
	{
		if($i==1){
			$tmpflag='class="cli"';
		}else{
			$tmpflag='';
		}
		
		$tempstr .='<li onmouseover="it618_firstnflex_tabChange(this,\'it618_tabcontent_nmember\')" '.$tmpflag.'>'.$nmember_content_title.'</li>';
		$i=$i+1;
		
	}
	return '<ul><li class="it618_lifirst"></li>'.$tempstr.'</ul>';
}

function it618_nflex_getnmember_list($nmember_content_lists){
	$i=1;

	foreach($nmember_content_lists as $key => $nmember_content_list)
	{
		if($i==1){
			$tmpflag='';
		}else{
			$tmpflag='class="hidden"';
		}
		$tempstr.='<div '.$tmpflag.' id="it618_tabcontent_nmember'.$i.'"><ul>';
		
		if(strpos($nmember_content_list,"block")==1){
			$tmparr=explode(",",$nmember_content_list);
			$tempstr.=it618_nflex_gettui(str_replace("}","",$tmparr[1]));
		}elseif(strpos($nmember_content_list,"member_onlinetime")==1){
			$tempstr.=it618_nflex_getblock($nmember_content_list,"member_onlinetime");
		}elseif(strpos($nmember_content_list,"member_homeview")==1){
			$tempstr.=it618_nflex_getblock($nmember_content_list,"member_homeview");
		}
		
		$tempstr.='</ul></div>';
		$i=$i+1;
		
	}
	return $tempstr;
}

function it618_nflex_getblock($content_list,$blocktype){
	global $_G;
	$titles=explode(",",lang('plugin/it618_firstnflex', 'it618_string'));
	
	if($blocktype=="member_onlinetime"){
		$tmparr=explode(",",$content_list);
		$membercount=str_replace("}","",$tmparr[1]);
		if(!preg_match('[0-9]',$membercount))$membercount=14;

		$query = DB::query("SELECT m.uid,m.username FROM ".DB::table('common_member')." m,".DB::table('common_onlinetime')." o where m.uid=o.uid ORDER BY o.total DESC limit 0, $membercount");

		while($result = DB::fetch($query)) {
			$tempstr .='<li><a href="home.php?mod=space&uid='.$result['uid'].'" c="1" target="_blank" title="'.$result['username'].'"><img src="'.it618_nflex_discuz_uc_avatar($result['uid'],'small').'"/><br>'.$result['username'].'</a></li>';
		}
		return it618_nflex_rewriteurl($tempstr);
	}elseif($blocktype=="member_homeview"){
		$tmparr=explode(",",$content_list);
		$membercount=str_replace("}","",$tmparr[1]);
		if(!preg_match('[0-9]',$membercount))$membercount=14;

		$query = DB::query("SELECT m.uid,m.username FROM ".DB::table('common_member')." m,".DB::table('common_member_count')." o where m.uid=o.uid ORDER BY o.views DESC limit 0, $membercount");

		while($result = DB::fetch($query)) {
			$tempstr .='<li><a href="home.php?mod=space&uid='.$result['uid'].'" c="1" target="_blank" title="'.$result['username'].'"><img src="'.it618_nflex_discuz_uc_avatar($result['uid'],'small').'"/><br>'.$result['username'].'</a></li>';
		}
		return it618_nflex_rewriteurl($tempstr);
	}elseif($blocktype=="thread_newreply"){
		require_once libfile('function/discuzcode');
		$tmparr=explode("<>",$content_list);
		$notinstr=str_replace("}","",$tmparr[1]);
		if($notinstr!="")$notinstr=" and t.fid not in".$notinstr;
		$query = DB::query("SELECT p.fid,p.tid,p.pid,f.name,t.subject,p.message,p.dateline,p.authorid, p.author FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f, ".DB::table('forum_post')." p where  f.status<>'3' AND f.fid=t.fid AND t.tid=p.tid AND t.displayorder not IN(-1,-2) $notinstr and p.subject='' ORDER BY p.dateline DESC LIMIT 0, 10");
		
		$i=1;
		while($result = DB::fetch($query)) {
			$tempstr .='<li><span class="it618_flex_author"><a href="home.php?mod=space&uid='.$result['authorid'].'" target="_blank">'.$result['author'].'</a></span><em class="it618_flex_ranknum'.$i.'">'.$i.'</em><a class="quicktip" href="forum.php?mod=redirect&goto=findpost&ptid='.$result['tid'].'&pid='.$result['pid'].'&fromuid='.$result['fid'].'" title="'.$titles[0].$result['subject'].'<br>'.$titles[1].$result['name'].'" target="_blank">'.cutstr(it618_nflex_ubbtotext($result['message']), 55, '..').'</a><div class=it618_title><br>'.discuzcode($result['message'], 0, 0, 0, 1, 1, 0, 0, 0, 0, 0).'</div></li>';
			$i=$i+1;
		}
		return it618_nflex_rewriteurl($tempstr);
	}elseif($blocktype=="thread_newthreadreply"){
		require_once libfile('function/discuzcode');
		$tmparr=explode("<>",$content_list);
		$notinstr=str_replace("}","",$tmparr[1]);
		if($notinstr!="")$notinstr=" and t.fid not in".$notinstr;
		$query = DB::query("SELECT p.fid,p.tid,p.pid,f.name,t.subject,p.message,p.dateline,p.authorid, p.author FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f, ".DB::table('forum_post')." p where  f.status<>'3' AND f.fid=t.fid AND t.tid=p.tid AND t.displayorder not IN(-1,-2) $notinstr and p.subject='' ORDER BY p.dateline DESC");
		
		$i=1;
		while($result = DB::fetch($query)) {
			
			if(!in_array($result['tid'],$tmptid)){
				$tempstr .='<li><span class="it618_flex_author"><a href="home.php?mod=space&uid='.$result['authorid'].'" target="_blank">'.$result['author'].'</a></span><em class="it618_flex_ranknum'.$i.'">'.$i.'</em><a class="quicktip" href="forum.php?mod=viewthread&tid='.$result['tid'].'" title="'.$titles[0].$result['subject'].'<br>'.$titles[1].$result['name'].'" target="_blank">'.$result['subject'].'</a><div class=it618_title><br>'.discuzcode($result['message'], 0, 0, 0, 1, 1, 0, 0, 0, 0, 0).'</div></li>';
				$i=$i+1;
				$tmptid[]=$result['tid'];
			}
			if($i>10)break;
		}
		return it618_nflex_rewriteurl($tempstr);
	}elseif($blocktype=="member_todaypost"){
		require_once libfile('function/discuzcode');
		$tomonth = date('n'); 
		$todate = date('j'); 
		$toyear = date('Y');
		$time=mktime(0, 0, 0, $tomonth, $todate, $toyear);
		
		$query = DB::query("select count(p.pid) as pcount, p.authorid, p.author FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f, ".DB::table('forum_post')." p where  f.status<>'3' AND f.fid=t.fid AND p.dateline>=$time AND t.tid=p.tid AND t.displayorder not IN(-1,-2) group by p.authorid ORDER BY pcount DESC LIMIT 0, 10");
		
		$i=1;
		while($result = DB::fetch($query)) {
			$tempstr .='<li><span class="it618_flex_author">'.$result['pcount'].'</span><em class="it618_flex_ranknum'.$i.'">'.$i.'</em><a c="1" href="home.php?mod=space&uid='.$result['authorid'].'" title="'.$result['author'].'" target="_blank">'.$result['author'].'</a></li>';
			$i=$i+1;
		}
		return it618_nflex_rewriteurl($tempstr);
	}elseif($blocktype=="member_daypost"){
		require_once libfile('function/discuzcode');
		$tomonth = date('n'); 
		$todate = date('j'); 
		$toyear = date('Y');
		$time=mktime(0, 0, 0, $tomonth, $todate, $toyear) - 604800;
		
		$query = DB::query("select count(p.pid) as pcount, p.authorid, p.author FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f, ".DB::table('forum_post')." p where  f.status<>'3' AND f.fid=t.fid AND p.dateline>=$time AND t.tid=p.tid AND t.displayorder not IN(-1,-2) group by p.authorid ORDER BY pcount DESC LIMIT 0, 10");
		
		$i=1;
		while($result = DB::fetch($query)) {
			$tempstr .='<li><span class="it618_flex_author">'.$result['pcount'].'</span><em class="it618_flex_ranknum'.$i.'">'.$i.'</em><a c="1" href="home.php?mod=space&uid='.$result['authorid'].'" title="'.$result['author'].'" target="_blank">'.$result['author'].'</a></li>';
			$i=$i+1;
		}
		return it618_nflex_rewriteurl($tempstr);
	}elseif($blocktype=="member_monthpost"){
		require_once libfile('function/discuzcode');
		$tomonth = date('n'); 
		$todate = date('j'); 
		$toyear = date('Y');
		$time=mktime(0, 0, 0, $tomonth, 1, $toyear);
		
		$query = DB::query("select count(p.pid) as pcount, p.authorid, p.author FROM ".DB::table('forum_thread')." t, ".DB::table('forum_forum')." f, ".DB::table('forum_post')." p where  f.status<>'3' AND f.fid=t.fid AND p.dateline>=$time AND t.tid=p.tid AND t.displayorder not IN(-1,-2) group by p.authorid ORDER BY pcount DESC LIMIT 0, 10");
		
		$i=1;
		while($result = DB::fetch($query)) {
			$tempstr .='<li><span class="it618_flex_author">'.$result['pcount'].'</span><em class="it618_flex_ranknum'.$i.'">'.$i.'</em><a c="1" href="home.php?mod=space&uid='.$result['authorid'].'" title="'.$result['author'].'" target="_blank">'.$result['author'].'</a></li>';
			$i=$i+1;
		}
		return it618_nflex_rewriteurl($tempstr);
	}
	
}

function it618_nflex_ubbtotext($Text) {
		$Text=preg_replace("/\[url=(.+?)\](.+?)\[\/.+?\]/is","",$Text);
		$Text=preg_replace("/\[coverimg\](.+?)\[\/coverimg\]/is","",$Text);
		$Text=preg_replace("/\[img\](.+?)\[\/img\]/is","",$Text);
		$Text=preg_replace("/\[img=(.+?)\](.+?)\[\/img\]/is","",$Text);
		$Text=preg_replace("/\[media=(.+?)\](.+?)\[\/media\]/is","",$Text);
		$Text=preg_replace("/\[attach\](.+?)\[\/attach\]/is","",$Text);
		$Text=preg_replace("/\[audio\](.+?)\[\/audio\]/is","",$Text);
		$Text=preg_replace("/\[hide\](.+?)\[\/hide\]/is","",$Text);
		$Text=preg_replace("/\[(.+?)\]/is","",$Text);
		$Text=preg_replace("/\{:(.+?):\}/is","",$Text);
		
		$Text=str_replace("<br />","",$Text);
        return $Text;
}

function it618_nflex_getusername($uid){
	return DB::result_first("select username from ".DB::table('common_member')." where uid=".$uid);
}

function it618_nflex_discuz_uc_avatar($uid, $size = '', $returnsrc = TRUE) {
	if($uid > 0) {
	   $size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
	   $uid = abs(intval($uid));
	   if(empty($GLOBALS['avatarmethod'])) {
		return $returnsrc ? UC_API.'/avatar.php?uid='.$uid.'&size='.$size : '<img src="'.UC_API.'/avatar.php?uid='.$uid.'&size='.$size.'" />';
	   } else {
		$uid = sprintf("%09d", $uid);
		$dir1 = substr($uid, 0, 3);
		$dir2 = substr($uid, 3, 2);
		$dir3 = substr($uid, 5, 2);
		$file = UC_API.'/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).'_avatar_'.$size.'.jpg';
		return $returnsrc ? $file : '<img src="'.$file.'" onerror="this.onerror=null;this.src=\''.UC_API.'/images/noavatar_'.$size.'.gif\'" />';
	   }
	} else {
	   $file = $GLOBALS['boardurl'].IMGDIR.'/syspm.gif';
	   return $returnsrc ? $file : '<img src="'.$file.'" />';
	}
}
?>