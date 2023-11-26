<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$long = $_G['cache']['plugin']['ecode']['codewidth'] ? $_G['cache']['plugin']['ecode']['codewidth'] : 1000;
if($_G['cache']['plugin']['ecode']['font']){
	foreach(explode("\n", trim($_G['cache']['plugin']['ecode']['font'])) as $item){
		list($index, $choice) = explode('=', $item);
		$font[$index] = $choice;
	}
	
	if($_G['cache']['plugin']['ecode']['banquan']){
	$banquan=$_G['cache']['plugin']['ecode']['banquan'];
	}else{
	$banquan = '请将易语言代码复制粘帖到下方编辑框内';
	}
}else{
	$font = array(
	0=>'随机颜色',
	1=>'默认配色',
	2=>'传统绿色',
	3=>'传统蓝色',
	4=>'古色古香',
	5=>'显明配色',
	6=>'淡兰黑字',
	7=>'灰色风格',
	8=>'粉红风格',
	9=>'绿色风格',
	10=>'蓝色风格');

		if($_G['cache']['plugin']['ecode']['banquan']){
	$banquan=$_G['cache']['plugin']['ecode']['banquan'];
	}else{
	$banquan = '请将易语言代码复制粘帖到下方编辑框内';
	}
}
$tmp = array_keys($font);
$current = $tmp[0];
$max = max($tmp);
$currentleft = ($max-5)*110;
$autopost = $_G['cache']['plugin']['ecode']['autopost'] ? 1 : 0;
$codemod = $_G['cache']['plugin']['ecode']['codemod'] == '' ? 'ecode' : $_G['cache']['plugin']['ecode']['codemod'];
$fast = $_GET['fast'] ? intval($_GET['fast']) : 0;
include template('ecode:index');

?>