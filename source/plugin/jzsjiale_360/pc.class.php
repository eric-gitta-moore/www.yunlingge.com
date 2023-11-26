<?php
/**
 * author: jzsjiale
 * qq: 836333583
 * e-mail: 836333583@qq.com
 * dismall: https://addon.dismall.com/?@32563.developer
 * createtime: 202002051510
 * updatetime: 202002051510
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_jzsjiale_360 {
	//TODO - Insert your code here

    var $count = 0;
    function get360($message)
    {
        $message = $message[0];
        $this->count ++;
        $id = '_' . $this->count;

        $message = trim($message);

        $message = substr($message, strlen('[jzsjiale_360]'), strlen($message) - strlen('[jzsjiale_360]') - strlen('[/jzsjiale_360]'));

        $img_param = explode(',=', $message);

        $imgurl = $img_param[0];
        $imgtitle = $img_param[1];
        $imgwidth = $img_param[2];
        $imgheight = $img_param[3];

        $pattern = "/^[a-zA-z]+:\/\/[^\s]*[.]{1}(gif|jpg|png|bmp|jpeg)$/is";
        if ( !preg_match( $pattern, $imgurl ) )
        {
            $imgurl = "#";
        }

        if (empty($imgtitle) || $imgtitle == "#"){
            $imgtitle = "";
        }
        if($imgwidth == ""){
            $imgwidth = "500px";
        }
        if($imgheight == ""){
            $imgheight = "280px";
        }

        include template('jzsjiale_360:360');
        return trim($return);

    }


    function discuzcode($param)
    {
        global $_G;

        $_config = $_G['cache']['plugin']['jzsjiale_360'];

        if (! $_config['g_isopenpc']) {
            return;
        }

        if (strpos($_G['discuzcodemessage'], '[/jzsjiale_360]') === false) {
            return false;
        }


        if ($param['caller'] == 'discuzcode') {

            $_G['discuzcodemessage'] = preg_replace_callback('/\s?\[jzsjiale_360\](.*?)\[\/jzsjiale_360\]\s?/is', array(
                $this,
                'get360'
            ), $_G['discuzcodemessage']);

        } else {
            $_G['discuzcodemessage'] = preg_replace_callback('/\s?\[jzsjiale_360\](.*?)\[\/jzsjiale_360\]\s?/is', '', $_G['discuzcodemessage']);

        }
        if ($_config['g_cdn']) {
            $_G['discuzcodemessage'] = "<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/photo-sphere-viewer@3.5.0/dist/photo-sphere-viewer.min.css\"><script src=\"https://cdn.jsdelivr.net/npm/three@0.99.0/build/three.min.js\"></script><script src=\"https://cdn.jsdelivr.net/npm/promise-polyfill@8.1.0/dist/polyfill.min.js\"></script><script src=\"https://cdn.jsdelivr.net/npm/dot@1.1.2/doT.min.js\"></script><script src=\"https://cdn.jsdelivr.net/npm/uevent@1.0.0/uevent.min.js\"></script><script src=\"https://cdn.jsdelivr.net/npm/photo-sphere-viewer@3.5.0/dist/photo-sphere-viewer.min.js\"></script>".$_G['discuzcodemessage'];
        }else{
            $_G['discuzcodemessage'] = "<link rel=\"stylesheet\" href=\"source/plugin/jzsjiale_360/static/css/photo-sphere-viewer.min.css\"><script src=\"source/plugin/jzsjiale_360/static/js/three.min.js\"></script><script src=\"source/plugin/jzsjiale_360/static/js/polyfill.min.js\"></script><script src=\"source/plugin/jzsjiale_360/static/js/doT.min.js\"></script><script src=\"source/plugin/jzsjiale_360/static/js/uevent.min.js\"></script><script src=\"source/plugin/jzsjiale_360/static/js/photo-sphere-viewer.min.js\"></script>".$_G['discuzcodemessage'];

        }
    }
}

class plugin_jzsjiale_360_forum extends plugin_jzsjiale_360
{
    function post_editorctrl_left()
    {
        global $_G;

        $_config = $_G['cache']['plugin']['jzsjiale_360'];
        $groupid = $_G['groupid'];
        $fid = $_G['fid'];


        $jzsjiale360_btn = "";
        if (in_array($fid, (array) unserialize($_config['g_fids'])) && in_array($groupid, (array) unserialize($_config['g_usergroups']))) {
            $jzsjiale360_btn = "<script src=\"source/plugin/jzsjiale_360/static/js/addbtn.js\" type=\"text/javascript\"></script><link rel=\"stylesheet\" href=\"source/plugin/jzsjiale_360/static/css/btn_360.css\" type=\"text/css\" /><a id=\"btn_360\" title=\"" . $_config['g_btntip'] . "\" onClick=\"add360('jzsjiale_360','" . $_config['g_onlymoren'] . "','".$rukuok."','".$tklcaijiok."','".$regexpstr."','".$_G['siteurl']."','".$_config['g_isopenmiaoshu']."')\" href='javascript:void(0);' >" . $_config['g_btnname'] . "</a>";
        }

        return $jzsjiale360_btn;
    }
}


class plugin_jzsjiale_360_group extends plugin_jzsjiale_360
{
    function post_editorctrl_left()
    {
        global $_G;

        $_config = $_G['cache']['plugin']['jzsjiale_360'];
        $groupid = $_G['groupid'];


        $jzsjiale360_btn = "";
        if ($_config['g_isopengroup'] && in_array($groupid, (array) unserialize($_config['g_usergroups']))) {
            $jzsjiale360_btn = "<script src=\"source/plugin/jzsjiale_360/static/js/addbtn.js\" type=\"text/javascript\"></script><link rel=\"stylesheet\" href=\"source/plugin/jzsjiale_360/static/css/btn_360.css\" type=\"text/css\" /><a id=\"btn_360\" title=\"" . $_config['g_btntip'] . "\" onClick=\"add360('jzsjiale_360','" . $_config['g_onlymoren'] . "','".$rukuok."','".$tklcaijiok."','".$regexpstr."','".$_G['siteurl']."','".$_config['g_isopenmiaoshu']."')\" href='javascript:void(0);' >" . $_config['g_btnname'] . "</a>";
        }

        return $jzsjiale360_btn;
    }
}
?>