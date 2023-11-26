<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: uninstall.php  2019-06  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
    DROP TABLE IF EXISTS `pre_plugin_adv_count`;
EOF;
	runquery($sql);


$finish = TRUE;
?>