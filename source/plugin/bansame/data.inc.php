<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('plugin');
$langvar=lang('plugin/bansame');
if(submitcheck('submit')){
	foreach($_POST['delete'] as $tid=>$v){
		if($tid){
			DB::query("update ".DB::table('forum_thread')." set displayorder='-1' where tid=".$tid);
			C::t('forum_threadmod')->insert(array('tid' =>$tid,'uid'=>1,'username'=>'admin','dateline'=>$_G['timestamp'],'expiration'=>'','action'=>'DEL','status'=>1,'reason'=>$langvar['appname']));		
		}
	}
	cpmsg($langvar['ok'],'action=plugins&operation=config&identifier=bansame&pmod=data', 'succeed');
	exit;
}
if($_GET['hash']&&$_GET['formhash']==formhash()){
	$hash=trim($_GET['hash']);
	$op=trim($_GET['op']);
	
	if($op=='cl_new'){//保留第一个
		cpmsg($langvar['cl_free']);//free
	}elseif($op=='cl_view'){//保留浏览量最大
		cpmsg($langvar['cl_free']);//free
	}elseif($op=='cl_len'){//保留内容最多
		cpmsg($langvar['cl_free']);//free
	}else{
		$data=DB::fetch_all("SELECT tid,subject,replies,author,authorid,dateline FROM ".DB::table('forum_thread')." where displayorder>=0 and md5(subject)='$hash'");
		showformheader('plugins&operation=config&identifier=bansame&pmod=data');
		showtableheader($langvar['title'], 'nobottom');
		showsubtitle(array('','tid',$langvar['subject'],$langvar['author'],$langvar['replies'],$langvar['dateline']));
		foreach($data as $tid=>$item){
			showtablerow('',array(), array(
						"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[".$item['tid']."]\" value=\"".$item['tid']."\">",
						$item['tid'],
						'<a href="forum.php?mod=viewthread&tid='.$item['tid'].'" target="_blank">'.$item['subject'].'</a>',
						'<a href="home.php?mod=space&uid='.$item['authorid'].'" target="_blank">'.$item['author'].'</a>',
						$item['replies'],
						date('Y-m-d H:i:s',$item['dateline']),
					));
		}	
		showsubmit('submit',$langvar['submit'],$langvar['del'].'<input class="checkbox" type="checkbox" name="groupall" onclick="checkAll(\'prefix\', this.form, \'delete\', \'groupall\')">', '','');
		showtablefooter();
		showformfooter();		
	}

}else{
	$data=DB::fetch_all("SELECT subject,count(subject) as count FROM ".DB::table('forum_thread')." where displayorder>=0 group  by subject having  count(subject) > 1");
	showtableheader($langvar['title_2']);
	showsubtitle(array($langvar['xh'],$langvar['subject'],$langvar['num'],$langvar['view'],$langvar['cl']));
	foreach($data as $k=> $item) {
		showtablerow('', array('class="td25"', 'class="td_k"', 'class="td_l"'), array(
			$k+1,
			$item['subject'],
			$item['count'],
			'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=bansame&pmod=data&hash='.md5($item['subject']).'&formhash='.FORMHASH.'">'.$langvar['view'].'</a>',
			'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=bansame&pmod=data&hash='.md5($item['subject']).'&op=cl_new&formhash='.FORMHASH.'">'.$langvar['cl_new'].'</a><span class="pipe">|</span>
			<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=bansame&pmod=data&hash='.md5($item['subject']).'&op=cl_view&formhash='.FORMHASH.'">'.$langvar['cl_view'].'</a><span class="pipe">|</span>
			<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=bansame&pmod=data&hash='.md5($item['subject']).'&op=cl_len&formhash='.FORMHASH.'">'.$langvar['cl_len'].'</a>',
		));
	}
	showtablefooter();
}
?>