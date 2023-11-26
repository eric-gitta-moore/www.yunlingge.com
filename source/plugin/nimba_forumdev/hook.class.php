<?php
/*
 * 主页：https://addon.dismall.com/?@1552.developer
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_nimba_forumdev {
	function __construct(){
		global $_G;	
		loadcache('plugin');
		$vars = $_G['cache']['plugin']['nimba_forumdev'];
		$this->margin=intval($vars['margin']);
		if($this->margin==0){
			$this->margin='';
		}else{
			$this->margin='margin-left:'.$this->margin.'px;';
		}
		$this->listwidth=intval($vars['listwidth']);
		$this->forums=unserialize($vars['forums']);
		$this->num=intval($vars['num']);
		$this->order=intval($vars['order']);
		$this->style=intval($vars['style']);
		$this->tuicache=intval($vars['tuicache']);
		$this->tuis='';//free
	}
	
	function devGetTuis($fid){
		if(!$this->tuis) return '';
		if(!$this->tid_by_fid[$fid]) return '';
		$filepath=DISCUZ_ROOT.'./data/sysdata/cache_nimba_forumdev_tui.php';
		$dateline=0;
		$hash='';
		if(file_exists($filepath)){
			@include $filepath;	
		}
		$newhash=md5($this->tuis);
		if($newhash!=$newhash||TIMESTAMP-$dateline>=$this->tuicache){//推送有跳转或者缓存到期
			$threadlist=C::t('forum_thread')->fetch_all_by_tid($this->alltid);
			if($threadlist){
				@require_once libfile('function/cache');
				$cacheArray = "\$threadlist=".arrayeval($threadlist).";\n";
				$cacheArray .= "\$dateline=".TIMESTAMP.";\n";
				$cacheArray .= "\$hash='".$newhash."';\n";
				writetocache('nimba_forumdev_tui',$cacheArray);	
			}
		}
		$res=array();
		if($threadlist){
			foreach($threadlist as $k=>$thread){
				if($thread['fid']==$fid&&in_array($thread['tid'],$this->tid_by_fid[$fid])) $res[]=$thread;
			}
		}
		return $res;
	}
	
	function devGetThreads($fid,$threads,$posts){//按fid调取最新帖子
		$filepath=DISCUZ_ROOT.'./data/sysdata/cache_nimba_forumdev_'.$fid.'.php';
		$dateline=time();
		if(file_exists($filepath)){
			@include $filepath;	
		}
		if($threadlist&&$old_threads==$threads&&$old_posts==$posts&&$old_num==$this->num&&$old_order==$this->order){//缓存存在 且主题回复数一致、配置数据一致，直接返回数据
			return $threadlist; 
		}else{
			if($this->order==2){
				$order='lastpost';
			}else{
				$order='dateline';
			}
			$threadlist=C::t('forum_thread')->fetch_all_by_fid_displayorder(array($fid),0,null,null, $start = 0,$this->num,$order) ;
			if($threadlist){
				@require_once libfile('function/cache');
				$cacheArray = "\$threadlist=".arrayeval($threadlist).";\n";
				$cacheArray .= "\$old_threads=".intval($threads).";\n";
				$cacheArray .= "\$old_posts=".intval($posts).";\n";
				$cacheArray .= "\$old_num=".intval($this->num).";\n";
				$cacheArray .= "\$old_order=".intval($this->order).";\n";
				writetocache('nimba_forumdev_'.$fid,$cacheArray);	
			}
			return $threadlist;
		}
	}
	
	function global_header(){//引入全局css
	
		global $_G;
		
		return '
<style>		
.forumdev {width:100%;margin-top:0px;'.$this->margin.'background: url(\'/source/plugin/nimba_forumdev/listnum.gif\') no-repeat;}
.forumdev ul {padding:0 2px 0 22px;list-style-type:none;line-height: 25px; }
.forumdev ul li{height:25px;line-height:25px;width:'.$this->listwidth.'%;overflow:hidden;background:url(\'/source/plugin/nimba_forumdev/dotline.gif\');}
.forumdev ul li span{float:right;margin: 0 0 0 5px}
</style>		
		';
	}
}
class plugin_nimba_forumdev_forum extends plugin_nimba_forumdev {
	function devGetHighlight($highlight){//解析高亮
		global $_G;
		return '';//free
	}
	
	function index_forum_extra_output(){//对开启的版块逐个处理
		global $_G,$forumlist,$catlist;
		$html=array();
		loadcache('plugin');
		foreach($forumlist as $fid=>$forum){
			if(in_array($fid,$this->forums)){//关闭版块
				$html[$fid]='';
				continue;
			}
			if($forum['threads']==0||$forum['posts']==0){//版块没有内容
				$html[$fid]='';
				continue;
			}
			if(!isset($_GET['gid'])&&$catlist[$forum['fup']]['forumcolumns']<2){//论坛首页 横排检查
				$html[$fid]='';
				continue;
			}
			if(isset($_GET['gid'])&&$catlist[$forum['fup']]['catforumcolumns']<2){//分区页面 横排检查
				$html[$fid]='';
				continue;
			}
			$thread_tui=$this->devGetTuis($fid);
			$threads=$this->devGetThreads($fid,$forum['threads'],$forum['posts']);
			if($thread_tui){
				$threads=array_merge($thread_tui,$threads);
				$threads=array_slice($threads,0,$this->num);
			}
			include template('nimba_forumdev:list');
			$html[$fid]=$list;
		}
		return $html;
	}
	
	function forumdisplay_subforum_extra_output(){//子版块设置
		global $_G,$sublist;
		$html=array();
		if($_G['forum']['forumcolumns']>=2){
			foreach($sublist as $_k=>$forum){
				$fid=$forum['fid'];
				if(in_array($fid,$this->forums)){//关闭版块
					$html[$fid]='';
					continue;
				}
				if($forum['threads']==0||$forum['posts']==0){//版块没有内容
					$html[$fid]='';
					continue;
				}
				$thread_tui=$this->devGetTuis($fid);
				$threads=$this->devGetThreads($fid,$forum['threads'],$forum['posts']);
				if($thread_tui){
					$threads=array_merge($thread_tui,$threads);
					$threads=array_slice($threads,0,$this->num);
				}
				include template('nimba_forumdev:list');
				$html[$fid]=$list;				
			}	
		}
		//var_dump($html);
		return $html;
	}
}

?>