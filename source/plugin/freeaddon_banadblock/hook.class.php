<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 663 2019-11-26 12:51:05Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if (!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_freeaddon_banadblock {
    function global_footer() {
        global $_G;
        $return = '';
        if($_G['inshowmessage']) {
					return '';
				}
        $splugin_setting = $_G['cache']['plugin']['freeaddon_banadblock'];
        $gids = unserialize($splugin_setting['gids']);
        if (in_array($_G['groupid'], $gids) && (!$splugin_setting['robot'] || !IS_ROBOT)) {
           include template('freeaddon_banadblock:banadblock');
        }
				return $return;
    }
}

//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1108 2019-11-26 04:51:05Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��