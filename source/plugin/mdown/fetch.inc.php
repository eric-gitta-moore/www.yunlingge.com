<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__).'/class/env.class.php';
try {
    if(!$_G['uid']) {
        $login = mdown_env::get_siteurl()."/member.php?mod=logging&action=login&referto=".urlencode(mdown_env::get_request_url());
        dheader("Location: $login");
        exit();
    }
    $uid = $_G['uid'];
	$rscode = isset($_GET['rscode']) ? $_GET['rscode'] : '';
	$rscId = C::m('#mdown#mdown_authcode')->decodeID($rscode);
    $rsc = C::t("#mdown#mdown_resource")->getById($rscId);
    if (empty($rsc)) {
        throw new Exception(lang('plugin/mdown','resource_lost'));
    }
    if ($rsc["status"]!=1) {
        throw new Exception(lang('plugin/mdown','resource_offline'));
    }
    $extinfo = $_G["username"]."[uid:$uid] ".lang('plugin/mdown','downloaded_rsc')." (".$rsc["title"].") [id:$rscId]";
    $rd = C::t('#mdown#mdown_log')->getByUK($rscId, $uid);
    if (empty($rd)) {
        C::t('#mdown#mdown_log')->write($rscId,$rsc["title"],$rsc['credits'],$extinfo);
        C::t('#mdown#mdown_resource')->statDownNum($rscId); 
    }
    mdown_env::getlog()->trace($extinfo);
    $url = $rsc["url"];
    if (!preg_match("/^http/i", $url)) {
        $url = mdown_env::get_siteurl()."/".$url;
    }
	dheader("Location: ".$url);
	exit(0);
} catch (Exception $e) {
    $msg = $e->getMessage();
	showmessage($msg);
}