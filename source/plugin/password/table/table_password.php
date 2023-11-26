<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_password extends discuz_table {
	public function __construct() {

		$this->_table = 'password';
		$this->_pk = 'uid';

		parent::__construct();
	}
	/**
	 * 检查是否已设置安全密码
	 * @param  [int] $uid [用户ID]
	 * @return [bool]     [结果]
	 */
	function checkexists($uid) {
		$check = $this->fetch($uid);
		if ($check['passwd']) {
			return true;
		} else {
			return false;
		}

	}
	/**
	 * 校验密码
	 * @param  [int] $uid [用户ID]
	 * @param  [char] $password [密码]
	 * @param  [char] $plugin [插件标识]
	 * @return [int]     [结果]
	 */
	function check($uid, $password, $plugin) {
		global $_G;
		$user = $this->fetch($uid);
		if (!$user['passwd']) {
			return -1; //未设置安全密码
		}
		if (md5(md5(daddslashes($password)) . $user['passwd_hash']) != $user['passwd']) {
			$errorlog = dhtmlspecialchars(
				TIMESTAMP . "\t" .
				$_G['username'] . "(" . $_G['uid'] . ")\t" .
				preg_replace("/^(.{" . round(strlen($password) / 4) . "})(.+?)(.{" . round(strlen($password) / 6) . "})$/s", "\\1***\\3", $password) . "\t" .
				"plugin:" . $plugin . "-wrong\t" .
				$_G['username'] . "($_G[uid])\t" .
				$_G['clientip']);
			writelog('password', $errorlog);
			return -2; //旧密码不正确
		}
		$errorlog = dhtmlspecialchars(
			TIMESTAMP . "\t" .
			$_G['username'] . "(" . $_G['uid'] . ")\t" .
			preg_replace("/^(.{" . round(strlen($password) / 4) . "})(.+?)(.{" . round(strlen($password) / 6) . "})$/s", "\\1***\\3", $password) . "\t" .
			"plugin:" . $plugin . "-success\t" .
			$_G['username'] . "($_G[uid])\t" .
			$_G['clientip']);
		writelog('password', $errorlog);
		return 1; //成功
	}

	function fetch_order_by($sc = 'DESC', $page = 0, $num = 15, $by = 'dateline') {

		$page = dintval($page);
		$num = dintval($num);
		$now = ($page - 1) * $num;
		return DB::fetch_all("SELECT * FROM %t ORDER BY %i %i" . ($page ? DB::limit($now, $num) : ''), array($this->_table, $by, $sc));
	}
}
?>