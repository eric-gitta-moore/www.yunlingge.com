<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class plugin_study_diydown {
	function common(){
		if(CURSCRIPT == 'forum' && CURMODULE == 'attachment'){
			global $_G;
			$splugin_setting = $_G['cache']['plugin']['study_diydown'];
			$study_gids = (array)unserialize($splugin_setting['study_gids']);
			if(in_array($_G['groupid'],$study_gids)){
				$study_fids = (array)unserialize($splugin_setting['study_fids']);
				@include_once DISCUZ_ROOT.'/source/plugin/study_diydown/forum_attachment.php';
				exit();
			}
		}
	}
}

?>