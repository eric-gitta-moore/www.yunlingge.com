<?php 
/*
 *	[jnpar] (C)2018-2023 jnpar����ſ��ҫ��Ʒ.
 *	�ⲻ��һ����ѵĳ�����QQ��94526868�ṩ����֧�֣����趨�ƻ��߸��Ի��޸Ĳ������ӭ��������ϵ��
 *  ��������վwww.jnpar.com �����ƹ㣬������ʻ��١�
 *	$_G['basescript'] = ģ������
 *	CURMODULE = Ϊģ���Զ��峣��
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

function getmd5($var1,$var2,$var3){//��ȡƴ���ַ�����md5ֵ������Ȩ����֤
	$arr=array($var1,$var2,$var3);
	return md5(implode('', $arr));
}
include_once 'identity.php';
include_once 'lang.'.currentlang().'.php';

if(getmd5(SN,SITEID,"jnparsn") != SITEKEY) {
	echo '<hr>';
}

global $_G;
$siteurl=$_G['siteurl'];//��ʼ������

$fidinfos=DB::fetch_all("SELECT fid,name FROM %t WHERE status=%d and type=%s order by fid asc",array('forum_forum',1,'forum'));//��ȡ�����õİ��fid�Ͱ������

//�������õ�fid���ϳ�����
$fids=array();
foreach($fidinfos as $fidinfo){
	$fids[]=$fidinfo['fid'];
}

$logoinfos=DB::fetch_all("SELECT fid,icon,extra FROM %t WHERE ".DB::field('fid',$fids).' order by fid asc',array('forum_forumfield'));//����fid���飬��ȡ��Ӧ�İ��ͼ���extra��Ϣ

$imgurl="data/attachment/common/";//ϵͳĬ�ϵ�ͼ����·������֤�ӹܺ��ܹ�������ʾԭ�еİ��ͼ��
$imgdir=DISCUZ_ROOT . "./data/attachment/common/";//ԭ���ͼ��ľ���·��

$logoimgs=$logo_widths=array();//����ͼ������Ϳ������


foreach($logoinfos as $key=>$logoinfo){
		//ͼ�����鸳ֵ
		if(!$logoinfo['icon']){
			$logoimgs[]="";
		}elseif(file_exists($imgdir.$logoinfo['icon'])){
			$logoimgs[]=dhtmlspecialchars($imgurl.$logoinfo['icon']);
		}else{
			$logoimgs[]=dhtmlspecialchars($logoinfo['icon']);
		}
		//������鸳ֵ
		$extra=$logoinfo['extra'];
		$extra=unserialize(stripcslashes($extra));
		$logo_widths[]=dhtmlspecialchars($extra["iconwidth"]);
}
