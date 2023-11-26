<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_wall');?>
<?php $_G['home_tpl_titles'] = array('留言板');?><?php include template('common/header'); include template('home/space_header'); ?><style>.comiis_footer_scroll {bottom:82px;}</style>
<?php if($_GET['cid'] && $_GET['view'] != 'me') { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $_GET['uid'];?>&amp;do=wall&amp;view=me&amp;from=space" class="comiis_loadbtn bg_f f_d"><?php echo $comiis_lang['home_openall'];?></a>
<?php } ?>
<div class="comiis_plli bg_f b_t mt10 cl">			
<?php if(count($list) > 0) { if(is_array($list)) foreach($list as $k => $value) { include template('home/space_comment_li'); } ?>	
<?php } else { ?>
<div class="comiis_notip comiis_sofa mt15 cl">
<i class="comiis_font f_e cl">&#xe613;</i>
<span class="f_d"><?php echo $comiis_lang['all22'];?></span>
</div>
<?php } ?>
</div>
<?php if($multi) { ?><div class="b_t cl"><?php echo $multi;?></div><?php } if(!$_GET['cid'] && $_GET['view'] == 'me') { comiis_load('RJBRz3jgasJF1jxRfj', 'space,wall');?><?php } $comiis_foot = 'no';?><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>