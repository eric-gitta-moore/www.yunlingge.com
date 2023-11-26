<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('header');?>
<?php require_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_lang.'.currentlang().'.php';?><!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if($comiis_app_switch['comiis_header_show'] == 2) { $comiis_isweixin = 1;?><?php } elseif($comiis_app_switch['comiis_header_show'] == 0 || $comiis_app_switch['comiis_header_show'] == 1) { $comiis_isweixin = 0;?><?php } include template('common/comiis_title'); ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-control" content="<?php if($_G['setting']['mobile']['mobilecachetime'] > 0) { ?><?php echo $_G['setting']['mobile']['mobilecachetime'];?><?php } else { ?>no-cache<?php } ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes">
<?php if($comiis_app_switch['comiis_appname']) { ?>
<meta name="apple-mobile-web-app-title" content="<?php echo $comiis_app_switch['comiis_appname'];?>">
<?php } ?>
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="format-detection" content="email=no" />
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/template/yunling_common/images/icon57.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/template/yunling_common/images/icon114.png">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/template/yunling_common/images/icon152.png">
<link rel="icon" sizes="114x114" href="/template/yunling_common/images/icon114.png" /> 
<?php if($comiis_app_switch['comiis_ucqqfull'] == 1) { ?>
<meta name="full-screen" content="yes">
<meta name="browsermode" content="application">
<meta name="x5-fullscreen" content="true">
<meta name="x5-page-mode" content="app">
<?php } if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'profile' && $_GET['mycenter'] == 1) { ?>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1986 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<?php } ?>
<base href="<?php echo $_G['siteurl'];?>" />
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?><?php } if($comiis_app_switch['comiis_sitename'] || $_G['setting']['sitename']) { ?> - <?php } if($comiis_app_switch['comiis_sitename']) { ?><?php echo $comiis_app_switch['comiis_sitename'];?><?php } else { ?><?php echo $_G['setting']['sitename'];?><?php } ?></title>
<meta name="keywords" content="<?php if(!empty($metakeywords)) { echo dhtmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { echo dhtmlspecialchars($metadescription); ?>, <?php } if($comiis_app_switch['comiis_sitename']) { ?><?php echo $comiis_app_switch['comiis_sitename'];?><?php } else { ?><?php echo $_G['setting']['bbname'];?><?php } ?>" />
<link rel="shortcut icon" href="/favicon.ico">
<script src="template/comiis_app/comiis/js/jquery.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>', comiis_pageid = '<?php echo $comiis_nav_ids;?>', comiis_page_start = 0, comiis_rlmenu = <?php echo $comiis_app_switch['comiis_scrolltop_ico'] ? intval($comiis_app_switch['comiis_scrolltop_ico']) : 0;; ?>, comiis_lrshow = <?php echo $comiis_app_switch['comiis_scrolltop_show'] ? intval($comiis_app_switch['comiis_scrolltop_show']) : 0;; ?>, comiis_post_btnwz = <?php echo $comiis_app_switch['comiis_post_btnwz'] ? intval($comiis_app_switch['comiis_post_btnwz']) : 0;; ?>, comiis_footer = <?php if(($comiis_foot != 'no' || $comiis_open_footer) && !$comiis_closefooter && count($comiis_app_nav['mnav'])) { ?>1<?php } else { ?>0<?php } ?>, comiis_open_wblink = <?php echo $comiis_app_switch['comiis_open_wblink'] ? intval($comiis_app_switch['comiis_open_wblink']) : 0;; ?>, comiis_open_wblink_txt = '<?php echo $comiis_app_switch['comiis_open_wblink_txt'];?>', comiis_open_wblink_tip = <?php echo $comiis_app_switch['comiis_open_wblink_tip'] ? intval($comiis_app_switch['comiis_open_wblink_tip']) : 0;; ?>;
var comiis_all_https = new Array(<?php if(is_array(explode("\n",$comiis_app_switch['comiis_open_nwblink']))) foreach(explode("\n",$comiis_app_switch['comiis_open_nwblink']) as $v) { if(strlen(trim($v)) > 1) { ?>'<?php echo trim($v);; ?>', <?php } } ?>window.location.host);
</script>
<style>
    @font-face {
        font-family:'comiis_font';
        src:url('/template/comiis_app/comiis/css/fonts/comiis_font.eot?v=<?php echo VERHASH;?>');
        src:url('/template/comiis_app/comiis/css/fonts/comiis_font.eot?v=<?php echo VERHASH;?>#iefix') format('embedded-opentype'),
        url('/template/comiis_app/comiis/css/fonts/comiis_font.svg?v=<?php echo VERHASH;?>#iconfont') format('svg'),
        url('/template/comiis_app/comiis/css/fonts/comiis_font.woff?v=<?php echo VERHASH;?>') format('woff'),
        url('/template/comiis_app/comiis/css/fonts/comiis_font.ttf?v=<?php echo VERHASH;?>') format('truetype');
    }
    .comiis_font {
        font-family:"comiis_font" !important;
        font-size:16px;
        font-style:normal;
        -webkit-font-smoothing:antialiased;
        -webkit-text-stroke-width:0px;
        -moz-osx-font-smoothing:grayscale;
    }
