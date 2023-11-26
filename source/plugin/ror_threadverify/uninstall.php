<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access denied');
}

$plugin_name = 'ror_threadverify';

$sql = <<<EOT

EOT;

runquery($sql);

C::t('common_syscache')->delete($plugin_name);

$finish = true;