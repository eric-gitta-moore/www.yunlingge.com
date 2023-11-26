<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
.comiis_mh_img14 {overflow:hidden;position:relative;}
.comiis_mh_img14 .swiper-slide h2 {position:absolute;left:0;bottom:0;color:#fff;width:100%;height:55px;padding:8px 0 12px;background:rgba(0,0,0,0.2);overflow:hidden;}
.comiis_mh_img14 .swiper-slide h2 span.kmtit {display:block;height:30px;line-height:30px;padding:0 12px;margin-bottom:5px;font-size:18px;font-weight:400;}
.comiis_mh_img14 .swiper-slide h2 span.kmuser {display:block;height:20px;line-height:20px;padding:0 12px;font-weight:400;}
.comiis_mh_img14 .swiper-slide h2 span.kmuser img {float:left;width:20px;height:20px;margin-right:6px;border-radius:50%;}
.comiis_mh_img14 .swiper-slide h2 span.kmuser em {padding:0 10px;}
.comiis_mh_img14_roll {position:absolute;right:10px;bottom:14px;height:16px;width:100%;text-align:right;z-index:9;overflow:hidden;}
.comiis_mh_img14_roll .swiper-pagination-bullet {display:inline-block;width:8px;height:8px;margin:0 2px;background-color:rgba(255, 255, 255, 1);border-radius:10px;}
.comiis_mh_img14_roll .swiper-pagination-bullet-active {background-color:#F90;}
</style>
<div class="comiis_mh_img14 comiis_mh_img14<?php echo $data['id'];?>">
<ul class="swiper-wrapper">
    <?php if(is_array($comiis['itemlist'])) foreach($comiis['itemlist'] as $temp) { ?><li class="swiper-slide">
            <a href="<?php echo $temp['url'];?>" title="<?php echo $temp['fields']['fulltitle'];?>">
<img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php if($temp['picflag'] == 0) { ?><?php echo $temp['pic'];?><?php } else { if($temp['picflag'] == 2) { ?><?php echo $_G['setting']['ftp']['attachurl'];?><?php } else { ?><?php echo $_G['setting']['attachurl'];?><?php } if($temp['makethumb'] == 1) { ?><?php echo $temp['thumbpath'];?><?php } else { ?><?php echo $temp['pic'];?><?php } } ?>" width="100%" class="vm comiis_mh_img14_whb<?php echo $data['id'];?><?php if($comiis_app_switch['comiis_loadimg']) { ?> comiis_loadimages<?php } ?>" alt="<?php echo $temp['fields']['fulltitle'];?>">
<h2><span class="kmtit"><?php echo $temp['title'];?></span><span class="kmuser"><img src="<?php echo $temp['fields']['avatar_middle'];?>" class="vm"><?php if($temp['fields']['author']) { ?><?php echo $temp['fields']['author'];?><?php } else { ?><?php echo $temp['fields']['username'];?><?php } ?><em class="comiis_tm">|</em><?php if($temp['fields']['views']) { ?><?php echo $temp['fields']['views'];?><?php } else { ?><?php echo $temp['fields']['viewnum'];?><?php } ?><?php echo $comiis_portal['img14_b'];?>&nbsp;&nbsp;&nbsp;<?php if($temp['fields']['replies']) { ?><?php echo $temp['fields']['replies'];?><?php } else { ?>0<?php } ?><?php echo $comiis_portal['img14_c'];?></span></h2>
</a>
</li>
<?php } ?>
</ul>
<div class="comiis_mh_img14_roll comiis_mh_img14_roll<?php echo $data['id'];?>"></div>
</div>
<script>
  $('.comiis_mh_img14_whb<?php echo $data['id'];?>').css('height', ($('.comiis_mh_img14_whb<?php echo $data['id'];?>').width() * <?php echo $comiis['picheight'] / $comiis['picwidth'];; ?>) + 'px');
comiis_app_portal_swiper('.comiis_mh_img14<?php echo $data['id'];?>', {
slidesPerView : 'auto',
        pagination: '.comiis_mh_img14_roll<?php echo $data['id'];?>',
loop: true,
autoplay: 5000,
        autoplayDisableOnInteraction: false,
onTouchMove: function(swiper){
Comiis_Touch_on = 0;
},
onTouchEnd: function(swiper){
Comiis_Touch_on = 1;
},
});
</script><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>