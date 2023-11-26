<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Deined');
}

class plugin_yw_alertlogin{

	function global_footer() {
	
		global $_G;
		$config = $_G['cache']['plugin']['yw_alertlogin'];

		if($config['open']==1){
			if(!$_G['uid'] && $_GET['mod'] != $_G['setting']['regname'] && $_GET['mod'] != 'logging'){
				$alertShowTime = $config['alertShowTime'];
				$alertShowType = $config['alertShowType'];
				if($alertShowType == 1){
					$alertShowType = 'show_alert_left';
				}else if($alertShowType == 2){
					$alertShowType = 'show_alert_bottom';
				}else{
					$alertShowType = '';
				}
				$opacity = $config['opacity']/100;
				$hoverOpacity = $config['hoverOpacity']/100;
				$alertText = $config['alertText'];
				$alertTextColor = $config['alertTextColor'];
				$alertTextSize = $config['alertTextSize'];
				$alertHeight = $config['alertHeight'];
				$loginText = $config['loginText'];
				$loginTextColor = $config['loginTextColor'];
				$loginColor = $config['loginColor'];
				$registerText = $config['registerText'];
				$registerTextColor = $config['registerTextColor'];
				$registerColor = $config['registerColor'];
				$buttonRaduis = $config['buttonRaduis'];
				$buttonTextSize = $config['buttonTextSize'];
				$orText = $config['orText'];
				$isShowOff = $config['isShowOff'];
				include template('yw_alertlogin:alert');
			}
		}
		return $return;
	}

}

?>