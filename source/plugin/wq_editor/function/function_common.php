<?php

/**
 * ά�� [ Discuz!Ӧ��ר�ң�������ά�廥���Ƽ����޹�˾����Discuz!�����Ŷ� ]
 *
 * Copyright (c) 2011-2099 http://www.wikin.cn All rights reserved.
 *
 * Author: wikin <wikin@wikin.cn>
 *
 * $Id: function_common.php 2015-5-29 20:38:48Z $
 */
if (!function_exists('currentlang')) {

	function currentlang() {
		$charset = strtoupper(CHARSET);
		if ($charset == 'GBK') {
			return 'SC_GBK';
		} elseif ($charset == 'BIG5') {
			return 'TC_BIG5';
		} elseif ($charset == 'UTF-8') {
			global $_G;
			if ($_G['config']['output']['language'] == 'zh_cn') {
				return 'SC_UTF8';
			} elseif ($_G['config']['output']['language'] == 'zh_tw') {
				return 'TC_UTF8';
			}
		} else {
			return '';
		}
	}

}
?>