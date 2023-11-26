<?php
	if($aconfig['tagid']==1){
		//标签
		$sql = 'SELECT a.tagid,a.tagname FROM '.DB::table('common_tag').' a ORDER BY a.tagid DESC';
		$query = DB::query($sql);
		while($arr = DB::fetch($query)) {
			if($aconfig['num']>0 && $xmli>=$aconfig['num']){Afengge($filename,$sitemap,$fgi,$aconfig['urlset']);$fgi++;$xmli=0;}
			if($aconfig_alias){
				if($charsetto) $arr['tagname'] = iconv($charsetto,"UTF-8//IGNORE",$arr['tagname']);
				if($aconfig_alias['urlcode']==1){$arr['tagname'] = rawurlencode($arr['tagname']);}
				$turl="http://".subdomain('forum').$web_root.str_replace('{tagid}',$arr['tagname'],$aconfig_alias['tags']);
			}else{
				$turl="http://".subdomain('forum').$web_root.'misc.php?mod=tag&amp;id='.$arr['tagid'];//动态规则,xml中&要换成&amp;
			}
			$sitemap .= sitemap_format($turl,date("Y-m-d",time()),$aconfig['tagid_priority'],$changefreq[$aconfig['tagid_cycle']]);
			$xmlnum['tagid']++;$xmli++;
		}
	}
	if($aconfig['blogid']==1){
		//空间日志
		$rewrite=get_rewrite('home_blog');
		$crr = explode('|',$aconfig['tid_config']);
		if($crr[1]>0){$where = 'and a.dateline>'.(time()-$crr[1]*86400);}else{$where = '';}
		if($crr[2]>0){$limit = 'LIMIT 0,'.$crr[2];}else{$limit = '';}
		$sql = "SELECT a.blogid,a.uid,a.dateline FROM ".DB::table('home_blog')." a WHERE a.friend=0 $where ORDER BY a.blogid DESC $limit";
		$query = DB::query($sql);
		while($arr = DB::fetch($query)) {
			if($aconfig['num']>0 && $xmli>=$aconfig['num']){Afengge($filename,$sitemap,$fgi,$aconfig['urlset']);$fgi++;$xmli=0;}
			if($rewrite) $turl="http://".subdomain('default').$web_root.str_replace(array('{uid}','{blogid}'),array($arr['uid'],$arr['blogid']),$rewrite);//静态规则
			else $turl="http://".subdomain('default').$web_root.'home.php?mod=space&amp;uid='.$arr['uid'].'&amp;do=blog&amp;id='.$arr['blogid'];//动态规则,xml中&要换成&amp;
			$sitemap .= sitemap_format($turl,date("Y-m-d",$arr['dateline']),$crr[0],$changefreq[$aconfig['aid_cycle']]);
			$xmlnum['blogid']++;$xmli++;
		}
	}
?>