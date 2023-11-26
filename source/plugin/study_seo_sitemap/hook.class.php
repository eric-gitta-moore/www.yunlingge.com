<?php

/**
 * Copyright 2001-2099 1314 学习.网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 897 2019-12-09 02:47:41
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue（备用 http://t.cn/RU4FEnD）
 * 应用售前咨询：QQ 153.26.940
 * 应用定制开发：QQ 64.330.67.97
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_study_seo_sitemap {
	function global_footerlink(){
		global $_G;
		$return = '';
		$splugin_setting = $_G['cache']['plugin']['study_seo_sitemap'];
		$splugin_lang = lang('plugin/study_seo_sitemap');
		if($splugin_setting['show_url_radio']){
			if($splugin_setting['rewrite_radio']){
				$return = '<span class="pipe">|</span><a href="sitemap.php" >'.$splugin_lang['slang_003'].'</a>';
			}else{
				$return = '<span class="pipe">|</span><a href="plugin.php?id=study_seo_sitemap" >'.$splugin_lang['slang_003'].'</a>';
			}
		}
		if(CURSCRIPT == 'plugin'){
			list($identifier, $module) = explode(':', $_GET['id']);
			if($identifier == 'study_seo_sitemap'){
				//show copyright
				if($splugin_setting['copyright_radio'] && !$_G['uid']){
					$return .= $splugin_lang['copyright'];
				}
			}
		}
    return $return;
	}
}


//Copyright 2001-2099 .1314.学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1358 2019-12-08 18:47:41
//应用售后问题：http://www.1314study.com/services.php?mod=issue （备用 http://t.cn/EUPqQW1）
//应用售前咨询：QQ 15.3269.40
//应用定制开发：QQ 643.306.797
//本插件为 131.4学习网（www.1314Study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。