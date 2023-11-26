<?php
/*
 * 主页：http://addon.dismall.com/?@72763.developer
 * 苏州众器良匠网络科技有限公司 出品
 * 插件定制 联系QQ281688302
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_zqlj_clearavatar {

}

class plugin_zqlj_clearavatar_home extends plugin_zqlj_clearavatar{

	function space_profile_baseinfo_top(){
		global $_G;
	    loadcache('plugin');
		$vars = $_G['cache']['plugin']['zqlj_clearavatar'];
		$uids=(array)explode(',',$vars['uids']);
		if(($_G['uid']&&in_array($_G['uid'],$uids))||$_G['groupid']==1){
			if($_GET['mod']=='space'&&$_GET['uid']){
				return "<p><strong><a style=\"color:red;\" href='plugin.php?id=zqlj_clearavatar:clearavatar&clearuid=".$_GET['uid']."&op_fid=".$_G['fid']."' onclick=\"showWindow('zqlj_clearavatar', this.href);return false;\">".lang('plugin/zqlj_clearavatar', 'op_tips')."</a></strong></p>";
			}
		}
		return '';
	}	
}

?>