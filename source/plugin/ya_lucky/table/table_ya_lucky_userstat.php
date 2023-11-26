<?php

/**
 * 	[【云猫】幸运发帖(ya_lucky)] (C)2019-2099 Powered by 云猫工作室.
 * 	Date: 2019-5-23 16:26
 *      File: table_ya_lucky_userstat.php
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_ya_lucky_userstat extends discuz_table
{

    public function __construct()
    {
        $this->_table = 'ya_lucky_userstat';
        $this->_pk = 'uid';
        parent::__construct();
    }

    public function increase($uid, $field)
    {

        if (in_array($field, array('lucky_num', 'bad_num'))) {
            return DB::query('UPDATE %t SET %i WHERE uid=%d', array($this->_table, DB::field($field, '1', '+'), $uid));
        }

        return false;
    }

    public function range($start = 0, $limit = 0, $orderby = '', $sort = '')
    {

        $orderby = in_array($orderby, array($this->_pk, 'lucky_num', 'bad_num'), true) ? $orderby : '';

        return DB::fetch_all('SELECT * FROM %t %i %i', array($this->_table, ($orderby ? ' ORDER BY ' . DB::order($orderby, $sort) : ''), DB::limit($start, $limit)), $this->_pk);
    }

}

?>