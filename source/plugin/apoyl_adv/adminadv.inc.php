<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: adminadv.inc.php  2019-06  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$totalnums=C::t('#apoyl_adv#adv_count')->count();
$pagenums=25;
$page=!empty($_GET['page'])?$_GET['page']:1;
$starttime=($page-1)*$pagenums;
$arr=C::t('#apoyl_adv#adv_count')->fetch_adm($starttime,$pagenums);
$pagecode=multi($totalnums, $pagenums, $page, ADMINSCRIPT.'?action=plugins&operation=config&pluginid='.$pluginid.'&identifier=apoyl_adv');


include template('apoyl_adv:adminadv');

?>