<?php

if (! defined('IN_DISCUZ') ) {
    exit('Access Denied');
}
//echo  '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=test&go=exit">View11</a>';
$tips = '<li>本页面无限级查询，推广邀请数据，输入需要查询的uid即可；</li><li>本框架推广邀请功能与DZ官方同步，结合插件“推广提成”设置进行提成奖励（必须通过本框架充值接口才能生效）；</li><li>网站注册必须开启邀请码发放注册，软件注册必须在注册接口时使用；</li>';
showtips($tips, 'tips', true, '温馨提示');
$identifier = 'xinxiu_network';
$go = $_GET['go'];
$uid = $_GET['uid'];
if (empty($go)){
    if (!submitcheck('submit')){
        showformheader('plugins&operation=config&do='.$pluginid.'&identifier=xinxiu_network&pmod=invite');
        showtableheader();
        showsetting('输入需要查询的用户uid','souid','','text');
        showtablefooter();
        showsubmit('submit');
        showformfooter();
    }else{
        $logs = DB::fetch_all('select * from %t where uid=%d',array('common_invite',$_GET['souid']));
        $num = count($logs);
        showtableheader('logs', '');
        showsubtitle(array(
            'id',
            '推广人',
            '推广渠道',
            '被推广人uid',
            '被推广人用户名',
            '下级推广人数',
            '注册ip',
            '注册时间',
            'operation'
        ));
        for($i=0;$i<$num;$i++){
            $fuid = DB::fetch_all('select * from %t where uid=%d',array('common_invite',$logs[$i]['fuid']));
            showtablerow('', array(), array(
                $logs[$i]['id'],
                $logs[$i]['uid'],
                $logs[$i]['code'] == 'network' ? "<font color='red'>软件注册</font>" : "<font color='green'>网站注册</font>" ,
                $logs[$i]['fuid'],
                $logs[$i]['fusername'],
                count($fuid) ? "<font color='red'>".'(下线'.count($fuid).'人)'."</font>":"<font color='green'>".'(下线'.count($fuid).'人)'."</font>" ,
                $logs[$i]['inviteip'],
                date('Y-m-d H:i:s',$logs[$i]['regdateline']),
                count($fuid) ? '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=invite&go=cha&uid='.$logs[$i]['fuid'].'">查下线人数</a>' : "<font color='green'>暂无下线</font>"
            ));
        }
        showtablefooter();
        showformfooter();
    }
}elseif ($go == 'exit'){
    if (!submitcheck('submit1')){
        showformheader('plugins&operation=config&do='.$pluginid.'&identifier=xinxiu_network&pmod=invite');
        showtableheader();
        showsetting('颜色管理','yanse','','color');
        echo  '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=invite&go=exit">View</a>';
        showtablefooter();
        showsubmit('submit1');
        showformfooter();
    }else{
        debug($_GET);
    }
}elseif ($go == 'cha'){
    $logs = DB::fetch_all('select * from %t where uid=%d',array('common_invite',$uid));
    $num = count($logs);
    showtableheader('logs', '');
    showsubtitle(array(
        'id',
        '推广人',
        '推广渠道',
        '被推广人uid',
        '被推广人用户名',
        '下级推广人数',
        '注册ip',
        '注册时间',
        'operation'
    ));
    for($i=0;$i<$num;$i++){
        $fuid = DB::fetch_all('select * from %t where uid=%d',array('common_invite',$logs[$i]['fuid']));
        showtablerow('', array(), array(
            $logs[$i]['id'],
            $logs[$i]['uid'],
            $logs[$i]['code'] == 'network' ? "<font color='red'>软件注册</font>" : "<font color='green'>网站注册</font>" ,
            $logs[$i]['fuid'],
            $logs[$i]['fusername'],
            count($fuid) ? "<font color='red'>".'(下线'.count($fuid).'人)'."</font>":"<font color='green'>".'(下线'.count($fuid).'人)'."</font>" ,
            $logs[$i]['inviteip'],
            date('Y-m-d H:i:s',$logs[$i]['regdateline']),
            count($fuid) ? '<a href="'.ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=' . $identifier . '&pmod=invite&go=cha&uid='.$logs[$i]['fuid'].'">查下线人数</a>' : "<font color='green'>暂无下线</font>"
        ));
    }
    showtablefooter();
    showformfooter();
}

