<?php

if(!defined('IN_DISCUZ')) {

    exit('Access Denied');

}




class plugin_yunling_storage {

    function common(){
        C::import('yunling_storage','plugin/yunling_storage/source/class');

        global $_G;

        $upload_path = $_G['cache']['plugin']['yunling_storage']['upload_path'];
        $_G['cache']['plugin']['yunling_storage']['upload_path'] = trim($upload_path," \t\n\r\0\x0B/");
        $_G['cache']['plugin']['yunling_storage']['upload_path'] .= '/';


        $_G['setting']['ftp']['attachurl'] = strstr($_G['cache']['plugin']['yunling_storage']['cdn_url'], -1) == '/' ? $_G['cache']['plugin']['yunling_storage']['cdn_url'] : $_G['cache']['plugin']['yunling_storage']['cdn_url'].'/';
        $_G['setting']['ftp']['attachurl'] = !empty($upload_path)?$_G['setting']['ftp']['attachurl'].$_G['cache']['plugin']['yunling_storage']['upload_path']:$_G['setting']['ftp']['attachurl'];

    }


    function getremotefile($file) {

        global $_G;
        @set_time_limit(0);
        if(!@readfile($_G['setting']['ftp']['attachurl'].'forum/'.$file)) {
            $ftp = ftpcmd('object');
            $tmpfile = @tempnam($_G['setting']['attachdir'], '');
            if($ftp->ftp_get($tmpfile, 'forum/'.$file, FTP_BINARY)) {
                @readfile($tmpfile);
                @unlink($tmpfile);
            } else {
                @unlink($tmpfile);
                return FALSE;
            }
        }
        return TRUE;
    }

    function getlocalfile($filename, $readmod = 2, $range = 0) {
        if($readmod == 1 || $readmod == 3 || $readmod == 4) {
            if($fp = @fopen($filename, 'rb')) {
                @fseek($fp, $range);
                if(function_exists('fpassthru') && ($readmod == 3 || $readmod == 4)) {
                    @fpassthru($fp);
                } else {
                    echo @fread($fp, filesize($filename));
                }
            }
            @fclose($fp);
        } else {
            @readfile($filename);
        }
        @flush(); @ob_flush();
    }

}



class plugin_yunling_storage_home extends plugin_yunling_storage {

//	 function spacecp_blog_upload_extend(){
//	 	global $_G;
//	 	require_once libfile('function/upload');
//
//	 	$swfconfig = getuploadconfig($_G['uid'], $_G['fid']);
//	 	$imgexts = str_replace(array(';', '*.'), array(', ', ''), $swfconfig['imageexts']['ext']);
//	 	$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
//	 	include template('yunling_storage:blog_upload');
//	 	return $return;
//	 }
}

class plugin_yunling_storage_forum extends plugin_yunling_storage {

    function post_upload_extend(){
        global $_G;

        $zms_storage = new yunling_storage();

        $upload_host = $zms_storage -> config['host'];
        $cdn_url = $zms_storage -> config['cdn_url'];

        $filepath = 'forum'.'/'.$zms_storage->get_target_dir('forum',0);

        require_once libfile('function/upload');

        $swfconfig = getuploadconfig($_G['uid'], $_G['fid']);

        $imgexts = str_replace(array(';', '*.'), array(', ', ''), $swfconfig['imageexts']['ext']);

        $allowpostimg = $_G['group']['allowpostimage'] && $imgexts;

        include template('yunling_storage:upload');
        return $return;
    }

    function forumdisplay_fastpost_upload_extend(){
        global $_G;

        $zms_storage = new yunling_storage();

        $upload_host = $zms_storage -> config['host'];
        $cdn_url = $zms_storage -> config['cdn_url'];

        require_once libfile('function/upload');
        $swfconfig = getuploadconfig($_G['uid'], $_G['fid']);
        $imgexts = str_replace(array(';', '*.'), array(', ', ''), $swfconfig['imageexts']['ext']);
        $allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
        include template('yunling_storage:fast_upload');
        return $return;

    }

