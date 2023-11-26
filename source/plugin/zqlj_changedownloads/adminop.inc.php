<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if(submitcheck('searchsubmit')||$_GET['resulthash']==formhash()){//搜索结果 附件列表
	$tid=intval(trim($_GET['tid']));
	if($tid){
		$tableid=$tid%10;
		$attchlist=C::t('forum_attachment_n')->fetch_all_by_id($tableid,'tid',$tid);
		if(!$attchlist) cpmsg(lang('plugin/zqlj_changedownloads','msg_attchlist'));
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=zqlj_changedownloads&pmod=adminop&tid='.$tid);
		showtableheader(lang('plugin/zqlj_changedownloads','title_list')."(<font color=\"red\">".lang('plugin/zqlj_changedownloads','step2')."</font>)");
		showsubtitle(array('aid',lang('plugin/zqlj_changedownloads','menu_filename'),lang('plugin/zqlj_changedownloads','menu_dateline'),lang('plugin/zqlj_changedownloads','menu_remote'),lang('plugin/zqlj_changedownloads','menu_isimage'),lang('plugin/zqlj_changedownloads','menu_price'),lang('plugin/zqlj_changedownloads','menu_louceng'),lang('plugin/zqlj_changedownloads','menu_downloads'),lang('plugin/zqlj_changedownloads','menu_newdownloads')));
		foreach ($attchlist as $k=>$attach) {
			$attach['downloads']=DB::result_first("select downloads from ".DB::table('forum_attachment')." where aid='$attach[aid]'");
			showtablerow('', array('class="td25"', 'class="td28"', '', '', ''), array(
			   $attach['aid'],
			   $attach['filename'],
			   dgmdate($attach['dateline']),
			   $attach['remote']? lang('plugin/zqlj_changedownloads','yes'):lang('plugin/zqlj_changedownloads','no'),
			   $attach['isimage']? lang('plugin/zqlj_changedownloads','yes'):lang('plugin/zqlj_changedownloads','no'),
			   $attach['price'],
			   '<a href="forum.php?mod=redirect&goto=findpost&ptid='.$attach['tid'].'&pid='.$attach['pid'].'" target="_blank">'.lang('plugin/zqlj_changedownloads','postview').'</a>',
			   $attach['downloads'],
				'<input type="text" class="txt" name="newdownloads['.$attach['aid'].']" value="'.$attach['downloads'].'" size="150"/>',
			));
		}
		showsubmit('changesubmit', 'submit', '','<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=zqlj_changedownloads&pmod=adminop">'.lang('plugin/zqlj_changedownloads','upstep').'</a>');
		showtablefooter();
		showformfooter();
	}else{
		cpmsg(lang('plugin/zqlj_changedownloads','msg_tid'));
	}
}elseif(submitcheck('changesubmit')){//修改次数
	$tid=intval(trim($_GET['tid']));
	foreach($_GET['newdownloads'] as $aid=>$downloads){
		$aid=intval($aid);
		$downloads=intval($downloads);
		if($aid){
			DB::update('forum_attachment',array('downloads'=>$downloads),array('aid'=>$aid));
			C::t('forum_attachment')->clear_cache($aid);
		}
	}
	cpmsg(lang('plugin/zqlj_changedownloads','msg_update_ok'),'action=plugins&operation=config&do='.$pluginid.'&identifier=zqlj_changedownloads&pmod=adminop&tid='.$tid.'&resulthash='.FORMHASH.'', 'succeed');
}else{//搜索界面
	showformheader("plugins&operation=config&do=$pluginid&identifier=zqlj_changedownloads&pmod=adminop");
	showtableheader(lang('plugin/zqlj_changedownloads','title_search').'(<font color="red">'.lang('plugin/zqlj_changedownloads','step1').'</font>)', 'nobottom');	
	showsetting(lang('plugin/zqlj_changedownloads','title_tid'),'tid','','text','', 0,lang('plugin/zqlj_changedownloads','title_tid_info'));			
	showsubmit('searchsubmit');
	showtablefooter();
	showformfooter();	
}



?>