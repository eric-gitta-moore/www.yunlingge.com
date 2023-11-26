<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_exx_mzsm_forum{
	
	function viewthread_postsightmlafter_output()
	{
		//echo 3;
		//echo base64_encode($this->std_output());
		global $_G;
		$exx_mzsm=$_G['cache']['plugin']['exx_mzsm'];

		$section = empty($exx_mzsm['mod']) ? array() : unserialize($exx_mzsm['mod']);
		if(!is_array($section)) $section = array();
		if(!($section[0]=='all')){
			if(!(in_array(CURSCRIPT,$section))){
				return;
			}
		}	
		
		if(CURSCRIPT=='forum'){
			$se = empty($exx_mzsm['bk']) ? array() : unserialize($exx_mzsm['bk']);
			if(!is_array($se)) $se = array();
			if(!(empty($se[0]) || in_array($_G['fid'],$se))){
				return;
			}
		}
		
		$title=dhtmlspecialchars($exx_mzsm['title']);
		$txt=editor_safe_replace($exx_mzsm['txt']);
		$ys=dhtmlspecialchars($exx_mzsm['ys']);
		$ysa=dhtmlspecialchars($exx_mzsm['wz']);
		$bg=dhtmlspecialchars($exx_mzsm['bg']);
		include template('exx_mzsm:index');
		return [$return];
		
	}
	
	function std_output($i){
		//opcache_reset();
		//opcache_invalidate(__FILE__);
		
		global $_G;
		$exx_mzsm=$_G['cache']['plugin']['exx_mzsm'];

		$section = empty($exx_mzsm['mod']) ? array() : unserialize($exx_mzsm['mod']);
		if(!is_array($section)) $section = array();
		if(!($section[0]=='all')){
			if(!(in_array(CURSCRIPT,$section))){
				return;
			}
		}	
		
		if(CURSCRIPT=='forum'){
			$se = empty($exx_mzsm['bk']) ? array() : unserialize($exx_mzsm['bk']);
			if(!is_array($se)) $se = array();
			if(!(empty($se[0]) || in_array($_G['fid'],$se))){
				return;
			}
		}
		
		$title=dhtmlspecialchars($exx_mzsm['title']);
		$txt=editor_safe_replace($exx_mzsm['txt']);
		$ys=dhtmlspecialchars($exx_mzsm['ys']);
		$ysa=dhtmlspecialchars($exx_mzsm['wz']);
		$bg=dhtmlspecialchars($exx_mzsm['bg']);
		include template('exx_mzsm:index');
		if($_G['forum_firstpid'])$temp[0]=$return;
		if($i==1){
			return $return;
		}else{
			return $temp;
		};
		
	}
		
}
class plugin_exx_mzsm_portal extends plugin_exx_mzsm_forum{
	function view_article_content(){
		return $this->std_output(1);
	}
}


class plugin_exx_mzsm_group extends plugin_exx_mzsm_portal{
	function viewthread_postbottom(){
		return $this->std_output();
	}
}


function editor_safe_replace($content){
    $tags = array(
        "'<iframe[^>]*?>.*?</iframe>'is",
        "'<frame[^>]*?>.*?</frame>'is",
        "'<script[^>]*?>.*?</script>'is",
        "'<head[^>]*?>.*?</head>'is",
        "'<title[^>]*?>.*?</title>'is",
        "'<meta[^>]*?>'is",
        "'<link[^>]*?>'is",
    );
    return preg_replace($tags, "", $content);
}
