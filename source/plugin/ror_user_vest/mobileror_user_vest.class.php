<?php
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

class mobileplugin_ror_user_vest
{
    var $plugin_name = 'ror_user_vest';
    
    function global_footer_mobile()
    {
        global $_G;
        
        $settings = $_G['cache']['plugin'][$this->plugin_name];
        
        $html = '';

        if((! in_array($_GET['action'], array('newthread','reply')) && $_GET['mod'] != 'viewthread') || ! $settings['forum_thread_open_vest']){
            return $html;
        }
        
        $group_is_open = $settings['group_is_open'] ? unserialize($settings['group_is_open']) : array();
        $send_uid = $settings['send_uid'] ? explode(',', $settings['send_uid']) : array();
        if((! $send_uid || ! in_array($_G['uid'], $send_uid)) && (! $group_is_open || ! in_array($_G['groupid'], $group_is_open))){
            return $html;
        }

        $action = in_array($_GET['action'], array('newthread','reply')) ? 'post' : 'fastpost';
        
        $limit_max = 50;
        $limit = $settings['wap_vest_number'] ? $settings['wap_vest_number'] : 30;
        $limit > $limit_max && $limit = $limit_max;

        $sql = 'SELECT uid,username FROM '.DB::table('plugin_'.$this->plugin_name).' ORDER BY weight DESC,dateline DESC LIMIT '.$limit;
        $vest_list = DB::fetch_all($sql);
 
        $vest_default = array(
            'uid'=>$_G['uid'],
            'username'=>$_G['username']
        );
        array_unshift($vest_list, $vest_default);
        
        $vest_rand = array(
            'uid'=>0,
            'username'=>lang('plugin/ror_user_vest', 'vest_rand')
        );
        array_unshift($vest_list, $vest_rand);
        
        $vest_select = '<select name="ror_vest_uid" class="px sort_sel ror_vest_uid">';
        foreach($vest_list as $value){
            $vest_select .= '<option value="'.$value['uid'].'">'.$value['username'].'</option>';
        }
        $vest_select .= '</select>';
        
 $html = <<<EOT
<script>
var vest_action = '{$action}';
jQuery(function($){
    if(vest_action == 'post'){
        $('.post_from').find('ul:first').append('<li>{$vest_select}</li>');
    }else{
        $('#fastpostsubmitline').append('{$vest_select}');
        $('.ror_vest_uid').css('margin-left', '10px');
    }
});
</script>
EOT;
        return $html;
    }
    
    function vest_init()
    {
        global $_G;
    
        $settings = $_G['cache']['plugin'][$this->plugin_name];
    
        $vest_uid = 0;
        if($_GET['ror_vest_uid']){
            $vest_uid = intval($_GET['ror_vest_uid']);
        }else if($settings['vest_is_rand']){
            $sql = 'SELECT uid FROM '.DB::table('plugin_'.$this->plugin_name).' ORDER BY rand() LIMIT 1';
            $vest_uid = DB::result_first($sql);
        }

        if(! $vest_uid){
            return FALSE;
        }
    
        $vest = getuserbyuid($vest_uid, 1);
        if(! $vest){
            return FALSE;
        }
    
        space_merge($vest, 'status');
    
        //保存登陆用户uid
        $_G[$this->plugin_name.'_uid'] = $_G['uid'];
    
        //模拟马甲用户登陆
        $_G['uid'] = $vest['uid'];
        $_G['username'] = $vest['username'];
        $_G['member'] = $vest;
        $_G['setting']['floodctrl'] = 0;
        $_G['forum']['ismoderator'] = 1;
        $_G['group']['seccode'] = '';
        $_GET['formhash'] = $_G['formhash'] = formhash();
    
        //是否随机ip
        if($settings['is_rand_ip']){
            $_G['clientip'] = C::t('#'.$this->plugin_name.'#admin_vest')->get_rand_ip();
        }
    
        //记录马甲在线时间
        //上次活动时间
        $lastactivity = $vest['lastactivity'];
        $oltimespan = $_G['setting']['oltimespan'];
        if(empty($_G['setting']['sessionclose']))
        {
            if($lastactivity + 600 < TIMESTAMP)
		    {
		        $discuz_action = APPTYPEID;
		        $discuz_tid = intval($_G['tid']);
		        $discuz_fid = intval($_G['fid']);
		        
		        $sql = 'SELECT sid FROM '.DB::table('common_session').' WHERE uid='.$_G['uid'];
		        $guise_ss = DB::fetch_first($sql);
		        $now_sid = $guise_ss['sid'] ? $guise_ss['sid'] : random(6);
		        $ips = explode('.', $_G['clientip']);
		        $sql = 'SELECT svalue FROM '.DB::table('common_setting')." where skey='maxonlines'";
		        $setting = DB::fetch_first($sql);
		        $sql = 'SELECT COUNT(sid) FROM '.DB::table('common_session');
		        $sessioncount = DB::result_first($sql);
		        $maxonlines = $setting['svalue'] ? $setting['svalue'] : 5000;
		        if($maxonlines < $sessioncount){
		            $sql = 'DELETE FROM '.DB::table('common_session');
		            DB::query($sql);
		        }
		        $timestamp = TIMESTAMP;
		        $sql = "REPLACE INTO ".DB::table('common_session')."(sid, ip1, ip2, ip3, ip4, groupid, lastactivity, action, fid, tid, uid, username)VALUES ('$now_sid', '$ips[0]','$ips[1]','$ips[2]','$ips[3]', '$vest[groupid]', '$timestamp','$discuz_action','$discuz_fid','$discuz_tid','".$_G['uid']."','".$_G['username']."')";
		        DB::query($sql, 'UNBUFFERED');
		    }
    
            if($oltimespan && TIMESTAMP - $lastactivity > $oltimespan * 60)
            {
                $sql = 'SELECT lastupdate FROM '.DB::table('common_onlinetime').' WHERE uid='.$_G['uid'];
                $lastupdate = DB::result_first($sql);
                if($lastupdate && TIMESTAMP - $lastupdate > $oltimespan * 60){
                    $sql = 'UPDATE '.DB::table('common_onlinetime').' SET total=total+'.$oltimespan.',thismonth=thismonth+'.$oltimespan.',lastupdate='.TIMESTAMP.' WHERE uid='.$_G['uid'];
                    DB::query($sql);
                }else{
                    $add = array('uid' => $_G['uid'],'thismonth'=>$oltimespan,'total'=>$oltimespan,'lastupdate'=>TIMESTAMP);
                    DB::insert('common_onlinetime', $add, FALSE, TRUE);
                }
    
                $sql = 'SELECT total FROM '.DB::table('common_onlinetime').' WHERE uid='.$_G['uid'];
                $total = DB::result_first($sql);
                $oltime = $total ? round(intval($total) / 60) : 0;
                if($oltime){
                    $sql = 'UPDATE '.DB::table('common_member_count').' SET oltime='.$oltime.' WHERE uid='.$_G['uid'];
                    DB::query($sql, 'UNBUFFERED');
                }
            }
        }
    
        //更新马甲用户活跃状态
        $edit = array(
            'lastip'=>$_G['clientip'],
            'lastvisit'=>TIMESTAMP,
            'lastactivity'=>TIMESTAMP,
            'lastpost'=>TIMESTAMP
        );
    
        C::t('common_member_status')->update($_G['uid'], $edit);
    
        return TRUE;
    }
}

