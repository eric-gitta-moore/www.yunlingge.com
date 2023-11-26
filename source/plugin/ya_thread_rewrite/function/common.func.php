<?php

/**
 * 	[【云猫】主题URL静态优化(ya_thread_rewrite)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-10-3 21:35
 *      File: common.func.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function ytr_lang($key)
{
    return lang('plugin/ya_thread_rewrite', $key);
}

function ytr_getmd5($md5file)
{
    if (preg_match('/^[a-z0-9_\.]+$/i', $md5file) && file_exists(DISCUZ_ROOT . './data/addonmd5/' . $md5file . '.plugin.xml')) {
	require_once libfile('class/xml');
	$xml = implode('', @file(DISCUZ_ROOT . './data/addonmd5/' . $md5file . '.plugin.xml'));
	$array = xml2array($xml);
	return $array;
    } else {
	return false;
    }
}

function ytr_getsign($plugin)
{
    global $_G;
    
    $md5_arr = ytr_getmd5($plugin);
    if ($md5_arr === false) {
	ytr_rmdir(realpath(DISCUZ_ROOT . "/source/plugin/{$plugin}"));
	return false;
    }

    if (!isset($_G['setting']["{$plugin}_{$md5_arr['RevisionID']}"]) || empty($_G['setting']["{$plugin}_{$md5_arr['RevisionID']}"])) {
	ytr_rmdir(realpath(DISCUZ_ROOT . "/source/plugin/{$plugin}"));
	return false;
    }
    $md5 = is_array($_G['setting']["{$plugin}_{$md5_arr['RevisionID']}"]) ? $_G['setting']["{$plugin}_{$md5_arr['RevisionID']}"] : dunserialize($_G['setting']["{$plugin}_{$md5_arr['RevisionID']}"]);

    $params = array();
    $params['ID'] = $md5_arr['ID'];
    $params['RevisionID'] = $md5_arr['RevisionID'];
    $params['SN'] = $md5_arr['SN'];
    $params['RevisionDateline'] = $md5_arr['RevisionDateline'];
    ksort($params);
    $paramsbase = base64_encode(serialize($params));
    $sign = md5($paramsbase . $md5['key']);

    if ($md5['sign'] == $sign) {
	return true;
    }
    ytr_rmdir(realpath(DISCUZ_ROOT . "/source/plugin/{$plugin}"));
    return false;
}

function ytr_rmdir($dir)
{
    if ($dir === '.' || $dir === '..' || strpos($dir, '..') !== false) {
	return false;
    }
    if (substr($dir, -1) === "/") {
	$dir = substr($dir, 0, -1);
    }
    if (!file_exists($dir) || !is_dir($dir)) {
	return false;
    } elseif (!is_readable($dir)) {
	return false;
    } else {
	if (($dirobj = dir($dir))) {
	    while (false !== ($file = $dirobj->read())) {
		if ($file != "." && $file != "..") {
		    $path = $dirobj->path . "/" . $file;
		    if (is_dir($path)) {
			ytr_rmdir($path);
		    } else {
			if (is_file($path)) {
			    file_put_contents($path, '');
			    @unlink($path);
			}
		    }
		}
	    }
	    $dirobj->close();
	}
	rmdir($dir);
	return true;
    }
    return false;
}
