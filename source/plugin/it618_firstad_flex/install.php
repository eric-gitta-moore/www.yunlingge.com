<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */
if(!defined('IN_ADMINCP')) exit('Access Denied');
$sql = <<<EOF

DROP TABLE IF EXISTS `pre_it618_firstad_flex_ad`;
CREATE TABLE IF NOT EXISTS `pre_it618_firstad_flex_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `it618_title` varchar(5000) NOT NULL,
  `it618_img` varchar(255) NOT NULL,
  `it618_url` varchar(255) NOT NULL,
  `it618_tip` varchar(1000) NOT NULL,
  `it618_pageurl` varchar(255) NOT NULL,
  `it618_is` int(10) unsigned NOT NULL,
  `it618_orderby` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

EOF;

$sql=str_replace("pre_it618_firstad_flex_ad",DB::table('it618_firstad_flex_ad'),$sql);

runquery($sql);

//DEFAULT CHARSET=gbk;
$finish = TRUE;
?>