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
class mobileplugin_comiis_app_homestyle{
	function global_comiis_header_mobile(){
		global $_G, $space;
		$_G['comiis_homestyleid'] = 'yes';
		$space['uid'] = intval($space['uid']);
		$homestyle_img = $homestyle_user_img = '';
		if($_G['uid']){
			$comiis_uidhomestyleid = 'comiis_homestyleid_u'.$_G['uid'];
			$comiis_uid_homestyle = getcookie($comiis_uidhomestyleid);
			if($comiis_uid_homestyle == ''){
				$homestyle = DB::fetch_first("SELECT uid, img, img_id FROM %t WHERE uid='%d'", array('comiis_app_homestyle', $_G['uid']));
				if($homestyle['uid'] == $_G['uid']){
					$homestyle_img = $homestyle['img'];
					$_G['comiis_homestyleid'] = $homestyle['img_id'];
				}else{
					$homestyle_img = 'home_bg.jpg';
				}
				dsetcookie($comiis_uidhomestyleid, ($homestyle['img_id'] ? intval($homestyle['img_id']) : 'yes').'*'.$homestyle_img, 86400 * 360);
			}else{
				list($_G['comiis_homestyleid'], $homestyle_img) = explode('*', $comiis_uid_homestyle);
			}
		}else{
			$homestyle_img = 'home_bg.jpg';
		}
		if($space['uid'] && $space['uid'] != $_G['uid']){
			$homestyle = DB::fetch_first("SELECT uid, img, img_id FROM %t WHERE uid='%d'", array('comiis_app_homestyle', $space['uid']));
			if($homestyle['uid'] == $space['uid']){
				$homestyle_user_img = $homestyle['img'];
			}else{
				$homestyle_user_img = 'home_bg.jpg';
			}
			return  '<style>.comiis_sidenv_box .comiis_sidenv_top{background:url(./source/plugin/comiis_app_homestyle/image/home_bg/'.htmlspecialchars($homestyle_img).') no-repeat 0 0 / cover;}.comiis_space_box{background:url(./source/plugin/comiis_app_homestyle/image/home_bg/'.htmlspecialchars($homestyle_user_img).') no-repeat 0 0 / cover;}</style>';
		}else{
			return '<style>.comiis_sidenv_box .comiis_sidenv_top,.comiis_space_box {background:url(./source/plugin/comiis_app_homestyle/image/home_bg/'.htmlspecialchars($homestyle_img).') no-repeat 0 0 / cover;}</style>';
		}
	}
}