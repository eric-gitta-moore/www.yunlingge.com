<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-5-23 16:26
 *      File: table_ya_lucky_event.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_ya_lucky_event extends discuz_table
{

    public function __construct()
    {
        $this->_table = 'ya_lucky_event';
        $this->_pk = 'eid';
        parent::__construct();
    }

    public function fetch_all_by_type($type = '', $order = 'DESC')
    {
        $parameter = array($this->_table);
        $wherearr = array();

        if (!empty($type)) {
            $parameter[] = $type;
            $wherearr[] = "type=%d";
        }

        $wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE ' . implode(' AND ', $wherearr) : '';
        return DB::fetch_all("SELECT * FROM %t $wheresql ORDER BY dateline $order", $parameter, $this->_pk);
    }

}

?>