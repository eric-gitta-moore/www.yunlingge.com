<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: mobilehook.class.php 532 2019-11-26 12:41:36Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
if (!defined('IN_DISCUZ')) {
exit('Access Denied');
}
require_once libfile('function/core', 'plugin/study_bbclosed_remind/source');
class mobileplugin_study_bbclosed_remind
{
    public function global_header_mobile()
    {  
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['study_bbclosed_remind']; // 调用后台设置参数
        $return = '';
        if ($splugin_setting['study_mradio']) {
         $return = study_bbclosed_remind();
        }  
        return $return;
    }
}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: mobilehook.class.php 983 2019-11-26 04:41:36Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��