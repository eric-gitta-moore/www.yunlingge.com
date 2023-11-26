<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>.comiis_znalist .user_gz {display:none;}.comiis_footer_scroll {bottom:52px;}</style>
<div class="comiis_space_box dhof">
<div id="comiis_head"<?php if($comiis_isweixin == 1 && $_GET['id'] != 'comiis_app_homestyle') { ?> class="comiis_head_hidden"<?php } ?>>		
<div class="comiis_head comiis_space_head f_f cl" style="background-color:rgba(0,0,0,0) !important">
<div class="header_z"><a href="javascript:;" onclick="history.go(-1);"><i class="comiis_font fyy">&#xe60d;</i></a></div>
<h2 class="fyy"><?php if($space['uid'] != $_G['uid']) { ?>Ta 的空间<?php } else { ?>我的空间<?php } ?></h2>
<div class="header_y"><?php if($comiis_app_switch['comiis_leftnv'] == 1) { ?><a href="javascript:;" class="comiis_leftnv_top_key"><i class="comiis_font fyy">&#xe666;</i></a><?php } ?><a href="javascript:;" class="comiis_menu_display" id="comiis_menu_tr"><i class="comiis_font fyy">&#xe62b;</i></a></div>
</div>
</div>
<div style="height:48px;"></div><?php if(!$space['groupid']){
loadcache('usergroups', 1);  
$space = getuserbyuid($space['uid']);
}
comiis_load('HAktL1tIaRFER39vre', 'space');?><div class="comiis_svg_box"><div class="comiis_svg_a"></div><div class="comiis_svg_b"></div></div>
</div>
<div class="comiis_memu_y bg_f f_b" id="comiis_menu_tr_menu" style="display:none;">
<ul>
<?php if($comiis_app_switch['comiis_space_header']==0) { if(helper_access::check_module('follow') && $space['uid'] != $_G['uid']) { $follow = 0;?><?php $follow = C::t('home_follow')->fetch_all_by_uid_followuid($_G['uid'], $space['uid']);?><?php if(!$follow) { ?>
<li><a id="followmod" href="<?php if($_G['uid']) { ?>home.php?mod=spacecp&ac=follow&op=add&hash=<?php echo FORMHASH;?>&fuid=<?php echo $space['uid'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>" class="<?php if($_G['uid']) { ?>dialog <?php } ?>b_b"><i class="comiis_font">&#xe60e;</i><?php echo $comiis_lang['all3'];?>Ta</a></li>
<?php } else { ?>
<li><a id="followmod" href="home.php?mod=spacecp&amp;ac=follow&amp;op=del&amp;fuid=<?php echo $space['uid'];?>" class="dialog b_b"><i class="comiis_font">&#xe60e;</i><?php echo $comiis_lang['all4'];?></a></li>
<?php } } } ?>		
<?php if($space['uid'] != $_G['uid']) { if($_G['uid']) { ?><li><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;from=space" class="b_b"><i class="comiis_font">&#xe662;</i>访问我的空间</a></li><?php } } else { if($_G['comiis_homestyleid']) { ?><li><a href="plugin.php?id=comiis_app_homestyle" class="b_b"><i class="comiis_font">&#xe612;</i>装扮空间</a></li><?php } ?>
<li><a href="home.php?mod=spacecp" class="b_b"><i class="comiis_font">&#xe655;</i>更新个人资料</a></li>		
<?php } ?>
<li><a href="index.php"<?php if($space['uid'] != $_G['uid']) { ?> class="b_b"<?php } ?>><i class="comiis_font">&#xe657;</i>返回首页</a></li>
<?php if($space['uid'] != $_G['uid']) { ?><li><a href="<?php if($_G['uid']) { ?>misc.php?mod=report&url=<?php echo $_G['currenturl_encode'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($_G['uid']) { ?> class="dialog"<?php } ?>><i class="comiis_font">&#xe636;</i><?php echo $comiis_lang['all2'];?></a></li><?php } ?>
</ul>
</div>
<?php if($comiis_app_switch['comiis_space_nv']==0) { if($comiis_app_switch['comiis_subnv_top'] != 1) { ?><div style="height:40px;"><div class="comiis_scrollTop_box"><?php } ?>
<div class="comiis_topnv bg_f b_b">
  <ul class="comiis_flex">
<li class="flex<?php if($do=='thread') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me&amp;from=space"<?php if($do=='thread') { ?> class="b_0 f_0"<?php } else { ?> class="f_b"<?php } ?>>帖子</a></li>
<?php if($_G['setting']['blogstatus']) { ?><li class="flex<?php if($do=='blog') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=blog&amp;view=me&amp;from=space"<?php if($do=='blog') { ?> class="b_0 f_0"<?php } else { ?> class="f_b"<?php } ?>>日志</a></li><?php } if($_G['setting']['albumstatus']) { ?><li class="flex<?php if($do=='album') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me&amp;from=space"<?php if($do=='album') { ?> class="b_0 f_0"<?php } else { ?> class="f_b"<?php } ?>>相册</a></li><?php } if($_G['setting']['wallstatus']) { ?><li class="flex<?php if($do=='wall') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=wall&amp;view=me&amp;from=space"<?php if($do=='wall') { ?> class="b_0 f_0"<?php } else { ?> class="f_b"<?php } ?>>留言</a></li><?php } ?>
<li class="flex<?php if($do=='profile') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=profile&amp;view=me&amp;from=space"<?php if($do=='profile') { ?> class="b_0 f_0"<?php } else { ?> class="f_b"<?php } ?>><?php echo $comiis_lang['view57'];?></a></li>
  </ul>
</div>
<?php if($comiis_app_switch['comiis_subnv_top'] != 1) { ?></div></div><?php } } elseif($comiis_app_switch['comiis_space_nv']==1) { if($comiis_app_switch['comiis_subnv_top'] != 1) { ?><div style="height:45px;"><div class="comiis_scrollTop_box"><?php } ?>
<div class="comiis_topnv bg_f b_b comiis_space_nv">
  <ul class="comiis_flex">
<li class="flex<?php if($do=='thread') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me&amp;from=space"<?php if($do=='thread') { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><i class="comiis_font">&#xe679;</i>帖子</a></li>
<?php if($_G['setting']['blogstatus']) { ?><li class="flex<?php if($do=='blog') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=blog&amp;view=me&amp;from=space"<?php if($do=='blog') { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><i class="comiis_font">&#xe632;</i>日志</a></li><?php } if($_G['setting']['albumstatus']) { ?><li class="flex<?php if($do=='album') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me&amp;from=space"<?php if($do=='album') { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><i class="comiis_font">&#xe627;</i>相册</a></li><?php } if($_G['setting']['wallstatus']) { ?><li class="flex<?php if($do=='wall') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=wall&amp;view=me&amp;from=space"<?php if($do=='wall') { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><i class="comiis_font">&#xe665;</i>留言</a></li><?php } ?>	
<li class="flex<?php if($do=='profile') { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=profile&amp;view=me&amp;from=space"<?php if($do=='profile') { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><i class="comiis_font">&#xe61e;</i><?php echo $comiis_lang['view57'];?></a></li>
  </ul>
</div>
<?php if($comiis_app_switch['comiis_subnv_top'] != 1) { ?></div></div><?php } } ?>
<script>
$(window).scroll(function() {
if($(window).scrollTop() > 100){
$('.comiis_space_head').attr('style', 'background-color:rgba(0,0,0,1) !important');
}else{
var i = $(window).scrollTop() / 100;
$('.comiis_space_head').attr('style', 'background-color:rgba(0,0,0,'+i+') !important');
}
});
</script><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>