<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: freeaddon_randomthread.inc.php 1882 2020-01-09 11:22:42Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_DISCUZ')) {
exit('2020012607P4fFJ4U80g');
}
$splugin_setting = $_G['cache']['plugin']['freeaddon_randomthread'];#www_discuz_1314study_com
$splugin_lang = lang('plugin/freeaddon_randomthread');
$where = '';/*��Ȩ��www.1314study.com*/
$starttime = strtotime($splugin_setting['starttime']);
$where .= $starttime ? " dateline > $starttime " : '';
$infids = freeaddon_randomthread_list_array(unserialize($splugin_setting['study_fids']));#�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ
$where .= $infids ? ($where ? ' AND ' : '')." fid in($infids) " : '';
$where .= $where ? ' AND displayorder >= 0' : ' displayorder >= 0 ';
if($starttime){
$starttid = DB::result_first("SELECT tid FROM ".DB::table('forum_thread')." WHERE $where ORDER BY tid ASC limit 1");#1.3.1.4.ѧ.ϰ.��
$starttid = max($starttid - 1, 0);
}else{
$starttid = 0;	
}
$endtid = DB::result_first("SELECT tid FROM ".DB::table('forum_thread')." WHERE $where ORDER BY tid DESC limit 1");
$endtid = max($endtid - 1, 0);
$tid = max(rand($starttid, $endtid), 0);//��Ȩ��www.1314study.com
$where = $where ? ' AND '.$where : '';#www_discuz_1314study_com
$tid = DB::result_first("SELECT tid FROM ".DB::table('forum_thread')." WHERE tid > '$tid' $where ORDER BY tid ASC limit 1");
dheader("Location: forum.php?mod=viewthread&tid=$tid");
function freeaddon_randomthread_list_array($fids_show) {
$result = '';#3817
if(is_array($fids_show)) {
$i = '1314';
foreach ($fids_show as $id => $fid) {
if(!empty($fid) && $fid) {
if($i == '1314') {
$result .= $fid;
$i = 'DIY';//��Ȩ��www.1314study.com
}else {
$result .= ',' . $fid;
}
}//www_discuz_1314study_com
}#��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
}//��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
return $result;
}


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: freeaddon_randomthread.inc.php 2344 2020-01-09 03:22:42Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��