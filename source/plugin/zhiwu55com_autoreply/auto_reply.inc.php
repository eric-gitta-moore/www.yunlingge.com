<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if (!isset($_G['cache']['plugin'])) {
	loadcache('plugin');
}
$server_url = 'action=plugins&operation=config&do=' . $pluginid . '&identifier=zhiwu55com_autoreply&pmod=auto_reply';
if ($_GET['formhash'] == FORMHASH && $_GET['clears_all']=='yes')
{
	
	DB::delete('zhiwu55comautoreply_auto', 'id>0');
	cpmsg('zhiwu55com_autoreply:succeed_clear_autoreply', '' , 'succeed');
	
} else {
	
	$zhiwu55com_open = $_G['cache']['plugin']['zhiwu55com_autoreply']['zhiwu55com_open'];
	$cronUrl = $_G['siteurl'] . 'plugin.php?id=zhiwu55com_autoreply:hzw_cron';
	$threadCount = DB::result_first('SELECT count(*) FROM %t',array('zhiwu55comautoreply_auto'));
	if($threadCount>0)
	{
		if (empty($_GET['page']) || is_numeric($_GET['page']) === false) {
			$page = 1;
		} else {
			$page = intval($_GET['page']);
			$page = max(1, $page);
		}
		$TotalNumber = lang('plugin/zhiwu55com_autoreply', 'total_number');
		$TotalPageNumber = $threadCount/20;
		$TotalPageNumber = @ceil($TotalPageNumber);
		$TotalNumber = str_replace('x',$TotalPageNumber,$TotalNumber);
		$TotalNumber = str_replace('y',$threadCount,$TotalNumber);
		$TotalNumber = str_replace('z',$page,$TotalNumber);
		$page = min($TotalPageNumber,$page);
		$startNum = ($page - 1) * 20;
		$homePage = $server_url . '&page=1';
		$nextPage = $server_url . '&page=' . ($page + 1);
		$prePage = $server_url . '&page=' . ($page - 1);
		$endPage = $server_url . '&page=' . $TotalPageNumber;
		$thread_list = DB::fetch_all('SELECT * FROM ' . DB::table('zhiwu55comautoreply_auto') . ' ORDER BY id DESC LIMIT ' . $startNum . ',20');
		$start = $page - 4;
		$start = min($TotalPageNumber - 8,$start);
		$start = max($start,1);
		$end = $start + 8;
		$end = min($end,$TotalPageNumber);
		$showPage="";
		for($i=$start;$i<=$end;$i++)
		{
			if($i==$page)
			{
				$showPage=$showPage . '<strong>' . $i . '</strong>';
			} else {
				$showPage=$showPage . '<a href="?' . $server_url . '&page=' . $i . '&formhash=' . FORMHASH . '">' . $i . '</a>';
			}
		}
	}
	include template('zhiwu55com_autoreply:auto_reply');

}