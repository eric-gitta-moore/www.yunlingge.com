<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 727 2020-01-02 21:00:08
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if (!defined('IN_DISCUZ')) {
exit('http://www.yun-ling.cn/');
}
class plugin_study_list_thumb {}
class plugin_study_list_thumb_forum extends plugin_study_list_thumb {
	function __construct() {
		require_once libfile('function/core', 'plugin/study_list_thumb/source');
	}
	public function forumdisplay_top_output() {
		global $_G;
		$return = '';
		if ($_G['cache']['plugin']['study_list_thumb']['show_way'] == '1') {
			$return = study_list_thumb();
		}
		return $return;
	}
	public function forumdisplay_thread_subject_output() {
		global $_G;
		$return = array();
		if ($_G['cache']['plugin']['study_list_thumb']['show_way'] == '2') {
			$return = study_list_thumb2();
		}
		return $return;
	}
}


//Copyright 2001-2099 .1314.ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1188 2020-01-02 13:00:08
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue ������ http://t.cn/EUPqQW1��
//Ӧ����ǰ��ѯ��QQ 15.3269.40
//Ӧ�ö��ƿ�����QQ 643.306.797
//�����Ϊ 131.4ѧϰ����www.1314Study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��