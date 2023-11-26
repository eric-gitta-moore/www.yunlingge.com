<?php
if (! defined('IN_DISCUZ') || ! defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$logid = dintval($_GET['logid']);
$identifier = 'xinxiu_network';
$table = '#xinxiu_network#xinxiu_network_token';

$url = '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=token';

$page = intval ( $_GET['page'] ) ? intval ( $_GET['page'] ) : 1;
$perpage = 20;
$start = ($page - 1) * $perpage;
$logs = C::t($table)->get_range('',$start, $perpage, 'DESC');
$count = C::t($table)->count();
if (empty($logid)){
    showtableheader('token日志', '');
    showsubtitle(array(
        '用户uid',
        'ip',
        '会员组id',
        '管理组id',
        'token令牌',
        '最后登陆时间',
        '登录次数',
    ));

    foreach ($logs as $v) {
        showtablerow('', array(), array(
            $v['uid'],
            $v['ip1'].'.'.$v['ip2'].'.'.$v['ip3'].'.'.$v['ip4'],
            $v['groupid'],
            $v['adminid'],
            substr($v['token'],0,5).'****'.substr($v['token'],(strlen($v['token'])-5)),
            (time() - $v['lastactivity']) > 3600 ?  "<font color='green'>".date('Y-m-d H:i:s',$v['lastactivity'])."</font>":"<font color='red'>".date('Y-m-d H:i:s',$v['lastactivity'])."</font>",
            $v['loginint'],
//            '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=logs&logid='.$v['id'].'">View</a>'
        ));
    }
    $mpurl = ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=token';
    $multipage = multi($count, $perpage, $page, $mpurl);
//    echo '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=token&logid='.$v['id'].'">View</a>';
    showsubmit('', '', '', '', $multipage);
//    $tips = '<li>提示信息一</li><li>提示信息二</li><li>提示信息三</li>';
//    showtips($tips, 'tips', true, '温馨提示');
    showtablefooter();
}






