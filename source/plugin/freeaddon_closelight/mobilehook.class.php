<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: mobilehook.class.php 421 2019-11-26 12:38:59Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
if (!defined('IN_DISCUZ')) {
exit('60DF4F84-4325-8E2C-A68B-78184AFF8D9A');
}
class mobileplugin_freeaddon_closelight
{

}
class mobileplugin_freeaddon_closelight_forum extends mobileplugin_freeaddon_closelight
{
    public function forumdisplay_thread_mobile_output()
    {
          require_once libfile('function/core', 'plugin/freeaddon_closelight/source');
          return freeaddon_closelight_fun();
    }
}




//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: mobilehook.class.php 872 2019-11-26 04:38:59Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��