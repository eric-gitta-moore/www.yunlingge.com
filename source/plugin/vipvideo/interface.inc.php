<?php

/**
 *      $author: ³ËÁ¹ $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

define('IDENTIFIER','vipvideo');

$pluginurl = ADMINSCRIPT.'?action=plugins&identifier='.IDENTIFIER.'&pmod=interface';

	if(!submitcheck('savesubmit')) {

?>
<script type="text/JavaScript">
var rowtypedata = [
	[
		[1,'', 'td25'],
		[1,'<input type="text" class="txt" name="newdisplayorder[]" size="3">', 'td28'],
		[1,'<input type="text" class="txt" name="newname[]" size="15">'],
		[1,'<input type="text" class="txt" name="newurl[]" size="30">', 'td26'],
		[1,'<input type="checkbox" name="newstatus[{n}]" value="1" class="checkbox">']
	]
]
</script>
<?php
		showformheader('plugins&identifier='.IDENTIFIER.'&pmod=interface');
		showtableheader(lang('plugin/'.IDENTIFIER, 'interface_list'));
		showsubtitle(array('del', 'display_order', lang('plugin/'.IDENTIFIER, 'interface_name'), lang('plugin/'.IDENTIFIER, 'interface_url'), 'enable'));
		showsubtitle(array('', '', '', '', '<input class="checkbox" type="checkbox" name="statusall" onclick="checkAll(\'prefix\', this.form, \'status\', \'statusall\')">'));
		loadcache('vipvideo_interface');
		$list = $_G['cache']['vipvideo_interface'];
		foreach ($list as $value) {
			showtablerow('', array('class="td25"', 'class="td28"', '', 'class="td26"'), array(
				'<input type="checkbox" class="checkbox" name="delete[]" value="'.$value['id'].'" />',
				'<input type="text" class="txt" name="displayorder['.$value[id].']" value="'.$value['displayorder'].'" size="3" />',
				'<input type="text" class="txt" name="name['.$value[id].']" value="'.$value['name'].'" size="15" />',
				'<input type="text" class="txt" name="url['.$value[id].']" value="'.$value['url'].'" size="30" />',
				'<input class="checkbox" type="checkbox" value="1" name="status['.$value[id].']" '.($value['status'] ? "checked" : '').'>',
			));
		}

		echo '<tr><td></td><td colspan="3"><div><a href="###" onclick="addrow(this, 0)" class="addtr">'.lang('plugin/'.IDENTIFIER, 'interface_add').'</a></div></td></tr>';
		showsubmit('savesubmit', 'submit', 'del');
		showtablefooter();
		showformfooter();

	} else {

		if($_GET['delete']) {
			C::t('#'.IDENTIFIER.'#vipvideo_interface')->delete($_GET['delete']);
		}

		if(is_array($_GET['name'])) {
			foreach($_GET['name'] as $id => $val) {
				$query = C::t('#'.IDENTIFIER.'#vipvideo_interface')->update($id, array(
					'displayorder' => $_GET['displayorder'][$id],
					'name' => $_GET['name'][$id],
					'url' => $_GET['url'][$id],
					'status' => intval($_GET['status'][$id]),
				));
			}
		}

		if(is_array($_GET['newname'])) {
			foreach($_GET['newname'] as $key => $value) {
				if($value) {
					C::t('#'.IDENTIFIER.'#vipvideo_interface')->insert(array(
						'displayorder' => $_GET['newdisplayorder'][$key],
						'name' => $value,
						'url' => $_GET['newurl'][$key],
						'status' => intval($_GET['newstatus'][$key]),
					));
				}
			}
		}
		updatecache('vipvideo:interface');

		cpmsg(lang('plugin/'.IDENTIFIER, 'interface_updatesucceed'), 'action=plugins&identifier='.IDENTIFIER.'&pmod=interface', 'succeed');

	}


?>