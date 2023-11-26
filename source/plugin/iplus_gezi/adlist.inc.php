<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
loadcache('plugin');
if(!$_G['uid']){//游客
	showmessage(lang('plugin/iplus_gezi', 'userlogin'), '', array(), array('login' => true));
}
require_once libfile('function','plugin/iplus_gezi/');
$_GET['adadmin'] = htmlspecialchars(trim($_GET['adadmin']));
if(!$_GET['adadmin']){//列表
		loadcache('plugin');
		$adcolor=$_G['cache']['plugin']['iplus_gezi']['adcolor'];
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('iplus_gezi'));
		$pagenum=20;
		$page=max(1,intval($_GET['page']));
		$start=($page-1)*$pagenum;
		$adlist=array();
		if($count){
			$query=DB::query("SELECT * FROM ".DB::table('iplus_gezi')." where uid=".$_G['uid']." and lastdate>".TIMESTAMP." ORDER BY dateline DESC LIMIT $start,$pagenum");
			while($result = DB::fetch($query)) {
				$style='style="';
				$fontarr=unserialize($result['style']);
				if($fontarr['fontcolor']) $style.='color:'.$fontarr['fontcolor'].';';
				else $style.='color:'.$adcolor.';';
				if($fontarr['fontweight']==1) $style.='font-weight: bold;';
				if($fontarr['fontstyle']==1) $style.='font-style: italic;';
				if($fontarr['textdecoration']==1) $style.='text-decoration: underline;';
				$style.='"';			
				$result['style']=$style;
				$result['lastdate']=date('Y-m-d H:i:s',$result['lastdate']);
				$result['title'] = dhtmlspecialchars($result['title']);
				$adlist[]=$result;
			}
		}
		$multi=multi($count,$pagenum,$page,'home.php?mod=spacecp&ac=plugin&id=iplus_gezi:adlist');
}elseif($_GET['adadmin']=='edit'){//编辑
	if(!submitcheck('editsubmit')){
		$aid = intval($_GET['adid']);
		$adinfo = DB::fetch_first("SELECT * FROM ".DB::table('iplus_gezi')." WHERE uid=".$_G['uid']." and id='$aid'");
		if(!$adinfo){
			showmessage(lang('plugin/iplus_gezi','aderror'));//不存在
		}
		$adinfo['style']=unserialize($adinfo['style']);
		$adinfo['title']=dhtmlspecialchars($adinfo['title']);
	}else{
		if(empty($_GET['url'])||!preg_match("/^(http:|https:)\/\/([0-9a-zA-Z][0-9a-zA-Z-]*\.)+[a-zA-Z]{2,}/", $_GET['url'])){
			showmessage(lang('plugin/iplus_gezi','errorurl'));//链接有误
		}
		if(empty($_GET['title'])){
			showmessage(lang('plugin/iplus_gezi','biaotinoll'));//标题为空
		}	
		$aid=intval($_GET['adid']);
		$title = daddslashes($_GET['title']);
		$url = daddslashes($_GET['url']);
		$fontarr=array();
		if(file_exists(DISCUZ_ROOT.'./source/plugin/iplus_gezi/lib/font0424.lib.php')){
			@include DISCUZ_ROOT . './source/plugin/iplus_gezi/lib/font0424.lib.php';
		}
		$style=serialize($fontarr);
		if($title&&$url){
			DB::update('iplus_gezi', array('title'=>$title,'url'=>$url,'style'=>$style),"id='$aid'");
			updateadlist();
			showmessage(lang('plugin/iplus_gezi','adokok'),'home.php?mod=spacecp&ac=plugin&id=iplus_gezi:adlist',array(),array('refreshtime'=>3));	
		}else{
			showmessage(lang('plugin/iplus_gezi','editerror'),'javascript:history.back()',array(),array('refreshtime'=>3));	
		}
	}
}elseif($_GET['adadmin']=='del'&&submitcheck('delsubmit')){//删除
	foreach($_GET['delete'] as $k=>$id){
		$id=intval($id);
		DB::delete('iplus_gezi',array('uid'=>$_G['uid'],'id'=>$id));
	}
	updateadlist();
	showmessage(lang('plugin/iplus_gezi','addesss'),'home.php?mod=spacecp&ac=plugin&id=iplus_gezi:adlist',array(),array('refreshtime'=>3));	
}

?>