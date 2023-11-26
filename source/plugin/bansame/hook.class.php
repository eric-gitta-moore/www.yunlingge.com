<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_bansame{
	function common(){
	    loadcache('plugin');
		global $_G;
		$vars = $_G['cache']['plugin']['bansame'];
		$groups=unserialize($vars['groups']);
		$content=unserialize($vars['content']);
		$tips=trim($vars['tips']);
		if($_G['groupid']&&!in_array($_G['groupid'],$groups)){//不受影响的用户组
			if($_GET['action']=='newthread'&&submitcheck('topicsubmit')){
				$subject = daddslashes(trim($_POST['subject']));
				$message = daddslashes(trim($_POST['message']));
				$hash = md5($_POST['message']);
				if(in_array('1',$content)&&$subject){
					$tid=DB::result_first("SELECT tid FROM ".DB::table('forum_thread')." WHERE subject = '$subject' ORDER BY tid DESC");
					if($tid){
						showmessage($tips);
						exit;
					}
					
				}
				if(in_array('2',$content)&&$message){
					//$count=DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE md5(message) =md5('".$_POST['message']."') and first=1");
					$count=DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE md5(message) ='$hash' and first=1");
					if($count){
						showmessage($tips);
						exit;
					}
				}
	
			}elseif($_GET['action']=='reply'&&submitcheck('replysubmit')&&in_array('3',$content)){
				$hash = md5($_POST['message']);
				if($hash){
					$count=DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE md5(message) ='$hash' and first=0");
					if($count){
						showmessage($tips);
						exit;
					}
				}
			}
		}
		return '';
	}
}

?>