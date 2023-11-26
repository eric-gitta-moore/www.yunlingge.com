<?php

/**
 * 	[¡¾ÔÆÃ¨¡¿ÐÒÔË·¢Ìû(ya_lucky)] (C)2019-2099 Powered by ÔÆÃ¨¹¤×÷ÊÒ.
 * 	Date: 2019-5-20 16:29
 *      File: event.inc.php
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

C::import('common.func', 'plugin/ya_lucky/function');
C::import('admincp.func', 'plugin/ya_lucky/function');
C::import('lucky.func', 'plugin/ya_lucky/function');

define('ADMINCPURL', "plugins&operation=config&do={$pluginid}&identifier=ya_lucky&pmod=event");
define('CPMSGURL', "action=" . ADMINCPURL);

if (!submitcheck('cardsubmit')) {

    if (empty($_G['setting']['extcredits'])) {
        cpmsg_error(yl_lang('not_open_extcredits'), $_G['siteurl'] . '/' . ADMINSCRIPT . '?action=setting&operation=credits');
    }

    $extcreditstype_arr = array();
    $extcreditstype_arr[0] = 'extcreditstype';
    $extcreditstype_arr[1] = array();
    foreach ($_G['setting']['extcredits'] as $key => $val) {
        $extcreditstype_arr[1][] = array($key, $val['title']);
    }
    $type_arr = array(
        0 => 'type',
        1 => array(
            array('', $lang['all']),
            array(1, yl_lang('reward')),
            array(2, yl_lang('punishment'))
        ),
    );
    $order_arr = array(
        0 => 'order',
        1 => array(
            array('ASC', yl_lang('desc')),
            array('DESC', yl_lang('asc'))
        ),
    );

    showtips(yl_lang('event_tips'), 'tips', TRUE, yl_lang('reminder'));

    $type = !empty($_GET['type']) && in_array($_GET['type'], array(1, 2)) ? intval($_GET['type']) : '';
    $order = !empty($_GET['order']) && in_array($_GET['order'], array('DESC', 'ASC')) ? dhtmlspecialchars($_GET['order']) : 'DESC';
    $lists = C::t('#ya_lucky#ya_lucky_event')->fetch_all_by_type($type, $order);

    showformheader(ADMINCPURL);
    showtableheader(yl_lang('search'));
    showtablerow('', $tdstyle, array(
        yl_lang('display') . ': ' . ya_select($order_arr, $order)
        . '&nbsp;' . yl_lang('reward_and_penalties_type') . ': ' . ya_select($type_arr, $type)
        . '&nbsp;<input type="submit" value="' . $lang['search'] . '" class="btn" />'
    ));
    showtablefooter();
    showformfooter();

    unset($order_arr[1][0]);

    $tdstyle = array('width="30px"', 'width="100px"', 'width="100px"', 'width="170px"', 'width="170px"', 'width="450px"', 'width="170px"', '');
    $titles = array(
        '',
        '*' . yl_lang('reward_and_penalties_type'),
        '*' . yl_lang('extcreditstype'),
        '*' . yl_lang('minextcredits'),
        '*' . yl_lang('maxextcredits'),
        '*' . yl_lang('event_desc'),
        yl_lang('add_time')
    );
    showformheader(ADMINCPURL);
    showtableheader(yl_lang('reward_and_penalties_eventlist'));
    showsubtitle($titles, 'header', $tdstyle);
    foreach ($lists as $list) {
        $extcreditstype_arr[0] = "extcreditstype[{$list['eid']}]";
        $type_arr[0] = "type[{$list['eid']}]";
        showtablerow('', $tdstyle, array(
            '<input type="checkbox" name="deleteid[' . $list['eid'] . ']" value="' . $list['eid'] . '">',
            ya_select($type_arr, $list['type'], 'required="required"'),
            ya_select($extcreditstype_arr, $list['extcreditstype'], 'required="required"'),
            '<input type="number" class="txt" name="minextcredits[' . $list['eid'] . ']" value="' . $list['minextcredits'] . '" required="required">',
            '<input type="number" class="txt" name="maxextcredits[' . $list['eid'] . ']" value="' . $list['maxextcredits'] . '" required="required">',
            '<textarea name="desc[' . $list['eid'] . ']" cols="50" rows="2" required="required">' . $list['desc'] . '</textarea>',
            dgmdate($list['dateline']),
            '',
        ));
    }
    echo '<tr><td colspan="10"><div><a href="###" onclick="addrow(this, 0)" class="addtr">' . $lang['add'] . '</a></div></tr>';
    showsubmit('cardsubmit', 'submit', 'del');
    showtablefooter();
    showformfooter();

    $extcreditstype_arr[0] = 'in_extcreditstype[]';
    $in_extcreditstype = str_replace("\n", '', ya_select($extcreditstype_arr, '', 'required="required"'));
    $type_arr[0] = 'in_type[]';
    $in_type = str_replace("\n", '', ya_select($type_arr, '', 'required="required"'));

    echo <<<EOF
<script>
    var rowtypedata = [
        [
            [1, ''],
            [1,'{$in_type}'],
            [1, '{$in_extcreditstype}'],
            [1,'<input type="number" class="txt" name="in_minextcredits[]" value="1" required="required"/>'],
            [1,'<input type="number" class="txt" name="in_maxextcredits[]" value="10" required="required"/>'],
            [1, '<div><textarea name="in_desc[]" cols="50" rows="2" required="required"></textarea>&nbsp;<a href="javascript:;" class="deleterow" onClick="deleterow(this)">{$lang['delete']}</a></div>']
        ]
    ]
</script>
EOF;
} else {
    foreach ($_GET['in_type'] as $key => $val) {
        if (empty($val) || empty($_GET['in_extcreditstype'][$key]) || empty($_GET['in_minextcredits'][$key]) || empty($_GET['in_maxextcredits'][$key]) || empty($_GET['in_desc'][$key])) {
            continue;
        }
        $_GET['in_minextcredits'][$key] = max(1, $_GET['in_minextcredits'][$key]);
        $_GET['in_maxextcredits'][$key] = max($_GET['in_minextcredits'][$key] + 1, $_GET['in_maxextcredits'][$key]);
        $data = array(
            'extcreditstype' => intval($_GET['in_extcreditstype'][$key]),
            'minextcredits' => intval($_GET['in_minextcredits'][$key]),
            'maxextcredits' => intval($_GET['in_maxextcredits'][$key]),
            'desc' => dhtmlspecialchars($_GET['in_desc'][$key]),
            'type' => intval($val),
            'dateline' => TIMESTAMP,
        );

        C::t('#ya_lucky#ya_lucky_event')->insert($data);
    }

    foreach ($_GET['type'] as $key => $val) {
        if (isset($_GET['deleteid'][$key])) {
            C::t('#ya_lucky#ya_lucky_event')->delete($key);
        } else {
            if (empty($val) || empty($_GET['extcreditstype'][$key]) || empty($_GET['minextcredits'][$key]) || empty($_GET['maxextcredits'][$key]) || empty($_GET['desc'][$key])) {
                continue;
            }
            $_GET['minextcredits'][$key] = max(1, $_GET['minextcredits'][$key]);
            $_GET['maxextcredits'][$key] = max($_GET['minextcredits'][$key] + 1, $_GET['maxextcredits'][$key]);
            $data = array(
                'extcreditstype' => intval($_GET['extcreditstype'][$key]),
                'minextcredits' => intval($_GET['minextcredits'][$key]),
                'maxextcredits' => intval($_GET['maxextcredits'][$key]),
                'desc' => dhtmlspecialchars($_GET['desc'][$key]),
                'type' => intval($val),
            );

            C::t('#ya_lucky#ya_lucky_event')->update($key, $data);
        }
    }

    lucky_event_savecache();

    cpmsg('groups_setting_succeed', CPMSGURL, 'succeed');
}
?>