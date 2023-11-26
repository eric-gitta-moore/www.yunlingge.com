<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
define('P_NAME', 'plugin/boan_glow');
$table = C::t('forum_bbcode')->getTable();
$edit = DB::fetch_first('SELECT * FROM '.DB::table($table).' WHERE '.DB::field('tag', 'glow'));
if(empty($edit)) {
        $data = array('tag'=>'glow', 
        'replacement'=>'<span style="display:inline-block;text-shadow:1px 0 4px {1},0 1px 4px {1},0 -1px 4px {1},-1px 0 4px {1};filter:glow(color={1},strength=3)" >{2}</span>', 
        'example'=>'[glow='.lang(P_NAME, 'color_value').']'.lang(P_NAME, 'glow_hint').'[/glow]', 
        'explanation'=>lang(P_NAME, 'glow_text'), 
        'available'=>1,
        'params'=>2, 
        'prompt'=>'', 
        'nest'=>3, 
        'perm'=>'');
    C::t('forum_bbcode')->insert($data);
    updatecache(array('bbcodes', 'bbcodes_display'));
}
$finish = TRUE;