    function viewthread_fastpost_upload_extend(){
        global $_G;

        $zms_storage = new yunling_storage();

        $upload_host = $zms_storage -> config['host'];
        $cdn_url = $zms_storage -> config['cdn_url'];

        require_once libfile('function/upload');
        $swfconfig = getuploadconfig($_G['uid'], $_G['fid']);
        $imgexts = str_replace(array(';', '*.'), array(', ', ''), $swfconfig['imageexts']['ext']);
        $allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
        include template('yunling_storage:fast_upload');
        return $return;
    }

    /**
     * 获取图片
     * @param $aid
     * @param int $nocache
     * @param int $w
     * @param int $h
     * @param string $type
     * @param string $key
     * @param bool $direct_output 直接输出header
     * @return bool|string
     */
    public function _image($aid, $nocache = 0, $w = 140, $h = 140, $type = '',$key='',$direct_output = false)
    {
        global $_G;

        $nocache = !empty($nocache) ? 1 : 0;
        $daid = intval($aid);
        $type = !empty($type) ? $type : 'fixwr';
        $dw = intval($w);
        $dh = intval($h);
        $key = empty($_GET['key'])?$key:$_GET['key'];

        $thumbfile = 'image/'.helper_attach::makethumbpath($daid, $dw, $dh);$attachurl = helper_attach::attachpreurl();
        if(!$nocache) {
            if(file_exists($_G['setting']['attachdir'].$thumbfile)) {
                return $attachurl.$thumbfile;
//                dheader('location: '.$attachurl.$thumbfile);
            }
        }

        define('NOROBOT', TRUE);

        $id = !empty($_GET['atid']) ? $_GET['atid'] : $daid;
        if(dsign($id.'|'.$dw.'|'.$dh) != $key) {
            return $_G['siteurl'].'static/image/common/none.gif';
//            dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
        }

        if($attach = C::t('forum_attachment_n')->fetch('aid:'.$daid, $daid, array(1, -1))) {
            if(!$dw && !$dh && $attach['tid'] != $id) {
                return $_G['siteurl'].'static/image/common/none.gif';
//                dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
            }
            if($attach['remote']) {

                $config = $_G['cache']['plugin']['yunling_storage'];
                $water = '';
                if ($config['iswater']) {
                    $water = '/'.$config['water_field'];
                }
                if (!empty($config['image_url']))
                {
                    $signUrl = $_G['cache']['plugin']['yunling_storage']['image_url'];
                    $signUrl = rtrim($signUrl,'/') . '/' . $config['upload_path'] . 'forum/' . $attach['attachment'] . $water;
                    return $signUrl;
//                    dheader('location: '.$signUrl);
                }
                else
                {
                    $signUrl = $this->ossSignatureUrlWithUploadPathThenReturnWithout('forum/'.$attach['attachment'].$water);
                    return $_G['setting']['ftp']['attachurl'].$signUrl;
//                    dheader('location: '.$_G['setting']['ftp']['attachurl'].$signUrl);
                }
            } else {
                $filename = $_G['setting']['attachdir'].'forum/'.$attach['attachment'];
                require_once libfile('class/image');
                $img = new image;
                if($img->Thumb($filename, $thumbfile, $w, $h, $type)) {
                    if($nocache) {
                        if ($direct_output)
                        {
                            dheader('Content-Type: image');
                            @readfile($_G['setting']['attachdir'].$thumbfile);
                            @unlink($_G['setting']['attachdir'].$thumbfile);
                        }
                        else
                        {
                            return $thumbfile;
                        }
                    } else {
                        return $attachurl.$thumbfile;
//                        dheader('location: '.$attachurl.$thumbfile);
                    }
                } else {
                    if ($direct_output)
                    {
                        dheader('Content-Type: image');
                        @readfile($filename);
                    }
                    else
                    {
                        return $filename;
                    }
                }
            }
        }
        return false;
    }

    function image(){
        global $_G;

        list($w, $h) = explode('x', $_GET['size']);

        $location = $this->_image($_GET['aid'],$_GET['nocache'],$w,$h,$_GET['type'],true);
        if ($location !== false)
        {
            dheader('location: '.$location);
        }
    }

