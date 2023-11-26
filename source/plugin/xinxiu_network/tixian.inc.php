<?php

if (! defined('IN_DISCUZ') ) {
    exit('Access Denied');
}
$tips = '<li>提现金额是您要给客户打款的最终人民币数量；</li><li>设置手续费的提现金额直接扣除，手续费按四舍五入、取整数计算；</li><li>消耗的积分种类是后台设置的交易积分，人民币与交易积分比例为1：1！</li>';
showtips($tips, 'tips', true, '温馨提示');
$logid = dintval($_GET['logid']);
$go = dintval($_GET['go']);
$identifier = 'xinxiu_network';
$table = '#xinxiu_network#xinxiu_network_tixian';

$url = '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=tixian';

$page = intval ( $_GET['page'] ) ? intval ( $_GET['page'] ) : 1;
$perpage = 20;
$start = ($page - 1) * $perpage;
$logs = C::t($table)->get_range('',$start, $perpage, 'DESC');
$count = C::t($table)->count();
if($go==1){
    $result = C::t($table)->fetch($logid);
    if (!submitcheck('submit')){
        showformheader('plugins&operation=config&do='.$pluginid.'&identifier=xinxiu_network&pmod=tixian&go=1');
        showtableheader();
        showsetting('订单id', 'log[id]', $result['id'], 'text',true,'','订单ID');
        showsetting('用户uid', 'log[uid]', $result['makeruid'], 'text',true,'','用户uid');
        showsetting('提款金额', 'log[price]', $result['price'].'元', 'text',true,'','提现金额');
        showsetting('提交时间', 'log[uiddate]',date('Y-m-d H:i:s',$result['uiddate']), 'text',true,'','提交时间');
        showsetting('申请备注', 'log[uidtext]', $result['uidtext'], 'textarea',true,'','申请备注');
        showsetting('打款备注', 'log[admintext]', $result['admintext'], 'textarea','','','处理备注');
        showtablefooter();
        showsubmit('submit','打款');
        showformfooter();
    }else{
//        var_dump($_GET['log']['admintext']);
//        var_dump($_GET['log']['id']);
        $url = 'action=plugins&operation=config&do='.$pluginid.'&identifier=xinxiu_network&pmod=tixian';
        $str = DB::update('xinxiu_network_tixian',array('admintext'=>$_GET['log']['admintext'],'status'=>2,'admindateline'=>time()),array('id'=>$_GET['log']['id']));
        $str ? cpmsg('orders_validate_succeed', $url, 'succeed') : cpmsg('error01', $url, 'error');
    }
}elseif(empty($logid)){
    showtableheader('提现', '');
    showsubtitle(array(
        '订单id',
        '申请uid',
        '提现金额',
        '消耗积分种类',
        '消耗积分值',
        '提现状态',
        '提交时间',
        'operation',
    ));

    foreach ($logs as $v) {
        showtablerow('', array(), array(
            $v['id'],
            $v['makeruid'],
            $v['price'].'RMB',
            'extcredits'.$v['extcreditskey'],
            $v['extcreditsval'],
            $v['status'] == 1 ? "<font color='green'>申请提现</font>" : "<font color='red'>已打款</font>" ,
            date('Y-m-d H:i:s',$v['uiddate']),
            '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=tixian&logid='.$v['id'].'">详情</a>',
            $v['status'] == 2 ? "<font color='red'>已完成</font>" : '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=tixian&go=1&logid='.$v['id'].'">打款</a>'
        ));
    }
    $mpurl = ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=tixian';
    $multipage = multi($count, $perpage, $page, $mpurl);
//    echo '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=token&logid='.$v['id'].'">View</a>';

//    $tips = '<li>提示信息一</li><li>提示信息二</li><li>提示信息三</li>';
//    showtips($tips, 'tips', true, '温馨提示');
    showtablefooter();
    showsubmit('', '', '', '', $multipage);
    showformfooter();

}elseif(!empty($logid)){
    $result = C::t($table)->fetch($logid);
        showformheader("plugins&operation=config&do='.$pluginid.'&identifier=xinxiu_network&pmod=tixian");
        showtableheader();
        showsetting('log_id', 'log[id]', $result['id'], 'text','','','日志ID');
        showsetting('log_uid', 'log[uid]', $result['makeruid'], 'text','','','用户uid');
        showsetting('log_price', 'log[price]', $result['price'].'元', 'text','','','提现金额');
        showsetting('log_extcreditskey', 'log[extcreditskey]', 'extcredits'.$result['extcreditskey'], 'text','','','消耗积分种类');
        showsetting('log_extcreditsval', 'log[extcreditsval]', $result['extcreditsval'], 'text','','','消耗积分值');
        showsetting('log_status', 'log[status]', $result['status']== 1 ? '申请提现' : '已打款' , 'text','','','提交状态');
        showsetting('log_uiddate', 'log[uiddate]',date('Y-m-d H:i:s',$result['uiddate']), 'text','','','提交时间');
        showsetting('log_uidtext', 'log[uidtext]', $result['uidtext'], 'textarea','','','申请备注');
        showsetting('log_admindateline', 'log[admindateline]',  date('Y-m-d H:i:s',$result['admindateline']), 'text','','','处理时间');
        showsetting('log_admintext', 'log[admintext]', $result['admintext'], 'textarea','','','处理备注');
        showtablefooter();
//        showsubmit('submit1');
        showformfooter();
}






