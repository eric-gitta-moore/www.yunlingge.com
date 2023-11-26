<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
$study_nge = $_G['cache']['plugin']['study_nge'];
$tid = intval($_GET[tid]);
if($tid) {
if($study_nge['threadcard_select2'] == '4') {
loadcache('forums');
$post = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid='$tid' limit 1");
$post['dateline'] = gmdate('Y-m-d H:i', $post['dateline'] + $_G['setting']['timeoffset'] * 3600);
$post['lastpost'] = gmdate('Y-m-d H:i', $post['lastpost'] + $_G['setting']['timeoffset'] * 3600);
}else {
        require_once DISCUZ_ROOT . './source/plugin/study_nge/source/class/func.class.php';
        require_once libfile('function/discuzcode');
        loadcache('usergroups');
        $post = DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " WHERE tid='$tid' AND first=1 limit 1");
        $post['message'] = study_nge_func::ngethread_messagecutstr(discuzcode(dhtmlspecialchars($post['message']), $post['smileyoff'], $post['bbcodeoff'], '0', '1'));
        $post['message'] = str_replace('&amp;', '&', $post['message']);

        $post['dateline'] = gmdate('Y-m-d H:i', $post['dateline'] + $_G['setting']['timeoffset'] * 3600);
        if($post['tid']) {
            $threadimage = DB::fetch_first("SELECT * FROM " . DB::table('forum_threadimage') . " WHERE tid='$post[tid]' limit 1");
            if($threadimage) {
                if($threadimage['remote']) {
                    $post['image'] = '<img src="' . $_G['setting']['ftp']['attachurl'] . 'forum/' . $threadimage['attachment'] . '" alt="" width="268px" />';
                }else {
                    $post['image'] = '<img src="' . $_G['setting']['attachurl'] . 'forum/' . $threadimage['attachment'] . '" alt="" width="268px" />';
                }
            }
            $thread = DB::fetch_first("SELECT views,replies FROM " . DB::table('forum_thread') . " WHERE tid='$post[tid]' limit 1");
            $post['views'] = $thread['views'];
            $post['replies'] = $thread['replies'];
        }
        $uid = $post['authorid'];
        if($uid) {
            study_nge_func::getonlinemember($uid);

            $space = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='$uid' limit 1");

            $space['group'] = $_G['cache']['usergroups'][$space['groupid']];
            $upgradecredit = $space['uid'] && $space['group']['type'] == 'member' && $space['group']['creditslower'] != 9999999 ? $space['group']['creditslower'] - $space['credits'] : false;
        }
    }
}
$lang = lang('plugin/study_nge');
include template('study_nge:default/thread_card');



//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: ngethread.inc.php 3047 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。