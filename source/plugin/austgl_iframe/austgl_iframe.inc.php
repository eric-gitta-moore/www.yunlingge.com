<?php
/**
 * 	[网站外链iframe打开（austgl_iframe）] (C)2014-2099 Powered by austgl.com|iganlei.cn 阿甘工作室.
 * 	Version: v0.1
 * 	Date: 2014-02-11 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $_G;
if(count($_GET)>2){
	include template('austgl_iframe:error');
	exit;
}
$url= empty($_GET['url']) ? "http://www.austgl.com" : $_GET['url'];
$url = urldecode($url);
$config = $_G['cache']['plugin']['austgl_iframe'];
if(preg_match_all('/[\<\>\'\"\?\=\&\*\%\#]/',$url,$arr)){
	include template('austgl_iframe:error');
}else{
	//$url = str_check($url);
	include template('austgl_iframe:iframe');
}
// function str_check($str) { 
	// if (!get_magic_quotes_gpc()) { // 判断magic_quotes_gpc是否打开 
		// $str = addslashes($str); // 进行过滤 
	// }
	// return $str; 
// }
?>