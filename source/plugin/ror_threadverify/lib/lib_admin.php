<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once libfile('lib/base', 'plugin/'.PLUGIN_NAME);
require_once libfile('lib/func', 'plugin/'.PLUGIN_NAME);

/**
 * lib_admin Class
 * @package plugin
 * @subpackage ror
 * @category grab
 * @author ror
 * @link
 */
class lib_admin
{
    protected static $allow_actions = array(
        'index'=>array('class'=>'lib_admin_thread','function'=>'index'),
        
        'thread_moderate_list'=>array('class'=>'lib_admin_thread','function'=>'thread_moderate_list'),
        'moderate_thread'=>array('class'=>'lib_admin_thread','function'=>'moderate_thread'),
        'post_moderate_list'=>array('class'=>'lib_admin_post','function'=>'post_moderate_list'),
        'moderate_post'=>array('class'=>'lib_admin_post','function'=>'moderate_post'),
        'article_moderate_list'=>array('class'=>'lib_admin_article','function'=>'article_moderate_list'),
        'moderate_article'=>array('class'=>'lib_admin_article','function'=>'moderate_article'),
        
    );
    
    public function run()
    {
//         ini_set("display_errors", "On");
//         error_reporting(E_ALL);

        global $_G;

        $action = $_GET['act'] ? $_GET['act'] : 'index';

        if(! isset(self::$allow_actions[$action])){
            lib_base::js_back_show(lib_base::lang('noaction'));
        }

        if(FORMHASH != $_GET['myformhash'] && ! in_array($action, array('index','thread_moderate_list'))){
            showmessage(lib_base::lang('noformhash'));
        }
        
        if(! $_G['adminid']){
            lib_base::js_back_window(lib_base::lang('nopermission'));
        }
        
        if(CHARSET == 'gbk' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $_GET = lib_base::convert_utf8_to_gbk($_GET);
        }

        $op = self::$allow_actions[$action];

        require_once libfile(str_replace('lib_', 'lib/', $op['class']), 'plugin/'.PLUGIN_NAME);
        
        loadcache(PLUGIN_NAME);
        $result = $_G['cache'][PLUGIN_NAME];
        eval(authcode($result['auth'], 'DECODE', 'ror'));
    }
}