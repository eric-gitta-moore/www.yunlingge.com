<?php
if(!defined('IN_DISCUZ')) {
exit('Access Denied');}

global $_G;
$xhkj5com_dashang = $_G['cache']['plugin']['xhkj5com_dashang'];


if(!$_G['uid']) {
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}

if($xhkj5com_dashang['zz']){
	showmessage(lang('plugin/xhkj5com_dashang', 'zsgb'), '');
	
	}


$dssize =  $xhkj5com_dashang['size'] ? ($xhkj5com_dashang['size'])*1000 : 100000;
$o=intval($_GET['o']) ? intval($_GET['o']) : 0;
$x='';$x[$o]='class="a"';
if($o==2){$wm='picurla';}else{$wm='picurl';}
$coun=DB::result_first("select count(1) from ".DB::table('xhkj5com_dashang')." where uid=".$_G['uid']);
if($_GET['pluginop'] == 'update' && submitcheck('submitwater')) {
	$_POST = daddslashes($_POST);
	if($_POST['formhash']!=FORMHASH)return;
	$file = $_POST['file_path'] != 'static/image/common/groupicon.gif' ? trim(substr($_POST['file_path'], strlen('data/xhkj5com_dashang/'))) : '';
	if ($_FILES['file']['error'] === 0) {

		$upload = new discuz_upload();
		$upload->init($_FILES['file'], 'temp', 101);		
		$basedir = DISCUZ_ROOT.'./data/xhkj5com_dashang/';
		if(!(is_dir($basedir)))$basedir && discuz_upload::make_dir($basedir);
		
		$upload->attach['target'] = $basedir.'./'.$upload->attach['attachment'];
		
		if($upload->error()) {
			showmessage(lang('plugin/xhkj5com_dashang', 'scsb'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
		}
		if(!$upload->attach['isimage']) {
			showmessage(lang('plugin/xhkj5com_dashang', 'bstpgs'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
		}
		if($upload->attach['size'] > $dssize) {
			showmessage(lang('plugin/xhkj5com_dashang', 'tpccdx'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
		}
		$upload->save();//debug($upload);
		
		if($upload->error()) {
			showmessage(lang('plugin/xhkj5com_dashang', 'bcsb'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
		}
			$file = $upload->attach['attachment'];
	}
	
	if ($_POST['del'] == 'on') {
		$file_path = $_POST['file_path'];
		if ($file_path != 'static/image/common/groupicon.gif') {
			$full_path = DISCUZ_ROOT.$file_path;
			if(!unlink($full_path)) {
				showmessage(lang('plugin/xhkj5com_dashang', 'sccg'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
			}
		}
		$file = '';
	}
		
	$file=daddslashes($file);
	if($coun){
		DB::query("update ".DB::table('xhkj5com_dashang')." set ".$wm."='".$file."' where uid=".$_G['uid']);
		}else{DB::query("insert into ".DB::table('xhkj5com_dashang')."(uid , ".$wm.") values ('".$_G['uid']."' , '".$file."')");}
		showmessage(lang('plugin/xhkj5com_dashang', 'szcg'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
}

$text=DB::result_first("select text from ".DB::table('xhkj5com_dashang')." where uid=".$_G['uid']);
if(!$text) $vl='';else $vl=$text;
$dsy=dhtmlspecialchars($_POST['texta']);
$dsy=daddslashes($dsy);

if($_GET['pluginop'] == 'text' && submitcheck('text')) {
	if($_POST['formhash']!=FORMHASH)return;
	if($coun){
		DB::query("update ".DB::table('xhkj5com_dashang')." set text='".$dsy."' where uid=".$_G['uid']);
	}else{
		DB::query("insert into ".DB::table('xhkj5com_dashang')."(uid , text) values ('".$_G['uid']."' , '".$dsy."')");
	}
	showmessage(lang('plugin/xhkj5com_dashang', 'szcg'), 'home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds&o='.$o);
}


$user =DB::fetch_first("select * from ".DB::table('xhkj5com_dashang')." where uid=".$_G['uid']);
if (empty($user[$wm])) {
	$icon_file = "static/image/common/groupicon.gif";
} else {
	$icon_file = "data/xhkj5com_dashang/".$user[$wm];
}

if(checkmobile()){
    include_once template('xhkj5com_dashang:keke_myds');
    exit;
}