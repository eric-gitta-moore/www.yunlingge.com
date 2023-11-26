<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: output.php 1580 2017-08-21 02:43:24Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
if($study_nge['pic_select'] != 1 && $study_nge['pic_way'] == 'flash') {
$study_slide['title_0xcolor'] = $study_nge['pic_color'] ? str_replace('#', '0x', $study_nge['pic_color']) : '0x0099ff';
$study_slide['title_0xbgcolor'] = $study_nge['pic_bgcolor'] ? str_replace('#', '0x', $study_nge['pic_bgcolor']) : '0xFF0000';//from 1314学习网
if($study_slide['title_radio']) {
$flash_pic[pic] = implode('|', $nge_data['content']['image']['new']['pic']);
$flash_pic[text] = implode('|', $nge_data['content']['image']['new']['text']);
$flash_pic[url] = implode('|', $nge_data['content']['image']['new']['url']);
$flash_pic[pic] = str_replace('&', '%26', $flash_pic[pic]);
$flash_pic[text] = str_replace('&quot;', '', $flash_pic[text]);
$flash_pic[text] = str_replace('&', '%26', $flash_pic[text]);
$flash_pic[url] = str_replace('&', '%26', $flash_pic[url]);
}else {
$flash_pic[pic] = implode('|', $nge_data['content']['image']['new']['pic']);
$flash_pic[url] = implode('|', $nge_data['content']['image']['new']['url']);
$flash_pic[pic] = str_replace('&', '%26', $flash_pic[pic]);
$flash_pic[text] = '';
$flash_pic[url] = str_replace('&', '%26', $flash_pic[url]);
}
}
//foreach($nge_data['content']['bottom_avatar'] as $key => $value) {
//    $nge_data['content']['bottom_avatar'][$key] = array_slice($value, 0, 16);
//}
//$nge_data['count']['threads'] = array_slice($nge_data['count']['threads'], 0, 4);
//$nge_data['id']['threads'] = array_slice($nge_data['id']['threads'], 0, 4);
$td_width = 100/$nge_data['count']['threads'];


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: output.php 2022 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。