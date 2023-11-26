<?php

/**
 *    Powered by Ñ¶»ÃÍø - www.xhkj5.com.
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_xhkj5com_jtft
{
    function global_cpnav_top()
    {
        global $_G;
        $set = $_G['cache']['plugin']['xhkj5com_jtft'];
//$xhkj5com_bl_fantizw = $lang['bl_fantizw'];
        $xhkj5com_jtft_weizhi = $set['xhkj5com_jf_weizhi'];
        $xhkj5com_jtft_zdybt = $set['xhkj5com_jtft_zdybt'];
        $xhkj5com_jtft_quanju = $set['xhkj5com_jtft_quanju'];

        if ($xhkj5com_jtft_quanju == 1) {
            if ($xhkj5com_jtft_weizhi == 1) {
                return '<a href="javascript:;" id="xhkj5comstranlink">' . $xhkj5com_jtft_zdybt . '</a>';
            }
        }


    }

    function global_cpnav_extra1()
    {
        global $_G;
        $set = $_G['cache']['plugin']['xhkj5com_jtft'];
        $xhkj5com_jtft_weizhi = $set['xhkj5com_jf_weizhi'];
        $xhkj5com_jtft_zdybt = $set['xhkj5com_jtft_zdybt'];
        $xhkj5com_jtft_quanju = $set['xhkj5com_jtft_quanju'];
        if ($xhkj5com_jtft_quanju == 1) {
            if ($xhkj5com_jtft_weizhi == 2) {
                return '<a href="javascript:;" id="xhkj5comstranlink">' . $xhkj5com_jtft_zdybt . '</a>';
            }
        }

    }

    function global_cpnav_extra2()
    {
        global $_G;
        $set = $_G['cache']['plugin']['xhkj5com_jtft'];
        $xhkj5com_jtft_weizhi = $set['xhkj5com_jf_weizhi'];
        $xhkj5com_jtft_zdybt = $set['xhkj5com_jtft_zdybt'];
        $xhkj5com_jtft_quanju = $set['xhkj5com_jtft_quanju'];
        if ($xhkj5com_jtft_quanju == 1) {
            if ($xhkj5com_jtft_weizhi == 3) {
                return '<a href="javascript:;" id="xhkj5comstranlink">' . $xhkj5com_jtft_zdybt . '</a>';
            }
        }
    }

    function global_nav_extra()
    {
        global $_G;
        $set = $_G['cache']['plugin']['xhkj5com_jtft'];
        $xhkj5com_jtft_weizhi = $set['xhkj5com_jf_weizhi'];
        $xhkj5com_jtft_zdybt = $set['xhkj5com_jtft_zdybt'];
        $xhkj5com_jtft_quanju = $set['xhkj5com_jtft_quanju'];

        if ($xhkj5com_jtft_quanju == 1) {
            if ($xhkj5com_jtft_weizhi == 4) {
                return '<a href="javascript:;" id="xhkj5comstranlink">' . $xhkj5com_jtft_zdybt . '</a>';
            }
        }
    }

    function global_footerlink()
    {
        global $_G;
        $set = $_G['cache']['plugin']['xhkj5com_jtft'];
        $xhkj5com_jtft_weizhi = $set['xhkj5com_jf_weizhi'];
        $xhkj5com_jtft_zdybt = $set['xhkj5com_jtft_zdybt'];
        $xhkj5com_jtft_quanju = $set['xhkj5com_jtft_quanju'];


        $xhkj5com_jtft_gbut_a = $set['xhkj5com_jtft_gbut'];//GBUT
        $xhkj5com_bl_fantizw = $lang['bl_fantizw'];
        $wmaffmrjf = $set['wmaffmrjf'];
        $xhkj5com_jtft_color = $set['xhkj5com_jtft_color'];


        if ($xhkj5com_jtft_gbut_a == 1) {
            $xhkj5com_jtft_gbut_a = "_gbk";
        } else {
            $xhkj5com_jtft_gbut_a = "_utf8";
        }

        $return = '';

        if ($xhkj5com_jtft_quanju == 1) {
            if ($xhkj5com_jtft_weizhi == 5) {

                $anniuaa = '<a href="javascript:;" id="xhkj5comstranlink">' . $xhkj5com_jtft_zdybt . '</a>';
            }
        }


        include 'template/top_1.php';
        return $anniuaa . $return;
    }


    function global_footer()
    {
        global $_G;
        $set = $_G['cache']['plugin']['xhkj5com_jtft'];

        $xhkj5com_jtft_gbut_a = $set['xhkj5com_jtft_gbut'];//GBUT
        $xhkj5com_bl_fantizw = $lang['bl_fantizw'];

        $wmaffmrjf = $set['wmaffmrjf'];
        $xhkj5com_jtft_color = $set['xhkj5com_jtft_color'];


        if ($xhkj5com_jtft_gbut_a == 1) {
            $xhkj5com_jtft_gbut_a = "_gbk";
        } else {
            $xhkj5com_jtft_gbut_a = "_utf8";
        }
        // $return = '';
        // include 'template/top_1.php';
        //return $return;

    }


}

?>