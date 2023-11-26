<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
//全局嵌入点类（必须存在）
class plugin_saya_https {
	private function _is_https() {
		// var_dump($_SERVER[ 'HTTP_X_FORWARDED_PROTO' ],$_SERVER[ 'HTTP_FRONT_END_HTTPS' ]);
		if ($_SERVER[ 'HTTP_X_FORWARDED_PROTO' ] === 'http')
		{
			return false;
		}
		elseif ( !empty( $_SERVER[ 'HTTPS' ] ) && strtolower( $_SERVER[ 'HTTPS' ] ) !== 'off' ) {
			return true;
		} elseif ( isset( $_SERVER[ 'HTTP_X_FORWARDED_PROTO' ] ) && $_SERVER[ 'HTTP_X_FORWARDED_PROTO' ] === 'https' ) {
			return true;
		} elseif ( !empty( $_SERVER[ 'HTTP_FRONT_END_HTTPS' ] ) && strtolower( $_SERVER[ 'HTTP_FRONT_END_HTTPS' ] ) !== 'off' ) {
			return true;
		}
		return false;
	}
	
	function common(){
		global $_G;
		if($this->_is_https()){ return;}
		$httphost=str_replace(array("http://","https://"),array("",""),$_G['siteurl']);
		$httphost=explode('/',$httphost);
		$httphost=$httphost[0];
		if($httpslist=$_G['cache']['plugin']['saya_https']['httpslist']){
			$httpslist=str_replace(array("http://","https://"),array("",""),$httpslist);
			$domain=preg_replace("/[\r\n]{1,2}/","\n", trim($httpslist));
			$domain=explode("\n", $domain );
			foreach($domain as $value){
				if(strpos($value,$httphost)!==false || strpos($httphost,$value)!==false){
					$jump=true;
				}
			}
		}else{
			$jump=true;
		}
		if($jump){
    		header("HTTP/1.1 301 Moved Permanently");
    		header('Location: https://'.$httphost.$_SERVER['REQUEST_URI']);
			exit();
		}
	}
}

class mobileplugin_saya_https extends plugin_saya_https {
}

?>