<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class class_vip{
	var $cvar;
	var $groupdata;
	public function __construct(){
		global $_G;
		loadcache('plugin');
		$this->cvar = &$_G['cache']['plugin']['dc_vip'];
		$this->cvar['hash']='10001fc122d05d3ed11787b9f14e90bf';
		$this->groupdata = C::t('#dc_vip#dc_vip_group')->getdata();
	}
	public function getvipinfo($uid='',$flag = false){
		global $_G;
		if(!$_G['uid']&&!$uid)return array();
		$uid = $uid ? $uid : $_G['uid'];
		$uvip = C::t('#dc_vip#dc_vip')->fetch($uid);
		if(empty($uvip))return array();
		if($flag==false)
			$this->update($uvip,'data');
		if(dgmdate($uvip['exptime'],'Y-m-d')>=dgmdate(TIMESTAMP,'Y-m-d')||$flag)
			return $uvip;
		else
			return array();
	}
	public function update($d,$type = 'uid'){
		if($type=='uid')$d=$this->getvipinfo($d,true);
		if(empty($d))return;
		$nowdate = dgmdate(TIMESTAMP,'Y-m-d');
		$update = dgmdate($d['uptime'],'Y-m-d');
		$expdate = dgmdate($d['exptime'],'Y-m-d');
		$isrewardchk = false;
		if($nowdate > $update){
			if($expdate >= $nowdate){
				$gt = $this->cvar['growthv'];
				$day = (strtotime($nowdate) - strtotime($update))/86400;
				$growth = $gt*$day + $d['growth'];
			}else{
				if($update>$expdate){
					$gt = $this->cvar['dropv'];
					$day = (strtotime($nowdate) - strtotime($update))/86400;
					$gt = $gt*$day;
					$growth = $d['growth']-$gt;
				}else{
					$gt = $this->cvar['growthv'];
					$day = (strtotime($expdate) - strtotime($update))/86400;
					$gt = $gt*$day;
					$day = (strtotime($nowdate) - strtotime($update))/86400;
					$day = $day-1;
					$growth = $gt - $this->cvar['dropv']*$day;
					$growth = $growth + $d['growth'];
				}
				if($growth<0)$growth=0;
			}
			$vgid = $this->get_vip_group_by_growth($growth);
			$data = array(
				'growth'=>$growth,
				'uptime'=>TIMESTAMP,
				'vgid'=>$vgid['id'],
			);
			if($isrewardchk){
				$data['growth'] += $this->cvar['fyvipreward'];
			}
			C::t('#dc_vip#dc_vip')->update($d['uid'],$data);
		}
	}
	public function updategrowth($uid,$growth = 0,$flag = false){
		global $_G;
		$uvip = array();
		if($uid==$_G['uid']){
			$uvip = $_G['dc_plugin']['vip']['user'];
			$flag = true;
		}else{
			$uvip = $this->getvipinfo($uid);
		}
		if(empty($uvip))return;
		$data = array(
			'growth'=>$uvip['growth'] + $growth,
		);
		if($flag){
			$vgid = $this->get_vip_group_by_growth($data['growth']);
			$data['vgid'] = $vgid['id'];
		}
		C::t('#dc_vip#dc_vip')->update($uid,$data);
	}
	public function get_vip_group_by_growth($growth){
		$vgdata = array();
		foreach($this->groupdata as $g){
			if($g['growthlower']<=$growth){
				$vgdata = $g;
			}else{
				break;
			}	
		}
		return $vgdata;
	}
}
?>