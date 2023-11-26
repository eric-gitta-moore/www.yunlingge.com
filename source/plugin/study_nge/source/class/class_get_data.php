<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if (!defined('IN_DISCUZ')) {
exit('Access Denied Powered by www.1314study.com ');
}
class study_nge {

    
    //调用图片信息主函数
    function get_image() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        if ($splugin_setting['cache_radio']) {
            return study_nge::get_image_cache();
        } else {
            return study_nge::get_image_nocache();
        }
    }

    //调用图片信息cache函数
    function get_image_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $pic_cache_time = intval($splugin_setting['pic_cache_time']);
        if ($pic_cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_pic_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $pic_cache_time) {
                $pic_array = study_nge::get_image_nocache();
                $cache_content = '$pic_array = ' . var_export($pic_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_pic_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $pic_array = study_nge::get_image_nocache();
        }
        return $pic_array;
    }

    //调用图片信息nocache函数
    function get_image_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $pic_array = array();
        if ($splugin_setting['pic_select'] == 3) { // 自定义图片
            $threadimage_array['pic'] = explode("\n", str_replace("\r\n", "\n", $splugin_setting['pic_zdy_pic']));
            $threadimage_array['text'] = explode("\n", str_replace("\r\n", "\n", $splugin_setting['pic_zdy_text']));
            $threadimage_array['url'] = explode("\n", str_replace("\r\n", "\n", $splugin_setting['pic_zdy_url']));
            if ($splugin_setting['pic_thumb_radio']) {
                if (!class_exists('image')) {
                    include libfile('class/image');
                }
                $thumb_param['w'] = $splugin_setting['pic_thumb_w'] ? $splugin_setting['pic_thumb_w'] : '300';
                $thumb_param['h'] = $splugin_setting['pic_thumb_h2'] ? $splugin_setting['pic_thumb_h2'] : '250';
                $thumb_param['thumbtype'] = 'fixwr';
                // 缩略图质量
                $_G['setting']['thumbquality'] = $splugin_setting['pic_thumb_quality'] ? $splugin_setting['pic_thumb_quality'] : '100';
                $parse = parse_url($_G['setting']['attachurl']);
                $thumb_param['attachurl'] = !isset($parse['host']) ? $_G['siteurl'] . $_G['setting']['attachurl'] : $_G['setting']['attachurl'];
                $thumb_param['type'] = 'zdy';
                foreach ($threadimage_array['pic'] as $key => $filename) {
                    if ($filename) {
                        $thumb_param['filename'] = $filename;
                        $pic_array['pic']['zdy_' . $key] = study_nge_func::image_thumb($thumb_param);
                        $pic_array['text']['zdy_' . $key] = study_nge_func::messagecutstr($threadimage_array['text'][$key], $splugin_setting['pic_title_length']);
                        ;
                        $pic_array['url']['zdy_' . $key] = $threadimage_array['url'][$key];
                    }
                }
            } else {
                foreach ($threadimage_array['pic'] as $key => $filename) {
                    if ($filename) {
                        $pic_array['pic']['zdy_' . $key] = $filename;
                        $pic_array['text']['zdy_' . $key] = study_nge_func::messagecutstr($threadimage_array['text'][$key], $splugin_setting['pic_title_length']);
                        ;
                        $pic_array['url']['zdy_' . $key] = $threadimage_array['url'][$key];
                    }
                }
            }
        } elseif ($splugin_setting['pic_select'] == 2) { // 论坛附件
            $pic_num = $splugin_setting['pic_num'] ? $splugin_setting['pic_num'] : '5';

            $pic_limit_day = $splugin_setting['pic_limit_day'] ? $splugin_setting['pic_limit_day'] : '1';
            $limit_time = study_nge_func::get_date($pic_limit_day);
            // get_image_info
            if ($splugin_setting['pic_select_way'] == '1') {
                $condition = " AND t.dateline >'$limit_time' AND t.isgroup=0 AND t.displayorder>=0 ";
                $condition .= study_nge_func::get_where_fids($splugin_setting['pic_fids'], ' AND t.fid IN({fids})');
            } else {
                $condition = " AND dateline >'$limit_time' AND attachment ='2' AND isgroup='0' AND displayorder>='0' ";
                $condition .= study_nge_func::get_where_fids($splugin_setting['pic_fids']);
            }
            if ($splugin_setting['pic_thumb_radio']) {
                if (!class_exists('image')) {
                    include libfile('class/image');
                }
                $thumb_param['w'] = $splugin_setting['pic_thumb_w'] ? $splugin_setting['pic_thumb_w'] : '300';
                $thumb_param['h'] = $splugin_setting['pic_thumb_h2'] ? $splugin_setting['pic_thumb_h2'] : '250';
                $thumb_param['thumbtype'] = 'fixwr';
                // 缩略图质量
                $_G['setting']['thumbquality'] = $splugin_setting['pic_thumb_quality'] ? $splugin_setting['pic_thumb_quality'] : '100';
                $parse = parse_url($_G['setting']['attachurl']);
                $thumb_param['attachurl'] = !isset($parse['host']) ? $_G['siteurl'] . $_G['setting']['attachurl'] : $_G['setting']['attachurl'];
                $thumb_param['type'] = 'att';
                // foreach(study_nge_db::get_image_info($condition,$pic_num) as $threadimage) {
                foreach (study_nge_db::get_att_info($condition, $pic_num, $splugin_setting['pic_select_way']) as $threadimage) {
                    if ($threadimage['remote']) {
                        $thumb_param['filename'] = $_G['setting']['ftp']['attachurl'] . 'forum/' . $threadimage['attachment'];
                    } else {
                        $thumb_param['filename'] = $_G['setting']['attachurl'] . 'forum/' . $threadimage['attachment'];
                    }
                    $pic_array['pic']['att_' . $threadimage['tid']] = study_nge_func::image_thumb($thumb_param);
                    $pic_array['text']['att_' . $threadimage['tid']] = study_nge_func::messagecutstr($threadimage['subject'], $splugin_setting['pic_title_length']);
                    $pic_array['url']['att_' . $threadimage['tid']] = 'forum.php?mod=viewthread&tid=' . $threadimage[tid];
                }
            } else {
                // foreach(study_nge_db::get_image_info($condition,$pic_num) as $threadimage) {
                foreach (study_nge_db::get_att_info($condition, $pic_num, $splugin_setting['pic_select_way']) as $threadimage) {
                    if ($threadimage['remote']) {
                        $filename = $_G['setting']['ftp']['attachurl'] . 'forum/' . $threadimage['attachment'];
                    } else {
                        $filename = $_G['setting']['attachurl'] . 'forum/' . $threadimage['attachment'];
                    }
                    $pic_array['pic']['att_' . $threadimage['tid']] = $filename;
                    $pic_array['text']['att_' . $threadimage['tid']] = study_nge_func::messagecutstr($threadimage['subject'], $splugin_setting['pic_title_length']);
                    $pic_array['url']['att_' . $threadimage['tid']] = 'forum.php?mod=viewthread&tid=' . $threadimage[tid];
                }
            }
        } elseif ($splugin_setting['pic_select'] == 4) { // 外部链接图片
            $pic_num = $splugin_setting['pic_num'] ? $splugin_setting['pic_num'] : '5';
            $pic_limit_day = $splugin_setting['pic_limit_day'] ? $splugin_setting['pic_limit_day'] : '1';
            $limit_time = study_nge_func::get_date($pic_limit_day);
            $condition = " AND dateline >'$limit_time' AND first='1' AND invisible ='0' AND status='0' AND bbcodeoff<>'1' AND message LIKE '%[img%[/img]%' ";
            $condition .= study_nge_func::get_where_fids($splugin_setting['pic_fids']);
            if ($splugin_setting['pic_thumb_radio']) {
                if (!class_exists('image')) {
                    include libfile('class/image');
                }
                $thumb_param['w'] = $splugin_setting['pic_thumb_w'] ? $splugin_setting['pic_thumb_w'] : '300';
                $thumb_param['h'] = $splugin_setting['pic_thumb_h2'] ? $splugin_setting['pic_thumb_h2'] : '250';
                $thumb_param['thumbtype'] = 'fixwr';
                // 缩略图质量
                $_G['setting']['thumbquality'] = $splugin_setting['pic_thumb_quality'] ? $splugin_setting['pic_thumb_quality'] : '100';
                $parse = parse_url($_G['setting']['attachurl']);
                $thumb_param['attachurl'] = !isset($parse['host']) ? $_G['siteurl'] . $_G['setting']['attachurl'] : $_G['setting']['attachurl'];
                $thumb_param['type'] = 'ext';
                foreach (study_nge_db::get_ext_image_info($condition, $pic_num) as $threadimage) {
                    if (preg_match('/\[img(\=\d{1,4}[x|\,]\d{1,4})?\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/i', $threadimage['message'], $threadimage['ext_image'])) {
                        $thumb_param['filename'] = $threadimage['ext_image'][2];
                        $pic_array['pic']['ext_' . $threadimage['pid']] = study_nge_func::image_thumb($thumb_param);
                        $pic_array['text']['ext_' . $threadimage['pid']] = study_nge_func::messagecutstr($threadimage['subject'], $splugin_setting['pic_title_length']);
                        $pic_array['url']['ext_' . $threadimage['pid']] = 'forum.php?mod=viewthread&tid=' . $threadimage['tid'];
                    }
                }
            } else {
                foreach (study_nge_db::get_ext_image_info($condition, $pic_num) as $threadimage) {
                    if (preg_match('/\[img(\=\d{1,4}[x|\,]\d{1,4})?\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/i', $threadimage['message'], $threadimage['ext_image'])) {
                        $pic_array['pic']['ext_' . $threadimage['pid']] = $threadimage['ext_image'][2];
                        $pic_array['text']['ext_' . $threadimage['pid']] = study_nge_func::messagecutstr($threadimage['subject'], $splugin_setting['pic_title_length']);
                        $pic_array['url']['ext_' . $threadimage['pid']] = 'forum.php?mod=viewthread&tid=' . $threadimage['tid'];
                    }
                }
            }
        }
        // print_r($pic_array);
        return $pic_array;
    }

    

    
    // 获取帖子信息主函数
    function get_threads($type) {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        if ($splugin_setting['cache_radio']) {
            $func_name = 'get_threads_' . $type . '_cache';
        } else {
            $func_name = 'get_threads_' . $type . '_nocache';
        }
        return study_nge::$func_name();
    }

    // 最新帖子
    function get_threads_newpost_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['newpost_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_newpost_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_threads_newpost_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_newpost_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_threads_newpost_nocache();
        }

        return $return_array;
    }

    function get_threads_newpost_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        empty($splugin_setting['data_num']) && $splugin_setting['data_num'] = '10';
        $return_array = array();
        $newpost_limit_day = $splugin_setting['newpost_limit_day'] ? $splugin_setting['newpost_limit_day'] : '1';
        $limit_time = study_nge_func::get_date($newpost_limit_day);
        $condition = " AND dateline >'$limit_time' AND displayorder >= '0' ";
        $condition .= study_nge_func::get_where_fids($splugin_setting['newpost_fids']);
        $condition .= ' AND status<>\'3\' AND isgroup <> \'1\' ORDER BY dateline DESC LIMIT ' . $splugin_setting['data_num'];
        foreach (study_nge_db::get_thread_info($condition) as $thread) {
            $return_array[$thread[tid]] = study_nge_func::deal_thread($thread);
        }
        return $return_array;
    }

    // 最新回帖
    function get_threads_newreply_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['newpost_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_newreply_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_threads_newreply_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_newreply_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_threads_newreply_nocache();
        }

        return $return_array;
    }

    function get_threads_newreply_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        empty($splugin_setting['data_num']) && $splugin_setting['data_num'] = '10';
        $return_array = array();
        $newreply_limit_day = $splugin_setting['newreply_limit_day'] ? $splugin_setting['newreply_limit_day'] : '1';
        $limit_time = study_nge_func::get_date($newreply_limit_day);
        $condition = " AND lastpost >'$limit_time' AND displayorder >= '0'";
        $condition .= study_nge_func::get_where_fids($splugin_setting['newreply_fids']);
        if ($splugin_setting['newreply_thru']) {
            $condition .= " AND lastpost < '" . intval($_G['timestamp']) . "' ";
        }
        $condition .= ' AND replies >\'0\' AND status<>\'3\' AND isgroup <> \'1\' ORDER BY lastpost DESC LIMIT ' . $splugin_setting['data_num'];
        foreach (study_nge_db::get_thread_info($condition) as $thread) {
            $return_array[$thread[tid]] = study_nge_func::deal_thread($thread);
        }
        return $return_array;
    }

    // 推荐帖子
    function get_threads_recpost_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['newpost_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_recpost_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_threads_recpost_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_recpost_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_threads_recpost_nocache();
        }

        return $return_array;
    }

    function get_threads_recpost_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        empty($splugin_setting['data_num']) && $splugin_setting['data_num'] = '10';
        $return_array = array();
        foreach (study_nge_db::get_thread_recpost($splugin_setting['data_num']) as $thread) {
            $return_array[$thread[tid]] = study_nge_func::deal_thread($thread);
        }
        return $return_array;
    }

    // 精华帖子
    function get_threads_goodreply_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['newpost_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_goodreply_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_threads_goodreply_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_goodreply_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_threads_goodreply_nocache();
        }

        return $return_array;
    }

    function get_threads_goodreply_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        empty($splugin_setting['data_num']) && $splugin_setting['data_num'] = '10';
        $return_array = array();
        $sortway = array('', 'replies', 'views', 'dateline', 'lastpost');
        $limit_time = study_nge_func::get_date($splugin_setting['goodreply_day']);
        $goodreply_order = $sortway[$splugin_setting['goodreply_order']] ? $sortway[$splugin_setting['goodreply_order']] : 'dateline';
        $where_digest = $splugin_setting['goodreply_digest'] ? 'AND digest IN(' . $splugin_setting['goodreply_digest'] . ')' : ' AND digest IN(1,2,3) ';
        $condition = " AND dateline >'$limit_time' $where_digest AND displayorder >= '0' ";
        $condition .= study_nge_func::get_where_fids($splugin_setting['goodreply_fids']);
        $condition .= ' AND status<>\'3\' AND isgroup <> \'1\' ORDER BY ' . $goodreply_order . ' DESC LIMIT ' . $splugin_setting['data_num'];
        foreach (study_nge_db::get_thread_info($condition) as $thread) {
            $return_array[$thread[tid]] = study_nge_func::deal_thread($thread);
        }
        return $return_array;
    }

    // 热门帖子
    function get_threads_hotpost_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['newpost_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_hotpost_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_threads_hotpost_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_hotpost_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_threads_hotpost_nocache();
        }

        return $return_array;
    }

    function get_threads_hotpost_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        empty($splugin_setting['data_num']) && $splugin_setting['data_num'] = '10';
        $return_array = array();
        // 热门排列方式
        $sortway = array('', 'heats', 'replies', 'views');

        $limit_time = study_nge_func::get_date($splugin_setting['hotpost_day']);
        $hotpost_order = $sortway[$splugin_setting['hotpost_order']] ? $sortway[$splugin_setting['hotpost_order']] : 'replies';
        $condition = " AND dateline >'$limit_time' ";
        $condition .= study_nge_func::get_where_fids($splugin_setting['hotpost_fids']);
        $condition .= ' AND displayorder >= \'0\' AND status<>\'3\' AND isgroup <> \'1\' ORDER BY ' . $hotpost_order . ' DESC LIMIT ' . $splugin_setting['data_num'];
        foreach (study_nge_db::get_thread_info($condition) as $thread) {
            $return_array[$thread[tid]] = study_nge_func::deal_thread($thread);
        }
        return $return_array;
    }

    

    
    // 获取会员信息主函数
    function get_members($type) {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        if ($splugin_setting['cache_radio']) {
            $func_name = 'get_member_' . $type . '_cache';
        } else {
            $func_name = 'get_member_' . $type . '_nocache';
        }
        return study_nge::$func_name();
    }

    // 最新会员
    function get_member_newmember_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['newmember_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_newmember_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_member_newmember_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_newmember_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_member_newmember_nocache();
        }

        return $return_array;
    }

    function get_member_newmember_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $return_array = array();
        $newmember_limit_day = $splugin_setting['newmember_limit_day'] ? $splugin_setting['newmember_limit_day'] : '1';
        $limit_time = study_nge_func::get_date($newmember_limit_day);

        if ($splugin_setting['newmember_limit_gids_radio']) {
            $condition = " AND regdate >'$limit_time' AND groupid not in(4,5,6,7,8,9) ";
        } else {
            $condition = " AND regdate >'$limit_time' ";
        }
        foreach (study_nge_db::get_newmember_info($condition, '30') as $member) {
            $member['regdate'] = gmdate('m-d H:i', $member['regdate'] + ($_G['setting']['timeoffset'] * 3600));
            $member['avatar'] = avatar($member['uid'], 'small');
            $return_array[$member['uid']] = $member;
        }
        return $return_array;
    }

    // 本月发帖
    function get_member_posts_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['posts_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_posts_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_member_posts_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_posts_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_member_posts_nocache();
        }

        return $return_array;
    }

    function get_member_posts_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $return_array = array();
        $limit_time = study_nge_func::get_date($splugin_setting['posts_day']);
        $condition = ' AND f.dateline >' . $limit_time . ' ';
        $condition .= study_nge_func::get_where_groupids($splugin_setting['posts_gids']);
        $condition .= $splugin_setting['posts_first_radio'] ? " AND f.first = '1' " : "";
        $condition .= ' AND f.author <> \'\' GROUP BY f.authorid ORDER BY num DESC LIMIT 0, 30';

        $i = 0;
        foreach (study_nge_db::get_member_posts_info($condition) as $member) {
            if ($splugin_setting['posts_way'] == '2' && $i < 3) {
                $member['avatar'] = avatar($member['uid'], small);
                $member['credits'] = study_nge_db::get_membercredits_by_uid($member['uid']);
                $return_array[$member[uid]] = $member;
                $i++;
            } else {
                $member['avatar'] = avatar($member['uid'], small);
                $return_array[$member[uid]] = $member;
            }
        }
        return $return_array;
    }

    // 在线排行
    function get_member_online_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['online_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_online_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_member_online_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_online_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_member_online_nocache();
        }

        return $return_array;
    }

    function get_member_online_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $return_array = array();
        foreach (study_nge_db::get_member_online_info('30') as $member) {
            $member['username'] = study_nge_db::get_membername_by_uid($member[uid]);
            $member['avatar'] = avatar($member['uid'], small);
            $return_array[$member[uid]] = $member;
        }
        return $return_array;
    }

    // 积分排行
    function get_member_credits_cache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $cache_time = intval($splugin_setting['credits_cache_time']);
        if ($cache_time) {
            $cache_file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_credits_data.php';
            if (($_G['timestamp'] - @filemtime($cache_file)) > $cache_time) {
                $return_array = study_nge::get_member_credits_nocache();
                $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
                study_nge_func::s_writetocache('study_nge_credits_data', $cache_content);
            } else {
                @include_once $cache_file;
            }
        } else {
            $return_array = study_nge::get_member_credits_nocache();
        }

        return $return_array;
    }

    function get_member_credits_nocache() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $return_array = array();
        if (in_array($splugin_setting['credits_extcredit'], array('1', '2', '3', '4', '5', '6', '7', '8'))) {
            foreach (study_nge_db::get_member_extcredit_info('30', $splugin_setting['credits_extcredit']) as $member) {
                $member['avatar'] = avatar($member['uid'], small);
                $member['username'] = study_nge_db::get_membername_by_uid($member['uid']);
                $return_array[$member[uid]] = $member;
            }
        } else {
            foreach (study_nge_db::get_member_credits_info('30') as $member) {
                $member['avatar'] = avatar($member['uid'], small);
                $return_array[$member[uid]] = $member;
            }
        }
        return $return_array;
    }

    

    
    // 更新缓存主函数
    function updatecache($type) {
        $func_name = 'updatecache_' . $type;
        study_nge::$func_name();
    }

    function updatecache_recpost() {
        global $_G;
        $return_array = array();
        $return_array = study_nge::get_threads_recpost_nocache();
        $cache_content = '$return_array = ' . var_export($return_array, true) . ";\n";
        study_nge_func::s_writetocache('study_nge_recpost_data', $cache_content);
    }

    
}

// if (empty($_G['cache']['plugin']['s' . 't' . 'u' . 'd' . 'y' . '_n' . 'g' . 'e'])) {
//     $return = '';
// }

//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: class_get_data.php 28630 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。