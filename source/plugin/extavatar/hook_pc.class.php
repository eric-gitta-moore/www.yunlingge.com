<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_extavatar
{
	public function avatar($param) {
		require_once dirname(__FILE__).'/class/env.class.php';
		C::m('#extavatar#extavatar')->avatar($param);
	}
}