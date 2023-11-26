<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if($_GET['formhash'] != FORMHASH) {
	showmessage('undefined_action');
}
if(!$_G['uid']) {
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}
if(!$_GET['type']) {
	showmessage('undefined_action');
}
if(strpos($_G['cache']['plugin']['xunjie_attention']['usergroup'], '"'.$_G['groupid'].'"')) {
	showmessage('undefined_action');
}
$result = '';
switch($_GET['type']) {
	case '1':
			if(!$_GET['authorid'] or !$_GET['author']) {
				showmessage('undefined_action');
			}else{
				$usercount = DB::fetch_first("SELECT COUNT(buid) FROM %t WHERE uid=%d", array('xunjieattention', $_G['uid']), FALSE);
				if($usercount['COUNT(buid)'] < $_G['cache']['plugin']['xunjie_attention']['top']) {
					DB::insert('xunjieattention', array('uid' => $_G['uid'], 'buid' => $_GET['authorid'], 'username' => rawurldecode($_GET['author'])), FALSE, TRUE, FALSE);
					$result = '<script reload="1">xunjie_attention_follow(1, \'plugin.php?id=xunjie_attention:attention&type=2&authorid='.$_GET['authorid'].'&author='.rawurlencode($_GET['author']).'&formhash='.FORMHASH.'\');</script>';
				}else{
					$result = '<script reload="1">showDialog(\''.lang('plugin/xunjie_attention', 'xunjie_attention_1').'\');document.getElementById(\'follow_a\').innerHTML = \''.lang('plugin/xunjie_attention', 'xunjie_attention_2').'\';</script>';
				}
			}
			break;
	case '2':
			if(!$_GET['authorid']) {
				showmessage('undefined_action');
			}else{
				DB::delete('xunjieattention', implode(' AND ', array('uid='.$_G['uid'], 'buid='.$_GET['authorid'])), 1, TRUE);
				if($_GET['islist']) {
					$result = lang('plugin/xunjie_attention', 'xunjie_attention_3');
				}else{
					$result = '<script reload="1">xunjie_attention_follow(2, \'plugin.php?id=xunjie_attention:attention&type=1&authorid='.$_GET['authorid'].'&author='.rawurlencode($_GET['author']).'&formhash='.FORMHASH.'\');</script>';
				}	
			}
			break;
	case '3':
			$usernamelist = '';
			$userlist = DB::fetch_all("SELECT buid,username FROM %t WHERE uid=%d", array('xunjieattention', $_G['uid']), FALSE);
			if(!empty($userlist)) {
				foreach($userlist as $buid) {
					$usernamelist .= '<li>'.$buid['username'].'<a id="xunjie_attention_'.$buid['buid'].'" href="plugin.php?id=xunjie_attention:attention&type=2&islist=1&authorid='.$buid['buid'].'&formhash='.FORMHASH.'" onclick="xunjie_attention_userlist(this, \'xunjie_attention_'.$buid['buid'].'\'); return false;">'.lang('plugin/xunjie_attention', 'xunjie_attention_5').'</a></li>';
				}	
			}else{
				$usernamelist = '<li>'.lang('plugin/xunjie_attention', 'xunjie_attention_4').'</li>';
			}
			$result = '<ul style="margin:3px;">'.$usernamelist.'</ul>';
			break;
	case '4':
			$buidlist = array();
			$threadlist = '';
			$userlist = DB::fetch_all("SELECT buid FROM %t WHERE uid=%d", array('xunjieattention', $_G['uid']), FALSE);
			$visit = DB::fetch_first("SELECT visit FROM %t WHERE uid=%d", array('xunjieattentionv', $_G['uid']), FALSE);
			foreach($userlist as $buid) {
				array_push($buidlist, $buid['buid']);
			}
			$threads = DB::fetch_all("SELECT subject,tid,author,dateline FROM %t WHERE authorid IN(%n) AND dateline>%d AND displayorder=%d ORDER BY dateline ASC LIMIT %d", array('forum_thread', $buidlist, $visit['visit'], 0, 15));//主题列表
			if(!empty($threads)) {
				$thread = end($threads);
				DB::insert('xunjieattentionv', array('uid' => $_G['uid'], 'visit' => $thread['dateline']), FALSE, TRUE, FALSE);
				$str = substr(currentlang(), 3);
				if($str == 'GBK') {
					$subjectlen = 20;
					$authorlen = 10;
				}else{
					$subjectlen = 30;
					$authorlen = 15;
				}
				foreach($threads as $thread) {
					if(strlen($thread['subject']) > $subjectlen) {
						$subject = mb_substr($thread['subject'], 0, 10, $str).'...';
					}else{
						$subject = $thread['subject'];
					}
					if(strlen($thread['author']) > $authorlen) {
						$author = mb_substr($thread['author'], 0, 5, $str).'...';
					}else{
						$author = $thread['author'];
					}
					$threadlist .= '<li><a href="forum.php?mod=viewthread&tid='.$thread['tid'].'" title="'.$thread['subject'].'" target="_blank">'.$subject.'<cite style="color:#696969;padding-left:30px;float:right;width:70px;">'.$author.'</cite></a></li>';
				}
			}
			if(!empty($threadlist)) {
				$ignore = '<img src="source/plugin/xunjie_attention/image/d7h.png" alt="ignore" title="'.lang('plugin/xunjie_attention', 'xunjie_attention_9').'" width="12" height="12" style="position:absolute;margin-top:5px;margin-right:5px;right:0;top:0;" onclick="ajaxget(\'plugin.php?id=xunjie_attention:attention&type=6&formhash='.FORMHASH.'\', \'xunjie_attention_show\');return false;">';
				if(count($threads) < 15) {
					$result = '<ul class="p_pop">'.$threadlist.$ignore.'</ul>';
				}else{
					$result = '<ul class="p_pop">'.$threadlist.'<li><a href="plugin.php?id=xunjie_attention:attention&type=4&formhash='.FORMHASH.'" style="background-image:url(source/plugin/xunjie_attention/image/bgu.png);background-repeat:no-repeat;background-position:center;height:6px" onclick="ajaxget(this.href, \'xunjie_attention_show\');return false;"></a></li>'.$ignore.'</ul>';
				}
			}else{
				$result = '<ul class="p_pop"><li>'.lang('plugin/xunjie_attention', 'xunjie_attention_6').'</li></ul>';
			}
			break;
	case '5':
			$buidlist = array();
			$visit = DB::fetch_first("SELECT visit FROM %t WHERE uid=%d", array('xunjieattentionv', $_G['uid']), FALSE);
			$userlist = DB::fetch_all("SELECT buid FROM %t WHERE uid=%d", array('xunjieattention', $_G['uid']), FALSE);
			foreach($userlist as $buid) {
				array_push($buidlist, $buid['buid']);
			}
			if(empty($visit)) {
				DB::insert('xunjieattentionv', array('uid' => $_G['uid'], 'visit' => $_G['timestamp']), FALSE, TRUE, FALSE);
				$result = '<span class="pipe">|</span>'.'<a href="javascript:;" id="xunjie_attention" class="showmenu" onmouseover="xunjie_attention_mOver(this, \'xunjie_attention_userlist\', \'plugin.php?id=xunjie_attention:attention&type=3&formhash='.FORMHASH.'\');" onmouseleave="xunjie_attention_mleave(\'xunjie_attention_userlist\');">'.lang('plugin/xunjie_attention', 'xunjie_attention_7').'</a>';
			}
			$threads = DB::fetch_all("SELECT COUNT(tid) FROM %t WHERE authorid IN(%n) AND dateline>%d AND displayorder=%d", array('forum_thread', $buidlist, $visit['visit'], 0));//主题列表
			if($threads[0]['COUNT(tid)'] == 0){
				$result = '<span class="pipe">|</span>'.'<a href="javascript:;" id="xunjie_attention" class="showmenu" onmouseover="xunjie_attention_mOver(this, \'xunjie_attention_userlist\', \'plugin.php?id=xunjie_attention:attention&type=3&formhash='.FORMHASH.'\');" onmouseleave="xunjie_attention_mleave(\'xunjie_attention_userlist\');">'.lang('plugin/xunjie_attention', 'xunjie_attention_7').'</a>';
			}else{
				$result = '<span class="pipe">|</span>'.'<a href="javascript:;" id="xunjie_attention" class="a showmenu new" style="margin-left:3px;background-image:url(source/plugin/xunjie_attention/image/notice.gif);" onmouseover="xunjie_attention_mOver(this, \'xunjie_attention_show\', \'plugin.php?id=xunjie_attention:attention&type=4&formhash='.FORMHASH.'\');" onmouseleave="xunjie_attention_mleave(\'xunjie_attention_show\');">'.lang('plugin/xunjie_attention', 'xunjie_attention_8').'('.$threads[0]['COUNT(tid)'].')</a>';
			}
			break;
	case '6':
			DB::insert('xunjieattentionv', array('uid' => $_G['uid'], 'visit' => $_G['timestamp']), FALSE, TRUE, FALSE);
			$result = '<ul class="p_pop"><li>'.lang('plugin/xunjie_attention', 'xunjie_attention_6').'</li></ul>';
			break;
	default:
			showmessage('undefined_action');
}
if(!empty($result)) {
	include template('common/header_ajax');
	echo $result;
	include template('common/footer_ajax');
	exit;
}
?>