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
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$comiis_sms = array();
class plugin_comiis_sms {
	var $comiis_is_mobile_user = 0;
	var $comiis_config = array();
	function plugin_comiis_sms() {
		global $_G, $comiis_sms;
		include DISCUZ_ROOT.'./source/plugin/comiis_sms/language/language.'.currentlang().'.php';
		loadcache('plugin');
		$_G['comiis_sms'] = $_G['cache']['plugin']['comiis_sms'];
		$this->comiis_config = $_G['comiis_sms'];
		$_G['comiis_is_mobile_user'] = 0;
		if($_G['uid']){
			$_G['comiis_is_mobile_user'] = DB::result_first("SELECT COUNT(*) FROM %t WHERE uid=%d", array('comiis_sms_user', $_G['uid']));
		}
		$this->comiis_is_mobile_user = $_G['comiis_is_mobile_user'] ? 1 : 0;
	}
	function global_login_extra(){
		global $_G, $comiis_sms;
		if($_G['comiis_sms']['tel_reglogin']){
			return '<div class="fastlg_fm y" style="margin-right:10px;padding-right:10px"><p><a href="plugin.php?id=comiis_sms:comiis_login&action=login&inajax=1" onclick="showWindow(\'login\', this.href, \'get\', 0);"><img src="source/plugin/comiis_sms/image/sms_login.png" alt="'.$comiis_sms['171'].'" class="vm"></a></p><p class="hm xg1" style="padding-top:2px;">'.$comiis_sms['172'].'</p></div>';
		}
	}
	function _comiis_sms_login_html(){
		global $_G, $comiis_sms;
		if($_G['comiis_sms']['tel_reglogin']){
			return '<a href="plugin.php?id=comiis_sms:comiis_login&action=login&inajax=1" onclick="showWindow(\'login\', this.href,\'get\', 0);"><img src="source/plugin/comiis_sms/image/sms_login.png" alt="'.$comiis_sms['171'].'" class="vm"></a>';
		}
	}
	function global_login_text(){
		return $this->_comiis_sms_login_html();
	}
	function global_header() {
		global $_G, $comiis_sms;
		$return = '';
		if(!$_G['uid']){
			$comiis_mod = 'register';
			if($_G['comiis_sms']['seccodeverify']){		
				list($seccodecheck, $secqaacheck) = seccheck('register');
				if($secqaacheck || $seccodecheck){
					$sectpl = '<div class="rfm"><table><tr><th><span class="rq">*</span><sec>: </th><td><sec><br /><sec></td></tr></table></div>';
					$sechash = !isset($sechash) ? 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'] : $sechash.random(3);
				}
			}
			include template('comiis_sms:comiis_mobreg');
			$regdata = preg_replace("/\r\n|\n|\r/", '', addcslashes($return, "'\\"));
			include template('comiis_sms:comiis_mobreg_js');
		}else{
			$this->_comiis_user_limit('0');
			if(!$this->comiis_is_mobile_user && $this->comiis_config['verify_tip'] && !($_GET['ac'] == 'plugin' && $_GET['id'] == 'comiis_sms:comiis_setup') && empty($_G['cookie']['comiis_sms_tip'])){
				$users = unserialize($this->comiis_config['verify_tip_user']);
				if(isset($users[0]) && ($users[0] == '0' || $users[0] == '')){
					unset($users[0]);
				}			
				if(count($users) < 1 || !in_array($_G['member']['groupid'], $users)){
					$return .= "<script>showDialog('{$this->comiis_config['verify_title']}', 'confirm', '{$comiis_sms['65']}', 'document.location.href = \'home.php?mod=spacecp&ac=plugin&id=comiis_sms:comiis_setup\';comiis_sms_tip_js();', 1, 'comiis_sms_tip_js()', '', '{$comiis_sms['71']}', '{$comiis_sms['72']}');
					function comiis_sms_tip_js(){
						setcookie('comiis_sms_tip', 1, ".intval($this->comiis_config['verify_tip_time']).");
					}
					</script>";
				}
			}
		}
		return ($_G['comiis_sms']['jquery'] ? '<script src="./source/plugin/comiis_sms/image/jquery.min.js" type="text/javascript"></script>' : '').$return;	
	}
	function global_usernav_extra1(){
		global $_G, $comiis_sms;
		if($_G['uid']){
			return '<span class="pipe">|</span><a href="home.php?mod=spacecp&ac=plugin&id=comiis_sms:comiis_setup"'.($this->comiis_is_mobile_user ? '' : ' style="color:#dd0000;"').'>'.($this->comiis_is_mobile_user ? $comiis_sms['73'] : $comiis_sms['74']).'</a> ';
		}
	}
	function logging(){
		global $_G, $comiis_sms;
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
					if(!function_exists('uc_user_login')) {
						loaducenter();
					}
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
					showmessage($comiis_sms['76'], './home.php?mod=spacecp&ac=plugin&id=comiis_sms:comiis_setup', '', array('showdialog' => 1, 'locationtime' => true));
				}
			}
		}
	}
}
class plugin_comiis_sms_forum extends plugin_comiis_sms {
	function post() {
		$this->_comiis_user_limit('1');
	}
}
class plugin_comiis_sms_group extends plugin_comiis_sms {
	function post() {
		$this->_comiis_user_limit('1');
	}
	function group_create() {
		if($_GET['action'] == 'create' || $_GET['action'] == 'manage'){
			$this->_comiis_user_limit('1');
		}
	}
}
class plugin_comiis_sms_portal extends plugin_comiis_sms {
	function portalcp() {
		if($_GET['ac'] == 'comment' || $_GET['ac'] == 'article'){
			$this->_comiis_user_limit('1');
		}
	}
}
class plugin_comiis_sms_home extends plugin_comiis_sms {
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
class plugin_comiis_sms_member extends plugin_comiis_sms {
	function logging_method() {
		return $this->_comiis_sms_login_html();
	}
	function register_logging_method() {
		return $this->_comiis_sms_login_html();
	}
	function logging_top_output(){
		global $_G, $comiis_sms;
		if($this->comiis_config['tel_lpw']){
			if($_G['comiis_sms']['lostpw_seccodeverify']){
				list($seccodecheck2) = seccheck('login');
				if($seccodecheck2){
					$sectpl2 = '<table><tr><th><span class="rq">*</span><sec>: </th><td><sec><br /><sec></td></tr></table>';
					$sechash2 = !isset($sechash) ? 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'] : $sechash.random(3);
				}
			}
			include template('comiis_sms:comiis_mobreg');
			$htmldata = preg_replace("/\r\n|\n|\r/", '', addcslashes($data, "'\\"));
			return '<script type="text/javascript" reload="1">'.
				($_G['comiis_sms']['tel_lpw'] ? '
				function comiis_mobile_run_logg_js(){
					if(typeof(jQuery) == \'undefined\'){
						comiis_mobile_runjs_num_ADDONVAR_var1++;
						if(comiis_mobile_runjs_num_ADDONVAR_var1 < 10){
							setTimeout(function(){
								comiis_mobile_run_logg_js();
							}, 500);
						}
					}else{
						comiis_lostpwform = jQuery(\'form[id^="lostpwform_"]\');
						comiis_lostpwform = jQuery(\'#\'+comiis_lostpwform.attr(\'id\'));
						jQuery(\''.$htmldata.'\').insertBefore(comiis_lostpwform);
						'.($_G['comiis_sms']['lostpw_mod'] == 0 ? 'comiis_lostpwform.hide();' : 'comiis_lostpwform.remove();').'
						
						'.($_G['comiis_sms']['lostpw_seccodeverify']? "updateseccode('cc$sechash2', '$sectpl2', 'member::logging');" : '').'
						
					}
				}
				jQuery(document).ready(function(){
					comiis_mobile_run_logg_js();
				});
				' : '').
			'</script>';
		}
	}
	function register_code(){
		global $comiis_sms;

		if(submitcheck('regsubmit') && $this->comiis_config['reg_mod'] == 1) {
			showmessage($comiis_sms['77']);
		}
	}
	function lostpasswd_code(){
	global $comiis_sms;
		if(submitcheck('lostpwsubmit') && $this->comiis_config['lostpw_mod'] == 1) {
			showmessage($comiis_sms['78']);
		}
	}
}