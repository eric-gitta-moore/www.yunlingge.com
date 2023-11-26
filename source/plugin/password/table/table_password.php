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
	 * ����Ƿ������ð�ȫ����
	 * @param  [int] $uid [�û�ID]
	 * @return [bool]     [���]
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
	 * У������
	 * @param  [int] $uid [�û�ID]
	 * @param  [char] $password [����]
	 * @param  [char] $plugin [�����ʶ]
	 * @return [int]     [���]
	 */
	function check($uid, $password, $plugin) {
		global $_G;
		$user = $this->fetch($uid);
		if (!$user['passwd']) {
			return -1; //δ���ð�ȫ����
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
			return -2; //�����벻��ȷ
		}
		$errorlog = dhtmlspecialchars(
			TIMESTAMP . "\t" .
			$_G['username'] . "(" . $_G['uid'] . ")\t" .
			preg_replace("/^(.{" . round(strlen($password) / 4) . "})(.+?)(.{" . round(strlen($password) / 6) . "})$/s", "\\1***\\3", $password) . "\t" .
			"plugin:" . $plugin . "-success\t" .
			$_G['username'] . "($_G[uid])\t" .
			$_G['clientip']);
		writelog('password', $errorlog);
		return 1; //�ɹ�
	}

	function fetch_order_by($sc = 'DESC', $page = 0, $num = 15, $by = 'dateline') {

		$page = dintval($page);
		$num = dintval($num);
		$now = ($page - 1) * $num;
		return DB::fetch_all("SELECT * FROM %t ORDER BY %i %i" . ($page ? DB::limit($now, $num) : ''), array($this->_table, $by, $sc));
	}
}
?>