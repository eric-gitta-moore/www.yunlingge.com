<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 1447 2019-11-26 13:03:55Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if (!defined('IN_DISCUZ')) {
exit('2020012206WZpw8DIlFE');
}
class plugin_freeaddon_attach_auto_description
{
}

class plugin_freeaddon_attach_auto_description_forum extends plugin_freeaddon_attach_auto_description
{
    public function post_attachautodescription()
    {
        global $_G;
        $return          = '';
        $splugin_setting = $_G['cache']['plugin']['freeaddon_attach_auto_description'];
        $splugin_lang    = lang('plugin/freeaddon_attach_auto_description');
        if ($_GET['attachnew'] && is_array($_GET['attachnew'])) {
            $study_fids = unserialize($splugin_setting['study_fids']);
            require_once libfile('function/core', 'plugin/freeaddon_attach_auto_description/source');
            if (!freeaddon_attach_auto_description($study_fids) || in_array($_G['fid'], $study_fids)) {
                $study_gids = unserialize($splugin_setting['study_gids']);
                if (!freeaddon_attach_auto_description($study_gids) || in_array($_G['groupid'], $study_gids)) {
                    $description = str_replace(array('{subject}'), array($_GET['subject']), $splugin_setting['description']);
                    foreach ($_GET['attachnew'] as $key => $value) {
                        $_GET['attachnew'][$key]['description'] = $value['description'] ? $value['description'] : $description;
                    }
                }
            }
        }
    }

}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1893 2019-11-26 05:03:55Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��