<?php
/*
 * ��ҳ��https://addon.dismall.com/?@1552.developer
 * �˹�����ʵ���ң�Discuz!Ӧ������ʮ�����㿪���ߣ�
 * ������� ��ϵQQ594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if(file_exists(DISCUZ_ROOT.'./source/plugin/nimba_shot/libs/hot.lib.php')){
	@require_once DISCUZ_ROOT.'./source/plugin/nimba_shot/libs/hot.lib.php';
}else{
	echo lang('plugin/nimba_shot','free');
}
?>