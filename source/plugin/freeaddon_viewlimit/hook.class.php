<?php

/**
 * Copyright 2001-2099 1314学习网.
 * This is NOT a freeware, use is subject to license terms
 * $Id: hook.class.php 7705 2019-11-26 13:03:13Z zhuge $
 * 应用售后问题：http://www.1314study.com/services.php?mod=issue
 * 应用售前咨询：QQ 15326940
 * 应用定制开发：QQ 643306797
 * 本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
 * 未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。
 */
if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_freeaddon_viewlimit {

}
class plugin_freeaddon_viewlimit_forum extends plugin_freeaddon_viewlimit {
	function viewthread_modoption_output(){
			global $_G,$postlist;

			$splugin_setting = $_G['cache']['plugin']['freeaddon_viewlimit'];
			$study_groups = unserialize($splugin_setting['study_groups']);
			$study_fids = unserialize($splugin_setting['study_fid']);
			$limitway = $splugin_setting['study_limitway'];
			$pcstyle = $splugin_setting['study_bgstyle'];
			$study_bgfids = unserialize($splugin_setting['study_bgfid']);

			$study_adway = $splugin_setting['study_adway'];
			$study_ad = $splugin_setting['study_ad'];


      if($pcstyle == '1'){
      	        require_once libfile('function/core', 'plugin/freeaddon_viewlimit/source');
				$leftarrows = freeaddon_viewlimittext();
			}else{

				$leftarrows = '';
				if($pcstyle == '5'){
					$pcstyle = '1';
				}
			}

			if(!IS_ROBOT){
				if(in_array($_G['groupid'], $study_groups)){
					if(in_array($_G['fid'], $study_fids)){
		        foreach ($postlist as $id=> $post){
							if($post['first'] && (!$post['authorid'] || $post['authorid'] != $_G['uid'])){
								if($study_adway == '2'){
									if($post['first']){
										$study_ads[$id] = !empty($study_ad) ? '<div>'.$study_ad.'</div>' : '';
									}else{
										$study_ads[$id] = '';
									}
								}else if($study_adway == '3'){
									if($post['first']){
										$study_ads[$id] = '';
									}else{
										$study_ads[$id] = !empty($study_ad) ? '<div>'.$study_ad.'</div>' : '';
									}
								}else if($study_adway == '4'){

										$study_ads[$id] = !empty($study_ad) ? '<div>'.$study_ad.'</div>' : '';

								}else{
										$study_ads[$id] = '';
								}

								if($post['first']){
									$study_number = $splugin_setting['study_tnumber'];
									$study_pcontent = $splugin_setting['study_tpcontent'];
								}else{
									$study_number = $splugin_setting['study_pnumber'];
									$study_pcontent = $splugin_setting['study_ppcontent'];
		           	}


								$find1 = '[login]';
								$find2 = '[reg]';
							 	$replace1 = '<a style="text-decoration:none;" onclick="showWindow(\'login\', this.href);hideWindow(\'register\');" href="member.php?mod=logging&action=login">'.$splugin_setting['study_loginname'].'</a>';
								$replace2 = '<a style="text-decoration:none;" onclick="showWindow(\'register\', this.href);hideWindow(\'login\');" href="member.php?mod='.$_G['setting']['regname'].'">'.$splugin_setting['study_regname'].'</a>';

								$study_pcontent = str_replace($find1,$replace1,$study_pcontent);
								$study_pcontent = str_replace($find2,$replace2,$study_pcontent);
								$pcontent[$id] = '<br /><div class="locked"><EM>'.$study_pcontent.'</EM></div>';

								if($limitway == '2'){
										if($post['first']){
											if($splugin_setting['study_sthread'] == '3'){

												$postlist[$id]['message'] = messagecutstr($post['message'], $study_number);

				           		}else if($splugin_setting['study_sthread'] == '2'){

				           			$postlist[$id]['message'] = '';

				           		}
			           		}
	//		           		else{
	//		           			if($splugin_setting['study_spost'] == '3'){
	//
	//											$postlist[$id]['message'] = messagecutstr($post['message'], $study_number);
	//
	//			           		}else if($splugin_setting['study_spost'] == '2'){
	//
	//			           			$postlist[$id]['message'] = '';
	//
	//			           		}
	//		           		}
								}else if($limitway == '1'){

		           		if($post['first']){
											if($splugin_setting['study_sthread'] == '3'){

													$postlist[$id]['message'] = '<div id="postmessage_'.$post[pid].'" class="t_f" style="height:'.$study_number.'px; overflow:hidden;">'.$post['message'].'</div>';

				           		}else if($splugin_setting['study_sthread'] == '2'){

				           				$postlist[$id]['message'] = '<div id="postmessage_'.$post[pid].'" class="t_f" style="height:0px; overflow:hidden;">'.$post['message'].'</div>';

				           		}
		           		}
	//	           		else{
	//	           			if($splugin_setting['study_spost'] == '3'){
	//
	//											$postlist[$id]['message'] = '<div id="postmessage_'.$post[pid].'" class="t_f" style="height:'.$study_number.'px; overflow:hidden;">'.$post['message'].'</div>';
	//
	//		           		}else if($splugin_setting['study_spost'] == '2'){
	//
	//		           				$postlist[$id]['message'] = '<div id="postmessage_'.$post[pid].'" class="t_f" style="height:0px; overflow:hidden;">'.$post['message'].'</div>';
	//
	//		           		}
	//	           		}
								}
							}
						}
					}
				}
				foreach ($postlist as $id=> $post){

						if($post['first']){
							$study_tops = $splugin_setting['study_ttop'];
						}else{
							$study_tops = $splugin_setting['study_ptop'];
           	}

						$find_date = '[date]';
						$find_name = '[name]';
					 	$replace_date = $post['dateline'];
						$replace_name = '<a href="home.php?mod=space&uid='.$post['authorid'].'" target="_blank"><font color="#0000FF">'.$post['author'].'</font></a>';

         		$study_tops = explode("\r\n",$study_tops);
						$count_top = count($study_tops) - 1;
						if(empty($study_tops[$count_top])){
								$count_top = $count_top - 1;
						}
						if($count_top >= 0){
						 	$study_top = $study_tops[rand(0,$count_top)];

							$study_nowtop = str_replace($find_date,$replace_date,$study_top);
							$study_nowtop = str_replace($find_name,$replace_name,$study_nowtop);

							if(!empty($study_nowtop)){
								$study_nowtops[$id] = '<font color=#a7a7a7>'.$study_nowtop.'</font><br /><br /><hr size="1" noshade="noshade" style="border-top:1px #dddddd dashed;margin-bottom: 0px;margin-top: -1px;"/><br />';
							}else{
								$study_nowtops[$id] = "";
							}
						}
						$study_nowtop = '';

						if($pcstyle != '6'){
							if(in_array($_G['fid'], $study_bgfids)){
								$postlist[$id]['message'] = '<table cellspacing="0" cellpadding="0" border="0"><tr><td width="40"><img height="40" src="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_top_l.gif" width="40"/></td><td width:=auto background="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_top_c.gif"></td><td width="40"><img height="40" src="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_top_r.gif" width="40"/></td></tr><tr><td valign="top" background="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_center_l.gif">'.$leftarrows.'</td><td background="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_center_c.gif">'.$study_nowtops[$id].$postlist[$id]['message'].'<br />'.$study_ads[$id].$pcontent[$id].'</td><td valign="top" width="40" background="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_center_r.gif"></td></tr><tr><td vAlign="top" width="40"><img height="40" src="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_foot_l.gif" width="40"/></td><td background="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_foot_c.gif"></td><td align="right" width="40"><img height="40" src="source/plugin/freeaddon_viewlimit/images/'.$pcstyle.'/study_foot_r.gif" width="40"/></td></tr></table>';
							}else{
								$postlist[$id]['message'] = $postlist[$id]['message'].'<br />'.$study_ads[$id].$pcontent[$id];
							}
						}else{
							$postlist[$id]['message'] = $postlist[$id]['message'].'<br />'.$study_ads[$id].$pcontent[$id];
						}
				}
			}
	 		return '';
	}

}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: hook.class.php 8151 2019-11-26 05:03:13Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。