<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * lib_index_vest Class
 * @package plugin
 * @subpackage ror
 * @category user_vest
 * @author ror
 * @link
 */
class lib_index_vest
{
    protected static $table = 'index_vest';
    protected static $table_admin = 'admin_vest';
    
    public static function vest_list()
    {
        global $_G;
        
        $handlekey = $_GET['handlekey'];
        
        $limit_max = 1000;
        $limit = lib_base::settings('web_vest_number') ? lib_base::settings('web_vest_number') : 52;
        $limit > $limit_max && $limit = $limit_max;
        
        $vest_list = lib_base::table(self::$table)->vest_list($limit);
        foreach($vest_list as $key => $value){
            $vest_list[$key]['avatar'] = avatar($value['uid'], '', TRUE);
        }
        
        $vest_rand = array(
            'uid'=>0,
            'username'=>lib_base::lang('vest_rand'),
            'avatar'=>'source/plugin/'.PLUGIN_NAME.'/public/images/avatar.png'
        );
        
        array_unshift($vest_list, $vest_rand);
        
        $vest_default = array(
            'uid'=>$_G['uid'],
            'username'=>$_G['username'],
            'avatar'=>avatar($_G['uid'], 'middle', TRUE)
        );
        
        array_unshift($vest_list, $vest_default);
        
        include lib_base::template('vest_list');
    }
    
    public static function avatar_add()
    {
        global $_G;
   
        $offset = $_GET['offset'] ? intval($_GET['offset']) : 0;
        
        $vest_one = lib_base::table(self::$table)->vest_one($offset);
        
        if(! $vest_one){
            lib_base::js_back_show(lib_base::lang('success'));
        }
        
        $offset++;
        
        $uid = $vest_one['uid'];
        
        //禁止其它插件修改路径
        $_G['setting']['plugins']['func'][HOOKTYPE]['avatar'] = '';
        $avatar_local_big_path = avatar($uid, 'big', TRUE, FALSE, TRUE);
        
        $urls = parse_url($avatar_local_big_path);

        $avatar_local_big_path_r = ltrim($urls['path'], '/');
        $avatar_local_big_path_a = DISCUZ_ROOT.$avatar_local_big_path_r;
        
        $header_url = lib_base::url('avatar_add').'&offset='.$offset;
        
        if(file_exists($avatar_local_big_path_a)){
            lib_base::back_url(lib_base::lang('success'), $header_url);
        }
        
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

        $avatar_data = lib_base::table(self::$table)->avatar_rand();
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
        
        lib_base::back_url(lib_base::lang('success'), $header_url);
    }
    
    //对外提供注册马甲接口
    public static function api_vest_add()
    {
        global $_G;
         
        $token = $_GET['token'];
        
        if(! lib_base::settings('api_token') || lib_base::settings('api_token') != $token){
            lib_base::back_text(lib_base::lang('notoken'));
        }
    
        $vest_rand_cache = DISCUZ_ROOT.lib_base::table(self::$table)->vest_cache_file;
        
        if(! file_exists($vest_rand_cache)){
            lib_base::table(self::$table)->vest_cache_save();
        }

        $time_edit = filemtime($vest_rand_cache);
        $vest_list = file_get_contents($vest_rand_cache);
        
        if(! $vest_list && $time_edit < (TIMESTAMP - 86400)){
            lib_base::table(self::$table)->vest_cache_save();
            $vest_list = file_get_contents($vest_rand_cache);
        }

        $vest_list = unserialize($vest_list);

        if(! $vest_list){
            lib_base::back_text(lib_base::lang('novest'));
        }

        loaducenter();
        
        while(is_array($vest_list) && $vest_list){
            $vest = array_shift($vest_list);
            if(! $vest){
                break;
            }

            if(uc_get_user($vest['username'])){
                continue;
            }
            
            $result = lib_base::table(self::$table_admin)->user_register($vest['username'], $vest['gender'], $vest['avatar'], $vest['source']);
            if($result['state'] != 0){
                continue;
            }
        
            break;
        }

        if(! $vest_list){
            file_put_contents($vest_rand_cache, '');
        }else{
            file_put_contents($vest_rand_cache, serialize($vest_list));
        }
         
        if($result['state'] != 0){
            lib_base::back_text(lib_base::lang('novest'));
        }

        $data = array(
            'uid'=>$result['uid'],
            'username'=>$result['username'],
            'gender'=>$result['gender'],
            'password'=>$result['password'],
            'avatar'=>avatar($result['uid'], 'middle', TRUE)
        );
        
        lib_base::back_json($data, 0);
    }
}