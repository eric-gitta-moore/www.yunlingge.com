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
function comiis_replace_https(){
	global $_G;
	if($_G['cache']['plugin']['comiis_https']['mob'] == 1 && $_G['cache']['plugin']['comiis_https']['http']){
		$comiis_url = explode("\n", $_G['cache']['plugin']['comiis_https']['http']);
		if(!empty($_G['setting']['output']['preg']['search']) && (empty($_G['setting']['rewriteguest']) || empty($_G['uid']))) {
			$_G['setting']['output']['preg']['search'] = str_replace('(http\:', '(https\:', $_G['setting']['output']['preg']['search']);
		}
		if(is_array($comiis_url)){
			$_G['setting']['rewritestatus'][] = 'comiis_https';
			foreach($comiis_url as $temp) {
				$temp = trim($temp);
				if(strlen($temp) > 3) {
					$_G['setting']['output']['str']['search'][] = 'http://'. $temp;
					$_G['setting']['output']['str']['replace'][] = 'https://'. $temp;
				}
			}
			$content = output_replace(ob_get_contents());
			ob_end_clean();
			$_G['gzipcompress'] ? ob_start('ob_gzhandler') : ob_start();
			echo $content;
		}
	}
}
class mobileplugin_comiis_https{
	function common(){}
}