<?php
/*
 * 主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_baidusitemap {

}
class plugin_baidusitemap_forum extends plugin_baidusitemap {
	
	function viewthread_bottom()
	{
		// global $_G;
		// return '<script async="async" src="/plugin.php?id=baidusitemap:push&tid=' . $_G['thread']['tid'] . '" type="text/javascript"></script>';
		
		global $_G;
		if($_G['thread']['displayorder']<0) return '<!--BS displayorder Error -->';//displayorder<0 推送
		if(!isset($_G['thread']['tobaidu'])) return '<!--BS Table Error -->';//forum_threads中字段缺失
		if($_G['thread']['tobaidu']) return '<!--BS To Baidu OK @'.date('Y-m-d H:i:s',$_G['thread']['todate']).'-->';//已经成功推送
		if(!function_exists('curl_init')||!function_exists('curl_setopt_array')||!function_exists('curl_exec')) return '<!--BS No CURL-->';//环境不支持
		$over='';
		if(DISCUZ_VERSION=='X2'){
			$filepath=DISCUZ_ROOT.'./data/cache/cache_baidusitemap_over.php';
		}else{
			$filepath=DISCUZ_ROOT.'./data/sysdata/cache_baidusitemap_over.php';
		}
		if(file_exists($filepath)){
			@require_once $filepath;
		}
		if($over==date('Ymd')) return '<!--BS Over Quota -->';//当日推送已满
		
		return '<script async="async" src="/plugin.php?id=baidusitemap:push&tid=' . $_G['thread']['tid'] . '" type="text/javascript"></script>';
	}
	
	function doIt()
	{
		// return '<!--BS empty -->';
		// global $_G;
		// if($_G['thread']['displayorder']<0) return '<!--BS displayorder Error -->';//displayorder<0 推送
		// if(!isset($_G['thread']['tobaidu'])) return '<!--BS Table Error -->';//forum_threads中字段缺失
		// if($_G['thread']['tobaidu']) return '<!--BS To Baidu OK @'.date('Y-m-d H:i:s',$_G['thread']['todate']).'-->';//已经成功推送
		// if(!function_exists('curl_init')||!function_exists('curl_setopt_array')||!function_exists('curl_exec')) return '<!--BS No CURL-->';//环境不支持
		// $over='';
		// if(DISCUZ_VERSION=='X2'){
			// $filepath=DISCUZ_ROOT.'./data/cache/cache_baidusitemap_over.php';
		// }else{
			// $filepath=DISCUZ_ROOT.'./data/sysdata/cache_baidusitemap_over.php';
		// }
		// if(file_exists($filepath)){
			// @require_once $filepath;
		// }
		// if($over==date('Ymd')) return '<!--BS Over Quota -->';//当日推送已满
		
		loadcache('plugin');
		$vars=$_G['cache']['plugin']['baidusitemap'];
		$type=intval($vars['type']);
		$domain=trim($vars['domain']);
		$token=trim($vars['token']);
		if(!$domain||!$token) return '<!--BS Error Setting-->';//配置缺失
		if(in_array('forum_viewthread',$_G['setting']['rewritestatus'])){
			$url=$_G['siteurl'].str_replace(array('{tid}','{page}','{prevpage}'),array($_G['tid'],1,1),$_G['setting']['rewriterule']['forum_viewthread']);
		}else{
			$url=$_G['siteurl'].'forum.php?mod=viewthread&tid='.$_G['tid'];
		}
		if(!$type) $api = 'http://data.zz.baidu.com/urls?site='.$domain.'&token='.$token;
		else $api = 'http://data.zz.baidu.com/urls?site='.$domain.'&token='.$token.'&type=original';
		$ch = curl_init();
		$options =  array(
			CURLOPT_URL => $api,
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $url,
			CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		$json=json_decode($result,true);
		if(isset($json['success'])&&$json['success']==1){
			DB::update('forum_thread',array('tobaidu'=>1,'todate'=>TIMESTAMP),array('tid'=>$_G['tid']));
			C::t('forum_thread')->clear_cache(array($_G['tid']));
			if(isset($json['remain'])){
				$max=0;
				if(DISCUZ_VERSION=='X2'){
					$filepath=DISCUZ_ROOT.'./data/cache/cache_baidusitemap_remain.php';
				}else{
					$filepath=DISCUZ_ROOT.'./data/sysdata/cache_baidusitemap_remain.php';
				}
				if(file_exists($filepath)){
					@require_once $filepath;
				}
				$remain=intval($json['remain']);
				$max=max($remain+1,$max);
				@require_once libfile('function/cache');
				$cacheArray = "\$remain=".$remain.";\n";
				$cacheArray.= "\$max=".$max.";\n";
				writetocache('baidusitemap_remain',$cacheArray);//记录每日运行推送最大数，可近日剩余数
			}
			return '<!--BS Doing To Baidu -->';			
		}elseif(isset($json['error'])&&$json['error']=='400'&&$json['message']=='over quota'){//当日推送已满
			@require_once libfile('function/cache');
			$cacheArray= "\$over='".date('Ymd')."';\n";
			writetocache('baidusitemap_over',$cacheArray);
		}else{//其他错误 
			return '<!--BS Other Error : '.$result.' -->';
		}
		return '<!--BS empty -->';
	}
}
?>