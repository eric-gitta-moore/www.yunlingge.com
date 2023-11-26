<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */
(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) && exit('Access Denied');
if(submitcheck('it618submit')){
	$same1=0;
	$ok1=0;
	$same2=0;
	$ok2=0;
	$del=0;
	
	if($ids = dimplode($_GET['delete'])) {
		$del=0;
		foreach($_GET['delete'] as $key => $delid) {
			$delid=intval($delid);
			DB::delete('it618_firstad_flex_ad', "id=$delid");
			$del=$del+1;
		}
	}

	if(is_array($_GET['it618_url'])) {
		foreach($_GET['it618_url'] as $id => $val) {
			$upid=addslashes(trim($_GET['id'][$id]));
			$upit618_title=addslashes(trim($_GET['it618_title'][$id]));
			$upit618_img=addslashes(trim($_GET['it618_img'][$id]));
			$upit618_url=addslashes(trim($_GET['it618_url'][$id]));
			
			if($oldfind = DB::fetch_first("SELECT it618_title FROM ".DB::table('it618_firstad_flex_ad')." WHERE it618_title='".$upit618_title."' and it618_img='".$upit618_img."' and it618_url='".$upit618_url."' and id<>".$upid)) {
				$same1=$same1+1;
			} else {
				DB::update('it618_firstad_flex_ad', array(
					'it618_title' => trim($_GET['it618_title'][$id]),
					'it618_img' => trim($_GET['it618_img'][$id]),
					'it618_url' => trim($_GET['it618_url'][$id]),
					'it618_tip' => trim($_GET['it618_tip'][$id]),
					'it618_pageurl' => trim($_GET['it618_pageurl'][$id]),
					'it618_is' => intval($_GET['it618_is'][$id]),
					'it618_orderby' => intval($_GET['it618_orderby'][$id]),
				), "id='$id'");
				if($id = DB::fetch_first("SELECT id FROM ".DB::table('it618_firstad_flex_ad')." WHERE id=".$upid)) $ok1=$ok1+1;
			}
		}
	}

	$newit618_title_array = !empty($_GET['newit618_title']) ? $_GET['newit618_title'] : array();
	$newit618_img_array = !empty($_GET['newit618_img']) ? $_GET['newit618_img'] : array();
	$newit618_url_array = !empty($_GET['newit618_url']) ? $_GET['newit618_url'] : array();
	$newit618_tip_array = !empty($_GET['newit618_tip']) ? $_GET['newit618_tip'] : array();
	$newit618_pageurl_array = !empty($_GET['newit618_pageurl']) ? $_GET['newit618_pageurl'] : array();
	$newit618_is_array = !empty($_GET['newit618_is']) ? $_GET['newit618_is'] : array();
	$newit618_orderby_array = !empty($_GET['newit618_orderby']) ? $_GET['newit618_orderby'] : array();
	
	foreach($newit618_url_array as $key => $value) {
		$newit618_title = addslashes(trim($newit618_title_array[$key]));
		$newit618_img = addslashes(trim($newit618_img_array[$key]));
		$newit618_url = addslashes(trim($newit618_url_array[$key]));
		
		if($newit618_url != '') {
			
			if($oldfind = DB::fetch_first("SELECT it618_title FROM ".DB::table('it618_firstad_flex_ad')." WHERE it618_title='".$newit618_title."' and it618_img='".$newit618_img."' and it618_url='".$newit618_url."'")) {
				$same1=$same1+1;
			} else {
				DB::insert('it618_firstad_flex_ad', array(
					'it618_title' => trim($newit618_title_array[$key]),
					'it618_img' => trim($newit618_img_array[$key]),
					'it618_url' => trim($newit618_url_array[$key]),
					'it618_tip' => trim($newit618_tip_array[$key]),
					'it618_pageurl' => trim($newit618_pageurl_array[$key]),
					'it618_is' => intval($newit618_is_array[$key]),
					'it618_orderby' => intval($newit618_orderby_array[$key]),
				));
				$ok2=$ok2+1;
			}
		}
	}

	cpmsg($it618_firstad_flex_lang[1].$same1.' '.$it618_firstad_flex_lang[2].$ok1.' '.$it618_firstad_flex_lang[3].$same2.' '.$it618_firstad_flex_lang[4].$ok2.' '.$it618_firstad_flex_lang[5].$del.')', "action=plugins&cp=admin_ad&pmod=admin_ad&operation=$operation&do=$do&page=$page", 'succeed');
}
if(submitcheck('it618sercsubmit')) {
		$extrasql = "AND it618_title LIKE '%".addcslashes($_GET['beforeword'],'%_')."%'";	
}
showformheader("plugins&cp=admin_ad&pmod=admin_ad&operation=$operation&do=$do");
showtableheaders($it618_firstad_flex_lang[6],'it618_firstad_flex_ad');
	showsubmit('it618sercsubmit', $it618_firstad_flex_lang[7], $it618_firstad_flex_lang[8].' <input name="beforeword" value="" class="txt" />');
	$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('it618_firstad_flex_ad')." w WHERE 1 $extrasql");
	$multipage = multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&cp=admin_ad&pmod=admin_ad&operation=$operation&do=$do");
	
	echo '<tr><td colspan=5>'.$it618_firstad_flex_lang[9].$count.' <font color=red>'.$it618_firstad_flex_lang[10].'</font></td></tr>';
	showtablerow('', array('class="td25"', '', '', '', '', ''), array('', $it618_firstad_flex_lang[11],"<div style='width:200px'>".$it618_firstad_flex_lang[12]."</div>","<div style='width:225px'>".$it618_firstad_flex_lang[13]."</div>",$it618_firstad_flex_lang[14],"<div style='width:100px'>".$it618_firstad_flex_lang[15]."</div>"));
	
	$query = DB::query("SELECT * FROM ".DB::table('it618_firstad_flex_ad')." WHERE 1 $extrasql ORDER BY it618_orderby LIMIT $startlimit, $ppp");
	while($it618_firstad_flex_ad =	DB::fetch($query)) {
		if($it618_firstad_flex_ad['it618_is']==1)$checked='checked="checked"';else $checked="";
		showtablerow('', array('class="td25"', '', '', '', '', ''), array(
			"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$it618_firstad_flex_ad[id]\"><input type=\"hidden\" name=\"id[$it618_firstad_flex_ad[id]]\" value=\"$it618_firstad_flex_ad[id]\">",
			"<textarea class=\"txt\" style=\"width:200px;height:80px\" name=\"it618_title[$it618_firstad_flex_ad[id]]\">$it618_firstad_flex_ad[it618_title]</textarea><br>".$it618_firstad_flex_lang[16],
			'<img src="'.$it618_firstad_flex_ad['it618_img'].'" width="80" height="80" align="absmiddle"/><textarea class="txt" style="width:100px;height:80px;margin-left:5px" name="it618_img['.$it618_firstad_flex_ad['id'].']">'.$it618_firstad_flex_ad['it618_img'].'</textarea><br>'.$it618_firstad_flex_lang[17],
			'<textarea type="text" style="width:100px;height:80px" name="it618_url['.$it618_firstad_flex_ad['id'].']">'.$it618_firstad_flex_ad['it618_url'].'</textarea><textarea type="text" style="width:100px;height:80px;margin-left:5px" name="it618_tip['.$it618_firstad_flex_ad['id'].']">'.$it618_firstad_flex_ad['it618_tip'].'</textarea>',
			'<textarea type="text" style="width:200px;height:50px" name="it618_pageurl['.$it618_firstad_flex_ad['id'].']">'.$it618_firstad_flex_ad['it618_pageurl'].'</textarea><br>'.$it618_firstad_flex_lang[18],
			'<input class="checkbox" type="checkbox" name="it618_is['.$it618_firstad_flex_ad['id'].']" '.$checked.' value="1">/ <input class="txt" style="width:30px" type="text" name="it618_orderby['.$it618_firstad_flex_ad['id'].']" value="'.$it618_firstad_flex_ad['it618_orderby'].'">'
		));
	}

	echo <<<EOT
	<script type="text/JavaScript">
	var rowtypedata = [
	[[1,''], [1,'<textarea type="text" class="txt" style=\"width:200px;height:50px\" name="newit618_title[]"></textarea><br>$it618_firstad_flex_lang[16]'], [1, ' <textarea class="txt" style=\"width:200px;height:50px\" name="newit618_img[]"></textarea><br>$it618_firstad_flex_lang[17]'], [1, ' <textarea class="txt" style=\"width:100px;height:80px\" name="newit618_url[]"></textarea><textarea class="txt" style=\"width:100px;height:80px\" name="newit618_tip[]"></textarea>'], [1, ' <textarea class="txt" style=\"width:200px;height:50px\" name="newit618_pageurl[]"></textarea><br>$it618_firstad_flex_lang[18]'], [1, ' <input class="checkbox" type="checkbox" name="newit618_is[]" value="1">/ <input class="txt" style="width:30px" type="text" name="newit618_orderby[]" value="1">'], [1,'']]
	];
	</script>
EOT;
	echo '<tr><td></td><td colspan="3"><div><a href="###" onclick="addrow(this, 0)" class="addtr">'.$lang['add_new'].'</a></div></td></tr>';
	
	showsubmit('it618submit', 'submit', 'del', "<input type=hidden value=$page name=page />", $multipage);
	showtablefooter();
?>