<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yunling_turbo
{
    public function global_header()
    {
        return '<script defer="defer" src="/source/plugin/yunling_turbo/static/instantpage.js"></script>';
    }
}