<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: adminhelp.inc.php  2019-11  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
showtableheader();
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_aliyunvideo')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_qiniu')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_videolist')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_baidumip')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_rewrite')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_baiduxiong')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_picverify')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_interest')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_limit')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_html5upload')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_service')));

showtablerow('','',array(lang('plugin/apoyl_video','apoyl_googleping')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_auth')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_weixinshare')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_prize')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_telfunc')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_like')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_teladv')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_facebook')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_google')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_yahoo')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_twitter')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_index')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_vest')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_wmark')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_pushpub')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_hidesection')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_money')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_salary')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_moderator')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_picessence')));
showtablerow('','',array(lang('plugin/apoyl_video','apoyl_picdivision')));

showtablerow('','',array(lang('plugin/apoyl_video','addr')));
showtablerow('','',array(lang('plugin/apoyl_video','blog')));
showtablerow('','',array(lang('plugin/apoyl_video','qq')));
showtablefooter();

?>