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
class mobileplugin_comiis_app_color{
	function global_comiis_header_mobile(){
		global $_G;
		$_G['comiis_cssid'] = '0';
		if($_G['uid']){
			$comiis_uidcssid = 'comiis_colorid_u'.$_G['uid'];
			$comiis_uid_color = getcookie($comiis_uidcssid);
			if($comiis_uid_color == ''){
				$css = DB::fetch_first("SELECT css FROM %t WHERE uid='%d'", array('comiis_app_userstyle', $_G['uid']));
				dsetcookie($comiis_uidcssid, intval($css['css']).'s', 86400 * 360);
				$_G['comiis_cssid'] = intval($css['css']);
			}else{
				$_G['comiis_cssid'] = intval($comiis_uid_color);
			}
		}
		return '<link rel="stylesheet" href="./source/plugin/comiis_app/cache/comiis_'.$_G['comiis_cssid'].'_style.css?'.VERHASH.'" type="text/css" media="all" id="comiis_app_addclass" />';
	}
}