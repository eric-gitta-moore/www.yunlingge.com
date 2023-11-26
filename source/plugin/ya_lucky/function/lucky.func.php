<?php

/**
 * 	[¡¾ÔÆÃ¨¡¿ÐÒÔË·¢Ìû(ya_lucky)] (C)2019-2099 Powered by ÔÆÃ¨¹¤×÷ÊÒ.
 * 	Date: 2019-5-23 16:26
 *      File: lucky.func.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function get_lucky_setting()
{
    global $_G;

    if (defined('IN_ADMINCP')) {
        loadcache('plugin');
    }
    $ya_setting = $_G['cache']['plugin']['ya_lucky'];
    $ya_setting['lucky_groups'] = (array) unserialize($ya_setting['lucky_groups']);
    $ya_setting['lucky_fids'] = (array) unserialize($ya_setting['lucky_fids']);
    $ya_setting['only_thread'] = intval($ya_setting['only_thread']);
    $ya_setting['probability'] = intval($ya_setting['probability']);
    $ya_setting['rew_probability'] = intval($ya_setting['rew_probability']);
    $ya_setting['is_open'] = intval($ya_setting['is_open']);

    return $ya_setting;
}

function lucky_event_savecache()
{
    global $_G;
    $data = array();
    $data[1] = array_values(C::t('#ya_lucky#ya_lucky_event')->fetch_all_by_type(1));
    $data[2] = array_values(C::t('#ya_lucky#ya_lucky_event')->fetch_all_by_type(2));
    savecache('ya_lucky_event', $data);

    return $data;
}

function get_lucky_event()
{
    global $_G;

    loadcache('ya_lucky_event');
    $event = empty($_G['cache']['ya_lucky_event']) ? lucky_event_savecache() : $_G['cache']['ya_lucky_event'];

    return $event;
}

function lucky_upadate_userstat($event_type, $reward_key = 1, $uid = 0)
{
    global $_G;

    $uid = $uid ? $uid : $_G['uid'];
    if (!C::t('#ya_lucky#ya_lucky_userstat')->fetch($uid)) {
        $log = array(
            'uid' => $uid,
            'lucky_num' => 0,
            'bad_num' => 0,
        );
        C::t('#ya_lucky#ya_lucky_userstat')->insert($log);
    }

    $field = $event_type == $reward_key ? 'lucky_num' : 'bad_num';
    return C::t('#ya_lucky#ya_lucky_userstat')->increase($uid, $field);
}

function lucky_log_insert($tid, $pid, $eid, $extcreditstype, $credits, $uid = 0, $username = '')
{
    global $_G;

    $uid = $uid ? $uid : $_G['uid'];
    $username = $username ? $username : $_G['username'];

    $data = array(
        'uid' => $uid,
        'username' => $username,
        'tid' => $tid,
        'pid' => $pid,
        'eid' => $eid,
        'extcreditstype' => $extcreditstype,
        'extcredits' => $credits,
        'dateline' => TIMESTAMP,
    );
    return C::t('#ya_lucky#ya_lucky_log')->insert($data);
}

function yl_g_color($groupid)
{
    global $_G;

    if (empty($_G['cache']['usergroups'])) {
        loadcache('usergroups');
    }

    if (empty($_G['cache']['usergroups'][$groupid]['color'])) {
        echo '';
    } else {
        echo ' style="color:' . $_G['cache']['usergroups'][$groupid]['color'] . ';"';
    }
}
