<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: contentorigin.class.php 3878 2019-11-21 10:48:23Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */

if(!defined('IN_DISCUZ')) {
exit('www.1314study.com');
}
class plugin_study_contentorigin{
		function global_footer(){
			global $_G;
			$return = '';
			$splugin_setting = $_G['cache']['plugin']['study_contentorigin'];
			$study_groups = unserialize($splugin_setting['study_limit']);
			if(!in_array($_G['groupid'], $study_groups)){
				$study_origin = str_replace('{url}',"'+location.href+'",$splugin_setting['study_origin']);
				include template('study_contentorigin:copy');
			}
			return $return;
		}
}

class plugin_study_contentorigin_forum extends plugin_study_contentorigin{

	function viewthread_postsightmlafter(){

			global $_G,$postlist;
			$return = array();

			if(!$_G['setting']['version']) {
			    require_once DISCUZ_ROOT . './source/discuz_version.php';
			    $_G['setting']['version'] = DISCUZ_VERSION;
			}
			if(in_array($_G['setting']['version'], array('X1.5', 'X2'))) {
			    $data_dir = 'cache';
			}else {
			    $data_dir = 'sysdata';
			}
			@include_once(DISCUZ_ROOT . './data/' . $data_dir . '/cache_study_contentorigin.php');
			$splugin_lang = lang('plugin/study_contentorigin');

			if($splugin_config['study_iflink']=='1' && !$_G['inajax'] && $_G['page'] == 1){
			   	if($splugin_config['study_ifbg']=='1'){
							$study_dispic = explode(",",$splugin_config['study_dispic']);
							$count_dispic = count($study_dispic);
							$count_dispic = $count_dispic - 1;
							if(!empty($study_dispic[0])){
								$picshow = 'background:url(/source/plugin/study_contentorigin/images/'.$study_dispic[rand(0,$count_dispic)].'.gif) no-repeat center top;';
							}else{
								$picshow = 'background:url(/source/plugin/study_contentorigin/images/study.gif) no-repeat center top;';
							}
							$overcolor = $splugin_config['study_overcolor'];
							if(!empty($splugin_config['study_wordcolor'])){
									$wordcolor = $splugin_config['study_wordcolor'];
							}else{
									$wordcolor = "#000";
							}
							if($splugin_config['study_transparent']=='1'){
									$transparent = "transparent";
							}else{
									$transparent = "#FFF";
							}
							if(!empty($overcolor)){
								 $mouseover = 'onmouseover=\'this.style.backgroundColor="'.$overcolor.'";\' onmouseout=\'this.style.backgroundColor="'.$transparent.'";\'';
							}
					}
					$copytitle = urldecode($_G['forum_thread']['subjectenc']);
					if(in_array('forum_forumdisplay', $_G['setting']['rewritestatus'])) {
						$copyurl = $_G['siteurl'].str_replace(array('{tid}','{page}','{prevpage}'),array($_G['tid'],'1','1'),$_G['setting']['rewriterule']['forum_viewthread']);
					}else{
						$copyurl = $_G['siteurl'].'forum.php?mod=viewthread&tid='.$_G['tid'];
					}
					$return[] = '<div style="'.$picshow.' no-repeat center top; border:#CAD9EA solid 0px; height: 60px;margin:10px 0; text-align:center;"><p style="height:10px;"></p><p class="mtm pns"><b><font style="color:'.$wordcolor.'">'.$splugin_lang['study_tieziloc'].'</font></b><input type="text" '.$mouseover.' onclick="this.select();setCopy(\''.$copytitle.'\n'.$copyurl.'\n('.$splugin_lang['study_from'].': '.($_G['setting']['bbname'] ? $_G['setting']['bbname'] : $_G['setting']['siteurl']).')\', \''.$splugin_lang['study_lert'].'\');" value="'.$copyurl.'" size="40" class="px" style="color:'.$wordcolor.';vertical-align:middle;background:'.$transparent.';" />&nbsp;<button type="submit" class="pn" style="color:'.$wordcolor.';background:'.$transparent.';" '.$mouseover.' onclick="setCopy(\''.$copytitle.'\n'.$copyurl.'\n('.$splugin_lang['study_from'].': '.($_G['setting']['bbname'] ? $_G['setting']['bbname'] : $_G['setting']['siteurl']).')\', \''.$splugin_lang['study_lert'].'\')"><font style="color:'.$wordcolor.'"><em>'.$splugin_lang['study_button'].'</em></font></button></p></div>';
			}
			return is_array($return)?$return:[$return];
	}
}



//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: contentorigin.class.php 4333 2019-11-21 02:48:23Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。