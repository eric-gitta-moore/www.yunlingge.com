<?php
if(!defined('IN_DISCUZ')) {
exit('Access Denied');}
	global $_G;
	$xhkj5com_dashang = $_G['cache']['plugin']['xhkj5com_dashang'];
	$zsx='#e74851';$qsbg='#FEF8F5';
	if($xhkj5com_dashang['styles']==2){$zsx='#fca222';$qsbg='#fdf9f3';}elseif($xhkj5com_dashang['styles']==3){$zsx='#5fbf5f';$qsbg='#edfded';}elseif($xhkj5com_dashang['styles']==4){$zsx='#60b4e9';$qsbg='#f3f9fd';}elseif($xhkj5com_dashang['styles']==5){$zsx='#5788aa';$qsbg='#f3f9fd';}
	
$authorid=intval($_GET['zzid']);
$ainfo=DB::fetch_first("select * from ".DB::table('xhkj5com_dashang')." where uid=".$authorid);

if($ainfo['text'] && !$xhkj5com_dashang['zz']){$dsy=$ainfo['text'];}else{$dsy=$xhkj5com_dashang['dsy'];}

if($ainfo && !$xhkj5com_dashang['zz']){
if($ainfo['picurl']){$alipay="data/xhkj5com_dashang/".$ainfo['picurl'];}else{$alipay=$xhkj5com_dashang['alipay'];}
if($ainfo['picurla']){$wechat="data/xhkj5com_dashang/".$ainfo['picurla'];}else{$wechat=$xhkj5com_dashang['wechat'];}
}else{
$alipay=$xhkj5com_dashang['alipay'];
$wechat=$xhkj5com_dashang['wechat'];
	}

include template('xhkj5com_dashang:tis');