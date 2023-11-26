<?php
/**
 * 
 * 克米出品 必属精品
 * 克米设计工作室 版权所有 http://www.Comiis.com
 * 专业论坛首页及风格制作, 页面设计美化, 数据搬家/升级, 程序二次开发, 网站效果图设计, 页面标准DIV+CSS生成, 各类大中小型企业网站设计...
 * 我们致力于为企业提供优质网站建设、网站推广、网站优化、程序开发、域名注册、虚拟主机等服务，
 * 一流设计和解决方案为企业量身打造适合自己需求的网站运营平台，最大限度地使企业在信息时代稳握无限商机。
 *
 *   电话: 0668-8810200
 *   手机: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作时间: 周一到周五早上09:00-11:00, 下午03:00-05:00, 晚上08:30-10:30(周六、日休息)
 * 克米设计用户交流群: ①群83667771 ②群83667772 ③群83667773 ④群110900020 ⑤群110900021 ⑥群70068388 ⑦群110899987
 * 
 */
 
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
$comiis_sms = array();
class mobileplugin_comiis_sms{
	var $is_comiis_template;
	var $comiis_is_mobile_user = 0;
	var $comiis_config = array();
	function mobileplugin_comiis_sms(){
		global $_G, $comiis_sms;
		include DISCUZ_ROOT.'./source/plugin/comiis_sms/language/language.'.currentlang().'.php';
		loadcache('plugin');
		$_G['comiis_sms'] = $_G['cache']['plugin']['comiis_sms'];
		$comiis_directory = DB::fetch_first("SELECT t.directory FROM %t s LEFT JOIN %t t ON s.templateid = t.templateid WHERE s.styleid='%d'", array('common_style', 'common_template',  $_G['setting']['styleid2']));
		$this->is_comiis_template = $comiis_directory['directory'] == './template/comiis_app' ? 1 : 0;
		$this->comiis_config = $_G['comiis_sms'];
		$_G['comiis_is_mobile_user'] = 0;
		if($_G['uid']){
			$_G['comiis_is_mobile_user'] = DB::result_first("SELECT COUNT(*) FROM %t WHERE uid=%d", array('comiis_sms_user', $_G['uid']));
		}
		$this->comiis_is_mobile_user = $_G['comiis_is_mobile_user'] ? 1 : 0;
	}
	function global_footer_mobile(){
		global $_G, $comiis_sms;
		if($_G['basescript'] == 'member' && CURMODULE == 'register' && $_G['comiis_sms']['open_mobreg'] && $_G['comiis_sms']['reg_mod'] == 0 && $_GET['agreement'] != 'yes'){
			if($this->is_comiis_template == 0){
				$comiis_app_switch = array();
				$comiis_app_switch['comiis_reg_zmtxt'] = $comiis_app_switch['comiis_reg_ico'] = $comiis_app_switch['comiis_reg_tit'] = 1;
			}else{
				loadcache('comiis_app_switch'); 
				$comiis_app_switch = $_G['cache']['comiis_app_switch'];
			}
			if($_G['comiis_sms']['seccodeverify']){
				list($seccodecheck, $secqaacheck) = seccheck('register');
			}
			include_once template('comiis_sms:touch/comiis_mobreg_js');
			$returnjs = $return;
			include_once template('comiis_sms:touch/comiis_reg');
			return $returnjs.$return;
		}elseif($_G['basescript'] == 'member' && CURMODULE == 'logging' && $_GET['lostpasswd'] == 'yes' && $this->comiis_config['lostpw_mod'] == 0 && $this->is_comiis_template == 1 && $this->comiis_config['tel_lpw']){
			if($this->is_comiis_template == 0){
				$comiis_app_switch = array();
				$comiis_app_switch['comiis_reg_zmtxt'] = $comiis_app_switch['comiis_reg_ico'] = $comiis_app_switch['comiis_reg_tit'] = 1;
			}else{
				loadcache('comiis_app_switch'); 
				$comiis_app_switch = $_G['cache']['comiis_app_switch'];
			}
			if($_G['comiis_sms']['lostpw_seccodeverify']){
				list($seccodecheck) = seccheck('login');
			}
			include_once template('comiis_sms:comiis_mobreg_js');
			$returnjs = $return;
			include_once template('comiis_sms:comiis_lpw');
			return $returnjs.$return;
		}elseif($_G['basescript'] == 'member' && CURMODULE == 'logging' && $_G['comiis_sms']['tel_login']){
			return '<script>
			$("input[name=\'username\']").attr("placeholder","'.$comiis_sms['163'].'");
			'.(($_G['comiis_sms']['open_mobreg'] && $this->is_comiis_template == 0) ? '$(".loginbox .reg_link").append("<a href=\"member.php?mod=logging&action=login&lostpasswd=yes\" class=\"y\">'.$comiis_sms['159'].'</a>");' : '').'
			</script>';
		}elseif($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'profile' && $_GET['mycenter'] == '1'){
			return '<script>$(".myinfo_list ul").append(\'<li><a href="home.php?mod=spacecp&ac=plugin&id=comiis_sms:comiis_setup">'.$comiis_sms['162'].'</a></li>\');</script>';
		}else{
			if($_G['uid']){
				if(!$this->comiis_is_mobile_user && $this->comiis_config['verify_tip'] && !($_GET['ac'] == 'plugin' && $_GET['id'] == 'comiis_sms:comiis_setup') && empty($_G['cookie']['comiis_sms_tip_m'])){
					$users = unserialize($this->comiis_config['verify_tip_user']);
					if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
						unset($users[0]);
					}
					if(count($users) < 1 || !in_array($_G['member']['groupid'], $users)){
						$close_time = intval($this->comiis_config['verify_tip_time']);
						include_once template('comiis_sms:touch/comiis_tip');
						return $data;
					}
				}
			}
		}
	}
	function global_comiis_home_space_profile_mobile(){
		global $_G, $comiis_sms;
		return '<a href="home.php?mod=spacecp&ac=plugin&id=comiis_sms:comiis_setup" class="comiis_flex comiis_styli b_t cl">
<div class="styli_tit f_c"><i class="comiis_font" style="color:#F37D7D">&#xe684;</i></div><div class="flex">'.$comiis_sms['162'].'</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
</a>';
	}
	function global_comiis_member_login_mobile(){
		global $_G, $comiis_sms;
		if($_G['basescript'] == 'member' && CURMODULE == 'register'){
		return '<a href="javascript:;" onclick="comiis_sms_regbox(1);" class="bg_f b_ok"><i class="comiis_font f_wb">&#xe6e8;</i></a>';
		}else{
			if($_G['comiis_sms']['tel_reglogin']){
				return '<a href="plugin.php?id=comiis_sms:comiis_login&action=login" class="bg_f b_ok"><i class="comiis_font f_wb">&#xe6e8;</i></a>';
			}else{
				return '<a href="member.php?mod='.$_G[setting][regname].'" class="bg_f b_ok"><i class="comiis_font f_wb">&#xe6e8;</i></a>';
			}
		}
	}
	function _comiis_user_limit($tip){
		global $_G, $allowfastpost, $comiis_sms;
		if($_G['uid'] && !$this->comiis_is_mobile_user && !getstatus($_G['member']['allowadmincp'], 1) && $this->comiis_config['nov_post']){
			$users = unserialize($this->comiis_config['nov_post_user']);
			if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
				unset($users[0]);
			}
			$nov_post_forum = unserialize($this->comiis_config['nov_post_forum']);
			if(isset($nov_post_forum[0]) && ($nov_post_forum[0] == '0' || $nov_post_forum[0] == '')){
				unset($nov_post_forum[0]);
			}			
			if(!empty($_G['fid']) && in_array($_G['fid'], $nov_post_forum)){
				return;
			}
			if(count($users) < 1 || !in_array($_G['member']['groupid'], $users)){
				$allowfastpost = 0;
				if($tip == '1'){
					showmessage($comiis_sms['76'], "home.php?mod=spacecp&ac=plugin&id=comiis_sms:comiis_setup", '', array('showdialog' => 1, 'locationtime' => true));
				}
			}
		}
	}
}
class mobileplugin_comiis_sms_member extends mobileplugin_comiis_sms {
	function logging_bottom_mobile(){
		global $_G, $comiis_sms;
		if($_G['comiis_sms']['tel_reglogin'] && $this->is_comiis_template == 0){
			return '<div class="btn_login"><a href="plugin.php?id=comiis_sms:comiis_login&action=login" class="pn pnc" ><span>'.$comiis_sms['168'].'</span></a></div>';
		}
	}
	function register_comiis(){
		global $_G, $comiis_sms;
		if($_G['comiis_sms']['open_mobreg']){
		if(submitcheck('regsubmit') && $this->comiis_config['reg_mod'] == 1) {
				showmessage($comiis_sms['77']);
				dexit();
			}elseif($this->comiis_config['reg_mod'] == 1  && $_GET['agreement'] != 'yes' && !$_G['uid']){ 
				if($this->is_comiis_template == 0){
					$comiis_app_switch = array();
					$comiis_app_switch['comiis_reg_zmtxt'] = $comiis_app_switch['comiis_reg_ico'] = $comiis_app_switch['comiis_reg_tit'] = 1;
				}else{
					loadcache('comiis_app_switch'); 
					$comiis_app_switch = $_G['cache']['comiis_app_switch'];
				}
				
				if($_G['comiis_sms']['seccodeverify']){
					list($seccodecheck, $secqaacheck) = seccheck('register');
				}
			
				include_once template('comiis_sms:touch/comiis_mobreg_js');
				$returnjs = $return;
				include_once template('comiis_sms:touch/comiis_reg');
				include_once template('common/header');
				echo $returnjs.$return;
				include_once template('common/footer');
				dexit();
			}
		}
	}
	function logging_comiis(){
		global $_G, $comiis_sms;
		if($_GET['lostpasswd'] == 'yes' && !$_G['uid'] && $this->comiis_config['tel_lpw']){
			if($this->comiis_config['lostpw_mod'] == 1 || $this->is_comiis_template == 0){
				if($this->is_comiis_template == 0){
					$comiis_app_switch = array();
					$comiis_app_switch['comiis_reg_zmtxt'] = $comiis_app_switch['comiis_reg_ico'] = $comiis_app_switch['comiis_reg_tit'] = 1;
				}else{
					loadcache('comiis_app_switch'); 
					$comiis_app_switch = $_G['cache']['comiis_app_switch'];
				}
				if($_G['comiis_sms']['lostpw_seccodeverify']){
					list($seccodecheck) = seccheck('login');
				}
				include_once template('comiis_sms:touch/comiis_mobreg_js');
				$returnjs = $return;
				include_once template('comiis_sms:touch/comiis_lpw');
				include_once template('common/header');
				echo $returnjs.$return;
				include_once template('common/footer');
				dexit();
			}
		}else{
			loadcache('plugin');
			$_G['comiis_sms'] = $_G['cache']['plugin']['comiis_sms'];
			if($_G['comiis_sms']['tel_login'] && $_GET['loginsubmit'] && $_GET['username']) {
				if(preg_match('/^(\+)?(86)?0?1\d{10}$/', $_GET['username'])){
					if($_G['comiis_sms']['login_seccodeverify']){
						list($seccodecheck) = seccheck('login');
						if($seccodecheck && !check_seccode($_GET['seccodeverify'], $_GET['seccodehash'], 0, $_GET['seccodemodid'])) {
							showmessage('submit_seccode_invalid');
						}
					}
					$comiis_teluser = DB::fetch_all("SELECT * FROM %t WHERE tel=%s ORDER BY dateline DESC", array('comiis_sms_user', $_GET['username']));
					if(is_array($comiis_teluser)){
						require_once libfile('function/member');
						loaducenter();
						foreach($comiis_teluser as $v){
							$user = getuserbyuid($v['uid']);
							if($user['uid'] == $v['uid']){
								if(!($_G['member_loginperm'] = logincheck($user['username']))) {
									showmessage('login_strike');
								}						
								$result = uc_user_login($user['username'], $_GET['password'], 0, 0, $_GET['questionid'], $_GET['answer'], $_G['clientip']);
								if ($result[0] == $v['uid']) {
									setloginstatus($user, 1296000);
									showmessage($comiis_sms['75'], $_GET['referer'] ? $_GET['referer'] : './', '', array('showdialog' => 1, 'locationtime' => true));
								}
							}
						}			
					}
				}
			}
			
		}
	}
	function lostpasswd_code(){
		global $comiis_sms;
		if(submitcheck('lostpwsubmit') && $this->comiis_config['lostpw_mod'] == 1) {
			showmessage($comiis_sms['78']);
		}
	}
}
class mobileplugin_comiis_sms_forum extends mobileplugin_comiis_sms {
	function post() {
		$this->_comiis_user_limit('1');
	}
}
class mobileplugin_comiis_sms_group extends mobileplugin_comiis_sms {
	function post() {
		$this->_comiis_user_limit('1');
	}
	function group_create() { 
		if($_GET['action'] == 'create' || $_GET['action'] == 'manage'){
			$this->_comiis_user_limit('1');
		}
	}
}
class mobileplugin_comiis_sms_portal extends mobileplugin_comiis_sms {
	function portalcp() {
		if($_GET['ac'] == 'comment' || $_GET['ac'] == 'article'){
			$this->_comiis_user_limit('1');
		}
	}
}
class mobileplugin_comiis_sms_home extends mobileplugin_comiis_sms {
	function spacecp_blog() { 
		$this->_comiis_user_limit('1');
	}
	function spacecp_comment(){ 
		$this->_comiis_user_limit('1');
	}
	function spacecp_follow(){ 
		$this->_comiis_user_limit('1');
	}
	
	function spacecp_doing(){
		$this->_comiis_user_limit('1');
	}
	function spacecp_feed(){
		$this->_comiis_user_limit('1');
	}
	function spacecp_upload(){ 
		$this->_comiis_user_limit('1');
	}
}