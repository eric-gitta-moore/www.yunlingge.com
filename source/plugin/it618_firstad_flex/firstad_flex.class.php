<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_it618_firstad_flex_forum {
	function it618_hook(){
		global $_G;
		$it618_firstad_flex = $_G['cache']['plugin']['it618_firstad_flex'];
		$bordercolor=$it618_firstad_flex['bordercolor'];
		$padding=$it618_firstad_flex['padding'];
		
		$ad_height=$it618_firstad_flex['ad_height'];
		$ad_width=$it618_firstad_flex['ad_width'];
		
		$ad_bordercolor=$it618_firstad_flex['ad_bordercolor'];
		$ad_bgcolor=$it618_firstad_flex['ad_bgcolor'];
		$ad_borderstyle=$it618_firstad_flex['ad_borderstyle'];
		$ad_align=$it618_firstad_flex['ad_align'];
		$ad_padding=$it618_firstad_flex['ad_padding'];
		$ad_margin=$it618_firstad_flex['ad_margin'];
		
		$ad_style=$it618_firstad_flex['ad_style'];
		$ad_stylewho=$it618_firstad_flex['ad_stylewho'];
		$ad_isimgborder=$it618_firstad_flex['ad_isimgborder'];
		
		if($it618_firstad_flex['adtop']!="")$adtop="<div style='margin-bottom:5px'>".$it618_firstad_flex['adtop']."</div>";
		if($it618_firstad_flex['adbottom']!="")$adbottom="<div style='margin-top:5px'>".$it618_firstad_flex['adbottom']."</div>";
		
		if($ad_align==1)$ad_align="left";
		if($ad_align==2)$ad_align="right";
		if($ad_align==3)$ad_align="center";
		
		if($ad_stylewho==1){
			if($ad_style==1)$txtstyle="height:".$ad_height."px;";
			if($ad_style==2)$txtstyle="width:".$ad_width."px;";
			if($ad_style==3)$txtstyle="height:".$ad_height."px;width:".$ad_width."px;";
		}elseif($ad_stylewho==2){
			if($ad_style==1)$imgstyle="height:".$ad_height."px;";
			if($ad_style==2)$imgstyle="width:".$ad_width."px;";
			if($ad_style==3)$imgstyle="height:".$ad_height."px; width:".$ad_width."px;";
		}else{
			if($ad_style==1)$txtstyle="height:".$ad_height."px;";
			if($ad_style==2)$txtstyle="width:".$ad_width."px;";
			if($ad_style==3)$txtstyle="height:".$ad_height."px;width:".$ad_width."px;";
			if($ad_style==1)$imgstyle="height:".$ad_height."px;";
			if($ad_style==2)$imgstyle="width:".$ad_width."px;";
			if($ad_style==3)$imgstyle="height:".$ad_height."px; width:".$ad_width."px;";
		}
		
		if($ad_isimgborder==1)$imgstyle.="border-width:0;padding:0";
		
		if($ad_borderstyle==1)$ad_borderstyle="dashed";else $ad_borderstyle="solid";
		
		if($it618_firstad_flex['ad_isad']==0){
			$ads=explode("|",str_replace(array("\r\n", "\r", "\n"), '|', $it618_firstad_flex['ads']));
			foreach($ads as $key => $ad){
				if($ad!=""){
					$tmparr=explode("==",$ad);
					$ad_txt[]=$tmparr[0];
					if(stripos($tmparr[1],"(txt)")){
						$tmparr1=explode("(txt)",$tmparr[1]);
						$ad_type[]="txt";
						$ad_img[]=str_replace("{{","",$tmparr1[0]);
						$ad_url[]=str_replace("}}","",$tmparr1[1]);
					}elseif(stripos($tmparr[1],"(img)")){
						$tmparr1=explode("(img)",$tmparr[1]);
						$ad_type[]="img";
						$ad_img[]=str_replace("{{","",$tmparr1[0]);
						$ad_url[]=str_replace("}}","",$tmparr1[1]);
					}
					
				}
			}

			for($i=0;$i<count($ad_txt);$i++){
				if($ad_type[$i]=="txt"){
					$strall.='<li class="txt"><div class="it618_ad_wrap" style="width:'.$ad_width.'px;height:'.$ad_height.'px"><div class="it618_ad_subwrap"><div class="it618_ad_content"><a href="'.$ad_url[$i].'" target="_blank" title="'.$ad_img[$i].'">'.$ad_txt[$i].'</a></div></div></div></li>';
				}elseif($ad_type[$i]=="img"){
					$strall.='<li class="img"><a href="'.$ad_url[$i].'" target="_blank"><img src="'.$ad_img[$i].'" alt="'.$ad_txt[$i].'"/></a></li>';
				}
			}
			if($strall!="")$strall='<div class="it618_firstad_flex"><ul>'.$strall.'<ul></div>';
		}else{
			$query = DB::query("SELECT * FROM ".DB::table('it618_firstad_flex_ad')." WHERE it618_is=1 order by it618_orderby");
			while($it618_firstad_flex_ad =DB::fetch($query)) {
				$url_this =  "http://".$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$it618_pageurl = $it618_firstad_flex_ad['it618_pageurl'];
				$tmparr=explode("#",$it618_pageurl);
				$flag=0;
				if(count($tmparr)==1){
					if($it618_pageurl==$url_this)$flag=1;
				}
				if(count($tmparr)==2){
					if($tmparr[0]==""){
						$tmparr1=explode($tmparr[1],$url_this);
						if(count($tmparr1)>1&&$tmparr1[1]=="")$flag=1;
					}else{
						$tmparr1=explode($tmparr[0],$url_this);
						if(count($tmparr1)>1&&$tmparr1[0]=="")$flag=1;
					}
				}
				if(count($tmparr)==3){
					$tmparr1=explode($tmparr[1],$url_this);
					if(count($tmparr1)>1)$flag=1;
				}
				
				if($flag==1){
					if($it618_firstad_flex_ad['it618_img']==""){
						$strall.='<li class="txt"><a href="'.$it618_firstad_flex_ad['it618_url'].'" target="_blank" title="'.$it618_firstad_flex_ad['it618_tip'].'">'.$it618_firstad_flex_ad['it618_title'].'</a></li>';
					}else{
						$strall.='<li class="img"><a href="'.$it618_firstad_flex_ad['it618_url'].'" target="_blank" title="'.$it618_firstad_flex_ad['it618_tip'].'"><img src="'.$it618_firstad_flex_ad['it618_img'].'" alt="'.$it618_firstad_flex_ad['it618_tip'].'"/></a></li>';
					}
				}
			}
			if($strall!="")$strall='<div class="it618_firstad_flex"><ul>'.$strall.'<ul></div>';
			if($it618_firstad_flex['ad_isurl']==1)$strall='<font color=red>'.$url_this.'</font>'.$strall;
		}

		$usergroup=(array)unserialize($it618_firstad_flex['usergroup']);
		if(empty($usergroup[0]) || in_array($_G['groupid'], $usergroup)){
			if($strall!=""){
				include template('it618_firstad_flex:firstad_flex');
				return $it618_firstad_flex_block;
			}
		}
		
	}
	
	function index_top(){
		global $_G;
		$it618_firstad_flex = $_G['cache']['plugin']['it618_firstad_flex'];
		if($it618_firstad_flex['indextop']==1)return $this->it618_hook();else return "";
	}
}

class plugin_it618_firstad_flex extends plugin_it618_firstad_flex_forum{
	
	function global_header(){
		$blockname="it618_firstad_flex";
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