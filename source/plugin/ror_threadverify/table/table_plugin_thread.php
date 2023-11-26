<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_thread extends discuz_table
{
    var $moderate_status = array();
    var $thread_dateline = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->_pk = 'tid';
        $this->_table = 'forum_thread';
        
        $this->moderate_status = array(
            0=>lib_base::lang('moderate_status0'),
            1=>lib_base::lang('moderate_status1'),
        );
        $this->thread_dateline = array(
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
    
    //删除不存在的审核
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
    public function moderate_thread($moderate)
    {
        global $_G;
        
        $modfid = intval($_GET['modfid']);
        if($modfid && $modfid != '-1'){
            $fidadd = array('fids' => $modfid);
        }else{
            $fidadd = array();
        }

        $validates = $ignores = $recycles = $deletes = 0;
        $validatedthreads = $pmlist = array();
        $moderation = array('validate' => array(), 'delete' => array(), 'ignore' => array());
        
        $recyclebins = $forumlist = array();
        $query = C::t('forum_forum')->fetch_all_valid_forum();
        foreach($query as $forum){
            $recyclebins[$forum['fid']] = $forum['recyclebin'];
            $forumlist[$forum['fid']] = $forum['name'];
        }
        
        if(is_array($moderate)){
            foreach($moderate as $tid => $act){
                $moderation[$act][] = intval($tid);
            }
        }
        
        require_once libfile('function/forum');
        require_once libfile('function/post');
        
        if($moderation['ignore']){
            $ignores = C::t('forum_thread')->update_displayorder_by_tid_displayorder($moderation['ignore'], -2, -3);
            updatemoderate('tid', $moderation['ignore'], 1);
        }
        
        if($moderation['delete'])
        {
            $deletetids = array();
            $recyclebintids = array();
            foreach(C::t('forum_thread')->fetch_all_by_tid_fid($moderation['delete'], $fidadd['fids']) as $thread)
            {
                if($recyclebins[$thread['fid']]) {
                    $recyclebintids[] = $thread['tid'];
                } else {
                    $deletetids[] = $thread['tid'];
                }
                $pm = 'pm_'.$thread['tid'];
                if($thread['authorid'] && $thread['authorid'] != $_G['uid']) {
                    $pmlist[] = array(
                        'action' =>  $_GET[$pm] ? 'modthreads_delete_reason' : 'modthreads_delete',
                        'notevar' => array('threadsubject' => $thread['subject'], 'reason' => $_GET[$pm]),
                        'authorid' => $thread['authorid'],
                    );
                }
            }
            require_once libfile('function/delete');
            if($recyclebintids){
                $recycles = deletethread($recyclebintids, false, false, true);
                updatemodworks('MOD', $recycles);
                updatemodlog(implode(',', $recyclebintids), 'DEL');
            }
        
            $deletes = deletethread($deletetids);
            updatemoderate('tid', $moderation['delete'], 2);
        }
        
        $thread_normal_validate = 0;
        if($moderation['validate'])
        {
            $forums = array();
        
            $tids = $authoridarray = $moderatedthread = array();
            $threadlist = C::t('forum_thread')->fetch_all_by_tid_fid($moderation['validate'], $fidadd['fids']);
            foreach($threadlist as $thread)
            {
                if($thread['displayorder'] != -2 && $thread['displayorder'] != -3){
                    if($thread['displayorder'] >= 0){
                        updatemoderate('tid', $thread['tid'], 2);
                        $thread_normal_validate++;
                    }
                    continue;
                }
                $poststatus = C::t('forum_post')->fetch_threadpost_by_tid_invisible($thread['tid']);
                $poststatus = $poststatus['status'];
                $tids[] = $thread['tid'];
        
                if(getstatus($poststatus, 3) == 0){
                    updatepostcredits('+', $thread['authorid'], 'post', $thread['fid']);
                    $attachcount = C::t('forum_attachment_n')->count_by_id('tid:'.$thread['tid'], 'tid', $thread['tid']);
                    updatecreditbyaction('postattach', $thread['authorid'], array(), '', $attachcount, 1, $thread['fid']);
                }
        
                $forums[] = $thread['fid'];
                $validatedthreads[] = $thread;
        
                $pm = 'pm_'.$thread['tid'];
                if($thread['authorid'] && $thread['authorid'] != $_G['uid']){
                    $pmlist[] = array(
                        'action' => 'modthreads_validate',
                        'notevar' => array('tid' => $thread['tid'], 'threadsubject' => $thread['subject'], 'reason' => dhtmlspecialchars($_GET[''.$pm]), 'from_id' => 0, 'from_idtype' => 'modthreads'),
                        'authorid' => $thread['authorid'],
                    );
                }
            }
        
            if($tids)
            {
                $tidstr = dimplode($tids);
                C::t('forum_post')->update_by_tid(0, $tids, array('status' => 4), false, false, null, -2, 0);
                loadcache('posttableids');
                $posttableids = $_G['cache']['posttableids'] ? $_G['cache']['posttableids'] : array('0');
                foreach($posttableids as $id) {
                    C::t('forum_post')->update_by_tid($id, $tids, array('invisible' => '0'), false, false, 1);
                }
                $validates = C::t('forum_thread')->update($tids, array('displayorder' => 0, 'moderated' => 1));
        
                foreach(array_unique($forums) as $fid) {
                    updateforumcount($fid);
                }
        
                updatemodworks('MOD', $validates);
                updatemodlog($tidstr, 'MOD');
                updatemoderate('tid', $tids, 2);
            }
            
            if($threadlist){
                //审核统计插件
                $filename = libfile('lib/func_verifycount', 'plugin/ror_verifycount');
                if(file_exists($filename)){
                    require_once $filename;
                    foreach($threadlist as $thread){
                        lib_func_verifycount::add_by_tid($thread['tid'], 'mods');
                    }
                }
            }
        }
        
        if($pmlist){
            foreach($pmlist as $pm){
                notification_add($pm['authorid'], 'system', $pm['action'], $pm['notevar'], 1);
            }
        }
        
        return array('validates'=>($validates + $thread_normal_validate),'ignores'=>$ignores,'recycles'=>$recycles,'deletes'=>$deletes);
    }
}