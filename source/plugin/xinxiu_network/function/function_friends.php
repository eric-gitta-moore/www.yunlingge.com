<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);
require_once DISCUZ_ROOT.'./config/config_ucenter.php';
require_once DISCUZ_ROOT.'./uc_client/client.php';

global $_G;

class function_friends extends class_base
{
    public $action_all = array('friends_add','friends_request','friends_ls','friends_add_uid','friends_delete');

    public function __construct(){
        parent::__construct();
    }

    public function friends_add($fuid,$note='',$gid=1){
        $fuid = intval($fuid);
        $gid = intval($gid);
      
        $uid = $this->uid_by_token();
        $fusername = DB::result_first('select username from %t where uid=%d',array('ucenter_members',$uid));
//        $fusername = $this->fetch_username_by_uid($uid);
//        DB::query("SET NAMES UTF8");
        DB::query("SET NAMES GB2312");//设置编码存入数据库
        $sqldata = array(
            'uid' => $fuid,
            'fuid' => $uid,
            'fusername' => $fusername,
            'note' => $note,
            'dateline' => time(),
            'gid' => $gid
        );
        $str = DB::insert('home_friend_request',$sqldata,true,true,'');
//        $str = C::t('home_friend_request')->insert($sqldata);
//        $note= urlencode($note);
        $note = iconv("GB2312","UTF-8",$note);
        $data = array(
            'fuid'=>$fuid,
            'note'=>$note,
            'gid' => $gid,
            'dateline' => time(),
        );
        $str ? $this->json_output(200,'',$data) : $this->json_output(400,'error0031');
    } //添加好友


    public function friends_request(){
        $uid = $this->uid_by_token();
        $str = $this->diy_fetch_first_all('home_friend_request',$uid);
        $str ? $this->json_output(200,'',$str) : $this->json_output(400,'error0036');
    }//查询好友请求

    public function friends_ls(){
        $uid = $this->uid_by_token();
        $str = $this->diy_fetch_first_all('home_friend',$uid);
        $str ? $this->json_output(200,'',$str) : $this->json_output(400,'error0037');
    }//查询好友列表
    public function friends_delete(){
        $fuid = intval($fuid);
        $table = 'home_friend';
        $uid = $this->uid_by_token();
        $data = DB::fetch_all('SELECT * FROM %t WHERE uid = %d and fuid = %d',array($table,$uid,$fuid));
        $data = $data[0];
        empty($data) ? $this->json_output(400,'error0038') : true;
        $data1 =  DB::delete($table,"uid=$uid and fuid=$fuid",true);
        $data2 =  DB::delete($table,"uid=$fuid and fuid=$uid",true);
        $str = array(
            'fuid' => $fuid
        );
        $data1 && $data2 ? $this->json_output(200,'',$str) : $this->json_output(400,'error0035');
    }//删除好友

    public function friends_add_uid($fuid){
        $fuid = intval($fuid);
        $table = 'home_friend_request';
        $uid = $this->uid_by_token();
        $data = DB::fetch_all('SELECT * FROM %t WHERE uid = %d and fuid = %d',array($table,$uid,$fuid));
        $data = $data[0];
        empty($data) ? $this->json_output(400,'error0032') : true;
        $uiddata = array(
            'uid' => $data['uid'],
            'fuid'=>$data['fuid'],
            'fusername'=>$data['fusername'],
            'gid' => $data['gid'],
            'dateline'=>time()
        );
        $fusername = $this->fetch_username_by_uid($data['uid']);
        $fuiddata =array(
            'uid' => $data['fuid'],
            'fuid'=>$data['uid'],
            'fusername'=>$fusername,
            'gid' => $data['gid'],
            'dateline'=>time()
        );
        $str = DB::insert('home_friend',$uiddata,true,true,'');
        $str ? true : $this->json_output(400,'error0033');
        $str = DB::insert('home_friend',$fuiddata,true,true,'');
        $str ? true : $this->json_output(400,'error0033');
//        echo "uid=$uid and fuid=$fuid";
        $data =  DB::delete($table,"uid=$uid and fuid=$fuid",true);
        $data ? $this->json_output(200,'',$uiddata) : $this->json_output(400,'error0034');
    }



    public function user_uc_pm_send($msgto,$message){
        $uid = $this->uid_by_token();
        $str = $this->uc_pm_send($uid,$msgto,'network',$message);
        if($str > 0){
            !empty($str) ? $this->json_output(200,'OK',$str) : $this->json_output(400,'error0020');
        }else{
            return 'err';
        }
    }

}