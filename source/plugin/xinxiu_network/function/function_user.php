<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);
require_once DISCUZ_ROOT.'./config/config_ucenter.php';
require_once DISCUZ_ROOT.'./uc_client/client.php';

global $_G;

class function_user extends class_base
{
    public $action_all = array('user_info','user_avatar','user_count','user_uc_pm_send','user_uc_friend_ls','user_credist','user_getsafe','user_setsafe','user_set_kz','user_get_kz');

    public function __construct(){
        parent::__construct();
    }

    public function user_info(){
        global $_G;
        $uid = $this->uid_by_token();
        $str = $this->diy_fetch_first('common_member',$uid);
        !empty($str) ? $this->json_output(200,'OK',$str) : $this->json_output(400,'error0020');
    }//获取用户信息

    public function user_avatar($size=''){
        $size = daddslashes($size);
        global $_G;
        $uid = $this->uid_by_token();
        $size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
        $url = $_G['siteurl'].'uc_server/avatar.php?uid='.$uid.'&size='.$size;
        !empty($url) ? $this->json_output(200,'OK',$url) : $this->json_output(400,'error0020');
    }//获取头像，有三个参数

    public function user_count(){//获取扩展信息
        $uid = $this->uid_by_token();
        $str = $this->diy_fetch_first('common_member_count',$uid);
        !empty($str) ? $this->json_output(200,'OK',$str) : $this->json_output(400,'error0020');
    }

    public function user_uc_pm_send($msgto,$message){
        $msgto = daddslashes($msgto);
        $message = daddslashes($message);
        $uid = $this->uid_by_token();
        $str = $this->uc_pm_send($uid,$msgto,'network',$message);
        if($str > 0){
            !empty($str) ? $this->json_output(200,'OK',$str) : $this->json_output(400,'error0020');
        }else{
            return 'err';
        }
    }

    public function user_uc_friend_ls(){
        $uid = $this->uid_by_token();
        $str = $this->uc_friend_ls($uid);
        !empty($str) ? $this->json_output(200,'OK',$str) : $this->json_output(400,'error0020');
    }

    public function user_credist($int,$ruletxt='',$customtitle='',$custommemo=''){
        $ruletxt = daddslashes($ruletxt);
        $custommemo = daddslashes($custommemo);
        $customtitle = daddslashes($customtitle);
        $int = intval($int);
        empty($ruletxt) ? $ruletxt='软件积分提示' :true;
        empty($customtitle) ? $customtitle='软件积分' :true;
        empty($custommemo) ? $custommemo='软件功能积分操作详情' :true;
        $uid = $this->uid_by_token();
        empty($uid) ? $this->json_output(400,'error0021') : true;
        $int = intval($int);
        $type = 'extcredits'.$this->config['credits'];
        $intuid = $this->diy_result_first($type,'common_member_count',$uid);
        ($int + $intuid) < 0 ? $this->json_output(400,'error0022') :true;
        $str = updatemembercount($uid,array($this->config['credits']=>intval($int)),true,'','',$ruletxt,$customtitle,$custommemo);
        !empty($str) ? $this->json_output(400,'error0023') :true;
        $intuid = $this->diy_result_first($type,'common_member_count',$uid);
        $data = array($type => $intuid);
        $this->json_output(200,'',$data);
    }


    public function user_getsafe($safe){// 检查安全码是否正确
        $safe = daddslashes($safe);
        $uid = $this->uid_by_token();
        $getsafe = $this->diy_result_first('field8','xinxiu_network_member',$uid);
        if (empty($getsafe)){
            $this->json_output(400,'error0025');
        }
        $salt = $this->diy_result_first('salt','ucenter_members',$uid);
        $sqloldmd5 = $this->diy_result_first('field8','xinxiu_network_member',$uid);
        $oldmd5 = md5(md5($safe).$salt);
        if ($oldmd5 === $sqloldmd5 ){
            $this->json_output(200,'',array('safe=>'.$safe));
        }else{
            $this->json_output(400,'error0026');
        }
    }

    public function user_setsafe($newsafe,$oldsafe=''){//设置或修改安全码
        $newsafe = daddslashes($newsafe);
        $oldsafe = daddslashes($oldsafe);
        $uid = $this->uid_by_token();
        $salt = $this->diy_result_first('salt','ucenter_members',$uid);
        $sqloldmd5 = $this->diy_result_first('field8','xinxiu_network_member',$uid);
        if (empty($oldsafe)){
            if (empty($sqloldmd5)){
                $sqlnewsafe = md5(md5($newsafe).$salt);
                DB::update('xinxiu_network_member',array('field8'=>$sqlnewsafe),array('uid'=>$uid));
                $this->json_output(200,'',array('safe=>'.$newsafe));
            }else{
                $this->json_output(400,'error0027');
            }
        }else{
            $oldmd5 = md5(md5($oldsafe).$salt);
            if ($oldmd5 === $sqloldmd5 ){
                $sqlnewsafe = md5(md5($newsafe).$salt);
                DB::update('xinxiu_network_member',array('field8'=>$sqlnewsafe),array('uid'=>$uid));
                $this->json_output(200,'',array('safe=>'.$newsafe));
            }else{
                $this->json_output(400,'error0028');
            }
        }
    }

    public function user_get_kz($int){//查找扩展字段信息
        $int = intval($int);
        $uid = $this->uid_by_token();
        $key_arr = array(1,2,3,4,5,6);
        if (in_array($int,$key_arr)){
            $str = $this->diy_result_first('field'.$int,'xinxiu_network_member',$uid);
            $data =array(
                'uid'=>$uid,
                'field'.$int =>$str,
            );
            $this->json_output(200,'',$data);
        }else{
            $this->json_output(400,'error0024');
        }
    }

    public function user_set_kz($int,$kz){//设置扩展字段信息
        $int = intval($int);
        $kz = daddslashes($kz);
        $uid = $this->uid_by_token();
        $key_arr = array(1,2,3,4,5,6);
        if (in_array($int,$key_arr)){
            DB::update('xinxiu_network_member',array('field'.$int=>$kz),array('uid'=>$uid));
            $data =array(
                'uid'=>$uid,
                'field'.$int =>$kz,
            );

            $this->json_output(200,'',$data);
        }else{
            $this->json_output(400,'error0024');
        }
    }
}