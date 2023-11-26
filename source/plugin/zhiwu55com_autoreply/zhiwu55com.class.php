<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_zhiwu55com_autoreply {
	
	function global_footer()
	{
		global $_G;
		$cronUrl = $_G['siteurl'] . 'plugin.php?id=zhiwu55com_autoreply:hzw_cron';
		return '<script defer="defer" src="' . $cronUrl . '"></script>';
	}

}
class plugin_zhiwu55com_autoreply_forum extends plugin_zhiwu55com_autoreply {
	
	public function viewthread_fastpost_content_output() {
		
		global $_G;
		if(!isset($_G['cache']['plugin'])) {
			loadcache('plugin');
		}
		$zhiwu55com_uid = $_G['cache']['plugin']['zhiwu55com_autoreply']['zhiwu55com_uid'];
		if(strpos($zhiwu55com_uid, ',') === false) {
			$zhiwu55com_uid = array($zhiwu55com_uid);
		} else {
			$zhiwu55com_uid = explode(',', $zhiwu55com_uid);
		}
		if(!empty($zhiwu55com_uid) && in_array($_G['uid'],$zhiwu55com_uid)) {
		
			include template('zhiwu55com_autoreply:zhiwu55com_forum');
			return $zhiwu55_return;
		
		} elseif($_G['uid']==1) {
			
			include template('zhiwu55com_autoreply:zhiwu55com_forum');
			return $zhiwu55_return;
			
		}

	}
	
}
class plugin_zhiwu55com_autoreply_portal extends plugin_zhiwu55com_autoreply {
	
	public function view_article_op_extra_output() {
		
		global $_G;
		$aid=$_GET['aid'];
		$catid=DB::result_first("SELECT catid FROM %t WHERE aid=%d",array('portal_article_title',$aid));
		$allowcomment=DB::result_first("SELECT allowcomment FROM %t WHERE catid=%d",array('portal_category',$catid));
		if($allowcomment==1)
		{	
			if(!isset($_G['cache']['plugin'])) {
				loadcache('plugin');
			}
			$zhiwu55com_uid = $_G['cache']['plugin']['zhiwu55com_autoreply']['zhiwu55com_uid'];
			if(strpos($zhiwu55com_uid, ',') === false) {
				$zhiwu55com_uid = array($zhiwu55com_uid);
			} else {
				$zhiwu55com_uid = explode(',', $zhiwu55com_uid);
			}
			if(!empty($zhiwu55com_uid) && in_array($_G['uid'],$zhiwu55com_uid)) {
			
				include template('zhiwu55com_autoreply:zhiwu55com_portal');
				return $zhiwu55_return;
			
			} elseif($_G['uid']==1) {
				
				include template('zhiwu55com_autoreply:zhiwu55com_portal');
				return $zhiwu55_return;
				
			}
		}

	}
	
}
class plugin_zhiwu55com_autoreply_group extends plugin_zhiwu55com_autoreply {
	
	public function viewthread_fastpost_content_output() {
		
		global $_G;
		if(!isset($_G['cache']['plugin'])) {
			loadcache('plugin');
		}
		$zhiwu55com_uid = $_G['cache']['plugin']['zhiwu55com_autoreply']['zhiwu55com_uid'];
		if(strpos($zhiwu55com_uid, ',') === false) {
			$zhiwu55com_uid = array($zhiwu55com_uid);
		} else {
			$zhiwu55com_uid = explode(',', $zhiwu55com_uid);
		}
		if(!empty($zhiwu55com_uid) && in_array($_G['uid'],$zhiwu55com_uid)) {
		
			include template('zhiwu55com_autoreply:zhiwu55com_forum');
			return $zhiwu55_return;
		
		} elseif($_G['uid']==1) {
			
			include template('zhiwu55com_autoreply:zhiwu55com_forum');
			return $zhiwu55_return;
			
		}

	}
	
}