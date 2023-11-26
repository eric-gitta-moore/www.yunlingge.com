<?php

/**
 *      [Discuz!] (C)2001-2099 Dz&#x76d2;&#x5b50;
 *      Dz盒子www.idzbox.com, use is subject to license terms
 *
 *      $Id: misc_swfupload.php 35377 2015-07-07 05:20:23Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

C::import('yunling_storage','plugin/yunling_storage/source/class');
include_once DISCUZ_ROOT.'source/plugin/yunling_storage/source/Autoloader.php';

$zms_storage = new yunling_storage();

$oss_config = $zms_storage->config;
$upload_path = $oss_config['upload_path'];
//strpos($upload_path,'/',-1);
$upload_path = substr($upload_path,-1,1) == '/'?$upload_path:($upload_path.'/');

$_G['uid'] = intval($_POST['uid']);

if((empty($_G['uid']) && $_GET['operation'] != 'upload') || $_POST['hash'] != md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid'])) {
	exit();
} else {
	if($_G['uid']) {
		$_G['member'] = getuserbyuid($_G['uid']);
	}
	$_G['groupid'] = $_G['member']['groupid'];
	loadcache('usergroup_'.$_G['member']['groupid']);
	$_G['group'] = $_G['cache']['usergroup_'.$_G['member']['groupid']];
}

$_GET['current'] = $_GET['current'] ? $_GET['current'] : 'forum';

if($_GET['operation'] == 'upload' && $_GET['current'] == 'forum') {

	$forumattachextensions = '';
	$fid = intval($_GET['fid']);
	if($fid) {
		$forum = $fid != $_G['fid'] ? C::t('forum_forum')->fetch_info_by_fid($fid) : $_G['forum'];
		if($forum['status'] == 3 && $forum['level']) {
			$levelinfo = C::t('forum_grouplevel')->fetch($forum['level']);
			if($postpolicy = $levelinfo['postpolicy']) {
				$postpolicy = dunserialize($postpolicy);
				$forumattachextensions = $postpolicy['attachextensions'];
			}
		} else {
			$forumattachextensions = $forum['attachextensions'];
		}
		if($forumattachextensions) {
			$_G['group']['attachextensions'] = $forumattachextensions;
		}
	}

	if ($_GET['type'] == 'image') {
//	    var_dump($_GET['key']);
//	    exit();
		$rs = $zms_storage->set_remote_file_acl($_GET['key']);
		$url = $oss_config['cdn_url'].'/'.$_GET['key'].'?x-oss-process=image/info';
		//get image info
		$imageInfo =yunling_storage::Curl($url,true);
		$imageWidth = $imageInfo['ImageWidth']['value'];
	}
	
	$aid = getattachnewaid($_G['uid']);

	$insert = array(
		'aid' => $aid,
		'dateline' => $_G['timestamp'],
		'filename' => dhtmlspecialchars(censor(diconv($_GET['filename'],'UTF-8',CHARSET))),
		'filesize' => intval($_GET['filesize']),
		'attachment' => str_replace($upload_path.'forum/', '', $_GET['key']),
		'isimage' => $_GET['type'] == 'image' ?  '1' : '0',
		'uid' => $_G['uid'],
		'thumb' => '0',
		'remote' => '1',
		'width' => $imageWidth ? $imageWidth + 0 : 300,
	);

	C::t('forum_attachment_unused')->insert($insert);
	if($_GET['isimage'] && $_G['setting']['showexif']) {
		C::t('forum_attachment_exif')->insert($aid, daddcslashes($_GET['filetype']));
	}

	echo $aid;
			
	exit;


}else if($_GET['operation'] == 'upload' && $_GET['current'] == 'home') {

	if ($_GET['type'] == 'image') {
		loadcache('plugin');
		$oss_config = $_G['cache']['plugin']['yunling_storage'];

		include_once DISCUZ_ROOT.'source/plugin/yunling_storage/source/Autoloader.php';
		$OssClient  = new OssClient($oss_config['OSSAccessKeyId'],$oss_config['AccessKeySecret'],substr($oss_config['host'], strpos($oss_config['host'],'.')+1));


		$OssClient->putObjectAcl($oss_config['bucketname'], $_GET['key'], 'public-read');
		
		$url = $oss_config['cdn_url'].'/'.$_GET['key'].'?x-oss-process=image/info';
		//get image info
		$imageInfo =yunling_storage::Curl($url,true);
		$imageWidth = $imageInfo['ImageWidth']['value'];
		
	}
	
	$aid = getattachnewaid($_G['uid']);

	$insert = array(
		'aid' => $aid,
		'dateline' => $_G['timestamp'],
		'filename' => dhtmlspecialchars(censor(diconv($_GET['filename'],'UTF-8',CHARSET))),
		'filesize' => intval($_GET['filesize']),
		'attachment' => str_replace('home/', '', $_GET['key']),
		'isimage' => $_GET['type'] == 'image' ?  '1' : '0',
		'uid' => $_G['uid'],
		'thumb' => '0',
		'remote' => '1',
		'width' => $imageWidth ? $imageWidth + 0 : 300,
	);

	C::t('forum_attachment_unused')->insert($insert);
	if($_GET['isimage'] && $_G['setting']['showexif']) {
		C::t('forum_attachment_exif')->insert($aid, daddcslashes($_GET['filetype']));
	}

	echo $aid;
			
	exit;


}

?>