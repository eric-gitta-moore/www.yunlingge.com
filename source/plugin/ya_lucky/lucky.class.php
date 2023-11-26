<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Version: 0.1
 * 	Date: 2019-5-20 16:29
 *      File: lucy.class.php
 *      Desc: 电脑版嵌入点功能
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

C::import('base.class', 'plugin/ya_lucky/class');

class plugin_ya_lucky extends plugin_ya_lucky_base
{

    public function __construct()
    {
        parent::__construct();
    }

}

class plugin_ya_lucky_forum extends plugin_ya_lucky
{

    public function post_ya_lucky_message($params)
    {
        global $_G, $displayorder, $pinvisible;

        list($message, $forword_url, $thread) = $params['param'];

        if ($this->ya_setting['is_open'] && $this->allow_group && $this->allow_fid && in_array($message, $this->trigger) && $displayorder != self::THREAD_DISPLAYORDER && $pinvisible != self::POST_INVISIBLE && $thread['pid']) {
            return $this->_run_lukcy_post($thread['tid'], $thread['pid']);
        }

        return true;
    }

    public function misc_ya_lucky_message($params)
    {
        global $_G;

        list($message) = $params['param'];
        if ($this->ya_setting['is_open'] && $this->allow_group && $this->allow_fid && $_GET['action'] == 'pubsave' && in_array($message, $this->trigger)) {
            return $this->_run_lukcy_post($_G['forum_thread']['tid'], self::EMPTY_PID);
        }

        return true;
    }

    public function viewthread_postbottom_output()
    {
        if (!$this->ya_setting['is_open']) {
            return array();
        }

        global $_G, $postlist;

        $pids = $luckylist = array();

        foreach ($postlist as $post) {
            $pids[] = $post['pid'];
            if ($post['first']) {
                $first_pid = $post['pid'];
            }
        }

        if ($_G['page'] == '1') {
            $pids[] = self::EMPTY_PID;
        }

        foreach (C::t('#ya_lucky#ya_lucky_log')->fetch_all_by_tid_pids($_G['tid'], $pids) as $lucky_log) {

            if ($lucky_log['pid'] == self::EMPTY_PID) {
                $lucky_log['pid'] = $first_pid;
            }

            if ($lucky_log['extcredits'] > 0) {
                $event_type = self::REWARD_KEY;
                $title = $this->_yl_lang('lucky');
                $billboard = $this->_yl_lang('lucky_rank');
                $view = 'lucky';
            } else {
                $event_type = self::PUNISH_KEY;
                $title = $this->_yl_lang('cooler');
                $billboard = $this->_yl_lang('bad_rank');
                $view = 'bad';
            }

            $event = '';
            foreach ($this->event[$event_type] as $val) {
                if ($lucky_log['eid'] != $val['eid']) {
                    continue;
                }
                $event = $val;
            }

            $extcredits = $_G['setting']['extcredits'][$lucky_log['extcreditstype']]['img'] . $_G['setting']['extcredits'][$lucky_log['extcreditstype']]['title'];
            $credits = $lucky_log['extcredits'] . ' ' . $_G['setting']['extcredits'][$lucky_log['extcreditstype']]['unit'];
            $desc = str_replace(array('{username}', '{extcredit}', '{credit}'), array($lucky_log['username'], $extcredits, $credits), $event['desc']);


            $luckylist[$lucky_log['pid']] = array(
                'event_type' => $event_type,
                'title' => $title,
                'desc' => $desc,
                'billboard' => $billboard,
                'view' => $view,
            );
        }
        foreach ($pids as $key => $pid) {
            if ($pid == self::EMPTY_PID) {
                unset($pids[$key]);
                continue;
            }

            if ($luckylist[$pid]['desc']) {
                $luckyEvent[] = tpl_viewthread_postbottom_luckyshow($luckylist[$pid]);
            } else {
                $luckyEvent[] = '';
            }
        }
        return $luckyEvent;
    }

}

?>