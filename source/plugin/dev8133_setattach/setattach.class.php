<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_dev8133_setattach {
	
	public function common() {
		
		global $_G;
		
		$rulecfg = getRule(explode("\r\n",$_G['cache']['plugin']['dev8133_setattach']['setforumjftype']));
		$setting  = &$_G['setting'];
		foreach($rulecfg as $rv){
			if($_GET['fid'] == $rv[0] || $_G['fid'] == $rv[0]){
				$setting['creditstransextra'][1] = $rv[1];
			}
		}
	}
}

function getRule($rulecfg){
		$returnvalue = array();
		foreach($rulecfg as $value){
			$tmpArray = explode("|",$value);
			array_push($returnvalue,$tmpArray);
		}
		return $returnvalue;
}

class plugin_dev8133_setattach_forum extends plugin_dev8133_setattach {
   

}
?>