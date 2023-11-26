<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
set_time_limit(0);
loadcache('plugin');
$var= $_G['cache']['plugin']['nimba_linkhelper'];
$site=empty($var['site'])? $_SERVER['HTTP_HOST']:$var['site'];

$op=addslashes($_GET['op']);
echo '<script type="text/javascript">
function ch(){';
$all_list=DB::fetch_all("SELECT id FROM ".DB::table('common_friendlink')." ORDER BY id DESC");
foreach($all_list as $k=>$ids){
	echo 'document.getElementById("s'.$ids['id'].'").innerHTML=ajaxget(\''.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=admincp&op=check&formhash='.FORMHASH.'&id='.$ids['id'].'\',\'s'.$ids['id'].'\',\'s'.$ids['id'].'\',\'loading\',\'\',\'recall\');'."\n";
}
echo '}</script>';

if($op=='check'){
	if($_GET['formhash']==formhash()){
		$id=intval($_GET['id']);
		$sec='<a onclick="ajaxget(\''.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=admincp&op=check&formhash='.FORMHASH.'&id='.$id.'\',\'s'.$id.'\',\'s'.$id.'\',\'loading\',\'\',\'recall\');return false" href="#">'.lang('plugin/nimba_linkhelper','sec').'</a>';
		$link=DB::result_first("SELECT url FROM ".DB::table('common_friendlink')." WHERE id=$id");
		$html=@file_get_contents($link);
		ajaxshowheader();
		if(empty($html)) echo '<span style="color:#FF0000;">'.lang('plugin/nimba_linkhelper','nohtml').'</span> | '.$sec;
		else{
			if(substr_count($html,$site)) echo '<span style="color:#009900;">'.lang('plugin/nimba_linkhelper','checkyes').'</span> | '.$sec;
			else echo '<span style="color:#FF0000;">'.lang('plugin/nimba_linkhelper','checkno').'</span> | '.$sec;
		}
		ajaxshowfooter();
	}else{
		ajaxshowheader();
		echo lang('plugin/nimba_linkhelper','hashcheck');
		ajaxshowfooter();
	}
}else{
	showtableheader(lang('plugin/nimba_linkhelper','tip').$site);
	showsubtitle(array(lang('plugin/nimba_linkhelper','type'),lang('plugin/nimba_linkhelper','url'),lang('plugin/nimba_linkhelper','type1'),lang('plugin/nimba_linkhelper','type2'),lang('plugin/nimba_linkhelper','type3'),lang('plugin/nimba_linkhelper','type4'),'<a id="p'.$i.'" onclick="ch()" href="#">'.lang('plugin/nimba_linkhelper','checkall').'</a>'));
	$list = DB::fetch_all("SELECT * FROM ".DB::table('common_friendlink')." ORDER BY id DESC");
	foreach($list as $k=>$data) {
		$type = sprintf('%04b',$data['type']);
		$data['dateline'] = empty($data['dateline'])? '':dgmdate($data['dateline']);
		showtablerow('', array('class="td_k"', 'class="td_k"', 'class="td_l"','','','','id="s'.$data['id'].'"'), array(
			'<a href='.$data['url'].' target="_blank">'.$data['name'].'</a>',
			'<a href='.$data['url'].' target="_blank">'.$data['url'].'</a>',
			'<input type="checkbox" value="1" disabled="false" name="portal['.$data['id'].']" '.($type[0] ? "checked" : '').'>',
			'<input type="checkbox" value="1" disabled="false" name="forum['.$data['id'].']" '.($type[1] ? "checked" : '').'>',
			'<input type="checkbox" value="1" disabled="false" name="group['.$data['id'].']" '.($type[2] ? "checked" : '').'>',
			'<input type="checkbox" value="1" disabled="false" name="home['.$data['id'].']" '.($type[3] ? "checked" : '').'>',
			'<a onclick="ajaxget(\''.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=admincp&op=check&formhash='.FORMHASH.'&id='.$data['id'].'\',\'s'.$data['id'].'\',\'s'.$data['id'].'\',\'loading\',\'\',\'recall\');return false" href="#">'.lang('plugin/nimba_linkhelper','check').'</a>'

		));
	}
	showtablefooter();
}

?>