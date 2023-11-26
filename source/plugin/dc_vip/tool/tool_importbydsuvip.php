<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class tool_importbydsuvip{
	var $title='&#23548;&#20837;[DSU]VIP&#30340;&#25968;&#25454;';
	var $des='&#25226;[DSU]VIP&#30340;&#25968;&#25454;&#23548;&#20837;&#21040;&#26412;&#25554;&#20214;&#20013;&#65292;&#26412;&#20250;&#26367;&#25442;&#24050;&#23384;&#22312;&#30340;&#29992;&#25143;&#20449;&#24687;';
	public function run(){
		global $page,$_G;
		$tablecheck=DB::result_first('show tables like \'%'.DB::table('dsu_vip').'%\'');
		if(!$tablecheck){
			cpmsg('&#23545;&#19981;&#36215;&#65292;&#26410;&#26816;&#32034;&#21040;[DSU]KKVIP&#30340;&#25968;&#25454;&#34920;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool','error');
		}
		$perpage = 1000;
		$start = ($page-1)*$perpage;
		$data=DB::fetch_all('SELECT * FROM '.DB::table('dsu_vip').' limit '.$start.','.$perpage);
		$count = count($data);
		$groups = C::t('#dc_vip#dc_vip_group')->getdata();
		foreach($data as $d){
			$vgid = 0;
			foreach($groups as $g){
				if($g['growthlower']<=$d['czz']){
					$vgid=$g['id'];
				}else{
					break;
				}
				
			}
			$uvd = array(
				'uid'=>$d['uid'],
				'jointime'=>$d['jointime'],
				'exptime'=>$d['exptime'],
				'growth'=>$d['czz'],
				'vgid'=>$vgid,
				'uptime'=>TIMESTAMP,
			);
			C::t('#dc_vip#dc_vip')->insert($uvd,false,true);
		}
		if($count==$perpage){
			cpmsg('&#27491;&#22312;&#36827;&#34892;[DSU]VIP&#30340;&#25968;&#25454;&#23548;&#20837;'.(($page-1)*$perpage+$count),'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool&f=importbydsuvip&f=importbydsuvip&submit=yes&page='.($page+1).'&formhash='.FORMHASH,'loading');
		}
	}
	public function setting(){
		global $pluginid,$_G;
		$tablecheck=DB::result_first('show tables like \'%'.DB::table('dsu_vip').'%\'');
		if(!$tablecheck){
			cpmsg('&#23545;&#19981;&#36215;&#65292;&#26410;&#26816;&#32034;&#21040;[DSU]KKVIP&#30340;&#25968;&#25454;&#34920;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool','error');
		}
		cpmsg('&#26159;&#21542;&#36827;&#34892;[DSU]KKVIP&#30340;&#25968;&#25454;&#23548;&#20837;','action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=tool&f=importbydsuvip&f=importbydsuvip&submit=yes','form');
	}
}
?>