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
$site=empty($vars['site'])? $_SERVER['HTTP_HOST']:$vars['site'];
$op=addslashes($_GET['op']);

echo '<script type="text/javascript">
function ch(){';
$all_list=DB::fetch_all("SELECT id FROM ".DB::table('nimba_linkhelper')." ORDER BY id DESC");
foreach($all_list as $k=>$ids){
	echo 'document.getElementById("s'.$ids['id'].'").innerHTML=ajaxget(\''.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=admincp&op=check&formhash='.FORMHASH.'&id='.$ids['id'].'\',\'s'.$ids['id'].'\',\'s'.$ids['id'].'\',\'loading\',\'\',\'recall\');'."\n";
}
echo '}</script>';

if($op=='check'){
	if($_GET['formhash']==formhash()){
		$id=intval($_GET['id']);
		$sec='<a onclick="ajaxget(\''.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=check&op=check&formhash='.FORMHASH.'&id='.$id.'\',\'s'.$id.'\',\'s'.$id.'\',\'loading\',\'\',\'recall\');return false" href="#">'.lang('plugin/nimba_linkhelper','sec').'</a>';
		$link=DB::result_first("SELECT siteurl FROM ".DB::table('nimba_linkhelper')." WHERE id=$id");
		$html=@file_get_contents($link);
		ajaxshowheader();
		if(empty($html)) echo '<span style="color:#FF0000;">'.lang('plugin/nimba_linkhelper','nohtml').'</span> | '.$sec;
		else{
			if(substr_count($html,$site)) echo '<span style="color:#009900;">'.lang('plugin/nimba_linkhelper','checkyes').'</span> | '.$sec;
			else echo '<span style="color:#FF0000;">'.lang('plugin/nimba_linkhelper','checkno').'</span> | '.$sec;
		}
		ajaxshowfooter();	
	}else{
		ajaxshowheader();
		echo lang('plugin/nimba_linkhelper','hashcheck');
		ajaxshowfooter();
	}
}elseif(!submitcheck('submit')){
		$page=max(1,intval($_GET['page']));
		$pagenum=20;
		$start = ($page-1)*$pagenum;
		$pagemod=$page>1? '&page='.$page:'';
		$mpurl = ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=check'.$pagemod;
		//$mpurl.= '&perpage='.$perpage;
		
		$count = DB :: result_first("SELECT count(*) FROM ".DB :: table('nimba_linkhelper')." l LEFT JOIN ".DB :: table('common_member')." m ON l.uid=m.uid WHERE l.status = '0'");
		$blogssql = DB :: query("SELECT l.*,m.email,m.username FROM ".DB :: table('nimba_linkhelper')." l LEFT JOIN ".DB :: table('common_member')." m ON l.uid=m.uid WHERE l.status = '0' ORDER BY l.id DESC LIMIT $start,$pagenum");
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=check'.$pagemod, 'submit');
		showtableheader(lang('plugin/nimba_linkhelper','linksvalidate'));
		if (!empty ($count)) {
			showsubtitle(array (
				'',
				lang('plugin/nimba_linkhelper','sitename'),
				lang('plugin/nimba_linkhelper','siteurl'),
				lang('plugin/nimba_linkhelper','logo'),
				lang('plugin/nimba_linkhelper','intro'),
				lang('plugin/nimba_linkhelper','applyer'),
				lang('plugin/nimba_linkhelper','dateline'),
				lang('plugin/nimba_linkhelper','check'),
			));

			while($linksarr = DB :: fetch($blogssql)){
				$linksarr[dateline] = date("Y-m-d H:i", $linksarr[dateline]);
				if(empty($linksarr['logo'])){
					$linksarr['logo'] = lang('plugin/nimba_linkhelper','nologo');//无logo
				}else{
					$linksarr['logo'] = "<img src='".$linksarr['logo']."' width='88' height='30' />";
				}
				if(empty($linksarr['description'])) $linksarr['description']=lang('plugin/nimba_linkhelper','nointro');
				$linksarr['username'] = empty($linksarr['username']) ? lang('plugin/nimba_linkhelper','youke'):$linksarr['username'];//申请人
				$url = str_replace("http://","",$linksarr[siteurl]);
				$checkurl='<span id="s'.$linksarr['id'].'"><a onclick="ajaxget(\''.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=check&formhash='.FORMHASH.'&op=check&id='.$linksarr['id'].'\',\'s'.$linksarr['id'].'\',\'s'.$linksarr['id'].'\',\'loading\',\'\',\'recall\');return false" href="#">'.lang('plugin/nimba_linkhelper','check').'</a></span>';
				showtablerow('', array ('','class="td_k"','class="td_k"','class="td_k"','class="td_k"','class="td_k"','class="td_k"','class="td_k"'), array (
					"<input type=\"checkbox\" class=\"checkbox\" name=\"linkids[]\" value=\"$linksarr[id]\">",
					$linksarr[sitename],
					"<a href='".$linksarr[siteurl]."' target='_blank'>".$linksarr[siteurl]."</a>",
					$linksarr[logo],
					$linksarr[description],
					"<a href='home.php?mod=space&uid=".$linksarr['uid']."' target='_blank'>".$linksarr['username']."</a>",
					$linksarr[dateline],
					$checkurl,
				));
			}

			$multipage = multi($count,$pagenum,$page,$mpurl);
			$optypehtml = ''.
			'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/>'.
			'<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$pagenum.'"/>'.
			'<input type="radio" name="optype" id="optype_trash" value="validate" class="radio" /><label for="optype_trash">'.lang('plugin/nimba_linkhelper','validate').'</label>'.
			'<input type="radio" name="optype" id="optype_delete" value="delete" class="radio" /><label for="optype_delete">'.lang('plugin/nimba_linkhelper','nopassverify').'</label>'.
			'&nbsp;&nbsp;';

			showsubmit('','','','<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.lang('plugin/nimba_linkhelper','select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="submit" value="'.lang('plugin/nimba_linkhelper','submit_url').'" />', $multipage);
		}else{
			showtablerow('',array(),array(lang('plugin/nimba_linkhelper','nodata')));
		}
		showtablefooter();
		showformfooter();
	}else{//提交处理
		$page=max(1,intval($_GET['page']));
		$pagemod=$page>1? '&page='.$page:'';		
		$linkids = !empty ($_POST['linkids']) && is_array($_POST['linkids']) ? $_POST['linkids']:array();
		$linkids=daddslashes($linkids);
		$mpurl = 'action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=check'.$pagemod;
		
		if($_POST['optype'] == 'validate'){//通过审核
			DB::update('nimba_linkhelper', array ('updatetime' => time(),'status' => '1'), 'id IN ('.dimplode($linkids).')');
			foreach($linkids as $id){
				$item=getlinks_by_id($id);
				$linkitem=array(
					'displayorder'	=>88,
					'name' => $item['sitename'],
					'url' => $item['siteurl'],
					'description' => $item['description'],
					'logo' => $item['logo'],
					'type' => 2
				);
				DB::insert('common_friendlink',$linkitem);
				$message = lang('plugin/nimba_linkhelper','validate_pmcontent1').$item['siteurl'].lang('plugin/nimba_linkhelper','validate_pmcontent2');
				sendpm($item['uid'],'',$message);
			}
			updatecache('forumlinks');
			cpmsg(lang('plugin/nimba_linkhelper','validate_succeed'),$mpurl, 'succeed');
		}

		if($_POST['optype']=='delete'){//未通过审核
			DB::update('nimba_linkhelper', array ('updatetime' => time(),'status' => '-1'), 'id IN ('.dimplode($linkids).')');
			foreach($linkids as $id){
				$item=getlinks_by_id($id);
				$message = lang('plugin/nimba_linkhelper','delete_pmcontent1').$item['siteurl'].lang('plugin/nimba_linkhelper','delete_pmcontent2');
				if($item['uid'] != 0){
					sendpm($item['uid'],'',$message);
				}
			}
			cpmsg(lang('plugin/nimba_linkhelper','validate_succeed'),$mpurl, 'succeed');
		}
	}

function getlinks_by_id($id){
	return DB::fetch_first('SELECT * FROM '.DB::table('nimba_linkhelper')." WHERE `id` = '".$id."'");
}
?>