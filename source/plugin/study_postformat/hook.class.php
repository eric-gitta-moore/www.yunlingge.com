<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 3473 2019-12-26 16:10:12
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_study_postformat {

}
class plugin_study_postformat_forum extends plugin_study_postformat{
	
	public function post_middle_output(){
			global $_G,$postinfo,$message;
			$splugin_setting = $_G['cache']['plugin']['study_postformat'];
			$splugin_lang = lang('plugin/study_postformat');
			$study_fids = unserialize($splugin_setting['study_fids']);
			if(in_array($_G['fid'], $study_fids)){
					$postformat_cache = array();
					@include DISCUZ_ROOT.'./data/cache/cache_study_postformat_fids.php';
					if($postformat_cache[$_G['fid']]){
						if($_GET['action'] == 'newthread'){
							$postinfo['subject'] = dhtmlspecialchars($postformat_cache[$_G['fid']]['subject']);
							$message_array = explode("||", $postformat_cache[$_G['fid']]['message']);
							$m_key = rand(0,(count($message_array)-1));
							$message = dhtmlspecialchars($message_array[$m_key]);
						}elseif($_GET['action'] == 'reply'){
							$message = dhtmlspecialchars($postformat_cache[$_G['fid']]['replymessage']);
						}
					}
			}
			return '';
	}
	
	public function forumdisplay_fastpost_content_output(){
		global $_G,$fastpost;
		$splugin_setting = $_G['cache']['plugin']['study_postformat'];
		$study_fids = unserialize($splugin_setting['study_fids']);
		if(in_array($_G['fid'], $study_fids)){
					$postformat_cache = array();
					@include DISCUZ_ROOT.'./data/cache/cache_study_postformat_fids.php';
					if($postformat_cache[$_G['fid']]['subject'] || $postformat_cache[$_G['fid']]['message']){
						$subject = dhtmlspecialchars($postformat_cache[$_G['fid']]['subject']);
						$message_array = explode("||", $postformat_cache[$_G['fid']]['message']);
						$m_key = rand(0,(count($message_array)-1));
						$message = dhtmlspecialchars($message_array[$m_key]);
						$_G['setting']['rewritestatus'] = '1';
						$_G['setting']['output']['str']['search']['study_postformat_subject'] = '<input type="text" id="subject" name="subject" class="px" value=""';
				    $_G['setting']['output']['str']['replace']['study_postformat_subject'] = '<input type="text" id="subject" name="subject" class="px" value="'.$subject.'"';
						$_G['setting']['output']['str']['search']['study_postformat_message'] = '></textarea>';
				    $_G['setting']['output']['str']['replace']['study_postformat_message'] = '>'.$message.'</textarea>';
					}
		}
		
		return '';
	}
	
	public function viewthread_fastpost_content_output(){
		global $_G,$fastpost;
		$splugin_setting = $_G['cache']['plugin']['study_postformat'];
		$study_fids = unserialize($splugin_setting['study_fids']);
		if(in_array($_G['fid'], $study_fids)){
					$postformat_cache = array();
					@include DISCUZ_ROOT.'./data/cache/cache_study_postformat_fids.php';
					if($postformat_cache[$_G['fid']]['replymessage']){
						$replymessage = dhtmlspecialchars($postformat_cache[$_G['fid']]['replymessage']);
						$_G['setting']['rewritestatus'] = '1';
						$_G['setting']['output']['str']['search']['study_postformat_replymessage'] = '></textarea>';
				    $_G['setting']['output']['str']['replace']['study_postformat_replymessage'] = '>'.$replymessage.'</textarea>';
					}
		}
		
		return '';
	}
	
	public function post_infloat_top_output(){
		$this->viewthread_fastpost_content_output();
	}
}


//Copyright 2001-2099 .1314.ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 3935 2019-12-26 08:10:12
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue ������ http://t.cn/EUPqQW1��
//Ӧ����ǰ��ѯ��QQ 15.3269.40
//Ӧ�ö��ƿ�����QQ 643.306.797
//�����Ϊ 131.4ѧϰ����www.1314Study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��