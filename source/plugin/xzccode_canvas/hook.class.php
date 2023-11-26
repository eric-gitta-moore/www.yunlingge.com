<?php
/**
 *	[窝窝链接变视频(xzccode_canvas.{modulename})] (C)2019-2099 Powered by 窝窝开发者.
 *	Version: 1.0
 *	Date: 2019-10-13 10:35
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_xzccode_canvas {
	function global_header(){
		global $_G;
		if($_G['cache']['plugin']['xzccode_canvas']['is_open'] == 0){
			return '';
		}
		/*
		
			<script src=\"source/plugin/xzccode_canvas/static/js/jquery.min.js\"></script>
			*/
		$script = "
			<script>
				//jQuery.noConflict();
				body = jQuery('body').prepend('<canvas style=\"position: fixed;z-index: -1;overflow: hidden;\"></canvas>');
			</script>
			<script src=\"/source/plugin/xzccode_canvas/static/js/script.js\"></script>
		";
		return $script;
	}
}

?>