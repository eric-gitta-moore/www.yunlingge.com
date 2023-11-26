<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
//This is NOT a freeware, use is subject to license terms
//From www.1314study.com
//应用售后问题：http://www.discuz.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('http://www.ymg6.com/');
}
function study_subtitle($menus, $type, $mid = ''){
if(is_array($menus)) {
if(!$mid){
				$actives[$type] = ' class="active"';
				showtableheader('','study_tb');
				$s .='<div class="study_tab study_tab_min">';
				foreach($menus as $k => $menu){
						$s .= '<a href="'.ADMINSCRIPT.'?action='.STUDY_MANAGE_URL.'&type1314='.$menu[1].'" '.$actives[$menu[1]].'><i></i><ins></ins>'.$menu[0].'</a>';
				}                                           
				$s .= '</div>';
				showtablerow('', array(''), array($s));
				showtablefooter();
		}else{
				$actives[$mid] = ' class="current" ';
				showtableheader('', 'study_tb');
				$s = '<div class="study_tab_mid"><ul class="tab1">';
				foreach($menus as $k => $menu){
						$s .= '
						<li '.$actives[$menu[1]].'>
						<a href="'.ADMINSCRIPT.'?action='.STUDY_MANAGE_URL.'&type1314='.$type.'&mid='.$menu[1].'">
						<span>'.$menu[0].'</span>
						</a>
						</li>';
				}
				$s .= '</ul></div>';
				showtitle($s);
				showtablefooter();
		}
	}
}

function s_updatecache($item){
		$file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_' . $item . '_data.php'; 
		clearstatcache();
		if(file_exists($file)) {
		  $result = @unlink ($file);
		  if ($result == false) {
		      exit('Can not update to cache files, please check directory ./data/ and ./data/sysdata/ .');
		  }
		}
}

function s_writetocache($script, $cachedata, $prefix = 'cache_') {
	global $_G;
	$dir = DISCUZ_ROOT.'./data/sysdata/';
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if($fp = @fopen("$dir$prefix$script.php", 'wb')) {
		fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
		fclose($fp);
	} else {
		exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ .');
	}
}

