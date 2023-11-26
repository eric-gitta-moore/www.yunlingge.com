<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 1514 2019-11-26 12:52:31Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_DISCUZ')) {
exit('2020012206XhU6HOewFz');
}
require_once libfile('function/core', 'plugin/freeaddon_editposttime/source');
class plugin_freeaddon_editposttime {

}
class plugin_freeaddon_editposttime_forum extends plugin_freeaddon_editposttime{
		function viewthread_title_extra_output(){
			 	global $_G;
				$return = array();
				$splugin_setting = $_G['cache']['plugin']['freeaddon_editposttime'];
				$splugin_lang = lang('plugin/freeaddon_editposttime');
				if($_G['page'] == 1 && !$_G['inajax']){
						$study_fids = unserialize($splugin_setting['study_fids']);
						if(!editposttime_list_array($study_fids) || in_array($_G['fid'], $study_fids)){
								$study_gids = unserialize($splugin_setting['study_gids']);
								if(!editposttime_list_array($study_gids) || in_array($_G['groupid'], $study_gids)){
									if($_G['thread']['authorid'] == $_G['uid'] || $splugin_setting['nomy_radio']){
											$splugin_setting['text'] = $splugin_setting['color'] ? '<font style="color:'.$splugin_setting['color'].'">'.$splugin_setting['text'].'</font>' : $splugin_setting['text'];
											$splugin_setting['text'] = $splugin_setting['bold'] ? '<b>'.$splugin_setting['text'].'</b>' : $splugin_setting['text'];
											$return = '<a href="plugin.php?id=freeaddon_editposttime&tid='.$_G['tid'].'" onclick="showWindow(\'freeaddon_editposttime\', this.href, \'get\');">'.$splugin_setting['text'].'</a>';
									}
								}
						}
				}//print_r($a);
				return $return;
		}

}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 1960 2019-11-26 04:52:31Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。