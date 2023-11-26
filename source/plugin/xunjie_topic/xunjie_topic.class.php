<?php
/**
 *	[根据浏览记录推荐主题(xunjie_topic.{modulename})] (C)2019-2099 Powered by 迅捷.
 *	Version: 1.0
 *	Date: 2019-11-11 19:22
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_xunjie_topic {
	//TODO - Insert your code here

}
class plugin_xunjie_topic_forum extends plugin_xunjie_topic {
	function viewthread_postsightmlafter() {
		global $_G;
		$threadlist = '';
 		if(!strpos($_G['cache']['plugin']['xunjie_topic']['plate'], '"'.$_G['fid'].'"')) {
			if(! isset($_COOKIE['xunjie_topic'])) {
				setcookie('xunjie_topic',$_G['tid']);
			}else{
				if($_COOKIE['xunjie_topic'] != $_G['tid']) {
					DB::insert('xunjietopic',array('fronttid' => $_COOKIE['xunjie_topic'],'aftertid' => $_G['tid'],'subject' => $_G['thread']['subject'],'browsedata' => time()),false,true,false);
					setcookie('xunjie_topic',$_G['tid']);
				}
			}
			$threads = DB::fetch_all("SELECT aftertid,subject FROM %t WHERE fronttid=%d ORDER BY browsedata DESC LIMIT %d",array('xunjietopic', $_G['tid'], $_G['cache']['plugin']['xunjie_topic']['numbers']));
			if(empty($threads)) {
				if($_G['cache']['plugin']['xunjie_topic']['type'] == 1) {
					$threadlist = lang('plugin/xunjie_topic', 'xunjie_topic_1');
				}else{
					switch($_G['cache']['plugin']['xunjie_topic']['type']) {
						case 3:
							$threads = DB::fetch_all("SELECT tid,subject FROM %t WHERE fid=%d AND displayorder=%d ORDER BY views DESC LIMIT %d", array('forum_thread', $_G['fid'], 0, $_G['cache']['plugin']['xunjie_topic']['numbers']));
							break;
						case 4:
							$threads = DB::fetch_all("SELECT tid,subject FROM %t WHERE fid=%d AND displayorder=%d ORDER BY replies DESC LIMIT %d", array('forum_thread', $_G['fid'], 0, $_G['cache']['plugin']['xunjie_topic']['numbers']));
							break;
						default:
							$threads = DB::fetch_all("SELECT tid,subject FROM %t WHERE fid=%d AND displayorder=%d ORDER BY dateline DESC LIMIT %d", array('forum_thread', $_G['fid'], 0, $_G['cache']['plugin']['xunjie_topic']['numbers']));
					}
					if(empty($threads)) {
						$threadlist = lang('plugin/xunjie_topic', 'xunjie_topic_1');
					}else{
						foreach($threads as $thread) {
							if($thread['tid'] != $_G['tid']) {
								$threadlist .= '<li><a href="forum.php?mod=viewthread&tid='.$thread['tid'].'" target="_blank" title="'.$thread['subject'].'">'.$thread['subject'].'</a></li>';
							}
						}
					}
				}
			}else{
				foreach($threads as $thread) {
					$threadlist .= '<li><a href="forum.php?mod=viewthread&tid='.$thread['aftertid'].'" target="_blank" title="'.$thread['subject'].'">'.$thread['subject'].'</a></li>';
				}
			}
			include template('xunjie_topic:xunjie_topic');
			return array(0 => $topic);			
		}else{
			return array();
		}
	}
}

?>