<?php

/**
 * Copyright 2001-2099 1314ѧϰ��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: config.php 1533 2017-08-21 02:43:24Z zhuge $
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
 * Ӧ����ǰ��ѯ��QQ 15326940
 * Ӧ�ö��ƿ�����QQ 643306797
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
// $nge_config = array();
$nge_config['nge_temp'] = 'nge';
$nge_config['output_file'] = 'output';
// ��������
$nge_config['weather_radio'] = '0';
// ��ݷ�ʽ����
$nge_config['shotcut_radio'] = '1';
// ������Ϣ����
$nge_config['warmprompt_radio'] = '1';
$nge_config['threadcard_select'] = $study_nge['threadcard_select2'];
$nge_config['posts_way'] = $study_nge['posts_way'] ? $study_nge['posts_way'] : '1';
$nge_config['posts_titlecolor'][0] = $study_nge['posts_zytitlecolor'] ? $study_nge['posts_zytitlecolor'] :'#BEE0FB';
$nge_config['posts_infocolor'][0] = $study_nge['posts_zyinfocolor'] ? $study_nge['posts_zyinfocolor'] :'#DEEBFB';
$nge_config['posts_titlecolor'][1] = $study_nge['posts_bytitlecolor'] ? $study_nge['posts_bytitlecolor'] :'#F5BEFB';
$nge_config['posts_infocolor'][1] = $study_nge['posts_byinfocolor'] ? $study_nge['posts_byinfocolor'] :'#FCE2F9';
$nge_config['posts_titlecolor'][2] = $study_nge['posts_thtitlecolor'] ? $study_nge['posts_thtitlecolor'] :'#FBE5BE';
$nge_config['posts_infocolor'][2] = $study_nge['posts_thinfocolor'] ? $study_nge['posts_thinfocolor'] :'#FBF4E5';
$nge_config['posts_show_name'] = explode('|', $study_nge['posts_show_name']);
// �õ�Ƭ���
// $study_slide['width'] = $study_nge['pic_thumb_w'] ? $study_nge['pic_thumb_w'] : '300';
// $study_slide['height'] = $study_nge['pic_thumb_h'] ? $study_nge['pic_thumb_h'] : '250';
// $study_slide['height'] -= 1;
$nge_config['common_icon_radio'] = $study_nge['common_icon_radio'];


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: config.php 1975 2017-08-20 18:43:24Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��