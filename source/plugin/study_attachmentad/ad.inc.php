<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: ad.inc.php 1254 2019-11-26 13:08:18Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
require_once libfile('function/attachment');
$lang = lang('plugin/study_attachmentad');#11364
list($aid) = explode('|', base64_decode($_G['gp_aid']));
$aid = intval( $aid );
$url = $_G['siteurl']."forum.php?mod=attachment&aid=".$_G['gp_aid'];
$attinfo = DB::fetch_first("SELECT tid,downloads FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
if($attinfo[tid]){
$file_info = DB::fetch_first("SELECT * FROM ".DB::table(getattachtablebytid($attinfo[tid]))." WHERE aid='$aid'");
$file_infos['filename'] = $file_info['filename'];#From www.1314study.com
$file_infos['filesize'] = sizecount($file_info['filesize']).'<br>';
$file_infos['dateline'] = gmdate("Y-m-d" , $file_info['dateline'] + $timeoffset * 3600 ).'<br>';/*1000*/
$file_infos['downloads'] = $attinfo['downloads'].'<br>';
$file_infos['attachtype'] = attachtype(strtolower(fileext($file_info['filename']))."\t".$file_info['filetype']);
}/*From www.1314study.com*/
$S_a = $_G['cache']['plugin']['study_attachmentad'];/*1.3.1.4.ѧ.ϰ.��*/
$top_px = $S_a[top_px] ? $S_a[top_px] :'10';
$bottom_px = $S_a[bottom_px] ? $S_a[bottom_px] :'10';/*www_discuz_1314study_com*/
include template("study_attachmentad:ad");


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: ad.inc.php 1696 2019-11-26 05:08:18Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��