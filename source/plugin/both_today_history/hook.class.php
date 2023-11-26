<?php
/**
 *	[历史上的今天最热帖(both_today_history.{modulename})] (C)2019-2099 Powered by 博士设计.
 *	Version: v1.0.0
 *	Date: 2019-11-22 11:26
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_both_today_history {
	function  __construct() {
		global $_G;
	    loadcache('plugin');
		$this->vars = $_G['cache']['plugin']['both_today_history'];
		$this->isopen=intval($this->vars['isopen']);
		$this->color=$this->vars['color'];
		$this->size=$this->vars['size'];
		$this->align=$this->vars['align'];
		$this->bgcolor=$this->vars['bgcolor'];
	}

	public function global_header() {
		loadcache('plugin');
		global $_G;
		if(!$this->isopen) return '';
		$val=DB::fetch_first("select * from ".DB::table('both_today_history'));
		$val['dateline'] = dgmdate($val['dateline'],'d');
		$color=$this->color;
		$bgcolor=$this->bgcolor;
		$size=$this->size;
		$align=$this->align;
		include template('both_today_history:heat');
		
	    return $return;	
	}

}

?>