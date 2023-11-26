<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

global $_G;

$config = $_G['cache']['plugin']['yunling_web_thumb'];
$navtitle = $config['seo_title'];
$metakeywords = $config['seo_keywords'];
$metadescription = $config['seo_description'];

$cdn_url = rtrim($config['cdn_url'],'/') . '/';

$static = $cdn_url.'source/plugin/yunling_web_thumb/static/';

include template('yunling_web_thumb:index');