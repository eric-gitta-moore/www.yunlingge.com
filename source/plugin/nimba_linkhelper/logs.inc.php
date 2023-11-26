<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 

if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit ('Access Denied');
}
loadcache('plugin');
$vars = $_G['cache']['plugin']['nimba_linkhelper'];


$pluginop = !empty ($_GET['pluginop']) ? $_GET['pluginop'] : 'list';
if (!in_array($pluginop, array ('list'))) {
	showmessage('undefined_action');
}

if ($pluginop == 'list') {
	if (!submitcheck('submit')) {
		$page = max(1,intval($_G['page']));
		$perpage = 20;
		$start = ($page -1) * $perpage;
		$mpurl = ADMINSCRIPT . '?action=plugins&operation=config&do=' . $pluginid . '&identifier=nimba_linkhelper&pmod=logs';
		$mpurl .= '&perpage=' . $perpage;
		$conditions='1';
		$count = DB :: result_first("SELECT count(*) FROM " . DB :: table('nimba_linkhelper') . " l LEFT JOIN " . DB :: table('common_member') . " m ON l.uid=m.uid WHERE " . $conditions);
		$blogssql = DB :: query("SELECT l.*,m.email,m.username FROM " . DB :: table('nimba_linkhelper') . " l LEFT JOIN " . DB :: table('common_member') . " m ON l.uid=m.uid WHERE " . $conditions . " ORDER BY l.id DESC LIMIT $start,$perpage");

		showformheader('plugins&operation=config&do=' . $pluginid . '&identifier=nimba_linkhelper&pmod=logs', 'submit');
		showtableheader(lang('plugin/nimba_linkhelper','linksvalidate'));
		if (!empty ($count)) {
			showsubtitle(array (
				'',
				lang('plugin/nimba_linkhelper','sitename'),
				lang('plugin/nimba_linkhelper','siteurl'),
				lang('plugin/nimba_linkhelper','logo'),
				lang('plugin/nimba_linkhelper','intro'),
				lang('plugin/nimba_linkhelper','applyer'),
				lang('plugin/nimba_linkhelper','updatetime'),
				lang('plugin/nimba_linkhelper','status'),
			));

			while ($linksarr = DB :: fetch($blogssql)) {

				$linksarr['updatetime'] = date("Y-m-d H:i", $linksarr['updatetime']);
				if($linksarr['status'] == 1){
					$linksarr['status'] = "<font color='green'>".lang('plugin/nimba_linkhelper','passverify')."</font>";
				}elseif($linksarr['status'] == -1){
					$linksarr['status'] = "<font color='red'>".lang('plugin/nimba_linkhelper','nopassverify')."</font>";
				}else{
					$linksarr['status'] = "<font color='blue'>".lang('plugin/nimba_linkhelper','unverify')."</font>";
					$linksarr['updatetime']=lang('plugin/nimba_linkhelper','unverify');
				}
				if(empty($linksarr['logo'])){
					$linksarr['logo'] = lang('plugin/nimba_linkhelper', 'nologo');
				}else{
					$linksarr['logo'] = "<img src='".$linksarr['logo']."' width='88' height='31' />";
				}
				if(empty($linksarr['description'])) $linksarr['description']=lang('plugin/nimba_linkhelper','nointro');
				$url = str_replace("http://","",$linksarr[siteurl]);
				showtablerow('', array ('','class="td_k"','class="td_k"','class="td_k"','class="td_k"','class="td_k"','class="td_k"','class="td_k"'), array (
					"<input type=\"checkbox\" class=\"checkbox\" name=\"deleteids[]\" value=\"$linksarr[id]\">",
					$linksarr['sitename'],
					"<a href='" . $linksarr['siteurl'] . "' target='_blank'>" . $linksarr['siteurl'] . "</a>",
					$linksarr['logo'],
					$linksarr['description'],
					"<a href='home.php?mod=space&uid=" . $linksarr['uid'] . "' target='_blank'>" . $linksarr['username'] . "</a>",
					$linksarr['updatetime'],
					$linksarr['status']
				));
			}
			$multipage = multi($count, $perpage, $page, $mpurl);
			$optypehtml = ''.
			'<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>' .
			'<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>' .
			'&nbsp;&nbsp;';

			showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.lang('plugin/nimba_linkhelper','delete').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="submit" value="' .lang('plugin/nimba_linkhelper','submit_url'). '" />', $multipage);
		}else{
			showtablerow('',array(),array (lang('plugin/nimba_linkhelper','nolog')));
		}
		showtablefooter();
		showformfooter();
	}else{
		$perpage = intval($_POST['hiddenperpage']);
		$page = intval($_POST['hiddenpage']);
		$deleteids = !empty ($_POST['deleteids']) && is_array($_POST['deleteids']) ? $_POST['deleteids'] : array ();
		$deleteids=daddslashes($deleteids);
		$mpurl = 'action=plugins&operation=config&do=' . $pluginid . '&identifier=nimba_linkhelper&pmod=logs';
		$mpurl .= '&perpage=' . $perpage;
		if (!empty ($page)) {
			$mpurl .= '&page=' . $page;
		}
		if(count($deleteids)>0){
			DB::query("DELETE FROM ".DB::table('nimba_linkhelper')." WHERE `id` IN (".dimplode($deleteids).")");
			cpmsg(lang('plugin/nimba_linkhelper','delete_succeed'),$mpurl, 'succeed');
		}else{
			cpmsg(lang('plugin/nimba_linkhelper','noselect_deleteids'),$mpurl, 'succeed');
		}
	}
}
?>