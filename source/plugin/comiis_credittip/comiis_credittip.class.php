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
class mobileplugin_comiis_credittip{
	function global_footer_mobile(){
		global $_G;
		if(!$_G['uid']){
			return;
		}
		$comiis_credittip = $_G['cache']['plugin']['comiis_credittip'];
		$comiis_set_style = $comiis_credittip['tipstyle'] ? 1 : 0; // ��ʽ 0/1
		$comiis_credittip['jbgcolor'] = $this->_hex2rgba($comiis_credittip['jbgcolor']);
		$comiis_credittip['nbgcolor'] = $this->_hex2rgba($comiis_credittip['nbgcolor']);
		$comiis_set_timeout = $comiis_credittip['time'] < 300 ? 300 : $comiis_credittip['time']; // ͣ��ʱ��
		$comiis_atime = 200; //����ʱ�� X2
		$comiis_alltime = $comiis_set_timeout + $comiis_atime * 2; // ��ʱ��
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
