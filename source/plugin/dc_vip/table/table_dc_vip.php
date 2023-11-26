<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_dc_vip extends discuz_table
{
	public function __construct() {
		$this->_table = 'dc_vip';
		$this->_pk    = 'uid';

		parent::__construct();
	}
	
	public function updaterange($limit = 0) {
		$t = strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table).' WHERE '.DB::field('uptime',$t,'<').' '.DB::limit(0, $limit), null, $this->_pk ? $this->_pk : '');
	}
	public function range($start = 0, $limit = 0, $sort = '') {
		if($sort) {
			$this->checkpk();
		}
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table).($sort ? ' ORDER BY '.DB::order('jointime', $sort) : '').DB::limit($start, $limit), null, $this->_pk ? $this->_pk : '');
	}
	public function gettop($type = 'new',$limit = 20){
		if($type=='new'){
			$order = DB::order('jointime', 'DESC');
		}else{
			$order = DB::order('growth', 'DESC');
		}
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table). ' WHERE '.DB::field('exptime',TIMESTAMP,'>').' ORDER BY '.$order.DB::limit(0, $limit), null, $this->_pk ? $this->_pk : '');
	}
}

?>