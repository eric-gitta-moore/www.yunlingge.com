<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yunling_remove_mobilejq
{
    public function common()
    {
//        return;
        global $_G;
        $html = '<script src="[^"]*?' . STATICURL . 'js/mobile/jquery\.min\.js\?' . $_G['style']['verhash'] . '"[^>]*?></script>';

//        var_dump($html,VERHASH,$_G['style']['verhash']);
//        exit();
//        var_dump($html);
//        exit();

        $_G['setting']['output']['preg']['search']['yunling_remove_mobilejq'] = '#' . $html . '#';
        $_G['setting']['output']['preg']['replace']['yunling_remove_mobilejq'] = '\'\'';

//        var_dump(STATICURL,VERHASH);
//        exit();

    }
}