<?php 
/*
 *	[jnpar] (C)2018-2023 jnpar����ſ��ҫ��Ʒ.
 *	�ⲻ��һ����ѵĳ�����QQ��94526868�ṩ����֧�֣����趨�ƻ��߸��Ի��޸Ĳ������ӭ��������ϵ��
 *  ��������վdiscuz.jnpar.com �����ƹ㣬������ʻ��١�
 *	$_G['basescript'] = ģ������
 *	CURMODULE = Ϊģ���Զ��峣��
 */


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT . "./source/plugin/jnpar_logoimg/config.php";

if(!submitcheck('submit')){
	include(template("jnpar_logoimg:admin"));
}else{
	include("upload.class.php");
	$i=0;
	foreach($fids as $key=>$fid){
		$iconwid_fid=dhtmlspecialchars($_POST["iconwidth_$fid"]);//�ύ�Ŀ��ֵ
		$iconnew_fid=dhtmlspecialchars($_POST["iconnew_$fid"]);//�ύ��ͼ��URL
		if($_FILES["iconnew_$fid"]['size'] or $logo_widths[$key]!=$iconwid_fid or ($iconnew_fid and $logoinfos[$key]['icon']!=$iconnew_fid)){//����ļ���Ϊ�գ������ύ�Ŀ�Ȳ����ڵ�ǰ��ȣ������û��л����ύurl����ͼ������ύ��url�����ڵ�ǰͼ��url����ִ�а��ͼ����²���
				$i++;
				if($_FILES["iconnew_$fid"]['size']){
					@unlink($logoimgs[$key]);
					@unlink("./source/plugin/jnpar_logoimg/logoimgs/"."common_$fid_icon");
					$up=new upclass();
					$wid=$up->get_ph_tmpname($_FILES["iconnew_$fid"]['tmp_name']);
					$up->get_ph_type($_FILES["iconnew_$fid"]['type']);
					$size=$up->get_ph_size($_FILES["iconnew_$fid"]['size']);
					$images=$up->get_ph_name($_FILES["iconnew_$fid"]['name'],'common_'.$fid.'_icon');//�ϴ����ͼ������
					$up->save();
					$wid=$wid[0];//��ȡ�ϴ���Ŀ����Ϣ
					$images=str_replace('./','',$images);
					$images=$siteurl.$images;//ƴ���ϴ���İ��ͼ��url
				}elseif($_POST["iconnew_$fid"]){
					$images=dhtmlspecialchars($_POST["iconnew_$fid"]);
					$imginf=getimagesize($images);
					$wid=$imginf[0];
				}else{
					$images=$logoimgs[$key];
				}
				
				
				$extra_arr=unserialize(stripcslashes($logoinfos[$key]["extra"]));
				if(!is_array($extra_arr)){
					$extra_arr=array(
									 'namecolor'=>'',
									 'iconwidth'=>'',
									 );
				}
				if(!$iconwid_fid){
					$extra_arr['iconwidth']=$wid;
				}else{
					$extra_arr['iconwidth']=$iconwid_fid;
				}
				$extra=serialize($extra_arr);
				$data=array(
							'icon'=>daddslashes($images),
							'extra'=>daddslashes($extra),
							);
				$condition="`fid`=$fid";
				//���ͼ�����
				DB::update('forum_forumfield',$data,$condition);
		}
	}
	cpmsg(lang('plugin/jnpar_logoimg', 'admin1').$i.lang('plugin/jnpar_logoimg', 'admin2'),'action=plugins&operation=config&do='.$pluginid.'&identifier=jnpar_logoimg&pmod=admin','succeed');
}

