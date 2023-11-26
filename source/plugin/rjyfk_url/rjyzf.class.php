<?php

if(!defined('IN_DISCUZ')) {  
    exit('Access Denied');  
}  
class plugin_rjyfk_url{
	
    function global_usernav_extra2(){
		global $_G;
		$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
		$rj_topname = $rjyfk_url['rj_topname'];
		$linkcolor =  $rjyfk_url['linkcolor'];
		if(trim($rj_topname)!=""){
			$url = 'plugin.php?id=rjyfk_url:url';
			return ' | <a href="'.$url.'"><font color='.$linkcolor.'>'.$rj_topname.'</font></a>';
		}
		else{
			return "";
		}
	}

}

class plugin_rjyfk_url_forum extends plugin_rjyfk_url{
	
	function index_nav_extra(){
			global $_G;
			$return = "";
			$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
			$up_gg = intval($rjyfk_url['up_gg']);
			$rj_notice = trim($rjyfk_url['rj_notice']);
			if($up_gg && $rj_notice && $rjyfk_url['switch_user']){
				$return = $this->groupdisplay($rj_notice);
			}
			return $return;
	}
		function groupdisplay(){
		global $_G;
		$return = "";
		$rjyfk_url = $_G['cache']['plugin']['rjyfk_url'];
		$rj_notice = explode("\r\n",$rjyfk_url['rj_notice']);
        $noteContent = str_replace("","",$rj_notice[0]);
		$rj_noticenums = $rjyfk_url['rj_noticenums']?intval($rjyfk_url['rj_noticenums']):10;
		$data = C::t('#rjyfk_url#rjy_log')->fetch_by_indexs($rj_noticenums,$rjyfk_url['switch_user']);
		$usergroup = C::t('common_usergroup')->fetch_all_by_type();
		$hot = "<img src='source/plugin/rjyfk_url/template/img/new.gif'>";
		foreach($data as $v){
			 if($v['listtype']==2){
		         $noteContentt .= "<li>".str_replace(array('{datetime}','{username}','{usergroup}'),array(dgmdate($v['paydate'],'u','9999'),$v['username'],dhtmlspecialchars($usergroup[$v['groupid']]['grouptitle'])),$noteContent).$hot.'</li>';
			 }
		}
		include template('rjyfk_url:message');
		return $return;
	}
	
}