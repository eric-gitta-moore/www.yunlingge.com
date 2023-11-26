<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require './source/plugin/zhiwu55com_autoreply/function_common.php';
$zhiwu55com_open = $_G['cache']['plugin']['zhiwu55com_autoreply']['zhiwu55com_open'];
$zhiwu55com_num = $_G['cache']['plugin']['zhiwu55com_autoreply']['zhiwu55com_num'];
if($zhiwu55com_open==0 || $zhiwu55com_num==0)
{
	echo '// close or reply 0 num ';
	exit;
}	
$lastHour = time() - 3600;
$lastHour2 = time() - 60;
$num=rand(1,3);
if($num==2)
{
	$aid=DB::result_first("SELECT aid FROM %t WHERE commentnum=0 ORDER BY RAND() LIMIT 1",array('portal_article_count'));
	if(!is_numeric($aid))
	{
		echo '// aid empty';
		exit;
	}
	$portalRs=DB::fetch_first("SELECT title,dateline,catid FROM %t WHERE aid=%d",array('portal_article_title',$aid));
	$allowcomment=DB::result_first("SELECT allowcomment FROM %t WHERE catid=%d",array('portal_category',$portalRs['catid']));
	if($allowcomment==1 && !empty($portalRs) && $lastHour2>$portalRs['dateline'] && $zhiwu55com_open==1 && $zhiwu55com_num>0 && $zhiwu55com_num<=20)
	{

		$hzw_appid = zhiwu55com_autoreply_appid();
		$keyword = $portalRs['title'];
		$keyword = diconv($keyword,CHARSET,'UTF-8');
		$keyword = urlencode($keyword);
		$commentUrl = dfsockopen("http://discuz.csdn123.net/plugin/zhiwu55com_autoreply/v100/?k=".$keyword.'&hzw_appid='.$hzw_appid);
		if(empty($commentUrl) || strlen($commentUrl)<10)
		{
			echo '// result empty';
			exit;
		}
		$htmlcode = dfsockopen($commentUrl);
		if(empty($htmlcode) || strlen($htmlcode)<100)
		{
			echo '// result empty';
			exit;
		}
		$htmlcode = diconv($htmlcode,'UTF-8');
		$htmlcode = preg_replace('/\s+/','',$htmlcode);
		preg_match('/<ul.+?><li>(.+?)<\/li><\/ul>/',$htmlcode,$commentArr);
		$commentArrStr=$commentArr[1];
		$commentArr=explode('</li><li>',$commentArrStr);
		shuffle($commentArr);
		if (!defined('DISCUZ_VERSION')) {
			require './source/discuz_version.php';
		}
		foreach($commentArr as $k=>$post_text)
		{
			if($k>=$zhiwu55com_num)
			{
				break;
			}
			$post_text=preg_replace('/\[.+?\]/','',$post_text);
			$addtime=60/$zhiwu55com_num;
			$addtime=rand($addtime-3,$addtime);
			$lastpostTime = $lastHour2 + $addtime;
			$lastpostTime = $lastpostTime + ($k * $addtime);
			$userInfo = DB::fetch_first("SELECT uid,username FROM %t ORDER BY RAND() LIMIT 1",array('zhiwu55comautoreply_reguser'));
			if(empty($userInfo))
			{
				$userInfo=array('username'=>'admin','uid'=>1);
			}
			if (defined('DISCUZ_VERSION') && (DISCUZ_VERSION == 'X3' || DISCUZ_VERSION == 'X2.5')) {
				$setarr = array('uid' => $userInfo['uid'],
					'username' => $userInfo['username'],
					'id' => $aid,
					'idtype' => 'aid',
					'postip' => $_G['clientip'],
					'dateline' => $lastpostTime,
					'status' => 0,
					'message' => $post_text
					);
			} else {
				$setarr = array('uid' => $userInfo['uid'],
					'username' => $userInfo['username'],
					'id' => $aid,
					'idtype' => 'aid',
					'postip' => $_G['clientip'],
					'port' => $_G['remoteport'],
					'dateline' => $lastpostTime,
					'status' => 0,
					'message' => $post_text
					);
			}

			$pcid = C::t('portal_comment')->insert($setarr, true);
			C::t('portal_article_count')->increase($aid, array('commentnum' => 1));
			$autoArr = array();
			$autoArr['pid'] = $aid;
			$autoArr['tid'] = $aid;
			$autoArr['subject'] = $portalRs['title'];
			$autoArr['reply_message'] = $post_text;
			$autoArr['showurl'] = $_G['siteurl'] . 'portal.php?mod=view&aid=' . $aid . '#comment';
			DB::insert('zhiwu55comautoreply_auto',$autoArr);

		}
		echo '// ' . $autoArr['showurl'];

	} else {

		echo '// close or empty or disablecomment or less 60s';

	}

} else {

	$threadRs=DB::fetch_first("SELECT tid,fid,subject,lastpost FROM %t WHERE replies=0 AND %d<dateline AND %d>dateline ORDER BY RAND() LIMIT 1",array('forum_thread',$lastHour,$lastHour2));
	if(!empty($threadRs) && $zhiwu55com_open==1 && $zhiwu55com_num>0 && $zhiwu55com_num<=20)
	{
		$hzw_appid = zhiwu55com_autoreply_appid();
		$tid = $threadRs['tid'];
		$fid = $threadRs['fid'];
		$keyword = $threadRs['subject'];
		$keyword = diconv($keyword,CHARSET,'UTF-8');
		$keyword = urlencode($keyword);
		$commentUrl = dfsockopen("http://discuz.csdn123.net/plugin/zhiwu55com_autoreply/v100/?k=".$keyword.'&hzw_appid='.$hzw_appid);
		if(empty($commentUrl) || strlen($commentUrl)<10)
		{
			echo '// result empty';
			exit;
		}
		$htmlcode = dfsockopen($commentUrl);
		if(empty($htmlcode) || strlen($htmlcode)<100)
		{
			echo '// result empty';
			exit;
		}
		$htmlcode = diconv($htmlcode,'UTF-8');
		$htmlcode = preg_replace('/\s+/','',$htmlcode);
		preg_match('/<ul.+?><li>(.+?)<\/li><\/ul>/',$htmlcode,$commentArr);
		$commentArrStr=$commentArr[1];
		$commentArr=explode('</li><li>',$commentArrStr);
		shuffle($commentArr);
		$forumInfo = C::t('forum_forum')->fetch_info_by_fid($threadRs['fid']);
		require_once libfile('function/editor');
		require_once './source/function/function_forum.php';
		if (!defined('DISCUZ_VERSION')) {
			require './source/discuz_version.php';
		}
		foreach($commentArr as $k=>$post_text)
		{
			if($k>=$zhiwu55com_num)
			{
				break;
			}
			$post_text=preg_replace('/\[.+?\]/','',$post_text);
			$addtime=60/$zhiwu55com_num;
			$addtime=rand($addtime-3,$addtime);
			$lastpostTime = $threadRs['lastpost'] + $addtime;
			$lastpostTime = $lastpostTime + ($k * $addtime);
			if ($forumInfo['allowhtml'] != 1) {
				$post_text = html2bbcode($post_text);
			}
			$userInfo = DB::fetch_first("SELECT uid,username FROM %t ORDER BY RAND() LIMIT 1",array('zhiwu55comautoreply_reguser'));
			if(empty($userInfo))
			{
				$userInfo=array('username'=>'admin','uid'=>1);
			}
			if (defined('DISCUZ_VERSION') && (DISCUZ_VERSION == 'X3' || DISCUZ_VERSION == 'X2.5')) {
				$pid = insertpost(array('fid' => $fid, 'tid' => $tid, 'first' => '0', 'author' => $userInfo['username'], 'authorid' => $userInfo['uid'], 'subject' => '', 'dateline' => $lastpostTime, 'message' => '[Just a minute,It is loading]', 'useip' => getglobal('clientip'), 'invisible' => 0, 'anonymous' => 0, 'usesig' => 1, 'htmlon' => 0, 'bbcodeoff' => 0, 'smileyoff' => - 1, 'parseurloff' => 0, 'attachment' => '0', 'status' => 0));
			} else {
				$pid = insertpost(array('fid' => $fid, 'tid' => $tid, 'first' => '0', 'author' => $userInfo['username'], 'authorid' => $userInfo['uid'], 'subject' => '', 'dateline' => $lastpostTime, 'message' => '[Just a minute,It is loading]', 'useip' => getglobal('clientip'), 'port' => getglobal('remoteport'), 'invisible' => 0, 'anonymous' => 0, 'usesig' => 1, 'htmlon' => 0, 'bbcodeoff' => 0, 'smileyoff' => - 1, 'parseurloff' => 0, 'attachment' => '0', 'status' => 0));
			}
			$postData = array();
			$postData['message'] = $post_text;
			$postData['dateline'] = $lastpostTime;
			if ($forumInfo['allowhtml'] == 1) {
				$postData['htmlon'] = 1;
			}
			DB::update('forum_post', $postData, 'pid=' . $pid);
			updatemembercount($userInfo['uid'], array('extcredits2' => 1), true, '', 0, '');
			 if (is_numeric($userInfo['uid'])) {
				DB::query('UPDATE ' . DB::table('common_member_count') . ' set extcredits2=extcredits2+1,posts=posts+1 where uid=' . $userInfo['uid']);
			}
			C::t('forum_threadpartake')->insert(array('tid' => $tid, 'uid' => $userInfo['uid'], 'dateline' => $postData['dateline']));
			if(DISCUZ_VERSION != 'X2.5')
			{
				C::t('common_member_status')->update($userInfo['uid'], array('lastip' => $_G['clientip'], 'port' => $_G['remoteport'], 'lastvisit' => TIMESTAMP, 'lastactivity' => TIMESTAMP));
			}
			$lastpostArr = array();
			$lastpostArr['lastpost'] = time();
			$lastpostArr['lastposter'] = $userInfo['username'];
			$replies = C::t('forum_post')->count_visiblepost_by_tid($tid);
			$replies = intval($replies) - 1;
			$page = intval($replies/10);
			$page++;
			$lastpostArr['replies'] = $replies;
			$lastpostArr['maxposition'] = $replies + 1;
			DB::update('forum_thread', $lastpostArr, 'tid=' . $tid);
			$autoArr = array();
			$autoArr['pid'] = $pid;
			$autoArr['tid'] = $tid;
			$autoArr['subject'] = $threadRs['subject'];
			$autoArr['reply_message'] = $post_text;
			$autoArr['showurl'] = $_G['siteurl'] . 'forum.php?mod=viewthread&tid=' . $tid . '&page=' . $page . '#pid' . $pid;
			DB::insert('zhiwu55comautoreply_auto',$autoArr);

		}
		echo '// ' . $autoArr['showurl'];

	} else {

		echo '// close or empty or less 60s';

	}

}