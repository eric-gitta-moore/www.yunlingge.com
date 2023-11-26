<?php
echo push();
function push()
{
	global $_G;
	loadcache('plugin');
	if (empty($_GET['tid']))
	{
		return '';
	}
	else
	{
		$_G['tid'] = intval($_GET['tid']);
	}
	
	$vars=$_G['cache']['plugin']['baidusitemap'];
	$type=intval($vars['type']);
	$domain=trim($vars['domain']);
	$token=trim($vars['token']);
	if(!$domain||!$token) return 'let baidusitemap_info = "BS Error Setting";';//配置缺失
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
		return 'let baidusitemap_info = "BS Doing To Baidu";';			
	}elseif(isset($json['error'])&&$json['error']=='400'&&$json['message']=='over quota'){//当日推送已满
		@require_once libfile('function/cache');
		$cacheArray= "\$over='".date('Ymd')."';\n";
		writetocache('baidusitemap_over',$cacheArray);
	}else{//其他错误 
		return 'let baidusitemap_info = "BS Other Error : '.$result.'";';
	}
	return 'let baidusitemap_info = "BS empty";';
}