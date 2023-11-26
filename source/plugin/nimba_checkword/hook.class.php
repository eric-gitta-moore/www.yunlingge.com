<?php
/*
 * 应用中心主页：https://addon.dismall.com/?@1552.developer
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ281688302/594941227
 * From www.ailab.cn
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_nimba_checkword {
	function checkword($str){
		$charset=strtolower(CHARSET);
		if($charset!='utf-8')	$str=diconv($str,CHARSET,'UTF-8');
		if(preg_match('/[\x{4e00}-\x{9fa5}]{3,}/u',$str)){
			return true;
		}else{
			return false;
		}		
	}
}

class plugin_nimba_checkword_forum extends plugin_nimba_checkword{
	function post_checkword(){
		global $_G;
		loadcache('plugin');
		$tips=$_G['cache']['plugin']['nimba_checkword']['tips'];	
		//var_dump($tips);
		if($_GET['action']=='newthread'&&submitcheck('topicsubmit')){
			$subject = daddslashes(trim($_POST['subject']));
			$message = daddslashes(trim($_POST['message']));
			if(!$subject&&!$message){
				return '';
			}			
			if(!$this->checkword($subject)&&!$this->checkword($message)){
				DB::insert('nimba_checkword_logs',array(
					'uid'=>$_G['uid'],
					'username'=>$_G['username'],
					'type'=>1,
					'dateline'=>TIMESTAMP,
				));
				showmessage($tips);
			}
		}elseif($_GET['action']=='reply'){
			$message = daddslashes(trim($_POST['message']));
			if(!$message){
				return '';
			}			
			if(!$this->checkword($message)){
				DB::insert('nimba_checkword_logs',array(
					'uid'=>$_G['uid'],
					'username'=>$_G['username'],
					'type'=>2,
					'dateline'=>TIMESTAMP,
				));				
				showmessage($tips);
			}			
		}
		return '';
	}

}

?>