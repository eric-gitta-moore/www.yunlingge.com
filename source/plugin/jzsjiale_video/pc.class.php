<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_jzsjiale_video {
	//TODO - Insert your code here

    function parsevideo($matches)
    {
        global $_G;
        $_config = $_G['cache']['plugin']['jzsjiale_video'];
        $url = $matches[2];

        $width = "100%";
        $height = "auto";

        if($_config['g_pcwidth'] == "" || $_config['g_pcwidth'] == "0"){
            $width = "100%";
        }else{
            $width = $_config['g_pcwidth']."px";
        }
        if($_config['g_pcheight'] == "" || $_config['g_pcheight'] == "0" || $_config['g_pcheight'] == "auto" || $_config['g_pcwidth'] == "" || $_config['g_pcwidth'] == "0"){
            $height = "auto";
        }else{
            $height = $_config['g_pcheight']."px";
        }
        $url = addslashes($url);
        $url = htmlspecialchars(str_replace(array('<', '>'), '', str_replace('\\"', '\"', $url)));

        $autoplay = $_config['g_pcautoplay']?'autoplay="autoplay"':'';
        $controls = $_config['g_pccontrol']?'controls="controls"':'';
        $muted = $_config['g_pcmuted']?'muted="muted"':'';
        if(strpos($url,'.mp4') !==false){
            return '<video src="'.$url.'"'.$muted.''.$autoplay.''.$controls.' width="'.$width.'" height="'.$height.'">Your browser does not support video tags.</video>';
        }else{
            return;
        }

    }

    function parsevideo_poster($matches)
    {
        global $_G;
        $_config = $_G['cache']['plugin']['jzsjiale_video'];
        $pic = $matches[2];
        $url = $matches[3];

        $width = "100%";
        $height = "auto";

        if($_config['g_pcwidth'] == "" || $_config['g_pcwidth'] == "0"){
            $width = "100%";
        }else{
            $width = $_config['g_pcwidth']."px";
        }
        if($_config['g_pcheight'] == "" || $_config['g_pcheight'] == "0" || $_config['g_pcheight'] == "auto" || $_config['g_pcwidth'] == "" || $_config['g_pcwidth'] == "0"){
            $height = "auto";
        }else{
            $height = $_config['g_pcheight']."px";
        }
        $pic = addslashes($pic);
        $pic = htmlspecialchars(str_replace(array('<', '>'), '', str_replace('\\"', '\"', $pic)));

        $url = addslashes($url);
        $url = htmlspecialchars(str_replace(array('<', '>'), '', str_replace('\\"', '\"', $url)));

        $autoplay = $_config['g_pcautoplay']?'autoplay="autoplay"':'';
        $controls = $_config['g_pccontrol']?'controls="controls"':'';
        $muted = $_config['g_pcmuted']?'muted="muted"':'';
        if(strpos($url,'.mp4') !==false){
            return '<video src="'.$url.'"'.$muted.''.$autoplay.''.$controls.' width="'.$width.'" height="'.$height.'" poster="'.$pic.'">Your browser does not support video tags.</video>';
        }else{
            return;
        }

    }

    function discuzcode($param)
    {
        global $_G;
        $_config = $_G['cache']['plugin']['jzsjiale_video'];

        $groupid = $_G['groupid'];
        $fid = $_G['fid'];

        if (!$_config['g_isopenpc'] || !in_array($fid, (array) unserialize($_config['g_pcfids'])) || !in_array($groupid, (array) unserialize($_config['g_pcusergroups']))) {
            return;
        }
        if (strpos($_G['discuzcodemessage'], '[/media]') != false) {
            $_G['discuzcodemessage'] = preg_replace_callback("/\[media=([\w,]+)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/is", array($this, 'parsevideo'), $_G['discuzcodemessage']);
            $_G['discuzcodemessage'] = preg_replace_callback("/\[media=(\s*([^\[\<\r\n]+?)\s*)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/is", array($this, 'parsevideo_poster'), $_G['discuzcodemessage']);
        }else{
            return false;
        }
    }
}

?>