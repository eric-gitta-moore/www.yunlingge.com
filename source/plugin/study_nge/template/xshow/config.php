<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: config.php 421 2017-08-21 02:43:24Z zhuge $
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
$nge_config['nge_temp'] = 'xshow';
$nge_config['output_file'] = 'output';
// 帖子右侧信息开关study
$nge_config['tiezi_right_radio'] = '1';
// 幻灯片宽度1314
// $study_slide['width'] = '230';
$study_slide['height'] = $thread_num * 25;
$nge_config['threadcard_select'] = $study_nge['threadcard_select2'];
$nge_config['td_row'] = '30%';


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: config.php 862 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。