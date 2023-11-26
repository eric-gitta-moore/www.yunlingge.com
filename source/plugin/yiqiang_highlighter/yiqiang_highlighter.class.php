<?php


if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yiqiang_highlighter
{
    function __construct()
    {
        include_once template('yiqiang_highlighter:highlighter');
    }
}

class plugin_yiqiang_highlighter_forum extends plugin_yiqiang_highlighter
{
    function viewthread_title_extra()
    {
        global $_G;
        $state = $_G['cache']['plugin']['yiqiang_highlighter']['state'];
        if ($state){
            return viewthread_title_extra_highlighter();
        }
    }

}

?>

