<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: thumb.inc.php 2662 2020-01-02 21:00:08
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if (!defined('IN_DISCUZ')) {
exit('http://www.yun-ling.cn/');
}
$splugin_setting = $_G['cache']['plugin']['study_list_thumb'];# http://suo.im/5qyxLj
$dw = $splugin_setting['pic_thumb_w'] ? $splugin_setting['pic_thumb_w'] : '100';
$dh = $splugin_setting['pic_thumb_h'] ? $splugin_setting['pic_thumb_h'] : '100';//27277
$pic_num = intval($splugin_setting['pic_num']);/*���棺 http://t.cn/hbdjxV*/
empty($pic_num) && $pic_num = '5';
$tid = intval($_GET['tid']);
$tableid = getattachtableid($tid);
$query = DB::query("SELECT * FROM " . DB::table('forum_attachment_'.$tableid)." WHERE tid ='$tid' LIMIT $pic_num");
while ($attach = DB::fetch($query)) {
$attachlist[$attach[aid]] = $attach;
}
if($attachlist){
$parse = parse_url($_G['setting']['attachurl']);
$attachurl = !isset($parse['host']) ? $_G['siteurl'].$_G['setting']['attachurl'] :$_G['setting']['attachurl'];
if($splugin_setting['thumb_radio']){
$thumbtype = 'fixwr';
//����ͼ����
$_G['setting']['thumbquality'] = $splugin_setting['pic_thumb_quality'] ? $splugin_setting['pic_thumb_quality'] : '100';
			require_once libfile('class/image');
			$img = new image;
			foreach($attachlist as $aid => $attach){
					if($attach['remote']) {
						$filename = $_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'];
					} else {
						$filename = $_G['setting']['attachurl'].'forum/'.$attach['attachment'];
					}
					$thumbfile = 'study_list_thumb/www.1314study.com_'.$attach['aid'].'.jpg';
					if(file_exists($_G['setting']['attachdir'].$thumbfile)) {
						$attachlist[$aid]['attachment'] = $attachurl.$thumbfile;
					}else{
						if($img->Thumb($filename, $thumbfile, $dw, $dh, $thumbtype)) {
							$attachlist[$aid]['attachment'] = $attachurl.$thumbfile;
						}else{
							$attachlist[$aid]['attachment'] = 'source/plugin/study_list_thumb/images/thumb.png';
						}
					}
			}
	}else{
			foreach($attachlist as $aid => $attach){
					if($attach['remote']) {
						$attachlist[$aid]['attachment'] = $_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'];
					} else {
						$attachlist[$aid]['attachment'] = $_G['setting']['attachurl'].'forum/'.$attach['attachment'];
					}
			}
			
			if($splugin_setting['only_limit_height']){
				$dw = 'auto';
			}
	}
}else{
	$dw = '200';
	$dh = '100';
	$attachlist[0]['attachment'] = 'source/plugin/study_list_thumb/images/thumb.png';
}

$thumb_bgcolor = $splugin_setting['thumb_bgcolor'] ? $splugin_setting['thumb_bgcolor'] : '#FFFFFF';
$thumb_padding = $splugin_setting['thumb_padding'] ? $splugin_setting['thumb_padding'] : '5';
include template('study_list_thumb:thumb');

//Copyright 2001-2099 .1314.ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: thumb.inc.php 3123 2020-01-02 13:00:08
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue ������ http://t.cn/EUPqQW1��
//Ӧ����ǰ��ѯ��QQ 15.3269.40
//Ӧ�ö��ƿ�����QQ 643.306.797
//�����Ϊ 131.4ѧϰ����www.1314Study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��