<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
@font-face {font-family: "comiis_mhfont";
  src: url('./source/plugin/comiis_app_portal/image/comiis_mhfont.eot?v=<?php echo VERHASH;?>');
  src: url('./source/plugin/comiis_app_portal/image/comiis_mhfont.eot?v=<?php echo VERHASH;?>#iefix') format('embedded-opentype'),
  url('./source/plugin/comiis_app_portal/image/comiis_mhfont.woff?v=<?php echo VERHASH;?>') format('woff'),
  url('./source/plugin/comiis_app_portal/image/comiis_mhfont.ttf?v=<?php echo VERHASH;?>') format('truetype'),
  url('./source/plugin/comiis_app_portal/image/comiis_mhfont.svg?v=<?php echo VERHASH;?>#comiis_mhfont') format('svg');
}
.comiis_mhfont {font-family:"comiis_mhfont" !important;font-size:16px;font-style:normal;-webkit-font-smoothing:antialiased;-webkit-text-stroke-width:0.2px;-moz-osx-font-smoothing:grayscale}
.comiis_bodybox .comiis_fx_homeico {margin-bottom:0}
.comiis_bodybox .comiis_ac_homebox {margin-top:0}
.comiis_mh_xifont {position:relative;padding:0 8px}
.comiis_mh_xifont:after {content:" ";width:200%;height:200%;position:absolute;top:0;left:0;border-radius:25px;border-width:1px;border-style:solid;-webkit-transform:scale(.5);transform:scale(.5);-webkit-transform-origin:0 0;transform-origin:0 0;box-sizing:border-box}
.bg_hs {background:#bbb}
.pb5 {padding-bottom:5px}
.pb6 {padding-bottom:6px}
.pb8 {padding-bottom:8px}
.pb10 {padding-bottom:10px}
.pb12 {padding-bottom:12px}
.pb15 {padding-bottom:15px}
.tfu10 {margin-top:-10px}
.bfu10 {margin-bottom:-10px}
#comiis_mh_head {position:fixed;display:block;z-index:99;left:0;right:0;top:0;width:100%;height:48px}
.comiis_mh_head {height:38px;padding:5px 5px}
.comiis_mh_head h2 {float:left;width:50%;text-align:center;font-size:18px;line-height:38px;font-weight:400;position:relative}
.comiis_mh_head h2 img {height:38px}
.comiis_mh_head h2 i.kmxiao {margin-left:5px;font-size:14px}
.comiis_mh_head .head_z {float:left;width:25%;position:relative}
.comiis_mh_head .head_y {float:right;width:25%;position:relative}
.comiis_mh_head .head_z a,.comiis_mh_head .head_y a {display:block;width:34px;height:38px;text-align:center;overflow:hidden}
.comiis_mh_head .head_y a {float:right}
.comiis_mh_head i {font-size:20px;line-height:38px}
.comiis_mh_h48 {height:48px}
.comiis_app_forumlist {overflow:hidden}
.comiis_app_forumlist li {margin-top:0;display:block;overflow:hidden;position:relative}
.comiis_app_forumlist li a {display:block;overflow:hidden}
.comiis_app_forumlist li .forumlist_one {padding:12px;overflow:hidden}
.comiis_app_forumlist li .forumlist_noimg {padding:11px 12px 12px;overflow:hidden}
.comiis_app_forumlist li .forumlist_img {width:32.5%;height:85px;float:left;margin-right:10px;font-size:0}
.comiis_app_forumlist li .forumlist_imga {width:32.5%;height:85px;float:right;margin-left:10px;font-size:0;background:#f8f8f8}
.comiis_app_forumlist li .forumlist_img img,.comiis_app_forumlist li .forumlist_imga img {width:100%}
.comiis_app_forumlist li .forumlist_info h2 {display:block;line-height:24px;font-size:17px;font-weight:400;overflow:hidden}
.comiis_app_forumlist li .forumlist_info h2.kmtitv1 {height:24px}
.comiis_app_forumlist li .forumlist_info h2 span {float:left;height:16px;line-height:16px;padding:0 2px;font-size:12px;margin-top:4px;margin-right:4px;border-radius:1.5px}
.comiis_app_forumlist li .forumlist_info h2 span.toico {height:16px;line-height:16px}
.comiis_app_forumlist li .forumlist_infoa h2 {height:48px;line-height:24px;margin-bottom:6px}
.comiis_app_forumlist li .forumlist_infoa h2 span {margin-top:4px}
.comiis_app_forumlist li .forumlist_noimg .forumlist_info p {max-height:44px;line-height:22px;font-size:14px;margin:5px 0;overflow:hidden}
.comiis_app_forumlist li .forumlist_bottom {display:block;height:16px;line-height:16px;margin-top:20px}
.comiis_app_forumlist li .forumlist_bottom i {font-size:12px}
.comiis_app_forumlist li .forumlist_bottom span {margin-right:10px}
.comiis_app_forumlist li .forumlist_imgs {padding:10px 0}
.comiis_app_forumlist li .forumlist_imgs h2 {font-size:17px;line-height:24px;margin:0 12px;font-weight:400;overflow:hidden}
.comiis_app_forumlist li .forumlist_imgs h2.kmtitv1 {height:24px}
.comiis_app_forumlist li .forumlist_imgs h2 span {float:left;height:16px;line-height:16px;padding:0 2px;font-size:12px;margin-top:4px;margin-right:4px;border-radius:1.5px}
.comiis_app_forumlist li h2 .comiis_xifont:after {border-radius:3px}
.comiis_app_forumlist li .forumlist_imgs .listimgs {margin:4px 12px 10px;overflow:hidden}
.comiis_app_forumlist li .forumlist_imgs .listimgs li {float:left;width:32.5%;padding-bottom:23%;margin-top:1.25%;margin-right:1.25%;box-sizing:border-box;position:relative;overflow:hidden;background:#f8f8f8}
.comiis_app_forumlist li .forumlist_imgs .listimgs li:nth-child(3n) {margin-right:0}
.comiis_app_forumlist li .forumlist_imgs .listimgs img {position:absolute;width:100%;font-size:0}
.comiis_app_forumlist li .forumlist_imgs .forumlist_bottom {display:block;height:16px;line-height:16px;margin:0 12px}
.comiis_app_forumlist li .forumlist_bottom a,.comiis_app_forumlist li .forumlist_imgs .forumlist_bottom a {margin-right:5px}
.comiis_app_nolist {padding:20px 15px;text-align:center;overflow:hidden}
.comiis_app_nolist i {display:block;padding:0;height:60px;line-height:60px;font-size:60px}
.comiis_app_nolist span {display:inline-block;font-size:14px;padding:5px 25px}
.comiis_multi_box {overflow:hidden}
.comiis_multi_box .comiis_page {border-top:none !important}
.comiis_loadbtn {display:block;text-align:center;line-height:34px;font-size:14px;margin:12px auto;width:80%;border-radius:25px}
.comiis_loading {background-color:#000;width:28px;padding:10px;border-radius:5px;filter:alpha(opacity=85);-moz-opacity:0.85;-khtml-opacity:0.85;opacity:0.85}
</style><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>