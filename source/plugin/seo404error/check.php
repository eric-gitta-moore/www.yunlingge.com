<?php
/*
����Ľ���QQ:210667808�����������ʹ��Ȩ������ӵ��Ȩ��
���𴫲���ת�����������޸ı����������һ�к�����߸Ų�����
*/
defined('IN_DISCUZ') && defined('IN_ADMINCP') or exit('Access Denied');
$addonid = 'seo404error.plugin';
$array = cloudaddons_getmd5($addonid);
if(empty($array) || cloudaddons_open('&mod=app&ac=validator&addonid='.$addonid.'&rid='.$array['RevisionID'].'&sn='.$array['SN'].'&rd='.$array['RevisionDateline']) === '0'){
	cloudaddons_deltree(DISCUZ_ROOT.'./source/plugin/seo404error/');
	cpmsg('cloudaddons_genuine_message', 'https://addon.dismall.com/?@seo404error.plugin', 'error', array('addonid' => $addonid));
}