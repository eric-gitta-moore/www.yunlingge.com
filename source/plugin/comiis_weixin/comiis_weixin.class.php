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

loadcache('plugin');
$_G['comiis_weixin'] = $_G['cache']['plugin']['comiis_weixin'];
require_once DISCUZ_ROOT.'./source/plugin/comiis_weixin/source/function_comiis_weixin.php';
include_once template('comiis_weixin:comiis_htm');
comiis_get_weixin_lang();
class mobileplugin_comiis_weixin{
	function global_header_mobile(){
		global $_G, $comiis_data;
		loadcache('plugin');
		$_G['comiis_weixin'] = $_G['cache']['plugin']['comiis_weixin'];
		$comiis_isweixin = strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ? true : false;
		if($_G['comiis_weixin']['autologin'] == 1 && $comiis_isweixin && !$_G['uid'] && !$_G['cookie']['comiis_weixin']){
			dsetcookie('comiis_weixin', 'yes');
			dheader('Location:'.comiis_get_weixin_login_url());
		}
		if($_G['comiis_weixin']['wxtopgz']){
			$wx_ids = unserialize($_G['comiis_weixin']['wxtopgzdw']);
			if(in_array('0', $wx_ids) || (($comiis_data['default'] == '1' || ($_G['basescript'] == 'forum' && CURMODULE == 'guide')) && in_array('1', $wx_ids)) || ($_G['basescript'] == 'portal' && CURMODULE == 'list' && in_array('2', $wx_ids)) || ($_G['basescript'] == 'portal' && CURMODULE == 'view' && in_array('3', $wx_ids)) || ($_G['basescript'] == 'forum' && CURMODULE == 'index' && in_array('4', $wx_ids)) || ($_G['basescript'] == 'forum' && CURMODULE == 'forumdisplay' && in_array('5', $wx_ids)) || ($_G['basescript'] == 'forum' && CURMODULE == 'viewthread' && in_array('6', $wx_ids))){
				return '<link rel="stylesheet" type="text/css" href="./source/plugin/comiis_weixin/style/comiis.css" />'.comiis_weixin_gzs();
			}
		}
	}
	function global_footer_mobile(){
		global $_G;
		if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'profile' && $_GET['mycenter'] == '1'){
			return '<script>$(".myinfo_list ul").append(\'<li><a href="home.php?mod=spacecp&ac=plugin&id=comiis_weixin:comiis_weixin_setup">'.$_G['comiis_wxlang']['047'].'</a></li>\');</script>';
		}elseif($_G['basescript'] == 'member' && CURMODULE == 'register'){
			return '<link rel="stylesheet" type="text/css" href="./source/plugin/comiis_weixin/style/comiis.css" /><script>$(".registerbox").append(\'<div class="comiis_wx_boxs" style="padding-top:20px;"><a href="'.comiis_get_weixin_login_url().'" class="comiis_wx_btn wx_btn_bg01">'.($_G['comiis_weixin']['perfect'] == '0' ? $_G['comiis_wxlang']['009'] : $_G['comiis_wxlang']['010']).'</a></div>\');</script>';
		}		
	}
	function global_comiis_home_space_profile_mobile(){
		global $_G;
		return '<a href="home.php?mod=spacecp&ac=plugin&id=comiis_weixin:comiis_weixin_setup" class="comiis_flex comiis_styli b_t cl">
<div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA06">&#xe623;</i></div><div class="flex">'.$_G['comiis_wxlang']['047'].'</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
</a>';
	}
	
	function global_comiis_member_login_mobile(){
		return '<link rel="stylesheet" type="text/css" href="./source/plugin/comiis_weixin/style/comiis.css" /><a href="'.comiis_get_weixin_login_url().'" class="bg_f b_ok"><i class="comiis_font f_wx">&#xe623;</i></a>';
	}
	
	
	
	function global_comiis_member_register_mobile(){
		global $_G;
		return '<div style="padding:0 15px 15px;"><button type="button" class="comiis_btn f_f" style="background:#99DB5E !important;" onclick="location.href=\''.comiis_get_weixin_login_url().'\';">'.($_G['comiis_weixin']['perfect'] == '0' ? $_G['comiis_wxlang']['009'] : $_G['comiis_wxlang']['010']).'</button></div>';
	}
	
	
	

}


class mobileplugin_comiis_weixin_member{
	function logging_bottom_mobile() {
		global $_G;
		$comiis_directory = DB::fetch_first("SELECT t.directory FROM %t s LEFT JOIN %t t ON s.templateid = t.templateid WHERE s.styleid='%d'", array('common_style', 'common_template',  $_G['setting']['styleid2']));
		$in_comiis_app = ($comiis_directory['directory'] == './template/comiis_app' ? 1 : 0);
		if($in_comiis_app == 0){
			$reurl = comiis_get_weixin_login_url();
			return '<link rel="stylesheet" type="text/css" href="./source/plugin/comiis_weixin/style/comiis.css" />'.comiis_weixin_login($reurl);
		}
	}
}
?>