<?php

/**
 * 	[【云猫】主题URL静态优化(ya_thread_rewrite)] (C)2019-2099 Powered by 云猫工作室.
 * 	Version: 0.1
 * 	Date: 2019-5-20 16:29
 *      File: lucy.class.php
 *      Desc: 嵌入点功能
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_ya_thread_rewrite_base
{

    public function __construct()
    {
	global $_G;
    }

    protected function _redirect_forum()
    {
	global $_G;

	if (!empty($_G['setting']['output']['preg']['search']) && (empty($_G['setting']['rewriteguest']) || empty($_G['uid'])) && array_key_exists('forum_viewthread', $_G['setting']['output']['preg']['search'])) {
	    if (CURMODULE == 'redirect' && in_array($_GET['goto'], array('lastpost', 'nextnewset', 'nextoldset'))) {


		if (empty($_G['thread'])) {
		    showmessage('thread_nonexistence');
		}

		if ($_GET['goto'] == 'lastpost') {

		    $pageadd = '';
		    if (!getstatus($_G['thread'], 4)) {
			$page = ceil(($_G['thread']['special'] ? $_G['thread']['replies'] : $_G['thread']['replies'] + 1) / $_G['ppp']);
			$pageadd = $page > 1 ? '&page=' . $page : '';
		    }

		    $url = rewriteoutput('forum_viewthread', 1, '', $_G['tid'], $page, 1, '') . '#lastpost';
		    dheader("Location: {$url}");
		}

		if ($_GET['goto'] == 'nextnewset' || $_GET['goto'] == 'nextoldset') {

		    $lastpost = $_G['thread']['lastpost'];


		    $glue = '<';
		    $sort = 'DESC';
		    if ($_GET['goto'] == 'nextnewset') {
			$glue = '>';
			$sort = 'ASC';
		    }
		    $next = C::t('forum_thread')->fetch_next_tid_by_fid_lastpost($_G['fid'], $lastpost, $glue, $sort, $_G['thread']['threadtableid']);

		    if ($next) {
			$url = rewriteoutput('forum_viewthread', 1, '', $next, 1, 1, '');
			dheader("Location: {$url}");
		    } elseif ($_GET['goto'] == 'nextnewset') {
			showmessage('redirect_nextnewset_nonexistence');
		    } else {
			showmessage('redirect_nextoldset_nonexistence');
		    }
		}
	    }
	}
    }

}

?>