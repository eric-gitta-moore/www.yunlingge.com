<?php

/**
 *      $author: ³ËÁ¹ $
 */

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_avatarrefresh {

	public static $identifier = 'avatarrefresh';

	function __construct() {

	}

	function avatar($value){
		global $_G;
		list($uid, $size, $returnsrc, $static, $real, $ucenterurl) = $value['param'];
		static $staticavatar;
		if($staticavatar === null) {
			$staticavatar = $_G['setting']['avatarmethod'];
		}

		$ucenterurl = empty($ucenterurl) ? $_G['setting']['ucenterurl'] : $ucenterurl;
		$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
		$uid = abs(intval($uid));
		if(!$staticavatar && !$static) {
			$_G['hookavatar'] = $returnsrc ? $ucenterurl.'/avatar.php?uid='.$uid.'&size='.$size.($real ? '&type=real' : '').'&random='.TIMESTAMP : '<img src="'.$ucenterurl.'/avatar.php?uid='.$uid.'&size='.$size.($real ? '&type=real' : '').'&random='.TIMESTAMP.'" />';
		} else {
			$uid = sprintf("%09d", $uid);
			$dir1 = substr($uid, 0, 3);
			$dir2 = substr($uid, 3, 2);
			$dir3 = substr($uid, 5, 2);
			$file = $ucenterurl.'/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).($real ? '_real' : '').'_avatar_'.$size.'.jpg?t='.TIMESTAMP;
			$_G['hookavatar'] = $returnsrc ? $file : '<img src="'.$file.'" onerror="this.onerror=null;this.src=\''.$ucenterurl.'/images/noavatar_'.$size.'.gif\'" />';
		}
	}

}

?>