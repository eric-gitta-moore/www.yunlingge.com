<?php

/**
 * Copyright 2001-2099 1314 学习.网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 3473 2019-12-26 16:10:12
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue（备用 http://t.cn/RU4FEnD）
 * 应用售前咨询：QQ 153.26.940
 * 应用定制开发：QQ 64.330.67.97
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_study_postformat {

}
class plugin_study_postformat_forum extends plugin_study_postformat{
	
	public function post_middle_output(){
			global $_G,$postinfo,$message;
			$splugin_setting = $_G['cache']['plugin']['study_postformat'];
			$splugin_lang = lang('plugin/study_postformat');
			$study_fids = unserialize($splugin_setting['study_fids']);
			if(in_array($_G['fid'], $study_fids)){
					$postformat_cache = array();
					@include DISCUZ_ROOT.'./data/cache/cache_study_postformat_fids.php';
					if($postformat_cache[$_G['fid']]){
						if($_GET['action'] == 'newthread'){
							$postinfo['subject'] = dhtmlspecialchars($postformat_cache[$_G['fid']]['subject']);
							$message_array = explode("||", $postformat_cache[$_G['fid']]['message']);
							$m_key = rand(0,(count($message_array)-1));
							$message = dhtmlspecialchars($message_array[$m_key]);
						}elseif($_GET['action'] == 'reply'){
							$message = dhtmlspecialchars($postformat_cache[$_G['fid']]['replymessage']);
						}
					}
			}
			return '';
	}
	
	public function forumdisplay_fastpost_content_output(){
		global $_G,$fastpost;
		$splugin_setting = $_G['cache']['plugin']['study_postformat'];
		$study_fids = unserialize($splugin_setting['study_fids']);
		if(in_array($_G['fid'], $study_fids)){
					$postformat_cache = array();
					@include DISCUZ_ROOT.'./data/cache/cache_study_postformat_fids.php';
					if($postformat_cache[$_G['fid']]['subject'] || $postformat_cache[$_G['fid']]['message']){
						$subject = dhtmlspecialchars($postformat_cache[$_G['fid']]['subject']);
						$message_array = explode("||", $postformat_cache[$_G['fid']]['message']);
						$m_key = rand(0,(count($message_array)-1));
						$message = dhtmlspecialchars($message_array[$m_key]);
						$_G['setting']['rewritestatus'] = '1';
						$_G['setting']['output']['str']['search']['study_postformat_subject'] = '<input type="text" id="subject" name="subject" class="px" value=""';
				    $_G['setting']['output']['str']['replace']['study_postformat_subject'] = '<input type="text" id="subject" name="subject" class="px" value="'.$subject.'"';
						$_G['setting']['output']['str']['search']['study_postformat_message'] = '></textarea>';
				    $_G['setting']['output']['str']['replace']['study_postformat_message'] = '>'.$message.'</textarea>';
					}
		}
		
		return '';
	}
	
	public function viewthread_fastpost_content_output(){
		global $_G,$fastpost;
		$splugin_setting = $_G['cache']['plugin']['study_postformat'];
		$study_fids = unserialize($splugin_setting['study_fids']);
		if(in_array($_G['fid'], $study_fids)){
					$postformat_cache = array();
					@include DISCUZ_ROOT.'./data/cache/cache_study_postformat_fids.php';
					if($postformat_cache[$_G['fid']]['replymessage']){
						$replymessage = dhtmlspecialchars($postformat_cache[$_G['fid']]['replymessage']);
						$_G['setting']['rewritestatus'] = '1';
						$_G['setting']['output']['str']['search']['study_postformat_replymessage'] = '></textarea>';
				    $_G['setting']['output']['str']['replace']['study_postformat_replymessage'] = '>'.$replymessage.'</textarea>';
					}
		}
		
		return '';
	}
	
	public function post_infloat_top_output(){
		$this->viewthread_fastpost_content_output();
	}
}


//Copyright 2001-2099 .1314.学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 3935 2019-12-26 08:10:12
//应用售后问题：http://www.1314study.com/services.php?mod=issue （备用 http://t.cn/EUPqQW1）
//应用售前咨询：QQ 15.3269.40
//应用定制开发：QQ 643.306.797
//本插件为 131.4学习网（www.1314Study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。