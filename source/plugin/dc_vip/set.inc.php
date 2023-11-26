<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if($_GET['act']=='zqx'){
	$id = dintval($_GET['id']);
	$vg = C::t('#dc_vip#dc_vip_group')->fetch($id);
	if(empty($vg))cpmsg(dcplang('novipgroup'),'','error');
	if(submitcheck('submit')){
		$d = dintval($_GET['d'],true);
		for($i = 0;$i < 8;$i++) {
			$exemptnewbin = intval($_GET['exempt'][$i]).$exemptnewbin;
		}
		$exemptnew = bindec($exemptnewbin);
		$d['exempt'] = $exemptnew;
		$vga['allow'] = serialize($d);
		C::t('#dc_vip#dc_vip_group')->update($id,$vga);
		cpmsg(dcplang('setok'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set', 'succeed');
	}
	$va = dunserialize($vg['allow']);
	if(empty($va))$va=array();
	$va['exempt'] = strrev(sprintf('%0'.strlen($va['exempt']).'b', $va['exempt']));
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set&act=zqx');
	echo'<input type="hidden" value="'.$vg['id'].'" name="id"/>';
	showtableheader(dcplang('edit').'('.$vg['grouptitle'].')'.dcplang('qx'), '');
	
	showsetting(dcplang('disablepostctrl'),'d[disablepostctrl]',$va['disablepostctrl'],'radio');
	showsetting(dcplang('allowdirectpost'),'d[allowdirectpost]',$va['allowdirectpost'],'radio');
	showsetting(dcplang('closead'),'d[closead]',$va['closead'],'radio');
	showsetting(dcplang('allowsenpm'),'exempt[0]',$va['exempt'][0],'radio');
	showsetting(dcplang('allowsearch'),'exempt[1]',$va['exempt'][1],'radio');
	showsetting(dcplang('allowatt'),'exempt[2]',$va['exempt'][2],'radio');
	showsetting(dcplang('allowpayadd'),'exempt[3]',$va['exempt'][3],'radio');
	showsetting(dcplang('allowpaysubject'),'exempt[4]',$va['exempt'][4],'radio');
	showsetting(dcplang('allowhide'),'d[allowhide]',$va['allowhide'],'radio');
	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
	exit();
}elseif($_GET['act']=='extqx'){
	$id = dintval($_GET['id']);
	$vg = C::t('#dc_vip#dc_vip_group')->fetch($id);
	if(empty($vg))cpmsg(dcplang('novipgroup'),'','error');
	if(submitcheck('submit')){
		$h = daddslashes($_GET['h']);
		$vga = array('hook'=>serialize($h));
		C::t('#dc_vip#dc_vip_group')->update($id,$vga);
		cpmsg(dcplang('setok'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set', 'succeed');
	}
	$vh = dunserialize($vg['hook']);
	if(empty($vh))$vh=array();
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set&act=extqx');
	echo'<input type="hidden" value="'.$vg['id'].'" name="id"/>';
	showtips(dcplang('exttips'));
	showtableheader(dcplang('edit').'('.$vg['grouptitle'].')'.dcplang('extqx'), '');
	$hooks = C::t('common_plugin')->fetch_all_data(true);
	foreach($hooks as $hook){
		if($hook['identifier']=='dc_vip')continue;
		$hookpath = DISCUZ_ROOT.'./source/plugin/'.$hook['directory'].'vip.config.php';
		if(file_exists($hookpath)){
			$conf = @include $hookpath;
			if(is_array($conf)){
				foreach($conf as $k=>$v){
					showsetting($hook['name'].'=>'.lang('plugin/'.$hook['identifier'], $v['title']),'h['.$hook['identifier'].']['.$k.']',$vh[$hook['identifier']][$k],(in_array($v['type'],array('radio','text','number'))?$v['type']:'radio'),'','',lang('plugin/'.$hook['identifier'], $v['des']));
				}
			}
		}
	}
	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
	exit();
}
if(submitcheck('submit')){
	$delete = dintval($_GET['delete'],true);
	$grouptitle = daddslashes($_GET['grouptitle']);
	$growthlower = dintval($_GET['growthlower'],true);
	$color = daddslashes($_GET['color']);
	$icon = daddslashes($_GET['icon']);
	$newgrouptitle = daddslashes($_GET['newgrouptitle']);
	$newgrowthlower = dintval($_GET['newgrowthlower'],true);
	$newcolor = daddslashes($_GET['newcolor']);
	$newicon = daddslashes($_GET['newicon']);
	if($delete){
		foreach($delete as $k => $dv){
			unset($grouptitle[$k]);
			unset($growthlower[$k]);
			unset($color[$k]);
			unset($icon[$k]);
		}
	}
	foreach($grouptitle as $k=>$gv){
		$d = array(
			'grouptitle'=>trim($gv),
			'growthlower'=>$growthlower[$k],
			'color'=>trim($color[$k]),
			'icon'=>trim($icon[$k]),
		);
		if(empty($d['grouptitle']))unset($d['grouptitle']);
		C::t('#dc_vip#dc_vip_group')->update($k,$d);
	}
	foreach($newgrouptitle as $k=>$gv){
		$gv = trim($gv);
		if(empty($gv))continue;
		$d = array(
			'grouptitle'=>$gv,
			'growthlower'=>$newgrowthlower[$k],
			'color'=>trim($newcolor[$k]),
			'icon'=>trim($newicon[$k]),
		);
		C::t('#dc_vip#dc_vip_group')->insert($d);
	}
	C::t('#dc_vip#dc_vip_group')->delete($delete);
	cpmsg(dcplang('setok'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set', 'succeed');
}
$vipgroup = C::t('#dc_vip#dc_vip_group')->getdata();
showformheader('plugins&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set');
showtips(dcplang('viptips'));
showtableheader(dcplang('vipqxgroup'), '');
showsubtitle(array('',dcplang('groupname'),dcplang('growthlower'), dcplang('hightlight'), dcplang('icon'), dcplang('qxedit')));
foreach($vipgroup as $g){
	showtablerow('', array('class="td25"', '', '', '', ''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[$g[id]]\" value=\"$g[id]\">",
				"<input type=\"text\" class=\"txt\" size=\"12\" name=\"grouptitle[$g[id]]\" value=\"$g[grouptitle]\">",
				"<input type=\"text\" class=\"txt\" size=\"12\"name=\"growthlower[$g[id]]\" value=\"$g[growthlower]\">",
				"<input type=\"text\" id=\"color_$g[id]_v\" class=\"left txt\" size=\"12\"name=\"color[$g[id]]\" value=\"$g[color]\" onchange=\"updatecolorpreview('color_$g[id]')\"><input type=\"button\" id=\"color_$g[id]\" class=\"colorwd\" style=\"background-color:$g[color]\" onclick=\"color_$g[id]_frame.location='static/image/admincp/getcolor.htm?color_$g[id]|color_$g[id]_v';showMenu({'ctrlid':'color_$g[id]'})\" /><span id=\"color_$g[id]_menu\" style=\"display: none\"><iframe name=\"color_$g[id]_frame\" src=\"\" frameborder=\"0\" width=\"210\" height=\"148\" scrolling=\"no\"></iframe></span>",
				"<input type=\"text\" class=\"txt\" size=\"12\"name=\"icon[$g[id]]\" value=\"$g[icon]\"><img src=\"source/plugin/dc_vip/images/icon/$g[icon]\">",
				'<a href="'.ADMINSCRIPT.'?action=plugins&&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set&act=zqx&id='.$g['id'].'">'.dcplang('zqx').'</a>&nbsp;&nbsp;<a href="'.ADMINSCRIPT.'?action=plugins&&operation=config&do='.$pluginid.'&identifier=dc_vip&pmod=set&act=extqx&id='.$g['id'].'">'.dcplang('extqx').'</a>'
			));
}
echo '<tr><td></td><td colspan="5"><div><a href="javascript:;" onclick="addrow(this)" class="addtr">'.dcplang('add').'</a></div></td></tr>';
showsubmit('submit', 'submit');
showtablefooter();
showformfooter();
echo'<script type="text/javascript">
	function addrow(obj) {
		var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
		var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex);
		var typedata = [\'\',\'<input type="text" name="newgrouptitle[]" value="" size="12"/>\',\'<input type="text" name="newgrowthlower[]" value="" size="12"/>\',\'<input type="text" name="newcolor[]" value="" size="12"/>\',\'<input type="text" name="newicon[]" value="" size="12"/>\',\'\'];
		for(var i = 0; i <= typedata.length - 1; i++) {
			var cell = row.insertCell(i);
			cell.innerHTML = typedata[i];
		}
	}
		</script>';
function dcplang($str) {
	return lang('plugin/dc_vip', $str);
}
?>