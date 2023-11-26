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


require_once DISCUZ_ROOT . "./source/plugin/jnpar_logoimg/config.php";

if(!submitcheck('submit')){
	showtips(lang('plugin/jnpar_logoimg', 'quickset1'));
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=jnpar_logoimg&pmod=quickset');
	showtableheader();
	
	showsetting('','logoimg_arr',$init,'textarea');
	
	showtablefooter();
	showsubmit('submit',lang('plugin/jnpar_logoimg', 'quickset4'));
	showformfooter();
	
}else{
	//获取post数据，安全过滤并拆分
	$post=dhtmlspecialchars($_POST);
	@extract($post);
	
	$logoimg_arr=explode(PHP_EOL,trim($logoimg_arr));//每行一个，将设置转化为数组
	foreach($logoimg_arr as $key=>$logoimg){
		$arr=explode("|",trim($logoimg));//每行拆分一个版块图标设置数组，数组中第一个元素为版块ID，第二个元素为位于指定目录中的图标名称，第三个元素为宽度
		
		//将设置中的宽度进行序列化，并得到序列化后的$extra
		$extra_arr=unserialize(stripcslashes($logoinfos[$key]["extra"]));
		$extra_arr['iconwidth']=$arr[2];
		$extra=serialize($extra_arr);
		
		
		//如果设置中包含版块图标，并且版块图标在指定目录中存在，则执行更新
		if($arr[1] and file_exists(DISCUZ_ROOT . "./source/plugin/jnpar_logoimg/logoimgs/".$arr[1])){
			
			$data=array(
						'icon'=>daddslashes($siteurl."source/plugin/jnpar_logoimg/logoimgs/".$arr[1]),
						'extra'=>daddslashes($extra),
						);
			$condition="`fid`=".$arr[0];
			DB::update('forum_forumfield',$data,$condition);
		}
	}
	cpmsg(lang('plugin/jnpar_logoimg', 'quickset5'),'action=plugins&operation=config&do='.$pluginid.'&identifier=jnpar_logoimg&pmod=quickset','succeed');
}

