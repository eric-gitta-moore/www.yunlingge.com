<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$vgid = dintval($_GET['vgid']);
$jg = array();
if($vgid){
	if($_G['dc_plugin']['vip']['groupdata'][$vgid]){
		$jg = $_G['dc_plugin']['vip']['groupdata'][$vgid];
	}
}else{
	foreach($_G['dc_plugin']['vip']['groupdata'] as $gdv){
		if($_G['dc_plugin']['vip']['user']['growth']<$gdv['growthlower']){
			$jg = $gdv;
			break;
		}
	}
}
if($_G['dc_plugin']['vip']['allow'])
	$_G['dc_plugin']['vip']['allow'] = array_merge($_G['group'],$_G['dc_plugin']['vip']['allow']);
else
	$_G['dc_plugin']['vip']['allow'] = $_G['group'];
$_G['dc_plugin']['vip']['allow']['exempt'] = strrev(sprintf('%0'.strlen($_G['dc_plugin']['vip']['allow']['exempt']).'b', $_G['dc_plugin']['vip']['allow']['exempt']));
if(!empty($jg)){
	$jg['allow'] = dunserialize($jg['allow']);
	$vipg = C::t('common_syscache')->fetch('usergroup_'.$jg['allow']['extgroupid']);
	if(!empty($vipg)){
		unset($vipg['groupid']);unset($vipg['grouptitle']);
		$jg['allow'] = array_merge($jg['allow'],$vipg);
	}
	$jg['hook'] = dunserialize($jg['hook']);
	if(empty($jg['allow']))$jg['allow']=array();
	if(empty($jg['hook']))$jg['hook']=array();
	$jg['allow']['exempt'] = strrev(sprintf('%0'.strlen($jg['allow']['exempt']).'b', $jg['allow']['exempt']));
}
$viphooks =array();
$pluginhooks = C::t('common_plugin')->fetch_all_data(true);
foreach($pluginhooks as $pluginhook){
	if($pluginhook['identifier']=='dc_vip')continue;
	$hookpath = DISCUZ_ROOT.'./source/plugin/'.$pluginhook['directory'].'vip.config.php';
	if(file_exists($hookpath)){
		$conf = @include $hookpath;
		if(is_array($conf)){
			foreach($conf as $k=>$v){
				$viphooks[$k] = array(
					'name'=>lang('plugin/'.$pluginhook['identifier'], $v['title']),
					'type'=>in_array($v['type'],array('radio','text','number'))?$v['type']:'radio',
					'value'=>$_G['dc_plugin']['vip']['hook'][$pluginhook['identifier']][$k],
				);
				if(!empty($jg)){
					$viphooks[$k]['jgvalue'] = $jg['hook'][$pluginhook['identifier']][$k];
				}
			}
		}
	}
}
$navtitle = lang('plugin/dc_vip','vip_center');
?>