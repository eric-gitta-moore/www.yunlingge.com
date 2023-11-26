<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_study_diydown_log extends discuz_table {

	public function __construct() {
		$this->_table = 'study_diydown_log';
		$this->_pk = 'id';

		parent::__construct();
	}

	public function fetch_first_by_aid_uid($aid, $uid) {
		return DB::fetch_first('SELECT * FROM %t where aid=%d and uid=%d ORDER BY dateline DESC', array($this->_table, $aid, $uid));
	}
	
	public function fetch_first_by_aid_ip($aid, $ip) {
		return DB::fetch_first('SELECT * FROM %t where aid=%d and ip=%s ORDER BY dateline DESC', array($this->_table, $aid, $ip));
	}	
}
?>