<?php
/**
 *	开发团队：IT618资讯网
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="为站长提供学习资料">IT618资讯网</a>
 */


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_it618_firstnflex_forum {

	function it618_hook(){
		global $_G,$it618_firstnflex;
		$it618_firstnflex = $_G['cache']['plugin']['it618_firstnflex'];
		$contentstyle=(array)unserialize($it618_firstnflex['contentstyle']);
		require_once libfile('function/cache');
		require_once DISCUZ_ROOT.'./source/plugin/it618_firstnflex/firstnflex.func.php';
		require_once DISCUZ_ROOT.'./config/config_ucenter.php';
		
		$cache_file = DISCUZ_ROOT.'./data/sysdata/cache_it618_firstnflex.php';

		if(($_G['timestamp'] - @filemtime($cache_file)) > $it618_firstnflex['cachetime']*60) {
			include_once libfile('function/block');
			loadcache('blockclass');
			
			//图片区
			$image_content_arr=explode("|",str_replace(array("\r\n", "\r", "\n"), '|', $it618_firstnflex['image_content']));
			foreach($image_content_arr as $key => $image_content){
				if($image_content!=""){$tmparr=explode("=",$image_content);
					$image_content_titles[]=$tmparr[0];
					$image_content_lists[]=$tmparr[1];
				}
			}
			$image_nv=it618_nflex_getimage_nv($image_content_titles);
			$image_list=it618_nflex_getimage_list($image_content_lists);
			
			//主题区
			$thread_content_arr=explode("|",str_replace(array("\r\n", "\r", "\n"), '|', $it618_firstnflex['thread_content']));
			foreach($thread_content_arr as $key => $thread_content){
				if($thread_content!=""){$tmparr=explode("=",$thread_content);
					$thread_content_titles[]=$tmparr[0];
					$thread_content_lists[]=$tmparr[1];
				}
			}
			$thread_nv=it618_nflex_getthread_nv($thread_content_titles);
			$thread_list=it618_nflex_getthread_list($thread_content_lists);
			
			//版块区
			$forum_content_arr=explode("|",str_replace(array("\r\n", "\r", "\n"), '|', $it618_firstnflex['forum_content']));
			foreach($forum_content_arr as $key => $forum_content){
				if($forum_content!=""){$tmparr=explode("=",$forum_content);
					$forum_content_titles[]=$tmparr[0];
					$forum_content_lists[]=$tmparr[1];
				}
			}
			if(count($forum_content_titles)>0){$forum_nv=it618_nflex_getforum_nv($forum_content_titles);
				$forum_list=it618_nflex_getforum_list($forum_content_lists);
			}
			
			//会员区
			$nmember_content_arr=explode("|",str_replace(array("\r\n", "\r", "\n"), '|', $it618_firstnflex['nmember_content']));
			foreach($nmember_content_arr as $key => $nmember_content){
				if($nmember_content!=""){$tmparr=explode("=",$nmember_content);
					$nmember_content_titles[]=$tmparr[0];
					$nmember_content_lists[]=$tmparr[1];
				}
			}
			if(count($nmember_content_titles)>0){$nmember_nv=it618_nflex_getnmember_nv($nmember_content_titles);
				$nmember_list=it618_nflex_getnmember_list($nmember_content_lists);
			}
			
			//界面设置
			$titles=explode(",",lang('plugin/it618_firstnflex', 'it618_string'));
			if($it618_firstnflex['tools_diy']==""){
				$diymargin=0;
			}else{
				$diymargin=$it618_firstnflex['tools_diymargin'];
			}
			//N格背景与边框
			$main_bgcolor=$it618_firstnflex['main_bgcolor'];
			$main_bgimage=$it618_firstnflex['main_bgimage'];
			$main_bgimage_repeat=$it618_firstnflex['main_bgimage_repeat'];
			$main_bordercolor=$it618_firstnflex['main_bordercolor'];
			
			if($main_bgcolor==""){$main_bgcolor="";
			}
			else{$main_bgcolor="bgcolor='".$main_bgcolor."'";
			}
			if($main_bgimage==""){$main_bgimage="";
			}
			else{$main_bgimage="background:url(".$main_bgimage.") ".$repeat[$main_bgimage_repeat-1];
			}
			$main_bgfangan=$it618_firstnflex['main_bgfangan'];
			if($main_bgfangan==1){$main_bgimage="";
			}elseif($main_bgfangan==2){$main_bgcolor="";
			}
			//顶部导航
			$topnv_bgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['topnv_bgcolor']);
			$topnv_onbgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['topnv_onbgcolor']);
			$topnv_bgimage = it618_nflex_getcss_bgimage($it618_firstnflex['topnv_bgimage'],$it618_firstnflex['topnv_bgimage_repeat']);
			$topnv_onbgimage = it618_nflex_getcss_bgimage($it618_firstnflex['topnv_onbgimage'],$it618_firstnflex['topnv_bgimage_repeat']);
			$topnv_color = it618_nflex_getcss_color($it618_firstnflex['topnv_color']);
			$topnv_oncolor = it618_nflex_getcss_color($it618_firstnflex['topnv_oncolor']);
			
			$topnv_bgfangan=$it618_firstnflex['topnv_bgfangan'];
			if($topnv_bgfangan==1){$topnv_bgimage="";
				$topnv_onbgimage="";
			}elseif($topnv_bgfangan==2){$topnv_bgcolor="";
				$topnv_onbgcolor="";
			}
			//底部导航
			$bottomnv_bgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['bottomnv_bgcolor']);
			$bottomnv_onbgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['bottomnv_onbgcolor']);
			$bottomnv_bgimage = it618_nflex_getcss_bgimage($it618_firstnflex['bottomnv_bgimage'],$it618_firstnflex['bottomnv_bgimage_repeat']);
			$bottomnv_onbgimage = it618_nflex_getcss_bgimage($it618_firstnflex['bottomnv_onbgimage'],$it618_firstnflex['bottomnv_bgimage_repeat']);
			$bottomnv_color = it618_nflex_getcss_color($it618_firstnflex['bottomnv_color']);
			$bottomnv_oncolor = it618_nflex_getcss_color($it618_firstnflex['bottomnv_oncolor']);
			
			$bottomnv_bgfangan=$it618_firstnflex['bottomnv_bgfangan'];
			if($bottomnv_bgfangan==1){$bottomnv_bgimage="";
				$bottomnv_onbgimage="";
			}elseif($bottomnv_bgfangan==2){$bottomnv_bgcolor="";
				$bottomnv_onbgcolor="";
			}
			//列表
			$list_numberbgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['list_numberbgcolor']);
			$list_numbercolor = it618_nflex_getcss_color($it618_firstnflex['list_numbercolor']);
			$list_number123bgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['list_number123bgcolor']);
			$list_color = it618_nflex_getcss_color($it618_firstnflex['list_color']);
			$list_oncolor = it618_nflex_getcss_color($it618_firstnflex['list_oncolor']);
			$list_rightcolor = it618_nflex_getcss_color($it618_firstnflex['list_rightcolor']);
			$list_onrightcolor = it618_nflex_getcss_color($it618_firstnflex['list_onrightcolor']);
			$list_bordercolor = $it618_firstnflex['list_bordercolor'];
			//会员
			$member_color = it618_nflex_getcss_color($it618_firstnflex['member_color']);
			$member_oncolor = it618_nflex_getcss_color($it618_firstnflex['member_oncolor']);
			//提示
			$tip_bgcolor = it618_nflex_getcss_bgcolor($it618_firstnflex['tip_bgcolor']);
			$tip_bgimage = it618_nflex_getcss_bgimage($it618_firstnflex['tip_bgimage'],$it618_firstnflex['tip_bgimage_repeat']);
			$tip_bordercolor = $it618_firstnflex['tip_bordercolor'];
			$tip_color = it618_nflex_getcss_color($it618_firstnflex['tip_color']);
			
			$tip_bgfangan=$it618_firstnflex['tip_bgfangan'];
			if($tip_bgfangan==1){$tip_bgimage="";
			}elseif($tip_bgfangan==2){$tip_bgcolor="";
			}
			$strall='.it618_nflex_table tr td{text-align:left;border:'.$main_bordercolor.' 1px solid; vertical-align:top}
			.it618_tabmenu_image ul,.it618_tabmenu_thread ul,.it618_tabmenu_forum ul{'.$topnv_bgcolor.$topnv_bgimage.'}
			.it618_tabmenu_image li,.it618_tabmenu_thread li,.it618_tabmenu_forum li{'.$topnv_color.'}
			.it618_tabmenu_image .cli,.it618_tabmenu_thread .cli,.it618_tabmenu_forum .cli{'.$topnv_onbgcolor.' '.$topnv_onbgimage.$topnv_oncolor.'}
			
			.it618_tabmenu_nmember ul{'.$bottomnv_bgcolor.$bottomnv_bgimage.'}
			.it618_tabmenu_nmember li{'.$bottomnv_color.'}
			.it618_tabmenu_nmember .cli{'.$bottomnv_onbgcolor.$bottomnv_onbgimage.' '.$bottomnv_oncolor.'}
			
			.it618_flex_ranknum1,.it618_flex_ranknum2,.it618_flex_ranknum3,.it618_flex_ranknum4,.it618_flex_ranknum5,.it618_flex_ranknum6,.it618_flex_ranknum7,.it618_flex_ranknum8,.it618_flex_ranknum9,.it618_flex_ranknum10{'.$list_numberbgcolor.$list_numbercolor.'}
			.it618_flex_ranknum1,.it618_flex_ranknum2,.it618_flex_ranknum3{'.$list_number123bgcolor.'}
			.it618_flex_list LI{border-bottom:'.$list_bordercolor.' 1px dashed}
			.it618_flex_list A {'.$list_color.'}
			.it618_flex_list A:hover {'.$list_oncolor.'}
			.it618_flex_list span.it618_flex_author{'.$list_rightcolor.'}
			.it618_flex_list span.it618_flex_author A {'.$list_rightcolor.'}
			.it618_flex_list span.it618_flex_author A:hover {'.$list_onrightcolor.'}
			
			.it618_tabcontent_nmember div li p a{'.$member_color.'}
			.it618_tabcontent_nmember div li p a:hover{'.$member_oncolor.'}
			.it618_floatdiv{position:absolute;z-index: 9999;width:auto;'.$tip_bgcolor.$tip_bgimage.' padding: 5px;opacity: 0.9;border: 1px solid '.$tip_bordercolor.';-moz-border-radius: 3px;border-radius: 3px;-webkit-border-radius: 3px;font-weight: normal;font-size: 12px;display: none;'.$tip_color.'}
			</style>';
			
			if(in_array(1, $contentstyle)){$strall.='<style>
			
			li.it618_lifirst{ padding-left:0px; padding-right:0px; width:5px}
			
			.it618_nflex_movebox{width:100%;background-color:#f8f8f8;height:28px;}
			.it618_nflex_movebox li{float:left;color:#000;font-size:12px;padding-top:5px}
			
			li.it618_nflex_category{float:right;cursor:pointer;padding-top:5px;_padding-top:7px;padding-right:10px;_padding-right:7px}
			li.it618_nflex_moveboxtitle{padding-left:10px}
			li.it618_nflex_moveboxlist{padding-top:0}
			li.it618_nflex_time{padding-left:5px;}
			li.it618_nflex_weather{padding-top:2px;padding-left:1px;}
			li.it618_nflex_baidu{padding-top:1px;padding-left:5px;_padding-left:0px;width:150px}
			li.it618_nflex_diy{margin-bottom:'.$diymargin.'px}
			
			.it618_nflex_movediv{ width:380px;height:28px;}
			.it618_nflex_movediv ul{ width:380px; height:28px; overflow:hidden; margin:0;padding:0;}
			.it618_nflex_movediv ul li{float:left;margin-right:15px;COLOR: #333;font-size:12px;}
			.it618_nflex_movediv ul li a{COLOR: #333; TEXT-DECORATION: none;font-size:12px; }
			.it618_nflex_movediv ul li a:hover{COLOR: #c00; TEXT-DECORATION: none;font-size:12px; }
			</style>

			<ul class="it618_nflex_movebox">
			<li class="it618_nflex_weather">'.str_replace('></iframe>',' allowTransparency="true"></iframe>',$it618_firstnflex['tools_weather']).'</li>
			<li class="it618_nflex_time">'.$it618_firstnflex['tools_time'].'</li>
			<li class="it618_nflex_moveboxtitle">'.$it618_firstnflex['tools_movetitle'].'</li>
			<li class="it618_nflex_moveboxlist">
				<div id="it618_nflex_divid" class="it618_nflex_movediv">
					<ul id="it618_nflex_ulid">
						'.$it618_firstnflex['tools_movelist'].'
					</ul>
				</div>
			</li>
			<SCRIPT language=javascript>
			new Marquee(
				{
					MSClass	  : {MSClassID:"it618_nflex_divid",ContentID:"it618_nflex_ulid"},
					Direction : "left",
					Width : 380,
					Height : 28,
					Timer : 30,
					DelayTime : 0,
					WaitTime : 3000,
					AutoStart : 1
				});
			
			</SCRIPT>
			<li class="it618_nflex_baidu">'.$it618_firstnflex['tools_baidu'].'</li>
<li class="it618_nflex_category"><img id="category_618_img" src="static/image/common/collapsed_no.gif" title="'.$titles[2].'" alt="'.$titles[2].'" onclick="toggle_collapse(\'category_618\');" /></li>
			<li class="it618_nflex_diy">'.$it618_firstnflex['tools_diy'].'</li>
			</ul>';
			}
			
			$strall.='<table id="category_618" class="it618_nflex_table" cellpadding="0" cellspacing="0" '.$main_bgcolor.' style="'.$main_bgimage.'">
			<tr>
			<td width="320">
			<div id="it618_image">
				<div class="it618_tabbox_image">
					<div class="it618_tabmenu_image">
						'.$image_nv.'
					</div>
					<div class="it618_tabcontent_image">
						'.$image_list.'
					</div>
				</div>
			</div>
			</td>
			<td>
			<div id="it618_thread">
			<div class="it618_tabbox_thread">
					<div class="it618_tabmenu_thread">
						'.$thread_nv.'
					</div>
					<div class="it618_tabcontent_thread">
						'.$thread_list.'
					</div>
			</div>
			</div>
			</td>';

			if(in_array(3, $contentstyle)){
				$cols_forum=2;
			}else{
				$cols_forum=1;
			}
			
			if(in_array(2, $contentstyle)){
				$cols_nmember=3;
			}else{
				$cols_nmember=2;
			}
			
			if(in_array(2, $contentstyle)){$strall.='<td width="190">
			<div id="it618_forum">
			<div class="it618_tabbox_forum">
					<div class="it618_tabmenu_forum">
						'.$forum_nv.'
					</div>
					<div class="it618_tabcontent_forum">
						'.$forum_list.'
					</div>
			</div>
			</div>
			</td>';
			}

			$strall.='</tr>';
			
			if(in_array(3, $contentstyle)){$strall.='<tr>
			<td colspan="'.$cols_nmember.'">
			<div id="it618_nmember">
			<div class="it618_tabbox_nmember">
					<div class="it618_tabmenu_nmember">
						'.$nmember_nv.'
					</div>
					<div class="it618_tabcontent_nmember">
						'.$nmember_list.'
					</div>
			</div>
			</div>
			</td>
			</tr>';
			}
			
			$contents[]=$strall;
			$cacheArray .= "\$contents=".arrayeval($contents).";\n";
			writetocache('it618_firstnflex', $cacheArray);	
	}
	else{
			include_once DISCUZ_ROOT.'./data/sysdata/cache_it618_firstnflex.php';
			$strall=$contents[0];
	}
		$usergroup=(array)unserialize($it618_firstnflex['usergroup']);

		if(in_array(2, $contentstyle)){
			$cols=3;
		}else{
			$cols=2;
		}

		if(empty($usergroup[0]) || in_array($_G['groupid'], $usergroup)){
			include template('it618_firstnflex:firstnflex');
			return $it618_firstnflex_block;
		}
		
	}
	
	function index_top(){
		global $_G;
		$it618_firstnflex = $_G['cache']['plugin']['it618_firstnflex'];
		if($it618_firstnflex['indextop']==1)return $this->it618_hook();else return "";
	}
}

class plugin_it618_firstnflex extends plugin_it618_firstnflex_forum{
	
	function global_header(){
		$blockname="it618_firstnflex";
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