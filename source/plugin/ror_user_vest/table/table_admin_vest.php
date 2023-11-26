<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_admin_vest extends discuz_table
{
    public function __construct()
    {
        parent::__construct();

        $this->_pk = 'uid';
        $this->_table = 'plugin_'.PLUGIN_NAME;
    }
    
    /**
     * 本地马甲列表
     *
     * @access public
     * @param string, int, int, string
     * @return array
     */
    public function local_vest_list($fields, $offset, $limit, $where = '')
    {
        $sql = 'SELECT '.$fields.' FROM '.DB::table($this->_table).' v
                LEFT JOIN '.DB::table('common_member_profile').' p ON v.uid=p.uid
               '.$where.'
               ORDER BY weight DESC,dateline DESC LIMIT '.$offset.','.$limit;
         
        return DB::fetch_all($sql);
    }
    
    /**
     * 本地马甲统计
     *
     * @access public
     * @param string
     * @return int
     */
    public function local_vest_count($where = '')
    {
        $sql = 'SELECT COUNT(*) FROM '.DB::table($this->_table).' v
    	       '.$where;
        
        return DB::result_first($sql);
    }
    
    /**
     * 本地马甲详情
     *
     * @access public
     * @param int
     * @return array
     */
    public function vest_detail($uid)
    {
        $sql = 'SELECT * FROM '.DB::table($this->_table).' WHERE uid='.$uid;
    
        return DB::fetch_first($sql);
    }
    
    /**
     * 本地马甲是否存在
     *
     * @access public
     * @param string
     * @return int
     */
    public function vest_is_exist_by_username($username)
    {
        $sql = 'SELECT COUNT(*) FROM '.DB::table($this->_table)." WHERE username='".$username."'";
    
        return DB::result_first($sql);
    }
    
    /**
     * 本地马甲是否存在
     *
     * @access public
     * @param int
     * @return int
     */
    public function vest_is_exist_by_uid($uid)
    {
        $sql = 'SELECT COUNT(*) FROM '.DB::table($this->_table).' WHERE uid='.$uid;
    
        return DB::result_first($sql);
    }
    
    /**
     * 本地马甲列表
     *
     * @access public
     * @param
     * @return array
     */
    public function local_vest_all()
    {
        $sql = 'SELECT * FROM '.DB::table($this->_table).' ORDER BY dateline DESC';
         
        return DB::fetch_all($sql);
    }
    
    /**
     * 用户注册
     *
     * @access public
     * @param string
     * @return array
     */
    public function user_register($username, $gender = 0, $avatar = '', $source = '')
    {
        global $_G;
   
        $ip = lib_base::settings('is_rand_ip') ? $this->get_rand_ip() : $_G['clientip'];
        $password = lib_base::settings('vest_password') ? lib_base::settings('vest_password') : substr(md5($username.TIMESTAMP), 0, 10);
        $email = self::get_rand_email();
        $gender_set = lib_base::settings('vest_gender');
        if(! $gender && $gender_set){
            $gender = $gender_set == 3 ? mt_rand(1, 2) : $gender_set;
        }
        
        loaducenter();
        uc_user_register('', '', '', '', '', '');
        
//         $email_temp = '';
//         if(lib_base::settings('is_rand_email')){
//             $email_temp = self::get_email();
//         }else{
//             $host = $_G['siteurl'];
//             $parse_url = parse_url($host);
//             $email_host = $parse_url['host'];
//             $email_temp = substr(md5($username), 0, 10).'@'.$email_host;
//         }
//         $uid = uc_user_register($username, $password, $email, '', '', $ip);

        $uid = $_ENV['user']->add_user($username, $password, $email, 0, '', '', $ip);
        if(! $uid){
            return lib_base::back_array(lib_base::lang('op_unknow'));
        }
        
//         $email = '';
//         if(lib_base::settings('is_rand_email')){
//             $email = $email_temp;
//         }else{
//             $email = $uid.'@'.$email_host;
//             //更换uc邮箱
//             uc_user_edit($username, '', '', $email, 1);
//         }

        //获取uc用户信息
        $uc_user = $_ENV['user']->get_user_by_uid($uid);

        $setting = $_G['setting'];
        //$groupid = $setting['regverify'] ? 8 : $setting['newusergroupid'];
        $groupid = $setting['newusergroupid'];
        $init_arr = explode(',',  $setting['initcredits']);

        $password_md5 = md5(md5($password).$uc_user['salt']);
        
        C::t('common_member')->insert($uid, $username, $password_md5, $email, $ip, $groupid, $init_arr);
        C::t('common_member_status')->update($uid, array('lastip'=>$ip,'lastvisit'=>TIMESTAMP, 'lastactivity'=>TIMESTAMP));
        C::t('common_member')->update($uid, array('emailstatus'=>1));
        
        if($gender){
            C::t('common_member_profile')->update($uid, array('gender'=>$gender));
        }

        require_once libfile('cache/userstats', 'function');
        build_cache_userstats();
        
        //记录马甲数据
        $add = array(
            'uid'=>$uid,
            'username'=>$username,
            'password'=>$password,
            'source'=>$source ? $source : $_G['siteurl'],
            'dateline'=>TIMESTAMP
        );
        $this->insert($add);
        
        //同步头像
        if($avatar)
        {
            //禁止其它插件修改路径
            $_G['setting']['plugins']['func'][HOOKTYPE]['avatar'] = '';
            $avatar_local_big_path = avatar($uid, 'big', TRUE, FALSE, TRUE);
            
            $urls = parse_url($avatar_local_big_path);

            $avatar_local_big_path_r = ltrim($urls['path'], '/');
            $avatar_local_big_path_a = DISCUZ_ROOT.$avatar_local_big_path_r;

            //创建目录
            $avatar_path = DISCUZ_ROOT;
            $paths = explode('/', $avatar_local_big_path_r);
            foreach($paths as $value){
                if(strpos($value, 'avatar_big.jpg') !== FALSE){
                    break;
                }
                $avatar_path .= $value.'/';
                if(! is_dir($avatar_path)){
                    mkdir($avatar_path);
                    chmod($avatar_path, 0777);
                }
            }

            $avatar_data = file_get_contents($avatar);
            if($avatar_data && file_put_contents($avatar_local_big_path_a, $avatar_data))
            {
                chmod($avatar_local_big_path_a, 0777);
                
                $avatar_local_middle_path = str_replace('big', 'middle', $avatar_local_big_path_r);
                $avatar_local_small_path = str_replace('big', 'small', $avatar_local_big_path_r);
                
                require_once libfile('class/image');
                $image = new image();
                $_G['setting']['attachdir'] = DISCUZ_ROOT;
                $thumb = $image->Thumb($avatar_local_big_path_a, $avatar_local_middle_path, 120, 120);
                $thumb = $image->Thumb($avatar_local_big_path_a, $avatar_local_small_path, 48, 48);
            }
        }
        
        return lib_base::back_array(array('uid'=>$uid,'username'=>$username,'password'=>$password,'gender'=>$gender,'result'=>lib_base::lang('user_register_success')), 0);
    }
    
    public static function get_rand_ip()
    {
        $ip_long = array(
            array('607649792', '608174079'), // 36.56.0.0-36.63.255.255
            array('1038614528', '1039007743'), // 61.232.0.0-61.237.255.255
            array('1783627776', '1784676351'), // 106.80.0.0-106.95.255.255
            array('2035023872', '2035154943'), // 121.76.0.0-121.77.255.255
            array('2078801920', '2079064063'), // 123.232.0.0-123.235.255.255
            array('-1950089216', '-1948778497'), // 139.196.0.0-139.215.255.255
            array('-1425539072', '-1425014785'), // 171.8.0.0-171.15.255.255
            array('-1236271104', '-1235419137'), // 182.80.0.0-182.92.255.255
            array('-770113536', '-768606209'), // 210.25.0.0-210.47.255.255
            array('-569376768', '-564133889'), // 222.16.0.0-222.95.255.255
        );
    
        $rand_key = mt_rand(0, 9);
    
        return $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
    }
    
    public static function get_rand_email()
    {
        $email = array(
            'gmail.com',
            'yahoo.com',
            'msn.com',
            'hotmail.com',
            'ask.com',
            'live.com',
            'qq.com',
            '0355.net',
            '163.com',
            '163.net',
            '263.net',
            '3721.net',
            'yeah.net',
            'mail.com',
        );
    
        $rand_id = mt_rand(0, count($email) - 1);
        $email_postfix = $email[$rand_id];
        $email_prefix = lib_base::randomkeys(mt_rand(5, 10));
        
        return $email_prefix.'@'.$email_postfix;
    }
}