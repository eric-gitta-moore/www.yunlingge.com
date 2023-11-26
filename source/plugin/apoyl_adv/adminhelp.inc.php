<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: adminhelp.inc.php  2019-06  liyuanchao（凹凸曼）$
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
showtableheader();
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_html5upload')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_sitemap')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_video')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_videolist')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_service')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_auth')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_weixinshare')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_salary')));

showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_telfunc')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_qq')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_like')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_teladv')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_index')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_vest')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_wmark')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_facebook')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_google')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_yahoo')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_twitter')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_pushpub')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_hidesection')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_money')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_moderator')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_mtime')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_picessence')));
showtablerow('','',array(lang('plugin/apoyl_adv','apoyl_picdivision')));

showtablerow('','',array(lang('plugin/apoyl_adv','addr')));
showtablerow('','',array(lang('plugin/apoyl_adv','blog')));
showtablerow('','',array(lang('plugin/apoyl_adv','qq')));
showtablefooter();

?>