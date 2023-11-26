<?php

/**
 *      $author: ณหมน $
 */

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_discuzcodeurl {

	public static $identifier = 'discuzcodeurl';

	function __construct() {
		global $_G;
		$setconfig = $_G['cache']['plugin'][self::$identifier];
		if($setconfig['url_pre']){
			$preArr = array();
			foreach(explode("\n", $setconfig['url_pre']) as $key => $option) {
				$option = trim($option);
				if($option){
					$preArr[] = $option;
				}
			}
			$setconfig['url_pre'] = implode("|",$preArr);
		}
		$this->setconfig = $setconfig;
	}

	function discuzcode($value){
		global $_G;
		$setconfig = $this->setconfig;
		list($message, $smileyoff, $bbcodeoff, $htmlon, $allowsmilies, $allowbbcode, $allowimgcode, $allowhtml, $jammer, $parsetype, $authorid, $allowmediacode, $pid, $lazyload, $pdateline, $first) = $value['param'];
		if($value['caller'] == 'discuzcode') {
			if(!$bbcodeoff && $allowbbcode) {
				if($setconfig['url_pre'] && strpos($_G['discuzcodemessage'], '[/url]') !== FALSE) {
					$_G['discuzcodemessage'] = preg_replace_callback("/\[url(=((".$setconfig['url_pre']."){1})([^\r\n\[\"']+?))?\](.+?)\[\/url\]/is", 'discuzcode_callback_parseurl_152', $_G['discuzcodemessage']);
				}
			}
		}
	}

}

?>