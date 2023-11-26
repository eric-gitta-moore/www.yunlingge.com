<?php
/**
 *	[历史上的今天最热帖(both_today_history.cron_both_today_history)] (C)2019-2099 Powered by 博士设计.
 *	Version: v1.0.0
 *	Date: 2019-11-22 11:26
 *	Warning: Don't delete this comment
 *
 *	cronname:定时获取历史上今天的最热帖
 *	week:-1
 *	day:-1
 *	hour:1
 *	minute:0
 *	desc:定时获取历史上今天的最热帖
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $_G;
loadcache('plugin');
$vars = $_G['cache']['plugin']['both_today_history'];
$inforums=unserialize($vars['inforums']);
$ingroups=unserialize($vars['ingroups']);

//清空表
DB::query("delete from ".DB::table('both_today_history'));
//查询历史上的今天最热帖

$sql="SELECT t1.tid,t1.authorid,t1.author,t1.`subject`,t1.fid,".
	"t3.`name`,t1.dateline,t1.heats,t1.views ".
"FROM ".
	DB::table('forum_thread')." t1 LEFT JOIN ".DB::table('forum_post')." t2 ON t1.tid=t2.tid LEFT JOIN ".
	DB::table('forum_forum')." t3 ON t1.fid=t3.fid LEFT JOIN ".DB::table('common_member')." t4 ON t1.authorid=t4.uid ".
"WHERE ".
"t2.`first`=1 AND t2.invisible=0 ".
"AND t1.typeid=0 ".
"AND from_unixtime(t1.dateline,'%m-%d')=date_format(now(), '%m-%d') ".
"AND from_unixtime(t1.dateline,'%Y')<>date_format(now(), '%Y') ";
if($inforums){
	$inforumIds=implode(',', $inforums);
	$sql."AND t1.fid IN ($inforumIds) ";
}
if($ingroups){
	$ingroupIds=implode(',', $ingroups);
	$sql."AND t4.groupid IN($ingroupIds) ";
}

$sql.'ORDER BY t1.heats DESC,t1.views DESC';
$result=DB::fetch_first($sql);

if($result){
	$record = array('tid'=>$result['tid'],'authorid'=>$result['authorid'],
				 'author'=>$result['author'],'subject'=>$result['subject'],
				 'fid'=>$result['fid'],'name'=>$result['name'],
				 'dateline'=>$result['dateline'],'heats'=>$result['heats'],
				 'views'=>$result['views']);
	DB::insert('both_today_history',$record);
}
?>
