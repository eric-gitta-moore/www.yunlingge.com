<?php


if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$uid = $_G['uid'];

$set = $_G['cache']['plugin']['dzl8_webmaster'];

$isurl = $set['isurl'];

$jiami = unserialize($set['jiami']);

if (in_array("1",$jiami)) {$set['tname'] = MD5($set['tname']);}
if (in_array("2",$jiami)) {$uids = MD5($uid);}else{$uids = $uid;}
if (in_array("3",$jiami)) {$set['verify'] = MD5($set['verify']);}
if (in_array("4",$jiami)) {$uida = MD5($uid);}else{$uida = $uid;}

$tname = daddslashes($set['tname']).$uids;

$verify = daddslashes($set['verify']).$uida;

function downloadFile($file,$verify){
    $file_name = $file;
    $mime = 'application/force-download';
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private',false);
    header('Content-Type: '.$mime);
    header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
    header('Content-Transfer-Encoding: binary');
    header('Connection: close');
    readfile($file_name); 

    exit($verify);
}

function is_url($str){
    global $_G;
    if ($_G['cache']['plugin']['dzl8_webmaster']['urlkg']) {
        return preg_match("/^http(s?):\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $str);
    }else{
        return true;
    }
}

if($_GET['down']=='yes'){

    downloadFile($tname.".txt",$verify);
}

$name =daddslashes($_POST['name']);

$url = daddslashes($_POST['url']);

$datatime = $_G['timestamp'];

$add = DB::fetch_first("SELECT * FROM ".DB::table('dzl8_webmaster')." WHERE uid=".$uid);

if (submitcheck('next')){

        $isurls = DB::result(DB::query("SELECT count(*) FROM ".DB::table('dzl8_webmaster')." WHERE url = '".$url."'"));

        if ($isurls&&$isurl) {
            showmessage(lang('plugin/dzl8_webmaster', 'congf'), "home.php?mod=spacecp&ac=plugin&id=dzl8_webmaster:url");
        }else{

            if($name&&$url&&is_url($url)){

            $setarr = array('uid' => $uid,'name' => $name,'url' => $url,'datatime' => $datatime,);

            if ($add['uid']) {
                DB::update('dzl8_webmaster',$setarr, "uid='$uid'");
            }else{
                DB::insert('dzl8_webmaster', $setarr, 1);
            }
                showmessage(lang('plugin/dzl8_webmaster', 'save_success'), "home.php?mod=spacecp&ac=plugin&id=dzl8_webmaster:url");

            }else{

                showmessage(lang('plugin/dzl8_webmaster', 'please_a'), "home.php?mod=spacecp&ac=plugin&id=dzl8_webmaster:url");
            }
        }

}
if ($_GET['yz']=='yes'){

    $host = $add[url]."/".$tname.".txt";

    $fp = dfsockopen($host);

    if ($fp == $verify){
        $setarr = array('verify'=>1);
        DB::update('dzl8_webmaster',$setarr, "uid='$uid'");
        showmessage(lang('plugin/dzl8_webmaster', 'y_success'), "home.php?mod=spacecp&ac=plugin&id=dzl8_webmaster:url");
    }else{
        showmessage(lang('plugin/dzl8_webmaster', 'y_sb'), "home.php?mod=spacecp&ac=plugin&id=dzl8_webmaster:url");
    }
}
?>