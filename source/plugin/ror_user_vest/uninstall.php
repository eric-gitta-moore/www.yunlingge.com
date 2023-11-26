<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access denied');
}

$plugin_name = 'ror_user_vest';

$sql = <<<EOT

DROP TABLE IF EXISTS pre_plugin_{$plugin_name};

EOT;

runquery($sql);

C::t('common_syscache')->delete($plugin_name);

//删除缓存
$filename = DISCUZ_ROOT.'data/plugindata/ror_user_vest_cache.log';
if(file_exists($filename)){
    unlink($filename);
}

$finish = true;