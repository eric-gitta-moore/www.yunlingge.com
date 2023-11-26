<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
loadcache('xinxiu_network');
global $_G;


C::import('class/client','plugin/xinxiu_network',false);


class class_base extends class_client
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetch_salt_by_uid($uid){//通过uid查询salt值
        $data = $this->diy_result_first('salt','ucenter_members',$uid);
        return $data;
    }

    public function fetch_username_by_uid($uid){//通过uid获取用户名
        $data = $this->diy_result_first('username','ucenter_members',$uid);
        return $data;
    }

    public function fetch_uid_by_username($username){//通过用户名获取用户uid
        $data = $this->diy_result_first('uid','common_member',$username);
        return $data;
    }

    public function fetch_password_by_uid($uid){//通过uid获取用户加密密码
        $data = $this->diy_result_first('password','ucenter_members',$uid);
        return $data;
    }

    public function fetch_groupid_by_uid($uid){//通过uid获取用户会员组groupid
        $data = $this->diy_result_first('groupid','common_member',$uid);
        return $data;
    }
    public function fetch_adminid_by_uid($uid){//通过uid获取用户管理组adminid
        $data = $this->diy_result_first('adminid','common_member',$uid);
        return $data;
    }

    public function fetch_login_by_uid($uid){//通过uid返回用户基本信息
        $data = DB::fetch_first("SELECT `uid` ,`username` ,`groupid` ,`adminid` FROM " . DB::table('common_member') . " WHERE `uid` = '$uid'");
        return $data;
    }

    /*
     * 根据uid 获取用户基本数据
     * @staticvar array $users 存放已经获取的用户的信息,避免重复查库
     * @param <int> $uid
     * @return <array>
     */
    public function get_user_by_uid($uid) {//通过uid获取用户基本数据
        $data = $this->getuserbyuid($uid);
        return $data;
    }

    /*
     * 获取当前用户的扩展资料
     * @param $field 字段
     */
    public function get_user_profile($field) {//通过field字段获取用户扩展资料，用户统计表
        $data = $this->getuserprofile($field);
        return $data;
    }



}