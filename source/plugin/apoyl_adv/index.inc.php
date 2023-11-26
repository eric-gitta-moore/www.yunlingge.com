<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: index.inc.php  2019-06  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
$ctid=intval($_GET['ctid']);

if($ctid<=0) showmessage(lang('plugin/apoyl_adv','paramserr'));
$referer=dreferer();
if(strpos($referer,'./')||empty($referer)){
    showmessage(lang('plugin/apoyl_adv','srcerr'));
}else{
    $a=parse_url($referer);
    $b=parse_url($_G['siteurl']);
    if($a['host']!=$b['host']) showmessage(lang('plugin/apoyl_adv','srcerr'));
}

$arr=C::t('#apoyl_adv#adv_count')->fetch($ctid);
if(!$arr||!preg_match('/^(http|https):\/\/.*/is',$arr['url'])) showmessage(lang('plugin/apoyl_adv','urlerr'));

if($arr){
    
    $data=array(
        'pvcount'=>$arr['pvcount']+1,
        'modtime'=>TIMESTAMP
    );
    C::t('#apoyl_adv#adv_count')->update($data,$ctid);
}

header('location:'.$arr['url']);
exit;

?>