<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class mobileplugin_yunling_comiis {
	
	public function common()
	{
		global $_G;
		$_G['plugind'] = './source/plugin/';
		$_G['siteurls'] = '_mmdada'. '_mobile.tpls.php';
		$_G['templated'] = '94_touch_';
	}

}

?>