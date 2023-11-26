<?php

/**
 * 维清 [ Discuz!应用专家，深圳市维清互联科技有限公司旗下Discuz!开发团队 ]
 *
 * Copyright (c) 2011-2099 http://www.wikin.cn All rights reserved.
 *
 * Author: wikin <wikin@wikin.cn>
 *
 * $Id: check.php 2015-5-29 20:38:48Z $
 */
 
define('STATURL', dfsockopen('http://wikinapi.sinaapp.com/'));

$params = array();

$params['i_SN'] = '2020022013Xs94X9ocQs';
$params['i_RevisionID'] = '52056';
$params['i_RevisionDateline'] = '1578837405';
$params['i_SiteUrl'] = 'http://www.yun-ling.cn/';
$params['i_ClientUrl'] = 'http://www.yunlingge.com/';
$params['i_SiteID'] = '60DF4F84-4325-8E2C-A68B-78184AFF8D9A';
$params['i_QQID'] = '87810FE7-AAAE-55ED-A938-30D35972DF05';

include_once DISCUZ_ROOT . './source/discuz_version.php';
$params['s_identifier'] = 'wq_editor';
$params['s_pluginversion'] = '2.0';
$params['s_siteversion'] = DISCUZ_VERSION;
$params['s_siterelease'] = DISCUZ_RELEASE;
$params['s_timestamp'] = TIMESTAMP;
$params['s_nowurl'] = $_G['siteurl'];
$bbname = CHARSET == 'gbk' ? $_G['setting']['bbname'] : iconv('GBK', 'UTF-8', $_G['setting']['bbname']);
$params['s_bbname'] = base64_encode($bbname);
$params['s_site_qq'] = $_G['setting']['site_qq'];
$params['s_adminemail'] = $_G['setting']['adminemail'];

ksort($params);
$paramsbase = base64_encode(serialize($params));
$md5hash = md5($paramsbase);
?>
