<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_xinxiu_network_log extends discuz_table
{

    public function __construct() {
        $this->_table = 'xinxiu_network_log';
        $this->_pk    = 'id';
        parent::__construct();
    }
    public function getbyorderid($orderid){
        return DB::fetch_first('SELECT * FROM '.DB::table($this->_table).' WHERE '.DB::field('orderid',$orderid));
    }
    public function get_range($condition,$start = 0, $limit = 0,$sort = 'DESC'){
        $where='1 ';
        if($sort) {
            $this->checkpk();
        }
        if(is_array($condition)){
            $wheret = DB::implode_field_value($condition, ' AND ');
            if($wheret)$where = $wheret;
        }
        return DB::fetch_all('SELECT * FROM '.DB::table($this->_table).' WHERE '.$where.($sort ? ' ORDER BY '.DB::order($this->_pk, $sort) : '').DB::limit($start, $limit), null, $this->_pk ? $this->_pk : '');
    }
    public function get_count($condition){
        $where='1 ';
        if(is_array($condition)){
            $wheret = DB::implode_field_value($condition, ' AND ');
            if($wheret)$where = $wheret;
        }
        return DB::result_first('SELECT count(*) FROM '.DB::table($this->_table).' WHERE '.$where);
    }
}

?>