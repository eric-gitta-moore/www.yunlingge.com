<?php

/*
 *Դ  ��    ��   y   m g  6  .   c  o     m
 *������ҵ���/ģ��������� ����Դ   �� ��
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

include 'sitemap.fun.php';

if(file_exists(DISCUZ_ROOT.'source/plugin/taobo_sitemap/sitemap.f.php')){

	//��ҵ��

	include 'sitemap.f.php';	

}else{

	//��ʼ��֯����

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

	else $charset='gbk';//Ĭ��ʹ��gbk

	$ban=unserialize($var['ban']);

	if(count($ban)==0) $notin='';

	else $notin='and a.fid not in('.dimplode($ban).')';

	$show=array(0,0,0);

	$urls=unserialize($var['urls']);

	if(in_array('1',$urls)) $show[0]=1;	

	if(in_array('2',$urls)) $show[1]=1;	

	if(in_array('3',$urls)) $show[2]=1;	

	$cycle='weekly';

	//��¼����ʱ��

	$last=time();

	@require_once libfile('function/cache');

	$cacheArray .= "\$last=".$last.";\n";

	writetocache('taobo_sitemap_log', $cacheArray);	

    //������ʾ

    $urlsum=get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show,$open,$num);//���ɵ�ͼ $open�־������Ч 

	$filename.='.xml';

	$item="<strong>���������ɵĵ�ͼ�а���</strong><br>���ӣ�".$urlsum[0]."<br>��飺".$urlsum[1]."<br>���£�".$urlsum[2]."</li>";

	$how="<strong>ʹ�÷���</strong><br>1���ڰٶ�վ���������ύSitemap<a href=\"http://zhanzhang.baidu.com/dashboard/index\" target=\"_blank\">http://zhanzhang.baidu.com/dashboard/index</a>";

	$how.="<br>2����robots.txt�����sitemap��ǣ�Sitemap: http://".subdomain('portal').$web_root.$filename;

	//���ؽ��

	$tip='<li><strong>������ʾ��</strong>������վ��ͼ���� ['.date("Y-m-d H:i:s",time()).'] ����,��ͼ��ַ��<br>http://'.subdomain('portal').$web_root.$filename.'</li><li>'.$item.'</li><li>'.$how.'</li>';

	$head="�ֶ����ɵ�ͼ";

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