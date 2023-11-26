<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$acto = getgpc('a');
!$acto && $acto = 'list';
$formurl = "plugins&operation=config&do={$pluginid}&identifier=rjyfk_invite&pmod=admin_data";
$jumpurl = "action={$formurl}&acto={$acto}";
$baseurl = ADMINSCRIPT . "?action={$formurl}";
$_setting = $_G['setting'];
$_extcredits = $_setting['extcredits'];
if ($acto == 'list') {
	$quer= getgpc('quer');
	if (empty($quer)) {
		$page = (int) getgpc('page');
		$uid = getgpc('uid');
		$fuid = getgpc('fuid');
		$status = getgpc('status');
		$sql = 1;
		$sqluid = "{$baseurl}&a={$acto}";
		if (is_numeric($uid)) {
			$sql .= ' AND ' . DB::field('uid', $uid);
			$sqluid .= "&uid={$uid}";
		}
		if (is_numeric($fuid)) {
			$sql .= ' AND ' . DB::field('fuid', $fuid);
			$sqluid .= "&fuid={$fuid}";
		}
		if ($status) {
			$sql .= ' AND ' . DB::field('status', $status);
			$sqluid .= "&status={$status}";
			${'status_' . $status} = ' selected';
		}
		list($pages, $query, $query_tatol) = C::t('#rjyfk_invite#rjyfk_invite')->fetch_all_by_paging($page, 20, $sql . ' ORDER BY `dateline` DESC', $sqluid);
		include template('rjyfk_invite:admin');
	} elseif ($quer== 'delete') {
		if (!submitcheck('delsubmit')) {
			cpmsg_error('Access Denied');
		}
		$delete = getgpc('delete');
		$sqlnum = is_array($delete) ? count($delete) : 0;
		if ($sqlnum) {
			C::t('#rjyfk_invite#rjyfk_invite')->delete($delete);
			cpmsg(lang('plugin/rjyfk_invite', 'deletesuccess', array('sqlnum' => $sqlnum)), $jumpurl, 'succeed');
		}
		cpmsg_error(lang('plugin/rjyfk_invite', 'deleteselect'));
	} else {
		cpmsg_error('Access Denied');
	}
} else {
	cpmsg_error('Access Denied');
}