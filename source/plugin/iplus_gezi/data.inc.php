<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function','plugin/iplus_gezi/');
$_GET['adadmin'] = dhtmlspecialchars($_GET['adadmin']);
if(!$_GET['adadmin']){
	$pagenum=20;
	$page=max(1,intval($_GET['page']));	
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('iplus_gezi'));
	showtableheader(lang('plugin/iplus_gezi', 'adlog'), '');
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=iplus_gezi&pmod=data');
	showtableheader();
	showsubtitle(iplus_gezi(array( 'adname','aduser', 'starttime', 'endtime' , 'adtools')));
	$adlist=DB::fetch_all("SELECT * FROM ".DB::table('iplus_gezi')." ORDER BY dateline DESC LIMIT ".(($page-1)*$pagenum).",$pagenum");
	foreach($adlist as $k=>$result) {
		$result['title']=dhtmlspecialchars(strip_tags($result['title']));
		showtablerow(NULL,NULL, array(
		'<a href="'.$result['url'].'" title="'.$result['url'].'" target="_blank">'.$result['title'].'</a>',
		'<a href="home.php?mod=space&uid='.$result['uid'].'" target="_blank">'.$result['username'].'</a>(UID:'.$result['uid'].')',
		dgmdate($result['dateline'],'Y-m-d H:i'),
		dgmdate($result['lastdate'],'Y-m-d H:i'),
		'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=iplus_gezi&pmod=data&adadmin=edit&aid='.intval($result['id']).'">'.lang ('plugin/iplus_gezi', 'adedit').'</a> <a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=iplus_gezi&pmod=data&adadmin=del&del_id='.$result['id'].'&formhash='.FORMHASH.'">'.lang('plugin/iplus_gezi', 'addels').'</a>'));
	}
	showtablerow();
	showtablefooter();
	showformfooter();
	echo multi($count, $pagenum, $page, ADMINSCRIPT.'?action=plugins&operation=config&identifier=iplus_gezi&pmod=data');		

}elseif($_GET['adadmin']=='edit'){
	if(!submitcheck('editsubmit')){
		$aid = intval($_GET['aid']);
		showtableheader(lang('plugin/iplus_gezi', 'admrpmh'), '');
		$id_info = DB::fetch_first("SELECT * FROM ".DB::table('iplus_gezi')." WHERE id='$aid'");
		$id_info['title']=dhtmlspecialchars(strip_tags($id_info['title']));
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=iplus_gezi&pmod=data&adadmin=edit&id='.intval($id_info['id']));
		showsetting(iplus_gezi('adyodd'),'title',$id_info['title'], 'text','0');	
		showsetting(iplus_gezi('adlinks'),'url',$id_info['url'], 'text','0');	
		showsubmit('editsubmit', 'submit');
		showtablefooter();
		showformfooter();
	}else{
		$aid = intval($_GET['id']);
		$title = daddslashes($_GET['title']);
		$title=dhtmlspecialchars(strip_tags($title));
		$url = daddslashes($_GET['url']);
		DB::update('iplus_gezi', array('title'=>$title,'url'=>$url),"id='$aid'");
		updateadlist();
		cpmsg(iplus_gezi('adokok'),'action=plugins&operation=config&do='.$pluginid.'&identifier=iplus_gezi&pmod=data');
	}
}elseif($_GET['adadmin']=='del'&&$_GET['formhash']==formhash()){
	$aid = intval($_GET['del_id']);
	DB::delete('iplus_gezi',array('id'=>$aid));
	updateadlist();
	cpmsg(iplus_gezi('addesss'),'action=plugins&operation=config&do='.$pluginid.'&identifier=iplus_gezi&pmod=data');
}

function iplus_gezi($str) {
	if(is_array($str)) {
		$return = array();
		foreach($str as $value) {
			$return[] = iplus_gezi($value);
		}
		return $return;
	} else {
		return lang('plugin/iplus_gezi', $str);
	}
}

?>
