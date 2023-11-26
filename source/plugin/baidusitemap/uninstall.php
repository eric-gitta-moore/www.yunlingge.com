<?php
/*
 * 主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF
ALTER TABLE `pre_forum_thread`
DROP COLUMN `tobaidu`,
DROP COLUMN `todate`;
EOF;
runquery($sql);
if(file_exists(DISCUZ_ROOT.'./data/cache/cache_baidusitemap_over.php')) @unlink($filepath);
if(file_exists(DISCUZ_ROOT.'./data/cache/cache_baidusitemap_remain.php')) @unlink($filepath);
if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_baidusitemap_over.php')) @unlink($filepath);
if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_baidusitemap_remain.php')) @unlink($filepath);
$finish = TRUE;
