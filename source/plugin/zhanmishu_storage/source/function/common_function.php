<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc && plugin by zhanmishu.
 *      DzКазгwww.idzbox.com, use is subject to license terms
 *
 *      Author: zhanmishu.com $
 *    	qq:87883395 $
 */	

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


function zms_storage_getconfig(){
	global $_G;
	loadcache('plugin');
	$config = $_G['cache']['plugin']['zhanmishu_storage'];

	return $config;
}//Fro m www.ymg 6.com

?>