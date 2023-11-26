<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);

global $_G;

class function_card extends class_base
{
    public $action_all = array('card_chongzhi','pm_checknew');

    public function __construct(){
        parent::__construct();
    }

    public function card_chongzhi($card){
  
        $uid = $this->uid_by_token();
        empty($uid) ? $this->json_output(400,'error0021') : true;
        $data = DB::fetch_first('select * from %t where id=%s',array('common_card',$card));
        empty($data) ? $this->json_output(400,'error0051') :true;
        $data['status'] == 1 ? true : $this->json_output(400,'error0052');//判断卡片状态1为未使用
        $data['extcreditskey'];//充值积分种类
        $data['extcreditsval'];//充值积分数额
        $data['price'];//卡片面值
        $data['cleardateline'];//卡片到期时间
        $data['makeruid'];//生成uid
        $data['useddateline'];//使用时间
        $data['uid'];//使用者uid


        $sqldata = array(
            'uid'=>$uid,
            'useddateline'=>time(),
            'status' =>2,
            'extcreditskey'=>$data['extcreditskey'],
            'extcreditsval'=>$data['extcreditsval'],
            'price'=>$data['price'],
            'cleardateline'=>$data['cleardateline'],
            'makeruid'=>$data['makeruid'],
            'dateline'=>$data['dateline']
        );
        $str1 = DB::update('common_card',$sqldata,array('id'=>$card));
//        $str = DB::insert('common_card',$sqldata,true,true,'');
        $str1 ? true :$this->json_output(400,'error0053') ;



        $int = $data['extcreditsval'];
        $type = 'extcredits'.$data['extcreditskey'];
//        ($int + $intuid) < 0 ? $this->json_output(400,'error0022') :true;
        $str = updatemembercount($uid,array(intval($data['extcreditskey'])=>$int),true,'','','充值积分','积分充值','软件积分充值卡充值');
        !empty($str) ? $this->json_output(400,'error0054') :true;
/////////推广提成
///

        global $_G;
        loadcache('plugin');
        $tuiguang = $_G['cache']['plugin']['xinxiu_network']['tuiguangticheng'];
//        var_dump($tuiguang);
        $ticheng = explode(',',$tuiguang);
        $num = count($ticheng);
        $tuiguanguid = DB::result_first('select uid from %t where fuid=%d',array('common_invite',$uid));
        for($i=0;$i<$num;++$i){
            updatemembercount($tuiguanguid,array(intval($data['extcreditskey'])=>(100*$ticheng[$i])),true,'','','推广提成','推广提成','多级推广充值提成');
            $tuiguanguid = DB::result_first('select uid from %t where fuid=%d',array('common_invite',$tuiguanguid));
        }

/// ////////推广提成

//        $str = DB::update('common_card',$sqldata,"id=$card");

        $intuid = DB::result_first('select '.$type.' from %t where uid=%d',array('common_member_count',$uid));
//        $intuid = $this->diy_result_first($type,'common_member_count',$uid);
        $jsondata= array(
            'uid'=>$uid,
            'price'=>$data['price'],
            'extcreditskey'=>$type,
            'extcreditsval'=>$data['extcreditsval'],
            $type=>$intuid,
            'useddateline'=>time(),
        );
        $this->json_output(200,'',$jsondata);
    }

}