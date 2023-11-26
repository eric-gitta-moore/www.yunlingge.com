<?php

//cronname:zhiwu55com_autoreply
//week:
//day:
//hour:
//minute:0,5,10,15,20,25,30,35,40,45,50,55

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');
}
$cronUrl = $_G['siteurl'] . 'plugin.php?id=zhiwu55com_autoreply:hzw_cron';
dfsockopen($cronUrl);

?>