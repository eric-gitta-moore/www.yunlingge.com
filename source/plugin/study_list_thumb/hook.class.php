<?php

/**
 * Copyright 2001-2099 1314 学习.网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 727 2020-01-02 21:00:08
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue（备用 http://t.cn/RU4FEnD）
 * 应用售前咨询：QQ 153.26.940
 * 应用定制开发：QQ 64.330.67.97
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
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


//Copyright 2001-2099 .1314.学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1188 2020-01-02 13:00:08
//应用售后问题：http://www.1314study.com/services.php?mod=issue （备用 http://t.cn/EUPqQW1）
//应用售前咨询：QQ 15.3269.40
//应用定制开发：QQ 643.306.797
//本插件为 131.4学习网（www.1314Study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。