<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: edit.class.php 29558 2017-04-21 23:45:14Z mpage $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_mpage_thread_edit {
	
	function plugin_mpage_thread_edit() {
		global $_G;

		$this->var = $_G['cache']['plugin']['mpage_thread_edit'];
	}
}

class plugin_mpage_thread_edit_forum extends plugin_mpage_thread_edit {

	function viewthread_title_extra_output() {
		global $_G, $postlist, $alloweditpost_status, $edittimelimit;

		$return = '';
		if($this->var['position'] == 1) {
			include template('mpage_thread_edit:edit');
		}

		return $return;
	}

	function viewthread_postheader_output() {
		global $_G, $postlist, $alloweditpost_status, $edittimelimit;

		$return = '';
		if($this->var['position'] == 2) {
			include template('mpage_thread_edit:edit');
		}

		return array($return);
	}
}

?>