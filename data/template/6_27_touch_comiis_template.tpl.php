<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
.comiis_mh_hdimg {padding:0 6px 12px;overflow:hidden;}
.comiis_mh_hdimg li {float:left;margin:12px 6px 0;width:60%;box-sizing:border-box;overflow:hidden;position:relative;border:none !important;}
.comiis_mh_hdimg li a.kmimg {display:block;}
.comiis_mh_hdimg li a.kmimg img {width:100%;}
.comiis_mh_hdimg li .nums {position:absolute;top:0px;right:0px;background:rgba(0,0,0,0.5);height:20px;line-height:20px;padding:0 5px;font-size:12px;font-weight:400;border-bottom-left-radius:3px;}
.comiis_mh_hdimg li .nums i {float:left;margin-right:3px;font-size:14px;}
.comiis_mh_hdimg li .img_stick {position:absolute;top:0px;left:0px;height:20px;line-height:20px;padding:0 5px;font-size:12px;font-weight:400;border-bottom-right-radius:3px;}
.comiis_mh_hdimg li h2 {padding:7px 10px 6px;height:44px;line-height:22px;font-size:16px;font-weight:400;}
.comiis_mh_hdimg li h2.kmnop {padding:8px 0 0;height:40px;line-height:20px;font-size:14px;}
.comiis_mh_hdimg li h2 a {display:block;}
.comiis_mh_hdimg li h2 span {float:left;margin-top:2px;margin-right:4px;padding:0 2px;height:16px;line-height:16px;font-size:12px;border-radius:2px;}
.comiis_mh_hdimg li p {padding:0 10px 10px;height:20px;line-height:20px;font-size:12px;}
.comiis_mh_hdimg li p a {float:left;font-size:12px;}
.comiis_mh_hdimg li p a img {float:left;width:20px;height:20px;margin-right:5px;border-radius:50%;}
.comiis_mh_hdimg li p span i {font-size:12px;margin-right:2px;}
</style>
<div id="comiis_mh_imggo<?php echo $data['id'];?>" class="comiis_mh_hdimg cl">
<ul class="swiper-wrapper">
    <?php if(is_array($comiis['itemlist'])) foreach($comiis['itemlist'] as $temp) { ?><li class="swiper-slide bg_e">					
<a href="<?php echo $temp['url'];?>" title="<?php echo $temp['fields']['fulltitle'];?>" class="kmimg"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>
"<?php if($temp['picflag'] == 0) { ?><?php echo $temp['pic'];?><?php } else { if($temp['picflag'] == 2) { ?><?php echo $_G['setting']['ftp']['attachurl'];?><?php } else { ?><?php echo $_G['setting']['attachurl'];?><?php } if($temp['makethumb'] == 1) { ?><?php echo $temp['thumbpath'];?><?php } else { ?><?php echo $temp['pic'];?><?php } } ?>" alt="<?php echo $temp['fields']['fulltitle'];?>" width="100%" class="vm comiis_imggo_whb<?php echo $data['id'];?><?php if($comiis_app_switch['comiis_loadimg']) { ?> comiis_loadimages<?php } ?>"></a>							
<h2><a href="<?php echo $temp['url'];?>" title="<?php echo $temp['fields']['fulltitle'];?>"><?php echo $temp['title'];?></a></h2>
<p>
<span class="y f_c"><?php if($temp['fields']['views']) { ?><?php echo $temp['fields']['views'];?><?php } else { ?><?php echo $temp['fields']['viewnum'];?><?php } ?><?php echo $comiis_portal['img04_b'];?></span>
<a href="home.php?mod=space&amp;uid=<?php if($temp['fields']['author']) { ?><?php echo $temp['fields']['authorid'];?><?php } else { ?><?php echo $temp['fields']['uid'];?><?php } ?>&amp;do=profile" rel="nofollow"><img src="<?php echo $temp['fields']['avatar_middle'];?>" class="vm f_b"><?php if($temp['fields']['author']) { ?><?php echo $temp['fields']['author'];?><?php } else { ?><?php echo $temp['fields']['username'];?><?php } ?></a>
</p>
</li>
<?php } ?>
</ul>
</div>
<script>
  $('.comiis_imggo_whb<?php echo $data['id'];?>').css('height', ($('.comiis_imggo_whb<?php echo $data['id'];?>').width() * <?php echo $comiis['picheight'] / $comiis['picwidth'];; ?>) + 'px');
comiis_app_portal_swiper('#comiis_mh_imggo<?php echo $data['id'];?>', {
freeMode : true,
freeModeMomentumRatio : 0.5,
slidesPerView : 'auto',
onTouchMove: function(swiper){
Comiis_Touch_on = 0;
},
onTouchEnd: function(swiper){
Comiis_Touch_on = 1;
},
});
</script><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>