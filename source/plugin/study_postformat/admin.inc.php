<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: admin.inc.php 4418 2019-12-26 16:10:12
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
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
require_once ('pluginvar.func.php');
loadcache('plugin');# From Www.1314Study.com
$splugin_setting = $_G['cache']['plugin']['study_postformat'];
$splugin_lang = lang('plugin/study_postformat');
if (submitcheck("forumsubmit")) {
$subject = $_POST['subject'];# 1_3.1.4.ѧ.ϰ.��
if(is_array($subject)){
foreach ($subject as $key => $var) {
$postformat_cache[$key]["subject"] = daddslashes($var);
}//  1314ѧϰ�W
}
$message = $_POST['message'];
if(is_array($message)){
foreach ($message as $key => $var) {
$postformat_cache[$key]["message"] = daddslashes($var);
}
}
$replymessage = $_POST['replymessage'];
if(is_array($replymessage)){
foreach ($replymessage as $key => $var) {
$postformat_cache[$key]["replymessage"] = daddslashes($var);
}
}
s_writetocache('study_postformat_fids', getcachevars(array('postformat_cache' => $postformat_cache)));
cpmsg('&#x53C2;&#x6570;&#x8BBE;&#x7F6E;&#x6210;&#x529F;', "action=plugins&operation=config&do=" . $plugin["pluginid"] . "&identifier=" . $plugin["identifier"] . "&pmod=admin", 'succeed');
} else {
$infids = list_array(unserialize($splugin_setting['study_fids']));
if (empty($infids)) {
cpmsg('&#x672A;&#x8BBE;&#x7F6E;&#x4F7F;&#x7528;&#x7684;&#x7248;&#x5757;');
}#��Ȩ��www.1314Study.com
$query = DB::query("SELECT fid, type, name FROM " . DB::table("forum_forum") . " WHERE fid IN($infids)");
while ($datarow = DB::fetch($query)) {
        $datarow['classr'] = array();
        foreach ($classlist as $var) {
            if ($var['fid'] == $datarow['fid']) {
                $datarow['classr'][] = $var;
            }
        }
        $forlist[] = $datarow;
    }
    if (file_exists(DISCUZ_ROOT . './data/cache/cache_study_postformat_fids.php')) {
        @require DISCUZ_ROOT . './data/cache/cache_study_postformat_fids.php';
    }
    showformheader("plugins&operation=config&do=" . $plugin["pluginid"] . "&identifier=" . $plugin["identifier"] . "&pmod=admin");
    showtableheader('&#x7248;&#x5757;&#x53C2;&#x6570;&#x8BBE;&#x7F6E;');
    showsubtitle(array('&#x7248;&#x5757;&#x540D;&#x79F0;', '&#x53D1;&#x5E16;&#x6807;&#x9898;&#x6A21;&#x677F;', '&#x53D1;&#x5E16;&#x5185;&#x5BB9;&#x6A21;&#x677F;', '&#x56DE;&#x5E16;&#x5185;&#x5BB9;&#x6A21;&#x677F;'));
    foreach ($forlist as $var) {
        $tablestr = array();
        $tablestr[0] = $var['name'].'<span class="lightfont">(fid:'.$var['fid'].')</span>';
        $tablestr[1] = '<textarea rows="6" name="subject[' . $var['fid'] . ']" cols="25">'.dhtmlspecialchars($postformat_cache[$var['fid']]['subject']).'</textarea>';
        $tablestr[2] = '<textarea rows="6" name="message[' . $var['fid'] . ']" cols="25">'.dhtmlspecialchars($postformat_cache[$var['fid']]['message']).'</textarea>';
        $tablestr[3] = '<textarea rows="6" name="replymessage[' . $var['fid'] . ']" cols="25">'.dhtmlspecialchars($postformat_cache[$var['fid']]['replymessage']).'</textarea>';

        showtablerow('', '', $tablestr);
    }
    showsubmit('forumsubmit', 'submit', '', '');
    showtablefooter();
    showformfooter();
}

function list_array($fids_show) {
    $result = '';
    if (is_array($fids_show)) {
        $i = '1314';
        foreach ($fids_show as $id => $fid) {
        		$fid = intval($fid);
            if (!empty($fid) && $fid) {
                if ($i == '1314') {
                    $result .= $fid;
                    $i = 'DIY';
                } else {
                    $result .= ',' . $fid;
                }
            }
        }
    }
    return $result;
}

function s_writetocache($script, $cachedata, $prefix = 'cache_') {
    global $_G;
    $dir = DISCUZ_ROOT . './data/cache/';
    if (!is_dir($dir)) {
        @mkdir($dir, 0777);
    }
    if ($fp = @fopen("$dir$prefix$script.php", 'wb')) {
        fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: " . md5($prefix . $script . '.php' . $cachedata . $_G['config']['security']['authkey']) . "\n\n " . 'if(!defined(\'IN_DISCUZ\')) {exit(\'Access Denied Powered by www.1314study.com http://www.yun-ling.cn/\');}' . "\n\n$cachedata?>");
        fclose($fp);
    } else {
        exit('Can not write to cache files, please check directory ./data/ and ./data/cache/ .');
    }
}

