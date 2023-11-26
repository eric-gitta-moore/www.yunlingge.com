<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_gp_autoreply {
	function global_footer()
	{
		return '<script class="lazy_script" data-src="/plugin.php?id=gp_autoreply:apps" type="text/javascript"></script>';
	}
	
	function _global_footer(){
		global $_G;
		loadcache('plugin');
		$vars = $_G['cache']['plugin']['gp_autoreply'];
		$maxtime=intval($vars['maxtime']);
		$last=0;
		$pidlist=array();
		if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_last.php')){
			@require_once DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_last.php';
		}
		if($_G['timestamp']-$last>$maxtime){
			$forums=unserialize($vars['forums']);
			if(!count($forums)) return '<!--gp_autoreply No any forum open-->';//未开启任何栏目的自动回复
			$fids=implode(',',$forums);
			$maxnum=intval($vars['maxnum']);
			$threadday=intval($vars['threadday']);
			$t=time()-86400*$threadday;
			$thread=DB::fetch_first("select tid,fid,subject,posttableid from ".DB::table('forum_thread')." where fid in($fids) and replies<'$maxnum' and dateline>'$t' and displayorder>=0 order by rand()");
			$tid=$thread['tid'];
			$fid=$thread['fid'];
			if(!$tid) return '<!--gp_autoreply filter by fids&&maxnum&&threadday-->';
			$tids=explode('',trim($vars['tids']));
			if(in_array($tid,$tids)){//按tid过滤掉了
				return '<!--gp_autoreply filter by tids-->';
			}
			/** contents cache **/
			$data=array();
			//free
			$r=count($data);
			if(!$r){
				/** free contents **/
				//*
				$data=array();
				$content= explode("/hhf/",str_replace(array("\r\n", "\n", "\r"), '/hhf/',$vars['contents']));
				foreach($content as $k=>$v){
					$v=trim($v);
					if($v) $data[]=$v;
				}
				$r=count($data);
				if(!$r) return '<!--gp_autoreply free contents is empty -->';
				$content=$data[rand(0,$r)];
				//*/
			}else{
				$content=$data[rand(0,$r)];
			}
			if(!$content){
				return '<!--gp_autoreply contents is empty2 -->';
			}

			/* Get user */
			$ruids=explode(",",trim($vars['ruids']));
			$majia_id=$ruids[rand(0,count($ruids))];
			$user=C::t('common_member')->fetch_all_username_by_uid(array($majia_id));
			$majia_name=$user[$majia_id];
			if(!$majia_id||!$majia_name){//重复拿一次
				$majia_id=$ruids[rand(0,count($ruids))];
				$user=C::t('common_member')->fetch_all_username_by_uid(array($majia_id));
				$majia_name=$user[$majia_id];
			}
			if(!$majia_id||!$majia_name) return '<!--gp_autoreply Can\'t get majia-->';
			$post=array();
			$post['content']=$content;
			$post['fid']=$fid;
			$post['dateline']=TIMESTAMP;
			$post['ip']=$_G['clientip'];
			$post['subject']=$thread['subject'];
			$pid=$this->gp_newpost($post,$tid,array('uid'=>$majia_id,'username'=>$majia_name),$thread['posttableid']);
			if($pid){
				$len=array_push($pidlist,array('tid'=>$tid,'pid'=>$pid,'dateline'=>TIMESTAMP));
				if($len>20){//数组中只保存最近20条
					array_shift($pidlist);
				}
				@require_once libfile('function/cache');
				$cacheArray = "\$last=".$_G['timestamp'].";\n\$tid=$tid;\n\$pid=$pid;\n";
				$cacheArray .= "\$pidlist=".arrayeval($pidlist).";\n";
				writetocache('gp_autoreply_last',$cacheArray);
				return '<!--gp_autoreply reply ok pid='.$pid.'-->';
			}else{
				return '<!--gp_autoreply Insert error-->';
			}
		}else{
			return '<!--gp_autoreply last='.date('Y-m-d H:i:s',$last).',tid='.$tid.',pid='.$pid.'-->';
		}
	}
	
	function gp_newpost($post,$tid,$user,$posttableid){
		global $_G;
		require_once libfile('function/post');
		require_once libfile('function/forum');
		$dateline=$post['dateline'];
		$invisible=0;
		$pid = insertpost(array(
			'fid' => $post['fid'],
			'tid' => $tid,
			'first' => '0',
			'author' => $user['username'],
			'authorid' => $user['uid'],
			'subject' => '',
			'dateline' =>$dateline,
			'message' => dhtmlspecialchars($post['content']),
			'useip' => $post['ip'],//,
			'invisible' => $invisible,
			'anonymous' => 0,
			'usesig' => 0,
			'htmlon' => 0,
			'bbcodeoff' => 0,
			'smileyoff' => 0,
			'parseurloff' => 0,
			'attachment' => 0,
			'tags' => '',
			'replycredit' => 0,
			'status' => 0
		 ));
		updatepostcredits('+',$user['uid'],'reply',$post['fid']);//post	
		C::t('common_member_count')->increase(array($user['uid']),array('posts'=>1));
		$postionid=C::t('forum_post')->fetch_maxposition_by_tid($posttableid,$tid);
		C::t('forum_thread')->update($tid,array('`maxposition`='.$postionid,'`replies`=`replies`+1','`heats`=`heats`+1','`views`=`views`+1','`lastpost`='.$dateline,'lastposter=\''.$user['username'].'\''),false,false,0,true);
		C::t('forum_forum')->update_forum_counter($post['fid'],0,1,1);
		$subject=dhtmlspecialchars($post['subject']);
		$lastpost = "$tid\t$subject\t".$dateline."\t".$user['username'];
		C::t('forum_forum')->update(array('fid'=>$post['fid']),array('lastpost'=>$lastpost));
		C::t('forum_thread')->clear_cache($tid);
		deletethreadcaches($tid);
		return $pid; 
	}
}

