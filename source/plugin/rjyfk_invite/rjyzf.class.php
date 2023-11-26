<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_rjyfk_invite {

	public function global_nav_extra() {
		if ($this->get_pos() == 3) {
			return '<ul><li><a href="plugin.php?id=rjyfk_invite:in" style="color:' . $this->_get_color() . ';"  >' . $this->get_title() . '</a></li></ul>';
		}
		return '';
	}

	public function global_cpnav_extra1() {
		if ($this->get_pos() == 0) {
			return '<a href="plugin.php?id=rjyfk_invite:in" style="color:' . $this->_get_color() . ';" >' . $this->get_title() . '</a>';
		}
		return '';
	}

	public function global_cpnav_extra2() {
		if ($this->get_pos() == 1) {
			return '<a href="plugin.php?id=rjyfk_invite:in" style="color:' . $this->_get_color() . ';" >' . $this->get_title() . '</a>';
		}
		return '';
	}

	public function get_pos() {
		global $_G;
		return $_G['cache']['plugin']['rjyfk_invite']['linktype'];
	}

	public function get_title() {
		global $_G;
		return $_G['cache']['plugin']['rjyfk_invite']['rj_title'];
	}

	public function _get_color() {
		global $_G;
		return $_G['cache']['plugin']['rjyfk_invite']['linkcolor'];
	}
}

class plugin_rjyfk_invite_member extends plugin_rjyfk_invite{

	public function register_top() {
		if ($this->get_pos() == 2) {
			return '<div class="rfm"><table><th><td><a href="plugin.php?id=rjyfk_invite:in" style="color:' . $this->_get_color() . ';font-weight:700;" >' . $this->get_title() . '</a></td><td></td></th></table></div>';
		}
		return '';
	}
}