</style>
<link rel="stylesheet" href="template/comiis_app/comiis/css/comiis.css?<?php echo VERHASH;?>" type="text/css" media="all">
<script src="template/comiis_app/comiis/js/common<?php if(currentlang() == 'SC_UTF8' || currentlang() == 'TC_UTF8') { ?>_u<?php } ?>.js?<?php echo VERHASH;?>" type="text/javascript" charset="<?php echo CHARSET;?>"></script>
<?php if($comiis_app_switch['comiis_loadimg']) { ?><script src="template/comiis_app/comiis/js/jquery.lazyload.min.js" type="text/javascript"></script><?php } ?>
<script>
var comiis_nvscroll = <?php if($comiis_isweixin != 1) { if($comiis_app_switch['comiis_header_show'] == 1) { ?>1<?php } else { ?>0<?php } } else { ?>0<?php } ?>;
var comiis_isweixin = '<?php echo $comiis_isweixin;?>';
</script>
<?php if($comiis_app_switch['comiis_share_style'] != 0 || $comiis_app_switch['comiis_leftnv'] == 1 || $comiis_app_switch['comiis_all_abg'] != 1) { ?>
<style>
<?php if($comiis_app_switch['comiis_all_abg'] != 1) { ?>a:active {background:rgba(0,0,0,0.08);}<?php } if($comiis_app_switch['comiis_share_style'] != 0) { ?>.comiis_share_box #comiis_share a span {background-image:url(template/comiis_app/comiis/img/comiis_share_ico<?php if($comiis_app_switch['comiis_share_style'] == 1) { ?>01<?php } elseif($comiis_app_switch['comiis_share_style'] == 2) { ?>02<?php } ?>.png);}<?php } if($comiis_app_switch['comiis_leftnv'] == 1) { ?>#comiis_head {z-index:200;}<?php } ?>
</style>
<?php } if($comiis_app_switch['comiis_seohead']) { ?><?php echo $comiis_app_switch['comiis_seohead'];?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_comiis_header_mobile'])) echo $_G['setting']['pluginhooks']['global_comiis_header_mobile'];?><?php $_G['comiis_new'] = 2;?></head><?php include template('common/comiis_header'); if($_G['basescript'] == 'member' && CURMODULE == 'logging' && $comiis_isweixin == 1) { ?>
    <?php if($_GET['lostpasswd'] == 'yes' && $comiis_app_switch['comiis_reg_zmtxt']) { ?>
        <?php $comiis_bg = 1;?>    <?php } elseif($comiis_app_switch['comiis_reg_dltxt'] && $_GET['lostpasswd'] != 'yes') { ?>
        <?php $comiis_bg = 1;?>    <?php } } elseif($_G['basescript'] == 'member' && CURMODULE == 'register' && $_GET['mod']!='connect' && $comiis_isweixin == 1 && $comiis_app_switch['comiis_reg_regtxt']) { ?>
    <?php $comiis_bg = 1;?><?php } elseif($comiis_app_switch['comiis_reg_zmtxt'] && $comiis_isweixin == 1 && $_G['basescript'] == 'member' && $_GET['mod'] == 'getpasswd') { ?>
    <?php $comiis_bg = 1;?><?php } ?>
<body id="<?php echo $_G['basescript'];?>" class="comiis_bodybg<?php if($comiis_bg==1) { ?> bg_f<?php } ?> pg_<?php echo CURMODULE;?><?php if($comiis_foot != 'no' && $comiis_open_footer && ($_G['basescript'] == 'forum' && CURMODULE == 'forumdisplay')) { ?> comiis_showfoot<?php } ?> dhof">
<?php if($comiis_app_switch['comiis_loadbox'] != 1) { ?>
<div class="comiis_loadings"></div>
<div class="comiis_loadings_icon">
<i class="weui-loading weui-icon_toast"></i>
<p class="comiis_loadings_content"><?php echo $comiis_lang['loader'];?></p>
</div>
<script>
function comiis_loadings() {	
$('.comiis_loadings').fadeOut(400, function(){
$('.comiis_loadings_icon').fadeOut(200);
});
}
(function($, window, undefined) {
$(window).ready(function () {
comiis_loadings();
});
window.onerror = function () {
comiis_loadings();
};
setTimeout(function() {
comiis_loadings();
}, 1500);
})(jQuery, window);
</script>
<?php } if(!$_COOKIE['comiis_fullscreen_cookies'] && (($_G['basescript'] == 'forum' && CURMODULE == 'index') || $comiis_data['default'] == 1) && $comiis_app_switch['comiis_fullscreen']) { ?>
<style><?php echo $comiis_app_switch['comiis_fullscreen_css'];?></style>
<div class="comiis_fullscreen bg_f">
<a href="<?php echo $comiis_app_switch['comiis_fullscreen_url'];?>" class="comiis_fullscreen_img"><img src="<?php echo $comiis_app_switch['comiis_fullscreen_img'];?>"></a>
<a href="<?php echo $comiis_app_switch['comiis_fullscreen_logourl'];?>" class="comiis_fullscreen_logo">
<img src="<?php echo $comiis_app_switch['comiis_fullscreen_logoimg'];?>">
<p class="f_d"><?php echo $comiis_app_switch['comiis_fullscreen_copy'];?></p>
</a>
<div class="comiis_fullscreen_time"><?php echo str_replace(array('[timenum]'), array($comiis_app_switch['comiis_fullscreen_time']), $comiis_app_switch['comiis_fullscreen_djs']);; ?></div>
</div>
<script type="text/javascript">
$.cookie('comiis_fullscreen_cookies', 1, {expires : <?php echo $comiis_app_switch['comiis_fullscreen_showtime'];?>, path : '/'});
var comiis_fullscreen_title = document.title;
document.title = '<?php echo $comiis_app_switch['comiis_fullscreen_title'];?>';
var num = <?php echo $comiis_app_switch['comiis_fullscreen_time'];?>;
var interval = setInterval(function(){
if(num == 0){
comiis_fullscreen_close();
}
num--;
$('.comiis_fullscreen_time span').html(num);
},1000);
$('.comiis_fullscreen_time').on('click', function(e) {
comiis_fullscreen_close();
});
function comiis_fullscreen_close() {
document.title = comiis_fullscreen_title;
$('.comiis_fullscreen').hide();
clearInterval(interval);
}
</script>
<?php } ?>
<div class="comiis_body">
<?php if($comiis_app_switch['comiis_leftnv'] != 2) { ?>
        <?php loadcache('usergroups');?>        <div class="comiis_leftmenubg" style="display:none"></div>
<?php } ?>
    <?php if($comiis_app_switch['comiis_leftnv'] != 1 && $comiis_app_switch['comiis_leftnv'] != 2) { ?>
        <div class="comiis_sidenv_box<?php if($comiis_app_switch['comiis_leftnv_list'] == 1) { ?> comiis_sidenv_boxv1<?php } ?>" style="display:none;">
            <div class="comiis_sidenv_top<?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?> comiis_sidenv_topv1<?php } ?> f_f">
            <?php if($_G['uid']) { ?>
                <?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?><div class="sidenv_edit"><i class="comiis_font fyy">&#xe63e;</i></div><?php } ?>
                <div class="sidenv_exit"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><span><i class="comiis_font">&#xe61c;</i><?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?>退出<?php } ?></span></a></div>
                <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1" class="sidenv_user">
                  <?php if($_G['member']['newpm'] || $_G['member']['newprompt']) { ?><span class="sidenv_num bg_del f_f"><?php echo $_G['member']['newpm'] + $_G['member']['newprompt']; ?></span><?php } ?>				
                  <em><img src="<?php echo avatar($_G['uid'],middle,true); ?>?<?php echo time();; ?>"></em>
                  <?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?>
                  <p class="user_tit fyy"><?php echo $_G['member']['username'];?></p>
                  <p class="mt5"><span class="user_lev bg_0"<?php if($_G['cache']['usergroups'][$_G['member']['groupid']]['color']) { ?> style="background:<?php echo $_G['cache']['usergroups'][$_G['member']['groupid']]['color'];?> !important"<?php } ?>><?php if($comiis_app_switch['comiis_lev_txt']) { ?><?php echo $comiis_app_switch['comiis_lev_txt'];?><?php } else { ?>Lv.<?php } ?><?php echo $_G['group']['stars'];?></span><span class="fyy"><?php echo strip_tags($_G['group']['grouptitle']);; ?> 积分: <?php echo $_G['member']['credits'];?></span></p>
                  <?php } else { ?>
                  <p><span class="user_tit fyy"><?php echo $_G['member']['username'];?></span><span class="user_lev bg_0"<?php if($_G['cache']['usergroups'][$_G['member']['groupid']]['color']) { ?> style="background:<?php echo $_G['cache']['usergroups'][$_G['member']['groupid']]['color'];?> !important"<?php } ?>><?php if($comiis_app_switch['comiis_lev_txt']) { ?><?php echo $comiis_app_switch['comiis_lev_txt'];?><?php } else { ?>Lv.<?php } ?><?php echo $_G['group']['stars'];?></span></p>
                  <p class="fyy mt5"><span><?php echo strip_tags($_G['group']['grouptitle']);; ?></span><span>积分: <?php echo $_G['member']['credits'];?></span></p>
                  <?php } ?>
                </a>
                <?php } elseif(!$_G['connectguest']) { ?>			
                <?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?>
                <div class="sidenv_exit"><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><span><i class="comiis_font">&#xe61c;</i><?php echo $_G['setting']['reglinkname'];?></span></a></div>
                <?php } ?>
                <a href="member.php?mod=logging&amp;action=login" class="sidenv_user">
                  <em><?php echo avatar(0,middle);?></em>
                  <p><span class="user_tit fyy">
                  <script language="javascript">					
                    var myDate = new Date();
                    var i = myDate.getHours();
                    if(i < 12)
                    document.write("<?php echo $comiis_lang['tip88'];?>");
                    else if(i >=12 && i < 14)
                    document.write("<?php echo $comiis_lang['tip89'];?>");
                    else if(i >= 14 && i < 18)
                    document.write("<?php echo $comiis_lang['tip90'];?>");
                    else if(i >= 18)
                    document.write("<?php echo $comiis_lang['tip91'];?>");					
                    </script> <?php echo $comiis_lang['tip92'];?><?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?><?php echo $comiis_lang['tip93'];?><?php } ?></span></p>
                  <p class="fyy mt5"><?php echo $comiis_lang['tip94'];?></p>
                </a>
             <?php } else { ?>
                <?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?><div class="sidenv_edit"><i class="comiis_font fyy">&#xe63e;</i></div><?php } ?>
                <div class="sidenv_exit"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><span><i class="comiis_font">&#xe61c;</i><?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?>退出<?php } ?></span></a></div>
                <a href="member.php?mod=connect" class="sidenv_user">
                  <?php if($_G['member']['newpm'] || $_G['member']['newprompt']) { ?><span class="sidenv_num bg_del f_f"><?php echo $_G['member']['newpm'] + $_G['member']['newprompt']; ?></span><?php } ?>				
                  <em><img src="<?php echo avatar(0,middle,true); ?>?<?php echo time();; ?>"></em>
                  <?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?>
                  <p class="user_tit fyy"><?php echo $_G['member']['username'];?></p>
                  <p class="fyy mt5"><?php echo strip_tags($_G['group']['grouptitle']);; ?>, <?php echo $comiis_lang['reg21'];?></p>
                  <?php } else { ?>
                  <p><span class="user_tit fyy"><?php echo $_G['member']['username'];?></span><span class="comiis_tm"><?php echo strip_tags($_G['group']['grouptitle']);; ?></span></p>
                  <p class="fyy mt5"><span><?php echo $comiis_lang['reg21'];?></span></p>
                  <?php } ?>
                </a>
            <?php } ?>
                <?php if($comiis_app_switch['comiis_svg'] != 1) { ?><div class="comiis_svg_box"><?php if($comiis_app_switch['comiis_leftnv_list'] == 1) { ?><div class="comiis_svg_c"></div><div class="comiis_svg_d"></div><?php } else { ?><div class="comiis_svg_a"></div><div class="comiis_svg_b"></div><?php } ?></div><?php } ?>
            </div>
            <?php if(!empty($_G['setting']['pluginhooks']['global_misign_mobile']) && $_G['uid']) { ?>
                <style>body .comiis_sidenv_box .sidenv_li {height:-moz-calc(100% - 200px);height:-webkit-calc(100% - 200px);height:calc(100% - 200px);}</style>
                <div class="comiis_k_misign<?php if($comiis_app_switch['comiis_leftnv_list'] == 1) { ?>v1<?php } ?>">
                    <?php if(!empty($_G['setting']['pluginhooks']['global_misign_mobile'])) echo $_G['setting']['pluginhooks']['global_misign_mobile'];?>
                </div>
            <?php } ?>
            <div class="sidenv_li<?php if($comiis_app_switch['comiis_leftnv_list'] == 1) { ?> sidenv_liv1 f_f<?php } ?>">			
                <ul class="comiis_left_Touch usps">
                    <?php if(is_array($comiis_app_nav['lnav'])) foreach($comiis_app_nav['lnav'] as $temp) { ?>                        <li class="comiis_left_Touch"><a href="<?php echo $temp['url'];?>" class="comiis_left_Touch"><i class="comiis_font comiis_left_Touch<?php if(!$temp['bgcolor']) { ?> f_c<?php } ?>"<?php if($temp['bgcolor']) { ?> style="color:<?php echo $temp['bgcolor'];?>;"<?php } ?>><?php if($temp['icon']) { ?>&#x<?php echo $temp['icon'];?>;<?php } else { ?>&#xe633;<?php } ?></i><?php echo $temp['name'];?></a></li>
                    <?php } ?>
                    <?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
                        <li class="comiis_left_Touch"><a href="admin.php?mobile=no" class="comiis_left_Touch"><i class="comiis_font comiis_left_Touch f_0">&#xe612;</i><?php echo $comiis_lang['tip304'];?> <?php echo $comiis_lang['tip305'];?></a></li>
                    <?php } ?>
                    <li class="comiis_left_Touch styli_h10"></li>
                </ul>
            </div>
        </div>
    <?php } elseif($comiis_app_switch['comiis_leftnv'] == 1) { ?>
        <div class="comiis_gobtn_tbox<?php if($comiis_app_switch['comiis_leftnv_list'] == 1) { ?> comiis_sidenv_boxv1 f_f<?php } else { ?> bg_f<?php } ?> cl">
            <?php if($comiis_app_switch['comiis_leftnv_user'] != 1) { ?>
            <div class="comiis_gobtn_user">
                <div class="comiis_sidenv_top<?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?> comiis_sidenv_topv1<?php } ?> f_f">
                <?php if($_G['uid']) { ?>
                    <div class="sidenv_exit"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><span><i class="comiis_font">&#xe61c;</i><?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?>退出<?php } ?></span></a></div>
                    <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1" class="sidenv_user">              		
                      <em><img src="<?php echo avatar($_G['uid'],middle,true); ?>?<?php echo time();; ?>"><?php if($_G['member']['newpm'] || $_G['member']['newprompt']) { ?><span class="sidenv_num bg_del f_f"><?php echo $_G['member']['newpm'] + $_G['member']['newprompt']; ?></span><?php } ?>		</em>
                      <?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?>
                      <p class="user_tit fyy"><?php echo $_G['member']['username'];?></p>
                      <p><span class="user_lev bg_0"<?php if($_G['cache']['usergroups'][$_G['member']['groupid']]['color']) { ?> style="background:<?php echo $_G['cache']['usergroups'][$_G['member']['groupid']]['color'];?> !important"<?php } ?>><?php if($comiis_app_switch['comiis_lev_txt']) { ?><?php echo $comiis_app_switch['comiis_lev_txt'];?><?php } else { ?>Lv.<?php } ?><?php echo $_G['group']['stars'];?></span><span class="fyy"><?php echo strip_tags($_G['group']['grouptitle']);; ?> 积分: <?php echo $_G['member']['credits'];?></span></p>
                      <?php } else { ?>
                      <p class="mt5"><span class="user_tit fyy"><?php echo $_G['member']['username'];?></span><span class="user_lev bg_0"<?php if($_G['cache']['usergroups'][$_G['member']['groupid']]['color']) { ?> style="background:<?php echo $_G['cache']['usergroups'][$_G['member']['groupid']]['color'];?> !important"<?php } ?>><?php if($comiis_app_switch['comiis_lev_txt']) { ?><?php echo $comiis_app_switch['comiis_lev_txt'];?><?php } else { ?>Lv.<?php } ?><?php echo $_G['group']['stars'];?></span></p>
                      <p class="fyy"><span><?php echo strip_tags($_G['group']['grouptitle']);; ?></span><span>积分: <?php echo $_G['member']['credits'];?></span></p>
                      <?php } ?>
                    </a>
                    <?php } elseif(!$_G['connectguest']) { ?>			
                    <?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?>
                    <div class="sidenv_exit"><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><span><i class="comiis_font">&#xe61c;</i><?php echo $_G['setting']['reglinkname'];?></span></a></div>
                    <?php } ?>
                    <a href="member.php?mod=logging&amp;action=login" class="sidenv_user">
                      <em><?php echo avatar(0,middle);?></em>
                      <p class="mt5"><span class="user_tit fyy">
                      <script language="javascript">					
                        var myDate = new Date();
                        var i = myDate.getHours();
                        if(i < 12)
                        document.write("<?php echo $comiis_lang['tip88'];?>");
                        else if(i >=12 && i < 14)
                        document.write("<?php echo $comiis_lang['tip89'];?>");
                        else if(i >= 14 && i < 18)
                        document.write("<?php echo $comiis_lang['tip90'];?>");
                        else if(i >= 18)
                        document.write("<?php echo $comiis_lang['tip91'];?>");					
                        </script> <?php echo $comiis_lang['tip92'];?><?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?><?php echo $comiis_lang['tip93'];?><?php } ?></span></p>
                      <p class="fyy"><?php echo $comiis_lang['tip94'];?></p>
                    </a>
                 <?php } else { ?>
                    <?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?><div class="sidenv_edit"><i class="comiis_font fyy">&#xe63e;</i></div><?php } ?>
                    <div class="sidenv_exit"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>"><span><i class="comiis_font">&#xe61c;</i><?php if($comiis_app_switch['comiis_leftnv_top'] == 0) { ?>退出<?php } ?></span></a></div>
                    <a href="member.php?mod=connect" class="sidenv_user">
                      <?php if($_G['member']['newpm'] || $_G['member']['newprompt']) { ?><span class="sidenv_num bg_del f_f"><?php echo $_G['member']['newpm'] + $_G['member']['newprompt']; ?></span><?php } ?>				
                      <em><img src="<?php echo avatar(0,middle,true); ?>?<?php echo time();; ?>"></em>
                      <?php if($comiis_app_switch['comiis_leftnv_top'] == 1) { ?>
                      <p class="user_tit fyy"><?php echo $_G['member']['username'];?></p>
                      <p class="fyy"><?php echo strip_tags($_G['group']['grouptitle']);; ?>, <?php echo $comiis_lang['reg21'];?></p>
                      <?php } else { ?>
                      <p class="mt5"><span class="user_tit fyy"><?php echo $_G['member']['username'];?></span><span class="comiis_tm"><?php echo strip_tags($_G['group']['grouptitle']);; ?></span></p>
                      <p class="fyy"><span><?php echo $comiis_lang['reg21'];?></span></p>
                      <?php } ?>
                    </a>
                <?php } ?>
                <?php if($comiis_app_switch['comiis_svg'] != 1) { ?><div class="comiis_svg_box"><?php if($comiis_app_switch['comiis_leftnv_list'] == 1) { ?><div class="comiis_svg_c"></div><div class="comiis_svg_d"></div><?php } else { ?><div class="comiis_svg_a"></div><div class="comiis_svg_b"></div><?php } ?></div><?php } ?>
                </div>                
            </div>
            <?php } ?>
            <ul<?php if($comiis_app_switch['comiis_leftnv_user'] == 1) { ?> class="leftnv_nouser"<?php } ?>>
                <?php if(is_array($comiis_app_nav['lnav'])) foreach($comiis_app_nav['lnav'] as $temp) { ?>                <li><a href="<?php echo $temp['url'];?>"><span<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } else { ?> class="bg_0"<?php } ?>><i class="comiis_font f_f"><?php if($temp['icon']) { ?>&#x<?php echo $temp['icon'];?>;<?php } else { ?>&#xe607;<?php } ?></i></span><?php echo $temp['name'];?></a></li>
                <?php } ?>
                <?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
                    <li><a href="admin.php?mobile=no"><span class="bg_0"><i class="comiis_font f_f">&#xe612;</i></span><?php echo $comiis_lang['tip304'];?></a></li>
                <?php } ?>
            </ul>
        </div>
    <?php } if($_GET['mycenter'] || $_G['comiis_close_header'] != 1 && !($_G['basescript'] == 'home' && CURMODULE == 'space' && ($_GET['from'] =='space' || $_GET['do'] == 'profile' || $_GET['do'] == 'wall'))) { ?>
<div id="comiis_head"<?php if($comiis_isweixin == 1) { ?> class="comiis_head_hidden"<?php } ?>>		
<div class="comiis_head<?php if($comiis_app_switch['comiis_header_style'] == 0) { ?> f_f<?php } elseif($comiis_app_switch['comiis_header_style'] == 1) { ?> bg_f f_0 b_b<?php } ?> cl">
<div class="header_z">
<?php if($comiis_head['left']) { ?>
<?php echo $comiis_head['left'];?>
<?php } else { ?>
<a href="javascript:history.back();"><i class="comiis_font">&#xe60d;</i></a>
<?php } ?>
</div>
<h2>
<?php if($comiis_head['center']) { ?>
<?php echo $comiis_head['center'];?>
<?php } else { if($comiis_app_switch['comiis_appname']) { ?><?php echo $comiis_app_switch['comiis_appname'];?><?php } else { ?><img src="<?php echo $comiis_app_switch['comiis_logourl'];?>" class="comiis_noloadimage"><?php } } ?>
</h2>
<div class="header_y">
                <?php if($comiis_app_switch['comiis_leftnv'] == 1) { ?><a href="javascript:;" class="comiis_leftnv_top_key"><i class="comiis_font">&#xe666;</i></a><?php } if($comiis_head['right']) { ?>
<?php echo $comiis_head['right'];?>
<?php } else { ?>
<a href="forum.php?mod=guide&amp;view=hot"><i class="comiis_font">&#xe662;</i></a>
<?php } ?>
</div>
</div>
</div>
<?php if($comiis_isweixin != 1) { ?><div style="height:48px;"></div><?php } } ?>	
<div class="comiis_bodybox"<?php if($_COOKIE['comiis_loading']) { ?> style="-webkit-transform: translateY(44px);transform: translateY(44px);"<?php } ?>>
<?php if(!empty($_G['setting']['pluginhooks']['global_header_mobile'])) echo $_G['setting']['pluginhooks']['global_header_mobile'];?>
<script>
if(history.length < 1 || history.length == 1 || document.referrer === ''){
$('.header_z').html('<?php echo $header_left;?>');
}
</script><?php comiis_load('XxKPUdUoOuXFOfpPVy', '');?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>