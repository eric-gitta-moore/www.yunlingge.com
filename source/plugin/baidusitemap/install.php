<?php
/*
 * 主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ')) { 
	exit('Access Denied');
}
$sql = <<<EOF
ALTER TABLE `pre_forum_thread`
ADD COLUMN `tobaidu`  tinyint(1) NOT NULL DEFAULT 0,
ADD COLUMN `todate`  int(11) NOT NULL DEFAULT 0;
EOF;
runquery($sql);
$finish = TRUE;

?>