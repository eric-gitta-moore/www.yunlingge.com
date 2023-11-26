<?php

/**
 * 	[¡¾ÔÆÃ¨¡¿¶¶Òô½âÎöÊÓÆµ(ya_douyin)] (C)2019-2099 Powered by ÔÆÃ¨¹¤×÷ÊÒ.
 * 	Date: 2019-10-26 21:50
 *      File: douyin.class.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('base.class', 'plugin/ya_douyin/class');

class plugin_ya_douyin extends plugin_ya_douyin_base
{

    public function global_header()
    {
	if ($this->has_douyin) {
	    return $this->_get_header_mate();
	}
    }

    public function discuzcode($params)
    {
	if ($params['caller'] == 'discuzcode') {

	    global $_G;
	    list($message, $smileyoff, $bbcodeoff, $htmlon, $allowsmilies, $allowbbcode, $allowimgcode, $allowhtml, $jammer, $parsetype, $authorid, $allowmediacode, $pid, $lazyload, $pdateline, $first) = $params['param'];
	    $_G['discuzcodemessage'] = str_replace(array('&amp;'), array('&'), $_G['discuzcodemessage']);

	    C::import('douyin.func', 'plugin/ya_douyin/function');
	    if (strpos($_G['discuzcodemessage'], '[/flash]') !== FALSE) {
		$_G['discuzcodemessage'] = preg_replace_callback("/\[flash(=(\d+),(\d+))?\]\s*([^\[\<\r\n]+?)\s*\[\/flash\]/is", 'ydy_discuzcode_callback_parseflash_234', $_G['discuzcodemessage']);
	    }

	    if (strpos($_G['discuzcodemessage'], '[/media]') !== FALSE) {
		$_G['discuzcodemessage'] = preg_replace_callback("/\[media=([\w,]+)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/is", 'ydy_discuzcode_callback_parsemedia_12', $_G['discuzcodemessage']);
	    }
	    if (strpos($_G['discuzcodemessage'], '[/url]') !== FALSE) {
		$_G['discuzcodemessage'] = preg_replace_callback("/\[url(=1)*\]\s*([^\[\<\r\n]+?)\s*\[\/url\]/is", 'ydy_discuzcode_callback_video_1', $_G['discuzcodemessage']);

		$_G['discuzcodemessage'] = preg_replace_callback("/\[url=(https?){1}:\/\/([^\[\"']+?)\](.+?)\[\/url\]/i", 'ydy_discuzcode_callback_video_2', $_G['discuzcodemessage']);
	    }

	    if (strpos($_G['discuzcodemessage'], 'has_douyin') !== FALSE) {
		$this->has_douyin = true;
	    }
	}
    }

}

?>