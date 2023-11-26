<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yunling_fully
{
    public function global_footer()
    {
        global $_G;
        $config = $_G['cache']['plugin']['yunling_fully'];

//        if (empty($config['key']))return;

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
            if ($config['bkg'])
            {
                $return .= '<script class="lazy_script" data-src="/source/plugin/yunling_fully/static/canvas-nest.js"></script>';
            }
            if ($config['input'] || $config['shake'])
            {
                $return .= '<script class="lazy_script" src="/source/plugin/yunling_fully/static/colorful.js"></script>';
                if ($config['input'] && $config['shake'])
                {
                    $return .= '<script>POWERMODE.colorful=true;POWERMODE.shake=true;document.body.addEventListener("input",POWERMODE);</script>';
                }
                elseif ($config['shake'])
                {
                    $return .= '<script>POWERMODE.colorful=false;POWERMODE.shake=true;document.body.addEventListener("input",POWERMODE);</script>';
                }
                elseif ($config['input'])
                {
                    $return .= '<script>POWERMODE.colorful=true;POWERMODE.shake=false;document.body.addEventListener("input",POWERMODE);</script>';
                }
            }

        }
        return $return;

    }
}
