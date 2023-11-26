<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc && plugin by zhanmishu.
 *      Dz盒子www.idzbox.com, use is subject to license terms
 *
 *      Author: zhanmishu.com $
 *      qq:87883395 $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class Zms_storage_Autoloader{
  
  /**
     * 类库自动加载，写死路径，确保不加载其他文件。
     * @param string $class 对象类名
     * @return void
     */
    public static function autoload($class) {


        $name = $class;
        if(false !== strpos($name,'\\')){
          $name = strstr($class, '\\', true);
        }

        $filename = DISCUZ_ROOT.'source/plugin/zhanmishu_storage/source/osssdk/'.$name.'.php';
        if(is_file($filename)) {
            include $filename;
            return;
        }
    }
}//From ww w.m o qu8.com

if (version_compare(phpversion(),'5.3.0','>=')) {
    spl_autoload_register('Zms_storage_Autoloader::autoload',false,true);
}else{
    Zms_storage_Autoloader::autoload("OssClient");
    Zms_storage_Autoloader::autoload("MimeTypes");
    Zms_storage_Autoloader::autoload("OssException");
    Zms_storage_Autoloader::autoload("OssUtil");
    Zms_storage_Autoloader::autoload("Result");
    Zms_storage_Autoloader::autoload("PutSetDeleteResult");
    Zms_storage_Autoloader::autoload("RequestCore");
    Zms_storage_Autoloader::autoload("RequestCore_Exception");
    Zms_storage_Autoloader::autoload("ResponseCore");


}




?>