<?php

/**
 *      $author: ³ËÁ¹ $
 */

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_wxqqshare {

	public static $identifier = 'wxqqshare';

	function __construct() {
		global $_G;
		$setconfig = $_G['cache']['plugin'][self::$identifier];
		$setconfig['request_url'] = str_replace(array('{uid}', '{username}'), array($_G['uid'], $_G['username']), $setconfig['request_url']);
		$this->setconfig = $setconfig;
	}

	function global_footer() {
		global $_G,$navtitle,$metadescription;
		$setconfig = $this->setconfig;
		$sharetitle = $setconfig['force_title'] ? $setconfig['force_title'] : $navtitle;
		$sharesummary = $setconfig['force_desc'] ? $setconfig['force_desc'] : preg_replace('# #','',dhtmlspecialchars($metadescription));
		$sharepic = $setconfig['force_image'] && $setconfig['default_image'] ? $setconfig['default_image'] : '';
		if(CURSCRIPT == 'portal' && CURMODULE == 'view'){
			global $article;
			if($article['pic'] && empty($sharepic)){
				$sharepic = $_G['siteurl'].$article['pic'];
			}
		}
		if(CURSCRIPT == 'forum' && CURMODULE == 'forumdisplay'){
			if($_G['forum']['icon'] && empty($sharepic)){
				require_once libfile('function_forumlist', 'function');
				$sharepic = get_forumimg($_G['forum']['icon']);
				$sharepic = preg_match('/^(http(s?):\/\/|\.)/i', $sharepic) ? $sharepic : $_G['siteurl'].$sharepic;
			}
		}
		if(CURSCRIPT == 'forum' && CURMODULE == 'viewthread'){
			if(empty($setconfig['force_desc'])){
				global $postarr;
				require_once libfile('function_post', 'function');
				foreach($postarr as $post) {
					if($post['first']) {
						if(!$_G['forum_thread']['price']){
							$sharesummary = str_replace(array("\r", "\n"), '', messagecutstr(strip_tags($post['message']), 160));
						}
					}
				}
			}
			if(empty($sharepic)){
				if($setconfig['viewthread_image'] == 1 || $setconfig['viewthread_image'] == 3){
					$attach = DB::fetch_first("SELECT aid FROM ".DB::table(getattachtablebytid($_G['tid']))." WHERE tid='".$_G['tid']."' AND isimage IN (1, -1) ORDER BY dateline ASC LIMIT 0,1");
					if($attach['aid']){
						$sharepic = $_G['siteurl'].getforumimg($attach['aid'], 0, 80, 80, 'fixwr');
					}else{
						if($setconfig['viewthread_image'] == 3 && $_G['forum']['icon']){
							require_once libfile('function_forumlist', 'function');
							$sharepic = get_forumimg($_G['forum']['icon']);
							$sharepic = preg_match('/^(http(s?):\/\/|\.)/i', $sharepic) ? $sharepic : $_G['siteurl'].$sharepic;
						}
					}
				}elseif($setconfig['viewthread_image'] == 2){
					if($_G['forum']['icon']){
						require_once libfile('function_forumlist', 'function');
						$sharepic = get_forumimg($_G['forum']['icon']);
						$sharepic = preg_match('/^(http(s?):\/\/|\.)/i', $sharepic) ? $sharepic : $_G['siteurl'].$sharepic;
					}
				}
			}
		}
		$sharepic = $sharepic ? $sharepic : ($setconfig['default_image'] ? $setconfig['default_image'] : $_G['siteurl'].STATICURL.'image/common/nophoto.gif');
		$protocol = $setconfig['http_type'] ? "https://" : ($this->_get_http_type() ? "https://" : "http://");
		$url = "$protocol$_SERVER[HTTP_HOST]".$this->_get_request_url();
		if($setconfig['wechat_appid'] && $setconfig['wechat_appsecret']){
			require_once DISCUZ_ROOT . './source/plugin/wxqqshare/lib/wechat.class.php';
			$wechat_client = new wxqqshare_wechat($setconfig['wechat_appid'], $setconfig['wechat_appsecret']);
			$jsapiTicket = $wechat_client->getJsApiTicket();
			$timestamp = time();
			$noncestr = "";
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			for ($i = 0; $i < 16; $i++) {
				$noncestr .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
			}
			$string = "jsapi_ticket=$jsapiTicket&noncestr=$noncestr&timestamp=$timestamp&url=$url";
			$signature = sha1($string);
			$wxconfig = array(
				"appid"     => $setconfig['wechat_appid'],
				"noncestr"  => $noncestr,
				"timestamp" => $timestamp,
				"url"       => $url.($setconfig['request_url'] ? (strpos($url, '?') !== false ? '&' : '?').$setconfig['request_url'] : ''),
				"signature" => $signature,
			);
		}
		include template(self::$identifier.':share');
		return $return;
	}

	function _get_http_type() {
		if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return true;
		} elseif ($_SERVER['SERVER_PORT'] == 443) {
			return true;
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
			return true;
		} elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return true;
		}
		return false;
    }

	function _get_request_url() {
		$request_url = $_SERVER["HTTP_X_REWRITE_URL"];
		if ($request_url == null){
			$request_url = $_SERVER["REQUEST_URI"];
		}
		return $request_url;
    }

}

?>