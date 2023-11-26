<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

global $_G;
$config = $_G['cache']['plugin']['yunling_online_ps'];

$title = $config['title'];
$desc = $config['desc'];
$keywords = $config['keywords'];
$cdn = rtrim($config['cdn'],'/') . '/';

$static = $cdn.'source/plugin/yunling_online_ps/static';

include template('yunling_online_ps:index');