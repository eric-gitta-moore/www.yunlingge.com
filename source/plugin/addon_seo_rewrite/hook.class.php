<?php

/**
 
 */

if (!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_addon_seo_rewrite {
	function common() {
		global $_G;
		if ($_G['cache']['plugin']['addon_seo_rewrite']['study_radio']) {
			include_once libfile('function/core', 'plugin/addon_seo_rewrite/source');
		}
	}
	function global_usernav_extra1() {
		global $_G;
		if ($_G['cache']['plugin']['addon_seo_rewrite']['study_radio']) {
			if (CURSCRIPT == 'home' && CURMODULE == 'space' && $_GET['do'] == 'thread') {
				addon_seo_rewrite_multipage();
			}
		}
		return '';
	}
}

class plugin_addon_seo_rewrite_forum extends plugin_addon_seo_rewrite {

	function forumdisplay_thread_output() {
		global $_G;
		if ($_G['cache']['plugin']['addon_seo_rewrite']['study_radio']) {
			addon_seo_rewrite_dispose($_G['forum_threadlist']);
		}
		return array();
	}

	function guide_top_output() {
		global $_G, $data, $view;
		if ($_G['cache']['plugin']['addon_seo_rewrite']['study_radio']) {
			addon_seo_rewrite_dispose($data[$view]['threadlist']);
		}
		return '';
	}
}

