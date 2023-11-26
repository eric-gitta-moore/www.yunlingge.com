<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_dc_vip {
	public function __construct(){
		$this->plugin_dc_vip();
	}
	function plugin_dc_vip(){
		global $_G;
		if($_G['dc_plugin']['vip']['obj'])return;
		$config = @include DISCUZ_ROOT.'./source/plugin/dc_vip/data/config.php';
		if(empty($config)||!is_array($config))$config = array();
		$_G['cache']['plugin']['dc_vip'] = array_merge($_G['cache']['plugin']['dc_vip'],$config);
		C::import('class/vip','plugin/dc_vip',false);
		$_G['dc_plugin']['vip']['obj'] = new class_vip();
		$_G['dc_plugin']['vip']['groupdata'] = $_G['dc_plugin']['vip']['obj']->groupdata;
	}
	public function getvipgid($user,$allow){
		$vipgid = 0;
		if($user['yearend']==2147454847)
			$vipgid = $allow['extforevergroupid']?$allow['extforevergroupid']:$allow['extyeargroupid'];
		if(!$vipgid){
			if($user['isyear'])
				$vipgid = $allow['extyeargroupid']?$allow['extyeargroupid']:$allow['extgroupid'];
			else
				$vipgid = $allow['extgroupid'];
		}
		return $vipgid;
	}
	function common(){
		global $_G;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		$uvip = $_G['dc_plugin']['vip']['obj']->getvipinfo();
		$_G['cache']['plugin']['dc_vip']['chk'] = DISCUZ_ROOT.'./source/plugin/dc_'.'vip/tem'.'plat'.'e/';
		if($uvip){
			$vg = $_G['dc_plugin']['vip']['groupdata'][$uvip['vgid']];
			$vg['allow'] = dunserialize($vg['allow']);
			$vg['hook'] = dunserialize($vg['hook']);
			if(empty($vg['allow']))$vg['allow']=array();
			if(empty($vg['hook']))$vg['hook']=array();
			
			$_G['dc_plugin']['vip']['user'] = $uvip;
			if(!in_array($_G['group']['radminid'],array(1,2,3))){
				$_G['group']['disablepostctrl'] = $vg['allow']['disablepostctrl'];
				$_G['group']['allowdirectpost'] = $vg['allow']['allowdirectpost'];
				$_G['group']['closead'] = $vg['allow']['closead'];
				$_G['group']['exempt'] = $vg['allow']['exempt'];	
			}
			$_G['dc_plugin']['vip']['allow'] = $vg['allow'];
			$_G['dc_plugin']['vip']['hook'] = $vg['hook'];
			unset($vg['allow']);unset($vg['hook']);
			$_G['dc_plugin']['vip']['group'] = $vg;
		}
		$_G['cache']['plugin']['dc_vip']['chk'] .= 'side'.'bar.htm';
	}
	function discuzcode($param){
		global $_G;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		if($param['caller']!='discuzcode'||$param['param'][10]==$_G['uid']||$_G['forum']['ismoderator']||!$_G['uid'])
			return;
		if($_G['dc_plugin']['vip']['user']&&$_G['dc_plugin']['vip']['allow']['allowhide'])
			$_G['discuzcodemessage'] = preg_replace("/\[hide[=]?(d\d+)?[,]?(\d+)?\]\s*(.*?)\s*\[\/hide\]/is", '<div class="showhide"><h4>'.lang('plugin/dc_vip', 'hideview').'</h4>\\3</div>', $_G['discuzcodemessage']);
	}
	function global_usernav_extra1(){
		global $_G;
		if(!$_G['cache']['plugin']['dc_vip']['open']||!$_G['cache']['plugin']['dc_vip']['usernav'])return;
		if($_G['dc_plugin']['vip']['user'])
			return'<a href="plugin.php?id=dc_vip" class="vm"><img src="source/plugin/dc_vip/images/icon/'.$_G['dc_plugin']['vip']['group']['icon'].'" style="margin-top: -5px;"></a>';
		else
			return '<a href="plugin.php?id=dc_vip" title="'.lang('plugin/dc_vip', 'notviptips').'" class="vm"><img src="source/plugin/dc_vip/images/common/openvip.gif" style="margin-top: -3px;"></a>';
	}
	function global_footer(){
		global $_G;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		$cron = @include DISCUZ_ROOT.'/source/plugin/dc_vip/data/cron.php';
		if(dgmdate(TIMESTAMP,'Y-m-d')!=dgmdate($cron['timestamp'],'Y-m-d'))
			return '<script src="plugin.php?id=dc_vip:update"></script>';
	}
}
class plugin_dc_vip_forum extends plugin_dc_vip{
	function index_bottom_output(){
		global $_G,$detailstatus,$whosonline;
		if(!$_G['cache']['plugin']['dc_vip']['open']||!$_G['cache']['plugin']['dc_vip']['useronline'])return;
		if($_G['setting']['whosonlinestatus'] && $detailstatus){
			$uids = array();
			foreach($whosonline as $online){
				if($online['uid'])$uids[]=$online['uid'];
			}
			$users = C::t('#dc_vip#dc_vip')->fetch_all($uids);
			foreach($whosonline as $k => $online){
				if($online['uid']&&$users[$online['uid']]['exptime']>TIMESTAMP){
					$whosonline[$k]['username'] ='<font color="'.$_G['dc_plugin']['vip']['groupdata'][$users[$online['uid']]['vgid']]['color'].'">'.$online['username'].'</font>';
				}
			}
		}
	}
	function viewthread_sidetop_output(){
		global $_G,$postlist;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		$uids=array();
		$upgradegrowths = array();
		foreach ($postlist as $post){
			$uids[]=$post['authorid'];
		}
		$users = C::t('#dc_vip#dc_vip')->fetch_all($uids);
		$growdownspeed = str_replace('{growth}',$_G['cache']['plugin']['dc_vip']['dropv'],lang('plugin/dc_vip', 'growdownspeed'));
		foreach($users as $u){
			if(TIMESTAMP<$u['exptime']){
				foreach($_G['dc_plugin']['vip']['groupdata'] as $gd){
					if($u['growth']<$gd['growthlower']){
						$upgradegrowths[$u['uid']] = '<font color="'.$gd['color'].'">'.$gd['grouptitle'].'</font>, '.lang('plugin/dc_vip', 'growth').' '.$gd['growthlower'].', '.str_replace('{growth}',($gd['growthlower']-$u['growth']),lang('plugin/dc_vip', 'upgradelevel'));
						break;
					}
				}
				if(!$upgradegrowths[$u['uid']])$upgradegrowths[$u['uid']] = lang('plugin/dc_vip', 'levelhighest');
			}else{
				$upgradegrowths[$u['uid']]=$growdownspeed;
			}
		}
		$vipbind = array();
		foreach($_G['dc_plugin']['vip']['groupdata'] as $k => $vipg){
			$vipbind[$k]=dunserialize($vipg['allow']);
		}
		$return=array();
		foreach ($postlist as $pid=>&$post){
			if($users[$post['authorid']]){
				if(TIMESTAMP<$users[$post['authorid']]['exptime']){
					$return[] = '<p><span class="vm" id="vip_up'.$pid.'" onmouseover="showMenu({\'ctrlid\':this.id, \'pos\':\'12!\'});"><img src="source/plugin/dc_vip/images/icon/'.$_G['dc_plugin']['vip']['groupdata'][$users[$post['authorid']]['vgid']]['icon'].'">&nbsp;<font color="red">'.lang('plugin/dc_vip', 'growth').': '.$users[$post['authorid']]['growth'].'</font></span></p><div id="vip_up'.$pid.'_menu" class="tip tip_4" style="display: none;"><div class="tip_horn"></div><div class="tip_c">'.$upgradegrowths[$post['authorid']].'</div></div>';

					$postlist[$pid]['groupcolor'] = $_G['dc_plugin']['vip']['groupdata'][$users[$post['authorid']]['vgid']]['color'];
					if($_G['cache']['plugin']['dc_vip']['viewthread'])
						$postlist[$pid]['author']='<font color="'.$_G['dc_plugin']['vip']['groupdata'][$users[$post['authorid']]['vgid']]['color'].'">'.$post['author'].'</font>';
				}elseif($users[$post['authorid']]['growth']>0){
					$return[]='<p><span class="vm" id="vip_up'.$pid.'" onmouseover="showMenu({\'ctrlid\':this.id, \'pos\':\'12!\'});"><img src="source/plugin/dc_vip/images/icon/novip.gif" alt="'.lang('plugin/dc_vip', 'vipend').'"></a>&nbsp;'.lang('plugin/dc_vip', 'growth').': '.$users[$post['authorid']]['growth'].'</span></p><div id="vip_up'.$pid.'_menu" class="tip tip_4" style="display: none;"><div class="tip_horn"></div><div class="tip_c">'.$upgradegrowths[$post['authorid']].'</div></div>';
					$postlist[$pid]['unverifyicon'][] = 'dc_vip:vip';
				}else{
					$return[] = '';
				}
			}else{
				$return[] = '';
			}
		}
		$_G['setting']['verify']['dc_vip:vip']=array(
			'title'=>lang('plugin/dc_vip', 'vipuser'),
			'icon'=>'source/plugin/dc_vip/images/common/vip.png',
			'unverifyicon'=>'source/plugin/dc_vip/images/common/novip.png',
		);
		return $return;
	}

