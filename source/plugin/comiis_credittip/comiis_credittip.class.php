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
class mobileplugin_comiis_credittip{
	function global_footer_mobile(){
		global $_G;
		if(!$_G['uid']){
			return;
		}
		$comiis_credittip = $_G['cache']['plugin']['comiis_credittip'];
		$comiis_set_style = $comiis_credittip['tipstyle'] ? 1 : 0; // 样式 0/1
		$comiis_credittip['jbgcolor'] = $this->_hex2rgba($comiis_credittip['jbgcolor']);
		$comiis_credittip['nbgcolor'] = $this->_hex2rgba($comiis_credittip['nbgcolor']);
		$comiis_set_timeout = $comiis_credittip['time'] < 300 ? 300 : $comiis_credittip['time']; // 停留时间
		$comiis_atime = 200; //动画时间 X2
		$comiis_alltime = $comiis_set_timeout + $comiis_atime * 2; // 总时间
		$comiis_3f1bfb = round($comiis_atime / $comiis_alltime * 100 , 2);
		$comiis_keyframes_bfb = array(
			'1' => ($comiis_3f1bfb / 2),
			'2' => $comiis_3f1bfb,
			'3' => (100 - $comiis_3f1bfb),
		);
		include template('comiis_credittip:hook');
		return $html;
	}
	function _hex2rgba($color) {
		global $_G;
        $color = str_replace('#', '', $color);
		return strlen($color) > 3 ? 'rgba('.hexdec(substr($color, 0, 2)).','.hexdec(substr($color, 2, 2)).','.hexdec(substr($color, 4, 2)).','.$_G['cache']['plugin']['comiis_credittip']['opacity'].')' : 'rgba('.hexdec(substr($color, 0, 1)).','.hexdec(substr($color, 1, 1)).','.hexdec(substr($color, 2, 1)).','.$_G['cache']['plugin']['comiis_credittip']['opacity'].')';
    }
}
