<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
CREATE TABLE `pre_dc_vip` (
  `uid` int(11) NOT NULL,
  `jointime` int(11) DEFAULT NULL,
  `exptime` int(11) DEFAULT NULL,
  `isyear` tinyint(1) DEFAULT NULL,
  `vgid` tinyint(4) DEFAULT NULL,
  `growth` int(11) DEFAULT NULL,
  `uptime` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
);
CREATE TABLE `pre_dc_vip_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grouptitle` varchar(45) DEFAULT NULL,
  `growthlower` int(11) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `allow` text,
  `hook` text,
  PRIMARY KEY (`id`)
);
EOF;
runquery($sql);
$data = array(
	array('id'=>1,'grouptitle'=>'VIP1','growthlower'=>0,'color'=>'#FF0000','icon'=>'vip1.gif','allow'=>'s:0:"";','hook'=>'s:0:"";'),
	array('id'=>2,'grouptitle'=>'VIP2','growthlower'=>600,'color'=>'#FF0000','icon'=>'vip2.gif','allow'=>'s:0:"";','hook'=>'s:0:"";'),
	array('id'=>3,'grouptitle'=>'VIP3','growthlower'=>1800,'color'=>'#FF0000','icon'=>'vip3.gif','allow'=>'s:0:"";','hook'=>'s:0:"";'),
	array('id'=>4,'grouptitle'=>'VIP4','growthlower'=>3600,'color'=>'#FF0000','icon'=>'vip4.gif','allow'=>'s:0:"";','hook'=>'s:0:"";'),
	array('id'=>5,'grouptitle'=>'VIP5','growthlower'=>6000,'color'=>'#FF0000','icon'=>'vip5.gif','allow'=>'s:0:"";','hook'=>'s:0:"";'),
	array('id'=>6,'grouptitle'=>'VIP6','growthlower'=>10800,'color'=>'#FF0000','icon'=>'vip6.gif','allow'=>'s:0:"";','hook'=>'s:0:"";'),
);
foreach($data as $d){
	C::t('#dc_vip#dc_vip_group')->insert($d);
}
$finish = TRUE;
?>