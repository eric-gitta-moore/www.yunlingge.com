<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once dirname(__FILE__).'/class/env.class.php';
function execute_sql($sql) {
    $sql = mdown_utils::utf8_to_site_charset($sql);
    runquery($sql);
}
$rscroot = '/source/plugin/mdown/data';
$iconpath = mdown_env::get_plugin_path()."/template/static";
$uid  = $_G['uid'];
$ctime = date('Y-m-d H:i:s');
$table = DB::table('mdown_category');
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `$table` (
`id` int unsigned NOT NULL AUTO_INCREMENT ,
`parent_id` int unsigned NOT NULL DEFAULT '0' ,
`name` varchar(32) NOT NULL DEFAULT '' ,
`displayorder` tinyint(3) unsigned NOT NULL DEFAULT '1' ,
`isdel` tinyint(1) unsigned NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`),
KEY `idx_pid` (`parent_id`),
UNIQUE KEY `uk_name` (`name`)
) ENGINE=MyISAM
EOF;
execute_sql($sql);
$sql = <<<EOF
INSERT IGNORE INTO `$table` (`id`,`parent_id`,`name`) VALUES 
(1,0,'Document'),
(2,0,'Software'),
(3,0,'Font'),
(4,0,'Audio')
EOF;
execute_sql($sql);
$table = DB::table('mdown_resource');
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `$table` (
`id` int unsigned NOT NULL AUTO_INCREMENT ,
`cateid` int unsigned NOT NULL DEFAULT '0' ,
`title` varchar(128) NOT NULL DEFAULT '' ,
`info` text NOT NULL DEFAULT '' ,
`size` varchar(64) NOT NULL DEFAULT '' ,
`icon` varchar(1024) NOT NULL DEFAULT '' ,
`url` varchar(1024) NOT NULL DEFAULT '' ,
`urltype` tinyint(1) unsigned NOT NULL DEFAULT '1' ,
`downnum` int unsigned NOT NULL DEFAULT '0' ,
`credits` int unsigned NOT NULL DEFAULT '0' ,
`status` tinyint(1) unsigned NOT NULL DEFAULT '0' ,
`cuid` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
`ctime` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' ,
`muid` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
`mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`isdel` tinyint(1) unsigned NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`),
KEY `idx_cateid` (`cateid`),
UNIQUE KEY `uk_title` (`title`)
) ENGINE=MyISAM
EOF;
execute_sql($sql);
$sql = <<<EOF
INSERT IGNORE INTO `$table` (`id`,`cateid`,`title`,`info`,`size`,`icon`,`url`,`status`,`cuid`,`ctime`,`muid`) VALUES 
(1,1,'mdown-readme.pdf','mdown-readme.pdf','10 KB','$iconpath/pdf.png','$rscroot/mdown-readme.pdf',1,'$uid','$ctime','$uid')
,(2,1,'robots.txt','robots file of this site','582 B','$iconpath/txt.png','robots.txt',1,'$uid','$ctime','$uid')
,(3,3,'FetteSteinschrift.ttf','Fette Steinschrift Font File','140 KB','$iconpath/ttf.png','static/image/seccode/font/en/FetteSteinschrift.ttf',1,'$uid','$ctime','$uid')
,(4,3,'PilsenPlakat.ttf','PilsenPlakat Font File','33 KB','$iconpath/ttf.png','static/image/seccode/font/en/PilsenPlakat.ttf',1,'$uid','$ctime','$uid')
,(5,4,'pm_1.mp3','pm_1.mp3 Audio File','34 KB','$iconpath/audio.png','static/image/sound/pm_1.mp3',1,'$uid','$ctime','$uid')
,(6,4,'pm_2.mp3','pm_2.mp3 Audio File','78 KB','$iconpath/audio.png','static/image/sound/pm_2.mp3',1,'$uid','$ctime','$uid')
,(7,4,'pm_3.mp3','pm_3.mp3 Audio File','36 KB','$iconpath/audio.png','static/image/sound/pm_3.mp3',1,'$uid','$ctime','$uid')
,(8,1,'flash1.swf','flash1.swf','295 B','$iconpath/flash.png','static/image/seccode/flash/flash1.swf',1,'$uid','$ctime','$uid')
,(9,1,'flash2.swf','flash2.swf','17 KB','$iconpath/flash.png','static/image/seccode/flash/flash2.swf',1,'$uid','$ctime','$uid')
EOF;
execute_sql($sql);
$table = DB::table('mdown_log');
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `$table` (
`id` int unsigned NOT NULL AUTO_INCREMENT ,
`rscid` int unsigned NOT NULL DEFAULT '0' ,
`rsctitle` varchar(64) NOT NULL DEFAULT '' ,
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
`credits` int unsigned NOT NULL DEFAULT '0' ,
`downtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ,
`clientip` varchar(64) NOT NULL DEFAULT '' ,
`extinfo` varchar(1024)  NOT NULL DEFAULT '' ,
PRIMARY KEY (`id`),
UNIQUE KEY `uk_rscid_uid` (`rscid`,`uid`),
KEY `idx_rscid` (`rscid`),
KEY `idx_uid` (`uid`)
) ENGINE=MyISAM
EOF;
execute_sql($sql);
$finish = TRUE;
?>