<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc && plugin by zhanmishu.
 *      DzºÐ×Ówww.idzbox.com, use is subject to license terms
 *
 *      Author: zhanmishu.com $
 *      qq:87883395 $
 */


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
C::import('zhanmishu_storage','plugin/zhanmishu_storage/source/class');
include_once DISCUZ_ROOT.'source/plugin/zhanmishu_storage/source/Autoloader.php';

$zhanmishu_storage = new zhanmishu_storage();


$tableid = $_GET['tableid'] ? $_GET['tableid'] + 0 : '0';


if (!$_GET['attach_num']) {
    $attach_num = $zhanmishu_storage->get_type_attachment_num($tableid,array('remote'=>'1'));
}else{
    $attach_num = $_GET['attach_num'] + 0;
}
$perpage=200;
$curpage = ($_GET['page'] + 0) > 0 ? ($_GET['page'] + 0) : 1;
$mpurl=ADMINSCRIPT.'?action=plugins&operation=config&do=5&identifier=zhanmishu_storage&pmod=update_acl';
$pages= ceil($attach_num / $perpage);
$start = $attach_num - ($attach_num - $perpage*$curpage+$perpage);


if ($_GET['formhash'] == formhash()) {
    if ($attach_num > 0) {
        $attachs = $zhanmishu_storage->get_type_attachment($tableid,$start, $perpage, 'desc','',array('remote'=>'1'));
        if (!empty($attachs)) {
            foreach ($attachs as $key => $value) {
                if ($value['isimage']) {
                    $file = 'forum/'.$value['attachment'];
                    $rs = $zhanmishu_storage->set_remote_file_acl($file);
                }
            }
            $current = 'forum_attachment_'.$tableid.'---step:'.$page.'('.$perpage.')';
            ++$page;
            $next =  'forum_attachment_'.$tableid.'---step:'.$page.'('.$perpage.')';
            cpmsg(lang('plugin/zhanmishu_storage','auto_acl').cplang('counter_processing', array('current' => $current, 'next' => $next)), 'action=plugins&operation=config&do=5&identifier=zhanmishu_storage&pmod=update_acl&tableid='.$tableid.'&page='.$page.'&attach_num='.$attach_num.'&formhash='.FORMHASH, 'loading');
        }
    }

    if ($tableid < 9) {
        $current = 'forum_attachment_'.$tableid.'---step:'.$page.'('.$perpage.')';
        $page = 0;
        ++$tableid;
        $next = 'forum_attachment_'.$tableid.'---step:'.$page.'('.$perpage.')';
        cpmsg(lang('plugin/zhanmishu_storage','auto_acl').cplang('counter_processing', array('current' => $current, 'next' => $next)), 'action=plugins&operation=config&do=5&identifier=zhanmishu_storage&pmod=update_acl&tableid='.$tableid.'&page='.$page.'&attach_num='.$attach_num.'&formhash='.FORMHASH, 'loading');
    }

        cpmsg(lang('plugin/zhanmishu_storage','success'),'action=plugins&operation=config&do=5&identifier=zhanmishu_storage&pmod=update_acl');
}

cpmsg("<label for=\"blockclasscache\">".lang('plugin/zhanmishu_storage','auto_acl').'</label>', 'action=plugins&operation=config&do=5&identifier=zhanmishu_storage&pmod=update_acl', 'form', '', FALSE);


?>