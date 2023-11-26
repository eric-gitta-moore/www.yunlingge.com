<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/yunling_forumlist_alt/hook.class.php';

class mobileplugin_yunling_forumlist_alt extends plugin_yunling_forumlist_alt
{

}

class mobileplugin_yunling_forumlist_alt_forum extends mobileplugin_yunling_forumlist_alt
{
    public function index_top_mobile_output()
    {
        $this->index_top_output();
    }
}

