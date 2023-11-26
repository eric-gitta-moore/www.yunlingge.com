<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_adv_count.php  2019-06  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ')){
exit('Acccess Denied');
} 
class table_adv_count extends discuz_table{
	public function __construct(){
		$this->_table = 'plugin_adv_count';
		$this->_pk    = 'id';
		parent::__construct();
	}
	public function update_idurl($data, $advid,$url) {
	
	    return DB::update($this->_table, $data, array('advid' => $advid,'url'=>$url));
	}
	public function update($data, $id) {
	
	    return DB::update($this->_table, $data, array('id' => $id));
	}
	
	public function fetch_adv($advid,$url){
	    return DB::fetch_first('SELECT * FROM %t WHERE advid=%d and url=%s',array($this->table,$advid,$url));
	}
	
	public function fetch_adm($start,$limit){
	    return DB::fetch_all('SELECT * FROM  %t order by modtime desc limit %d,%d',array($this->table,$start,$limit));
	}
	

}
?>