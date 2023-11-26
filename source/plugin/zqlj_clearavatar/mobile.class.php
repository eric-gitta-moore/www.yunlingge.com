<?php
/*
 * 主页：http://addon.dismall.com/?@72763.developer
 * 苏州众器良匠网络科技有限公司 出品
 * 插件定制 联系QQ281688302
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class mobileplugin_zqlj_clearavatar {
	function global_footer_mobile(){
		global $_G;
	    loadcache('plugin');
		$vars = $_G['cache']['plugin']['zqlj_clearavatar'];
		$uids=(array)explode(',',$vars['uids']);
		if(($_G['uid']&&in_array($_G['uid'],$uids))||$_G['groupid']==1){
			if($_GET['mod']=='space'&&$_GET['uid']){
				$msg=addslashes(trim($vars['msg']));
				return "<center><strong><a style=\"color:red;\" href='plugin.php?id=zqlj_clearavatar:clearavatar&clearuid=".$_GET['uid']."&inmobile=1&formhash=".FORMHASH."' onclick=\"clearavatar(this.href);return false;\">".lang('plugin/zqlj_clearavatar', 'op_tips')."</a></strong></center><script type=\"text/javascript\">
function clearavatar(url){
	if(confirm(\"".lang('plugin/zqlj_clearavatar','op_cleartip1').lang('plugin/zqlj_clearavatar','op_cleartip2')."\")){
		window.location =url;
	}
	return false;
}
</script>";
			}
		}
		return '';		
	}
}

?>