<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function getmode($tid, $pid, $title, $msg)
{
    global $_G;
    $exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];
    return baiduKeyword($tid, $pid, $title, $msg);
}


function baiduKeyword($tid, $pid, $title, $msg)
{
    global $_G;
    $exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];


    $w = dfsockopen('https://m.baidu.com/s?word=' . urlencode($title) . '&ie=utf-8',0,'',$exx_tagseo['cookie']);
//    var_dump($w);exit();

	if (empty($w))return 'open url failed';

    preg_match_all('/<div id="relativewords"([\s\S]+)<div id="page-controller"/i', $w, $con);

//    var_dump($con);
    $list = $con[1][0];
    preg_match_all('#<!----><span[ \w\d-]+>([^<]+)</span><!----><!----></a>#Ui', $list, $content);
//    var_dump($content);
//    exit();
    if ($exx_tagseo['sl']) {
        $content[1] = array_slice($content[1], 0, $exx_tagseo['sl']);
    }
    $result = implode(",", $content[1]);
//    var_dump($result);

    $result = diconv($result, 'UTF-8', CHARSET);
    $return = settag($tid, $pid, $result);
	return $return;

}

function settag($tid, $pid, $result)
{
//    var_dump($result);
//    exit();
    $newtagclass = new tag();
    $tags = $newtagclass->add_tag($result, $tid, 'tid');
//    var_dump($tags);
//    exit();
//    return $tags;
    if ($result) {
        loadcache('censor');
        C::t('forum_post')->update('tid:' . $tid, $pid, array(
            'tags' => $tags,
        ));
    }
    if ($tags) {
        $tagarray = explode("\t", $tags);
        if ($tagarray) {
            foreach ($tagarray as $v) {
                if ($v) {
                    $tag = explode(',', $v);
                    $ptag_array[] = $tag;
                }
            }
        }
    }

    return $ptag_array;

}