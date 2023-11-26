<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once DISCUZ_ROOT.'./config/config_ucenter.php';
require_once DISCUZ_ROOT.'./uc_client/client.php';
//require_once DISCUZ_ROOT.'./source/plugin/xinxiu_network/license.php';
loadcache('xinxiu_network');
global $_G;

class class_client {
    public $config = array();//读取插件配置文件
    public $lang = array();
    public $identifier = 'xinxiu_network';
    public $errcode = 200;
    public $errmsg = 'OK';
    public $key = '';//传输密钥
    public $token = '';//传输token
    public $action = '';//传输方法
    public $action_all = array();//方法合集为空
    public $data;//JSON数据接收数组
    public $table_log = '#xinxiu_network#xinxiu_network_log';//日志表调用
    public $stime; //计算执行时间

    public function __construct() {
        $this->stime = microtime(true); //计算执行时间
        global $_G;
        loadcache('plugin');
        $this->config = $_G['cache']['plugin'][$this->identifier];
        $this->action = $this->safe_check('action',true);
        $this->login_action();//判断接口方法是否被禁止
        $this->login_kaiguan();//判断插件是否开启
        $this->login_daili_ip();//判断是否使用代理IP
        $this->login_groupid();//判断用户组是否被禁止
        if($this->action == 'login_user' or $this->action == 'login_config' or $this->action == 'login_register'){
            $this->key = $this->safe_check('key',true);
            $this->auth_key();
        }else{
            $this->token = $this->safe_check('token',true);
            $this->auth_token();
        }
        !in_array($this->action, $this->action_all) ? $this->json_output(400,'error010') : true;

    }
///--------------------登录判断key和token类
    protected function auth_key() {
        $key_arr = array($this->config['apikey']);
        !in_array($this->key, $key_arr) ? $this->json_output(401,'error02') : true ;
    }

    protected function auth_token() {
        $uid = $this->uid_by_token();
        $key_arr = $this->fetch_token_by_uid($uid);
        $this->token != $key_arr ? $this->json_output(401,'error05') : true;

    }//验证token是否正确


///--------------------获取和操作token、cookies类、加密类


    public function diy_jiami($str){
        $data = base64_encode($str);
        return $data;
    }

    public function diy_jiemi($str){
        $data = base64_decode($str);
        return $data;
    }

    public function login_set_token($uid,$username,$groupid,$adminid){
        global $_G;
        $ip = explode('.',$_G['clientip']);
        $token = $this->diy_jiami($uid.','.$username.','.$groupid.','.$adminid.','.time());
        $id = $this->diy_result_first('id','xinxiu_network_token',$uid);
        $loginint = $this->diy_result_first('loginint','xinxiu_network_token',$uid);
        $loginint = $loginint + 1;
        $data = array(
            'uid' => $uid,
            'username' => $username,
            'ip1' => $ip[0],
            'ip2' => $ip[1],
            'ip3' => $ip[2],
            'ip4' => $ip[3],
            'groupid' => $groupid,
            'adminid' => $adminid,
            'lastactivity' => time(),
            'token' => $token,
            'loginint' => $loginint,
        );
        if ($id){
            $data['id'] = $id;
            $this->diy_update('xinxiu_network_token',$data,$uid);
            return $token;
        }else{
            $this->diy_insert('xinxiu_network_token',$data);
            return $token;
        }

    }

    public function uid_by_token($do=null){
        $str = $this->diy_jiemi($_GET['token']);
        $strl = explode(',',$str);
        if (empty($do)){
            return $strl[0];
        }elseif ($do==1){
            return $strl[1];
        }elseif ($do==2){
            return $strl[2];
        }elseif ($do==3){
            return $strl[3];
        }else{
            return $strl[0];
        }
    }

    public function fetch_token_by_uid($uid){
        $data = $this->diy_result_first('token','xinxiu_network_token',$uid);
        return $data;
    }


