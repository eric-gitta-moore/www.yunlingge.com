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

class plugin_comiis_app_video{
	function discuzcode($param){
		global $_G, $pid;
		if($param['caller'] == 'discuzcode'){
			if($_G['forum_thread']['isgroup'] || ($_G['basescript']=='forum' && CURMODULE=='viewthread' && in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum'])))){
				if(dstrpos($_G['discuzcodemessage'], array('[/media]', '[/flash]', '[/audio]', '[/attach]')) !== FALSE){
					$_G['comiis_video'] = 1;
					$_G['comiis_video_attach'] = C::t('forum_attachment_n')->fetch_all_by_id(getattachtableid($_G['tid']), 'pid', $pid);
					include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/comiis_app_video.fun.php';
					$_G['discuzcodemessage'] = comiis_discuzcode($_G['discuzcodemessage'], $param);
				}
			}
		}
	}
	function global_header(){
		global $_G;
		if($_G['basescript']=='forum' && CURMODULE=='post'){
			//<script src="./source/plugin/comiis_app_video/static/jquery.min.js"></script><script>jQuery.noConflict();</script>
			return '<script src="/source/plugin/comiis_app_video/static/upload.js" charset="utf-8"></script>';
		}
	}
}
class plugin_comiis_app_video_forum extends plugin_comiis_app_video{
    function post_editorctrl_left(){
        global $_G;
		$users = unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_group']);
		if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
			unset($users[0]);
		}
		if(($_G['basescript'] == 'group' && $_G['cache']['plugin']['comiis_app_video']['comiis_group_uploadvideo']) || in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_video'])) && count($users) && in_array($_G['member']['groupid'], $users)){
			include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/language/language.'.currentlang().'.php';
			include template('comiis_app_video:comiis_upkey');
			return $html;
		}
    }
}
class plugin_comiis_app_video_group extends plugin_comiis_app_video {
	function post_editorctrl_left(){
        global $_G;
		$users = unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_group']);
		if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
			unset($users[0]);
		}
		if(($_G['basescript'] == 'group' && $_G['cache']['plugin']['comiis_app_video']['comiis_group_uploadvideo']) || in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_video'])) && count($users) && in_array($_G['member']['groupid'], $users)){
			include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/language/language.'.currentlang().'.php';
			include template('comiis_app_video:comiis_upkey');
			return $html;
		}
	}
}
