<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: freeaddon_editposttime.inc.php 1865 2019-11-26 12:52:31Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
$splugin_setting = $_G['cache']['plugin']['freeaddon_editposttime'];/*1314ѧϰ��*/
$splugin_lang = lang('plugin/freeaddon_editposttime');/*1.3.1.4.ѧ.ϰ.��*/
$study_fids = unserialize($splugin_setting['study_fids']);
$study_gids = unserialize($splugin_setting['study_gids']);/*From www.1314study.com*/
$tid = intval($_GET['tid']);//From www.1314study.com
$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid='$tid'");
if($thread['authorid'] != $_G['uid'] && !$splugin_setting['nomy_radio']){
showmessage('&#x975E;&#x6CD5;&#x64CD;&#x4F5C;');
}elseif(freeaddon_editposttime_list_array($study_fids) && !in_array($thread['fid'], $study_fids)){
showmessage('&#x975E;&#x6CD5;&#x64CD;&#x4F5C;');
}elseif(freeaddon_editposttime_list_array($study_gids) && !in_array($_G['groupid'], $study_gids)){
showmessage('&#x975E;&#x6CD5;&#x64CD;&#x4F5C;');//17264
}/*��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ*/
if(submitcheck('submit')){
$dateline = intval(strtotime($_GET['dateline']));
if($dateline){
DB::update('forum_thread', array('dateline'=> $dateline), "tid='$tid'");#From www.1314study.com
DB::update('forum_post', array('dateline'=> $dateline), "tid='$tid' AND first=1");
}
showmessage('&#x4FEE;&#x6539;&#x6210;&#x529F;', 'forum.php?mod=viewthread&tid='.$tid);
}	else{
$thread['dateline'] = dgmdate($thread['dateline']);/*28364*/
include template('freeaddon_editposttime:editposttime');
}
function freeaddon_editposttime_list_array($fids_show) {
$result = '';
if(is_array($fids_show)) {
$i = '1314';
foreach ($fids_show as $id => $fid) {
if(!empty($fid) && $fid) {
if($i == '1314') {
$result .= $fid;
$i = 'DIY';
}else {
$result .= ',' . $fid;
}
}
}
}/*From www.1314study.com*/
return $result;
}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: freeaddon_editposttime.inc.php 2327 2019-11-26 04:52:31Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��