<?php
 /**
 * Created by DisM.
 * User: DisM!应用中心
 * From: DisM.taobao.Com
 * Time: 2019-10-11
 */
if (! defined ('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit ('Access Denied');
}

$addonid = $pluginarray['plugin']['identifier'].'.plugin';
$array = cloudaddons_getmd5($addonid);
if(cloudaddons_open('&mod=app&ac=validator&ver=2&addonid='.$addonid.($array !== false ? '&rid='.$array['RevisionID'].'&sn='.$array['SN'].'&rd='.$array['RevisionDateline'] : '')) === '0') {
}