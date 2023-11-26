<?php
/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_ADMINCP')) {
exit('Access Denied');
}
C::t('common_plugin')->update($_GET['pluginid'], array('available' => 0));
updatecache(array('plugin', 'setting', 'styles'));
cleartemplatecache();
updatemenu('plugin');
cpmsg('&#x63d2;&#x4ef6;&#x5df2;&#x5173;&#x95ed;&#xff0c;&#x53bb;&#x6e90;&#x7801;&#x54e5;&#x770b;&#x770b;&#x5427;', 'http://www.ymg6.com', 'succeed');