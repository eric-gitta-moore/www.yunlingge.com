<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
.comiis_mh_twlist {overflow:hidden;}
.comiis_mh_twlist ul {margin:0 12px;overflow:hidden;}
.comiis_mh_twlist .twlist_li:first-child,.comiis_mh_twlist .twlist_li:first-child a {border-top:none !important;}
.comiis_mh_twlist .twlist_li a {display:block;width:100%;padding:12px 0;overflow:hidden;}
.comiis_mh_twlist .twlist_li a.twlist_noimg {padding:8px 0;}
.comiis_mh_twlist .twlist_img {float:left;width:30%;height:85px;overflow:hidden;margin-right:8px;}
.comiis_mh_twlist .twlist_img img {width:100%;}
.comiis_mh_twlist .twlist_info {height:85px;overflow:hidden;}
.comiis_mh_twlist .twlist_info strong {font-weight:400;}
.comiis_mh_twlist .twlist_info p,.comiis_mh_twlist .twlist_info span {display:block;overflow:hidden;}
.comiis_mh_twlist .twlist_info p {height:52px;line-height:26px;font-size:17px;}
.comiis_mh_twlist .twlist_info span {height:20px;line-height:20px;margin-top:14px;font-size:12px;position:relative;}
.comiis_mh_twlist .twlist_info span em {float:right;text-align:right;display:table-cell;vertical-align:bottom;}
.comiis_mh_twlist .twlist_info span i {float:right;margin-top:1px;margin-left:4px;height:14px;line-height:14px;font-size:12px;border-radius:2px;padding:0 2px;overflow:hidden;}
</style>
<div class="comiis_mh_twlist cl">
<ul><?php if(is_array($comiis['itemlist'])) foreach($comiis['itemlist'] as $temp) { ?><li class="twlist_li b_t">
<a href="<?php echo $temp['url'];?>" title="<?php echo $temp['fields']['fulltitle'];?>">
<div class="twlist_img bg_e"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php if($temp['picflag'] == 0) { ?><?php echo $temp['pic'];?><?php } else { if($temp['picflag'] == 2) { ?><?php echo $_G['setting']['ftp']['attachurl'];?><?php } else { ?><?php echo $_G['setting']['attachurl'];?><?php } if($temp['makethumb'] == 1) { ?><?php echo $temp['thumbpath'];?><?php } else { ?><?php echo $temp['pic'];?><?php } } ?>" width="<?php echo $temp['picwidth'];?>" height="<?php echo $temp['picheight'];?>" alt="<?php echo $temp['fields']['fulltitle'];?>"<?php if($comiis_app_switch['comiis_loadimg']) { ?> class="comiis_loadimages"<?php } ?>></div>
<div class="twlist_info">
<p><?php echo $temp['title'];?></p>
<span class="f_d"><em><?php if($temp['fields']['views'] > 500) { ?><i class="b_ok b_i f_g"><?php echo $comiis_portal['img02_b'];?></i><?php } if($temp['fields']['views']) { ?><?php echo $temp['fields']['views'];?><?php } else { ?><?php echo $temp['fields']['viewnum'];?><?php } ?><?php echo $comiis_portal['img02_c'];?></em><?php echo dgmdate($temp['fields']['dateline'], ($comiis['dateuformat'] == 1 ? 'u' : $comiis['dateformat']));; ?></span>
</div>
</a>
</li>
<?php } ?>
</ul>
</div><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>