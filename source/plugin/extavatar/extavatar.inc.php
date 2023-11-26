<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__)."/class/env.class.php";
$uid = isset($_GET['uid']) ? $_GET['uid'] : 0;
$size = isset($_GET['size']) ? $_GET['size'] : 'middle';
$userInfo = C::t('common_member')->fetch_all_username_by_uid($uid);
if (empty($userInfo)) {
    die(0);
}
$text = mb_substr($userInfo[$uid], 0, 1, CHARSET);  
if ($text>='a' && $text<='z') {
    $text = strtoupper($text);
}
showimg($uid,$text,$size);
function showimg($uid,$text,$size='middle')
{
    $fontFile = dirname(__FILE__)."/data/fonts/msyh.ttf";
    $bgcolors = array(
        array(102,153,102), array(51,153,255), array(255,152,0), array(6,176,197), array(247,105,95),
        array(188,101,204), array(115,65,204), array(148,102,86), array(193,175,17), array(8,109,158),
    );
    $sizeConf = array (
        'small' => array('piclen'=>200,'fontsize'=>100),
        'middle' => array('piclen'=>200,'fontsize'=>100)
    );
    $conf = isset($sizeConf[$size]) ? $sizeConf[$size] : $sizeConf['middle'];
    $bgcolor = $bgcolors[$uid % count($bgcolors)];
	$width = $conf['piclen'];
	$height = $conf['piclen'];
	$img = imagecreatetruecolor($width,$height);
	$color = imagecolorAllocate($img,$bgcolor[0],$bgcolor[1],$bgcolor[2]);
	imagefill($img,0,0,$color);
    $fontColor = 0xffffff;
    $fontSize = $conf['fontsize'];
    $a = imagettfbbox($fontSize, 0, $fontFile, $text);
    $fontW = $a[2] - $a[0]; 
    $fontH = $a[1] - $a[7]; 
    $fx = ($width-$fontW)/2;
    $fy = ($height+$fontH-40)/2;
    if ($text>='A' && $text<='Z') {
        $fontSize *= 1.1;
        $fx -= 10;
        $fy = ($height+$fontH)/2;
    }
    imagefttext($img, $fontSize , 0, $fx, $fy, $fontColor, $fontFile, $text);
    if (function_exists("imagepng")) {
        header('Content-type: image/png');
        imagepng($img);
    } else {
        header('content-type:image/jpeg');
        imagejpeg($img);
    }
    imagedestroy($img);
}