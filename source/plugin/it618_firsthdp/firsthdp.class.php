<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_it618_firsthdp_forum {
	function it618_hook(){
		global $_G;
		$it618_firsthdp = $_G['cache']['plugin']['it618_firsthdp'];
		require_once libfile('function/cache');
		require_once DISCUZ_ROOT.'./source/plugin/it618_firsthdp/firsthdp.func.php';
		require_once DISCUZ_ROOT.'./config/config_ucenter.php';
		
		$cache_file = DISCUZ_ROOT.'./data/sysdata/cache_it618_firsthdp.php';

		if(($_G['timestamp'] - @filemtime($cache_file)) > $it618_firsthdp['cachetime']*60) {
include_once libfile('function/block');
loadcache('blockclass');
$effect[1]="horizontal";
$effect[2]="vertical";
$effect[3]="fade";
$effect[4]="none";
$numBtnSty[1]="num";
$numBtnSty[2]="square";
$numBtnSty[3]="circle";
$numBtnSty[4]="roundness";
$numBtnSty[5]="rectangle";

$ads=explode("|",str_replace(array("\r\n", "\r", "\n"), '|', $it618_firsthdp['hdp_diy']));
foreach($ads as $key => $ad){
	if($ad!=""){
		$tmparr=explode("==",$ad);
		$ad_title=$tmparr[0];
		$tmparr1=explode(",",$tmparr[1]);
		$ad_img=str_replace("{","",$tmparr1[0]);
		$ad_url=$tmparr1[1];
		$ad_summary=str_replace("}","",$tmparr1[2]);
		
		$stralldiy.='<li><a href="'.$ad_url.'" title="'.$ad_title.'" target="_blank"><img alt="' . $ad_title . ',' . $ad_summary . '" title="' . $ad_title . ',' . $ad_summary . '" src="'.$ad_img.'" width="'.$it618_firsthdp['hdp_width'].' height="'.$it618_firsthdp['hdp_height'].'" /><span class="it618_summary">'.$ad_title.'</span><div class="it618_summary">'.$ad_summary.'</div></a></li>
';
	}
}

$hdp_load=$it618_firsthdp['hdp_load'];
if($hdp_load==1)$strall=it618_firsthdp_gettui(lang('plugin/it618_firsthdp', 'it618_string'));
if($hdp_load==2)$strall=$stralldiy;
if($hdp_load==3)$strall=$stralldiy.it618_firsthdp_gettui(lang('plugin/it618_firsthdp', 'it618_string'));
if($hdp_load==4)$strall=it618_firsthdp_gettui(lang('plugin/it618_firsthdp', 'it618_string')).$stralldiy;

$strall='<style>
#altbox .title{width:'.($it618_firsthdp['hdp_width']-30).'px}
#altbox .summary{width:'.($it618_firsthdp['hdp_width']-30).'px}
</style>
       <table class="it618_firsthdp_table" cellpadding="0" cellspacing="0">
			<tr>
			<td>
			<div id="it618_firsthdp_slider">
                <ul>				
                    '.$strall.'	
                </ul>
            </div>
			</td>
			</tr>
		</table>
	<script type="text/javascript">
	//jQuery(document).ready(function(){
		jQuery("#it618_firsthdp_slider").nbspSlider({
			widths:         "'.$it618_firsthdp['hdp_width'].'px",
			heights:        "'.$it618_firsthdp['hdp_height'].'px",
			autoplay:       '.$it618_firsthdp['hdp_autoplay'].',
			delays:         '.$it618_firsthdp['hdp_delays'].',
			prevId: 		"prevBtn",
			nextId: 		"nextBtn",
			effect:	        "'.$effect[$it618_firsthdp['hdp_effect']].'",
			speeds: 		'.$it618_firsthdp['hdp_speeds'].',
			altOpa:         '.$it618_firsthdp['hdp_altOpa'].',
			altBgColor:     "'.$it618_firsthdp['hdp_altBgColor'].'",
			altHeight:      "'.$it618_firsthdp['hdp_altHeight'].'px",
			altShow:         '.$it618_firsthdp['hdp_altShow'].',
			altFontColor:    "'.$it618_firsthdp['hdp_titlecolor'].'",
			altjyFontColor:    "'.$it618_firsthdp['hdp_jycolor'].'",
			starEndNoEff: 	  '.$it618_firsthdp['hdp_starEndNoEff'].',
			preNexBtnShow:    '.$it618_firsthdp['hdp_preNexBtnShow'].',
			numBtnSty:        "'.$numBtnSty[$it618_firsthdp['hdp_numBtnSty']].'",
			numBtnShow:       '.$it618_firsthdp['hdp_numBtnShow'].'
		});

	//});
</script>';
			
			$contents[]=$strall;
			$cacheArray .= "\$contents=".arrayeval($contents).";\n";
			writetocache('it618_firsthdp', $cacheArray);	
	}
	else{
			include_once DISCUZ_ROOT.'./data/sysdata/cache_it618_firsthdp.php';
			$strall=$contents[0];
	}
		
		
		$usergroup=(array)unserialize($it618_firsthdp['usergroup']);
		if(empty($usergroup[0]) || in_array($_G['groupid'], $usergroup)){
			include template('it618_firsthdp:firsthdp');
			return $it618_firsthdp_block;
		}
		
	}
	
	function index_top(){
		global $_G;
		$it618_firsthdp = $_G['cache']['plugin']['it618_firsthdp'];
		if($it618_firsthdp['indextop']==1)return $this->it618_hook();else return "";
	}
}

class plugin_it618_firsthdp extends plugin_it618_firsthdp_forum{
	
	function global_header(){
		$blockname="it618_firsthdp";
		$blockcount=DB::result_first("select count(1) from ".DB::table('common_block')." where name='".$blockname."' and blockclass=0");
		
		if($blockcount>0){
			$strContent=$this->it618_hook();
			
			$setarr = array(
				'summary' => $strContent,
				'dateline' => $_G['timestamp']
			);
			DB::update('common_block', $setarr, "name='".$blockname."' and blockclass=0");
		}
	}

}
?>