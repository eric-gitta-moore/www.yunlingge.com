<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

loadcache('plugin');
class plugin_dang {
	
	function global_header() {
		global $_G;
                $setting = $_G['cache']['plugin']['dang'];
                if($setting['open']){
                	$setting['open_page'] = unserialize($setting['open_page']);
                	
                	$script = [
			            'portal,index' => 2,//门户首页
			            'forum,index' => 3,//论坛首页
			            'forum,forumdisplay' => 4,//论坛板块
			            'forum,viewthread' => 5,//论坛贴子
			        ];
			        if (in_array($script[CURSCRIPT . ',' . CURMODULE],$setting['open_page'])
			            || in_array(1,$setting['open_page'])
			            || (!array_key_exists(CURSCRIPT . ',' . CURMODULE,$script)  && in_array(6,$setting['open_page']))
			        )
			        {
			            
		
		                $height = $setting['height'];
		                $about = $setting['about'];
		                $color = $setting['color'];
		                $Typeface = $setting['Typeface'];
		                $radius = $setting['radius'];
		                $url = $setting['url'];
	                
	                
						include template('dang:index');
						return $return;	
			        }
                	
				} else {
					return;
				}
	}
	
}
?>