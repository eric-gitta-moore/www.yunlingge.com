<?php

/**
 *      $author: ณหมน $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
define('IDENTIFIER','vipvideo');
//$lockfile = DISCUZ_ROOT.'./source/plugin/'.IDENTIFIER.'/install.lock';
//if(!file_exists($lockfile)) {

$sql = <<<EOF

DROP TABLE IF EXISTS `cdb_plugin_vipvideo_interface`;
CREATE TABLE `cdb_plugin_vipvideo_interface` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` mediumint(8) NOT NULL DEFAULT 0,
  `name` varchar(32) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `postip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `cdb_plugin_vipvideo_record`;
CREATE TABLE `cdb_plugin_vipvideo_record` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL DEFAULT 0,
  `username` varchar(32) NOT NULL DEFAULT '',
  `linkurl` varchar(255) NOT NULL DEFAULT '',
  `credit_item` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `credit_num` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `postip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

EOF;

runquery($sql);

$video_interface = lang('plugin/'.IDENTIFIER, 'video_interface');
foreach ($video_interface as $key => $value) {
	$data = array(
		'displayorder' => $key,
		'name' => $value['name'],
		'url' => $value['url'],
		'status' => 1,
		'createtime' => $_G['timestamp'],
		'postip' => $_G['clientip'],
	);
	C::t('#'.IDENTIFIER.'#vipvideo_interface')->insert($data);
}

updatecache('vipvideo:interface');
//@touch($lockfile);

//}

$finish = TRUE;

?>