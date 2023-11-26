<?php
/**
 *	[[Ñ¸½Ý]¹Ø×¢»áÔ±(xunjie_attention.{modulename})] (C)2020-2099 Powered by Ñ¸½Ý.
 *	Version: 1.0.0
 *	Date: 2020-2-22 08:22
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_xunjie_attention {
	//TODO - Insert your code here
	function global_usernav_extra1() {
		global $_G;
		if(!empty($_G['uid']) && !strpos($_G['cache']['plugin']['xunjie_attention']['usergroup'], '"'.$_G['groupid'].'"')) {
			return '<span id="xunjie_attention_s"></span> ';
		}else{
			return '';
		}
	}
	function global_footer() {
		global $_G;
		if(!empty($_G['uid']) && !strpos($_G['cache']['plugin']['xunjie_attention']['usergroup'], '"'.$_G['groupid'].'"')) {
			include template('xunjie_attention:attention');
			$js = 'xunjie_attention_2 = \''.lang('plugin/xunjie_attention', 'xunjie_attention_2').'\';xunjie_attention_5 = \''.lang('plugin/xunjie_attention', 'xunjie_attention_5').'\';';
			$ajax = 'ajaxget(\'plugin.php?id=xunjie_attention:attention&type=5&formhash='.FORMHASH.'\', \'xunjie_attention_s\', \'xunjie_attention_w\');';
			return $attention.'<script>'.$js.$ajax.'</script>';
		}else{
			return '';
		}
	}
}
class plugin_xunjie_attention_forum extends plugin_xunjie_attention {
	function viewthread_sidebottom_output() {
		global $_G,$postlist;
		$post = reset($postlist);
		if(!empty($_G['uid']) && !strpos($_G['cache']['plugin']['xunjie_attention']['usergroup'], '"'.$_G['groupid'].'"') && $_G['forum_thread']['authorid'] != $_G['uid'] && $post['first'] == 1) {
			$count = DB::fetch_first("SELECT COUNT(uid) FROM %t WHERE uid=%d AND buid=%d", array('xunjieattention', $_G['uid'], $_G['forum_thread']['authorid']), FALSE);
			if($count['COUNT(uid)'] > 0) {
				return array(0 => '<ul class="xl xl2 o cl"><li id="follow_li" class="pm2" style="background-image:url(source/plugin/xunjie_attention/image/2.3.png);width:100px;"><a id="follow_a" href="plugin.php?id=xunjie_attention:attention&type=2&authorid='.$_G['forum_thread']['authorid'].'&author='.rawurlencode($_G['forum_thread']['author']).'&formhash='.FORMHASH.'" class="xi2" style="color:#515151;" onclick="ajaxget(this.href, \'follow_a\');return false;">'.lang('plugin/xunjie_attention', 'xunjie_attention_5').'</a></li></ul>');
			}else{
				return array(0 => '<ul class="xl xl2 o cl"><li id="follow_li" class="pm2" style="background-image:url(source/plugin/xunjie_attention/image/1.3.png);width:100px;"><a id="follow_a" href="plugin.php?id=xunjie_attention:attention&type=1&authorid='.$_G['forum_thread']['authorid'].'&author='.rawurlencode($_G['forum_thread']['author']).'&formhash='.FORMHASH.'" class="xi2" style="color:#F64B31;" onclick="ajaxget(this.href, \'follow_a\');return false;">'.lang('plugin/xunjie_attention', 'xunjie_attention_2').'</a></li></ul>');
			}
		}else{
			return array(0 => '');
		}
	}
}
?>