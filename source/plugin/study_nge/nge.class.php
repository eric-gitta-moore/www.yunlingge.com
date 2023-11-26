<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
class plugin_study_nge {
		
		function global_header(){
				global $_G;
				$return = '';
				if(CURSCRIPT == 'portal'){
	        $return = $this->_nge_output();
	        $return = $return ? '<div class="wp" style="padding-top: 10px;">'.$return.'</div>' : '';
	      }
        return $return;
		}
		
		function _nge_output() {
        global $_G;
        $return = '1314study.com';
        // 获取插件配置
        $study_nge = $_G['cache']['plugin']['study_nge'];
        $splugin_lang = lang('plugin/study_nge');
        $common_show = (array)unserialize($study_nge['common_show']);
        $flag = false;
        if(CURSCRIPT == 'portal'){
		        if(CURMODULE == 'index' && in_array(1, $common_show)){
		        	$flag = true;
		        }
	      }elseif(CURSCRIPT == 'forum'){
		      	if(empty($_GET['gid'])){
		      		if(in_array(2, $common_show)){
			        	$flag = true;
			        }
		        }elseif(in_array(3, $common_show)){
		        	$flag = true;
		        }
	      }
        
	    	if($flag){
	        include_once libfile('class/func', 'plugin/study_nge/source');
	        include_once libfile('class/mysql', 'plugin/study_nge/source');
	        include_once libfile('class/get_data', 'plugin/study_nge/source');
	    		$common_gids = (array)unserialize($study_nge['common_gids']);
					if(!in_array($_G['groupid'], $common_gids)){
			        $return = '1314study.com';
			        $_G['setting']['showusercard'] = intval($study_nge['showusercard_radio']);
			        if($study_nge['common_fid_radio'] || $study_nge['threadcard_select2'] == '2') {
			            loadcache('forums');
			            $study_nge_forums = array();
  					if($_G['setting']['version'] == 'X2.5' && $study_nge['common_strip_tags_radio']) {
			                foreach($_G['cache']['forums'] as $key => $value) {
			                    $study_nge_forums[$key]['name'] = strip_tags($value['name']);
			                }
			            }else {
			                $study_nge_forums = $_G['cache']['forums'];
			            }
			        }
			        // 链接是否新帖打开
			        $target_blank_radio = $study_nge['target_blank_radio'] == 1 ? ' target="_blank"' : '';
			
			        $thread_num = $study_nge['data_num'] ? $study_nge['data_num'] : '10';
			        // 幻灯片信息处理 START
			        if($study_nge['pic_select'] != 1) {
			            $study_slide['data_num'] = $study_nge['data_num'] ? $study_nge['data_num'] : '10';
			            $study_slide['height'] = 25 * $thread_num;
			            // $study_slide['width'] = 30*$thread_num;
			            $study_slide['width'] = $study_nge['pic_thumb_w'];
			            $study_slide['pic_cut'] = $study_nge['pic_cut'] ? $study_nge['pic_cut'] :'3';
			            $study_slide['title_radio'] = $study_nge['pic_title_radio'];
			            $study_slide['title_color'] = $study_nge['pic_color'] ? $study_nge['pic_color'] :'#FFFFFF';;
			            $study_slide['title_bgcolor'] = $study_nge['pic_bgcolor'] ? $study_nge['pic_bgcolor'] :'#3399FF';
			            $study_slide['title_bgtransparent'] = $study_nge['pic_transparent'] ? $study_nge['pic_transparent'] : '80';
			            $study_slide['title_bgtransparent_noie'] = $study_slide['title_bgtransparent'] / 100;
			
			            $pic_title = $study_nge['pic_title'] ? $study_nge['pic_title'] : $splugin_lang['study_pic_title'];
			            $nge_data['content']['image']['new'] = study_nge::get_image();
			        }
			        // 幻灯片信息处理 END
			        // 帖子信息处理 START
			        $threads_existid_key = array(2, 3, 4, 5, 6);
			        $threads_existid_value = array('2' => 'newpost', '3' => 'newreply', '4' => 'recpost', '5' => 'goodreply', '6' => 'hotpost');
			        $middle_active_array[2] = $study_nge['newpost_title'] ? $study_nge['newpost_title'] : $splugin_lang['study_newpost_title'];
			        $middle_active_array[3] = $study_nge['newreply_title'] ? $study_nge['newreply_title'] : $splugin_lang['study_newreply_title'];
			        $middle_active_array[4] = $study_nge['recpost_title'] ? $study_nge['recpost_title'] : $splugin_lang['study_recpost_title'];
			        $middle_active_array[5] = $study_nge['goodreply_title'] ? $study_nge['goodreply_title'] : $splugin_lang['study_goodreply_title'];
			        $middle_active_array[6] = $study_nge['hotpost_title'] ? $study_nge['hotpost_title'] : $splugin_lang['study_hotpost_title'];
			
			        $nge_config['threads']['right_reply'] = $study_nge['common_tiezi_right_reply'] ? explode(',', $study_nge['common_tiezi_right_reply']) : array('3');
			
			        $middle_order = $study_nge['middle_order'] ? $study_nge['middle_order'] :'2,3,4,5,6';
			        $middle_order_array = explode(',', $middle_order);
			        foreach($middle_order_array as $key => $active_id) {
			            if(in_array($active_id, $threads_existid_key)) {
			                $type = $threads_existid_value[$active_id];
			                $nge_data['content']['threads'][$type] = study_nge::get_threads($type);
			                if(in_array($active_id, $nge_config['threads']['right_reply'])) {
			                    $nge_data['config']['threads'][$type]['right_reply'] = true;
			                }
			                $nge_data['nav']['threads'][$type] = $middle_active_array[$active_id];
			                $nge_data['id']['threads'][] = $type;
			            }
			        }
			        $nge_data['count']['threads'] = count($nge_data['nav']['threads']);
			        $nge_data['lastid']['threads'] = $nge_data['id']['threads'][($nge_data['count']['threads']-1)];
			        // 帖子信息处理 END
			        $member_active_array[7] = $study_nge['newmember_title'] ? $study_nge['newmember_title'] : $splugin_lang['study_newmember_title'];
			        $member_active_array[8] = $study_nge['posts_title'] ? $study_nge['posts_title'] : $splugin_lang['study_posts_title'];
			        $member_active_array[9] = $study_nge['online_title'] ? $study_nge['online_title'] : $splugin_lang['study_online_title'];
			        $member_active_array[10] = $study_nge['credits_title'] ? $study_nge['credits_title'] : $splugin_lang['study_credits_title'];
			        // 右侧会员信息处理 SYART
			        $right_order = $study_nge['right_order'] ? $study_nge['right_order'] :'';
			        if(!empty($right_order) && $study_nge['template_default'] != 'xshow') {
			            $members_existid_key = array(7, 8, 9, 10);
			            $members_existid_value = array('7' => 'newmember', '8' => 'posts', '9' => 'online', '10' => 'credits');
			            $right_order_array = explode(',', $right_order);
			            // print_r(study_nge::get_members(credits));
			            $flag = 1;
			            foreach($right_order_array as $key => $active_id) {
			                if(in_array($active_id, $members_existid_key)) {
			                    $type = $members_existid_value[$active_id];
			                    if($flag == '1') {
			                        $nge_data['first']['members'] = $type;
			                        $flag = '1314';
			                    }
			                    $nge_data['content']['members'][$type] = study_nge::get_members($type);
			                    $nge_data['nav']['members'][$type] = $member_active_array[$active_id];
			                    $nge_data['id']['members'][] = $type;
			                }
			            }
			            $nge_data['count']['members'] = count($nge_data['nav']['members']);
			            $nge_data['lastid']['members'] = $nge_data['id']['members'][($nge_data['count']['members']-1)];
			        }
			        // 右侧会员信息处理 END
			        // 底部会员信息处理 SYART
			        $bottom_avatar = $study_nge['bottom_avatar'] ? $study_nge['bottom_avatar'] :'';
			        if(!empty($bottom_avatar)) {
			        		$members_existid_key = array(7, 8, 9, 10);
			            $members_existid_value = array('7' => 'newmember', '8' => 'posts', '9' => 'online', '10' => 'credits');
			            $bottom_avatar_array = explode(',', $bottom_avatar);
			            $flag = 1;
			            foreach($bottom_avatar_array as $key => $active_id) {
			                if(in_array($active_id, $members_existid_key)) {
			                    $type = $members_existid_value[$active_id];
			                    if($nge_data['content']['members'][$type]) {
			                        $nge_data['content']['bottom_avatar'][$type] = $nge_data['content']['members'][$type];
			                    }else {
			                        $nge_data['content']['bottom_avatar'][$type] = study_nge::get_members($type);
			                    }
			                    $nge_data['nav']['bottom_avatar'][$type] = $member_active_array[$active_id];
			                    $nge_data['id']['bottom_avatar'][] = $type;
			                }
			            }
			        }
			        // 底部会员信息处理 END
			        
			        if($return == '1314study.com'){
				        // 使用的模板
				        $study_nge['template_default'] = ($study_nge['template_default'] && in_array($study_nge['template_default'], array('default', 'phpwind', 'xshow')))? $study_nge['template_default'] : 'default';
				        // $study_nge['template_default'] = 'default';
				        require_once DISCUZ_ROOT . './source/plugin/study_nge/template/' . $study_nge['template_default'] . '/config.php';
				        // 模板参数
				        $study_nge_temp_style['header_color'] = $study_nge['header_color'] ? 'BACKGROUND:' . $study_nge['header_color'] : ($_G['style']['titlebgcode'] ? $_G['style']['titlebgcode']: 'background: url(' . $_G['style']['imgdir'] . '/title.jpg) repeat-x 0 -3px');
				        //$study_nge_temp_style['header_font'] = 'font: ' . $_G['style']['fontsize'] .' '. $_G['style']['font'] . '; color: ' . $_G['style']['tabletext'] . ';';
				        $study_nge_temp_style['border_color'] = $study_nge['border_color'] ? $study_nge['border_color'] : $_G['style']['specialborder'];
				        $study_nge_temp_style['common_tiezi_right_color'] = $study_nge['common_tiezi_right_color'] ? $study_nge['common_tiezi_right_color']:'#95B9FF';
				        $study_nge_temp_style['common_hy_right_color'] = $study_nge['common_hy_right_color'];
				        // 加载风格自己的处理文件
				        $file = DISCUZ_ROOT . './source/plugin/study_nge/template/' . $study_nge['template_default'] . '/' . $nge_config['output_file'] . '.php';
				        if(file_exists($file)) {
				            require_once $file;
				        }
				        // 帖子右侧内容颜色
				        $nge_config['tiezi_right_color'] = $study_nge['common_tiezi_right_color'] ? $study_nge['common_tiezi_right_color'] : '#95B9FF';
				        
				        //配色
				        if($study_nge['common_extstyle'] != getcookie('study_nge_extstyle_default')){
				        		dsetcookie('study_nge_extstyle', $study_nge['common_extstyle'], 86400 * 365);
					      }
					      dsetcookie('study_nge_extstyle_default', $study_nge['common_extstyle'], 86400 * 365);
				        $splugin_cookie['extstyle'] = getcookie('study_nge_extstyle');
				        if(empty($splugin_cookie['extstyle'])){
				        		$splugin_cookie['extstyle'] = $study_nge['common_extstyle'];
				        }
				        
				        //收起展开N格
				        $splugin_cookie['toggle_category_study_nge'] = getcookie('toggle_category_study_nge');
				        
						include template('study_nge:' . $study_nge['template_default'] . '/' . $nge_config['nge_temp']);
				    	}
					}
				}
        return $return == '1314study.com' ? '' : $return;
    }
}
class plugin_study_nge_forum extends plugin_study_nge {
    function index_top_output() {
        global $_G;
        $return = $this->_nge_output();
        return $return;
    }

