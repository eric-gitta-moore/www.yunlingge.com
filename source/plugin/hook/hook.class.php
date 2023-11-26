<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ')) {
   exit('2020012206a1DkbhjwwA');
}

class plugin_hook {
		function common($param) {
		    global $_G;
		    $splugin_setting = $_G['cache']['plugin']['hook'];
		    if($splugin_setting['coerce'] && (!$splugin_setting['onlyadmin'] || $_G['adminid'] == 1)){
		    		$hookcheck = DISCUZ_ROOT.'./data/template/hookcheck.php';
				    if($_G['config']['plugindeveloper'] != 2 && !file_exists($hookcheck)){
				    		$tpl = dir(DISCUZ_ROOT.'./data/template');
								while($entry = $tpl->read()) {
									if(preg_match("/\.tpl\.php$/", $entry)) {
										@unlink(DISCUZ_ROOT.'./data/template/'.$entry);
									}
								}
								$tpl->close();
								$fp = fopen($hookcheck, "w+");
								fclose($fp);
				    }
				    $_G['config']['plugindeveloper'] = 2;
			  }
		    $_G['setting']['seohead'] .= '<script type="text/javascript"> document.createElement("hook"); </script><style>hook { display: none; }</style>';
		}
		
		function _showhook($hook){
				global $_G;
				$return = '';
				$splugin_setting = $_G['cache']['plugin']['hook'];
				if($splugin_setting['hook'] == $hook && (!$splugin_setting['onlyadmin'] || $_G['adminid'] == 1)){
						include template('hook:hook');
				}
				return $return;
		}
		
		function global_cpnav_extra1(){
				return $this->_showhook(1);
		}
		
		function global_cpnav_extra2(){
				return $this->_showhook(2);
		}
		
		function global_cpnav_top(){
				return $this->_showhook(3);
		}
		
		function global_usernav_extra1(){
				return $this->_showhook(4);
		}
		
		function global_footerlink(){
				return $this->_showhook(5);
		}
}

?>