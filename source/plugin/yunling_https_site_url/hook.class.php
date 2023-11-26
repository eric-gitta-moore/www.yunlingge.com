<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_yunling_https_site_url {

    public function common()
    {
        global $_G;
        $config = $_G['cache']['plugin']['yunling_https_site_url'];
        $switch = $config['switch'];
        $redirect = $config['redirect'];
        if ($switch)
        {
        	// if ($redirect)
            $sitepath = substr($_G['PHP_SELF'], 0, strrpos($_G['PHP_SELF'], '/'));
            if(defined('IN_API')) {
                $sitepath = preg_replace("/\/api\/?.*?$/i", '', $sitepath);
            } elseif(defined('IN_ARCHIVER')) {
                $sitepath = preg_replace("/\/archiver/i", '', $sitepath);
            }
            if(defined('IN_NEWMOBILE')) {
                $sitepath = preg_replace("/\/m/i", '', $sitepath);
            }
            $_G['isHTTPS'] = true;
            $_G['scheme'] = 'http'.($_G['isHTTPS'] ? 's' : '');
            $_G['siteurl'] = dhtmlspecialchars($_G['scheme'].'://'.$_SERVER['HTTP_HOST'].$sitepath.'/');

            $url = parse_url($_G['siteurl']);
            $_G['siteroot'] = isset($url['path']) ? $url['path'] : '';
            $_G['siteport'] = empty($_SERVER['SERVER_PORT']) || $_SERVER['SERVER_PORT'] == '80' || $_SERVER['SERVER_PORT'] == '443' ? '' : ':'.$_SERVER['SERVER_PORT'];

            if(defined('SUB_DIR')) {
                $_G['siteurl'] = str_replace(SUB_DIR, '/', $_G['siteurl']);
                $_G['siteroot'] = str_replace(SUB_DIR, '/', $_G['siteroot']);
            }
        }
    }

}

?>