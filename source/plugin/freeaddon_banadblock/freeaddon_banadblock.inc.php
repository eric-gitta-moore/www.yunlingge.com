<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: freeaddon_banadblock.inc.php 1845 2019-11-26 12:51:05Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if (!defined('IN_DISCUZ')) {
exit('Access Denied');
}
$splugin_setting = $_G['cache']['plugin']['freeaddon_banadblock'];#16497
$find = array('{username}', '{domain}', '{site_qq}');
$replace = array($_G['username'] ? dhtmlspecialchars($_G['username']) : '&#x6E38;&#x5BA2;', dhtmlspecialchars($_SERVER['HTTP_HOST']), ' <a href="http://wpa.qq.com/msgrd?v=3&uin='.$_G['setting']['site_qq'].'&menu=yes&from=discuz" target="_blank" title="QQ"><img src="static/image/common/site_qq.jpg" style="position: relative;top: 5px;" alt="QQ" /></a>');/*�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ*/
$splugin_setting['tips'] = str_replace($find, $replace, $splugin_setting['tips']);
if($splugin_setting['log']){
if($_G['uid']){
$log = C::t('#freeaddon_banadblock#freeaddon_banadblock_log')->fetch_by_search(array('uid' => $_G['uid']), array('dateline' => 'DESC'));
}else{
$log = C::t('#freeaddon_banadblock#freeaddon_banadblock_log')->fetch_by_search(array('useip' => $_G['clientip']), array('dateline' => 'DESC'));
}
if(empty($log) || $_G['timestamp'] - $log['dateline'] > 5){
$processname ='BANADBLOCK_'.ip2long($_G['clientip']);
if(!discuz_process::islocked($processname, 15)) {
$data = array(
		  	'uid' => $_G['uid'],
		  	'username' => $_G['username'],
		    'url' => $_GET['url'],
		    'useip' => $_G['clientip'],
		    'realip' => $_SERVER['REMOTE_ADDR'],
		    'dateline' => $_G['timestamp'],
		  );
C::t('#freeaddon_banadblock#freeaddon_banadblock_log')->insert($data, 1);#www_discuz_1314study_com
discuz_process::unlock($processname);
}//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ
}/*From www.1314study.com*/
}
include template('freeaddon_banadblock:tips');

//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: freeaddon_banadblock.inc.php 2305 2019-11-26 04:51:05Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��