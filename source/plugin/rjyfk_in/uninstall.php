<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS pre_rjy_inlog;
EOF;
runquery($sql);
$finish = TRUE;