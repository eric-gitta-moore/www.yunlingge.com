<?php

/**
 *      [Caogen8!] (C)2014-2018 Www.Caogen8.co.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_core.php 37712 2018-03-15 08:30:42Z ²Ý-¸ù-°É $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


function auto_charset($fContents, $to='gbk', $from='utf-8') {
	$from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
	$to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
	if(strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
		return $fContents;
	}
	if(is_string($fContents)) {
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($fContents, $to, $from);
		}elseif(function_exists('iconv')) {
			return iconv($from, $to, $fContents);
		}else{
			return $fContents;
		}
	}elseif(is_array($fContents)) {
		foreach ($fContents as $key => $val) {
			$_key = auto_charset($key, $from, $to);
			$fContents[$_key] = auto_charset($val, $from, $to);
			if ($key != $_key) unset($fContents[$key]);
		}
		return $fContents;
	}else{
		return $fContents;
	}
}

function auto_charset_u($fContents, $from='gbk', $to='utf-8') {
	$from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
	$to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
	if(strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
		return $fContents;
	}
	if(is_string($fContents)) {
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($fContents, $to, $from);
		}elseif(function_exists('iconv')) {
			return iconv($from, $to, $fContents);
		}else{
			return $fContents;
		}
	}elseif(is_array($fContents)) {
		foreach ($fContents as $key => $val) {
			$_key = auto_charset($key, $from, $to);
			$fContents[$_key] = auto_charset($val, $from, $to);
			if ($key != $_key) unset($fContents[$key]);
		}
		return $fContents;
	}else{
		return $fContents;
	}
}


function plugin_zhuzhu_taobao_rewriteoutput($type, $returntype)
{
    global $_G;

    $fextra = '';

    //taobao
    if($type == 'taobao') {
        list(,,, $extra) = func_get_args();
        $r = array();
    }
    if($type == 'taobao-tbk') {
        list(,,, $extra) = func_get_args();
        $r = array();
    }
    if($type == 'taobao-tbk-9k9') {
        list(,,, $extra) = func_get_args();
        $r = array();
    }
    if($type == 'taobao-tbk-cat') {
        list(,,, $cat, $extra) = func_get_args();
        $r = array(
            '{cat}' => $cat ? $cat : 0,
        );
    }
    if($type == 'taobao-tqg') {
        list(,,, $extra) = func_get_args();
        $r = array();
    }
    if($type == 'taobao-view') {
        list(,,, $num_iid, $extra) = func_get_args();
        $r = array(
            '{num_iid}' => $num_iid ? $num_iid : 0,
        );
    }
    if($type == 'taobao-quan') {
        list(,,, $extra) = func_get_args();
        $r = array();
    }
    if($type == 'taobao-quan-cat') {
        list(,,, $category_id, $extra) = func_get_args();
        $r = array(
            '{category_id}' => $category_id ? $category_id : 0,
        );
    }
    if($type == 'taobao-uatm') {
        list(,,, $extra) = func_get_args();
        $r = array();
    }
    if($type == 'taobao-uatm-cat') {
        list(,,, $favorites_id, $extra) = func_get_args();
        $r = array(
            '{favorites_id}' => $favorites_id ? $favorites_id : 0,
        );
    }
    if($type == 'taobao-tbrand-view') {
        list(,,, $brand_id, $extra) = func_get_args();
        $r = array(
            '{brand_id}' => $brand_id ? $brand_id : 0,
        );
    }

    $zhuzhu_rewrite = dunserialize($_G['setting']['zhuzhu_taobao']);
    $href = str_replace(array_keys($r), $r, $zhuzhu_rewrite[$type]['rule']).$fextra;
    if(!$returntype) {
        return '<a href="'.$href.'"'.(!empty($extra) ? stripslashes($extra) : '').'>';
    } else {
        return $href;
    }
}

function autowrap($fontsize, $angle, $fontface, $string, $width) {
	$content = "";
	preg_match_all("/./u", $string, $arr);
	$letter = $arr[0];
	foreach ($letter as $l) {
		$teststr = $content." ".$l;
		$testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
		if (($testbox[2] > $width) && ($content !== "")) {
			$content .= PHP_EOL;
		}
		$content .= $l;
	}
	return $content;
}