<?php

/**
 * ά�� [ Discuz!Ӧ��ר�ң�������ά�廥���Ƽ����޹�˾����Discuz!�����Ŷ� ]
 *
 * Copyright (c) 2011-2099 http://www.wikin.cn All rights reserved.
 *
 * Author: wikin <wikin@wikin.cn>
 *
 * $Id: config.php 2015-5-29 20:38:48Z $
 */
$setting = $_G['cache']['plugin']['wq_editor']; 


include_once DISCUZ_ROOT . './source/plugin/wq_editor/function/function_common.php';
include_once DISCUZ_ROOT . './source/plugin/wq_editor/function/function_editor.php';

$langfile = DISCUZ_ROOT . './source/plugin/wq_editor/language/language.' . currentlang() . '.php';
$includefile = is_file($langfile) ? $langfile : libfile('language', 'plugin/wq_editor/language');

include_once $includefile;
?>