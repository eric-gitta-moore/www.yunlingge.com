<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class model_mdown_authcode
{
	private $_dekey = '28db89eba2f387c312e78d9aef1caa3b';
	public function decodeID($str)
	{
		$res = array (
			'uid' => 0,
			'id' => 0,
		);
		$str = rawurldecode($str);
		$s = authcode($str,'DECODE',$this->_dekey);
		list($uid,$id,$tm) = explode('_',$s);
		$res['uid'] = intval($uid);
		$res['id']  = intval($id);
		$res['tm']  = $tm;
		return $res['id'];
	}
	public function encodeID($id)
	{
		global $_G;
		$str = $_G['uid']."_".$id."_".time();
		return rawurlencode(authcode($str,'ENCODE',$this->_dekey));
	}
}
?>