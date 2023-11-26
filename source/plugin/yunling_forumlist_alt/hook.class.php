<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yunling_forumlist_alt
{
    public function index_top_output()
    {
        global $forumlist,$_G;

        $config = $_G['cache']['plugin']['yunling_forumlist_alt'];

        if ($config['alt_switch'] && $config['width_switch'])
        {
            foreach ($forumlist as $k => &$item) {
                $item['icon'] = str_replace('alt=""','alt="' . $item['name'] . ' - ' . $_G['setting']['sitename'] . '" width="' . $item['extra']['iconwidth'] . '"' . ' height="' . $item['extra']['iconwidth'] . '"',$item['icon']);
            }
        }
        elseif ($config['width_switch'])
        {
            foreach ($forumlist as $k => &$item) {
                $item['icon'] = str_replace('alt=""','alt="" width="' . $item['extra']['iconwidth'] . '"' . ' height="' . $item['extra']['iconwidth'] . '"',$item['icon']);
            }
        }
        elseif ($config['alt_switch'])
        {
            foreach ($forumlist as $k => &$item) {
                $item['icon'] = str_replace('alt=""','alt="' . $item['name'] . ' - ' . $_G['setting']['sitename'] . '"',$item['icon']);
            }
        }


//        var_dump($forumlist);
//        exit();
    }
}

class plugin_yunling_forumlist_alt_forum extends plugin_yunling_forumlist_alt
{

}