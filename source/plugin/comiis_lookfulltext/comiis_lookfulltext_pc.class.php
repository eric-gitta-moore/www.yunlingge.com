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
class plugin_comiis_lookfulltext{
	function global_footer() {
		global $_G;
		$comiis_lookfulltext = $_G['cache']['plugin']['comiis_lookfulltext'];
		// $comiis_lookfulltext['forum'] = except_empty_string_array($comiis_lookfulltext['forum'],true);
		// var_dump(unserialize($comiis_lookfulltext['forum']));
		// var_dump(dempty((array)unserialize($comiis_lookfulltext['forum'])));
		// exit;
		
		if($comiis_lookfulltext['open_pc']){
			if(($comiis_lookfulltext['blog'] && $_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'blog' && !empty($_GET['id'])) ||
			
			($comiis_lookfulltext['group'] && $_G['basescript'] == 'group' && CURMODULE == 'viewthread') ||
			
			($comiis_lookfulltext['portal'] && $_G['basescript'] == 'portal' && CURMODULE == 'view') || 
			
			(
				$_G['basescript'] == 'forum' && CURMODULE == 'viewthread' && intval($comiis_lookfulltext['pc_maxheight']) > 300 && 
				(in_array($_G['fid'], unserialize($comiis_lookfulltext['forum'])) ||
				dempty((array)unserialize($comiis_lookfulltext['forum'])) )
			)
			
			) {
				if($comiis_lookfulltext['pc_class']){
					$comiis_lookfulltext['pc_class'] = ','.$comiis_lookfulltext['pc_class'];
				}
				include_once template('comiis_lookfulltext:comiis_hook');
				return $return;
			}
		}
	}
}



