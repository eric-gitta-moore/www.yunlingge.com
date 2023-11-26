<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('comiis_html');
0
|| checktplrefresh('./source/plugin/comiis_app_find/template/touch/comiis_html.htm', './template/comiis_app/touch/common/header.htm', 1584782046, 'comiis_app_find', './data/template/6_comiis_app_find_touch_comiis_html.tpl.php', './source/plugin/comiis_app_find/template', 'touch/comiis_html')
|| checktplrefresh('./source/plugin/comiis_app_find/template/touch/comiis_html.htm', './template/comiis_app/touch/common/footer.htm', 1584782046, 'comiis_app_find', './data/template/6_comiis_app_find_touch_comiis_html.tpl.php', './source/plugin/comiis_app_find/template', 'touch/comiis_html')
;?>
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
</script><?php comiis_load('XxKPUdUoOuXFOfpPVy', '');?><link rel="stylesheet" href="source/plugin/comiis_app_find/style/comiis.css" type="text/css" media="all">
<?php if($_G['cache']['plugin']['comiis_app_find']['comiis_app_find_css']) { ?>
<style><?php echo strip_tags($_G['cache']['plugin']['comiis_app_find']['comiis_app_find_css']);; ?></style>
<?php } if($_G['cache']['plugin']['comiis_app_find']['comiis_app_find_top']) { ?>
<header class="comiis_fxhead qhae cl">
<div class="head_l"><a href="javascript:history.back(-1)"><img src="source/plugin/comiis_app_find/style/comiis_top_lico.png"></a></div>
<h2><?php echo $_G['cache']['plugin']['comiis_app_find']['comiis_app_find_name'];?></h2>
<div class="head_r"><a href="index.php"><img src="source/plugin/comiis_app_find/style/comiis_top_rico.png"></a></div>
</header>
<?php } ?>
<?php echo $_G['cache']['plugin']['comiis_app_find']['comiis_app_find_ad'];?>
<?php if(count($comiis_app_find['data'])) { if(is_array($comiis_app_find['data'])) foreach($comiis_app_find['data'] as $temp) { if($temp['cid'] == 0) { ?>
<div class="<?php if($temp['show']) { ?>comiis_fx_list<?php } else { ?>comiis_fx_ico<?php } ?> ecze fxbg_f bg_f cl">
<h2 class="fxbg_e odyp fxb_b bg_e b_b"><?php echo $temp['name'];?></h2>
<ul><?php $n = 0;?><?php if(is_array($comiis_app_find['data'])) foreach($comiis_app_find['data'] as $sub) { if($temp['id'] == $sub['cid']) { $n++;?><?php if($temp['show']) { ?>
<li class="fxb_b b_b"><a href="<?php echo $sub['url'];?>" title="<?php echo $sub['name'];?>"><span><?php echo $sub['data'];?></span><img src="source/plugin/comiis_app_find/ico/<?php if($sub['icon']) { ?><?php echo $sub['icon'];?><?php } else { ?>noicon.png<?php } ?>" class="vm"><p><?php echo $sub['name'];?></p></a></li>
<?php } else { ?>
<li class="fxb_r fxb_b b_r b_b"><a href="<?php echo $sub['url'];?>" title="<?php echo $sub['name'];?>"><img src="source/plugin/comiis_app_find/ico/<?php if($sub['icon']) { ?><?php echo $sub['icon'];?><?php } else { ?>noicon.png<?php } ?>" class="vm"><p><?php echo $sub['name'];?></p></a></li>
<?php } } } ?>
</ul>
</div>
<?php if($n == 0) { ?>
<div class="comiis_fx_nodata oqoh fxf_d f_d cl">
<img src="source/plugin/comiis_app_find/style/comiis_nodata.png" class="vm">
<h2><?php echo $_G['cache']['plugin']['comiis_app_find']['comiis_app_find_nodata'];?></h2>
</div>
<?php } } } } else { ?>
<div class="comiis_fx_nodata uvrf fxf_d f_d  cl">
<img src="source/plugin/comiis_app_find/style/comiis_nodata.png" class="vm">
<h2><?php echo $_G['cache']['plugin']['comiis_app_find']['comiis_app_find_nodata'];?></h2>
</div>
<?php } ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?><?php comiis_load('j9alEz9X55JrjbA3l9', '');?><div id="mask" style="display:none;"></div>
<div id="comiis_menu_bg" style="display:none;"></div>
<div id="comiis_alert" style="display:none;"></div></div>
<?php if($comiis_app_switch['comiis_statcode']) { ?><div style="display:none;"><?php echo $comiis_app_switch['comiis_statcode'];?></div><?php } if($comiis_app_switch['comiis_scrolltop'] > 0) { ?>
<div class="comiis_footer_scroll<?php if($comiis_app_switch['comiis_scrolltop'] == 1) { ?> scrolltop_l<?php } ?>"<?php if($comiis_foot != 'no' || $comiis_open_footer) { ?> style="bottom:82px;"<?php } ?>>
    <?php if(count($comiis_app_nav['ynav'])) { ?>
        <?php $nn=0;?>        <div class="comiis_lrmenu comiis_lrshow">
        <?php if(is_array($comiis_app_nav['ynav'])) foreach($comiis_app_nav['ynav'] as $temp) { ?>            <?php $nn++;?>            <?php if($nn < 15) { ?>
                <?php if($temp['url'] == ':comiis_top:') { ?>
                    <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> onclick="$('body,html').animate({scrollTop:0}, 800);" class="comiis_scrolltops f_f" style="display:none;<?php if($temp['bgcolor']) { ?>background:<?php echo $temp['bgcolor'];?><?php } ?>"><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } elseif($temp['url'] == ':comiis_back:') { ?>
                    <?php if($comiis_isweixin == 1) { ?>
                    <a href="javascript:history.back();"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } elseif($temp['url'] == ':comiis_head:') { ?>
                    <?php if($comiis_isweixin == 1 && $_G['comiis_close_header'] != 1) { ?>
                    <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="comiis_isweixin_key f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } elseif($temp['url'] == ':comiis_reload:') { ?>
                    <a href="javascript:;" onclick="location.reload();"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } elseif($temp['url'] == ':comiis_nav:') { ?>
                    <?php if($comiis_app_switch['comiis_leftnv'] != 2) { ?> 
                        <?php if($comiis_isweixin == 1 && $comiis_app_switch['comiis_leftnv'] == 1) { ?> 
                            <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="f_f comiis_leftnv_top_key"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                        <?php } elseif($comiis_app_switch['comiis_leftnv'] == 0) { ?> 
                            <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> onclick="comiis_leftnv();" class="f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                        <?php } ?>
                    <?php } ?>
                <?php } elseif($temp['url'] == ':comiis_home:') { ?>
                    <?php if($comiis_data['default'] != 1) { ?>
                    <a href="./"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } elseif($temp['url'] == ':comiis_showbtn:') { ?>
                <?php } elseif($temp['url'] == ':comiis_msn:') { ?>
                    <?php if($_G['uid'] && ($_G['member']['newpm'] || $_G['member']['newprompt']) && $comiis_app_switch['comiis_showpm'] == 2 && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1&amp;mobile=2#pm"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_a <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span><span class="comiis_rpm<?php if(!$temp['name']) { ?>a<?php } ?> bg_del"></span></a>
                    <?php } ?>
                <?php } elseif($temp['url'] == ':comiis_albumbtn:') { ?>
                    <?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do']=='album' && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <a href="<?php if($_G['uid']) { ?>home.php?mod=spacecp&ac=upload<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } elseif($temp['url'] == ':comiis_postbtn:') { ?>
                    <?php if((($_G['basescript'] == 'forum' && CURMODULE == 'forumdisplay' && $comiis_app_switch['comiis_list_fpost'] == 2) || ($_G['basescript'] == 'group' && CURMODULE == 'forumdisplay')) && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <?php if($comiis_app_switch['comiis_post_yindao'] == 1 && $_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
                            <a href="<?php if(!(!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm']))))) { ?>#comiis_post_type<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if($_G['uid']) { ?>popup <?php } if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                        <?php } else { ?>
                            <a href="<?php if(!(!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm']))))) { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                        <?php } ?>
                    <?php } ?>
                    <?php if(($comiis_data['default'] == 1 || $_G['is_comiis_portal'] == 1) && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="comiis_gobtna<?php if(!$temp['bgcolor']) { ?> bg_0<?php } ?> f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                    <?php if($_G['basescript'] == 'forum' && CURMODULE == 'index' && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="comiis_gobtna<?php if(!$temp['bgcolor']) { ?> bg_0<?php } ?> f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                    <?php if($_G['basescript'] == 'portal' && CURMODULE == 'list' && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <?php if(($_G['group']['allowpostarticle'] || $_G['group']['allowmanagearticle'] || $categoryperm[$catid]['allowmanage'] || $categoryperm[$catid]['allowpublish']) && empty($cat['disallowpublish'])) { ?>
                        <a href="<?php if($_G['uid']) { ?>portal.php?mod=portalcp&ac=article&catid=<?php echo $cat['catid'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                        <?php } ?>
                    <?php } ?>
                    <?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do']=='blog' && $comiis_app_switch['comiis_scrolltop_fenli'] == 0) { ?>
                        <a href="<?php if($_G['uid']) { ?>home.php?mod=spacecp&ac=blog<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } else { ?>
                    <a href="<?php echo $temp['url'];?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        </div>
    <?php } ?>
    <?php if(count($comiis_app_nav['ynav'])) { ?>
        <?php if(is_array($comiis_app_nav['ynav'])) foreach($comiis_app_nav['ynav'] as $temp) { if($temp['url'] == ':comiis_showbtn:') { if($comiis_app_switch['comiis_scrolltop_show'] == 0) { ?>
                    <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="comiis_lrmenukey<?php if(!$temp['bgcolor']) { ?> bg_a<?php } ?> f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } ?>
            <?php } elseif($temp['url'] == ':comiis_msn:') { ?>
                <?php if($_G['uid'] && ($_G['member']['newpm'] || $_G['member']['newprompt']) && $comiis_app_switch['comiis_showpm'] == 2 && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1&amp;mobile=2#pm"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_a <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span><span class="comiis_rpm<?php if(!$temp['name']) { ?>a<?php } ?> bg_del"></span></a>
                <?php } ?>
            <?php } elseif($temp['url'] == ':comiis_albumbtn:') { ?>
                <?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do']=='album' && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <a href="<?php if($_G['uid']) { ?>home.php?mod=spacecp&ac=upload<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } ?>
            <?php } elseif($temp['url'] == ':comiis_postbtn:') { ?>
                <?php if((($_G['basescript'] == 'forum' && CURMODULE == 'forumdisplay' && $comiis_app_switch['comiis_list_fpost'] == 2) || ($_G['basescript'] == 'group' && CURMODULE == 'forumdisplay')) && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <?php if($comiis_app_switch['comiis_post_yindao'] == 1 && $_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
                        <a href="<?php if(!(!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm']))))) { ?>#comiis_post_type<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if($_G['uid']) { ?>popup <?php } if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } else { ?>
                        <a href="<?php if(!(!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm']))))) { ?>forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } ?>                
                <?php if(($comiis_data['default'] == 1 || $_G['is_comiis_portal'] == 1) && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="comiis_gobtna<?php if(!$temp['bgcolor']) { ?> bg_0<?php } ?> f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } ?>                
                <?php if($_G['basescript'] == 'forum' && CURMODULE == 'index' && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <a href="javascript:;"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="comiis_gobtna<?php if(!$temp['bgcolor']) { ?> bg_0<?php } ?> f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } ?>
                <?php if($_G['basescript'] == 'portal' && CURMODULE == 'list' && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <?php if(($_G['group']['allowpostarticle'] || $_G['group']['allowmanagearticle'] || $categoryperm[$catid]['allowmanage'] || $categoryperm[$catid]['allowpublish']) && empty($cat['disallowpublish'])) { ?>
                    <a href="<?php if($_G['uid']) { ?>portal.php?mod=portalcp&ac=article&catid=<?php echo $cat['catid'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                    <?php } ?>
                <?php } ?>
                <?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do']=='blog' && $comiis_app_switch['comiis_scrolltop_fenli'] == 1) { ?>
                    <a href="<?php if($_G['uid']) { ?>home.php?mod=spacecp&ac=blog<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($temp['name']) { ?> title="<?php echo $temp['name'];?>"<?php } ?> class="<?php if(!$temp['bgcolor']) { ?>bg_0 <?php } ?>f_f"<?php if($temp['bgcolor']) { ?> style="background:<?php echo $temp['bgcolor'];?>;"<?php } ?>><i class="comiis_font<?php if(!$temp['name']) { ?> kmnotxt<?php } ?>">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e632<?php } ?>;</i><span><?php if($temp['name']) { ?><em><?php echo $temp['name'];?></em><?php } ?></span></a>
                <?php } ?>
                <?php if($comiis_isweixin == 1 && $_GET['id'] == 'comiis_app_activity') { ?>
                    <?php if($comiis_app_activity_set['post_url']) { ?>
                    <a href="<?php echo $comiis_app_activity_set['post_url'];?>" title="<?php echo $comiis_lang['post24'];?>" class="bg_0 f_f"><i class="comiis_font">&#xe62d;</i><span><em><?php echo $comiis_lang['post24'];?></em></span></a>
                    <?php } ?>
                <?php } } } } if($comiis_isweixin == 1 || $_G['comiis_close_header'] == 0) { ?>
    <script>
    $(document).on('click', '.comiis_isweixin_key', function() {
    $('#comiis_head').toggleClass("comiis_head_hidden");
    });
    </script>
<?php } if($comiis_app_switch['comiis_scrolltop_show'] == 0) { ?>
<script>
$(".comiis_lrmenukey").on('click', function(e) {
$('.comiis_lrmenu').toggleClass('comiis_lrshow');
});
</script>
<?php } ?>
</div>
<?php } if($comiis_closefooter == 1) { $comiis_foot = 'no';$comiis_open_footer = 0;?><?php } if(($comiis_foot != 'no' || $comiis_open_footer) && count($comiis_app_nav['mnav'])) { ?>
<div class="comiis_foot_height"></div>
<?php } if(($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && CURMODULE == 'viewthread') { comiis_load('jj74PQM0ehoQfoM9EU', 'comiis_thead_fav,comiis_my_recommend,comiis_isweixin');?><?php } elseif(($comiis_foot != 'no' || $comiis_open_footer) && count($comiis_app_nav['mnav'])) { ?>
<div id="comiis_foot_box" class="qqjj">
<div id="comiis_foot_memu" class="comiis_foot_memu bg_f b_t">
<ul class="comiis_flex"><?php $nn=0;?><?php if(is_array($comiis_app_nav['mnav'])) foreach($comiis_app_nav['mnav'] as $temp) { $nn++;?><?php if($nn < 7) { if($temp['url'] == ':comiisbig:') { ?>
                    <li class="flex comiis_fbigbtn"><a href="javascript:;" class="comiis_openfootbox" title="<?php echo $temp['name'];?>" icon1="&#x<?php echo $temp['icon'];?>;" icon2="&#x<?php echo $temp['bgcolor'];?>;"><em class="bg_f b_ok"></em><span class="bg_f"><i class="comiis_font foot_btn bg_0 f_f">&#x<?php echo $temp['icon'];?>;</i></span></a></li>
<?php } elseif($temp['url'] == ':comiis:') { ?>
<li class="flex"><a href="javascript:;" class="comiis_openfootbox" title="<?php echo $temp['name'];?>" icon1="&#x<?php echo $temp['icon'];?>;" icon2="&#x<?php echo $temp['bgcolor'];?>;"><i class="comiis_font foot_btn bg_0 f_f">&#x<?php echo $temp['icon'];?>;</i></a></li>
<?php } elseif($temp['url'] == '#comiis_post') { ?>
<li class="flex"><a href="javascript:;" class="comiis_openfootboxg f_c" title="<?php echo $temp['name'];?>" icon1="&#x<?php echo $temp['icon'];?>;" icon2="&#x<?php echo $temp['bgcolor'];?>;"><i class="comiis_font">&#x<?php echo $temp['icon'];?>;</i><span><?php echo $temp['name'];?></span></a></li>
<?php } elseif($temp['url'] == 'home.php?mod=space&do=profile&mycenter=1') { ?>
<li class="flex f_<?php if($temp['nav_ids'] == $comiis_nav_ids || $temp['nav_ids'] == $comiis_nav_ids2) { ?>0<?php } else { ?>c<?php } ?>"><a href="<?php echo $temp['url'];?>" title="<?php echo $temp['name'];?>"><i class="comiis_font">&#x<?php if($temp['nav_ids'] == $comiis_nav_ids || $temp['nav_ids'] == $comiis_nav_ids2) { ?><?php echo $temp['bgcolor'];?><?php } else { ?><?php echo $temp['icon'];?><?php } ?>;<?php if($_G['uid'] && ($_G['member']['newpm'] || $_G['member']['newprompt'])) { ?><span class="icon_msgs bg_del"></span><?php } ?></i><span><?php echo $temp['name'];?></span></a></li>
<?php } else { ?>
<li class="flex f_<?php if($temp['nav_ids'] == $comiis_nav_ids || $temp['nav_ids'] == $comiis_nav_ids2) { ?>0<?php } else { ?>c<?php } ?>"><a href="<?php echo $temp['url'];?>" title="<?php echo $temp['name'];?>"><i class="comiis_font">&#x<?php if($temp['nav_ids'] == $comiis_nav_ids || $temp['nav_ids'] == $comiis_nav_ids2) { ?><?php echo $temp['bgcolor'];?><?php } else { ?><?php echo $temp['icon'];?><?php } ?>;</i><span><?php echo $temp['name'];?></span></a></li>
<?php } } } ?>
</ul>
</div>
<div class="comiis_gobtn cl">
<?php if($comiis_app_switch['comiis_fnav_date']) { ?>
<div class="comiis_gobtn_top cl">
<div class="comiis_fttime cl" id="comiis_show_datebox"></div>		
</div>
<?php } if($comiis_app_switch['comiis_fnavimgs']) { ?><?php echo $comiis_app_switch['comiis_fnavimgs'];?><?php } ?>
<a href="javascript:;" class="comiis_gobtn_close comiis_gobtna"><i class="comiis_font f_d">&#xe639;</i></a>
</div>
<div class="comiis_gobtn_box bg_f b_t cl">
<h2 class="f_c"><?php echo $comiis_app_switch['comiis_fnav_title'];?></h2>
<ul class="cl"><?php if(is_array($comiis_app_nav['fnav'])) foreach($comiis_app_nav['fnav'] as $temp) { ?><li><a href="<?php echo $temp['url'];?>"><span style="background:<?php if($temp['bgcolor']) { ?><?php echo $temp['bgcolor'];?><?php } else { ?>#FF9900<?php } ?>;"><i class="comiis_font f_f">&#x<?php if($temp['icon']) { ?><?php echo $temp['icon'];?><?php } else { ?>e651<?php } ?>;</i></span><?php echo $temp['name'];?></a></li>
<?php } ?>
</ul>
<div class="comiis_gobtn_foot cl">
</div>
</div>
</div>
<script type="text/javascript"> 
<?php if($comiis_app_switch['comiis_fnav_date']) { ?>
var sWeek = new Array(<?php echo $comiis_lang['tip223'];?>);
var dNow = new Date();
var CalendarData = new Array(100);
var madd = new Array(12);
var numString = "<?php echo $comiis_lang['tip224'];?>";
var monString = "<?php echo $comiis_lang['tip225'];?>";
var cYear, cMonth, cDay, TheDate;
CalendarData = new Array(0xA4B, 0x5164B, 0x6A5, 0x6D4, 0x415B5, 0x2B6, 0x957, 0x2092F, 0x497, 0x60C96, 0xD4A, 0xEA5, 0x50DA9, 0x5AD, 0x2B6, 0x3126E, 0x92E, 0x7192D, 0xC95, 0xD4A, 0x61B4A, 0xB55, 0x56A, 0x4155B, 0x25D, 0x92D, 0x2192B, 0xA95, 0x71695, 0x6CA, 0xB55, 0x50AB5, 0x4DA, 0xA5B, 0x30A57, 0x52B, 0x8152A, 0xE95, 0x6AA, 0x615AA, 0xAB5, 0x4B6, 0x414AE, 0xA57, 0x526, 0x31D26, 0xD95, 0x70B55, 0x56A, 0x96D, 0x5095D, 0x4AD, 0xA4D, 0x41A4D, 0xD25, 0x81AA5, 0xB54, 0xB6A, 0x612DA, 0x95B, 0x49B, 0x41497, 0xA4B, 0xA164B, 0x6A5, 0x6D4, 0x615B4, 0xAB6, 0x957, 0x5092F, 0x497, 0x64B, 0x30D4A, 0xEA5, 0x80D65, 0x5AC, 0xAB6, 0x5126D, 0x92E, 0xC96, 0x41A95, 0xD4A, 0xDA5, 0x20B55, 0x56A, 0x7155B, 0x25D, 0x92D, 0x5192B, 0xA95, 0xB4A, 0x416AA, 0xAD5, 0x90AB5, 0x4BA, 0xA5B, 0x60A57, 0x52B, 0xA93, 0x40E95);
madd[0] = 0;
madd[1] = 31;
madd[2] = 59;
madd[3] = 90;
madd[4] = 120;
madd[5] = 151;
madd[6] = 181;
madd[7] = 212;
madd[8] = 243;
madd[9] = 273;
madd[10] = 304;
madd[11] = 334;
function GetBit(m, n) {
    return (m >> n) & 1
}
function e2c() {
    TheDate = (arguments.length != 3) ? new Date() : new Date(arguments[0], arguments[1], arguments[2]);
    var total, m, n, k;
    var isEnd = false;
    var tmp = TheDate.getFullYear();
    total = (tmp - 1921) * 365 + Math.floor((tmp - 1921) / 4) + madd[TheDate.getMonth()] + TheDate.getDate() - 38;
    if (TheDate.getYear() % 4 == 0 && TheDate.getMonth() > 1) {
        total++
    }
    for (m = 0;; m++) {
        k = (CalendarData[m] < 0xfff) ? 11 : 12;
        for (n = k; n >= 0; n--) {
            if (total <= 29 + GetBit(CalendarData[m], n)) {
                isEnd = true;
                break
            }
            total = total - 29 - GetBit(CalendarData[m], n)
        }
        if (isEnd) break
    }
    cYear = 1921 + m;
    cMonth = k - n + 1;
    cDay = total;
    if (k == 12) {
        if (cMonth == Math.floor(CalendarData[m] / 0x10000) + 1) {
            cMonth = 1 - cMonth
        }
        if (cMonth > Math.floor(CalendarData[m] / 0x10000) + 1) {
            cMonth--
        }
    }
}
function GetcDateString() {
    var tmp = '<h2 class="f_f">';
    if (cMonth < 1) {
        tmp += "<?php echo $comiis_lang['tip226'];?>";
        tmp += monString.charAt( - cMonth - 1)
    } else {
        tmp += monString.charAt(cMonth - 1)
    }
    tmp += '<?php echo $comiis_lang['tip227'];?></h2><p class="bg_f f_c">';
    tmp += (cDay < 11) ? "<?php echo $comiis_lang['tip228'];?>": ((cDay < 20) ? "<?php echo $comiis_lang['tip229'];?>": ((cDay < 30) ? "<?php echo $comiis_lang['tip230'];?>": "<?php echo $comiis_lang['tip234'];?>"));
    if (cDay == 20) {
    tmp += "<?php echo $comiis_lang['tip229'];?>";
    }
    if (cDay % 10 != 0 || cDay == 10) {
        tmp += numString.charAt((cDay - 1) % 10)
    }
    return tmp + '</p>'
}
function GetLunarDay(solarYear, solarMonth, solarDay) {
    if (solarYear < 1921 || solarYear > 2020) {
        return ""
    } else {
        solarMonth = (parseInt(solarMonth) > 0) ? (solarMonth - 1) : 11;
        e2c(solarYear, solarMonth, solarDay);
        return GetcDateString()
    }
}
function comiis_timesadd0(obj){
if(obj<10){
return "0" +""+ obj;
}else{
return obj;
}
}
var D = new Date();
var yy = D.getFullYear();
var mm = D.getMonth() + 1;
var dd = D.getDate();
var ww = D.getDay();
var ss = parseInt(D.getTime() / 1000);
function getFullYear(d) {
    yr = d.getYear();
    if (yr < 1000) yr += 1900;
    return yr
}
$('#comiis_show_datebox').html('<div class="z fttime_rq f_b">' + comiis_timesadd0(dNow.getDate()) + '</div><div class="z fttime_xq"><span class="f_b"><?php echo $comiis_lang['tip231'];?>' + sWeek[dNow.getDay()] + '</span><em class="f_d">/</em><span class="f_b">' + getFullYear(dNow) + '<?php echo $comiis_lang['tip232'];?>' + comiis_timesadd0(dNow.getMonth() + 1) + '<?php echo $comiis_lang['tip233'];?></span></div><div class="z fttime_nl bg_0">' + GetLunarDay(yy, mm, dd) + '</div>');
<?php } ?>
$(document).on('click', '.comiis_openfootbox,.comiis_openfootboxg,.comiis_gobtna', function() {
if($('#comiis_foot_box').hasClass('comiis_footer_showbox')){
$('#comiis_foot_memu').css('z-index','101');
$('.comiis_openfootboxg i').text($('.comiis_openfootboxg').attr('icon1')).removeClass('f_0');
$('.comiis_openfootbox i').text($('.comiis_openfootbox').attr('icon1'));
$('#comiis_foot_box').removeClass('comiis_footer_showbox');
Comiis_Touch_on = 1;
}else{
Comiis_Touch_on = 0;
$('.comiis_openfootboxg i').text($('.comiis_openfootboxg').attr('icon2')).addClass('f_0');
$('.comiis_openfootbox i').text($('.comiis_openfootbox').attr('icon2'));
$('#comiis_foot_box').addClass('comiis_footer_showbox');
$('#comiis_foot_memu').css('z-index','211');
}
});
</script> <?php loadcache('forums');?><?php } comiis_load('g7J1y0H7T0j12HU32t', '');?><div id="comiis_bgbox" style="display:none;"></div>
</div><?php $comiis_wx_title_box = ($comiis_app_wx_share['title'] ? strip_tags($comiis_app_wx_share['title']) : strip_tags($navtitle));
$comiis_wx_description_box = ($comiis_app_wx_share['desc'] ? strip_tags($comiis_app_wx_share['desc']) : ($metadescription ? strip_tags($metadescription) : ($comiis_app_switch['comiis_sitename'] ? $comiis_app_switch['comiis_sitename'] : $_G['setting']['sitename'])));?><div id="comiis_wx_title_box" style="display:none;"><?php echo $comiis_wx_title_box;?></div>
<div id="comiis_wx_description_box" style="display:none;"><?php echo $comiis_wx_description_box;?></div>
<?php if($comiis_app_switch['comiis_share_html']) { ?>
<?php echo $comiis_app_switch['comiis_share_html'];?>
<?php } ?>
<script>
$(document).on('click', '.comiis_openrebox', function() {
<?php if($_G['uid']) { ?>
comiis_openrebox(1);
<?php } else { if((!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm']))))) { ?>
popup.open('您还未登录，立即登录?', 'confirm', 'member.php?mod=logging&action=login');
<?php } else { ?>	
comiis_openrebox(1);
<?php } } ?>
return false;
});
<?php if($comiis_app_switch['comiis_loadimg']) { ?>
$(document).ready(function() {
$("img.comiis_loadimages").lazyload();
});
<?php } ?>
var comiis_wx_title = $('#comiis_wx_title_box').html();
var comiis_wx_description = $('#comiis_wx_description_box').html();
<?php if($comiis_app_wx_share['img']) { ?>
var comiis_wx_imgUrl = "<?php echo $_G['siteurl'];?><?php echo $comiis_app_wx_share['img'];?>";
<?php } else { ?>
var comiis_wx_img_objs;
var comiis_wx_img_obj = $("img[src*='/attachment/'],img[src*='forum.php?mod=image'],img[comiis_loadimages*='/attachment/'],img[comiis_loadimages*='forum.php?mod=image']");
for(var i = 0; i < comiis_wx_img_obj.length; i++){
        if(comiis_wx_img_obj[i].width >= 60 && comiis_wx_img_obj[i].height >= 60 && comiis_wx_img_obj[i].naturalWidth >= 180 && comiis_wx_img_obj[i].naturalHeight >= 180){
comiis_wx_img_objs = comiis_wx_img_obj[i];
break;
        }
}
var comiis_wx_img = $(comiis_wx_img_objs).attr('comiis_loadimages');
if(typeof(comiis_wx_img)=="undefined"){
comiis_wx_img = $(comiis_wx_img_objs).attr('src');
if(typeof(comiis_wx_img)=="undefined"){
comiis_wx_img = '<?php echo $comiis_app_switch['comiis_wximg'];?>';
}
}
var comiis_wx_imgUrl = ((comiis_wx_img.indexOf("ttp://") > 0 || comiis_wx_img.indexOf("ttps://") > 0) ? '' : "<?php echo $_G['siteurl'];?>") + comiis_wx_img;
<?php } ?>
var comiis_wx_url = window.location.href.replace('&mobile=2', '');
<?php if($comiis_app_switch['comiis_share_js']) { ?>
function comiis_user_share() {
<?php echo $comiis_app_switch['comiis_share_js'];?>
}
<?php } ?>
</script>
<?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script type="text/javascript" class="lazy_script" src-data="home.php?mod=spacecp&amp;ac=pm&amp;op=checknewpm&amp;rand=<?php echo $_G['timestamp'];?>"></script>
<?php } if($comiis_app_switch['comiis_foot_backico'] < 2 && $comiis_is_new_url == 1) { ?>
<script>$('.backico').html('<li class="backico" style="margin-left:3px;"><a href="./" class="b_r"><i class="comiis_font f_0" style="line-height:24px;">&#xe662;</i></a></li>');</script>
<?php } if($comiis_app_switch['comiis_wxappid'] && $comiis_app_switch['comiis_wxappsecret']) { include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/jssdk.php';?><script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" type="text/javascript"></script>
<script>
wx.config({
debug: 0,
appId: '<?php echo $comiis_signPackage["appId"];?>',
timestamp: '<?php echo $comiis_signPackage["timestamp"];?>',
nonceStr: '<?php echo $comiis_signPackage["nonceStr"];?>',
signature: '<?php echo $comiis_signPackage["signature"];?>',
jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone', 'getLocation', 'openLocation']
});
wx.ready(function () {
var comiis_wx_share_data = {
title: comiis_wx_title,
desc: comiis_wx_description,
imgUrl: comiis_wx_imgUrl,
link: comiis_wx_url
}
wx.onMenuShareAppMessage(comiis_wx_share_data);
wx.onMenuShareQQ(comiis_wx_share_data);
wx.onMenuShareWeibo(comiis_wx_share_data);
wx.onMenuShareQZone(comiis_wx_share_data);
wx.onMenuShareTimeline(comiis_wx_share_data);
});
</script>
<?php } ?>
</body>
</html><?php global $comiis_fsimage;
$content = ob_get_contents();
ob_end_clean();
$content = output_replace($content);
$content = str_replace(array('http://'.$_G['setting']['domain']['app']['default'].'/'), array($_G['siteurl']), $content);
$_G['gzipcompress'] ? ob_start('ob_gzhandler') : ob_start();
echo $content;
updatesession();
if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output();}?>