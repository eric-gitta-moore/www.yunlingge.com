<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc && plugin by zhanmishu.
 *      Dz盒子www.idzbox.com, use is subject to license terms
 *
 *      Author: zhanmishu.com $
 *    	qq:87883395 $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

C::import('zhanmishu_storage','plugin/zhanmishu_storage/source/class');

$zms_storage = new zhanmishu_storage();

$oss_config = $zms_storage->config;
// $oss_config['OSSAccessKeyId'] ='piFRdJVTShugHat8';
// $oss_config['AccessKeySecret'] ='zlCrKEvHFVDQN09zSo3qAqPbZpdH66';
// $oss_config['host'] ='http://zhanmishu.oss-cn-shenzhen.aliyuncs.com';

$current = $_GET['current'] ? daddslashes($_GET['current']) : 'forum';
$expiretime = TIMESTAMP + 360;
$policy_data = array();
$filepath = $current.'/'.$zms_storage->get_target_dir($current,0);

$policy_data['expiration'] = gmt_iso8601($expiretime);//Fro·m www.ymg 6.com·
$policy_data['conditions'][] = array(0=>'content-length-range', 1=>0, 2=>1048576000);
// $policy_data['conditions'][] = array(0=>'Content-Disposition',1=>'attachment;filename='.$_GET['filename']);
// $policy_data['conditions'][] = array(0=>'starts-with', 1=>'$key', 2=>$filepath);


$data = array();
$data['OSSAccessKeyId'] = $oss_config['OSSAccessKeyId'];
$data['policy'] = base64_encode(json_encode($policy_data));
$data['expire'] = $expiretime;
$data['filepath'] = $filepath;
$data['target_filename'] = $zms_storage->get_target_filename($current,0,'');
$data['host'] = $oss_config['host'];
$data['signature'] = base64_encode(hash_hmac('sha1', $data['policy'], $oss_config['AccessKeySecret'] , true));//生成认证签名

echo json_encode($data);

function gmt_iso8601($time) {
    $dtStr = date("c", $time);
    $mydatetime = new DateTime($dtStr);
    $expiration = $mydatetime->format(DateTime::ISO8601);
    $pos = strpos($expiration, '+');
    $expiration = substr($expiration, 0, $pos);
    return $expiration."Z";
}