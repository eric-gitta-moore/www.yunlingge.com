<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if(submitcheck('submit')){

	if(is_array($_POST['delete'])){
		
		foreach($_POST['delete'] as $k=>$id){
			if($id){
				DB::delete('dzl8_webmaster',array('id'=>$id));
			}
		}
	}
	cpmsg(lang('plugin/dzl8_webmaster', 'shan'),'action=plugins&operation=config&identifier=dzl8_webmaster&pmod=lists', 'succeed');
}else{
	
	$verify=array(
		'0'=>'<font color="red">'.lang('plugin/dzl8_webmaster', 'no').'</font>',
		'1'=>'<font color="green">'.lang('plugin/dzl8_webmaster', 'yes').'</font>',
	);

$pagenum=15;
$page=max(1,intval($_GET['page']));

$rencount = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('dzl8_webmaster') ));

$data=DB::fetch_all("SELECT * FROM ".DB::table('dzl8_webmaster')." WHERE 1 ORDER BY `id` DESC limit ".($page-1)*$pagenum.",$pagenum");

showformheader('plugins&operation=config&identifier=dzl8_webmaster&pmod=lists');

showtableheader(lang('plugin/dzl8_webmaster', 'bt'));

showsubtitle(array('',lang('plugin/dzl8_webmaster', 'xh'),lang('plugin/dzl8_webmaster', 'yhm'),lang('plugin/dzl8_webmaster', 'name'),lang('plugin/dzl8_webmaster', 'url'),lang('plugin/dzl8_webmaster', 'sfrz'),lang('plugin/dzl8_webmaster', 'time')));

	foreach($data as $list) {
		
		$id=$list['id'];
		$username = DB::result(DB::query("SELECT username FROM ".DB::table('common_member')." WHERE uid = ".$list['uid']." "));
		showtablerow('', array('class="td25"', 'class="td_k"', 'class="td_l"'), array(
			"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[".$list['id']."]\" value=\"".$list['id']."\">",
			$list['id'],
			'<a href="home.php?mod=space&uid='.$list['uid'].'" target="_blank">'.$username.'</a>',
			'<a href="'.$list['url'].'" target="_blank">'.$list['name'].'</a>',
			'<a href="'.$list['url'].'" target="_blank">'.$list['url'].'</a>',
			$verify[$list['verify']],
			date('Y-m-d H:i:s',$list['datatime']),
		));
				
	}
	
	$multipage=multi($rencount,$pagenum,$page,ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=dzl8_webmaster&pmod=lists");
	showsubmit('submit', 'submit', 'del', '', $multipage);
	showtablefooter();
	showformfooter();
	
}	
?>