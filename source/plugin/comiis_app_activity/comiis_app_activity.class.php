<?php
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
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class mobileplugin_comiis_app_activity{
	function global_comiis_app_activity(){
		return $this->_show_comiis_app_activity(1);
	}
	function _show_comiis_app_activity($open){
		global $_G;
		loadcache('comiis_app_activity');
		if(($open ==1 || $_G['cache']['plugin']['comiis_app_activity']['activity_index'] == 1) && trim($_G['cache']['plugin']['comiis_app_activity']['tids'])){
			require_once DISCUZ_ROOT.'./source/plugin/comiis_app_activity/language/language.'.currentlang().'.php';
			$tids = explode(',', trim($_G['cache']['plugin']['comiis_app_activity']['tids']));
			$comiis_app_activity = DB::fetch_all('SELECT t.subject, t.tid, a.starttimefrom, a.starttimeto, a.class, a.aid FROM '.DB::table('forum_activity').' a INNER JOIN '.DB::table("forum_thread").' t ON t.tid=a.tid WHERE t.displayorder>=\'0\' AND a.tid IN ('.dimplode($tids).') ORDER BY t.dateline DESC');
			include_once template('comiis_app_activity:comiis_hook');
			return $return;
		}
	}
}
class mobileplugin_comiis_app_activity_forum extends mobileplugin_comiis_app_activity{
	function index_top_mobile(){
		return $this->_show_comiis_app_activity(2);
	}
}
