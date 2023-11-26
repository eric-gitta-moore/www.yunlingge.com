<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
define('P_NAME', 'plugin/boan_glow');
class  plugin_boan_glow{
    
}

class plugin_boan_glow_forum extends plugin_boan_glow{
    var $in_perm;
    function __construct(){
        global $_G;
        $this->in_perm = false;
        foreach ($_G['cache']['bbcodes'][$_G['groupid']]['searcharray'] as $search){
            if(stripos($search,'[\/glow\]') !== false){
                $this->in_perm = true;
                break;
            }
        }
    }
    function post_editorctrl_left(){
        $text = lang(P_NAME, 'glow_text');
        $button_text = lang(P_NAME, 'glow_button_text');
        $rtn = '';
        if($this->in_perm){
            $rtn = "<style type=\"text/css\">      	
                    #e_boan_glow{
                        background: url(source/plugin/boan_glow/images/bb_l_glow.gif) no-repeat;
                        background-position:3px 0px;
					}
					.b2r #e_boan_glow{
						background: url(source/plugin/boan_glow/images/bb_glow.gif) no-repeat;
                        background-position:0px 0px;
					}
                </style>
                <a id=\"e_boan_glow\"    title=\"$text\">$button_text</a>";
        }
        return $rtn;
    }
    
    function post_bottom(){
        $rtn = '';
        if($this->in_perm){
            $rtn = "<script src=\"source/plugin/boan_glow/js/glow.js\" charset=\"utf-8\" type=\"text/javascript\"></script>
            <span style=\"color:red\"></spn>";
        }      
        return $rtn;
    }
 
}