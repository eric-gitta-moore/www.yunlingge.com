<?php
/**
 * 
 * ���׳�Ʒ ������Ʒ
 * ������ƹ����� ��Ȩ���� http://www.Comiis.com
 * רҵ��̳��ҳ���������, ҳ���������, ���ݰ��/����, ������ο���, ��վЧ��ͼ���, ҳ���׼DIV+CSS����, �������С����ҵ��վ���...
 * ����������Ϊ��ҵ�ṩ������վ���衢��վ�ƹ㡢��վ�Ż������򿪷�������ע�ᡢ���������ȷ���
 * һ����ƺͽ������Ϊ��ҵ��������ʺ��Լ��������վ��Ӫƽ̨������޶ȵ�ʹ��ҵ����Ϣʱ�����������̻���
 *
 *   �绰: 0668-8810200
 *   �ֻ�: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * ����ʱ��: ��һ����������09:00-11:00, ����03:00-05:00, ����08:30-10:30(����������Ϣ)
 * ��������û�����Ⱥ: ��Ⱥ83667771 ��Ⱥ83667772 ��Ⱥ83667773 ��Ⱥ110900020 ��Ⱥ110900021 ��Ⱥ70068388 ��Ⱥ110899987
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