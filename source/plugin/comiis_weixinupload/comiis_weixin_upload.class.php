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
class mobileplugin_comiis_weixinupload{
	function global_footer_mobile(){
		global $_G, $comiis_signPackage;
		if(!$_G['uid']){
			return;
		}
		$comiis_wxup_iswx = 0;
		if($_G['basescript'] == 'forum' && (CURMODULE == 'post' || CURMODULE == 'viewthread')){
			if(empty($_G['cache']['plugin'])){
				loadcache('plugin');
			}
			$comiis_weixinupload = $_G['cache']['plugin']['comiis_weixinupload'];
			$fids = unserialize($comiis_weixinupload['forum']);
			if(isset($fids[0]) && ($fids[0] == '0' || $fids[0] == '')){
				unset($fids[0]);
			}
			if(count($fids) && !in_array($_G['fid'], $fids)){
				return;
			}
			$users = unserialize($comiis_weixinupload['user']);
			if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
				unset($users[0]);
			}
			if(count($users) && !in_array($_G['member']['groupid'], $users)){
				return;
			}
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false && $comiis_weixinupload['appid'] && $comiis_weixinupload['appsecret']){
				$comiis_hash = md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid']);
				$comiis_wxup_iswx = 1;
				$comiis_app_switch['comiis_wxappid'] = $comiis_weixinupload['appid'];
				$comiis_app_switch['comiis_wxappsecret'] = $comiis_weixinupload['appsecret'];
				if(file_exists(DISCUZ_ROOT.'./template/comiis_app/comiis/php/jssdk.php')){
					include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/jssdk.php';
				}else{
					include_once DISCUZ_ROOT.'./source/plugin/comiis_weixinupload/jssdk.php';
				}
			}
		}
		include DISCUZ_ROOT.'./source/plugin/comiis_weixinupload/language/language.'.currentlang().'.php';
		include template('comiis_weixinupload:hook');
		return $html;
	}
}