<?php
/* www.ymg6.com */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_nciaer_sync_collect_title {

    public $config = array();

    public function __construct() {

        global $_G;

        $this->config = $_G['cache']['plugin']['nciaer_sync_collect_title'];
    }

    public function post_message($params) {

        global $_G, $thread, $subject;

        if(!$this->config['on']) return;

        if(!$thread['isgroup']) {
            if(!in_array($_G['fid'], dunserialize($this->config['fids'])) && !dempty(dunserialize($this->config['fids']))) return;
        }

        if($params['param'][0] == 'post_edit_succeed') {
            $tid = intval($thread['tid']);
            DB::update('home_favorite', array('title' => $subject), array('idtype' => 'tid', 'id' => $tid));
        }
    }
}

class plugin_nciaer_sync_collect_title_forum extends plugin_nciaer_sync_collect_title {}
class mobileplugin_nciaer_sync_collect_title_forum extends plugin_nciaer_sync_collect_title {}
class mobileplugin_nciaer_sync_collect_title_group extends plugin_nciaer_sync_collect_title {}
class plugin_nciaer_sync_collect_title_group extends plugin_nciaer_sync_collect_title {}
