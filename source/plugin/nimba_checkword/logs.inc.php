<?php
/*
 * 应用中心主页：https://addon.dismall.com/?@1552.developer
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ281688302/594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(!submitcheck('delsubmit')){
	$typelist=array(
		1=>lang('plugin/nimba_checkword','type_1'),
		2=>lang('plugin/nimba_checkword','type_2'),
		3=>lang('plugin/nimba_checkword','type_3'),
		4=>lang('plugin/nimba_checkword','type_4'),
	);
	$page=max(1,intval($_GET['page']));
	$pagenum=20;
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=nimba_checkword&pmod=logs');
    showtableheader(lang('plugin/nimba_checkword','m_title'));
    showsubtitle(array('', 'ID',lang('plugin/nimba_checkword','m_type'),lang('plugin/nimba_checkword','m_user'),lang('plugin/nimba_checkword','m_date'),lang('plugin/nimba_checkword','m_ban')));
	$count=DB::result_first("select count(*) from ".DB::table('nimba_checkword_logs')." where 1 ");
    $query = DB::query("SELECT * FROM ".DB::table('nimba_checkword_logs')." ORDER BY id desc limit ".($page-1)*$pagenum.",$pagenum");
	$tuiids=array();
    while ($item = DB::fetch($query)) {			
        showtablerow('', array('class="td25"', 'class="td28"', '', '', ''), array(
			'<input type="checkbox" class="checkbox" name="delete[]" value="' . $item['id'] . '" />',
			$item['id'],
			$typelist[$item['type']],
			'<a href="home.php?mod=space&uid='.$item['uid'].'" target="_blank">'.$item['username'].'</a>',
			dgmdate($item['dateline'],'Y-m-d H:i:s'),
			'<a href="'.ADMINSCRIPT.'?action=members&operation=ban&uid='.$item['uid'].'&submit=yes">'.lang('plugin/nimba_checkword','m_ban').'</a>',
		));
    }
    showsubmit('delsubmit', 'submit', 'del');
    showtablefooter();
    showformfooter();
	echo multi($count,$pagenum,$page,ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=nimba_checkword&pmod=logs");
}else{
    $postdata = daddslashes(dstripslashes($_GET));
    if($postdata['delete']) {
        DB::delete('nimba_checkword_logs', "id IN (" . dimplode($postdata['delete']) . ")");
    }
	cpmsg(lang('plugin/nimba_checkword','del_succeed'),'action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_checkword&pmod=logs', 'succeed');	
}


?>