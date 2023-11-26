<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-5-23 16:26
 *      File: table_ya_lucky_log.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_ya_lucky_log extends discuz_table
{

    public function __construct()
    {
        $this->_table = 'ya_lucky_log';
        $this->_pk = 'lid';
        parent::__construct();
    }

    public function fetch_all_by_tid_pids($tids, $pids, $start = 0, $limit = 0)
    {
        return ($pids = dintval($pids, true)) ? DB::fetch_all('SELECT * FROM ' . DB::table($this->_table) . ' WHERE ' . DB::field('tid', $tids) . ' AND ' . DB::field('pid', $pids), null, 'pid') : array();
    }

    public function fetcl_all_by_uid($uid = 0, $start = 0, $limit = 0, $orderby = 'dateline', $sort = 'DESC')
    {
        $parameter = array($this->_table);
        $wherearr = array();

        if (!empty($uid)) {
            $parameter[] = $uid;
            $wherearr[] = "uid=%d";
        }

        $wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE ' . implode(' AND ', $wherearr) : '';

        $parameter[] = $orderby && $sort ? ' ORDER BY ' . DB::order($orderby, $sort) : '';
        $parameter[] = DB::limit($start, $limit);

        return DB::fetch_all("SELECT * FROM %t $wheresql %i %i", $parameter);
    }

    public function count_by_uid($uid = 0)
    {
        $parameter = array($this->_table);
        $wherearr = array();

        if (!empty($uid)) {
            $parameter[] = $uid;
            $wherearr[] = "uid=%d";
        }

        $wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE ' . implode(' AND ', $wherearr) : '';

        return DB::result_first("SELECT COUNT(*) FROM %t $wheresql", $parameter);
    }

}

?>