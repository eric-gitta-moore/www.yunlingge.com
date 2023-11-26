<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class utils {

	
    //in_array二维数组
    function in_2array($keyWord, $stack) {
    
        foreach ($stack as $key => $val) {
    
            if (in_array($keyWord, $val)) {
                return TRUE;
            }
        }
        return FALSE;
    
    }
	
    //in_array多维数组
    function in_morearray($array, $v) {
    
        $data = array();
    
        foreach ($array as $key => $value) {
    
            if (is_array($value)) {
    
                $result = test($value, $v);
    
                if (!empty($result)) {
    
                    $data[$key] = $result;
    
                }
    
            } else {
    
                if ($value == $v) {
    
                    $data[$key] = $v;
    
                }
    
            }
    
        }
    
        return $data;
    
    }
	
    
    function getsetting() {
        global $_G;
        $settings = array(
            'fids' => array(
                'title' => 'settingfidstitle',
                'type' => 'mselect',
                'comment' => 'settingfidscomment',
                'value' => array(),
            ),
        );
        loadcache(array('forums'));
        $settings['fids']['value'][] = array(0, plang('bbshome'));
        if(empty($_G['cache']['forums'])) $_G['cache']['forums'] = array();
        foreach($_G['cache']['forums'] as $fid => $forum) {
            $settings['fids']['value'][] = array($fid, ($forum['type'] == 'forum' ? str_repeat('&nbsp;', 4) : ($forum['type'] == 'sub' ? str_repeat('&nbsp;', 8) : '')).$forum['name']);
        }
    
    
        //var_dump($this->categoryvalue);
        return $settings;
    }
    
    function gettargetsname($targets) {
        global $_G;
        $targetsname = "";
    
        if(in_array('1',$targets)){
            $targetsname .= plang('settingtargetspc').",";
        }
        if(in_array('2',$targets)){
            $targetsname .= plang('settingtargetswsq').",";
        }
        if(in_array('3',$targets)){
            $targetsname .= plang('settingtargetsmobile').",";
        }
        $targetsname = rtrim($targetsname,',');
        return $targetsname;
    }
    
    function getforumsname($fid,$fids,$isarray = false) {
        global $_G;
        $fidname = "";
        loadcache(array('forums'));
        if(empty($_G['cache']['forums'])) {
            $fidname = plang('nullstr');
            return $fidname;
        }
        if($isarray){
            if(in_array('0',$fids)){
                $fidname .= plang('bbshome').",";
            }
            foreach($_G['cache']['forums'] as $fid => $forum) {
                if(in_array($forum['fid'],$fids)){
                    $fidname .= $forum['name'].",";
                }
            }
            $fidname = rtrim($fidname,',');
        }else{
            if($fid == '0'){
                $fidname = plang('bbshome');
            }
            foreach($_G['cache']['forums'] as $fid => $forum) {
                if($forum['fid'] == $fid){
                    $fidname = $forum['name'];
                }
            }
        }
    
    
        return $fidname;
    }
    
    function getusergroupname($usergroup,$usergroups,$isarray = false) {
        global $_G;
        $usergroupname = "";
        //$query = C::t('common_usergroup')->fetch_all_not(array(6, 7), true);
        $query = C::t('common_usergroup')->fetch_all_not(array(), true);
        if(empty($query)) {
            $usergroupname = plang('nullstr');
            return $usergroupname;
        }
    
        if($isarray){
            foreach($query as $group) {
                if(in_array($group['groupid'],$usergroups)){
                    $usergroupname .= $group['grouptitle'].",";
                }
            }
            $usergroupname = rtrim($usergroupname,',');
        }else{
            foreach($query as $group) {
                if($group['groupid'] == $usergroup){
                    $usergroupname = $group['grouptitle'];
                }
            }
        }
    
    
        return $usergroupname;
    }
}
//WWW.xhkj5.com
?>