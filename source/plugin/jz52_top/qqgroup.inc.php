<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['uid'] && !$_G['cache']['plugin']['jz52_top']['jz52_openlist']){
	showmessage(lang('plugin/jz52_top', 'jz_qqqnoyk'));
}

$types = array();
$newgroup = [];
$tnum = 0;
$ckey = $tkey = 1;
$qqqqrsc = $_G['cache']['plugin']['jz52_top']['jz52_qrsc'];
$qqgroupsm=$_G['cache']['plugin']['jz52_top']['jz52_qqgroupsm'];
$qqqqrlo=$_G['cache']['plugin']['jz52_top']['jz52_qqqqrlo'];
$jz52_qqqqrsm=$_G['cache']['plugin']['jz52_top']['jz52_qqqqrsm'];
$jz52_qqqqrkg=$_G['cache']['plugin']['jz52_top']['jz52_qqqqrkg'];
$qqgroup = explode("\r\n", $_G['cache']['plugin']['jz52_top']['jz52_qqgrouplist']);


if($qqgroup[0]===0) {
	$qqgroup = $newgroup = '';
} else {
	// $newgroup[] =1;
	// var_dump($newgroup);
	// exit();
	
	foreach($qqgroup as $key => $value) {
		$value=explode(':', $value);
		$type = array_shift($value);
		$types[$type] = $type;
		// $arr = $newgroup[$type];
		// $arr[] = $value;
		// array_push($arr,$value);
		// $newgroup[$type] = $arr;
		
		// var_dump($type);//exit();
		
		// $newgroup['$type']['d'] = $value;
		
		// array_push($newgroup,[$type => '']);
		// array_push($newgroup[$type],$value);
		
		// if(empty($newgroup[$type]))$newgroup[$type]=[];
		
		$newgroup[$type][] = $value;
		$qqcount++;
	}//exit;
	unset($value);
	$qqgroup = $newgroup;
	$tnum = count($types);
}


if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0') == true )
{
 // ie 6.0
$jz52ie6 = 1;
}

include_once template('jz52_top:jz_qqq');
?>