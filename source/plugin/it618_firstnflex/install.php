<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 8889 2010-04-23 07:48:22Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = str_replace("\r\n", "\n", str_replace("pre_common_block",DB::table('common_block'),lang('plugin/it618_firstnflex', 'it618_sql')));

runquery($sql);

//DEFAULT CHARSET=gbk;
$finish = TRUE;

?>