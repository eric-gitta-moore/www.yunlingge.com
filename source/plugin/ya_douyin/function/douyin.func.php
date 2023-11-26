<?php

/**
 * 	[°æ‘∆√®°ø∂∂“ÙΩ‚Œˆ ”∆µ(ya_douyin)] (C)2019-2099 Powered by ‘∆√®π§◊˜ “.
 * 	Date: 2019-10-26 21:57
 *      File: douying.func.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function ydy_discuzcode_callback_video_1($matches)
{
    return ydy_parseflv($matches[2]);
}

function ydy_discuzcode_callback_video_2($matches)
{
    return ydy_parseflv($matches[3]);
}

function ydy_discuzcode_callback_parseflash_234($matches)
{
    return ydy_parseflash($matches[2], $matches[3], $matches[4]);
}

function ydy_parseflash($w, $h, $url)
{
    $w = !$w ? 500 : $w;
    $h = !$h ? 375 : $h;

    return '[media=x,' . $w . ',' . $h . ']' . $url . '[/media]';
}

function ydy_discuzcode_callback_parsemedia_12($matches)
{
    return ydy_parsemedia($matches[1], $matches[2]);
}

function ydy_parsemedia($params, $url)
{
    $params = explode(',', $params);
    $width = intval($params[1]) > 500 ? '500px' : intval($params[1]) . 'px';
    $height = intval($params[2]) > 375 ? '375px' : intval($params[2]) . 'px';

    $url = addslashes($url);
    if (!in_array(strtolower(substr($url, 0, 6)), array('http:/', 'https:', 'ftp://', 'rtsp:/', 'mms://')) && !preg_match('/^static\//', $url) && !preg_match('/^data\//', $url)) {
	return ydy_parseflash($width, $height, $url);
    }

    if ($flv = ydy_parseflv($url, $width, $height)) {
	return $flv;
    }
}

/**
 *  ”∆µΩ‚Œˆ
 * @param type $url
 * @param type $width
 * @param type $height
 * @return string
 */
function ydy_parseflv($url, $width = '500px', $height = '375px')
{
    global $_G;

    if (empty($url)) {
	return '';
    }

    $width = $width ? $width : '500px';
    $height = $height ? $height : '375px';
    if ($_G['mobile']) {
	$width = '100%';
	$height = '100%';
    }

    if (strpos($_G['discuzcodemessage'], 'douyin.com') !== FALSE) {
		$content = diconv(ydy_curl($url, 1), 'utf-8', CHARSE);
		preg_match('/theVideo" class="video-player" src="(.*?)"/is', $content, $match);
		$_url = str_replace('&amp;', "&", $match[1]);
	
		$content = ydy_curl($_url, 0);
		preg_match('#<a href="(.*?)">#', $content, $match);
	
		if (count($match) >= 1) {
		    $arr = explode("//", $match[1]);
		    if (!empty($arr)) {
			$url = str_replace('&amp;', "&", $arr[1]);
			if (!function_exists('ydy_get_video')) {
			    include template('ya_douyin:module');
			}
			return ydy_get_video($url, $width, $height);
		    }
		}
    }
    else {
    	
    	//return $url;
    }
    return ydy_parseflash($width, $height, $url);
}

function ydy_curl($url, $foll = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5376e Safari/8536.25"]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $foll);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
