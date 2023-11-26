<?php 
/*
 *	[jnpar] (C)2018-2023 jnpar技能趴荣耀出品.
 *	这不是一个免费的程序！由QQ：94526868提供技术支持，如需定制或者个性化修改插件，欢迎与我们联系。
 *  技术交流站www.jnpar.com 辅助推广，敬请访问惠临。
 *	$_G['basescript'] = 模块名称
 *	CURMODULE = 为模块自定义常量
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

function getmd5($var1,$var2,$var3){//获取拼接字符串的md5值，用于权限验证
	$arr=array($var1,$var2,$var3);
	return md5(implode('', $arr));
}
include_once 'identity.php';
include_once 'lang.'.currentlang().'.php';

if(getmd5(SN,SITEID,"jnparsn") != SITEKEY) {
	echo '<hr>';
}

global $_G;
$siteurl=$_G['siteurl'];//初始化设置

$fidinfos=DB::fetch_all("SELECT fid,name FROM %t WHERE status=%d and type=%s order by fid asc",array('forum_forum',1,'forum'));//获取已启用的版块fid和版块名称

//所有启用的fid整合成数组
$fids=array();
foreach($fidinfos as $fidinfo){
	$fids[]=$fidinfo['fid'];
}

$logoinfos=DB::fetch_all("SELECT fid,icon,extra FROM %t WHERE ".DB::field('fid',$fids).' order by fid asc',array('forum_forumfield'));//根据fid数组，获取对应的版块图标和extra信息

$imgurl="data/attachment/common/";//系统默认的图标存放路径，保证接管后能够正常显示原有的版块图标
$imgdir=DISCUZ_ROOT . "./data/attachment/common/";//原版块图标的绝对路径

$logoimgs=$logo_widths=array();//定义图标数组和宽度数组


foreach($logoinfos as $key=>$logoinfo){
		//图标数组赋值
		if(!$logoinfo['icon']){
			$logoimgs[]="";
		}elseif(file_exists($imgdir.$logoinfo['icon'])){
			$logoimgs[]=dhtmlspecialchars($imgurl.$logoinfo['icon']);
		}else{
			$logoimgs[]=dhtmlspecialchars($logoinfo['icon']);
		}
		//宽度数组赋值
		$extra=$logoinfo['extra'];
		$extra=unserialize(stripcslashes($extra));
		$logo_widths[]=dhtmlspecialchars($extra["iconwidth"]);
}