	function forumdisplay_vip_output(){
		global $_G,$verify,$groupcolor;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		$vipfids = dunserialize($_G['cache']['plugin']['dc_vip']['vipfids']);
		if(in_array($_G['fid'],$vipfids)&&$_G['cache']['plugin']['dc_vip']['distx'])
			return;
		$users = array();
		foreach ($_G['forum_threadlist'] as $key=>$thread){
			$uids[]=$thread['authorid'];
		}
		$users = C::t('#dc_vip#dc_vip')->fetch_all($uids);
		if($_G['cache']['plugin']['dc_vip']['forumdisplay']){
			foreach($users as $u){
				if($_G['cache']['plugin']['dc_vip']['forumdisplay']==1){
					$groupcolor[$u['uid']] = $_G['dc_plugin']['vip']['groupdata'][$u['vgid']]['color'];
				}else{
					if(TIMESTAMP<$u['exptime']){
						$groupcolor[$u['uid']] = $_G['dc_plugin']['vip']['groupdata'][$u['vgid']]['color'];
						$verify[$u['uid']] .= '<a href="plugin.php?id=dc_vip" target="_blank"><img src="source/plugin/dc_vip/images/common/vip.png"></a>';
					}elseif($u['growth']>0){
						$verify[$u['uid']] .= '<a href="plugin.php?id=dc_vip" target="_blank"><img src="source/plugin/dc_vip/images/common/novip.png"></a>';
					}
				}
			}
		}
		foreach ($_G['forum_threadlist'] as $key=>$thread){
			if(TIMESTAMP<$users[$thread['authorid']]['exptime']&&empty($thread['highlight'])){
				$threadstyle = '';
				$hightset = $_G['dc_plugin']['vip']['groupdata'][$users[$thread['authorid']]['vgid']];
				if($hightset['highlight']==1 || $hightset['highlight']==3)
					$threadstyle .= 'font-weight: bold;';
				if($hightset['highlight']==2 || $hightset['highlight']==3)
					$threadstyle .= 'color: '.$hightset['highlightcolor'].';';
				if($threadstyle)
					$_G['forum_threadlist'][$key]['highlight'] ='style="'.$threadstyle.'" ';
			}
		}
	}
}
class plugin_dc_vip_home extends plugin_dc_vip{
	var $spaceuv=null;
	var $spacevg=null;
	var $spaceisvip =null;
	public function __construct(){
		parent::__construct();
		$this->plugin_dc_vip_home();
	}
	function plugin_dc_vip_home(){
		global $_G,$space;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		$this->spaceuv = $_G['dc_plugin']['vip']['obj']->getvipinfo($space['uid'],true);
		if(!empty($this->spaceuv)){
			$this->spacevg = $_G['dc_plugin']['vip']['groupdata'][$this->spaceuv['vgid']];
			$this->spacevg['allow'] = dunserialize($this->spacevg['allow']);
			$this->spacevg['hook'] = dunserialize($this->spacevg['hook']);
			$this->spaceisvip = true;
		}
		
	}
	
