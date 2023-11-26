<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('plugin');
$vars=$_G['cache']['plugin']['gp_autoreply'];
require_once libfile('function/portalcp');
loadcache('portalcategory');
$portalcategory = $_G['cache']['portalcategory'];
if(empty($portalcategory) && C::t('portal_category')->count()) {
	updatecache('portalcategory');
	loadcache('portalcategory', true);
	$portalcategory = $_G['cache']['portalcategory'];
}
if($_GET['op']=='edit'){
	$fid=intval($_GET['fid']);
	if(submitcheck('editsubmit')){
		$data=array();
		$content= explode("/hhf/",str_replace(array("\r\n", "\n", "\r"), '/hhf/',$_POST['content']));
		foreach($content as $k=>$v){
			$v=trim($v);
			if($v) $data[]=$v;
		}
		@require_once libfile('function/cache');
		$cacheArray = "\$data=".arrayeval($data).";\n";
		writetocache('gp_autoreply_'.$fid,$cacheArray);	
		cpmsg(lang('plugin/gp_autoreply','edit_ok'),'action=plugins&operation=config&identifier=gp_autoreply&pmod=item', 'succeed');
	}else{
		$name=DB::result_first("select name from ".DB::table('forum_forum')." where fid='$fid'");
		$content='';
		if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_'.$fid.'.php')){
			@require_once DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_'.$fid.'.php';
			$content=trim(implode("\r\n",$data));
		}
		showformheader("plugins&operation=config&identifier=gp_autoreply&pmod=item&op=edit&fid=$fid");
		showtableheader(lang('plugin/gp_autoreply','edit_title',array('catname'=>$name)),'nobottom');	
		showsetting(lang('plugin/gp_autoreply','edit_content'),'content',$content,'textarea','', 0,lang('plugin/gp_autoreply','edit_content_tip'));	
		showsubmit('editsubmit');
		showtablefooter();
		showformfooter();
	}
	
}elseif(!submitcheck('editsubmit')){
	showtableheader(lang('plugin/gp_autoreply','tips'));
	showtablerow('',array('colspan="9" class="tipsblock"'), array(lang('plugin/gp_autoreply','info')));
	showtableheader(lang('plugin/gp_autoreply','list_title'), 'nobottom');
	showsubtitle(array('',lang('plugin/gp_autoreply','list_menu_1'),lang('plugin/gp_autoreply','list_menu_2'),lang('plugin/gp_autoreply','list_menu_3'),lang('plugin/gp_autoreply','list_menu_4')));
	$forums=unserialize($vars['forums']);
	foreach($forums as $k=>$v){
		$cnum='0'.lang('plugin/gp_autoreply','comments');
		if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_'.$v.'.php')){
			@require_once DISCUZ_ROOT.'./data/sysdata/cache_gp_autoreply_'.$v.'.php';
			$cnum=intval(count($data)).lang('plugin/gp_autoreply','comments');
		}
		if($config[$v]) $value=$config[$v];
		else $value=0;
		$name=DB::result_first("select name from ".DB::table('forum_forum')." where fid='$v'");
		showtablerow('', array('class="td25"', 'class="td_k"', 'class="td_l"'), array(
			'',
			$v,
			'<a href="forum.php?mod=forumdisplay&fid='.$v.'" target="_blank">'.$name.'</a>',
			'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=gp_autoreply&pmod=item&op=edit&fid='.$v.'">'.lang('plugin/gp_autoreply','edit').'</a>',
			$cnum,
		));
	}
	showtablefooter();
}	
?>