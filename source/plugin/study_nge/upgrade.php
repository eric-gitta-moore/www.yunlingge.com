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
CREATE TABLE IF NOT EXISTS `cdb_study_nge_recpost` (
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
		$StatUri = 'http'.($_G['isHTTPS'] ? 's' : '').'://0.0.0.0';
		$_StatUrl = $StatUrl.'?info='.$_statInfo.'&md5check='.$_md5Check;
		$code =  "<script src=\"".$_StatUrl."\" type=\"text/javascript\"></script>";
		cpmsg($s_installlang['ilang_stat_ok'], "{$request_url}&step=addon", 'loading', array('operation' => $s_installlang[$operation], 'stat_code' => $code));
		break;
	case 'addon':
		//$available = dfsockopen('http://addon.1314study.com/api/available.php?siteurl='.rawurlencode($_G['siteurl']).'&identifier='.$identifier, 0, '', '', false, '', 5);
		if($available == 'succeed'||true){
			$_statInfo = array();
			$_statInfo['pluginName'] = $pluginarray['plugin']['identifier'];
			$_statInfo['bbsVersion'] = DISCUZ_VERSION;
			$_statInfo['bbsUrl'] = $_G['siteurl'];
			$_statInfo['action'] = str_replace('plugin', '', $operation);
			$_statInfo['nextUrl'] = ADMINSCRIPT.'?'.$request_url;
			$_statInfo = base64_encode(serialize($_statInfo));
			$_md5Check = md5($_statInfo);
			$StatUrl = 'http'.($_G['isHTTPS'] ? 's' : '').'://addon.1314study.com/api/outer_addon.php';
			$_StatUrl = $StatUrl.'?type=js&info='.$_statInfo.'&md5check='.$_md5Check;
			echo '<script type="text/javascript">location.href="'.$_StatUrl.'";</script>';
		}else{
			echo '<script type="text/javascript">location.href="'.$_G['siteurl'].ADMINSCRIPT.'?'.$request_url.'&step=ok";</script>';
		}
		splugin_updatecache($pluginarray['plugin']['identifier']);
		break;
	case 'ok':
		$finish = TRUE;
		break;
}