	function spacecp_usergroup_top_output(){
		global $_G,$maingroup,$usergroups;
		if(!$usergroups||!$_G['dc_plugin']['vip']['user'])return;
		$maingroup['grouptitle'].='('.$_G['dc_plugin']['vip']['group']['grouptitle'].')';
	}
	function space_profile_baseinfo_top_output(){
		global $_G,$space;
		if(!$_G['cache']['plugin']['dc_vip']['open'])return;
		if($this->spaceisvip){
			if($this->spaceuv['exptime']>TIMESTAMP){
				$exid = $this->getvipgid($this->spaceuv,$this->spacevg['allow']);
				if(!$exid)return;
				$vipg = C::t('common_syscache')->fetch('usergroup_'.$exid);
				if(!in_array($space['adminid'],array(1,2,3))&&$_G['cache']['plugin']['dc_vip']['groupreplace']&&$vipg&&!in_array($space['groupid'],array(4,5,6,7,8))){
					$group = array(
						'type'=>$vipg['grouptype'],
						'grouptitle'=>$vipg['grouptitle'],
						'stars'=>$vipg['stars'],
						'color'=>$vipg['color'],
						'icon'=>g_icon($vipg['groupid'], 1),
						'readaccess'=>$vipg['readaccess'],
						'allowgetattach'=>$vipg['allowgetattach'],
						'allowgetimage'=>$vipg['allowgetimage'],
						'allowmediacode'=>$vipg['allowmediacode'],
						'maxsigsize'=>$vipg['maxsigsize'],
						'allowbegincode'=>$vipg['allowbegincode'],
					);
					$space['group'] = array_merge($space['group'],$group);
					$space['groupexpiry'] = $this->spaceuv['exptime']!=2147454847?$this->spaceuv['exptime']:0;
				}
				$level = '<img src="source/plugin/dc_vip/images/icon/'.$this->spacevg['icon'].'">';
				$growth = $_G['cache']['plugin']['dc_vip']['growthv'];
				$growth = '<font color="#FF0000">'.$growth.'</font>';
			}else{
				$level = '<a href="plugin.php?id=dc_vip" title="'.lang('plugin/dc_vip', 'vipend').'"><img src="source/plugin/dc_vip/images/common/novip.gif" alt="'.lang('plugin/dc_vip', 'vipend').'"></a>';
				$growth = '<font color="#FF0000">-'.$_G['cache']['plugin']['dc_vip']['dropv'].'</font>';
			}
			return '<div class="pbm mbm bbda cl">
						<h2 class="mbn" style="color:#FF0000">VIP</h2>
						<ul class="pf_l">
							<li><em>'.lang('plugin/dc_vip', 'viplevel').'</em>'.$level.'</li>
							<li><em>'.lang('plugin/dc_vip', 'growth').'</em>'.$this->spaceuv['growth'].'</li>
							<li><em>'.lang('plugin/dc_vip', 'timeend').'</em><strong style="color:#FF0000">'.(dgmdate($this->spaceuv['exptime'],'Y-m-d')).'</strong></li>
							<li><em>'.lang('plugin/dc_vip', 'growspeed').'</em>'.$growth.lang('plugin/dc_vip', 'pointday').'</li>
						</ul>
					</div>';
		}elseif($_G['uid']==$space['uid']){
			return '<div class="pbm mbm bbda cl">
						<ul><li>'.lang('plugin/dc_vip', 'notviptips').'
        	<a href="plugin.php?id=dc_vip" class="dc_vip_btn"><span>'.lang('plugin/dc_vip', 'openvipuser').'</span></a></li>
						</ul>
					</div>';
		}
	}
	function spacecp_profile_verify(){
		if($_GET['op']=='verify'&&isset($_GET['vid'])){
			$vids = explode(':',$_GET['vid']);
			if($vids[0] == 'dc_vip')
				dheader('location:plugin.php?id=dc_vip');
		}
		
	}
	
}
class mobileplugin_dc_vip extends plugin_dc_vip{}
class mobileplugin_dc_vip_forum extends plugin_dc_vip_forum{}
class mobileplugin_dc_vip_home extends plugin_dc_vip_home{}
?>