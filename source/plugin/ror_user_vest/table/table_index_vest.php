<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_index_vest extends discuz_table
{
    public function __construct()
    {
        parent::__construct();

        $this->_pk = 'uid';
        $this->_table = 'plugin_'.PLUGIN_NAME;
    }
    
    var $vest_cache_file = 'data/plugindata/ror_user_vest_cache.log';
    
    /**
     * 本地马甲列表
     *
     * @access public
     * @param int
     * @return array
     */
    public function vest_list($limit)
    {
        $sql = 'SELECT uid,username FROM '.DB::table($this->_table).'
                ORDER BY weight DESC,dateline DESC LIMIT '.$limit;
         
        return DB::fetch_all($sql);
    }
    
    /**
     * 本地马甲列表
     *
     * @access public
     * @param int
     * @return array
     */
    public function vest_one($offset)
    {
        $sql = 'SELECT uid,username FROM %t ORDER BY uid ASC LIMIT %d,1';
         
        return DB::fetch_first($sql, array($this->_table, $offset));
    }
    
    /**
     * 随机头像
     *
     * @access public
     * @param
     * @return array
     */
    public function avatar_rand()
    {
        $uid = rand(1, 135275);
        $avatar_url = self::get_avatar($uid);
        $data = file_get_contents($avatar_url);
        
        if(! $data){
            for($i=1; $i<=10; $i++){
                $uid = rand(1, 135275);
                $avatar_url = self::get_avatar($uid);
                $data = file_get_contents($avatar_url);
                if($data){
                    break;
                }
            }
        }
        
        return $data;
    }
    
    /**
     * 头像地址
     *
     * @access public
     * @param int, string, string
     * @return string
     */
    public function get_avatar($uid, $size = 'big', $type = '')
    {
        $url_prefix = 'http://bbs.share555.com/data/plugindata/ror_user_vest_share/';
        
        $size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
        $uid = abs(intval($uid));
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        $typeadd = $type == 'real' ? '_real' : '';
    
        return $url_prefix.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
    }
    
    /**
     * 缓存马甲
     *
     * @access public
     * @param
     * @return
     */
    public function vest_cache_save()
    {
        $result = lib_base::curl(lib_base::$grab_host.lib_base::$grab_vest_rand);

        $result = json_decode($result, TRUE);
        
        if(! $result || ! $result['list']){
            return FALSE;
        }
        
        //gbk转码
        if(CHARSET == 'gbk'){
            $result = lib_base::convert_utf8_to_gbk($result);
        }
        
        $vest_list = $result['list'];
        
        $vest_rand_cache = DISCUZ_ROOT.$this->vest_cache_file;
        
        file_put_contents($vest_rand_cache, serialize($vest_list));
        
        return TRUE;
    }
}