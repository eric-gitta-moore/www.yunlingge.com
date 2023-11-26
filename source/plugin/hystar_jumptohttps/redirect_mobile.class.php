<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class mobileplugin_hystar_jumptohttps {
    function  global_header_mobile () {
        global $_G;
        $cacheinfo = $_G['cache']['plugin']['hystar_jumptohttps'];
        if ($cacheinfo['openmobile'] != 1) {
            return;
        }

        $serverport = $_SERVER["SERVER_PORT"];
        if ($serverport != '443') {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            exit ;
        }
    }
}

?>