    function viewthread_postfooter_output() {
		global $_G;
		
        $return = '';
        $splugin_setting = $_G['cache']['plugin']['study_nge'];
        $recpost_fids = (array)unserialize($splugin_setting['recpost_fids']);
        $middle_order = $splugin_setting['middle_order'] ? $splugin_setting['middle_order'] : '2,3,4,5,6';
        $middle_order_array = explode(',', $middle_order);
        if(in_array('4',$middle_order_array)){
	        if((empty($recpost_fids[0]) && count($recpost_fids) < 2) || in_array($_G['fid'],$recpost_fids)) {
		        	$recpost_admin_gids = (array)unserialize($splugin_setting['recpost_admin_gids']);
							if(in_array($_G['groupid'],$recpost_admin_gids)){
		            	$return = '<a href="javascript:;" style=" background: url(/template/quater_6_motion/src/ding.png) no-repeat 0 50%;" onclick=\'showWindow("recpost", "plugin.php?id=study_nge:recpost&handlekey=recpost&tid='.$_G[tid].'&formhash='.$_G[formhash].'","get","0");return false;\' title="&#x63A8;&#x8350;&#x5230;N&#x683C;">&#x63A8;&#x8350;&#x5230;N&#x683C;</a>';
		          }
	        }
	      }//echo base64_encode($return);exit;
        return [$return];
    }
}


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: nge.class.php 13281 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。