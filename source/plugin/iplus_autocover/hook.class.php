<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_iplus_autocover {
 	function global_header(){
	    loadcache('plugin');
		global $_G,$postlist;
		$picstyle=$_G['forum']['picstyle'];
		$localsrc=intval($_G['cache']['plugin']['iplus_autocover']['localsrc']);
		$srcopen=intval($_G['cache']['plugin']['iplus_autocover']['srcopen']);
		$remoteopen=intval($_G['cache']['plugin']['iplus_autocover']['remoteopen']);
		if($srcopen||$remoteopen) $localsrc=1;
		if($localsrc&&$_G['fid']&&$_GET['mod']=='forumdisplay'&&$picstyle){//开启了图片列表形式的版块
			$width=intval($_G['cache']['plugin']['iplus_autocover']['width']);	
			foreach($_G['forum_threadlist'] as $k=>$v){
				if(!$_G['forum_threadlist'][$k]['coverpath']){//没有封面
					$cover='';
					require_once DISCUZ_ROOT.'./source/discuz_version.php';
					$filepath=DISCUZ_ROOT.'./data/sysdata/cache_cover_'.$v['tid'].'.php';
					if(DISCUZ_VERSION=='X2') $filepath=DISCUZ_ROOT.'./data/cache/cache_cover_'.$v['tid'].'.php';	
					if(file_exists($filepath)){
						@include_once $filepath;
						//兼容http://addon.discuz.com/?@qiniuyun.plugin
						if(substr_count($cover,'7niu')==1&&substr_count($cover,'http')==0) $cover=$_G['cache']['plugin']['iplus_autocover']['remote'].str_replace('data/attachment/','',$cover);
						$_G['forum_threadlist'][$k]['coverpath']=$cover;
						$_G['forum_threadlist'][$k]['cover']=1;
						continue;
					}
					$coverset=0;
					$querys = DB::query("SELECT aid,tableid FROM ".DB::table('forum_attachment')." WHERE tid=".$v['tid']." order by aid asc");
					while($attach=DB::fetch($querys)){
						if($attach['aid']){
							$pic=DB::fetch_first("SELECT remote,attachment FROM ".DB::table('forum_attachment_'.$attach['tableid'])." WHERE aid=".$attach['aid']." and width>$width and isimage=1");
							if($pic['attachment']){
								if($pic['remote']&&$remoteopen&&file_exists(DISCUZ_ROOT.'./source/plugin/iplus_autocover/lib/remote.lib.php')){//远程附件
									@include DISCUZ_ROOT . './source/plugin/iplus_autocover/lib/remote.lib.php';
									if($coverset==1) break;
								}else{//本地附件
									if(!$pic['remote']){
										$_G['forum_threadlist'][$k]['cover']=1;
										$_G['forum_threadlist'][$k]['coverpath']='data/attachment/forum/'.$pic['attachment'];
										@require_once libfile('function/cache');
										$cacheArray .= "\$cover='".$_G['forum_threadlist'][$k]['coverpath']."';\n";
										writetocache('cover_'.$v['tid'], $cacheArray);										
										$coverset=1;
										break;
									}
								}
							}
						}
					}
					if($coverset!=1&&$srcopen&&file_exists(DISCUZ_ROOT.'./source/plugin/iplus_autocover/lib/img.lib.php')){//外部插入图片
						@include DISCUZ_ROOT . './source/plugin/iplus_autocover/lib/img.lib.php';
					}
				}		
			}
		}	
	}
}

?>