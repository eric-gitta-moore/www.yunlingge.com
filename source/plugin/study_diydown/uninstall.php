<?php
/*
 * Install Uninstall Upgrade AutoStat System Code 2020012608cvkk0Pf20g
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if(!defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once ('installlang.lang.php');
require_once ('pluginvar.func.php');
$request_url=str_replace('&step='.$_GET['step'],'',$_SERVER['QUERY_STRING']);
showsubmenusteps($pluginarray['plugin']['name'].$s_installlang[$operation].$s_installlang['ilang_001'], array(
	array($s_installlang['ilang_check'], !$_GET['step']),
	array($s_installlang['ilang_sql'], $_GET['step'] == 'sql'),
	array($s_installlang['ilang_stat'].$s_installlang[$operation], $_GET['step'] == 'stat' || $_GET['step']=='ok'),
));
if($_GET['step']){
sleep(1);
}
switch($_GET['step']){
	default:
	case 'check':
		cpmsg($s_installlang['ilang_check_ok'], "{$request_url}&step=sql", 'loading', array('operation' => $s_installlang[$operation]));
		break;
	case 'sql':
		if(!$_GET['deletesql']) {
			cpmsg($s_installlang['ilang_sql_delete'], "{$request_url}&step=sql&deletesql=1314", 'form', array(), '', TRUE, ADMINSCRIPT."?{$request_url}&step=stat");
		}
		cpmsg($s_installlang['ilang_sql_ok'], "{$request_url}&step=stat", 'loading', array('operation' => $s_installlang[$operation]));
		break;
	case 'stat':
		$_statInfo = array();
		$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
		$_statInfo['pluginVersion'] = $pluginarray['plugin']['version'];
		require_once DISCUZ_ROOT.'./source/discuz_version.php';
		$_statInfo['bbsVersion'] = DISCUZ_VERSION;
		$_statInfo['bbsRelease'] = DISCUZ_RELEASE;
		$_statInfo['timestamp'] = TIMESTAMP;
		$_statInfo['bbsUrl'] = $_G['siteurl'];
		$_statInfo['SiteUrl'] = 'http://www.yun-ling.cn/';
		$_statInfo['ClientUrl'] = 'http://www.yun-ling.cn/';
		$_statInfo['SiteID'] = '60DF4F84-4325-8E2C-A68B-78184AFF8D9A';
		$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
		$_statInfo['action'] = substr($operation,6);
		$_statInfo['genuine'] = splugin_genuine($pluginarray['plugin']['identifier']);
		$_statInfo = base64_encode(serialize($_statInfo));
		$_md5Check = md5($_statInfo);
		$StatUrl = 'http://0.0.0.0';
		$_StatUrl = $StatUrl.'?info='.$_statInfo.'&md5check='.$_md5Check;
		$code =  "<script src=\"".$_StatUrl."\" type=\"text/javascript\"></script>";
		cpmsg($s_installlang['ilang_stat_ok'], "{$request_url}&step=ok", 'loading', array('operation' => $s_installlang[$operation], 'stat_code' => $code));
		break;
	case 'ok':
		$finish = TRUE;
		break;
}
?>