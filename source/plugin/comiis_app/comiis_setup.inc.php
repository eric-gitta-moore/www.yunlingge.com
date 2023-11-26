<?php
/**
 * 
 * 草-根-吧提醒：为保证草根吧资源的更新维护保障，防止草根吧首发资源被恶意泛滥，
 *             希望所有下载草根吧资源的会员不要随意把草根吧首发资源提供给其他人;
 *             如被发现，将取消草根吧VIP会员资格，停止一切后期更新支持以及所有补丁BUG等修正服务；
 *          
 * 草.根.吧出品 必属精品
 * 草根吧 全网首发 https://Www.Caogen8.co
 * 官网：www.Cgzz8.com (请收藏备用!)
 * 本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 * 技术支持/更新维护：QQ 2575 163778
 * 谢谢支持，感谢你对.草根吧.的关注和信赖！！！   
 * 
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/comiis_app/language/language.'.currentlang().'.php';
require_once libfile('function/comiis_app', 'plugin/comiis_app');
include_once libfile('function/forumlist');
if(empty($_GET['comiis']) || !in_array($_GET['comiis'], array('setup', 'nav', 'portal', 'bbs', 'other', 'style', 'config', 'tip', 'group', 'wx', 'adv'))) $_GET['comiis'] = 'setup';
loadcache(array('comiis_app_switch'));
if(!isset($_G['cache']['comiis_app_switch']['comiis_view_header_noxx'])){
$sql = <<<EOF
	REPLACE  into `pre_comiis_app_switch`(`name`,`value`) values ('comiis_view_header_noxx','1');
	REPLACE  into `pre_comiis_app_switch`(`name`,`value`) values ('comiis_view_lev_tit','0');
	REPLACE  into `pre_comiis_app_switch`(`name`,`value`) values ('comiis_recommend_open','0');
	{$comiis_app_new_install_lang}
EOF;
	runquery($sql);
	$sql = '';
	comiis_app_up_switch();
	comiis_app_up_nav();
}
$plugin_url = 'plugins&operation=config&do='. $plugin_id. '&identifier='. $plugin['identifier'].'&pmod=comiis_setup'. '&comiis='. $_GET['comiis'];
$plugin_nav_in = array($_GET['comiis'] => ' class="current"');
$comiis_app_nav = '';
foreach($comiis_app_nav_name as $k => $v){
	$comiis_app_nav .= '<li'.$plugin_nav_in[$k].'><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$plugin_id.'&identifier='.$plugin['identifier'].'&pmod=comiis_setup&comiis='.$k.'"><span>'.$v.'</span></a></li>';
}
echo '<link rel="stylesheet" href="source/plugin/comiis_app/style/comiis.css" type="text/css">
<div class="floattop">
	<div class="itemtitle">
		<h3>'.$comiis_app_lang['338'].'</h3>
		<ul class="tab1">
		'.$comiis_app_nav.'
		<li><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$plugin_id.'&identifier='.$plugin['identifier'].'&pmod=comiis_more"><span>'.$comiis_app_lang['337'].'</span></a></li>
		</ul>
	</div>
</div>';
global $plugin_url, $plugin_id;
include_once libfile('comiis_'.$_GET['comiis'], 'plugin/comiis_app/include/');
