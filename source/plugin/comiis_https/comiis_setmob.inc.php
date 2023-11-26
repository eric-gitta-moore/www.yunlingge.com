<?PHP

/**
 * 
 * 克米出品 必属精品
 * 克米设计工作室 版权所有 http://www.Comiis.com
 * 专业论坛首页及风格制作, 页面设计美化, 数据搬家/升级, 程序二次开发, 网站效果图设计, 页面标准DIV+CSS生成, 各类大中小型企业网站设计...
 * 我们致力于为企业提供优质网站建设、网站推广、网站优化、程序开发、域名注册、虚拟主机等服务，
 * 一流设计和解决方案为企业量身打造适合自己需求的网站运营平台，最大限度地使企业在信息时代稳握无限商机。
 *
 *   电话: 0668-8810200
 *   手机: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作时间: 周一到周五早上09:00-11:00, 下午03:00-05:00, 晚上08:30-10:30(周六、日休息)
 * 克米设计用户交流群: ①群83667771 ②群83667772 ③群83667773 ④群110900020 ⑤群110900021 ⑥群70068388 ⑦群110899987
 * 
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$plugin_url = 'plugins&operation=config&do='. $pluginid. '&identifier='. $plugin['identifier'];
loadcache('plugin');
$moblie_style = DB::fetch_first("SELECT t.directory FROM %t s LEFT JOIN %t t ON s.templateid = t.templateid WHERE s.styleid='%d'", array('common_style', 'common_template',  $_G['setting']['styleid2']));
$footer_file = $moblie_style['directory']. '/touch/common/footer';
$edit_file = file_exists(DISCUZ_ROOT. $footer_file.'.php') ? $footer_file.'.php' : (file_exists(DISCUZ_ROOT. $footer_file.'.htm') ? $footer_file.'.htm' : $_G['style']['directory']. '/touch/common/footer.htm');
$html = implode('', @file(DISCUZ_ROOT. $edit_file));
if($_G['cache']['plugin']['comiis_https']['mob'] == 1){
	if(strpos($html, 'comiis_replace_https()') === false){
		$html = str_replace('output();', '(function_exists("comiis_replace_https") ? comiis_replace_https() : "");output();', $html);
		if($fp = @fopen(DISCUZ_ROOT. $edit_file, 'wb')) {
			fwrite($fp, $html);
			fclose($fp);
		} else {
			cpmsg('Can not write to file, please check file '. $edit_file, '', 'error', array(), '', 0);
			exit;
		}
	}
	cpmsg('update_cache_succeed', "action=". $plugin_url, 'succeed', array(), '', 0);
}else{
	if(strpos($html, 'comiis_replace_https()') !== false){
		$html = str_replace('(function_exists("comiis_replace_https") ? comiis_replace_https() : "");', '', $html);
		if($fp = @fopen(DISCUZ_ROOT. $edit_file, 'wb')) {
			fwrite($fp, $html);
			fclose($fp);
		} else {
			cpmsg('Can not write to file, please check file '. $edit_file, '', 'error', array(), '', 0);
			exit;
		}
	}
	cpmsg('update_cache_succeed', "action=". $plugin_url, 'succeed', array(), '', 0);
}
$tpl = dir(DISCUZ_ROOT.'./data/template');
while($entry = $tpl->read()) {
	if(preg_match("/\.tpl\.php$/", $entry)) {
		@unlink(DISCUZ_ROOT.'./data/template/'.$entry);
	}
}
$tpl->close();