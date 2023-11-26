<?php

/*
 *源  码    哥   y   m g  6  .   c  o     m
 *更多商业插件/模版免费下载 就在源   码 哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

include 'sitemap.fun.php';

if(file_exists(DISCUZ_ROOT.'source/plugin/taobo_sitemap/sitemap.f.php')){

	//商业版

	include 'sitemap.f.php';	

}else{

	//开始组织参数

	loadcache('plugin');

	$var = $_G['cache']['plugin']['taobo_sitemap'];

    $auto =$var['auto'];

	$filename =str_replace('.xml','',trim($var['filename']));

	$web_root=trim($var['web_root']);

	$url=empty($var['mysite']) ? $_G['siteurl']:$var['mysite'];

	$date=trim($var['cycle']);

	$num=$var['num'];

	$open =$var['open'];

	$charset =$var['charset'];

	if($charset==2) $charset='utf-8';

	else $charset='gbk';//默认使用gbk

	$ban=unserialize($var['ban']);

	if(count($ban)==0) $notin='';

	else $notin='and a.fid not in('.dimplode($ban).')';

	$show=array(0,0,0);

	$urls=unserialize($var['urls']);

	if(in_array('1',$urls)) $show[0]=1;	

	if(in_array('2',$urls)) $show[1]=1;	

	if(in_array('3',$urls)) $show[2]=1;	

	$cycle='weekly';

	//记录更新时间

	$last=time();

	@require_once libfile('function/cache');

	$cacheArray .= "\$last=".$last.";\n";

	writetocache('taobo_sitemap_log', $cacheArray);	

    //更新提示

    $urlsum=get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show,$open,$num);//生成地图 $open分卷参数无效 

	$filename.='.xml';

	$item="<strong>您本次生成的地图中包括</strong><br>帖子：".$urlsum[0]."<br>版块：".$urlsum[1]."<br>文章：".$urlsum[2]."</li>";

	$how="<strong>使用方法</strong><br>1、在百度站长工具中提交Sitemap<a href=\"http://zhanzhang.baidu.com/dashboard/index\" target=\"_blank\">http://zhanzhang.baidu.com/dashboard/index</a>";

	$how.="<br>2、在robots.txt中添加sitemap标记：Sitemap: http://".subdomain('portal').$web_root.$filename;

	//返回结果

	$tip='<li><strong>生成提示：</strong>您的网站地图已于 ['.date("Y-m-d H:i:s",time()).'] 更新,地图地址：<br>http://'.subdomain('portal').$web_root.$filename.'</li><li>'.$item.'</li><li>'.$how.'</li>';

	$head="手动生成地图";

	if(strtolower(CHARSET) == 'utf-8'){

		$tip=iconv('GB2312', 'UTF-8',$tip);//utf-8

		$head=iconv('GB2312', 'UTF-8',$head);//utf-8

	}

	echo '<table class="tb tb2 " id="tips">

			<tr>

				<th  class="partition">'.$head.'</th>

			</tr>

			<tr>

				<td class="tipsblock" s="1">

					<ul id="tipslis">';	

						echo $tip;

				echo '</ul>

				</td>

			</tr>

		</table>';

}



?>