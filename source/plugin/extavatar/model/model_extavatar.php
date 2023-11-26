<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class model_extavatar
{
	private $_extavatar_setting;
	public function __construct() {
		$this->_extavatar_setting = C::m('#extavatar#extavatar_setting')->get();
	}
	
	public function avatar(array &$param) {
		if (!isset($param['param'])) return;
		$params = &$param['param'];
		if (!isset($params[0])) return;
		$uid = $params[0];
		$size = (isset($params[1]) && $params[1]!='') ? $params[1] : 'middle';
		$returnsrc = (isset($params[2]) && $params[2]==1) ? TRUE : FALSE;
		if ($this->_extavatar_setting['scope']==1 && !$this->is_using_default_avatar($uid)) {
			return;
		}
		$this->_avatar($uid,$size,$returnsrc);
	}
	
	private function _avatar($uid, $size, $returnsrc) {
		global $_G;
		$imgurl = '';
		switch (intval($this->_extavatar_setting['strategy'])) {
			case 2: $imgurl = $this->gen_avatar_imgurl($uid); break;
			default: $imgurl = $this->random_avatar_imgurl($uid,$size); break;
		}
		if ($imgurl!='') {
			$_G['hookavatar'] = $returnsrc ? $imgurl : '<img src="'.$imgurl.'">';
		}
	}
	
	private function gen_avatar_imgurl($uid) {
		return extavatar_env::get_siteurl()."/plugin.php?id=extavatar&uid=$uid";
	}
	private function random_avatar_imgurl($uid,$size) {
		$res = C::t('#extavatar#extavatar')->getAvatarByUid($uid);
		if (empty($res)) return '';
		$imgurl = isset($res[$size]) ? $res[$size] : $res['middle'];
		$imgurl = extavatar_env::get_siteurl()."/".$imgurl;
		return $imgurl;
	}
	private function is_using_default_avatar($uid) {
		global $_G;
		$uid = sprintf("%09d", $uid);
		$dir1 = substr($uid, 0, 3);
		$dir2 = substr($uid, 3, 2);
		$dir3 = substr($uid, 5, 2);
		$arr = array('small','middle','big');
		$avatarpath = DISCUZ_ROOT."/uc_server/data/avatar/";
		foreach ($arr as $size) {
			$file = $avatarpath.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).'_avatar_'.$size.'.jpg';
			if (is_file($file)) {
				return false;
			}
		}
		return true;
	}
}
?>