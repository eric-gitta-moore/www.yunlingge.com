<?php
/*
 *源 码    哥     y     m     g     6   .  c    o m
 *更多商业插件/模版免费下载 就在源  码     哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_llx_noreply {
	
	public $config = array();
	
	public function __construct() {
		
		global $_G;
		$this->config = $_G['cache']['plugin']['llx_noreply'];
	}
	
	public function post_message($p) {
		
		global $_G;
		
		if(!in_array($_G['fid'], unserialize($this->config['fids']))) return;
		if(!in_array($_G['groupid'], unserialize($this->config['gids']))) return;
		
		$param = $p['param'];
		if(($param[0] == 'post_newthread_succeed' || $param[0] == 'post_newthread_mod_succeed') && intval($_GET['noreply'])) {
			
			$tid = $param[2]['tid'];
			C::t('forum_thread')->update($tid, array('closed'=>1), true);
			DB::insert('forum_threadmod', array(
				'tid' => $tid,
				'uid' => $_G['uid'],
				'username' => $_G['username'],
				'dateline' => TIMESTAMP,
				'expiration' => 0,
				'action' => 'CLS',
				'status' => 1,
				'stamp' => '',
			));	
		}
	}
}

class plugin_llx_noreply_forum extends plugin_llx_noreply {
	
	public function post_middle() {
	
		global $_G;
		
		if(!in_array($_G['fid'], unserialize($this->config['fids']))) return;
		if(!in_array($_G['groupid'], unserialize($this->config['gids']))) return;
		
		include template('llx_noreply:index');
		return $return;
	}
}

class mobileplugin_llx_noreply_forum extends plugin_llx_noreply {
	
	public function post_bottom_mobile() {
		
		global $_G;
		
		if(!in_array($_G['fid'], unserialize($this->config['fids']))) return;
		if(!in_array($_G['groupid'], unserialize($this->config['gids']))) return;
		
		include template('llx_noreply:index');
		return $return;	
	}
}