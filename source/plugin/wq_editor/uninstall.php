<?php

/**
 * ά�� [ Discuz!Ӧ��ר�ң�������ά�廥���Ƽ����޹�˾����Discuz!�����Ŷ� ]
 *
 * Copyright (c) 2011-2099 http://www.wikin.cn All rights reserved.
 *
 * Author: wikin <wikin@wikin.cn>
 *
 * $Id: uninstall.php 2015-5-29 20:38:48Z $
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$wq_editor = DB::table('wq_editor');
$sql = <<<EOF
DROP TABLE IF EXISTS `{$wq_editor}`;
EOF;

runquery($sql);

$finish = TRUE;
?>