class mobileplugin_ror_user_vest_forum extends mobileplugin_ror_user_vest
{
    var $plugin_name = 'ror_user_vest';
    
    function post_top()
    {
        global $_G, $seccodecheck, $secqaacheck;
        
        $settings = $_G['cache']['plugin'][$this->plugin_name];

        $group_is_open = $settings['group_is_open'] ? unserialize($settings['group_is_open']) : array();
        $send_uid = $settings['send_uid'] ? explode(',', $settings['send_uid']) : array();
        if((! $send_uid || ! in_array($_G['uid'], $send_uid)) && (! $group_is_open || ! in_array($_G['groupid'], $group_is_open))){
            return '';
        }
        
        if(! submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck) && ! submitcheck('replysubmit', 0, $seccodecheck, $secqaacheck)){
            return '';
        }
        
        if($_GET['ror_vest_uid'] == $_G['uid']){
            return '';
        }
        
        if($_GET['action'] == 'newthread' && $settings['forum_thread_open_vest']){
            $this->vest_init();
        }

        if($_GET['action'] == 'reply' && $settings['forum_post_open_vest']){
            $this->vest_init();
        }
        
        return '';
    }
    
    function post_ror_user_vest_message($param)
    {
        global $_G;
        
        $settings = $_G['cache']['plugin'][$this->plugin_name];

        $result = $param['param'];

        if($result[0] == 'post_newthread_succeed' || $result[0] == 'post_reply_succeed')
        {
    		$uid = $_G[$this->plugin_name.'_uid'];
    		if(! $uid){
    		    return '';
    		}
    		
    		$tid = $result[2]['tid'];
    		$pid = $result[2]['pid'];
    		if(! $tid || ! $pid){
    		    return '';
    		}

    		if(isset($_GET['attachnew'])){
    		    $sql = 'UPDATE '.DB::table('forum_attachment').' SET uid='.$_G['uid'].' WHERE uid='.$uid.' and tid='.$tid.' and pid='.$pid;
                DB::query($sql, 'UNBUFFERED');
                $tableid = intval(substr($tid, -1));
                $sql = 'UPDATE '.DB::table('forum_attachment_'.$tableid).' SET uid='.$_G['uid'].' WHERE uid='.$uid.' and tid='.$tid.' and pid='.$pid;
            	DB::query($sql, 'UNBUFFERED');
			}
			
			//更新用户组
			$vest_uid = $_G['uid'];
			$_G['uid'] = $uid;
			checkusergroup($vest_uid);
			$_G['uid'] = $vest_uid;
        }
        
        return '';
    }
}