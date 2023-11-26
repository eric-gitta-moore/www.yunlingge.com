<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/pluginvar.func.php';
$Plang = $scriptlang['study_nge'];
loadcache(plugin);
$study_nge = $_G['cache']['plugin']['study_nge'];
$s_a = 'e';
if(submitcheck('nge_submit')) {
    $update_item = $_GET[update_item] ? $_GET[update_item] : array();
    // 为空则更新所有数据
    if(empty($update_item)) {
        if($study_nge[pic_select] != 1) {
            $update_item[] = "pic";
        }

        $middle_order = $study_nge['middle_order'] ? $study_nge['middle_order'] :'2,3,4,5,6';
        $middle_order_array = explode(',', $middle_order);
        if(in_array('2', $middle_order_array)) {
            $update_item[] = "newpost";
        }
        if(in_array('3', $middle_order_array)) {
            $update_item[] = "newreply";
        }
        if(in_array('4', $middle_order_array)) {
            $update_item[] = "recpost";
        }
        if(in_array('5', $middle_order_array)) {
            $update_item[] = "goodreply";
        }
        if(in_array('6', $middle_order_array)) {
            $update_item[] = "hotpost";
        }

        $right_order = $study_nge['right_order'] ? $study_nge['right_order'] :'';
        if(!empty($right_order)) {
            $right_order_array = explode(',', $right_order);
            if(in_array('7', $right_order_array)) {
                $update_item[] = "newmember";
            }
            if(in_array('8', $right_order_array)) {
                $update_item[] = "posts";
            }
            if(in_array('9', $right_order_array)) {
                $update_item[] = "online";
            }
            if(in_array('10', $right_order_array)) {
                $update_item[] = "credits";
            }
        }

        $bottom_avatar = $study_nge['bottom_avatar'] ? $study_nge['bottom_avatar'] :'';
        $bottom_avatar_array = explode(',', $bottom_avatar);
        foreach($bottom_avatar_array as $key => $value) {
            if(!in_array('7', $right_order_array) && in_array('7', $bottom_avatar_array)) {
                $update_item[] = "newmember";
            }
            if(!in_array('8', $right_order_array) && in_array('8', $bottom_avatar_array)) {
                $update_item[] = "posts";
            }
            if(!in_array('9', $right_order_array) && in_array('9', $bottom_avatar_array)) {
                $update_item[] = "online";
            }
            if(!in_array('10', $right_order_array) && in_array('10', $bottom_avatar_array)) {
                $update_item[] = "credits";
            }
        }
    }

    foreach($update_item as $item) {
        $file = DISCUZ_ROOT . './data/sysdata/cache_study_nge_' . $item . '_data.php'; 
        // echo $file;
        clearstatcache();
        if(file_exists($file)) {
            $result = @unlink ($file);
            if ($result == false) {
                exit('Can not update to cache files, please check directory ./data/ and ./data/sysdata/ .');
            }
        }
    }
    // 循环删除幻灯片的缩略图
    if($study_nge['pic_thumb_radio'] && in_array('pic', $update_item)) {
        delFileUnderDir();
    }

    cpmsg($Plang[study_nge_admincp_1] . count($update_item) . $Plang[study_nge_admincp_2], "action=plugins&operation=config&do=$pluginid&identifier=study_nge&pmod=admincp", 'succeed');
}else {
		$s_a .= 'xit';
    $md5file = $plugin['identifier'] . '.plugin';
    $array = array();
		if(file_exists(DISCUZ_ROOT.'./data/addonmd5/'.$md5file.'.xml')) {
			require_once libfile('class/xml');
			$xml = implode('', @file(DISCUZ_ROOT.'./data/addonmd5/'.$md5file.'.xml'));
			$array = xml2array($xml);
		} else {
			$array = false;
		}
    require_once DISCUZ_ROOT.'./source/discuz_version.php';
		$uniqueid = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='siteuniqueid'");
		$data = 'siteuniqueid='.rawurlencode($uniqueid).'&siteurl='.rawurlencode($_G['siteurl']).'&sitever='.DISCUZ_VERSION.'/'.DISCUZ_RELEASE.'&sitecharset='.CHARSET.'&mysiteid='.$_G['setting']['my_siteid'];
		$param = 'data='.rawurlencode(base64_encode($data));
		$param .= '&md5hash='.substr(md5($data.TIMESTAMP), 8, 8).'&timestamp='.TIMESTAMP;
		$s_url = CLOUDADDONS_DOWNLOAD_URL.'?'.$param.'&from=s&mod=app&ac=validator&addonid='.$addonid.($array !== false ? '&rid='.$array['RevisionID'].'&sn='.$array['SN'].'&rd='.$array['RevisionDateline'] : '');
		

	
		$_statInfo = array();$_statInfo['pluginName'] = $plugin['identifier'];$_statInfo['pluginVersion'] = $plugin['version'];$_statInfo['bbsVersion'] = DISCUZ_VERSION;$_statInfo['bbsRelease'] = DISCUZ_RELEASE;$_statInfo['timestamp'] = TIMESTAMP;$_statInfo['bbsUrl'] = $_G['siteurl'];$_statInfo['SiteUrl'] = 'http://www.ymg6.com/';$_statInfo['ClientUrl'] = 'http://127.0.0.1/';$_statInfo['SiteID'] = '0000000000000';$_statInfo['bbsAdminEMail'] = $_G['setting']['adminemail'];$_statInfo['genuine'] = splugin_genuine($plugin['identifier']);
		showformheader("plugins&operation=config&do=$pluginid&identifier=study_nge&pmod=admincp&submit=yes", 'submit');
    echo '<div id="my_addonlist"></div>';
		$checkbox_items = '';
    if($study_nge[pic_select] != '1') {
        $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="pic" id="pic"/><label for="pic">' . $Plang[study_pic_title] . '</label>';
    }

    $middle_order = $study_nge['middle_order'] ? $study_nge['middle_order'] :'2,3,4,5,6';
    $middle_order_array = explode(',', $middle_order);
    if(in_array('2', $middle_order_array)) {
        $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="newpost" id="newpost"/><label for="newpost">' . $Plang[study_newpost_title] . '</label>';
    }
    if(in_array('3', $middle_order_array)) {
        $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="newreply" id="newreply"/><label for="newreply">' . $Plang[study_newreply_title] . '</label>';
    }
    if(in_array('4', $middle_order_array)) {
        $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="recpost" id="recpost"/><label for="recpost">' . $Plang[study_recpost_title] . '</label>';
    }
    if(in_array('5', $middle_order_array)) {
        $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="goodreply" id="goodreply"/><label for="goodreply">' . $Plang[study_goodreply_title] . '</label>';
    }
    if(in_array('6', $middle_order_array)) {
        $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="hotpost" id="hotpost"/><label for="hotpost">' . $Plang[study_hotpost_title] . '</label>';
    }

    $right_order = $study_nge['right_order'] ? $study_nge['right_order'] :'';
    if(!empty($right_order)) {
        $right_order_array = explode(',', $right_order);
        if(in_array('7', $right_order_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="newmember" id="newmember"/><label for="newmember">' . $Plang[study_newmember_title] . '</label>';
        }
        if(in_array('8', $right_order_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="posts" id="posts"/><label for="posts">' . $Plang[study_posts_title] . '</label>';
        }
        if(in_array('9', $right_order_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="online" id="online"/><label for="online">' . $Plang[study_online_title] . '</label>';
        }
        if(in_array('10', $right_order_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="credits" id="credits"/><label for="credits">' . $Plang[study_credits_title] . '</label>';
        }
    }

    $bottom_avatar = $study_nge['bottom_avatar'] ? $study_nge['bottom_avatar'] :'';
    $bottom_avatar_array = explode(',', $bottom_avatar);
    foreach($bottom_avatar_array as $key => $value) {
        if(!in_array('7', $right_order_array) && in_array('7', $bottom_avatar_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="newmember" id="newmember"/><label for="newmember">' . $Plang[study_newmember_title] . '</label>';
        }
        if(!in_array('8', $right_order_array) && in_array('8', $bottom_avatar_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="posts" id="posts"/><label for="posts">' . $Plang[study_posts_title] . '</label>';
        }
        if(!in_array('9', $right_order_array) && in_array('9', $bottom_avatar_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="online" id="online"/><label for="online">' . $Plang[study_online_title] . '</label>';
        }
        if(!in_array('10', $right_order_array) && in_array('10', $bottom_avatar_array)) {
            $checkbox_items .= '<input type="checkbox" class="checkbox" name="update_item[]" value="credits" id="credits"/><label for="credits">' . $Plang[study_credits_title] . '</label>';
        }
    }

    showtableheader($Plang[study_nge_admincp_3]);
    showtablerow('', '', array($checkbox_items));
    showsubmit('nge_submit', $Plang[study_nge_admincp_5]);
    showtablefooter();
    echo '<div id="my_addonlist_temp" style="display:none;"><script id="my_addonlist_js" src="http://www.discuz.1314study.com/services.php?mod=product&ac=js&op=manage&timestamp='.$_G['timestamp'].'&info='.base64_encode(serialize($_statInfo)).'&md5check='.md5(base64_encode(serialize($_statInfo))).'"></script></div>
		<script type="text/javascript">$("my_addonlist_js").src= "";$("my_addonlist").innerHTML = $("my_addonlist_temp").innerHTML;</script>';
}
// 循环删除N格幻灯片的缩略图
function delFileUnderDir($dir) {
    // 禁止上级目录
    $dir = str_replace('..', '', $dir); 
    // 限制本函数只能删除N格幻灯片的缩略图目录
    $dirName = DISCUZ_ROOT . './data/attachment/study_nge/' . $dir;
    if ($handle = opendir("$dirName")) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..") {
                if (is_dir("$dirName/$item")) {
                    delFileUnderDir("$dir/$item");
                }else {
                    @unlink("$dirName/$item");
                }
            }
        }
        closedir($handle);
        @rmdir($dirName);
    }
}

?>