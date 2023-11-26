<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_doing');?>
<?php $comiis_bg = 1;?><?php include template('common/header'); if($comiis_app_switch['comiis_doingtimgs']) { ?><?php echo $comiis_app_switch['comiis_doingtimgs'];?><?php } if($comiis_app_switch['comiis_subnv_top'] != 1) { ?><div style="height:40px;"><div class="comiis_scrollTop_box"><?php } ?>
<div class="comiis_topnv bg_f b_b">
<ul class="comiis_flex">
<li class="flex<?php if($actives['me']) { ?> kmon<?php } ?>"><a href="<?php if($_G['uid']) { ?>home.php?mod=space&do=<?php echo $do;?>&view=me<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($actives['me']) { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><?php echo $comiis_lang['all58'];?><?php echo $comiis_lang['all56'];?></a></li>
<li class="flex<?php if($actives['we']) { ?> kmon<?php } ?>"><a href="<?php if($_G['uid']) { ?>home.php?mod=space&do=<?php echo $do;?>&view=we<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>"<?php if($actives['we']) { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>><?php echo $comiis_lang['all59'];?><?php echo $comiis_lang['all56'];?></a></li>		
<li class="flex<?php if($actives['all']) { ?> kmon<?php } ?>"><a href="home.php?mod=space&amp;do=<?php echo $do;?>&amp;view=all"<?php if($actives['all']) { ?> class="b_0 f_0"<?php } else { ?> class="f_c"<?php } ?>>随便看看</a></li>
</ul>
</div>
<?php if($comiis_app_switch['comiis_subnv_top'] != 1) { ?></div></div><?php } if(helper_access::check_module('doing')) { include template('home/space_doing_form'); } ?>
<div class="styli_h10 bg_e cl"></div>
<?php if($dolist) { ?>
<div class="comiis_allpl bg_f cl">
<ul><?php if(is_array($dolist)) foreach($dolist as $dv) { $doid = $dv[doid];?><?php $_GET[key] = $key = random(8);?><li class="comiis_list_readimgs b_t">
<a href="home.php?mod=space&amp;uid=<?php echo $dv['uid'];?>&amp;do=profile" class="allpl_tx bg_e"><?php echo avatar($dv[uid],middle);?></a>
<h2><span class="f_d y"><?php echo dgmdate($dv['dateline'], 'u');?></span><a href="home.php?mod=space&amp;uid=<?php echo $dv['uid'];?>&amp;do=profile" class="f14 f_b"><?php echo $dv['username'];?></a></h2>
<div class="allpl_nr allpl_face">
<?php echo $dv['message'];?>
</div><?php $list = $clist[$doid];?><?php include template('home/space_doing_li'); ?><div class="allpl_ft">				
<?php if(helper_access::check_module('doing')) { ?>
<a href="<?php if($_G['uid']) { ?>home.php?mod=spacecp&ac=doing&op=docomment&handlekey=msg_0&doid=<?php echo $doid;?>&id=0&key=<?php echo $key;?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>" class="<?php if($_G['uid']) { ?>dialog <?php } ?>b_ok f_c bg_e"><i class="comiis_font">&#xe626;</i>回复</a>
<?php } if($dv['uid']==$_G['uid']) { ?><a href="home.php?mod=spacecp&amp;ac=doing&amp;op=delete&amp;doid=<?php echo $doid;?>&amp;id=<?php echo $dv['id'];?>&amp;handlekey=doinghk_<?php echo $doid;?>_<?php echo $dv['id'];?>" id="<?php echo $key;?>_doing_delete_<?php echo $doid;?>_<?php echo $dv['id'];?>" class="dialog b_ok f_c bg_e"><i class="comiis_font">&#xe67f;</i>删除</a><?php } if($dv['status'] == 1) { ?><span class="f_g">待审核</span><?php } ?>
</div>
</li>
<?php } if($pricount) { ?>
<li class="f_d b_t">本页有 <?php echo $pricount;?> 条记录因未通过审核而隐藏</li>
<?php } ?>
</ul>
</div>
<?php if($multi) { ?>
<div  class="bg_f b_t cl"><?php echo $multi;?></div>
<?php } } else { ?>
<div class="comiis_notip comiis_sofa bg_f b_t cl">
<i class="comiis_font f_e cl">&#xe613;</i>
<span class="f_d">现在还没有记录<?php if($space['self']) { ?>您可以用一句话记录下这一刻在做什么<?php } ?></span>
</div>
<?php } $comiis_foot = 'no';?><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>