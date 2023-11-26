<?php

/*
 *源  码  哥   y     m     g   6  .     c o    m
 *更多商业插件/模版免费下载 就在源     码     哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_iplus_sitemap {
	function global_header(){
		global $_G;
		@require_once DISCUZ_ROOT.'./source/discuz_version.php';
		if(strtolower(DISCUZ_VERSION)=='x2.5'&&$this->getOpRight()){//仅X2.5
			include_once DISCUZ_ROOT.'/source/plugin/iplus_sitemap/libs/sitemap.class.php';
			loadcache('plugin');
			$var=$_G['cache']['plugin']['iplus_sitemap'];
			$var['auto']=intval($var['auto']);
			if($var['auto']){
				$var['urls']=unserialize($var['urls']);
				$var['forums']=unserialize($var['forums']);
				$priority=array(
					'index'=>$var['freq_index'],
					'forum'=>$var['freq_forum'],
					'thread'=>$var['freq_thread'],
					'article'=>$var['freq_article'],
				);
				$single_num=intval($var['single_num']);
				$sitemap=new sitemap(1,array('siteurl'=>$_G['siteurl'],'urls'=>$var['urls'],'forums'=>$var['forums'],'single_num'=>$single_num,'priority'=>$priority));
			}
			$this->getOpRight(time());
		}
	}
	
	function getOpRight($dateline=''){
		if(empty($dateline)){
			$filepath=DISCUZ_ROOT.'./data/sysdata/cache_iplus_sitemap.php';
			if(file_exists($filepath)){
				@include_once $filepath;
				if((time()-intval($dateline))>=3600) return true;//一小时
				else return false;
			}else{
				return true;
			}
		}else{
			@require_once libfile('function/cache');
			$cacheArray .= "\$dateline=".$dateline.";\n";
			writetocache('iplus_sitemap', $cacheArray);	
		}
	}	
}

?>