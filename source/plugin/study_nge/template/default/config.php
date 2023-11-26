<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: config.php 1533 2017-08-21 02:43:24Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
// $nge_config = array();
$nge_config['nge_temp'] = 'nge';
$nge_config['output_file'] = 'output';
// 天气开关
$nge_config['weather_radio'] = '0';
// 快捷方式开关
$nge_config['shotcut_radio'] = '1';
// 附加信息开关
$nge_config['warmprompt_radio'] = '1';
$nge_config['threadcard_select'] = $study_nge['threadcard_select2'];
$nge_config['posts_way'] = $study_nge['posts_way'] ? $study_nge['posts_way'] : '1';
$nge_config['posts_titlecolor'][0] = $study_nge['posts_zytitlecolor'] ? $study_nge['posts_zytitlecolor'] :'#BEE0FB';
$nge_config['posts_infocolor'][0] = $study_nge['posts_zyinfocolor'] ? $study_nge['posts_zyinfocolor'] :'#DEEBFB';
$nge_config['posts_titlecolor'][1] = $study_nge['posts_bytitlecolor'] ? $study_nge['posts_bytitlecolor'] :'#F5BEFB';
$nge_config['posts_infocolor'][1] = $study_nge['posts_byinfocolor'] ? $study_nge['posts_byinfocolor'] :'#FCE2F9';
$nge_config['posts_titlecolor'][2] = $study_nge['posts_thtitlecolor'] ? $study_nge['posts_thtitlecolor'] :'#FBE5BE';
$nge_config['posts_infocolor'][2] = $study_nge['posts_thinfocolor'] ? $study_nge['posts_thinfocolor'] :'#FBF4E5';
$nge_config['posts_show_name'] = explode('|', $study_nge['posts_show_name']);
// 幻灯片宽度
// $study_slide['width'] = $study_nge['pic_thumb_w'] ? $study_nge['pic_thumb_w'] : '300';
// $study_slide['height'] = $study_nge['pic_thumb_h'] ? $study_nge['pic_thumb_h'] : '250';
// $study_slide['height'] -= 1;
$nge_config['common_icon_radio'] = $study_nge['common_icon_radio'];


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: config.php 1975 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。