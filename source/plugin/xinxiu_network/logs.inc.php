<?php
if (! defined('IN_DISCUZ') || ! defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$logid = dintval($_GET['logid']);
$identifier = 'xinxiu_network';
$table = '#xinxiu_network#xinxiu_network_log';

$url = '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=logs';

$page = intval ( $_GET['page'] ) ? intval ( $_GET['page'] ) : 1;
$perpage = 20;
$start = ($page - 1) * $perpage;
$logs = C::t($table)->get_range('',$start, $perpage, 'DESC');
$count = C::t($table)->count();
if (empty($logid)){
    showtableheader('logs', '');
    showsubtitle(array(
        'logid',
        'uid',
        'apikey',
        'isapi',
        'action',
        'errcode',
        'time',
        'ip',
        'operation'
    ));
    foreach ($logs as $v) {
        showtablerow('', array(), array(
            $v['id'],
            $v['uid'],
            $v['apikey'],
            $v['isapi'],
            $v['action'],
            $v['errcode'] == 200 ? "<font color='green'>".$v['errcode']."</font>":"<font color='red'>".$v['errcode']."</font>",
            date('Y-m-d H:i:s',$v['time']),
            $v['fromip'],
            '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=logs&logid='.$v['id'].'">View</a>'
        ));
    }
    $mpurl = ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=logs';
    $multipage = multi($count, $perpage, $page, $mpurl);
    showsubmit('', '', '', '', $multipage);
    showtablefooter();
}else{
    $result = C::t($table)->fetch($logid);
    showformheader($url);
    showtableheader();
    showsetting('log_id', 'log[uid]', $result['id'], 'text','','','日志ID');
    showsetting('log_uid', 'log[uid]', $result['uid'], 'text','','','用户uid');
    showsetting('log_key', 'log[apikey]', $result['apikey'], 'text');
    showsetting('log_api', 'log[isapi]', $result['isapi'], 'text');
    showsetting('log_action', 'log[action]', $result['action'], 'text');
    showsetting('log_errcode', 'log[errcode]', $result['errcode'], 'text');
    showsetting('log_get', 'log[isget]', $result['isget'], 'textarea');
    showsetting('log_post', 'log[ispost]', $result['ispost'], 'textarea');
    showsetting('log_time', 'log[time]', date('Y-m-d H:i:s',$result['time']), 'text');
    showsetting('log_fromip', 'log[fromip]', $result['fromip'], 'text');
    showsetting('log_output', 'log[output]', $result['output'], 'textarea');
    //showsubmit('submit');
    showtablefooter();
    showformfooter();
}






