<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);

global $_G;

class function_login extends class_base
{
    public $action_all = array('ceshi', 'get_avatar', 'fetch_by_uid', 'fetch_by_groupid', 'user_login', 'fetch_uid_by_username', 'fetch_by_type');

    public function __construct()
    {
        parent::__construct();
    }


}