<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
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
        'index'=>array('class'=>'lib_admin_vest','function'=>'index'),
        
        'local_vest_list'=>array('class'=>'lib_admin_vest','function'=>'local_vest_list'),
        'local_vest_add'=>array('class'=>'lib_admin_vest','function'=>'local_vest_add'),
        'local_vest_added'=>array('class'=>'lib_admin_vest','function'=>'local_vest_added'),
        'local_vest_del'=>array('class'=>'lib_admin_vest','function'=>'local_vest_del'),
        'local_vest_uid'=>array('class'=>'lib_admin_vest','function'=>'local_vest_uid'),
        'local_vest_import'=>array('class'=>'lib_admin_vest','function'=>'local_vest_import'),
        'local_vest_imported'=>array('class'=>'lib_admin_vest','function'=>'local_vest_imported'),
        'local_vest_weight'=>array('class'=>'lib_admin_vest','function'=>'local_vest_weight'),
        'local_vest_weighted'=>array('class'=>'lib_admin_vest','function'=>'local_vest_weighted'),
        'local_vest_export'=>array('class'=>'lib_admin_vest','function'=>'local_vest_export'),
        
        'share_vest_list'=>array('class'=>'lib_admin_vest','function'=>'share_vest_list'),
        'share_vest_register'=>array('class'=>'lib_admin_vest','function'=>'share_vest_register'),
        'share_vest_register_batch'=>array('class'=>'lib_admin_vest','function'=>'share_vest_register_batch'),
        'share_vest_register_batched'=>array('class'=>'lib_admin_vest','function'=>'share_vest_register_batched'),
        'share_vest_add'=>array('class'=>'lib_admin_vest','function'=>'share_vest_add'),
        'share_vest_added'=>array('class'=>'lib_admin_vest','function'=>'share_vest_added'),
//         'grab_auth'=>array('class'=>'lib_admin_vest','function'=>'grab_auth'),
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

        if(FORMHASH != $_GET['myformhash'] && ! in_array($action, array('index','local_vest_list'))){
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