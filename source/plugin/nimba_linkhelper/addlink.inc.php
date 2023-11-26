<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 
 if(!defined('IN_DISCUZ')){
 	exit('Access Denied');
 }
$lang=lang('plugin/nimba_linkhelper');
$vars=$_G['cache']['plugin']['nimba_linkhelper'];
$ailab_sq=intval($vars['ailab_sq']);//是否允许申请
$ailab_yk=intval($vars['ailab_yk']);//是否允许游客申请
$tips=$vars['ailab_ts'];
$navtitle=$vars['ailab_mc'];
$site_name=lang('plugin/nimba_linkhelper','ru').$vars['ailab_wz'];
$site_url=lang('plugin/nimba_linkhelper','ru').$vars['ailab_url'];
$site_logo=lang('plugin/nimba_linkhelper','ru').$_G['siteurl'].'static/image/common/logo.png';
$ailab_xe=$vars['ailab_xe'];

if ($_G['uid']==''&&$ailab_yk!=1){//游客
	showmessage(lang('plugin/nimba_linkhelper','gotologin'), '', array(), array('login' => true));
}

if(!$ailab_sq){
	showmessage(lang('plugin/nimba_linkhelper','ailab_sq'));
}else{
	$mod=addslashes($_GET['mod']);
	if($mod=='apply'||empty($mod)){
		$plugin_nav = lang('plugin/nimba_linkhelper','nav_apply');
		if($ailab_xe&&$_G['uid']){
			$today=strtotime(date('Y-m-d',time()).' 00:00:00');
			$xe=DB::result_first("SELECT count(*) FROM ".DB::table('nimba_linkhelper')." WHERE `uid` = '".$_G['uid']."' and dateline>='$today' ");
			if($xe>=$ailab_xe) showmessage(lang('plugin/nimba_linkhelper','xe'),'plugin.php?id=nimba_linkhelper:addlink&mod=log');
		}
		if(submitcheck('applysubmit')){
			if(empty($_POST['sitename'])){
				showmessage(lang('plugin/nimba_linkhelper','needsitename'), dreferer());
			}elseif(empty($_POST['siteurl'])||$_POST['siteurl']=='http://'){
				showmessage(lang('plugin/nimba_linkhelper','needsiteurl'), dreferer());
			}else{
				$_POST['sitename'] = addslashes($_POST['sitename']);
				$_POST['siteurl'] = addslashes($_POST['siteurl']);
				$_POST['description'] = addslashes($_POST['description']);
				$_POST['logo'] = addslashes($_POST['logo']);
				
				$url = str_replace("http://","",$_POST['siteurl']);
				$num = DB::result_first("SELECT * FROM ".DB::table('nimba_linkhelper')." WHERE `siteurl` = '".$_POST['siteurl']."' AND `uid` = '".$_G['uid']."' AND (`status` = '0' OR `status` = '1')");
				if($num){
					showmessage(lang('plugin/nimba_linkhelper','siteexist1').$url.lang('plugin/nimba_linkhelper','siteexist2'),'plugin.php?id=iplus_tieba', array(), array('locationtime'=>true,'refreshtime'=>3, 'showdialog'=>1, 'showmsg' => true));
				}
				DB::insert('nimba_linkhelper',array(
					'sitename' => $_POST['sitename'], 
					'siteurl' => $_POST['siteurl'], 
					'description' => $_POST['description'], 
					'logo' => $_POST['logo'], 
					'uid' => $_G['uid'], 
					'dateline' => time(), 
					'status' => '0'
				));
				$message = lang('plugin/nimba_linkhelper','pm_content1').$_POST['siteurl'].lang('plugin/nimba_linkhelper','pm_content2');
				foreach($admins as $uid){
					sendpm($uid,'',$message);
				}
				if(empty($_G['uid'])){
					showmessage(lang('plugin/nimba_linkhelper','tips_content_nologin'),'plugin.php?id=nimba_linkhelper:addlink');
				}else{
					showmessage(lang('plugin/nimba_linkhelper','tips_content'),'plugin.php?id=nimba_linkhelper:addlink&mod=log');
				}
			}
		}
	}elseif($mod=='log'){
		if ($_G['uid']==''){
			showmessage(lang('plugin/nimba_linkhelper','gotologin'), '', array(), array('login' => true));
		}
		$plugin_nav = lang('plugin/nimba_linkhelper','nav_log');
		$page = empty($_G['page']) ? 1 : $_G['page'];
		$perpage = 10;
		$lognum = DB::result_first("SELECT COUNT(*) FROM ".DB::table('nimba_linkhelper') ." WHERE `uid` = '".$_G['uid']."'");
		$start_limit = ($page - 1) * $perpage;
		$multipage = multi($lognum, $perpage, $page, 'plugin.php?id=nimba_linkhelper:addlink&mod=log', 0, 10);
		$sql = "SELECT * FROM ".DB::table('nimba_linkhelper')." WHERE `uid` = '".$_G['uid']."' ORDER BY dateline DESC LIMIT $start_limit, $perpage";
		$query = DB::query($sql);
		$loglist = $loglists = array();

		while($loglist = DB::fetch($query)){
			$loglist['dateline'] = dgmdate($loglist['dateline']);
			if(empty($loglist['logo'])){
				$loglist['logo'] = lang('plugin/nimba_linkhelper','nologo');
			}else{
				$loglist['logo'] = "<img src='".$loglist['logo']."' width='88' height='31' />";
			}
			if(empty($loglist['description'])) $loglist['description']=lang('plugin/nimba_linkhelper','nointro');
			if($loglist['status'] == 1){
				$loglist['status'] = "<font color=green>".lang('plugin/nimba_linkhelper','passverify')."</font>";
			}elseif($loglist['status'] == 0){
				$loglist['status'] = "<font color='#ff6600'>".lang('plugin/nimba_linkhelper','unverify')."</font>";
			}
			if($loglist['status'] == -1){
				$loglist['status'] = "<font color=red>".lang('plugin/nimba_linkhelper','nopassverify')."</font>";
			}
			$loglists[] = $loglist;
		}
	}else{
		showmessage('undefined_action');
	}
	include template('nimba_linkhelper:addlink');
}
?>
