<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class mobileplugin_comiis_app_portal{
	function common(){
		global $_G;
		if(($_G['basescript'] == 'forum' && CURMODULE == 'guide' && $_GET['view'] == 'hot') || ($_G['basescript'] == 'portal' && CURMODULE == 'index')){
			$comiis_data = DB::fetch_first("SELECT id, comiisheader FROM %t WHERE `show`='1' AND `default`='1'", array('comiis_app_portal_page'));
			if($comiis_data['id']){
				dheader('Location: '. $_G['siteurl'] .($comiis_data['comiisheader'] == '1' ? 'page-'.$comiis_data['id'].'.html' : 'plugin.php?id=comiis_app_portal&pid='.$comiis_data['id']));
			}
		}
	}
}



