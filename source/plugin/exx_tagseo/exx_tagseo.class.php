<?php
if(!defined('IN_DISCUZ')) {
  exit('Access Denied');
}

class plugin_exx_tagseo_forum{
	function viewthread_posttop_output() {
		global $_G,$post,$seodata;
		$exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];	
		
		$section = empty($exx_tagseo['bk']) ? array() : unserialize($exx_tagseo['bk']);
		if(!is_array($section)) $section = array();
		if(!(empty($section[0]) || in_array($_G['fid'],$section))){
			return;
		}
        $tags = $seodata['tags'];
		if(empty($tags)){
			$ajax="<script>
			window.onload=function(){
				setTimeout(function(){
					settag();function settag() {var x = new Ajax();x.get('plugin.php?id=exx_tagseo:settag&tid=".$_G[tid]."&formhash=".FORMHASH."' , function(s){});}
				},1000);
			}
			</script>";
			return array($ajax);
		}
		return array();
	}
	
	
	function post_message($param) {
		global $_G;
		$exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];	
		$section = empty($exx_tagseo['bk']) ? array() : unserialize($exx_tagseo['bk']);
		if(!is_array($section)) $section = array();
		if(!(empty($section[0]) || in_array($_G['fid'],$section))){
			return;
		}
		$param = $param['param'];
		if(($param[0]=="post_newthread_succeed" || $param[0]=="post_newthread_mod_succeed") && $exx_tagseo['qz'] && $_GET['subject']){
			$pid = intval($param[2]['pid']);
			DB::query("update ".DB::table('forum_post')." set tags='' where pid=".$pid);
		}
	}
	
	
}

class plugin_exx_tagseo_group extends plugin_exx_tagseo_forum{
	
}