    function attachment(){
        global $_G;

        @list($_GET['aid'], $_GET['k'], $_GET['t'], $_GET['uid'], $_GET['tableid']) = daddslashes(explode('|', base64_decode($_GET['aid'])));

        $requestmode = !empty($_GET['request']) && empty($_GET['uid']);
        $aid = intval($_GET['aid']);
        $k = $_GET['k'];
        $t = $_GET['t'];
        $authk = !$requestmode ? substr(md5($aid.md5($_G['config']['security']['authkey']).$t.$_GET['uid']), 0, 8) : md5($aid.md5($_G['config']['security']['authkey']).$t);

        if($k != $authk) {
            if(!$requestmode) {
                showmessage('attachment_nonexistence');
            } else {
                exit;
            }
        }

        if(!empty($_GET['findpost']) && ($attach = C::t('forum_attachment')->fetch($aid))) {
            dheader('location: forum.php?mod=redirect&goto=findpost&pid='.$attach['pid'].'&ptid='.$attach['tid']);
        }

        if($_GET['uid'] != $_G['uid'] && $_GET['uid']) {
            $_G['uid'] = $_GET['uid'] = intval($_GET['uid']);
            $member = getuserbyuid($_GET['uid']);
            loadcache('usergroup_'.$member['groupid']);
            $_G['group'] = $_G['cache']['usergroup_'.$member['groupid']];
            $_G['group']['grouptitle'] = $_G['cache']['usergroup_'.$_G['groupid']]['grouptitle'];
            $_G['group']['color'] = $_G['cache']['usergroup_'.$_G['groupid']]['color'];
        }


        $tableid = 'aid:'.$aid;
        if($_G['setting']['attachexpire']) {
            if(TIMESTAMP - $t > $_G['setting']['attachexpire'] * 3600) {
                $aid = intval($aid);
                if($attach = C::t('forum_attachment_n')->fetch($tableid, $aid)) {
                    if($attach['isimage']) {
                        dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
                    } else {
                        if(!$requestmode) {
                            showmessage('attachment_expired', '', array('aid' => aidencode($aid, 0, $attach['tid']), 'pid' => $attach['pid'], 'tid' => $attach['tid']));
                        } else {
                            exit;
                        }
                    }
                } else {
                    if(!$requestmode) {
                        showmessage('attachment_nonexistence');
                    } else {
                        exit;
                    }
                }
            }
        }

        $readmod = getglobal('config/download/readmod');
        $readmod = $readmod > 0 && $readmod < 5 ? $readmod : 2;
        $refererhost = parse_url($_SERVER['HTTP_REFERER']);
        $serverhost = $_SERVER['HTTP_HOST'];
        if(($pos = strpos($serverhost, ':')) !== FALSE) {
            $serverhost = substr($serverhost, 0, $pos);
        }

        if(!$requestmode && $_G['setting']['attachrefcheck'] && $_SERVER['HTTP_REFERER'] && !($refererhost['host'] == $serverhost)) {
            showmessage('attachment_referer_invalid', NULL);
        }


        periodscheck('attachbanperiods');
        loadcache('threadtableids');
        $threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
        if(!in_array(0, $threadtableids)) {
            $threadtableids = array_merge(array(0), $threadtableids);
        }

        $archiveid = in_array($_GET['archiveid'], $threadtableids) ? intval($_GET['archiveid']) : 0;


        $attachexists = FALSE;
        if(!empty($aid) && is_numeric($aid)) {
            $attach = C::t('forum_attachment_n')->fetch($tableid, $aid);
            $thread = C::t('forum_thread')->fetch_by_tid_displayorder($attach['tid'], 0, '>=', null, $archiveid);
            if($_G['uid'] && $attach['uid'] != $_G['uid']) {
                if($attach) {
                    $attachpost = C::t('forum_post')->fetch($thread['posttableid'], $attach['pid'], false);
                    $attach['invisible'] = $attachpost['invisible'];
                    unset($attachpost);
                }
                if($attach && $attach['invisible'] == 0) {
                    $thread && $attachexists = TRUE;
                }
            } else {
                $attachexists = TRUE;
            }

        }

        if(!$attachexists) {
            if(!$requestmode) {
                showmessage('attachment_nonexistence');
            } else {
                exit;
            }
        }

        if(!$requestmode) {

            $forum = C::t('forum_forumfield')->fetch_info_for_attach($thread['fid'], $_G['uid']);
            $_GET['fid'] = $forum['fid'];

            if($attach['isimage']) {
                $allowgetattach = !empty($forum['allowgetimage']) || (($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid']) && !$forum['getattachperm']) || forumperm($forum['getattachperm']);
            } else {
                $allowgetattach = !empty($forum['allowgetattach']) || (($_G['group']['allowgetattach']  || $_G['uid'] == $attach['uid']) && !$forum['getattachperm']) || forumperm($forum['getattachperm']);
            }

            if($allowgetattach && ($attach['readperm'] && $attach['readperm'] > $_G['group']['readaccess']) && $_G['adminid'] <= 0 && !($_G['uid'] && $_G['uid'] == $attach['uid'])) {
                showmessage('attachment_forum_nopermission', NULL, array(), array('login' => 1));
            }

            $ismoderator = in_array($_G['adminid'], array(1, 2)) ? 1 : ($_G['adminid'] == 3 ? C::t('forum_moderator')->fetch_uid_by_tid($attach['tid'], $_G['uid'], $archiveid) : 0);

            $ispaid = FALSE;
            $exemptvalue = $ismoderator ? 128 : 16;
            if(!$thread['special'] && $thread['price'] > 0 && (!$_G['uid'] || ($_G['uid'] != $attach['uid'] && !($_G['group']['exempt'] & $exemptvalue)))) {
                if(!$_G['uid'] || $_G['uid'] && !($ispaid = C::t('common_credit_log')->count_by_uid_operation_relatedid($_G['uid'], 'BTC', $attach['tid']))) {

                    showmessage('attachment_payto', 'forum.php?mod=viewthread&tid='.$attach['tid']);

                }

            }


            $exemptvalue = $ismoderator ? 64 : 8;
            if($attach['price'] && (!$_G['uid'] || ($_G['uid'] != $attach['uid'] && !($_G['group']['exempt'] & $exemptvalue)))) {
                $payrequired = $_G['uid'] ? !C::t('common_credit_log')->count_by_uid_operation_relatedid($_G['uid'], 'BAC', $attach['aid']) : 1;
                $payrequired && showmessage('attachement_payto_attach', 'forum.php?mod=misc&action=attachpay&aid='.$attach['aid'].'&tid='.$attach['tid']);
            }
        }


        $isimage = $attach['isimage'];
        if (!$isimage && $attach['remote']) {
//            $Oss_Signatureurl = $this->Oss_Signatureurl($_G['cache']['plugin']['yunling_storage']['upload_path'].'forum/'.$attach['attachment']);
//			$attach['attachment'] = ltrim($Oss_Signatureurl,'/');

            $attach['attachment'] = $this->ossSignatureUrlWithUploadPathThenReturnWithout('forum/'.$attach['attachment']);
//			var_dump($_G['setting']['ftp']['attachurl']);
//			var_dump($attach['attachment']);
//			var_dump($Oss_Signatureurl);
//			var_dump($_G['cache']['plugin']['yunling_storage']['upload_path']);
//			exit();
            dheader("location:".$_G['setting']['ftp']['attachurl'].$attach['attachment']);
            exit;
        }else if ($attach['remote']) {
            //$attach['attachment'] = substr($this->Oss_Signatureurl('/forum/'.$attach['attachment']), 7);
            $attach['attachment'] = $this->ossSignatureUrlWithUploadPathThenReturnWithout('forum/'.$attach['attachment']);
            dheader("location:".$_G['setting']['ftp']['attachurl'].$attach['attachment']);
            exit;
        }

        $_G['setting']['ftp']['hideurl'] = $_G['setting']['ftp']['hideurl'] || ($isimage && !empty($_GET['noupdate']) && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp');

        if(empty($_GET['nothumb']) && $attach['isimage'] && $attach['thumb']) {
            $db = DB::object();
            $db->close();
            !$_G['config']['output']['gzip'] && ob_end_clean();
            dheader('Content-Disposition: inline; filename='.getimgthumbname($attach['filename']));
            dheader('Content-Type: image/pjpeg');

            if($attach['remote']) {
                $_G['setting']['ftp']['hideurl'] ? $this->getremotefile(getimgthumbname($attach['attachment'])) : dheader('location:'.$_G['setting']['ftp']['attachurl'].'forum/'.getimgthumbname($attach['attachment']));
            } else {
                $this->getlocalfile($_G['setting']['attachdir'].'/forum/'.getimgthumbname($attach['attachment']));
            }
            exit();
        }

        $filename = $_G['setting']['attachdir'].'/forum/'.$attach['attachment'];
        if(!$requestmode) {
            if(!$ispaid && !$forum['allowgetattach']) {
                if(!$forum['getattachperm'] && !$allowgetattach) {
                    showmessage('getattachperm_none_nopermission', NULL, array(), array('login' => 1));
                } elseif(($forum['getattachperm'] && !forumperm($forum['getattachperm'])) || ($forum['viewperm'] && !forumperm($forum['viewperm']))) {
                    showmessagenoperm('getattachperm', $forum['fid']);
                }
            }

            $exemptvalue = $ismoderator ? 32 : 4;
            if(!$isimage && !($_G['group']['exempt'] & $exemptvalue)) {
                $creditlog = updatecreditbyaction('getattach', $_G['uid'], array(), '', 1, 0, $thread['fid']);
                if($creditlog['updatecredit']) {
                    if($_G['uid']) {
                        $k = $_GET['ck'];
                        $t = $_GET['t'];
                        if(empty($k) || empty($t) || $k != substr(md5($aid.$t.md5($_G['config']['security']['authkey'])), 0, 8) || TIMESTAMP - $t > 3600) {
                            dheader('location: forum.php?mod=misc&action=attachcredit&aid='.$attach['aid'].'&formhash='.FORMHASH);
                            exit();
                        }
                    } else {
                        showmessage('attachment_forum_nopermission', NULL, array(), array('login' => 1));
                    }
                }
            }
        }



        $range = 0;
        if($readmod == 4 && !empty($_SERVER['HTTP_RANGE'])) {
            list($range) = explode('-',(str_replace('bytes=', '', $_SERVER['HTTP_RANGE'])));
        }

        if(!$requestmode && !$range && empty($_GET['noupdate'])) {
            if($_G['setting']['delayviewcount']) {
                $_G['forum_logfile'] = './data/cache/forum_attachviews_'.intval(getglobal('config/server/id')).'.log';
                if(substr(TIMESTAMP, -1) == '0') {
                    attachment_updateviews($_G['forum_logfile']);
                }

                if(@$fp = fopen(DISCUZ_ROOT.$_G['forum_logfile'], 'a')) {
                    fwrite($fp, "$aid\n");
                    fclose($fp);
                } elseif($_G['adminid'] == 1) {
                    showmessage('view_log_invalid', '', array('logfile' => $_G['forum_logfile']));
                }
            } else {
                C::t('forum_attachment')->update_download($aid);
            }
        }


        $db = DB::object();
        $db->close();
        !$_G['config']['output']['gzip'] && ob_end_clean();

        if($attach['remote'] && !$_G['setting']['ftp']['hideurl'] && $isimage) {
            dheader('location:'.$_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment']);
        }

        $filesize = (!$attach['remote']) ? filesize($filename) : $attach['filesize'];
        $attach['filename'] = '"'.(strtolower(CHARSET) == 'utf-8' && strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($attach['filename']) : $attach['filename']).'"';

        dheader('Date: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
        dheader('Last-Modified: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
        dheader('Content-Encoding: none');

        if($isimage && !empty($_GET['noupdate']) || !empty($_GET['request'])) {
            dheader('Content-Disposition: inline; filename='.$attach['filename']);
        } else {
            dheader('Content-Disposition: attachment; filename='.$attach['filename']);
        }

        if($isimage) {
            dheader('Content-Type: image');
        } else {
            dheader('Content-Type: application/octet-stream');
        }


        dheader('Content-Length: '.$filesize);

        $xsendfile = getglobal('config/download/xsendfile');
        if(!empty($xsendfile)) {
            $type = intval($xsendfile['type']);
            $cmd = '';
            switch ($type) {
                case 1: $cmd = 'X-Accel-Redirect'; $url = $xsendfile['dir'].$attach['attachment']; break;

                case 2: $cmd = $_SERVER['SERVER_SOFTWARE'] <'lighttpd/1.5' ? 'X-LIGHTTPD-send-file' : 'X-Sendfile'; $url = $filename; break;

                case 3: $cmd = 'X-Sendfile'; $url = $filename; break;

            }
            if($cmd) {
                dheader("$cmd: $url");
                exit();
            }
        }

        if($readmod == 4) {
            dheader('Accept-Ranges: bytes');
            if(!empty($_SERVER['HTTP_RANGE'])) {
                $rangesize = ($filesize - $range) > 0 ?  ($filesize - $range) : 0;
                dheader('Content-Length: '.$rangesize);
                dheader('HTTP/1.1 206 Partial Content');
                dheader('Content-Range: bytes='.$range.'-'.($filesize-1).'/'.($filesize));
            }
        }

        $attach['remote'] ? $this->getremotefile($attach['attachment']) : $this->getlocalfile($filename, $readmod, $range);

        exit;

    }

    function Oss_Signatureurl($filename){

        global $_G;
        loadcache('plugin');
        $config = $_G['cache']['plugin']['yunling_storage'];

        $expire=TIMESTAMP + 200;
        $bucketname=$config['bucketname'];

        $filename = ltrim($filename,'/');
        $StringToSign="GET\n\n\n$expire\n/$bucketname/$filename";
        $Sign = base64_encode(hash_hmac("sha1",$StringToSign,$config['AccessKeySecret'],true));
        return $filename."?OSSAccessKeyId=".rawurlencode($config['OSSAccessKeyId'])."&Expires=".$expire."&Signature=".rawurlencode($Sign);

    }

    /**
     * 用给定文件名加上设置中的上传路径签名并返回不带上传路径的OSS签名链接
     *
     * @param $filename
     * 左正斜杠不影响，可加可不加
     * @return string
     * 开头不带正斜杠/
     *
     * @copyright 云凌工作室
     */
    function ossSignatureUrlWithUploadPathThenReturnWithout($filename)
    {
        global $_G;
        loadcache('plugin');
        $config = $_G['cache']['plugin']['yunling_storage'];

        $filename = ltrim($filename,'/');
        $filename = $config['upload_path'] . $filename;
        $signature_url = $this->Oss_Signatureurl($filename);
        return str_replace($config['upload_path'],'',$signature_url);
    }

    function viewthread_bottom_output() {
        global $postlist;
        global $_G;
        $config = $_G['cache']['plugin']['yunling_storage'];


        foreach($postlist as $k=>$post){
            foreach($post['attachments'] as $key=>$attach){
                if($attach['remote']== '1' && !$attach['isimage']){

                    if (!empty($_G['cache']['plugin']['yunling_storage']['image_url']))
                    {
                        $url = $_G['cache']['plugin']['yunling_storage']['image_url'];
                        $url = rtrim($url,'/') . '/' . $config['upload_path'] . 'forum/' . $attach['attachment'];

                        $post['message'] = str_replace($_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'].'"',$url.'"',$post['message']);
                    }
                    else
                    {
                        $url = '/'.$this->ossSignatureUrlWithUploadPathThenReturnWithout('/forum/'.$attach['attachment']);
                        $post['message'] = str_replace('/forum/'.$attach['attachment'].'"',$url.'"',$post['message']);
                    }
                }
                elseif($attach['remote']== '1' && $attach['isimage'])
                {
                    $water = '';
                    if ($config['iswater']) {
                        $water = '/'.$config['water_field'];
                    }

                    if (!empty($_G['cache']['plugin']['yunling_storage']['image_url']))
                    {
                        $url = $_G['cache']['plugin']['yunling_storage']['image_url'];
                        $url = rtrim($url,'/') . '/' . $config['upload_path'] . 'forum/' . $attach['attachment'].$water;

                        $post['message'] = str_replace($_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'].'"',$url.'"',$post['message']);
                    }
                    else
                    {
                        $url = '/'.$this->ossSignatureUrlWithUploadPathThenReturnWithout('/forum/'.$attach['attachment'].$water);
                        $post['message'] = str_replace('/forum/'.$attach['attachment'].'"',$url.'"',$post['message']);
                    }

                }
            }
            $postlist[$k] = $post;
        }
        return '';
    }
}





?>