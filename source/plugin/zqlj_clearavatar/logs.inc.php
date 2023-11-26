<?php
/*
 * 主页：http://addon.dismall.com/?@72763.developer
 * 苏州众器良匠网络科技有限公司 出品
 * 插件定制 联系QQ281688302
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('plugin');
$pagenum=10;
$page=max(1,intval($_GET['page']));
$count=DB::result_first("select count(*) from ".DB::table('zqlj_clearavatar_logs')." where 1");
$items = DB::fetch_all("select * from ".DB::table('zqlj_clearavatar_logs')." where 1 order by logid desc ".DB::limit(($page-1)*$pagenum,$pagenum));
showtableheader(lang('plugin/zqlj_clearavatar','log_title'), 'nobottom');
showsubtitle(array('ID',lang('plugin/zqlj_clearavatar','m_opuser'),lang('plugin/zqlj_clearavatar','m_user'),lang('plugin/zqlj_clearavatar','m_date')));
foreach($items as $adid=>$item){
	$thread=C::t('forum_thread')->fetch($item['tid']);
	showtablerow('',array(), array(
		$item['logid'],
		'<a href="home.php?mod=space&uid='.$item['opuid'].'" target="_blank">'.$item['opusername'].'</a>',
		'<a href="home.php?mod=space&uid='.$item['uid'].'" target="_blank">'.$item['username'].'</a>',
		dgmdate($item['dateline'],'u'),
	));
}
showtablefooter();
echo multi($count,$pagenum,$page,ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=zqlj_clearavatar&pmod=logs");
?>