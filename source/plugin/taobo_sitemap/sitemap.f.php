<?php

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

function _get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show,$open,$num,$maxmaps,$page=''){

	$maps=array();

	//��ʼͳ�Ƹ�����ַ����

	if($show[0]==1) $threadnum=DB::result_first("SELECT count(*) FROM ".DB::table('forum_thread')." a inner join ".DB::table('forum_forum')." b on a.fid=b.fid where a.displayorder!=-2 and a.displayorder!=-1 $notin ORDER BY a.tid DESC");

	else $threadnum=0;

	if($show[1]==1) $forumnum=DB::result_first("SELECT count(*) FROM ".DB::table('forum_forum')." a where a.type='forum' and status=1 $notin ORDER BY a.fid DESC");

	else $forumnum=0;

	if($show[2]==1) $articlenum=DB::result_first("SELECT count(*) FROM ".DB::table('portal_article_title')." ORDER BY aid DESC");

	else $articlenum=0;

	$num=empty($num)? 10000:$num;//�־���ַ����

	$page=max(1,intval($page));

	$startnum=($page-1)*$num;

	$endnum=$startnum+$num;

	if($startnum<$threadnum&&$endnum<=$threadnum){//1���˾�ȫ����������ַ

		$maps=get_thread($web_root,$cycle,$notin,$startnum,$num);

	}

	if($startnum<$threadnum&&$endnum>$threadnum){//2��������Ѱ���ַȫ������˾�

		$map1=get_thread($web_root,$cycle,$notin,$startnum,$num);

		if($forumnum!=0) $map2=get_forum($web_root,$cycle,$notin,0,$forumnum);

		else $map2=array();

		$maps=array_merge($map1,$map2);

		if(count($maps)<$num&&$articlenum!=0){

			$map3=get_article($web_root,$cycle,$notin,0,($num-count($maps)));

			$maps=array_merge($maps,$map3);

		}

	}

	if($startnum>$threadnum&&$articlenum!=0){

		$startnum-=$threadnum;

		$endnum-=$threadnum;			

		$startnum=$startnum<0? 0:$startnum;

		$endnum=$endnum<0? $num:$endnum;

		$maps=get_article($web_root,$cycle,$notin,$startnum,$endnum);

	}

		

/*
 *Դ    ��   ��   y     m     g 6     .    c  o     m
 *������ҵ���/ģ��������� ����Դ     ��    ��
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

//��վ��ͼsitemap.xml

	$start="<?xml version=\"1.0\" encoding=\"$charset\"?>\n";

	$start.="<urlset\n";

	$start.="xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n";

	$start.="xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n";

	$start.="xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n";

	$start.="http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";

	$end="</urlset>\n";

 	if($open==0){//���־�

 		$sitemap='';

		foreach($maps as $k=>$map){

			$sitemap.="<url>\n";

			$sitemap.="<loc>".$map['link']."</loc>\n";

			$sitemap.="<priority>".$map['priority']."</priority>\n";

			$sitemap.="<lastmod>".$map['riqi']."</lastmod>\n";

			$sitemap.="<changefreq>".$map['cycle']."</changefreq>\n";

			$sitemap.="</url>\n";

		}

		$sitemap=$start.$sitemap.$end;

		$fp = fopen(DISCUZ_ROOT.'/'.$filename.'.xml','w');

		fwrite($fp,$sitemap);

		fclose($fp);

		return 1;

	}else{//�־�

		if(!empty($page)&&(count($maps)>0)&&($maxmaps==0||$maxmaps>=$page)){

			$sitemap='';

			$name=$page>1? $filename.'_'.$page:$filename;

 			foreach($maps as $k=>$map){

				$sitemap.="<url>\n";

				$sitemap.="<loc>".$map['link']."</loc>\n";

				$sitemap.="<priority>".$map['priority']."</priority>\n";

				$sitemap.="<lastmod>".$map['riqi']."</lastmod>\n";

				$sitemap.="<changefreq>".$map['cycle']."</changefreq>\n";

				$sitemap.="</url>\n";

			}

			$sitemap=$start.$sitemap.$end;

			$fp = fopen(DISCUZ_ROOT.'/'.$name.'.xml','w');

			fwrite($fp,$sitemap);

			fclose($fp);

			return 0;

		}else return $page-1;

	}

}



function get_thread($web_root,$cycle,$notin,$startnum,$num){

	global $_G;

	loadcache('plugin');			

	$rank = $_G['cache']['plugin']['taobo_sitemap']['rank1'];

	$rank=empty($rank)? 0.8:$rank;

	$base=array('weekly','always','hourly','daily','weekly','monthly','yearly','never');

	$cycle=$base[intval($_G['cache']['plugin']['taobo_sitemap']['change1'])];

	$isrewrite=isrewrite('forum_viewthread');	

	$subdomain=subdomain('forum');

	$maps=array();

	$querys = DB::query("SELECT a.tid,a.lastpost FROM ".DB::table('forum_thread')." a inner join ".DB::table('forum_forum')." b on a.fid=b.fid where a.displayorder!=-2 and a.displayorder!=-1 $notin ORDER BY a.tid DESC  LIMIT $startnum,$num");

	while($threadfid = DB::fetch($querys)){

		if(!empty($isrewrite)) $link='http://'.$subdomain.$web_root.str_replace(array('{tid}','{page}','{prevpage}'),array($threadfid['tid'],1,1),$isrewrite);//��̬����

		else $link='http://'.$subdomain.$web_root.'forum.php?mod=viewthread&amp;tid='.$threadfid['tid'];//��̬����,xml��&Ҫ����&amp;

		$riqi=date("Y-m-d",$threadfid['lastpost']);

		$map=array('link'=>$link,'priority'=>$rank,'riqi'=>$riqi,'cycle'=>$cycle);

		$maps[]=$map;

	}

	return $maps;

}



function get_forum($web_root,$cycle,$notin,$startnum,$num){

	global $_G;

	loadcache('plugin');			

	$rank = $_G['cache']['plugin']['taobo_sitemap']['rank2'];

	$rank=empty($rank)? 0.8:$rank;

	$base=array('weekly','always','hourly','daily','weekly','monthly','yearly','never');

	$cycle=$base[intval($_G['cache']['plugin']['taobo_sitemap']['change2'])];

	$isrewrite=isrewrite('forum_forumdisplay');

	$subdomain=subdomain('forum');

	$maps=array();

	$querys = DB::query("SELECT a.fid,a.domain FROM ".DB::table('forum_forum')." a where a.type='forum' and status=1 $notin ORDER BY a.fid DESC  LIMIT $startnum,$num");

	while($threadfid = DB::fetch($querys)){

		if($threadfid['domain']&&$_G['setting']['domain']['root']['forum']) $subdomain=$threadfid['domain'].'.'.$_G['setting']['domain']['root']['forum'];//�������

		if(!empty($_G['setting']['forumkeys'][$threadfid['fid']])) $threadfid['fid']= $_G['setting']['forumkeys'][$threadfid['fid']];//������

		if(!empty($isrewrite)) $link='http://'.$subdomain.$web_root.str_replace(array('{fid}','{page}'),array($threadfid['fid'],1),$isrewrite);//��̬����

		else $link='http://'.$subdomain.$web_root.'forum.php?mod=forumdisplay&amp;fid='.$threadfid['fid'];//��̬����,xml��&Ҫ����&amp;

		$riqi=date("Y-m-d",time());

		$map=array('link'=>$link,'priority'=>$rank,'riqi'=>$riqi,'cycle'=>$cycle);

		$maps[]=$map;

	}

	return $maps;

}



function get_article($web_root,$cycle,$notin,$startnum,$num){

	global $_G;

	loadcache('plugin');			

	$rank = $_G['cache']['plugin']['taobo_sitemap']['rank3'];

	$rank=empty($rank)? 0.8:$rank;

	$base=array('weekly','always','hourly','daily','weekly','monthly','yearly','never');

	$cycle=$base[intval($_G['cache']['plugin']['taobo_sitemap']['change3'])];	

	$isrewrite=isrewrite('portal_article');

	$subdomain=subdomain('portal');

	$maps=array();

	$querys = DB::query("SELECT aid,dateline FROM ".DB::table('portal_article_title')." ORDER BY aid DESC  LIMIT $startnum,$num");

	while($threadfid = DB::fetch($querys)){

		if(!empty($isrewrite)) $link='http://'.$subdomain.$web_root.str_replace(array('{id}','{page}'),array($threadfid['aid'],1),$isrewrite);//��̬����

		else $link='http://'.$subdomain.$web_root.'portal.php?mod=view&amp;aid='.$threadfid['aid'];//��̬����,xml��&Ҫ����&amp;

		$riqi=date("Y-m-d",$threadfid['dateline']);

		$map=array('link'=>$link,'priority'=>$rank,'riqi'=>$riqi,'cycle'=>$cycle);

		$maps[]=$map;

	}

	return $maps;

}



//��֯����

loadcache('plugin');

$var = $_G['cache']['plugin']['taobo_sitemap'];

$auto =$var['auto'];

$open =$var['open'];

$num=$var['num'];

$filename =str_replace('.xml','',trim($var['filename']));

$web_root=trim($var['web_root']);

$url=empty($var['mysite']) ? $_G['siteurl']:$var['mysite'];

$date=trim($var['cycle']);

if($var['charset']==2) $charset='utf-8';

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

$maxmaps=empty($var['maxmaps'])? 0:$var['maxmaps'];

//��¼����ʱ��

$last=time();

@require_once libfile('function/cache');

$cacheArray .= "\$last=".$last.";\n";

writetocache('taobo_sitemap_log', $cacheArray);	

//������ʾ

$page=max(0,intval($_GET['page']));

if($page==0){

	$head="�ֶ����ɵ�ͼ";

	$tip='��лʹ��[�ϲ�]��վ��ͼ������Ϊ�����ɣ����Ժ�...';

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

						<ul id="tipslis">'

							.$tip.

						'</ul>

					</td>

				</tr>

			</table>';

	$page++;

	echo "<script>window.location.href='admin.php?action=plugins&operation=config&do=".$pluginid."&identifier=taobo_sitemap&pmod=do&page=$page';</script>";

}else{

	$sum=_get_sitemap($filename,$web_root,$cycle,$charset,$notin,$show,$open,$num,$maxmaps,$page);//���ɵ�ͼ

	if($sum==0){

		$color=array('red','blue');

		$head="�ֶ����ɵ�ͼ";

		$tip='<br>����Ϊ������<font color="'.$color[$page%2].'">��'.$page.'��</font>��ͼ,���Ժ�...�������ϵͳ���Զ���ת...';

		$page++;

		$click="<a href=\"admin.php?action=plugins&operation=config&do=".$pluginid."&identifier=taobo_sitemap&pmod=do&page=$page\">��δ��ת����������һ��</a>";

		if(strtolower(CHARSET) == 'utf-8'){

			$tip=iconv('GB2312', 'UTF-8',$tip);//utf-8

			$head=iconv('GB2312', 'UTF-8',$head);//utf-8

			$click=iconv('GB2312', 'UTF-8',$click);//utf-8

		}

		echo '<table class="tb tb2 " id="tips">

				<tr>

					<th  class="partition">'.$head.'</th>

				</tr>

				<tr>

					<td class="tipsblock" s="1">

						<ul id="tipslis">'

							.$tip.$click.

						'</ul>

					</td>

				</tr>

			</table>';

		

		echo "<script>window.location.href='admin.php?action=plugins&operation=config&do=".$pluginid."&identifier=taobo_sitemap&pmod=do&page=$page';</script>";

	}else{

		//���ؽ��

		$xmls=='';

		for($i=1;$i<=$sum;$i++){

			if($i==1) $xmls.='<br>http://'.subdomain('portal').$web_root.$filename.'.xml';

			else $xmls.='<br>http://'.subdomain('portal').$web_root.$filename.'_'.$i.'.xml';

		}

		$tip='<br>��ʾ��������վ��ͼ���� ['.date("Y-m-d H:i:s",time()).'] ����,��ͼ��ַ��'.$xmls;

		$head="�ֶ����ɵ�ͼ";

		$how="<br><br><strong>ʹ�÷���</strong><br><li>��ֻ������վ��Ŀ¼�µ�robots.txt�����sitemap��ǣ�Sitemap: http://".subdomain('portal').$web_root.$filename.'.xml</li>';

		if(strtolower(CHARSET) == 'utf-8'){

			$tip=iconv('GB2312', 'UTF-8',$tip);//utf-8

			$head=iconv('GB2312', 'UTF-8',$head);//utf-8

			$how=iconv('GB2312', 'UTF-8',$how);//utf-8

		}

		echo '<table class="tb tb2 " id="tips">

				<tr>

					<th  class="partition">'.$head.'</th>

				</tr>

				<tr>

					<td class="tipsblock" s="1">

						<ul id="tipslis">'

							.$tip.$how.

						'</ul>

					</td>

				</tr>

			</table>';

		//��������

		$sum+=1;

		while(file_exists(DISCUZ_ROOT.'/'.$filename.'_'.$sum.'.xml')){

			unlink(DISCUZ_ROOT.'/'.$filename.'_'.$sum.'.xml');

			$sum+=1;

		}

	}

}

?>