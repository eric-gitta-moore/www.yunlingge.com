<?php  function debugaddslashes($string, $force = 1) {
	if(is_array($string)) {
		$keys = array_keys($string);
		foreach($keys as $key) {
			$val = $string[$key];
			unset($string[$key]);
			$string[addslashes($key)] = debugaddslashes($val, $force);
		}
	} else {
		$string = addslashes($string);
	}
	return $string;
}
$_GET = debugaddslashes($_GET);  if(empty($_GET['k']) || $_GET['k'] != '5cb7c25d649da864e0587e42cbd11d23') { exit; } ?><style>body,table { font-size:12px; }table { width:90%;border:1px solid gray; }</style><a href="javascript:;" onclick="location.href=location.href">Refresh</a><br />