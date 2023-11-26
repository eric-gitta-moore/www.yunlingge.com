<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

define('PLAYER_API','playerapi.yunlingge.com');

class plugin_yunling_music_player
{

    public function global_footer()
    {
        global $_G;
        $config = $_G['cache']['plugin']['yunling_music_player'];

        if (empty($config['key']))return;

        $script = [
            'portal,index' => 2,//门户首页
            'forum,index' => 3,//论坛首页
            'forum,forumdisplay' => 4,//论坛板块
            'forum,viewthread' => 5,//论坛贴子
        ];

        $config['multi_select'] = unserialize($config['multi_select']);

        $return = '';


        if (in_array($script[CURSCRIPT . ',' . CURMODULE],$config['multi_select'])
            || in_array(1,$config['multi_select'])
            || (!array_key_exists(CURSCRIPT . ',' . CURMODULE,$script)  && in_array(6,$config['multi_select']))
        )
        {
            if ($config['jquery'])
            {
                $return .= '<script src="//libs.baidu.com/jquery/1.7.2/jquery.min.js"></script><script >jQuery.noConflict();</script>';
            }
            if ($config['switch_lazyload'])
            {
                $return .= '<script id="ilt" data-src="'. $_G['scheme'] .'://' . PLAYER_API . '/player/js/player.js" key="' . $config['key'] . '"></script>';
                if ($config['lazyload_time'] > 0)
                {
                    $return .= '<script type="text/javascript">
                    jQuery(document).ready(function()
                    {
                        setTimeout(function(){
                            jQuery("#ilt").attr("src",jQuery("#ilt").attr("data-src"));
                        }, '. $config['lazyload_time'] .');
                    });
                    </script>';
                }
                else
                {
                    $return .= '<script>
                                jQuery(function(){
                                    let yunling_interval = setInterval(function () {
                                        if (document.readyState == "complete") {
                                            //code
                                            jQuery("#ilt").attr("src",jQuery("#ilt").attr("data-src"));
                                            clearInterval(yunling_interval);
                                        }
                                    }, 100);
                                });</script>';
                }
            }
            else
            {
                $return .= '<script id="ilt" src="//' . PLAYER_API . '/player/js/player.js" key="' . $config['key'] . '"></script>';
            }



        }
        return $return;
    }

}