    public function login_action(){
        global $_G;
        loadcache('plugin');
        $action = $_G['cache']['plugin']['xinxiu_network']['isaction'];
        $actions = explode(',',$action);
        $num = count($actions);
        for($i=0;$i<$num;++$i){
            $actions[$i] === $this->action ? $this->json_output(400,$this->action.' Not opened') : true;
        }
    }
    public function login_kaiguan(){
        if (!$this->config['iskaiguan']) {
            $this->json_output(403,'error01');
        }
    }

    public function login_daili_ip(){
        if ($this->config['dailiip']){
            empty($_SERVER['HTTP_VIA']) or $this->json_output(400,'error03') ;
        }
    }

    public function login_ip(){
        global $_G;
        debug($_G['clientip']);
        $ip = explode('.',$_G['clientip']);
        $data = C::t('#xinxiu_network#common_banned')->fetch_by_ip($ip[0],$ip[1],$ip[2],$ip[3]);//debug待处理
        empty($data) ? false : $_G['timestamp'] < $data['expiration'] ? exit('Your IP is prohibited, and the time of release is'.date("Y-m-d H:i:s",$data['expiration'])) : false;
    }


    public function login_md5($rmd5){
        if (!empty($this->config['ismd5'])){
            $this->config['ismd5'] === $rmd5 ? true : $this->json_output(400,'error08');
        }
    }

    public function login_groupid(){
        global $_G;
        $data = $_G['cache']['plugin']['xinxiu_network']['groupids'];
        $data = unserialize($data);
        $groupid = $this->uid_by_token(2);
        in_array($groupid,$data) ? $this->json_output(401,'error09') : false;
    }


    public function safe_check($param, $iscore = false) {
        $value = $_GET[$param];
        $value  = trim(addslashes($value));
        $iscore && empty($value) ? $this->json_output(401,'error06:'.$param) : true;
        return $value;
    }

    public function safe_check_uid($param, $iscore = false) {
        $value = $_GET[$param];
        $value = abs(intval($value));
        $value  = trim(addslashes($value));
        $iscore && empty($value) ? $this->json_output(401,'error06'.$param) : true;
        return $value;
    }


    public function gbk_to_utf8($arr){
        if (CHARSET != 'gbk'){
            return $arr;
        }
        if(is_array($arr) && count($arr)){
            foreach($arr as $key=>$value){
                if(is_array($value)){
                    $arrRs[$key] = $this->is_utf8($value);
                }else{
                    $arrRs[$key] = diconv($value,'GBK','UTF-8');
                }
            }
            return $arrRs;
        }
        return null;
    }

