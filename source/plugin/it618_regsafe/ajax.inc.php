<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

global $_G,$it618_regsafe;

$it618_regsafe = $_G['cache']['plugin']['it618_regsafe'];

if($_GET['formhash']!=FORMHASH)exit;

if($_GET['ac']=="sendsmscode"){
	$sendsmscode=md5(FORMHASH.time().mt_rand(1,100000));
	dsetcookie('sendsmscode',$sendsmscode,31536000);
	echo 'it618_split'.$sendsmscode;
}

if($_GET['ac']=="gettip"){
	if(strtolower($_GET['it618_regsafe_check_answer'])==getcookie('validatecode')){
		echo '<img src="source/plugin/it618_regsafe/images/check_right.gif" style="margin-right:5px" align="absmiddle"/>';
	}else{
		echo '<img src="source/plugin/it618_regsafe/images/check_error.gif" style="margin-right:5px" align="absmiddle"/>';
	}
}

?>