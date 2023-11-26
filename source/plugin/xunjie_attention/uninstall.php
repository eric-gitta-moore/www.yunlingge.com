<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE cdb_xunjieattention, cdb_xunjieattentionv;

EOF;

runquery($sql);
$finish = true;
?>