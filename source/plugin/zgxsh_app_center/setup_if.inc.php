<?php
/**
 *	[插件聚合(zgxsh_app_center.{modulename})] (C)2018-2099 Powered by 日月星辰软件.
 *	Version: 1.0
 *	Date: 2019-08-04 15:00
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//--这个文用来执行$_G逻辑和安全函数以及处理插件变量
include 'module/main.php';

if($_TRC['admin_uid']<>$_G['uid'] and $_G['adminid']<>1){  //非管理
	header("Location:plugin.php?id=zgxsh_app_center:index");
  exit();
}


if($_GET['op']=="setup_add"){
	
	$ls = security::add_aq($_GET);
	
	$db_plugin = DB::fetch_all("SELECT * FROM ".DB::table('common_plugin'));
	for($i=0;$i<count($db_plugin);$i++){
		$db_plugin[$i]['mk'] = unserialize($db_plugin[$i]['modules']);
		for($o=0;$o<count($db_plugin[$i]['mk']);$o++){
			if($db_plugin[$i]['mk'][$o]['type']==1 and $db_plugin[$i]['identifier']<>"zgxsh_bdx" and $db_plugin[$i]['identifier']<>"zgxsh_cq" and $db_plugin[$i]['identifier']<>"zgxsh_sxsb" and $db_plugin[$i]['identifier']<>"zgxsh_app_center"){
				 $p_l[] = array(
					 'pluginid'=> $db_plugin[$i]['pluginid'],
					 'name' => $db_plugin[$i]['name'],
				 );
			}
		}
	}
	include template('zgxsh_app_center:setup/setup_add');
	exit();
}
elseif($_GET['op']=="setup_add_xz_sub"){
	
	$ls = security::add_xz_aq($_GET);
	
	$db_plugin = DB::fetch_first("SELECT * FROM ".DB::table('common_plugin')." WHERE pluginid='".$ls['pluginid']."'");
	
	$db_plugin['mk'] = unserialize($db_plugin['modules']);
	for($o=0;$o<count($db_plugin['mk']);$o++){
		if($db_plugin['mk'][$o]['type']==1){
			 $p_l = array(
				 'name' => $db_plugin['name'],
				 'url' => "plugin.php?id=".$db_plugin['identifier'].":".$db_plugin['mk'][$o]['name'],
				 'txt' => $db_plugin['description'],
				 'ico' => "https://open.dismall.com/resource/plugin/".$db_plugin['identifier'].".png",
			 );
		}
	}
	
	include template('zgxsh_app_center:setup/setup_add_xz');
	exit();
}
elseif($_GET['op']=="setup_add_sub"){
	
	$ls = security::setup_add_sub_aq($_GET);
	
	$ins_t = security::setup_add_sub_ins($ls);
	
	if($ins_t){
		$text = co('if_1');
	}else{
		$text = co('if_2');
	}
	
	include template('zgxsh_app_center:ts/ts');
	exit();
}
elseif($_GET['op']=="setup_del"){
	
	$ls = security::setup_del_aq($_GET);
	
	$del = DB::delete('zgxsh_app_center',array('id'=>$ls['bh']));
	
	if($del){
		$text = co('if_3');
	}else{
		$text = co('if_4');
	}
	
	include template('zgxsh_app_center:ts/ts');
	exit();
}


system_end("error");
?>