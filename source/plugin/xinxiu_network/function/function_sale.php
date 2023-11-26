<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
C::import('class/base','plugin/xinxiu_network',false);
C::import('class/client','plugin/xinxiu_network',false);

global $_G;

class function_sale extends class_base
{
    public $action_all = array('sale_credits_remit','sale_credits_ls','sale_credits_bank','sale_connt','sale_buy','sale_ls');

    public function __construct(){
        parent::__construct();
    }

    public function sale_credits_buy(){//买积分

    }
    public function sale_credits_sell(){//卖积分

    }

    public function sale_credits_remit($id,$admintext=''){//打款处理
        $id = intval($id);
        $admintext = daddslashes($admintext);
        $uid = $this->uid_by_token();
        $uid == 1 ? true : $this->json_output(400,'NOT admin');
        $data = array(
            'status'=>2,
            'admindateline'=>time(),
            'admintext'=>$admintext
        );
        DB::update('xinxiu_network_tixian',$data,array('id'=>$id),true);
        $str = DB::fetch_all('SELECT * FROM %t WHERE id=%d',array('xinxiu_network_tixian',$id));
        $this->json_output(200,'',$str);
    }


    public function sale_credits_ls(){//获取所有提现信息
        $str = DB::fetch_all('SELECT * FROM %t WHERE typeid=1',array('xinxiu_network_tixian'));
        $this->json_output(200,'',$str);
    }

    public function sale_credits_bank($extcreditsval,$uidtext=''){//积分提现
        $extcreditsval = intval($extcreditsval);
        $uidtext = daddslashes($uidtext);
        global $_G;
        loadcache('plugin');
        $extcreditsval =abs(intval($extcreditsval));
        empty($_G['cache']['plugin']['xinxiu_network']['jiaoyi']) ? $this->json_output(400,'error0061') :true;
        $uid = $this->uid_by_token();
        $type = 'extcredits'.$_G['cache']['plugin']['xinxiu_network']['jiaoyi'];
        $jifen = $this->diy_result_first($type,'common_member_count',$uid);
        $extcreditsval > $jifen ? $this->json_output(400,'error0064') : true; //判断积分是否够用

 //===================开始提现
        $data1 = $_G['cache']['plugin']['xinxiu_network']['tixian'];
        $data = explode(';',$data1);
        $num = count($data);

        for($i=0;$i<$num;++$i){

            $str = explode('|',$data[$i]);

            $str1 = explode('-',$str[0]);

            if ($str1[0] <= $extcreditsval && $extcreditsval <= $str1[1]){
                $price = round($extcreditsval * (1-$str[1]));//四舍五入取正数

                updatemembercount($uid,array(intval($_G['cache']['plugin']['xinxiu_network']['jiaoyi'])=>-$extcreditsval),true,'','','积分提现','积分提现','积分提现操作');

                $sqldata =array(
                    'makeruid'=>$uid,
                    'price'=>$price,
                    'extcreditskey'=>$_G['cache']['plugin']['xinxiu_network']['jiaoyi'],
                    'extcreditsval'=>$extcreditsval,
                    'status'=>1,//1代表提现
                    'uiddate'=>time(),
                    'uidtext'=>$uidtext
                );
                $id = DB::insert('xinxiu_network_tixian',$sqldata,true,false,true);
                $id > 0 ? $this->json_output(200,'',$sqldata) : $this->json_output(400,'tixian');
            }

        }
        $this->json_output(400,'err');
//===================提现结束
    }

    public function sale_connt($price=''){//取可购买卡片数量
        $price = intval($price);
        if (empty($price)){
            $str = DB::fetch_all('SELECT * FROM %t WHERE makeruid=1 and status=1',array('common_card'));
            $data =array(
                'count'=>count($str)
            );
            $this->json_output(200,'',$data);
        }else{
            $str = DB::fetch_all('SELECT * FROM %t WHERE makeruid=1 and status=1 and price=%d',array('common_card',$price));
            $data =array(
                'price'=>$price,
                'count'=>count($str)
            );
            $this->json_output(200,'',$data);
        }
    }

    public function sale_buy($int,$price){//购卡操作，数量和卡片面值
        $int= abs(intval($int));
        $price =abs(intval($price));
        empty($this->config['jiaoyi']) ? $this->json_output(400,'error0061') :true;
        $uid = $this->uid_by_token();
        $type = 'extcredits'.$this->config['jiaoyi'];

        $kuchun = DB::fetch_all('SELECT makeruid FROM %t WHERE makeruid=1 and status=1 and price=%d',array('common_card',$price));
        $intkuicun =count($kuchun);
        empty($intkuicun) ? $this->json_output(400,'error0062') : true;
        $int > $intkuicun ? $this->json_output(400,'error0063') : true;

//////////////////提卡折扣
        global $_G;
        loadcache('plugin');
        $jisuan = $int * $price;
        $groupid = $this->diy_result_first('groupid','common_member',$uid);
        $data = $_G['cache']['plugin']['xinxiu_network']['tikazhekou'];
        if (!empty($data)){
            $zhekou = explode(';',$data);
            foreach($zhekou as $key=>$v){
                $str = explode('|',$v);
                $str[0] =trim($str[0]);
                $str[1] =trim($str[1]);
                if ($str[0]===$groupid){
                    $str[1]=round($str[1],2);
                    $jisuan = intval($int * $price * $str[1]);
                }
            }
        }

//////////////////提卡折扣
        $jifen = $this->diy_result_first($type,'common_member_count',$uid);
        $jisuan > $jifen ? $this->json_output(400,'error0064') : true; //判断积分是否够用

        $str = DB::fetch_all('SELECT * FROM %t WHERE makeruid =1 and status =1 and price=%d'.DB::limit($int),array('common_card',$price));
        foreach($str as $key=>$v){
            DB::update('common_card',array('makeruid'=>$uid,'dateline'=>time(),'cleardateline'=>time()+31536000),array('id'=>$v['id']));
        }
        updatemembercount($uid,array($type=>-$jisuan),true,'','','提取充值卡','提取充值卡','代理提卡操作');
        $sale_all = DB::fetch_all('SELECT `id` ,`price` ,`extcreditskey` ,`extcreditsval` ,`cleardateline` FROM %t WHERE makeruid=%d and status=1',array('common_card',$uid));
        $this->json_output(200,'yuanjia='.($int * $price).',zhekoujia='.$jisuan,$sale_all);
    }

    public function sale_ls($do=0){//查看自己的卡密
        $do = intval($do);
        $uid = $this->uid_by_token();
        if ($do==0){
            $sale_all = DB::fetch_all('SELECT * FROM %t WHERE makeruid=%d ',array('common_card',$uid));
            $this->json_output(200,'',$sale_all);
        }elseif ($do==1){
            $sale_all = DB::fetch_all('SELECT * FROM %t WHERE makeruid=%d and status=1',array('common_card',$uid));
            $this->json_output(200,'',$sale_all);
        }elseif ($do=2){
            $sale_all = DB::fetch_all('SELECT * FROM %t WHERE makeruid=%d and status=2',array('common_card',$uid));
            $this->json_output(200,'',$sale_all);
        }else{
            $sale_all = DB::fetch_all('SELECT * FROM %t WHERE makeruid=%d ',array('common_card',$uid));
            $this->json_output(200,'',$sale_all);
        }

    }
}