<?php
/*
 *Դ ��    ��     y     m     g     6   .  c    o m
 *������ҵ���/ģ��������� ����Դ  ��     ��
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
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