<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 897 2019-12-09 02:47:41
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
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


//Copyright 2001-2099 .1314.ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1358 2019-12-08 18:47:41
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue ������ http://t.cn/EUPqQW1��
//Ӧ����ǰ��ѯ��QQ 15.3269.40
//Ӧ�ö��ƿ�����QQ 643.306.797
//�����Ϊ 131.4ѧϰ����www.1314Study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��