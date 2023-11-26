<?php
/**
 *	[注册加入Q群展示(yeehot_reg_qqgroup.{modulename})] (C)2017-2099 Powered by yeehot.com.
 *	Version: v1.0
 *	Date: 2017-4-15 18:23
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_yeehot_reg_qqgroup {


}
class plugin_yeehot_reg_qqgroup_member extends plugin_yeehot_reg_qqgroup {
	
	public function register_top() {

		global $_G;
		$cacheinfo =$_G['cache']['plugin']['yeehot_reg_qqgroup'];
		if ($cacheinfo['isopen'] != 1) {
			return "";
		}
		$qnum=$cacheinfo['qnum'] ;
		$grouptitle=$cacheinfo['grouptitle'] ;
		include  template('yeehot_reg_qqgroup:info');
		return $return;
		 
	}

}
?>