<?php

/**
 *      $author: ณหมน $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_plugin_interface() {

	$data = C::t('#vipvideo#vipvideo_interface')->fetch_all_by_displayorder();
	savecache('vipvideo_interface', $data);

}

?>