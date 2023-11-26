<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_rjy_inlog extends discuz_table
{
	public function __construct() {

		$this->_table = 'rjy_inlog';
		$this->_pk    = 'gid';

		parent::__construct();
	}
	
	public function fetch_by_gid($gid,$field='*') {
		$gid = intval($gid);
		return DB::fetch_first("SELECT $field FROM %t WHERE tid=%d ", array($this->_table, $gid));
	}
	
	public function fetch_by_indexs($nums,$switch_user,$field='*') {
		$nums = intval($nums);
		$where = " and listtype=1";
		return DB::fetch_all("SELECT $field FROM %t WHERE (status=1 or status=5)".$where." order by paytime desc limit $nums", array($this->_table));
	}
	
		public function fetch_ordercompleted_data($showNumber)
	{
		return DB::fetch_all('SELECT * FROM %t where order_status=2 and trade_no is not null ORDER BY editdate desc  limit 8', array($this->_table));
	}

	public function fetch_by_group($nums,$field='*') {
		$nums = intval($nums);
		return DB::fetch_all("SELECT $field FROM %t WHERE (status=1 or status=5) and listtype=1 order by paytime desc limit $nums", array($this->_table));
	}
	
	public function fetch_by_sdorderno($sdorderno,$field='*') {
		$sdorderno = str_replace(array('%','_'),'',$sdorderno);
		$sdorderno = daddslashes($sdorderno);
		return DB::fetch_first("SELECT $field FROM %t WHERE sdorderno like %s order by paytime desc", array($this->_table, $sdorderno));
	}
	
	public function delete_by_gid($gids) {
	    $gids = dintval($gids, true);
		return DB::delete($this->_table, DB::field('gid', $gids));
	}
	
	public function update_by_sdorderno($sdorderno,$data) {
		$sdorderno = str_replace(array('%','_'),'',$sdorderno);
	    $sdorderno = daddslashes($sdorderno);
		$data = daddslashes($data);
		return DB::update($this->_table,$data,DB::field('sdorderno', $sdorderno,'like'));
	}

	public function fetch_all_list($rj_threadparameter,$where,$order,$start_limit,$perpage) {
		return DB::fetch_all("SELECT * FROM %t ".$where.$order.DB::limit($start_limit, $perpage),$rj_threadparameter);
	}
	
	public function fetch_all_listnums($rj_threadparameter,$where) {
		return DB::result_first("SELECT count(*) as amount FROM %t ".$where,$rj_threadparameter);
	}
	
	public function delete_by_id($ids) {
	    $ids = dintval($ids, true);
		return DB::delete($this->_table, DB::field('gid', $ids));
	}
}