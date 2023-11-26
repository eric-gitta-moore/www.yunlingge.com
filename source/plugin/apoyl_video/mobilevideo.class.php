<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: mobilevideo.class.php  2019-12  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class mobileplugin_apoyl_video{
    public function discuzcode($value)
    {
        global $_G;
        $cache = $_G['cache']['plugin']['apoyl_video'];
        $message = $_G['discuzcodemessage'];
            if (in_array($_G['fid'], unserialize($cache['openmbforums']))) {
            if ($cache['openmp4'])
                $message = preg_replace_callback('/\[attach\]([0-9]+)\[\/attach\]/i', array(
                    $this,
                    "_callback_videoapoyl"
                ), $message);
            
            include $this->_fileapoylv2('youkuapoyl');
            include $this->_fileapoylv2('youtubeapoyl');
            include $this->_fileapoylv2('dailymotionapoyl');
            include $this->_fileapoylv2('bilibiliapoyl');
            include $this->_fileapoylv2('qqapoyl');
            include $this->_fileapoylv2('tudouapoyl');
            include $this->_fileapoylv2('iqiyiapoyl');
            include $this->_fileapoylv2('wmp4apoyl');
            include $this->_fileapoylv2('wcovermp4apoyl');

        }
        $_G['discuzcodemessage'] = $message;
    }
    
    private function _callback_videoapoyl($match)
    {
        global $_G;
        $cache = $_G['cache']['plugin']['apoyl_video'];
        $width = $cache['mp4mbwidth'] ? $cache['mp4mbwidth'] : "100%";
        $height = $cache['mp4mbheight'] ? $cache['mp4mbheight'] : 300;
        if ($match[1]) {
            $rowaid = C::t('forum_attachment_n')->fetch('aid:' . $match[1], $match[1]);
            $transcodefile=$this->_fileapoylv2('transcodeapoyl');
            if($transcodefile){
                $return='';
                include $transcodefile;
                return $return;
            }else{
                if (stripos($rowaid['filename'], '.mp4') !== FALSE) {
                    $_G['setting']['attachurl'] = $rowaid['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl'];
                    $url = $_G['setting']['attachurl'] . 'forum/' . $rowaid['attachment'];
                    return '<video controls="controls" width="' . $width . '" height="' . $height . '" '.$poster.' > <source src="' . $url . '" type="video/mp4">Your browser does not support the video tag</video>';
                }
            }
            return $match[0];
        }
    }
    protected function _fileapoylv2($filename){
        $fileapoyl=DISCUZ_ROOT.'./source/plugin/apoyl_video/components/'.$filename.'.php';
        if(file_exists($fileapoyl))
            return $fileapoyl;
            return '';
    }
}

class mobileplugin_apoyl_video_portal extends mobileplugin_apoyl_video{
    public function view_go_output($a){
        global $_G,$content;
        $cache = $_G['cache']['plugin']['apoyl_video'];
        include $this->_fileapoylv2('articlembmp4apoyl');
        include $this->_fileapoylv2('articleyoukuapoyl');
        include $this->_fileapoylv2('articlebilibiliapoyl');
        include $this->_fileapoylv2('articleyoutubeapoyl');
        include $this->_fileapoylv2('articleqqapoyl');

    }
}

class mobileplugin_apoyl_video_forum extends mobileplugin_apoyl_video{
   
    public function post_bottom_mobile_output($a){
        global $_G;
        $return='';
        $cache = $_G['cache']['plugin']['apoyl_video'];
        if(in_array($_GET['fid'], unserialize($cache['openmbforums']))&&$cache['openmbupload']){
            $hash=md5(substr(md5($_G['config']['security']['authkey']), 8) . $_G['uid']);
            include template('apoyl_video:show');
          
        }
        return $return;
    }
    public function post_message(){
        global $_G,$tid,$pid;
        $cache = $_G['cache']['plugin']['apoyl_video'];
        include $this->_fileapoylv2('mbuploadapoyl');
    }
}
?>