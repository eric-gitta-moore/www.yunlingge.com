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
class mobileplugin_comiis_app_video{
	function discuzcode($param){
		global $_G, $pid;
		if($param['caller'] == 'discuzcode'){
			if(($_G['forum_thread']['isgroup'] || ($_G['basescript']=='forum' && CURMODULE=='viewthread')) && dstrpos($_G['discuzcodemessage'], array('[/img]')) !== FALSE){
				if(preg_match_all("/\[img\=?([\w,]*)\]\s*(.*?)\s*\[\/img\]/is", $_G['discuzcodemessage'], $matches)) {
					foreach($matches[2] as $key => $img){
						$_G['discuzcodemessage'] = str_replace($matches[0][$key], '<img src="'.$matches[2][$key].'" style="max-width:100%" />', $_G['discuzcodemessage']); 
					}
				}
			}
			if(($_G['forum_thread']['isgroup'] && $_G['cache']['plugin']['comiis_app_video']['comiis_group']) || ($_G['basescript']=='forum' && CURMODULE=='viewthread' && in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum'])))){
				if(dstrpos($_G['discuzcodemessage'], array('[/media]', '[/flash]', '[/audio]', '[/attach]')) !== FALSE){
					$_G['comiis_video_attach'] = C::t('forum_attachment_n')->fetch_all_by_id(getattachtableid($_G['tid']), 'pid', $pid);
					include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/comiis_app_video.fun.php';
					$_G['discuzcodemessage'] = comiis_discuzcode($_G['discuzcodemessage'], $param);
				}
			}
		}
	}
	function global_header_mobile(){
		global $_G;
		if($_G['is_comiis_portal'] == 1 || (($_G['forum_thread']['isgroup'] || $_G['basescript'] == 'group') && ($_G['cache']['plugin']['comiis_app_video']['comiis_group'] || $_G['cache']['plugin']['comiis_app_video']['comiis_group_list'])) || ($_G['basescript']=='forum' && CURMODULE=='viewthread' && in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum']))) || ($_G['basescript']=='forum' && CURMODULE=='forumdisplay' && in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum_video'])))){
			return '<style>.comiis_video{width:100%;height:100%;}</style>
			<script>    
			var comiis_document_lognhmtztgb_heightxeem = 0;
			$(function(){
				comiis_setbtxa_widthisui();
				$(window).scroll(function() {
					if($(document).height() != comiis_document_lognhmtztgb_heightxeem){
						comiis_document_lognhmtztgb_heightxeem = $(document).height();
						comiis_setbtxa_widthisui();
					}
				});
			});
			function comiis_setbtxa_widthisui(){
				$(".comiis_no_width").each(function(){
					var comiis_tempheight = $(this).width() / parseFloat("'.$_G['cache']['plugin']['comiis_app_video']['comiis_scale'].'");
					$(this).css("height", (comiis_tempheight > $(this).width() ? $(this).width() : comiis_tempheight)).removeClass("comiis_no_width");
					'.(($_G['basescript']=='forum' && CURMODULE=='viewthread') ? '$(".comiis_video_height").css("height", $(window).width() / parseFloat("'.$_G['cache']['plugin']['comiis_app_video']['comiis_scale'].'"));' : '').'
				});		
			}
			function comiis_setvideowidth(){
				comiis_setbtxa_widthisui();
			}
			comiis_setbtxa_widthisui();
			</script>';
		}
	}
    function global_comiis_forumdisplay_list_bottom(){
		global $_G;
		if(($_G['basescript'] == 'plugin' && CURMODULE=='comiis_app_portal') || ($_G['basescript']=='forum' || $_G['basescript'] == 'group') && CURMODULE=='forumdisplay' && $_G['style']['directory'] == './template/comiis_app' && (in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum_audio'])) || in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum_video'])) || (($_G['basescript'] == 'group' && $_G['cache']['plugin']['comiis_app_video']['comiis_group_list']) || ($_G['basescript'] == 'group' && $_G['cache']['plugin']['comiis_app_video']['comiis_group_list_audio'])))){
			include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/comiis_app_video.fun.php';
			return _comiis_forumdisplay_video_list();
		}
	}
	function global_comiis_video_box(){
		global $_G;
		if($_G['style']['directory'] == './template/comiis_app' && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && CURMODULE == 'post'){
			$users = unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_group']);
			if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
				unset($users[0]);
			}
			if(($_G['basescript'] == 'group' && $_G['cache']['plugin']['comiis_app_video']['comiis_group_uploadvideo']) || in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_video'])) && count($users) && in_array($_G['member']['groupid'], $users)){
				include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/comiis_app_video.fun.php';
				$_G['comiis_video_is_comiis'] = 1;
				$_G['comiis_video_access_token'] = _comiis_getyoukukey();
				include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/language/language.'.currentlang().'.php';
				include template('comiis_app_video:hook');
				return $html;
			}
		}
	}
}
class mobileplugin_comiis_app_video_forum extends mobileplugin_comiis_app_video{
    function viewthread_postbottom_mobile(){
		$re_js = '<script>comiis_setbtxa_widthisui();</script>';
		return array($re_js, $re_js, $re_js, $re_js, $re_js);
	}
    function forumdisplay_thread_mobile_output(){
		global $_G;
		if($_G['basescript']=='forum' && CURMODULE=='forumdisplay' && $_G['style']['directory'] != './template/comiis_app' && (in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum_audio'])) || in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_forum_video'])) || ($_G['forum_thread']['isgroup'] && ($_G['cache']['plugin']['comiis_app_video']['comiis_group_list'] || $_G['cache']['plugin']['comiis_app_video']['comiis_group_list_audio'])))){
			include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/comiis_app_video.fun.php';
			return _comiis_forumdisplay_video_list();
		}
	}
	function post_bottom_mobile_output(){
		global $_G;

		if($_G['style']['directory'] != './template/comiis_app'){
			$users = unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_group']);
			if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
				unset($users[0]);
			}
			if(($_G['basescript'] == 'group' && $_G['cache']['plugin']['comiis_app_video']['comiis_group_uploadvideo']) || in_array($_G['fid'], unserialize($_G['cache']['plugin']['comiis_app_video']['comiis_upload_video'])) && count($users) && in_array($_G['member']['groupid'], $users)){
				include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/comiis_app_video.fun.php';
				$_G['comiis_video_is_comiis'] = 0;
				$_G['comiis_video_access_token'] = _comiis_getyoukukey();
				include_once DISCUZ_ROOT.'./source/plugin/comiis_app_video/language/language.'.currentlang().'.php';
				include template('comiis_app_video:hook');
				return $html;
			}
		}
	}
}
