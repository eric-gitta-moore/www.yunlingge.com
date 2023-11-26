<?php
/**
 *    [新浪短网址(austgl_shorturl.{modulename})] (C)2014-2099 Powered by austgl.com|iganlei.cn 阿甘工作室.
 *    Version: v1.1
 *    Date: 2017-08-12 12:22
 */
// error_reporting(E_ALL);
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if (!function_exists('is_php')) {
    function is_php($version)
    {
        static $_is_php;
        $version = (string)$version;

        if (!isset($_is_php[$version])) {
            $_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
        }
        return $_is_php[$version];
    }
}

class plugin_austgl_shorturl
{
    public $config = array();

    function __construct()
    {
        global $_G;
        $config = $_G['cache']['plugin']['austgl_shorturl'];
        $this->config['austglurl_forums'] = unserialize($config['austgl_forums']);
        // $this->config['austglurl_navopen'] = $config['austgl_navopen'];
        $this->config['austglurl_user'] = unserialize($config['austgl_user']);
        $this->config['austglurl_forumopen'] = $config['austgl_forumopen'];
    }

    public function _parseLongUrl($message)
    {
        global $_G, $austgl_short_replace;
        $msglower = strtolower($message);
        require_once('shorturl.php');
        if (strpos($msglower, '[/glurl]') !== FALSE) {
            preg_match_all("/\[glurl\]\s*([^\[\<\r\n]+?)\s*\[\/glurl\]/is", $msglower, $a);
            $replace = returnShort(iconv($_G["charset"], "UTF-8", $a[1][0]));
            $austgl_short_replace = iconv("UTF-8", $_G["charset"], $replace);
            // echo $repace;
            if (is_php(5.4)) {
                $message = preg_replace_callback("/\[glurl\]\s*[^\[\<\r\n]+?\s*\[\/glurl\]/is", function ($matches) {
                    global $austgl_short_replace;
                    return '<a target="blank" rel=”nofollow” href="' . $austgl_short_replace . '">' . $austgl_short_replace . '</a>';
                }, $message);
            } else {
                $message = preg_replace("/\[glurl\]\s*[^\[\<\r\n]+?\s*\[\/glurl\]/is", '<a target="blank" rel=”nofollow” href="' . $austgl_short_replace . '">' . $austgl_short_replace . '</a>', $message);
            }
        }
        return $message;
    }

    function global_header()
    {
        global $_G;
        return '<link type="text/css" rel="stylesheet" href="source/plugin/austgl_shorturl/css/austglurl.css"/>';
    }

    function post_editorctrl_left()
    {
        global $_G;
        if (($this->config['austglurl_forumopen']) && (in_array($_G['groupid'], $this->config['austglurl_user'])) && (in_array($_G['fid'], $this->config['austglurl_forums']))) {
            return '<script src="source/plugin/austgl_shorturl/js/austgl_editor.js"></script><script>var austgl_insert="' . lang('plugin/austgl_shorturl', 'austgl_insert') . '",austgl_example="' . lang('plugin/austgl_shorturl', 'austgl_example') . '",austgl_submit="' . lang('plugin/austgl_shorturl', 'austgl_submit') . '",austgl_shutdown="' . lang('plugin/austgl_shorturl', 'austgl_shutdown') . '";</script><a href="javascript:;" id="austglurl" title="' . lang('plugin/austgl_shorturl', 'austgl_shorturladd') . '" onclick="austglurl_showEditorMenu(this,null)">' . lang('plugin/austgl_shorturl', 'austgl_shorturlname') . '</a>';
        }
    }

    function viewthread_postbottom_output()
    {
        global $_G, $postlist;
        foreach ($postlist as $k => &$vpost) {
            $vpost['message'] = $this->_parseLongUrl($vpost['message']);
        }
        unset($vpost);
        return array();
    }
}

class plugin_austgl_shorturl_forum extends plugin_austgl_shorturl
{
}

?>