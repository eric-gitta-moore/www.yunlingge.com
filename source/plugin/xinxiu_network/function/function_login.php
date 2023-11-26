<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);

global $_G;

class function_login extends class_base
{
    public $action_all = array('login_user','login_register','login_config','update_cookies','login_getsafe','login_setsafe','key');
    public function __construct()
    {
        parent::__construct();
    }

    public function login_user($username,$password,$questionid,$answer,$isuid){
        $isuid = intval($isuid);
        $questionid = intval($questionid);
        $username = daddslashes($username);
        $answer = daddslashes($answer);
        $password = daddslashes($password);
        $uid = C::t('common_member')->fetch_uid_by_username($username);
        if (empty($uid)){
            $this->json_output(400,'error00112');
        }
        if (!empty($questionid)){
            $checkques = 1;
        }
        $data = uc_user_login($username, $password,$isuid,$checkques,$questionid,$answer);
        $uid = $data['0'];
        if($uid > 0) {
            $data = $this->fetch_login_by_uid($uid);
            $result = array(
                'uid' => $uid,
                'username' => $data['username'],
                'groupid' => $data['groupid'],
                'adminid' => $data['adminid'],
                'token' => $this->user_login_ini($uid),
            );
            $this->json_output(200,'',$result);
        } elseif($uid == -1) {
            $this->json_output(400,'error0011');
        } elseif($uid == -2) {
            $this->json_output(400,'error0012');
        } else {
            $this->json_output(400,'error0013');
        }

    }

    public function user_login_ini($uid){
        $uid = intval($uid);
        DB::insert('xinxiu_network_member',array('uid'=>$uid),false,false,true);//初始化插件的自定义表
        $data = $this->fetch_login_by_uid($uid);
        $token = $this->login_set_token($uid,$data['username'],$data['groupid'],$data['adminid']);
        return $token;
    }

    public function login_register($username,$password,$email,$invite=''){//用户注册，通过uc注册
        $invite = daddslashes($invite);
        $username = daddslashes($username);
        $email = daddslashes($email);
        $password = daddslashes($password);
        if($uid <= 0) {
            if($uid == -1) {
                $this->json_output(400,'error0015');
            } elseif($uid == -2) {
                $this->json_output(400,'error0016');
            } elseif($uid == -3) {
                $this->json_output(400,'error0017');
            } elseif($uid == -4) {
                $this->json_output(400,'error0018');
            } elseif($uid == -5) {
                $this->json_output(400,'error0019');
            } elseif($uid == -6) {
                $this->json_output(400,'error00110');
            } else {
                $this->json_output(400,'error00111');
            }
        } else {
            $result = array(
                'uid' => $uid,
                'username' => $username,
                'password' => $password,
                'email' => $email,
            );
//////////////推荐uid填写代码
            if (!empty($invite)){
                $tjdata =array(
                    'uid'=>abs(intval(trim($invite))),
                    'fuid'=>$uid,
                    'fusername'=>$username,
                    'code'=>'network',
                    'dateline'=>time(),
                    'endtime'=>time(),
                    'status'=>2,
                    'inviteip'=>$_SERVER['REMOTE_ADDR'],
                    'regdateline'=>time()
                );
                DB::insert('common_invite',$tjdata,true,true,'');
                $result['inviteuid'] = abs(intval(trim($invite)));
            }
//////////////推荐uid填写代码

            ///=============自动激活代码===开始
            $salt = $this->diy_result_first('salt','ucenter_members',$uid);
            $passwordmd5 = md5(md5($password).$salt);
            $this->config['dailiip'];

            $member =array(
                'uid'=>$uid,
                'username'=>$username,
                'password'=>$passwordmd5,
                'email'=>$email,
                'adminid'=>0,
                'groupid'=>10,
                'regdate'=>time(),
                'credits'=>0,
                'timeoffset'=>9999

            );

            DB::insert('common_member',$member,true,true,'');

            $status =array(
                'uid'=>$uid,
                'regip'=>$this->config['dailiip'],
                'lastip'=>$this->config['dailiip'],
                'lastvisit'=>time(),
                'lastactivity'=>time(),
                'lastpost'=>0,
                'lastsendmail'=>0
            );
            DB::insert('common_member_status',$status,true,true,'');
            $profile =array(
                'uid'=>$uid,
            );
            DB::insert('common_member_profile',$profile,true,true,'');
            $forum=array(
                'uid'=>$uid,
            );
            DB::insert('common_member_field_forum',$forum,true,true,'');
            $home=array(
                'uid'=>$uid,
            );
            DB::insert('common_member_field_home',$home,true,true,'');
            $count=array(
                'uid'=>$uid,
                'extcredits1'=>0,
                'extcredits2'=>0,
                'extcredits3'=>0,
                'extcredits4'=>0,
                'extcredits5'=>0,
                'extcredits6'=>0,
                'extcredits7'=>0,
                'extcredits8'=>0,
            );
            DB::insert('common_member_count',$count,true,true,'');

            ///=============自动激活代码===结束

            $this->json_output(200,'',$result);
        }

    }

    public function login_config($plugin=''){//获取插件配置信息,为空获取全部，不为空获取全部
        global $_G;
        $plugin = daddslashes($plugin);
        loadcache('plugin');
        $data = $_G['cache']['plugin'][$this->identifier];
        $data['groupids'] = unserialize($data['groupids']);
        if ($plugin == '') {
            $result = array(
                'version' => $data['version'],
                'Notice' => $data['Notice'],
                'updateurl' => $data['updateurl']
            );
            $this->json_output(200, '', $result);
        } else {
            $result = array(
                $plugin => $data[$plugin],
            );
            if (empty($data[$plugin])) {
                $this->json_output(400, 'error0014');
            } else {
                $this->json_output(200, '', $result);
            }
        }
    }

}


