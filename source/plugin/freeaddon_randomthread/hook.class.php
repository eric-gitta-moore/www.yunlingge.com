<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 740 2020-01-09 11:22:42Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_DISCUZ')) {
exit('2020012607P4fFJ4U80g');
}
require_once libfile('function/core', 'plugin/freeaddon_randomthread/source');
class plugin_freeaddon_randomthread {
		function global_cpnav_extra1(){
				return show_randomthread('global_cpnav_extra1');
		}
		
		function global_cpnav_extra2(){
				return show_randomthread('global_cpnav_extra2');
		}
		
		function global_nav_extra(){
				return show_randomthread('global_nav_extra');
		}

}
class plugin_freeaddon_randomthread_forum extends plugin_freeaddon_randomthread{
		function index_status_extra(){
			 	return show_randomthread('index_status_extra');
		}
		function index_nav_extra(){
			 	return show_randomthread('index_nav_extra');
		}
}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1185 2020-01-09 03:22:42Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��