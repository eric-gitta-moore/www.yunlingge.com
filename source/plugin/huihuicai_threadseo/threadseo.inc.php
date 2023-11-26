<?php

/**
 *  添加主题SEO标题
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

define('THREADSEO_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.urlencode($_GET['identifier']).'&pmod='.urlencode($_GET['pmod']));
define('THREADSEO_MANAGE_VALIDITY', 6 * 30 * 86400); //只管理多长时间内主题

require_once libfile('function/post');

$optype = $_GET['optype'];
$_GET['optype'] = !empty($_GET['optype']) ? trim($_GET['optype']) : '';
if(empty($_GET['moderate'])) {
    $tids = $threadcount = '0';
    if($_GET['optype'] == 'search' && empty($_GET['keywords'])){
        $threadcount = '0';
    }else{
        $_GET['perpage'] = intval($_GET['perpage']) < 1 ? 10 : intval($_GET['perpage']);
        $perpage = $_GET['pp'] ? $_GET['pp'] : $_GET['perpage'];
        $start = ($page - 1) * $perpage;
        $threads = '';
        $threadlist = array();

        if($_GET['optype'] == 'search'){
        }else{
            //获取n天前的主题
            $dateline = getglobal('timestamp') - THREADSEO_MANAGE_VALIDITY;

            $sql_seo = ' FROM pre_forum_thread t 
				    LEFT JOIN pre_forum_thread_seo_edited e ON t.tid=e.tid 
				    LEFT JOIN pre_forum_thread_seo_ignored i ON t.tid=i.tid 
				    WHERE t.`displayorder`>=0';
            $sql_seo_order = ' ORDER BY t.tid DESC';

            if($_GET['optype'] == 'search'){
                //搜索(走数据库的搜索，已不使用)
                $keywords = trim($_GET['keywords']);
                $sql_seo .= " AND t.subject LIKE '%".$keywords."%'";
            }elseif($_GET['optype'] == 'edited'){
                //已编辑主题
                $sql_seo .= ' AND e.tid IS NOT NULL';
                $sql_seo_order = ' ORDER BY e.edited_time DESC';
            }elseif($_GET['optype'] == 'ignored'){
                //已忽略主题
                $sql_seo .= ' AND i.tid IS NOT NULL';
                $sql_seo_order = ' ORDER BY i.ignored_time DESC';
            }else{
                //全部主题
                $sql_seo .= ' AND t.`dateline`>'.$dateline.' AND e.tid IS NULL AND i.tid IS NULL';
            }

            $threadcount = DB::result_first("SELECT COUNT(*)".$sql_seo);
            if($threadcount) {
                $perpage_limit = $perpage;
                if($page == ceil($threadcount / $perpage)){
                    $perpage_limit = max($threadcount - $start, 0);
                }
                foreach (DB::fetch_all("SELECT t.tid, t.subject, t.dateline, t.views, t.replies, e.seo_title, e.edited_time, i.ignored_time"
                    . $sql_seo . $sql_seo_order . DB::limit($start, $perpage_limit)) as $thread) {
                    $thread['dateline'] = $thread['dateline'] ? dgmdate($thread['dateline']) : 0;
                    $thread['edited_time'] = $thread['edited_time'] ? dgmdate($thread['edited_time']) : 0;
                    $thread['ignored_time'] = $thread['ignored_time'] ? dgmdate($thread['ignored_time']) : 0;
                    $threadlist[] = $thread;
                }
            }
        }
        if($threadcount) {
            if($threadlist) {
                //表格头
                $table_th = [
                    lang('plugin/huihuicai_threadseo', 'order'), 
                    lang('plugin/huihuicai_threadseo', 'subject'),
                    lang('plugin/huihuicai_threadseo', 'dateline'),
                    lang('plugin/huihuicai_threadseo', 'edited_title'),
                    lang('plugin/huihuicai_threadseo', 'edited_time'),
                    lang('plugin/huihuicai_threadseo', 'ignored_time'),
                    lang('plugin/huihuicai_threadseo', 'status'),
                    lang('plugin/huihuicai_threadseo', 'views'),
                    lang('plugin/huihuicai_threadseo', 'replies'),
                    lang('plugin/huihuicai_threadseo', 'operation')
                ];
                //表格列
                $table_td = ['class="td25"', '', '', '', '', '', 'class="td25"', 'class="td23"', 'class="td23"', 'class="td24"'];

                //不同tab显示不同列
                if(!empty($_GET['optype']) && $_GET['optype'] == 'edited'){
                    //已编辑主题
                    unset($table_th[5], $table_th[6], $table_td[5], $table_td[6]);
                }elseif(!empty($_GET['optype']) && $_GET['optype'] == 'ignored'){
                    //已忽略主题
                    unset($table_th[3], $table_th[4], $table_th[6], $table_td[3], $table_td[4], $table_td[6]);
                }elseif(!empty($_GET['optype']) && $_GET['optype'] == 'search'){
                    //搜索
                    unset($table_th[4], $table_th[5], $table_td[4], $table_td[5]);
                }else{
                    //全部主题
                    unset($table_th[3], $table_th[4], $table_th[5], $table_th[6], $table_td[3], $table_td[4], $table_td[5], $table_td[6]);
                }

                //不同tab显示不同表格列值
                foreach($threadlist as $key=>$thread) {
                    //表格值
                    $table_td_value = [
                        $key + 1,
                        "<a href=\"forum.php?mod=viewthread&tid=$thread[tid]\" target=\"_blank\">$thread[subject]</a>",
                        $thread['dateline'],
                        $thread['seo_title'],
                        $thread['edited_time'],
                        $thread['ignored_time'],
                        ((!$thread['edited_time'] && !$thread['ignored_time']) ? lang('plugin/huihuicai_threadseo', 'not_edited') : ($thread['edited_time'] ? lang('plugin/huihuicai_threadseo', 'edited') : lang('plugin/huihuicai_threadseo', 'ignored'))),
                        $thread['views'],
                        $thread['replies'],
                        '<a href="'.ADMINSCRIPT.'?action='.THREADSEO_MANAGE_URL.'&moderate=edit&optype='.$_GET['optype'].'&tid='.$thread['tid'].'&original_title='.urlencode($thread['subject']).'&seo_title='.urlencode($thread['seo_title']).'" class="title-edit-btn">'.lang('plugin/huihuicai_threadseo', 'edit_subject').'</a>'
                        .(empty($_GET['optype']) || $_GET['optype'] == 'all' || ($_GET['optype'] == 'search' && !$thread['edited_time'] && !$thread['ignored_time']) ? '&nbsp;&nbsp;<a href="'.ADMINSCRIPT.'?action='.THREADSEO_MANAGE_URL.'&moderate=ignore&optype='.$_GET['optype'].'&tid='.$thread['tid'].'" class="title-ignore-btn">'.lang('plugin/huihuicai_threadseo', 'ignore').'</a>' : '')
                    ];
                    if(!empty($_GET['optype']) && $_GET['optype'] == 'edited'){
                        //已编辑主题
                        unset($table_td_value[5], $table_td_value[6]);
                    }elseif(!empty($_GET['optype']) && $_GET['optype'] == 'ignored'){
                        //已忽略主题
                        unset($table_td_value[3], $table_td_value[4], $table_td_value[6]);
                    }elseif(!empty($_GET['optype']) && $_GET['optype'] == 'search'){
                        //搜索
                        unset($table_td_value[4], $table_td_value[5]);
                    }else{
                        //全部主题
                        unset($table_td_value[3], $table_td_value[4], $table_td_value[5], $table_td_value[6]);
                    }
                    $threads .= showtablerow('', $table_td, $table_td_value, TRUE);
                }
            }

            $multi = multi($threadcount, $perpage, $page, ADMINSCRIPT.'?action='.THREADSEO_MANAGE_URL. '&'.getCurrentParams('get', 'page'));
            $multi = preg_replace('/href=\"'.ADMINSCRIPT.'\?action='.THREADSEO_MANAGE_URL. '&amp;'.getCurrentParams('get', 'page')."&amp;page=(\d+)\"/", "href=\"javascript:page(\\1)\"", $multi);
            $multi = str_replace("window.location='".ADMINSCRIPT."?action=".THREADSEO_MANAGE_URL. '&amp;'.getCurrentParams('get', 'page')."&amp;page='+this.value", "page(this.value)", $multi);
        }
    }

    showtagheader('div', 'threadlist', TRUE);
    $search_forum = '';
    if($_GET['optype'] == 'search'){
        $search_forum = '<form name="threadforum" method="get" autocomplete="off" action="'.ADMINSCRIPT.'?action='.THREADSEO_MANAGE_URL. '&'.getCurrentParams('get', 'page').'">
                <input type="hidden" name="action" value="threads">
                <input type="hidden" name="optype" value="search">
                <input name="keywords" value="'.$keywords.'" type="text" class="txt"> <input type="submit" class="btn" name="searchsubmit" value="搜索"></form>';
    }elseif($_GET['optype'] == 'edited'){
//        $search_forum = '<form name="threadforum" method="get" autocomplete="off" action="'.$_G['siteurl'].ADMINSCRIPT.'?action='.THREADSEO_MANAGE_URL. '&moderate=export">
//                <input type="hidden" name="formhash" value="'.FORMHASH.'">
//                <input type="text" class="txt" name="start_time" value="'.date('Y-m-d', time() - 86400 * 7).'" style="width: 108px; margin-right: 5px;"> --
//                <input type="text" class="txt" name="end_time" value="'.date('Y-m-d', time()).'" style="width: 108px; margin-left: 5px;">
//                <input type="submit" class="btn" name="exportsubmit" value="导出"></form>';

    }
    showtableheader($search_forum, 'nobottom');
    if(!$threadcount) {
        showtablerow('', 'colspan="3"', cplang('threads_thread_nonexistence'));
    } else {
        showsubtitle($table_th);
        echo $threads;
        showtablefooter();
    }

    showsubmit('', '', '', '', $multi);
    showtablefooter();
    echo '<iframe name="threadframe" style="display:none"></iframe>';
    showtagfooter('div');

}elseif($_GET['moderate'] == 'ignore' && !empty($_GET['tid'])){
    //忽略主题
}elseif($_GET['moderate'] == 'edit'){
    //编辑seo标题
    if(submitcheck('threadseo_submit')){
        $seo_title = trim($_POST['seo_title']);
        $tid = intval($_POST['tid']);
        if(empty($seo_title) || empty($tid)){
            cpmsg('huihuicai_threadseo:operation_content_error', '', 'error');
        }
        if(DB::insert('forum_thread_seo_edited', ['tid'=>$tid, 'seo_title'=>$seo_title, 'edited_time'=>time()], true, true)){
            DB::delete('forum_thread_seo_ignored', ['tid'=>$tid]);
            //清除缓存
            memory('rm', 'forum_thread_'.$tid);
            cpmsg('huihuicai_threadseo:operation_success', 'action='.THREADSEO_MANAGE_URL . '&'.getCurrentParams('post'), 'succeed');
        }else{
            cpmsg('huihuicai_threadseo:operation_fail', '', 'error');
        }
        exit();
    }else{
        $tid = intval($_GET['tid']);
        $original_title = $_GET['original_title'];
        $seo_title = $_GET['seo_title'];
        showformheader(THREADSEO_MANAGE_URL. '&moderate=edit','enctype');
        showtableheader();
        showsetting(lang('plugin/huihuicai_threadseo', 'forum_original_title'), 'original_title', $original_title, 'text', 'readonly');
        echo  '<input type="hidden" name="tid" value="'.$tid.'"/>';
        echo  '<input type="hidden" name="optype" value="'.$_GET['optype'].'"/>';
        echo  '<input type="hidden" name="page" value="'.$_GET['page'].'"/>';
        echo  '<input type="hidden" name="keywords" value="'.$_GET['keywords'].'"/>';
        echo  '<input type="hidden" name="threadseo_submit" value="true"/>';
        showsetting(lang('plugin/huihuicai_threadseo', 'forum_seo_title'), 'seo_title', $seo_title, 'text');

        showsubmit('edit');
        showtablefooter();
        showformfooter();
    }

}elseif($_GET['moderate'] == 'export'){
    //导出已编辑seo主题
    $start_time = strtotime($_GET['start_time']);
    $end_time = strtotime($_GET['end_time']) + 86400;
    if(!$start_time || !$end_time) cpmsg('huihuicai_threadseo:operation_content_error', '', 'error');

    $file_content = '';
    foreach(DB::fetch_all('SELECT tid, seo_title FROM pre_forum_thread_seo_edited WHERE edited_time BETWEEN '.$start_time.' AND '.$end_time
        .' ORDER BY tid DESC LIMIT 10000') as $thread){
        if(empty($thread['tid'])) continue;
        $file_content .= $thread['seo_title'].','.$_G['siteurl'].'thread-'.$thread['tid']."-1-1.html\n";
    }

    ob_end_clean();
    header('Content-Encoding: none');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=threadseo_'. date('Ymd', TIMESTAMP).'.csv');
    header('Pragma: no-cache');
    header('Expires: 0');
    echo $file_content;
    exit();
}

/**
 * 获取编辑过的主题信息
 * @param $tids
 * @return array
 */
function getEditedThread($tids){
    $thread_edited = [];
    $data = DB::fetch_all('SELECT tid, seo_title, edited_time FROM %t WHERE tid IN(%n)', array('forum_thread_seo_edited', $tids));
    foreach ($data as $row){
        $thread_edited[$row['tid']] = $row;
    }
    return $thread_edited;
}

/**
 * 获取忽略的主题信息
 * @param $tids
 * @return array
 */

/**
 * 获取组装url参数
 * @param $params_type
 * @param string $remove_params
 * @return string
 */
function getCurrentParams($params_type, $remove_params = ''){
    if($params_type == 'get'){
        global $_GET;
        $curr_params = $_GET;
    }else{
        global $_POST;
        $curr_params = $_GET;
    }
    $params = ['tid', 'optype', 'page', 'keywords'];
    $url_params = [];

    foreach ($params as $row){
        if($row != $remove_params && isset($curr_params[$row])){
            $url_params[$row] = $curr_params[$row];
        }
    }

    return $url_params ? http_build_query($url_params) : '';
}


?>