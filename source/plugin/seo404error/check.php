<?php
/*
购买的仅是QQ:210667808所发布插件的使用权，并非拥有权。
请勿传播、转卖、公开、修改本插件，否则一切后果作者概不负责。
*/
defined('IN_DISCUZ') && defined('IN_ADMINCP') or exit('Access Denied');
$addonid = 'seo404error.plugin';
$array = cloudaddons_getmd5($addonid);
if(empty($array) || cloudaddons_open('&mod=app&ac=validator&addonid='.$addonid.'&rid='.$array['RevisionID'].'&sn='.$array['SN'].'&rd='.$array['RevisionDateline']) === '0'){
	cloudaddons_deltree(DISCUZ_ROOT.'./source/plugin/seo404error/');
	cpmsg('cloudaddons_genuine_message', 'https://addon.dismall.com/?@seo404error.plugin', 'error', array('addonid' => $addonid));
}