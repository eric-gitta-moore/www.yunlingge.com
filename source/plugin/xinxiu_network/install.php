<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/12
 * Time: 10:29
 */

if (!defined('IN_DISCUZ')) {//判断是否在discuz环境中
    exit('Access Denied');
}
if (!defined('IN_ADMINCP')) {//判断是否在discuz管理员环境中
    exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_xinxiu_network_jiaoyi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `typeid` smallint(6) unsigned NOT NULL DEFAULT '1' COMMENT '分类id',
  `maketype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提交方法',
  `makeruid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '提交uid',
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '交易面值',
  `extcreditskey` tinyint(1) NOT NULL DEFAULT '0' COMMENT '积分种类',
  `extcreditsval` int(10) NOT NULL DEFAULT '0' COMMENT '积分值',
  `status` tinyint(1) unsigned NOT NULL COMMENT '交易动作',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  `cleardateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `useddateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '交易时间',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '购买者uid',
  PRIMARY KEY (`id`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `pre_xinxiu_network_log` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uid` smallint(5) unsigned NOT NULL,
  `apikey` char(50) DEFAULT NULL,
  `isapi` char(50) DEFAULT NULL,
  `action` char(50) DEFAULT NULL,
  `errcode` int(3) unsigned DEFAULT NULL,
  `isget` text,
  `ispost` text,
  `time` int(10) unsigned DEFAULT NULL,
  `fromip` char(40) DEFAULT NULL,
  `output` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `pre_xinxiu_network_member` (
  `uid` mediumint(8) unsigned NOT NULL,
  `realname` varchar(255) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `birthyear` smallint(6) unsigned NOT NULL DEFAULT '0',
  `birthmonth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `birthday` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `constellation` varchar(255) NOT NULL DEFAULT '',
  `zodiac` varchar(255) NOT NULL DEFAULT '',
  `telephone` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `idcardtype` varchar(255) NOT NULL DEFAULT '',
  `idcard` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `zipcode` varchar(255) NOT NULL DEFAULT '',
  `nationality` varchar(255) NOT NULL DEFAULT '',
  `birthprovince` varchar(255) NOT NULL DEFAULT '',
  `birthcity` varchar(255) NOT NULL DEFAULT '',
  `birthdist` varchar(20) NOT NULL DEFAULT '',
  `birthcommunity` varchar(255) NOT NULL DEFAULT '',
  `resideprovince` varchar(255) NOT NULL DEFAULT '',
  `residecity` varchar(255) NOT NULL DEFAULT '',
  `residedist` varchar(20) NOT NULL DEFAULT '',
  `residecommunity` varchar(255) NOT NULL DEFAULT '',
  `residesuite` varchar(255) NOT NULL DEFAULT '',
  `graduateschool` varchar(255) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `education` varchar(255) NOT NULL DEFAULT '',
  `occupation` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `revenue` varchar(255) NOT NULL DEFAULT '',
  `affectivestatus` varchar(255) NOT NULL DEFAULT '',
  `lookingfor` varchar(255) NOT NULL DEFAULT '',
  `bloodtype` varchar(255) NOT NULL DEFAULT '',
  `height` varchar(255) NOT NULL DEFAULT '',
  `weight` varchar(255) NOT NULL DEFAULT '',
  `alipay` varchar(255) NOT NULL DEFAULT '',
  `icq` varchar(255) NOT NULL DEFAULT '',
  `qq` varchar(255) NOT NULL DEFAULT '',
  `yahoo` varchar(255) NOT NULL DEFAULT '',
  `msn` varchar(255) NOT NULL DEFAULT '',
  `taobao` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '提现姓名',
  `bank` varchar(255) NOT NULL COMMENT '银行及支行',
  `card` varchar(255) NOT NULL COMMENT '银行卡号',
  `field1` text NOT NULL,
  `field2` text NOT NULL,
  `field3` text NOT NULL,
  `field4` text NOT NULL,
  `field5` text NOT NULL,
  `field6` text NOT NULL,
  `field7` text NOT NULL,
  `field8` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `pre_xinxiu_network_tixian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `typeid` smallint(6) unsigned NOT NULL DEFAULT '1' COMMENT '分类id',
  `maketype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提交方法',
  `makeruid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '提交uid',
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '交易面值',
  `extcreditskey` tinyint(1) NOT NULL DEFAULT '0' COMMENT '积分种类',
  `extcreditsval` int(10) NOT NULL DEFAULT '0' COMMENT '积分值',
  `status` tinyint(1) unsigned NOT NULL COMMENT '交易动作',
  `uiddate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  `uidtext` text NOT NULL COMMENT '提现备注',
  `admindateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '交易时间',
  `admintext` varchar(255) NOT NULL COMMENT '处理备注',
  PRIMARY KEY (`id`),
  KEY `dateline` (`uiddate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `pre_xinxiu_network_token` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned DEFAULT NULL,
  `username` char(15) DEFAULT NULL,
  `ip1` tinyint(3) unsigned DEFAULT NULL,
  `ip2` tinyint(3) unsigned DEFAULT NULL,
  `ip3` tinyint(3) unsigned DEFAULT NULL,
  `ip4` tinyint(3) unsigned DEFAULT NULL,
  `groupid` tinyint(3) unsigned DEFAULT NULL COMMENT '会员组id',
  `adminid` tinyint(3) unsigned DEFAULT NULL COMMENT '管理组id',
  `token` varchar(1000) DEFAULT NULL COMMENT '验证token',
  `lastactivity` int(10) unsigned DEFAULT NULL COMMENT '最后活动时间',
  `loginint` int(10) unsigned NOT NULL COMMENT '登录次数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;


EOF;

runquery($sql);

$finish = TRUE;

?>