<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_blog_list');?><?php include template('common/header'); if($_GET['from']=='space') { include template('home/space_header'); } else { ?>
    <?php if($comiis_app_switch['comiis_subnv_top'] != 1) { ?><div style="height:40px;"><div class="comiis_scrollTop_box"><?php } ?>
<div class="comiis_topnv bg_f b_b">
<ul class="comiis_flex">
<li class="flex<?php if($actives['me']) { ?> kmon<?php } ?>"><a href="<?php if($_G['uid']) { ?>home.php?mod=space&do=blog&view=me<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($actives['me']) { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>>我的日志</a></li>
<li class="flex<?php if($actives['we']) { ?> kmon<?php } ?>"><a href="<?php if($_G['uid']) { ?>home.php?mod=space&do=blog&view=we<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($actives['we']) { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>>好友的日志</a></li>        
<li class="flex<?php if($actives['all']) { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;do=blog&amp;view=all"<?php if($actives['all']) { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>>随便看看</a></li>
</ul>
</div>
<?php if($comiis_app_switch['comiis_subnv_top'] != 1) { ?></div></div><?php } } if($count) { comiis_load('zysbGCQMXuggYx913U', 'list,stickflag,space,diymode,multi');?><?php } else { ?>
<div class="comiis_notip comiis_sofa mt15 cl">
<i class="comiis_font f_e cl">&#xe613;</i>
<span class="f_d">还没有相关的日志</span>
</div>
<?php } if($_GET['from']=='space') { if($space['uid'] == $_G['uid']) { ?>
<div class="cl" style="height:40px;"></div>
<div class="comiis_space_footfb bg_f b_t">
<a href="home.php?mod=spacecp&amp;ac=blog"><i class="comiis_font f_wb">&#xe62d;</i><span class="f_b">发布日志</span></a>
</div>
<?php } else { include template('home/space_footer'); } } $comiis_foot = 'no';?><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>