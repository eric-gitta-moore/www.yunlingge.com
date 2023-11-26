<?php

/**		Author: 怪话丨START [专注Discuz论坛插件开发]
 * 
 * 		Plugin name: are_weather [每日天气]
 * 
 * 		mailbox: 16647424@qq.com
 * 
 * 		Author website: www.gh87661.com
 * 
 *      [DisMall!] (C) 87661 All rights reserved $Id$
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_are_weather {//普通版脚本中的类名以 plugin_ 开头
	
    /*public static function global_cpnav_top() {
    	global $_G;
    	if (in_array('global_cpnav_top', unserialize($_G['cache']['plugin']['are_weather']['hook'])))
        include template('are_weather:hook_top');
        $hkhtm.= self::loadjs();
        return $hkhtm;
    }
	
    public static function global_cpnav_extra1() {
    	global $_G;
    	if (in_array('global_cpnav_extra1', unserialize($_G['cache']['plugin']['are_weather']['hook'])))
        include template('are_weather:hook_ext');
        $hkhtm.= self::loadjs();
        return $hkhtm;
    }*/

    public static function global_header() {
    	global $_G;
    	if (in_array('global_header', unserialize($_G['cache']['plugin']['are_weather']['hook'])))
        include template('are_weather:hook_header');
        $hkhtm.= self::loadjs();
        return $hkhtm;
    }

    /*public static function global_footer() {
    	global $_G;
    	if (in_array('global_footer', unserialize($_G['cache']['plugin']['are_weather']['hook'])))
        include template('are_weather:hook_footer');
        $hkhtm.= self::loadjs();
        return $hkhtm;
    }*/
	
	public static $_G, $PLSTATIC;

	public static function loadjs() {
		global $_G;
		
		$PLSTATIC = self::$PLSTATIC;
		$js = "
		
	<link  href='/source/plugin/are_weather/statics/dialog417/skins/default.css?4.1.7' type='text/css' rel='stylesheet'>
	<script src='/source/plugin/are_weather/statics/dialog417/dialog.js?skin=default' type='text/javascript'></script>
	<script src='/source/plugin/are_weather/statics/dialog417/plugins/iframeTools.js' type='text/javascript'></script>
";
		return $js;
	}

	
}



?>