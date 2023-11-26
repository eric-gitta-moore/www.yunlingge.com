<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_huihuicai_threadseo_base {
}


class plugin_huihuicai_threadseo  extends plugin_huihuicai_threadseo_base{

    function global_header(){
        global $_G, $navtitle;
        if($_G['basescript']=="forum" and CURMODULE=="viewthread"){
            $tid = intval($_GET['tid']);
            if($seo_title = DB::result_first("select seo_title from ".DB::table('forum_thread_seo_edited')." where tid=$tid")){
                $navtitle = $seo_title;
            }
        }
    }

}
