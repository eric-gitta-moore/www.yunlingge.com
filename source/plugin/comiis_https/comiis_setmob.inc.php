<?PHP

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