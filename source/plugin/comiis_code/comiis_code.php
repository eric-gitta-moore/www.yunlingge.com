<?php

/**
 * 
 * 克米出品 必属精品
 * 克米设计工作室 版权所有 http://www.Comiis.com
 * 专业论坛首页及风格制作, 页面设计美化, 数据搬家/升级, 程序二次开发, 网站效果图设计, 页面标准DIV+CSS生成, 各类大中小型企业网站设计...
 * 我们致力于为企业提供优质网站建设、网站推广、网站优化、程序开发、域名注册、虚拟主机等服务，
 * 一流设计和解决方案为企业量身打造适合自己需求的网站运营平台，最大限度地使企业在信息时代稳握无限商机。
 *
 *   电话: 0668-8810200
 *   手机: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作时间: 周一到周五早上09:00-11:00, 下午03:00-05:00, 晚上08:30-10:30(周六、日休息)
 * 克米设计用户交流群: ①群83667771 ②群83667772 ③群83667773 ④群110900020 ⑤群110900021 ⑥群70068388 ⑦群110899987
 * 
 */
 
if(!defined('IN_DISCUZ')) {exit('Access Denied');}
$plugindata = array();
$comiis_code_view = $recomiis_code = '';
$plugindata = $_G['cache']['plugin']['comiis_code'];
if(isset($_GET['code']) && $_GET['code'] == substr(md5($_G['tid']), 8, 16) && $_G['basescript'] == 'forum' && CURMODULE == 'viewthread'){
	loadcache('comiis_code_view');
	$comiis_code_view = intval($_G['cache']['comiis_code_view']) + 1;
	savecache('comiis_code_view', $comiis_code_view);
	if($plugindata['comiis_code_top_open'] == 1){
		$plugindata['comiis_code_mob_view'] = str_replace("{views}", "<span>". $comiis_code_view. "</span>", $plugindata['comiis_code_mob_view']);
		$recomiis_code = '<style>
		.comiis_mob_code {width:100%;margin:0 auto;padding-bottom:15px;background:#fff url(source/plugin/comiis_code/comiis_img/comiis_mob_x.gif) repeat-x bottom;text-align:center;}
		.comiis_mob_code .comiis_mob_wz{padding:10px 10px 4px 40px; background:#fff url(source/plugin/comiis_code/comiis_img/comiis_mob_logo.gif) no-repeat 0px 14px;text-align:left;margin:0px auto;display:inline-block;}
		.comiis_mob_code .comiis_mob_wz .comiis_mob_titlenvgh{font-size:16px;display:block;}
		.comiis_mob_code .comiis_mob_wz .comiis_mob_viewsudqg{color:#999;font-size:12px;height:12px;line-height:12px;display:block;}
		.comiis_mob_code .comiis_mob_wz .comiis_mob_viewsudqg span{margin:0px 6px;color:#333;}
		.comiis_mob_code .comiis_mob_wz .comiis_mob_viewsudqg img{margin-left:4px;vertical-align:bottom;}
		</style>				
		<div class="comiis_mob_code">
		<div class="comiis_mob_wz">
		<p class="comiis_mob_titlenvgh">'.$plugindata['comiis_code_mob_title'].'</p>
		<p class="comiis_mob_viewsudqg">'.$plugindata['comiis_code_mob_view'].'</p>
		</div>
		</div>';
	}else{
		$recomiis_code = '';
	}
}
?>