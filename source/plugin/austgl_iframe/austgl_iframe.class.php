<?php
/**
 *    [网站外链iframe打开（austgl_iframe）] (C)2014-2099 Powered by austgl.com|iganlei.cn 阿甘工作室.
 *    Version: v0.1
 *    Date: 2014-02-11
 */
// error_reporting(E_ALL);

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_austgl_iframe
{
    public $austgl_iframe_root;
    public $adscode;
    public $adsimg;

    function __construct()
    {
        global $_G;
        if ($_G['cache']['plugin']['austgl_iframe']['austgl_iframe_radio']) {
            $this->austgl_iframe_root = 'source/plugin/austgl_iframe';
            $this->adscode = $_G['cache']['plugin']['austgl_iframe']['austgl_iframe_adcode'];
            $this->adsimg = $_G['cache']['plugin']['austgl_iframe']['austgl_iframe_adimg'];
        }
    }

    function _replace($content)
    {
        $patterns = "/\<a href\=\"(http|https)\:\/\/(.+?)\"/is";
//        $replacements = '$this->_iframeUrl(\'\\1\')';

        $content = preg_replace_callback($patterns, array($this, '_iframeUrl'), $content);
        return $content;
    }

    /**
     * 取得根域名
     * @param type $domain 域名
     * @return string 返回根域名
     */
    function _letUrlToDomain($domain)
    {
        $domain_postfix_array = array('com', 'net', 'org', 'gov', 'edu', 'com.cn', 'cn', 'cc', 'us', 'tv', 'jp', 'uk', 'tw', 'arpa', 'int', 'mil', 'biz', 'info', 'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'me', 'mobi', 'info');
        $array_domain = explode(".", $domain);
        $array_num = count($array_domain) - 1;
        if ($array_domain[$array_num] == 'cn') {
            if (in_array($array_domain[$array_num - 1], $domain_postfix_array)) {
                $re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
            } else {
                $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
            }
        } else {
            $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
        return $re_domain;
    }

    function _iframeUrl($url)
    {
        global $_G;
        /*
         array(3) {
            [0]=>
            string(38) "<a href="http://www.austgl.com/adfjkl""
            [1]=>
            string(4) "http"
            [2]=>
            string(21) "www.austgl.com/adfjkl"
            }
            array(3) {
            [0]=>
            string(50) "<a href="https://www.austgl.com/asldkfjsdfasdfdfs""
            [1]=>
            string(5) "https"
            [2]=>
            string(32) "www.austgl.com/asldkfjsdfasdfdfs"
         }
         */
        $allow = $_G['cache']['plugin']['austgl_iframe']['austgl_iframe_exceptiondomin'];
        $allow = explode("\r\n", $allow);
        $currentdomain = $this->_letUrlToDomain($_G['siteurl']);
        $allow[] = $currentdomain;
        $domain = explode('/', $url[2]);
        $domain = $domain[0];
        $topdomain = $this->_letUrlToDomain($url[2]);
        if (in_array($domain, $allow) || in_array($topdomain, $allow)) {
            return "<a href=\"$url[1]://$url[2]\"";
        } else {
            $link = rawurlencode($url[2]);
            return '<a rel="nofollow" href="' . $_G['siteurl'] . 'plugin.php?id=austgl_iframe:austgl_iframe&url='.$url[1].'://' . $link . '"';
        }
    }

}

class plugin_austgl_iframe_forum extends plugin_austgl_iframe
{
    public function viewthread_postbottom_output()
    {
        global $_G, $postlist;
        if (!$_G['cache']['plugin']['austgl_iframe']['austgl_iframe_radio']) return array();
        foreach ($postlist as $id => &$post) {
            $post['message'] = $this->_replace($post['message']);
        }
        unset($post);
        return array();
    }
}
