<?php

/**
 *      $author: ³ËÁ¹ $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_vipvideo_record extends discuz_table {

	public function __construct() {
		$this->_table = 'plugin_vipvideo_record';
		$this->_pk = 'id';

		parent::__construct();
	}

	public function count_by_search_where($wherearr) {
		$wheresql = empty($wherearr) ? '' : implode(' AND ', $wherearr);
		return DB::result_first('SELECT COUNT(*) FROM '.DB::table($this->_table).($wheresql ? ' WHERE '.$wheresql : ''));
	}

	public function fetch_all_by_search_where($wherearr, $ordersql = '', $start = 0, $limit = 0) {
		$wheresql = empty($wherearr) ? '' : implode(' AND ', $wherearr);
		return DB::fetch_all('SELECT * FROM '.DB::table($this->_table).($wheresql ? ' WHERE '.$wheresql : '').' '.$ordersql.DB::limit($start, $limit), null, 'id');
	}

	public function fetch_by_id($id) {
		return DB::fetch_first('SELECT * FROM %t WHERE id=%d', array($this->_table, $id));
	}

	public function update_by_id($id, $data) {
		if(($id = dintval($id, true)) && $data && is_array($data)) {
			DB::update($this->_table, $data, DB::field($this->_pk, $id), true);
		}
	}

	public function delete_by_id($ids) {
		if(($ids = dintval((array)$ids, true))) {
			DB::query('DELETE FROM %t WHERE id IN(%n)', array($this->_table, $ids), false, true);
		}
	}

}