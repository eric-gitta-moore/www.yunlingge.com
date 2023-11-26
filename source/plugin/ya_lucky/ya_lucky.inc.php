<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky.{modulename})] (C)2019-2099 Powered by 云猫工作室.
 * 	Version: 0.1
 * 	Date: 2019-5-20 16:29
 *      File: ya_lucky.inc.php
 *      Desc: 入口文件
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('common.func', 'plugin/ya_lucky/function');
C::import('lucky.func', 'plugin/ya_lucky/function');

if (!$_G['uid']) {
    showmessage('to_login', '', '', array('login' => 1));
}

if (!$_G['cache']['plugin']['ya_lucky']['is_open']) {
    showmessage('ya_lucky:closed');
}

$types = array('list', 'rank');
$type = !in_array($_GET['type'], $types) ? 'rank' : dhtmlspecialchars($_GET['type']);

$list = $my_stat = $uids = array();

$my_stat = C::t('#ya_lucky#ya_lucky_userstat')->fetch($_G['uid']);
$lucky_num = !empty($my_stat['lucky_num']) ? intval($my_stat['lucky_num']) : 0;
$bad_num = !empty($my_stat['bad_num']) ? intval($my_stat['bad_num']) : 0;
$mystat = yl_lang('my_stat', array('lucky_num' => $lucky_num, 'bad_num' => $bad_num));


if ($type == 'list') {
    $views = array('all', 'my');
    $view = !in_array($_GET['view'], $views) ? 'all' : dhtmlspecialchars($_GET['view']);

    $events = get_lucky_event();

    $pn = 15;
    $max_page = 500;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $page = $page >= $max_page ? $max_page : $page;
    $start = ($page - 1) * $pn;

    if ($view == 'my') {
        $all_event = C::t('#ya_lucky#ya_lucky_log')->fetcl_all_by_uid($_G['uid'], $start, $pn);
        $total = C::t('#ya_lucky#ya_lucky_log')->count_by_uid($_G['uid']);
    } else {
        $all_event = C::t('#ya_lucky#ya_lucky_log')->fetcl_all_by_uid(0, $start, $pn);
        $total = C::t('#ya_lucky#ya_lucky_log')->count();
    }

    $todaytime = strtotime(dgmdate(TIMESTAMP, 'Ymd'));
    foreach ($all_event as $result) {
        $member = getuserbyuid($result['uid']);
        $result['username'] = $member['username'];
        $result['groupid'] = $member['groupid'];

        $event_type = $result['extcredits'] > 0 ? 1 : 2;
        $event = '';
        foreach ($events[$event_type] as $val) {
            if ($result['eid'] != $val['eid']) {
                continue;
            }
            $event = $val;
        }

        $extcredits = $_G['setting']['extcredits'][$result['extcreditstype']]['img'] . $_G['setting']['extcredits'][$result['extcreditstype']]['title'];
        $credits = $result['extcredits'] . ' ' . $_G['setting']['extcredits'][$result['extcreditstype']]['unit'];
        $result['desc'] = str_replace(array('{username}', '{extcredit}', '{credit}'), array($result['username'], $extcredits, $credits), $event['desc']);
        if (empty($result['desc'])) {
            $result['desc'] = lang('plugin/ya_lucky', 'event_deleted');
        }

        $result['istoday'] = $result['dateline'] > $todaytime ? 1 : 0;
        $result['dateline'] = dgmdate($result['dateline'], 'u', '9999', getglobal('setting/dateformat'));

        $list[] = $result;
        $uids[] = $result['uid'];
    }

    $total = $total >= $max_page * $pn ? $max_page * $pn : $total;
    $page_url = "plugin.php?id=ya_lucky&type=list&view={$view}";
    $multipage = multi($total, $pn, $page, $page_url);
} else {

    $views = array('lucky', 'bad');
    $view = !in_array($_GET['view'], $views) ? 'lucky' : dhtmlspecialchars($_GET['view']);
    $displayorder = $view == 'bad' ? 'bad_num' : 'lucky_num';
    $numtitle = yl_lang($displayorder);

    $myfuids = array();
    $query = C::t('home_friend')->fetch_all($_G['uid']);
    foreach ($query as $value) {
        $myfuids[$value['fuid']] = $value['fuid'];
    }
    $myfuids[$_G['uid']] = $_G['uid'];

    $k = 1;
    foreach (C::t('#ya_lucky#ya_lucky_userstat')->range(0, 20, $displayorder, 'DESC') as $result) {
        $member = getuserbyuid($result['uid']);

        $result['rank'] = $k;
        $result['num'] = $result[$displayorder];
        $result['username'] = $member['username'];
        $result['groupid'] = $member['groupid'];
        $result['isfriend'] = empty($myfuids[$result['uid']]) ? 0 : 1;

        $uids[] = $result['uid'];
        $list[] = $result;
        $k++;
    }
}

$ols = array();
if ($uids) {
    foreach (C::app()->session->fetch_all_by_uid($uids) as $val) {
        if (!$val['invisible']) {
            $ols[$val['uid']] = $val['lastactivity'];
        }
    }
}

$a_actives_type = array($type => ' a');
$a_actives = array($view => ' class="a"');

$navtitle = yl_lang('lucky_stat');

include_once template('ya_lucky:lucky');
?>