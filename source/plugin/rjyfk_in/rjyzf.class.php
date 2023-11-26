<?php

if(!defined('IN_DISCUZ')) {  
    exit('Access Denied');  
}  
class plugin_rjyfk_in{
	
		function rjyfk_in() {
		global $_G;
		$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
		$lincolor = $rjyfk_in['linkcolor'];
		$rj_title = $rjyfk_in['rj_title'];
		if(trim($rj_title)!=""){
	         $url = 'home.php?mod=spacecp&ac=plugin&op=credit&id=rjyfk_in:in';
			return ' <a href="'.$url.'"><font color='.$lincolor.'>'.$rj_title.'</font></a>';
		} else {
			return '';
		}
	}

	function global_cpnav_extra1() {
		global $_G;
		$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
		$linktype = $rjyfk_in['linktype'];
		if ($linktype == '0') {
			return $this->rjyfk_in();
		} else {
			return '';
		}
	}

	function global_cpnav_extra2() {
		global $_G;
		$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
		$linktype = $rjyfk_in['linktype'];
		if ($linktype == '1') {
			return $this->rjyfk_in();
		} else {
			return '';
		}
	}

	function global_usernav_extra3() {
		global $_G;
		$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
		$linktype = $rjyfk_in['linktype'];
		if ($linktype == '2') {
			return $this->rjyfk_in();
		} else {
			return '';
		}
	}
	
	function global_nav_extra() {
		global $_G;
		$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
		$linktype = $rjyfk_in['linktype'];
		if ($linktype == '3') {
			return '<ul><li>'.$this->rjyfk_in().'</li></ul>';
		} else {
			return '';
		}
	}
}

class plugin_rjyfk_in_home extends plugin_rjyfk_in {
	
	function spacecp_credit_extra() {
		return '<ul><li>'.$this->rjyfk_in().'</li></ul>';
	}
}