<?php
/*
Author:讯幻网
Website:www.xhkj5.com
Qq:2444300667
*/
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}

$sql = <<<EOF
DROP TABLE IF EXISTS pre_jzsjiale_seo_alt_keywords;
CREATE TABLE pre_jzsjiale_seo_alt_keywords (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(1024) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
   PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS pre_jzsjiale_seo_alt_settings;
CREATE TABLE pre_jzsjiale_seo_alt_settings (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titlename` varchar(1024) DEFAULT NULL,
  `isopen` int(11) DEFAULT NULL,
  `targets` varchar(1024) DEFAULT NULL,
  `huifu` int(11) DEFAULT NULL,
  `alt` varchar(1024) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `isoverridealt` int(11) DEFAULT NULL,
  `isoverridetitle` int(11) DEFAULT NULL,
  `istags` int(11) DEFAULT NULL,
  `fids` varchar(1024) DEFAULT NULL,
  `usergroup` varchar(1024) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
EOF;
runquery ( $sql );


$pluginid = 'jzsjiale_seo_alt';

// 请根据您的实际需要增减下方的嵌入点
$Hooks = array (
	'viewthread_variables'
);

$data = array ();
foreach ( $Hooks as $Hook ) {
	$data [] = array (
		$Hook => array (
			'plugin' => $pluginid,
			'include' => 'api.class.php',
			'class' => $pluginid . '_api',
			'method' => $Hook
		)
	);
}

require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
WeChatHook::updateAPIHook($data);

$finish = TRUE;

