<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
$table = C::t('forum_bbcode')->getTable();
$edit = DB::fetch_first('SELECT * FROM '.DB::table($table).' WHERE '.DB::field('tag', 'glow'));
if(!empty($edit)){
    C::t('forum_bbcode')->delete($edit['id']);
    updatecache(array('bbcodes', 'bbcodes_display'));
}
$finish = TRUE;