    private function is_utf8($string) {
        return preg_match('%^(?:
            [\x09\x0A\x0D\x20-\x7E] # ASCII
            | [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
            | \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
            | \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
            | \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
            | \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
            )*$%xs', $string);
    }

    public function json_output($code,$result='',$data=[]) {
        global $_G;
        empty($result) ? $result='OK' : true;
        if (!$code == 200){
            $this->errcode = $code;
            $this->errmsg = $result;
        }else{
            $this->errcode = $code;
            $this->errmsg = $result;
            $this->data = $data;
        }
        $this->data = $this->gbk_to_utf8($this->data);
        $etime=microtime(true);
        $total= $etime-$this->stime;
        $output = json_encode(array(
            'code' => $this->errcode,
            'result' => $this->errmsg,
            'count' => count($this->data),
            'data' => $this->data,
            'sqltime' =>round($total,5).'s',
        ));
        if ($this->config['islog']) {
            $uid = $this->uid_by_token();
            if (empty($this->key)){
                $this->key = 'token';
            }
            $data = array(
                'uid'=>$uid,
                'apikey' => $this->key,
                'isapi' => get_class($this),
                'action' => $this->action,
                'isget' => json_encode($_GET),
                'ispost' => json_encode($_POST),
                'time' => time(),
                'fromip' => $_G['clientip'],
                'errcode' => $this->errcode,
                'output' => $output,
            );
            C::t($this->table_log)->insert($data);
        }
        exit($output);
    }


///--------------------封装数据库类


    public function diy_result_first($ziduan,$table,$uid){//单字段内容查询，通过uid来查询，参数分别为：字段名称、表名称、uid
        $data = DB::result_first('select '.$ziduan.' from %t where uid=%d',array($table,$uid));
        return $data;
    }

    public function diy_result_first_count($table){//通过表查询存在的条目数
        $data = DB::result_first('select count(*) from %t ',array($table));
        return $data;
    }

    public function diy_result_first_max($table,$uid='uid'){//通过表和主键查询主键最大值,默认uid为主键
        $data = DB::result_first('select max(%s) from %t',array($uid,$table));
        return $data;
    }
    /*
     * $table:插入数据的表 $data：插入的数据，字段对应值 $return_insert_id：是否返回插入数据的ID $replace：是否使用replace into $slient：操作失败是否不提示
     */
    public function diy_insert($table,$dataarray){//数据表插入！$replace 当存在数据执行修改，不存在执行写入，返回uid，注意数组重必须包含主键uid array('uid' => '1','dname' => 'ppc', )
        $data = DB::insert($table,$dataarray,true,true);
        return $data;
    }
    /*
     * 数据表删除操作
        方法名：DB::delete()
        参数解释：
        $table：删除数据的表
        $condition：删除条件
        $limit：删除满足条件的目数
        $unbuffered:是否使用无缓存查询
     */
    public function diy_delete($table,$uid,$limit=1){//删除制定uid数据
        $data =  DB::delete($table,'uid='.$uid,$limit,true);
        return $data;
    }
    /* 数据表更新操作
     * 方法名：DB::update()
     * 插入的值如果是变量用array(),DB::update('borle_do',array('countMoney' => $countMoney),array('doId'=> $doId),true);}
     * $table：（更新数据的表）
     * $data：更新的数据，字段对应的
     * $condition：更新的条件
     * $unbuffrerd：是否使用无缓存查询
     * $low_priority:是否采用无损更新表
     */
    public function diy_update($table,$array,$uid){//更新数据表内容
        $data =  DB::update($table,$array,'uid='.$uid,true);
        return $data;
    }
    ////绑定查询的参数解释
    ////表达式	数据处理
    ////%t	DB::table()
    ////%d	Intval()
    ////%s	addslashes
    ////%n	IN(1,2,3)
    ////%f	Sprintf(‘%f,%var’)
    ////%i	不做任何处理

    /*
     * 单条查询
     * $sql:查询数据的sql语句   $arg:绑定查询的参数    $silent:查询失败时是否不提示
     */
    public function diy_fetch_first($table,$uid){//单条查询，输入表名，及uid，查询整个字段
        $data = DB::fetch_first('SELECT * FROM %t WHERE uid=%d',array($table,$uid));
        return $data;
    }
    /*
     * 多条查询
     * $sql:查询数据的sql语句   $arg:绑定查询的参数    $silent:查询失败时是否不提示
     */
    public function diy_fetch_first_all($table,$uid){//查询一条所有字段数据，输入表名，及uid，查询整个字段
        $data = DB::fetch_all('SELECT * FROM %t WHERE uid=%d',array($table,$uid));
//        $data = $data['0'];
        return $data;
    }

    public function diy_fetch_all($table,$uid1,$uid2){//查询多条，输入表名，及uid，查询整个字段
        $data = DB::fetch_all('SELECT * FROM %t WHERE uid >= %d and uid <= %d',array($table,$uid1,$uid2));
        return $data;
    }

    /*
     * 参数解释：$sql：查询数据的SQL语句  $arg：绑定查询的参数   $keyfield：一维索引的字段名称   $silent：查询失败的是否不提示
     */
    public function diy_fetch_all_n($table,$array){//用in数组查询多条，输入表名，及uid数组
        $data = DB::fetch_all("select * from %t where uid in (%n)",array($table,$array));
        return $data;
    }







///--------------------功能测试区


    
}


?>
