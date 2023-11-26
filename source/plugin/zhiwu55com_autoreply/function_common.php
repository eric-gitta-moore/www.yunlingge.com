<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
function zhiwu55com_autoreply_appid($returnType=1)
{
	global $_G;
	$appid = '';
	$randNum=rand(1,20);
	if($returnType==1 && !empty($_COOKIE['zhiwu55com_autoreply_appid']) && $randNum!=5)
	{
		return $_COOKIE['zhiwu55com_autoreply_appid'];
	}
	$dataArr = array();
	$dataArr['plugin'] = 'zhiwu55com_autoreply';
	$siteurl = str_replace(array('https','http'),'',$_G['siteurl']);
	$dataArr['siteurl'] = $siteurl;
	$dataArr['savepath'] = __DIR__;
	$php_uname = php_uname();
	$dataArr['system_info'] = $php_uname;
	$php_uname = preg_replace('/[\s\W\d]+/','',$php_uname);
	$php_uname = substr($php_uname,0,20);
	$SERVER_SOFTWARE = $_SERVER['SERVER_SOFTWARE'];
	$dataArr['http_server'] = $SERVER_SOFTWARE;	
	$SERVER_SOFTWARE = preg_replace('/[\s\W\d]+/','',$SERVER_SOFTWARE);
	$SERVER_SOFTWARE = substr($SERVER_SOFTWARE,0,20);	
	$returnStr = serialize($dataArr);
	$returnStr=base64_encode($returnStr);
	$appid = $dataArr['plugin'].$dataArr['siteurl'].$dataArr['savepath'].$php_uname.$SERVER_SOFTWARE;
	$appid = md5($appid);
	setcookie('zhiwu55com_autoreply_appid',$appid,time()+86400);
	$remoteUrl = array();
	$remoteUrl['hzw_appid_data'] = $returnStr;
	$remoteUrl['hzw_appid'] = $appid;
	$remoteUrl['SN'] = '2020021808y124Z64ryz';
	$remoteUrl['RevisionID'] = '85249';
	$remoteUrl['RevisionDateline'] = '1563640652';
	$remoteUrl['dz_SiteUrl'] = 'http://www.yun-ling.cn/';
	$remoteUrl['ClientUrl'] = 'http://www.yun-ling.cn/';
	$remoteUrl['SiteID'] = '60DF4F84-4325-8E2C-A68B-78184AFF8D9A';
	$remoteUrl['QQID'] = '87810FE7-AAAE-55ED-A938-30D35972DF05';
	$fetchUrl = "http://www.zhiwu55.com/authorization/zhiwu55com_autoreply_empowerment.php";
	dfsockopen($fetchUrl, 0, $remoteUrl);
	if($returnType==1)
	{
		return $appid;

	} else {

		return $returnStr;
	}

}