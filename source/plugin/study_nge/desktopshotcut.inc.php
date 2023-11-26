<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
Header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . str_replace(array(',', '"', '&quot;', ';'), array('_', '_', '_'), diconv($_G['setting']['bbname'], CHARSET, 'GBK')) . ".url;");
echo "[InternetShortcut] 
URL=" . $_G['setting']['siteurl'] . "
IDList= 
[{000214A0-0000-0000-C000-000000000046}] 
Prop3=19,2 
";
?>
