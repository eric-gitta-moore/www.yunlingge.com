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


require_once DISCUZ_ROOT . "./source/plugin/jnpar_logoimg/config.php";

if(!submitcheck('submit')){
	showtips(lang('plugin/jnpar_logoimg', 'quickset1'));
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=jnpar_logoimg&pmod=quickset');
	showtableheader();
	
	showsetting('','logoimg_arr',$init,'textarea');
	
	showtablefooter();
	showsubmit('submit',lang('plugin/jnpar_logoimg', 'quickset4'));
	showformfooter();
	
}else{
	//��ȡpost���ݣ���ȫ���˲����
	$post=dhtmlspecialchars($_POST);
	@extract($post);
	
	$logoimg_arr=explode(PHP_EOL,trim($logoimg_arr));//ÿ��һ����������ת��Ϊ����
	foreach($logoimg_arr as $key=>$logoimg){
		$arr=explode("|",trim($logoimg));//ÿ�в��һ�����ͼ���������飬�����е�һ��Ԫ��Ϊ���ID���ڶ���Ԫ��Ϊλ��ָ��Ŀ¼�е�ͼ�����ƣ�������Ԫ��Ϊ���
		
		//�������еĿ�Ƚ������л������õ����л����$extra
		$extra_arr=unserialize(stripcslashes($logoinfos[$key]["extra"]));
		$extra_arr['iconwidth']=$arr[2];
		$extra=serialize($extra_arr);
		
		
		//��������а������ͼ�꣬���Ұ��ͼ����ָ��Ŀ¼�д��ڣ���ִ�и���
		if($arr[1] and file_exists(DISCUZ_ROOT . "./source/plugin/jnpar_logoimg/logoimgs/".$arr[1])){
			
			$data=array(
						'icon'=>daddslashes($siteurl."source/plugin/jnpar_logoimg/logoimgs/".$arr[1]),
						'extra'=>daddslashes($extra),
						);
			$condition="`fid`=".$arr[0];
			DB::update('forum_forumfield',$data,$condition);
		}
	}
	cpmsg(lang('plugin/jnpar_logoimg', 'quickset5'),'action=plugins&operation=config&do='.$pluginid.'&identifier=jnpar_logoimg&pmod=quickset','succeed');
}

