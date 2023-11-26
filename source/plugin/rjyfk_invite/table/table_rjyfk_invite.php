<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class table_rjyfk_invite extends table_common_invite {
	public function fetch_all_by_paging($page, $count, $where, $url, $field = '*') {
		if (!is_numeric($page) || $page < 1) $page = 1;
		$data = array();
		$table = DB::table($this->_table);
		if ($where) $where = ' WHERE ' . $where;
		$sum = (int) DB::result_first('SELECT COUNT(*) AS sum FROM ' . $table . $where);
		$url && $data[] = multi($sum, $count, $page, $url, 0, 10, false, false, false);
		$limit = ' LIMIT ' . ($page - 1) * $count . ',' . $count;
		$data[] = DB::fetch_all('SELECT ' . $field . ' FROM ' . $table . $where . $limit);
		$data[] = $sum;
		return $data;
	}
	 public function  fetch_pay_orderid($orderid)
   {
		return DB::fetch_first('SELECT * FROM %t WHERE  orderid like %s', array($this->_table, $orderid));
	}
	
}