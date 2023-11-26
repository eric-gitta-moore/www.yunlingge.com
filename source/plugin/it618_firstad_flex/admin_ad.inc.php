<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */
(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) && exit('Access Denied');

global $_G;

loadcache('plugin');
$it618_firstad_flex = $_G['cache']['plugin']['it618_firstad_flex'];

loadcache('pluginlanguage_template');
loadcache('pluginlanguage_script');
$scriptlang['it618_firstad_flex'] = $_G['cache']['pluginlanguage_script']['it618_firstad_flex'];

$it618_lang = $scriptlang['it618_firstad_flex'];

for($i=1;$i<=18;$i++){
	$it618_firstad_flex_lang[$i]=$it618_lang['it618_ad_lang'.$i];
}

require_once DISCUZ_ROOT.'./source/plugin/it618_firstad_flex/function/it618_firstad_flex.func.php';

$ppp = $it618_firstad_flex['pagecount'];
$page = max(1, intval($_GET['page']));
$startlimit = ($page - 1) * $ppp;

$hosturl=ADMINSCRIPT."?action=";
$identifier = $_GET['identifier'];
$urls = '&pmod=admin&identifier='.$identifier.'&operation='.$operation.'&do='.$do;

$cparray = array('admin_ad');
$cp = !in_array($_GET['cp'], $cparray) ? 'admin_ad' : $_GET['cp'];
define(TOOLS_ROOT, dirname(__FILE__).'/');


require TOOLS_ROOT.'./include/'.$cp.'.inc.php';
showformfooter();
?>