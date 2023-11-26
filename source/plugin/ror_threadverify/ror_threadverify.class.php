<?php
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

class plugin_ror_threadverify{

}

class plugin_ror_threadverify_forum extends plugin_ror_threadverify
{
    var $plugin_name = 'ror_threadverify';
    
    function post_ror_threadverify_message($param)
    {
        global $_G, $isfirstpost;
        
        $threadverify = $_G['cache']['plugin'][$this->plugin_name];

        if(! $threadverify['forum_is_open_verify']){
            return '';
        }

        $open_forum = unserialize($threadverify['open_forum']);
        $open_group = unserialize($threadverify['open_group']);
        
        if(! in_array($_G['groupid'], $open_group)){
            return '';
        }
        
        $result = $param['param'];

        if(! in_array($result[2]['fid'], $open_forum) || !dempty($open_forum)){
            return '';
        }

        if($result[0] == 'post_reply_succeed' && $result[2]['pid']){
            updatemoderate('pid', $result[2]['pid']);
        }else if($result[0] == 'post_newthread_succeed' && $result[2]['tid']){
            updatemoderate('tid', $result[2]['tid']);
        }else if($result[0] == 'post_edit_succeed' && $result[2]['pid']){
            if($isfirstpost){
                updatemoderate('tid', $result[2]['tid']);
            }else{
                updatemoderate('pid', $result[2]['pid']);
            }
        }
    }
}

class plugin_ror_threadverify_group extends plugin_ror_threadverify
{
    var $plugin_name = 'ror_threadverify';
    
    function post_ror_threadverify_message($param)
    {
        global $_G, $isfirstpost;

        $threadverify = $_G['cache']['plugin'][$this->plugin_name];

        if(! $threadverify['group_is_open_verify']){
            return '';
        }

        $open_group = unserialize($threadverify['open_group']);

        if(! in_array($_G['groupid'], $open_group)){
            return '';
        }

        $result = $param['param'];

        if($result[0] == 'post_reply_succeed' && $result[2]['pid']){
            updatemoderate('pid', $result[2]['pid']);
        }else if($result[0] == 'post_newthread_succeed' && $result[2]['tid']){
            updatemoderate('tid', $result[2]['tid']);
        }else if($result[0] == 'post_edit_succeed' && $result[2]['pid']){
            if($isfirstpost){
                updatemoderate('tid', $result[2]['tid']);
            }else{
                updatemoderate('pid', $result[2]['pid']);
            }
        }
    }
}

class plugin_ror_threadverify_portal extends plugin_ror_threadverify
{
    var $plugin_name = 'ror_threadverify';
    
    function portalcp_bottom_output()
    {
        global $_G, $aid;
        
        if(! submitcheck('articlesubmit')){
            return '';
        }
     
        $threadverify = $_G['cache']['plugin'][$this->plugin_name];

        if(! $threadverify['portal_is_open_verify']){
            return '';
        }

        $open_group = unserialize($threadverify['open_group']);

        if(! in_array($_G['groupid'], $open_group)){
            return '';
        }

        updatemoderate('aid', $aid);
    }
}