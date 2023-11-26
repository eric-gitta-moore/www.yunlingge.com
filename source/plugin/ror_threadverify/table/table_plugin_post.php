<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_post extends discuz_table
{
    var $moderate_status = array();
    var $post_dateline = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->_pk = 'tid';
        $this->_table = 'forum_post';
        
        $this->moderate_status = array(
            0=>lib_base::lang('moderate_status0'),
            1=>lib_base::lang('moderate_status1'),
        );
        $this->post_dateline = array(
            0=>lib_base::lang('article_dateline0'),
            604800=>lib_base::lang('article_dateline1'),
            2592000=>lib_base::lang('article_dateline2'),
            7776000=>lib_base::lang('article_dateline3'),
        );
    }
    
    /**
     * 主题审核统计
     *
     * @access public
     * @param string
     * @return int
     */
    public function censor(& $subject, & $message)
    {
        $censor = & discuz_censor::instance();
        $censor->highlight = '#FF0000';
        $censor->check($subject);
        $censor->check($message);
        $censor_words = $censor->words_found;
        if(count($censor_words) > 3) {
            $censor_words = array_slice($censor_words, 0, 3);
        }
        
        return $censor_words?implode(', ', $censor_words):'';
    }
    
    public function moderateswipe($type, $ids)
    {
        if($type == 'pid') {
            $exist_ids = array_keys(C::t('forum_post')->fetch_all(0, $ids));
        } elseif($type == 'tid') {
            $exist_ids = array_keys(C::t('forum_thread')->fetch_all($ids));
        }
        $remove_ids = array_diff($ids, $exist_ids);
        if($remove_ids) {
            return C::t('common_moderate')->delete($remove_ids, $type);
        } else {
            return 0;
        }
    }
    
    /**
     * 审核主题
     *
     * @access public
     * @param array
     * @return array
     */
    public function moderate_post($moderate)
    {
        global $_G;
        
        $modfid = intval($_GET['modfid']);
        if($modfid && $modfid != '-1'){
            $fidadd = array('fids' => $modfid);
        }else{
            $fidadd = array();
        }
        
        $recyclebins = $forumlist = array();
        $query = C::t('forum_forum')->fetch_all_valid_forum();
        foreach($query as $forum){
            $recyclebins[$forum['fid']] = $forum['recyclebin'];
            $forumlist[$forum['fid']] = $forum['name'];
        }
        
        loadcache('posttableids');
        $posttable = in_array($_GET['posttableid'], $_G['cache']['posttableids']) ? $_GET['posttableid'] : 0;

        $moderation = array('validate' => array(), 'delete' => array(), 'ignore' => array());
    	$pmlist = array();
    	$validates = $ignores = $deletes = 0;
    
    	require_once libfile('function/forum');
    	require_once libfile('function/post');
    	
    	if(is_array($moderate)){
    		foreach($moderate as $pid => $act) {
    			$moderation[$act][] = intval($pid);
    		}
    	}
    
    	if($moderation['ignore']){
    		$ignores = C::t('forum_post')->update($posttable, $moderation['ignore'], array('invisible' => -3), false, false, 0, -2, $fidadd['fids']);
    		updatemoderate('pid', $moderation['ignore'], 1);
    	}
    
    	if($moderation['delete'])
    	{
    		$pids = $recyclebinpids = array();
    		foreach(C::t('forum_post')->fetch_all($posttable, $moderation['delete']) as $post)
    		{
    			if($post['first'] != 0 || ($fidadd['fids'] && $post['fid'] != $fidadd['fids'])){
    				continue;
    			}
    			if($recyclebins[$post['fid']]) {
    				$recyclebinpids[] = $post['pid'];
    			} else {
    				$pids[] = $post['pid'];
    			}
    			$pm = 'pm_'.$post['pid'];
    			if($post['authorid'] && $post['authorid'] != $_G['uid']) {
    				$pmlist[] = array(
    					'action' => 'modreplies_delete',
    					'notevar' => array('pid' => $post['pid'], 'post' => dhtmlspecialchars(cutstr($post['message'], 30)), 'reason' => dhtmlspecialchars($_GET[''.$pm])),
    					'authorid' => $post['authorid'],
    				);
    			}
    		}
    		require_once libfile('function/delete');
    		if($recyclebinpids) {
    			deletepost($recyclebinpids, 'pid', false, $posttable, true);
    		}
    		if($pids) {
    			$deletes = deletepost($pids, 'pid', false, $posttable);
    		}
    		$deletes += count($recyclebinpids);
    		updatemodworks('DLP', count($moderation['delete']));
    		updatemoderate('pid', $moderation['delete'], 2);
    	}
    
    	if($moderation['validate'])
    	{
    		$forums = $threads = $attachments = $pidarray = $authoridarray = array();
    		$tids = $postlist = array();
    		foreach(C::t('forum_post')->fetch_all($posttable, $moderation['validate']) as $post) {
    			if($post['first'] != 0) {
    				continue;
    			}
    			$tids[$post['tid']] = $post['tid'];
    			$postlist[] = $post;
    		}
    		$threadlist = C::t('forum_thread')->fetch_all($tids);
    
    		foreach($postlist as $post)
    		{
    			$post['lastpost'] = $threadlist[$post['tid']]['lastpost'];
    
    			$pidarray[] = $post['pid'];
    			if(getstatus($post['status'], 3) == 0) {
    				updatepostcredits('+', $post['authorid'], 'reply', $post['fid']);
    				$attachcount = C::t('forum_attachment_n')->count_by_id('tid:'.$post['tid'], 'pid', $post['pid']);
    				updatecreditbyaction('postattach', $post['authorid'], array(), '', $attachcount, 1, $post['fid']);
    			}
    
    			$forums[] = $post['fid'];
    
    			$threads[$post['tid']]['replies']++;
    			if($post['dateline'] > $post['lastpost']) {
    				$threads[$post['tid']]['lastpost'] = array($post['dateline']);
    				$threads[$post['tid']]['lastposter'] = array($post['anonymous'] && $post['dateline'] != $post['lastpost'] ? '' : $post['author']);
    			}
    			if($threads[$post['tid']]['attachadd'] || $post['attachment']) {
    				$threads[$post['tid']]['attachment'] = array(1);
    			}
    
    			$pm = 'pm_'.$post['pid'];
    			if($post['authorid'] && $post['authorid'] != $_G['uid']) {
    				$pmlist[] = array(
    					'action' => 'modreplies_validate',
    					'notevar' => array('pid' => $post['pid'], 'tid' => $post['tid'], 'post' => dhtmlspecialchars(cutstr($post['message'], 30)), 'reason' => dhtmlspecialchars($_GET[''.$pm]), 'from_id' => 0, 'from_idtype' => 'modreplies'),
    					'authorid' => $post['authorid'],
    				);
    			}
    		}
    		
    		//审核统计插件
    		$filename = libfile('lib/func_verifycount', 'plugin/ror_verifycount');
    		if(file_exists($filename)){
    		    require_once $filename;
    		    loadcache('posttableids');
    		    $posttableid = in_array($_GET['posttableid'], $_G['cache']['posttableids']) ? intval($_GET['posttableid']) : 0;
    		    foreach($postlist as $post){
    		        lib_func_verifycount::add_by_pid($post['pid'], $posttableid, 'mods');
    		    }
    		}
    		
    		unset($postlist, $tids, $threadlist);
    
    		foreach($threads as $tid => $thread) {
    			C::t('forum_thread')->increase($tid, $thread);
    		}
    
    		foreach(array_unique($forums) as $fid) {
    			updateforumcount($fid);
    		}
    
    		if(!empty($pidarray)) {
    			C::t('forum_post')->update($posttable, $pidarray, array('status' => 4), false, false, null, -2, null, 0);
    			$validates = C::t('forum_post')->update($posttable, $pidarray, array('invisible' => 0));
    			updatemodworks('MOD', $validates);
    			updatemoderate('pid', $pidarray, 2);
    		} else {
    		    require_once libfile('function/forum');
    			updatemodworks('MOD', 1);
    		}
    	}
    
    	if($pmlist) {
    		foreach($pmlist as $pm) {
    			notification_add($pm['authorid'], 'system', $pm['action'], $pm['notevar'], 1);
    		}
    	}
        
        return array('validates'=>$validates,'ignores'=>$ignores,'recycles'=>0,'deletes'=>$deletes);
    }
}