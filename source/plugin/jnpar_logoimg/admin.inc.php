<?php 
/*
 *	[jnpar] (C)2018-2023 jnpar技能趴荣耀出品.
 *	这不是一个免费的程序！由QQ：94526868提供技术支持，如需定制或者个性化修改插件，欢迎与我们联系。
 *  技术交流站discuz.jnpar.com 辅助推广，敬请访问惠临。
 *	$_G['basescript'] = 模块名称
 *	CURMODULE = 为模块自定义常量
 */


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT . "./source/plugin/jnpar_logoimg/config.php";

if(!submitcheck('submit')){
	include(template("jnpar_logoimg:admin"));
}else{
	include("upload.class.php");
	$i=0;
	foreach($fids as $key=>$fid){
		$iconwid_fid=dhtmlspecialchars($_POST["iconwidth_$fid"]);//提交的宽度值
		$iconnew_fid=dhtmlspecialchars($_POST["iconnew_$fid"]);//提交的图标URL
		if($_FILES["iconnew_$fid"]['size'] or $logo_widths[$key]!=$iconwid_fid or ($iconnew_fid and $logoinfos[$key]['icon']!=$iconnew_fid)){//如果文件域不为空，或者提交的宽度不等于当前宽度，或者用户切换到提交url设置图标项并且提交的url不等于当前图标url，则执行版块图标更新操作
				$i++;
				if($_FILES["iconnew_$fid"]['size']){
					@unlink($logoimgs[$key]);
					@unlink("./source/plugin/jnpar_logoimg/logoimgs/"."common_$fid_icon");
					$up=new upclass();
					$wid=$up->get_ph_tmpname($_FILES["iconnew_$fid"]['tmp_name']);
					$up->get_ph_type($_FILES["iconnew_$fid"]['type']);
					$size=$up->get_ph_size($_FILES["iconnew_$fid"]['size']);
					$images=$up->get_ph_name($_FILES["iconnew_$fid"]['name'],'common_'.$fid.'_icon');//上传后的图标名称
					$up->save();
					$wid=$wid[0];//获取上传后的宽度信息
					$images=str_replace('./','',$images);
					$images=$siteurl.$images;//拼接上传后的版块图标url
				}elseif($_POST["iconnew_$fid"]){
					$images=dhtmlspecialchars($_POST["iconnew_$fid"]);
					$imginf=getimagesize($images);
					$wid=$imginf[0];
				}else{
					$images=$logoimgs[$key];
				}
				
				
				$extra_arr=unserialize(stripcslashes($logoinfos[$key]["extra"]));
				if(!is_array($extra_arr)){
					$extra_arr=array(
									 'namecolor'=>'',
									 'iconwidth'=>'',
									 );
				}
				if(!$iconwid_fid){
					$extra_arr['iconwidth']=$wid;
				}else{
					$extra_arr['iconwidth']=$iconwid_fid;
				}
				$extra=serialize($extra_arr);
				$data=array(
							'icon'=>daddslashes($images),
							'extra'=>daddslashes($extra),
							);
				$condition="`fid`=$fid";
				//版块图标更新
				DB::update('forum_forumfield',$data,$condition);
		}
	}
	cpmsg(lang('plugin/jnpar_logoimg', 'admin1').$i.lang('plugin/jnpar_logoimg', 'admin2'),'action=plugins&operation=config&do='.$pluginid.'&identifier=jnpar_logoimg&pmod=admin','succeed');
}

