<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$addtime = $modtime = date('Y-m-d H:i:s');
$table = DB::table('extavatar');
$sql = "CREATE TABLE IF NOT EXISTS $table ". <<<EOF
(
`id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '',
`imgurl_small` varchar(1024) NOT NULL DEFAULT '' COMMENT '',
`imgurl_middle` varchar(1024) NOT NULL DEFAULT '' COMMENT '',
`imgurl_big` varchar(1024) NOT NULL DEFAULT '' COMMENT '',
`enable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '',
`uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '',
`ctime` datetime NOT NULL DEFAULT "0000-00-00 00:00:00" comment '',
`mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '',
`isdel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '',
PRIMARY KEY (`id`),
KEY `idx_uid` (`uid`)
) ENGINE=MyISAM 
EOF;
runquery($sql);
$avatarPath = 'source/plugin/extavatar/data/avatars';
$sql=<<<EOF
INSERT IGNORE INTO $table 
(id,imgurl_small,imgurl_middle,imgurl_big,enable,uid,ctime) 
VALUES 
(1,'$avatarPath/avatar_01_small.jpg','$avatarPath/avatar_01_middle.jpg','$avatarPath/avatar_01_big.jpg',1,0,'$addtime')
,(2,'$avatarPath/avatar_02_small.jpg','$avatarPath/avatar_02_middle.jpg','$avatarPath/avatar_02_big.jpg',1,0,'$addtime')
,(3,'$avatarPath/avatar_03_small.jpg','$avatarPath/avatar_03_middle.jpg','$avatarPath/avatar_03_big.jpg',1,0,'$addtime')
,(4,'$avatarPath/avatar_04_small.jpg','$avatarPath/avatar_04_middle.jpg','$avatarPath/avatar_04_big.jpg',1,0,'$addtime')
,(5,'$avatarPath/avatar_05_small.jpg','$avatarPath/avatar_05_middle.jpg','$avatarPath/avatar_05_big.jpg',1,0,'$addtime')
,(6,'$avatarPath/avatar_06_small.jpg','$avatarPath/avatar_06_middle.jpg','$avatarPath/avatar_06_big.jpg',1,0,'$addtime')
,(7,'$avatarPath/avatar_07_small.jpg','$avatarPath/avatar_07_middle.jpg','$avatarPath/avatar_07_big.jpg',1,0,'$addtime')
,(8,'$avatarPath/avatar_08_small.jpg','$avatarPath/avatar_08_middle.jpg','$avatarPath/avatar_08_big.jpg',1,0,'$addtime')
,(9,'$avatarPath/avatar_09_small.jpg','$avatarPath/avatar_09_middle.jpg','$avatarPath/avatar_09_big.jpg',1,0,'$addtime')
,(10,'$avatarPath/avatar_10_small.jpg','$avatarPath/avatar_10_middle.jpg','$avatarPath/avatar_10_big.jpg',1,0,'$addtime')
,(11,'$avatarPath/avatar_11_small.jpg','$avatarPath/avatar_11_middle.jpg','$avatarPath/avatar_11_big.jpg',1,0,'$addtime')
,(12,'$avatarPath/avatar_12_small.jpg','$avatarPath/avatar_12_middle.jpg','$avatarPath/avatar_12_big.jpg',1,0,'$addtime')
,(13,'$avatarPath/avatar_13_small.jpg','$avatarPath/avatar_13_middle.jpg','$avatarPath/avatar_13_big.jpg',1,0,'$addtime')
,(14,'$avatarPath/avatar_14_small.jpg','$avatarPath/avatar_14_middle.jpg','$avatarPath/avatar_14_big.jpg',1,0,'$addtime')
,(15,'$avatarPath/avatar_15_small.jpg','$avatarPath/avatar_15_middle.jpg','$avatarPath/avatar_15_big.jpg',1,0,'$addtime')
,(16,'$avatarPath/avatar_16_small.jpg','$avatarPath/avatar_16_middle.jpg','$avatarPath/avatar_16_big.jpg',1,0,'$addtime')
,(17,'$avatarPath/avatar_17_small.jpg','$avatarPath/avatar_17_middle.jpg','$avatarPath/avatar_17_big.jpg',1,0,'$addtime')
,(18,'$avatarPath/avatar_18_small.jpg','$avatarPath/avatar_18_middle.jpg','$avatarPath/avatar_18_big.jpg',1,0,'$addtime')
,(19,'$avatarPath/avatar_19_small.jpg','$avatarPath/avatar_19_middle.jpg','$avatarPath/avatar_19_big.jpg',1,0,'$addtime')
,(20,'$avatarPath/avatar_20_small.jpg','$avatarPath/avatar_20_middle.jpg','$avatarPath/avatar_20_big.jpg',1,0,'$addtime')
EOF;
runquery($sql);
$finish = TRUE;
?>