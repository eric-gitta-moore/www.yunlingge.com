<?php
/*
 * 插件名称:IE内核版本检测
 * 插件版本：V1.0.0
 * 插件作者：梦梦
 * 作者网站：http://www.moemiao.net/
 */
	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}
	class plugin_moemiao_ie {
		function global_cpnav_top(){
			
			global $_G;
			$set = $_G['cache']['plugin']['moemiao_ie'];
            $lang = lang('plugin/moemiao_ie');

			if(empty($set['ietext'])){
			  $ietext = $lang['ietext'];
			}else{
			  $ietext = $set['ietext'];
			}
			
			if(empty($set['iecolor'])){
			  $iecolor = "#FFF";
			}else{
			  $iecolor = $set['iecolor'];
			}
			
			if(empty($set['iebgcolor'])){
			  $iebgcolor = "#000";
			}else{
			  $iebgcolor = $set['iebgcolor'];
			}
			
			if(empty($set['ieacolor'])){
			  $ieacolor = "#F13C35";
			}else{
			  $ieacolor = $set['ieacolor'];
			}

			$moemiao_ie = "
			<style type='text/css'>
				.moemiao_ie{
				  text-align:center;
				  background:".$iebgcolor.";
				  color:".$iecolor.";
                  height:30px;
                  line-height:30px;
				}
				.moemiao_ie a{
				  color:".$ieacolor."!important;
                  float:none !important;
				}
			</style>
			<!--[if lt IE ".$set['ieversion']." ><div class='moemiao_ie'>".$ietext."</div><![endif]-->";

			return $moemiao_ie;
	}
}
?>