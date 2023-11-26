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

class plugin_ya_lucky_base
{

    protected $ya_setting = array();
    protected $trigger = array();
    protected $allow_group = FALSE;
    protected $allow_fid = FALSE;
    protected $event = array();

    const REWARD_KEY = 1;
    const PUNISH_KEY = 2;
    const THREAD_DISPLAYORDER = -4;
    const POST_INVISIBLE = -3;
    const EMPTY_PID = 0;

    public function __construct()
    {
        global $_G;

        $this->ya_setting = $this->_get_lucky_setting();

        if ($this->ya_setting['is_open']) {

            $this->trigger = $_G['cache']['plugin']['ya_lucky']['only_thread'] ? array('post_newthread_succeed') : array('post_newthread_succeed', 'post_reply_succeed');
            $this->allow_group = in_array($_G['member']['groupid'], $this->ya_setting['lucky_groups']) ? TRUE : FALSE;
            $this->allow_fid = in_array($_G['fid'], $this->ya_setting['lucky_fids']) ? TRUE : FALSE;
            $this->event = $this->_get_lucky_event();
            if (!$_G['mobile']) {
                include_once template('ya_lucky:module');
            }
        }
    }

    protected function _run_lukcy_post($tid, $pid = self::EMPTY_PID)
    {

        $iflucky = $this->_probability($this->ya_setting['probability']);

        if ($iflucky && !empty($this->event)) {
            $event_type = $this->_probability($this->ya_setting['rew_probability']) ? self::REWARD_KEY : self::PUNISH_KEY;
            $max_num = count($this->event[$event_type]) - 1;
            $eid = mt_rand(0, $max_num);

            return $this->_lukcy_post($event_type, $eid, $tid, $pid);
        }
    }

    protected function _probability($probability)
    {
        $random = mt_rand(1, 100);
        if ($probability >= $random) {
            return true;
        } else {
            return false;
        }
    }

    function _lukcy_post($event_type, $eid, $tid, $pid = self::EMPTY_PID)
    {

        if ($this->event[$event_type][$eid] && $tid) {
            global $_G;

            $event = $this->event[$event_type][$eid];

            $credits = mt_rand(abs($event['minextcredits']), abs($event['maxextcredits']));
            $credits = $event_type == self::REWARD_KEY ? $credits : '-' . $credits;

            if ($event['extcreditstype']) {
                $dataarr = array('extcredits' . $event['extcreditstype'] => $credits);

                $extcredits = $_G['setting']['extcredits'][$event['extcreditstype']]['img'] . $_G['setting']['extcredits'][$event['extcreditstype']]['title'];
                $desc = str_replace(array('{username}', '{extcredit}', '{credit}'), array($_G['username'], $extcredits, $credits), $event['desc']);

                updatemembercount($_G['uid'], $dataarr, true, '', $_G['uid'], '', $this->_yl_lang('lucky_post'), $desc);
                $this->_lucky_log_insert($tid, $pid, $event['eid'], $event['extcreditstype'], $credits);
                $this->_upadate_userstat($event_type);
            }
        }

        return true;
    }

    protected function _lucky_log_insert($tid, $pid, $eid, $extcreditstype, $credits)
    {

        if (C::import('lucky.func', 'plugin/ya_lucky/function') !== false) {
            global $_G;

            return lucky_log_insert($tid, $pid, $eid, $extcreditstype, $credits, $_G['uid'], $_G['username']);
        }
        return false;
    }

    protected function _upadate_userstat($event_type)
    {
        if (C::import('lucky.func', 'plugin/ya_lucky/function') !== false) {
            global $_G;

            return lucky_upadate_userstat($event_type, self::REWARD_KEY, $_G['uid']);
        }
        return false;
    }

    protected function _yl_lang($key)
    {
        return lang('plugin/ya_lucky', $key);
    }

    protected function _get_lucky_setting()
    {
        if (C::import('lucky.func', 'plugin/ya_lucky/function') !== false) {
            return get_lucky_setting();
        }

        return array();
    }

    protected function _get_lucky_event()
    {

        if (C::import('lucky.func', 'plugin/ya_lucky/function') !== false) {
            return get_lucky_event();
        }

        return array();
    }

}

?>