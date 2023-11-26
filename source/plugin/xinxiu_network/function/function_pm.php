<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);
require_once DISCUZ_ROOT.'./config/config_ucenter.php';
require_once DISCUZ_ROOT.'./uc_client/client.php';

global $_G;

class function_pm extends class_base
{
    public $action_all = array('pm_send','pm_checknew');

    public function __construct(){
        parent::__construct();
    }

    public function pm_checknew(){
        $uid = $this->uid_by_token();
        $str = uc_pm_checknew($uid,3);
        $str > 0 ? $this->json_output(200,'OK',$str) : true;
    }
    public function pm_send($msgto,$message){
        $msgto = daddslashes($msgto);
        $message = daddslashes($message);
        $uid = $this->uid_by_token();
        $str = uc_pm_send($uid,$msgto,'network',$message);
        if($str > 0){
            $data=array(
                'pmid' => $str,
                'msgto' => $msgto,
                'message' => $message,
            );
            !empty($str) ? $this->json_output(200,'OK',$data) : true;
        }else{
            $this->json_output(400,'error0041');
        }
    }

}