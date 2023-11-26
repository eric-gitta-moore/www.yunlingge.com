<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_zqlj_changedownloads {
	function __construct(){
		global $_G;
		loadcache('plugin');		
		$vars = $_G['cache']['plugin']['zqlj_changedownloads'];
		$this->open=intval($vars['open']);
		$this->uids=explode(',',trim($vars['uids']));
		$this->nav=intval($vars['nav']);
		$this->name=trim($vars['name']);
		$this->color=trim($vars['color']);	
		if(!$_G['uid']||!in_array($_G['uid'],$this->uids)) $this->open=0;
	}

	function global_cpnav_extra1() {
		if($this->nav==2&&$this->open) return '<a href="plugin.php?id=zqlj_changedownloads"><font color="'.$this->color.'">'.$this->name.'</font></a>';
		else return '';
	}

	function global_nav_extra(){
		if($this->nav==3&&$this->open) return '<ul><li><a href="plugin.php?id=zqlj_changedownloads"><font color="'.$this->color.'">'.$this->name.'</font></a></ul></li>';	
		else return '';
	}
	
	function global_footerlink(){
		if($this->nav==4&&$this->open) return '<span class="pipe">|</span><a href="plugin.php?id=zqlj_changedownloads"><font color="'.$this->color.'">'.$this->name.'</font></a>';	
		else return '';
	}
	
	function global_usernav_extra2(){
		if($this->nav==5&&$this->open) return '<span class="pipe">|</span><a href="plugin.php?id=zqlj_changedownloads"><font color="'.$this->color.'">'.$this->name.'</font></a>';	
		else return '';
	}
}

class plugin_zqlj_changedownloads_forum extends plugin_zqlj_changedownloads {
	function viewthread_title_extra(){
		if($this->open){
			return '<a href="plugin.php?id=zqlj_changedownloads&tid='.$_G['tid'].'&resulthash='.FORMHASH.'" target="_blank"><font color="'.$this->color.'">'.$this->name.'</font></a>';
		}
		return '';		
	}
}

?>