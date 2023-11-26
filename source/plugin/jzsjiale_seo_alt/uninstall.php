<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


$sql = <<<EOF
DROP TABLE IF EXISTS pre_jzsjiale_seo_alt_keywords;
DROP TABLE IF EXISTS pre_jzsjiale_seo_alt_settings;
EOF;

runquery($sql);

require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::delAPIHook('jzsjiale_seo_alt');

$finish = TRUE;
