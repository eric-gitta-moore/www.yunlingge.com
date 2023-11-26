<?php
if (! defined ('IN_DISCUZ')) {
	exit ('Access Denied');
}
global $_G;
$exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];	
$tid=intval($_GET['tid']);

if($_GET['formhash']!=FORMHASH)return;
include_once DISCUZ_ROOT.'./source/plugin/exx_tagseo/fun.inc.php';
//echo 1;
$group = empty($exx_tagseo['yhz']) ? array() : unserialize($exx_tagseo['yhz']);
if(!(empty($group[0]) || !in_array($_G['groupid'],$group))){
	return;
}
//echo 2;exit();
$postdata=DB::fetch_first("select * from ".DB::table('forum_post')." where tid=".$tid);

if($postdata && empty($postdata['tags']) || 1){
    echo 'OK';//exit();
	require_once libfile('function/post');
	$message=strip_tags($thread['message']);
	$msg=messagecutstr($message, 500);
	$r = getmode($tid,$postdata['pid'],$postdata['subject'],$msg);
	print_r($r);
}