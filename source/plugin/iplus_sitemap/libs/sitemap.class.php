<?php

/*
 *源    码    哥  y     m     g  6     .   c  o    m
 *更多商业插件/模版免费下载 就在源  码   哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class sitemap{
	public $corexml='';
	public $type;
	public $num=0;//计数
	public $all_num=0;//总体计数
	public $single_num=2000;//单卷大小
	public $xml_num=1;//当前卷别
	public $siteurl;
	public $charset='UTF-8';
	public $base_name='sitemap';
	public $basefreq=array('weekly','always','hourly','daily','weekly','monthly','yearly','never');
	protected $temp="<url>\n<loc>%s</loc>\n<lastmod>%s</lastmod>\n<changefreq>%s</changefreq>\n<priority>%s</priority>\n</url>";
	public function __construct($type,$params){
		$this->siteurl=$params['siteurl'];
		$this->dir='';
		if(substr_count($_SERVER["PHP_SELF"],'/')>1){
			$dir=explode('/',$_SERVER["PHP_SELF"]);
			unset($dir[count($dir)-1]);
			$this->dir=implode('/',$dir).'/';
		}
		$this->dir=empty($this->dir)? '/':$this->dir;
		$this->single_num=empty($params['single_num'])? $this->single_num:intval($params['single_num']);
		$this->priority=$params['priority'];
		$this->urls=$params['urls'];
		$this->forums=$params['forums'];
		if(in_array(1,$this->urls)) $this->createIndex();
		if(in_array(2,$this->urls)&&count($this->forums) || dempty($this->forums)) $this->createFroum();
		if(in_array(3,$this->urls)&&count($this->forums) || dempty($this->forums)) $this->createThread();
		if(in_array(4,$this->urls)) $this->createArticle();
		$this->onexml(true);
		if($this->xml_num>=3){
			$this->xmlIndex();
		}
		$this->xmlclear();
	}
	
	function createIndex(){
		$this->corexml.=empty($this->corexml)? sprintf($this->temp,$this->siteurl,date('Y-m-d',time()),$this->basefreq[1],$this->priority['index']):"\n".sprintf($this->temp,$this->siteurl,date('Y-m-d',time()),$this->basefreq[1],$this->priority['index']);
		$this->num++;
		$this->all_num++;
		$this->onexml();
	}
	
	function createFroum(){
		global $_G;
		if (!dempty($this->forums))
		{
			$data=DB::fetch_all("select fid,domain from ".DB::table('forum_forum')." where fid in(".implode(',',$this->forums).")");
		}
		else
		{
			$data=DB::fetch_all("select fid,domain from ".DB::table('forum_forum')." where 1=1");
		}
		$isrewrite=$this->urlRewrite('forum_forumdisplay');
		$subdomain=$this->appSubdomain('forum');		
		foreach($data as $k=>$v){
			if($v['domain']&&$_G['setting']['domain']['root']['forum']) $subdomain=$v['domain'].'.'.$_G['setting']['domain']['root']['forum'];
			if(!empty($_G['setting']['forumkeys'][$v['fid']])) $v['fid']= $_G['setting']['forumkeys'][$v['fid']];//板块别名				
			if($isrewrite){
				$url=str_replace(array('{fid}','{page}'),array($v['fid'],1),$isrewrite);
			}else{
				$url='forum.php?mod=forumdisplay&amp;fid='.$v['fid'];
			}
			if($subdomain) $url='http://'.$subdomain.$this->dir.$url;
			else $url=$this->siteurl.$url;
			$this->corexml.=empty($this->corexml)? sprintf($this->temp,$url,date('Y-m-d',time()),$this->basefreq[1],$this->priority['forum']):"\n".sprintf($this->temp,$url,date('Y-m-d',time()),$this->basefreq[1],$this->priority['forum']);
			$this->num++;
			$this->all_num++;
			$this->onexml();
		}
	}
	
	function createThread(){
		if (!dempty($this->forums))
		{
			$data=DB::fetch_all("select tid,lastpost from ".DB::table('forum_thread')." where fid in(".implode(',',$this->forums).") and displayorder>=0 order by tid desc ");//limit 0,20000
		}
		else
		{
			$data=DB::fetch_all("select tid,lastpost from ".DB::table('forum_thread')." where displayorder>=0 order by tid desc ");//limit 0,20000
		}
		// $data=DB::fetch_all("select tid,lastpost from ".DB::table('forum_thread')." where fid in(".implode(',',$this->forums).") and displayorder>=0 order by tid desc limit 0,20000");
		$isrewrite=$this->urlRewrite('forum_viewthread');
		$subdomain=$this->appSubdomain('forum');		
		foreach($data as $k=>$v){
			if($isrewrite){
				$url=str_replace(array('{tid}','{page}','{prevpage}'),array($v['tid'],1,1),$isrewrite);
			}else{
				$url='forum.php?mod=viewthread&amp;tid='.$v['tid'];
			}
			if($subdomain) $url='http://'.$subdomain.$this->dir.$url;
			else $url=$this->siteurl.$url;			
			$this->corexml.=empty($this->corexml)? sprintf($this->temp,$url,date('Y-m-d',$v['lastpost']),$this->basefreq[1],$this->priority['thread']):"\n".sprintf($this->temp,$url,date('Y-m-d',$v['lastpost']),$this->basefreq[1],$this->priority['thread']);
			$this->num++;
			$this->all_num++;
			$this->onexml();
		}		
		
	}	
	
	function createArticle(){
		$data=DB::fetch_all("select aid,dateline from ".DB::table('portal_article_title')." where status=0 order by aid desc limit 0,20000");
		$isrewrite=$this->urlRewrite('portal_article');
		$subdomain=$this->appSubdomain('portal');		
		foreach($data as $k=>$v){
			if($isrewrite){
				$url=str_replace(array('{id}','{page}'),array($v['aid'],1),$isrewrite);
			}else{
				$url='portal.php?mod=view&amp;aid='.$v['aid'];
			}
			if($subdomain) $url='http://'.$subdomain.$this->dir.$url;
			else $url=$this->siteurl.$url;		
			$this->corexml.=empty($this->corexml)? sprintf($this->temp,$url,date('Y-m-d',$v['dateline']),$this->basefreq[1],$this->priority['article']):"\n".sprintf($this->temp,$url,date('Y-m-d',$v['dateline']),$this->basefreq[1],$this->priority['article']);
			$this->num++;
			$this->all_num++;
			$this->onexml();			
		}
	}
	
	function createBlog(){
	
	}
	
	function xmlIndex(){
		$index='';
		$head="<?xml version=\"1.0\"  encoding=\"UTF-8\"?>\r\n<sitemapindex>\r\n";
		$temp="<sitemap>\n<loc>%s</loc>\n<lastmod>%s</lastmod>\n</sitemap>\n";
		$end="</sitemapindex>";
		for($i=1;$i<$this->xml_num;$i++){
			$index.=empty($index)? sprintf($temp,$this->siteurl.'sitemap'.$i.'.xml','1',date('Y-m-d',time())):"\n".sprintf($temp,$this->siteurl.'sitemap'.$i.'.xml','1',date('Y-m-d',time()));
		}
		$index=$head.$index.$end;
		$fp = fopen(DISCUZ_ROOT.'/sitemapindex.xml','w');
		fwrite($fp,$index);
		fclose($fp);
	}
	
	function onexml($last=false){
		if($last||$this->num>=$this->single_num){
			if($last&&$this->xml_num==1) 
			$xmlname='sitemapindex.xml';
			// $xmlname='baidu_sitemap_index.xml';
			// else $xmlname=$this->base_name.'_'.$this->xml_num.'.xml';
			else 
			$xmlname=$this->base_name.$this->xml_num.'.xml';
			
			$this->creatxml($xmlname);
			$this->xml_num++;
			$this->num=0;
			$this->corexml='';
		}
	}
	
	function creatxml($xmlname=''){
		$xmlname=empty($xmlname)? $this->base_name.'.xml':$xmlname;
		$start="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$start.="<urlset\n";
		$start.="xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n";
		$start.="xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n";
		$start.="xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n";
		$start.="http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
		$end="\n</urlset>\n";	
		$sitemapxml=$start.$this->corexml.$end;
		$fp = fopen(DISCUZ_ROOT.'/'.$xmlname,'w');
		fwrite($fp,$sitemapxml);
		fclose($fp);
	}
	
	function xmlclear(){
		$sum=$this->xml_num;
		while(file_exists(DISCUZ_ROOT.'/sitemap'.$sum.'.xml')){
			unlink(DISCUZ_ROOT.'/sitemap'.$sum.'.xml');
			$sum++;
		}		
	}
	
	function urlRewrite($item){
		global $_G;
		$rewritestatus = $_G['setting']['rewritestatus'];
		$rewriterule = $_G['setting']['rewriterule'];
		if(in_array($item,$rewritestatus)){
			return $rewriterule[$item];
		}else{
			return false;
		}	
	}

	function appSubdomain($item){
		global $_G;
		$domain = $_G['setting']['domain'];
		if($domain['app'][$item]){
			$return = $domain['app'][$item];
		}else{
			$return = $domain['app']['default'];
		}
		if(empty($return)){
			$return =false;
		}
		return $return;	
	}
}
?>