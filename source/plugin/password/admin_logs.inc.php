<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$lpp = 20;
$checklpp = array();
$checklpp[$lpp] = 'selected="selected"';
$extrainput = '';
$logdir = DISCUZ_ROOT.'./data/log/';
$logfiles = get_log_files($logdir, 'password');

$logs = array();
krsort($logfiles);
$lastlog = $logfiles[0];



if($logfiles) {
	if(!isset($_GET['day'])) {
		$logs = file($logdir.$lastlog);
	} else {
		$day = str_replace(array('.','..'),'',daddslashes($_GET['day']));
		if(!file_exists($logdir.$day.'_password.php')) cpmsg_error('log isn\'t existed');
		$logs = file($logdir.$day.'_password.php');
	}
}


$start = ($page - 1) * $lpp;
$logs = array_reverse($logs);

$num = count($logs);
echo $multipage = multi($num, $lpp, $page, ADMINSCRIPT."?action=plugins&operation=$operation&identifier=password&pmod=admin_logs");
$logs = array_slice($logs, $start, $lpp);

showtableheader('', 'fixpadding" style="table-layout: fixed');
$filters = '';
$selectcode = '';
foreach($logfiles as $value){
	$day = explode('_',$value);
	$day = $day[0];
	$selectcode .= '<option value="'.$day.'"'.($day == $_GET['day'] ? 'selected="selected"' : '').'>'.$day.'</option>';
}
showtablerow('class="header"', array('class="td23"','class="td24"','class="td23"','class="td23"','class="td23"','class="td23"'), array(
	cplang('time'). '<select class="right" onchange="location.href=\'admin.php?action=plugins&amp;operation=config&amp;identifier=password&amp;pmod=admin_logs&amp;day=\'+this.value">
			'.$selectcode.'
		</select>
	',
    lang('plugin/password', '394'),
    lang('plugin/password', '395'),
    lang('plugin/password', '396'),
    lang('plugin/password', '397'),
	cplang('ip'),
));

foreach($logs as $logrow) {
	$log = explode("\t", $logrow);
	if(empty($log[1])) {
		continue;
	}
	$log[1] = dgmdate($log[1], 'y-n-j H:i');
	if(strtolower($log[2]) == strtolower($_G['member']['username'])) {
		$log[2] = "<b>$log[2]</b>";
	}
	$log[5] = $_G['group']['allowviewip'] ? $log[5] : '-';
	showtablerow('', array('class="smallefont"', 'class="smallefont"', 'class="bold"', 'class="smallefont"', 'class="smallefont"'), array(
		$log[1],
		$log[2],
		$log[3],
		$log[4],
        $log[5],
        $log[6],
	));
}
showtablefooter();
function get_log_files($logdir = '', $action = 'action') {
	$dir = opendir($logdir);
	$files = array();
	while($entry = readdir($dir)) {
		$files[] = $entry;
	}
	closedir($dir);

	if($files) {
		sort($files);
		$logfile = $action;
		$logfiles = array();
		$ym = '';
		foreach($files as $file) {
			if(strpos($file, $logfile) !== FALSE) {
				if(substr($file, 0, 6) != $ym) {
					$ym = substr($file, 0, 6);
				}
				$logfiles[$ym][] = $file;
			}
		}
		if($logfiles) {
			$lfs = array();
			foreach($logfiles as $ym => $lf) {
				$lastlogfile = $lf[0];
				unset($lf[0]);
				$lf[] = $lastlogfile;
				$lfs = array_merge($lfs, $lf);
			}
			return $lfs;
		}
		return array();
	}
	return array();
}
?>