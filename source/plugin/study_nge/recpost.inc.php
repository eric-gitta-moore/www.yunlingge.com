<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
require_once libfile('class/func', 'plugin/study_nge/source');
require_once libfile('class/mysql', 'plugin/study_nge/source');
require_once libfile('class/get_data', 'plugin/study_nge/source');

$splugin_setting = $_G['cache']['plugin']['study_nge'];
$splugin_lang = lang('plugin/study_nge');
$recpost_admin_gids = (array)unserialize($splugin_setting['recpost_admin_gids']);

if(in_array($_G['groupid'],$recpost_admin_gids)){
	$tid = intval($_GET['tid']); 
  // 参数校验
  $thread = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid = '$tid' limit 1");
  if($thread) {
      $recpost_fids = (array)unserialize($splugin_setting['recpost_fids']);
      if( !(empty($recpost_fids[0]) && count($recpost_fids) < 2) ){
      	if(!in_array($thread['fid'],$recpost_fids)) {
          showmessage($splugin_lang['slang_002']);
      	}
      }
  }else {
      showmessage($splugin_lang['slang_003']);
  }
	
	if(!submitcheck('setrecpostsubmit')) {
		$s_recpost = DB::fetch_first("SELECT * FROM " . DB::table('study_nge_recpost') . " WHERE tid = '$tid' limit 1");
		$s_recpost = dhtmlspecialchars(dstripslashes($s_recpost));
		include template('study_nge:recpost');
	}else{

    $subject = $_POST['subject'] ? $_POST['subject'] : $thread[subject];
		$data = array(
			'tid' => $tid,
			'uid' => $thread[authorid],
			'username' => daddslashes(dstripslashes($thread[author])),
			'subject' => daddslashes(dstripslashes($subject)),
		);

		$recposttid = DB::result_first("SELECT tid FROM " . DB::table('study_nge_recpost') . " WHERE tid = '$tid'");
		if($recposttid) {
			if($_POST['recpost_radio']){
					if($_POST['recpost_top']){
							$data['dateline'] = $_G['timestamp'];
					}
					DB::update('study_nge_recpost', $data, "tid='$tid'");
					study_nge::updatecache('recpost');
					showmessage($splugin_lang['slang_004'], dreferer());
			}else{
					DB::delete('study_nge_recpost', "tid='$tid'");
					study_nge::updatecache('recpost');
					showmessage($splugin_lang['slang_005'], dreferer());
			}
		}else{
				$data['dateline'] = $_G['timestamp'];
				DB::insert('study_nge_recpost', $data);
				study_nge::updatecache('recpost');
				if($_POST['recpost_send']){
						notification_add($thread['authorid'], 'system', str_replace(array('{tid}','{subject}'),array($thread[tid],dhtmlspecialchars($thread[subject])),$splugin_lang['slang_001']), '', 1);
				}
				showmessage($splugin_lang['slang_006'], dreferer());
		}
		
	}
}else{
	showmessage($splugin_lang['slang_007']);
}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: recpost.inc.php 3073 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。