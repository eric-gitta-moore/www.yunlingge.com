<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');?><?php include template('common/header'); $comiis_app_switch['comiis_list_zntits'] = $comiis_app_switch['comiis_grouplist_zntits'];?><?php if($comiis_app_switch['comiis_group_style'] == 1 || $_GET['hot'] == 'yes') { include template('group/comiis_grouplist'); } else { include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_group_index.php';?><?php if(!$_GET['inajax'] && $page == 1) { ?>	
<div class="comiis_topsearch cl">	  
<div id="comiis_search_noe"><a href="javascript:comiis_search_show(1);" class="ssbox ssct b_ok bg_f f_d"><i class="comiis_font f_d">&#xe622;</i> <?php echo $comiis_group_lang['024'];?></a></div>
<div id="comiis_search_two" style="display:none">            
<form class="searchform" method="post" autocomplete="off" action="search.php?mod=group">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="searchsubmit" value="yes" />
<ul class="comiis_flex">				
<input type="search" id="scform_srchtxt" name="srchtxt" placeholder="<?php echo $comiis_lang['enter_content'];?>..." class="ssbox b_ok bg_f f_d flex" />	
<a href="javascript:comiis_search_show(0);" class="f_0"><?php echo $comiis_lang['all9'];?></a>
</ul>			
</form>
</div>
</div>	
    <script>
    function comiis_search_show(a){
        if(a == 1){
            $('#comiis_search_noe').hide();
            $('#comiis_search_two').show()
            $('#scform_srchtxt').focus();
        }else{
            $('#comiis_search_two').hide();
            $('#comiis_search_noe').show();
        }
    }
    </script>
    <?php if($comiis_app_switch['comiis_group_thtml']) { ?><?php echo $comiis_app_switch['comiis_group_thtml'];?><?php } ?>
<script src="template/comiis_app/comiis/js/comiis_swiper.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script>
if($("#comiis_rollimg li").length > 0) {
var comiis_index = $("#comiis_rollimg li").offset().left + $("#comiis_rollimg li").width() >= $(window).width() ? $("#comiis_rollimg li").index() : 0;
}else{
var comiis_index = 0;
}
mySwiper = new Swiper('#comiis_rollimg', {
freeMode : true,
slidesPerView : 'auto',
initialSlide : comiis_index,
onTouchMove: function(swiper){
Comiis_Touch_on = 0;
},
onTouchEnd: function(swiper){
Comiis_Touch_on = 1;
},
});
</script>
<div class="comiis_uibox bg_f b_t b_b cl">
<h2 class="b_b"><?php if($_G['uid']) { ?><a href="group.php?mod=my&amp;view=join" class="comiis_xifont y f_0"><i class="comiis_font">&#xe612;</i> <?php echo $comiis_lang['tip250'];?></a><?php } if(($comiis_app_switch['comiis_header_show'] == 2 || ($comiis_app_switch['comiis_header_show'] == 3 && $comiis_isweixin == 1))) { ?><a href="forum.php?mod=group&amp;action=create" class="comiis_xifont y f_wx">+ <?php echo $comiis_group_lang['033'];?></a><?php } ?><span class="f_c"><?php echo $comiis_group_lang['037'];?></span><?php if($comiis_app_switch['comiis_group_jxtj'] == 0) { ?> <em class="f_c"><?php echo count($user_fid); ?></em><?php } ?></h2>
<?php if($_G['uid'] && count($user_fid)) { ?>
  <div class="comiis_userlist01<?php if($comiis_app_switch['comiis_group_jxtj'] == 0) { ?> b_b<?php } ?> cl">
  <ul><?php $n = 0;?><?php if(is_array($user_fid)) foreach($user_fid as $fid) { $n++;?><?php if($n > 5) { break;?><?php } ?>
<li class="b_t">
<a href="forum.php?mod=group&amp;fid=<?php echo $fid['fid'];?>" class="block">
<i class="comiis_font f_e">&#xe60c;</i>
<?php if($fid['todayposts']) { ?><em class="bg_c f_f"><?php echo $fid['todayposts'];?></em><?php } ?>
<span class="list01_limg bg_e"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php echo $fid['icon'];?>" alt="<?php echo $fid['name'];?>"<?php if($comiis_app_switch['comiis_loadimg']) { ?> class="comiis_loadimages"<?php } ?> /></span>
<p class="tit"><?php echo $fid['name'];?></p>
<p class="txt f_d"><?php echo $fid['description'];?></p>
</a>
</li>
<?php } if($comiis_app_switch['comiis_group_jxtj'] == 1 && count($user_fid) > 5) { ?>
<li class="b_t">
<a href="group.php?mod=my&amp;view=join" class="f_d f14"><?php echo $comiis_group_lang['041'];?><?php echo count($user_fid); ?><?php echo $comiis_group_lang['038'];?></a>
</li>
<?php } ?>
  </ul>
  </div>
<?php if($comiis_app_switch['comiis_group_jxtj'] == 0) { ?>
<div class="comiis_notip comiis_sofa bg_f cl">
<a href="group.php?mod=my&amp;view=join" class="bg_c f_f cl" style="margin-top:0;"><?php echo $comiis_lang['all58'];?><?php echo $comiis_group_lang['001'];?></a><a href="group.php?hot=yes" class="bg_c f_f cl" style="margin-top:0;"><?php echo $comiis_lang['all'];?><?php echo $comiis_group_lang['001'];?></a>
</div> 
<?php } } else { ?>
<div class="comiis_notip comiis_sofa bg_f cl">
<i class="comiis_font f_d cl">&#xe613;</i>
<span class="f_d"><?php echo $comiis_group_lang['039'];?></span>
<a href="group.php?hot=yes" class="bg_c f_f cl"><?php echo $comiis_group_lang['040'];?></a>
</div>
<?php } ?>
</div>
<?php if($comiis_app_switch['comiis_group_jxtj'] == 1 && $_G['setting']['group_recommend'] && count(dunserialize($_G['setting']['group_recommend']))) { ?>
<div class="comiis_uibox bg_f b_t b_b mt10 cl">
  <h2 class="b_b"><a href="group.php?hot=yes" class="comiis_xifont y f_0"><i class="comiis_font">&#xe622;</i> <?php echo $comiis_lang['all'];?><?php echo $comiis_group_lang['001'];?></a><span class="f_c"><?php echo $comiis_app_switch['comiis_group_jxtj_name'];?></span></h2>    
  <div class="comiis_userlist01 cl">
  <ul>
   <?php if(is_array(dunserialize($_G['setting']['group_recommend']))) foreach(dunserialize($_G['setting']['group_recommend']) as $val) { ?>   <?php if(in_array($val['fid'], $user_fid)) { ?>
<li class="b_t">
<a href="forum.php?mod=group&amp;fid=<?php echo $val['fid'];?>" class="block">
<i class="comiis_font f_e">&#xe60c;</i>
<span class="list01_limg bg_e"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>"<?php if($comiis_app_switch['comiis_loadimg']) { ?> class="comiis_loadimages"<?php } ?> /></span>
<p class="tit"><?php echo $val['name'];?></p>
<p class="txt f_d"><?php echo $val['description'];?></p>
</a>
</li>
<?php } else { ?>
<li class="b_t">
<p class="ybtn"><a href="<?php if($_G['uid']) { ?>forum.php?mod=group&action=join&fid=<?php echo $val['fid'];?><?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>" class="comiis_sendbtn bg_c f_f<?php if($_G['uid']) { ?> dialog<?php } ?>">+ <?php echo $comiis_group_lang['041'];?></a></p>
<a href="forum.php?mod=group&amp;fid=<?php echo $val['fid'];?>" class="list01_limg bg_e"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php echo $val['icon'];?>" alt="<?php echo $val['name'];?>"<?php if($comiis_app_switch['comiis_loadimg']) { ?> class="comiis_loadimages"<?php } ?> /></a>
<p class="tit"><a href="forum.php?mod=group&amp;fid=<?php echo $val['fid'];?>"><?php echo $val['name'];?></a></p>
<p class="txt f_d"><?php echo $val['description'];?></p>
  </a>
</li>
<?php } } ?>
  </ul>
  </div>
</div>
<?php } if($comiis_app_switch['comiis_group_bhtml']) { ?><?php echo $comiis_app_switch['comiis_group_bhtml'];?><?php } } $comiis_page = ceil($num/$mpp);?><?php if($comiis_app_switch['comiis_group_ilist']) { if(!$_GET['inajax'] && $_G['uid']) { ?>
<script>var formhash = '<?php echo FORMHASH;?>', allowrecommend = '<?php echo $_G['group']['allowrecommend'];?>';</script>
<script src="template/comiis_app/comiis/js/comiis_forumdisplay.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if(!$_GET['inajax'] && $page == 1) { ?><div class="mt10"></div><?php } if(!$_GET['inajax']) { if($comiis_app_switch['comiis_subnv_top'] != 1) { ?><div style="height:40px;"><div class="comiis_scrollTop_box"><?php } ?>
<div class="comiis_topnv bg_f b_b">
  <ul class="comiis_flex">
<li class="flex kmon"><a href="group.php?mod=index" class="b_0 f_0"><?php echo $comiis_group_lang['043'];?><?php echo $comiis_group_lang['014'];?></a></li>
<li class="flex"><a href="<?php if($_G['uid']) { ?>group.php?mod=my&view=mythread<?php } elseif(!$_G['connectguest']) { ?>javascript:popup.open('<?php echo $comiis_lang['tip16'];?>', 'confirm', 'member.php?mod=logging&action=login');<?php } else { ?>javascript:popup.open('<?php echo $comiis_lang['reg23'];?>', 'confirm', 'member.php?mod=connect');<?php } ?>" class="f_c"><?php echo $comiis_lang['all58'];?><?php echo $comiis_group_lang['014'];?></a></li>
  </ul>
</div>
<?php if($comiis_app_switch['comiis_subnv_top'] != 1) { ?></div></div><?php } } ?>
<div class="comiis_group_list<?php if(!$_GET['inajax'] || $page == 1) { ?> group_mt<?php } ?>"><?php $comiis_list_template = 'default_g_style'; include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_list.php';?></div>
<?php if(!$_GET['inajax']) { if($comiis_app_list_num != 10) { ?><div id="list_new"></div><?php } if($comiis_app_list_num == 10 || $comiis_app_list_num == 7) { ?><style>.group_mt {margin-top:0;}</style><?php } ?>
<div class="comiis_multi_box bg_f b_t" style="margin-top:10px;">
<?php if($multipage && ($comiis_app_switch['comiis_listpage'] == 0 || $page > 1)) { ?>
<?php echo $multipage;?>
<?php } elseif($comiis_app_switch['comiis_listpage'] == 1 && $page < $comiis_page) { ?>
<a href="javascript:;" onclick="comiis_list_page()" class="comiis_loadbtn bg_e f_d"><?php echo $comiis_lang['tip5'];?></a>
<?php } elseif($comiis_app_switch['comiis_listpage'] == 2 && $page < $comiis_page) { ?>
<div class="comiis_loadbtn f_d"><?php echo $comiis_lang['tip6'];?></div>
<?php } elseif($comiis_app_switch['comiis_listpage'] && $comiis_page == 1 && $num > 4) { ?>
<div class="comiis_loadbtn f_d"><?php echo $comiis_lang['tip31'];?></div>
<?php } ?>
</div><?php comiis_load('NrsxXa4A44RXXaW5Wv', 'page,comiis_page,comiis_app_list_num');?><?php } } } $comiis_app_wx_share['img'] = './template/comiis_app/pic/icon152.png';
$comiis_app_wx_share['title'] = $comiis_group_lang['001'].' - '.$comiis_app_switch['comiis_sitename'];?><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>