<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

global $_G;
$config = $_G['cache']['plugin']['yunling_code'];

$navtitle = $config['title'];
$metakeywords = $config['desc'];
$metadescription = $config['keywords'];

$width = $config['width'];
$height = $config['height'];
$cdn = rtrim($config['cdn'],'/') . '/';

$static = $cdn.'source/plugin/yunling_code/static';


include template('yunling_code:iframe');