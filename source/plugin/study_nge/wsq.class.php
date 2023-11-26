<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class study_nge_api {
	function forumdisplay_topBar() {
		global $_G;
		$return = array();
		require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
		require_once libfile('class/func', 'plugin/study_nge/source');
        require_once libfile('class/mysql', 'plugin/study_nge/source');
        require_once libfile('class/get_data', 'plugin/study_nge/source');
		
		// 鑾峰彇鎻掍欢閰嶇疆
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $splugin_lang = lang('plugin/study_nge');
		
		$threads_existid_key = array(2, 3, 4, 5, 6);
        $threads_existid_value = array('2' => 'newpost', '3' => 'newreply', '4' => 'recpost', '5' => 'goodreply', '6' => 'hotpost');
        $middle_active_array[2] = $splugin_setting['newpost_title'] ? $splugin_setting['newpost_title'] : $splugin_lang['study_newpost_title'];
        $middle_active_array[3] = $splugin_setting['newreply_title'] ? $splugin_setting['newreply_title'] : $splugin_lang['study_newreply_title'];
        $middle_active_array[4] = $splugin_setting['recpost_title'] ? $splugin_setting['recpost_title'] : $splugin_lang['study_recpost_title'];
        $middle_active_array[5] = $splugin_setting['goodreply_title'] ? $splugin_setting['goodreply_title'] : $splugin_lang['study_goodreply_title'];
        $middle_active_array[6] = $splugin_setting['hotpost_title'] ? $splugin_setting['hotpost_title'] : $splugin_lang['study_hotpost_title'];

        $middle_order = $splugin_setting['middle_order'] ? $splugin_setting['middle_order'] :'2,3,4,5,6';
        $middle_order_array = explode(',', $middle_order);
        $css = '<style>#topcontainer .study_nge_wsq{white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}#topcontainer .study_nge_wsq li em{float:right;display:none;}</style>';
        foreach($middle_order_array as $key => $active_id) {
            if(in_array($active_id, $threads_existid_key)) {
                $type = $threads_existid_value[$active_id];
                $threadlist = study_nge::get_threads($type);
                if(!empty($threadlist)){
                	$html = study_nge_func::wsq_thread($threadlist);
	                $return[] = array(
						'name' => $middle_active_array[$active_id],
						'html' => $css.$html,
						'more' => '',
					);
					$css = '';
				}
            }
        }
		return $return;
	}
}

//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: wsq.class.php 2891 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。