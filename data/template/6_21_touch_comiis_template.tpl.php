<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
.comiis_mh_twlist01 {overflow:hidden;}
.comiis_mh_twlist01 ul {margin:0 12px;overflow:hidden;}
.comiis_mh_twlist01 .twlist_li:first-child,.comiis_mh_twlist .twlist_li:first-child a {border-top:none !important;}
.comiis_mh_twlist01 .twlist_li a {display:block;width:100%;padding:12px 0;overflow:hidden;}
.comiis_mh_twlist01 .twlist_li a.twlist_noimg {padding:8px 0;}
.comiis_mh_twlist01 .twlist_img {float:right;width:30%;height:85px;overflow:hidden;margin-left:10px;}
.comiis_mh_twlist01 .twlist_img img {width:100%;}
.comiis_mh_twlist01 .twlist_info {height:85px;overflow:hidden;}
.comiis_mh_twlist01 .twlist_info strong {font-weight:400;}
.comiis_mh_twlist01 .twlist_info p,.comiis_mh_twlist01 .twlist_info span {display:block;overflow:hidden;}
.comiis_mh_twlist01 .twlist_info p {height:48px;line-height:24px;font-size:17px;}
.comiis_mh_twlist01 .twlist_info p i {float:left;margin-top:3px;margin-right:4px;height:16px;line-height:16px;font-size:12px;padding:0 2px;overflow:hidden;}
.comiis_mh_twlist01 .twlist_info p i.comiis_xifont:after {border-radius:3px;}
.comiis_mh_twlist01 .twlist_info span {height:20px;line-height:20px;margin-top:17px;font-size:13px;position:relative;}
.comiis_mh_twlist01 .twlist_info span em.img06_tximg {float:left;width:18px;height:18px;line-height:18px;margin-right:4px;border-radius:50%;}
.comiis_mh_twlist01 .twlist_info span img {width:18px;height:18px;border-radius:50%;}
.comiis_mh_twlist01 .twlist_info span em.img06_views {float:right;text-align:right;font-size:12px;display:table-cell;vertical-align:bottom;}
.comiis_mh_twlist01 .twlist_info span i {float:left;margin-top:3px;margin-right:1px;height:14px;line-height:14px;font-size:14px;border-radius:2px;padding:0 2px;overflow:hidden;}
.comiis_mh_twlist01 .twlist_info span font {margin-right:6px;}
</style>
<div class="comiis_mh_twlist01 cl">
<ul><?php if(is_array($comiis['itemlist'])) foreach($comiis['itemlist'] as $temp) { ?><li class="twlist_li b_t">
<a href="<?php echo $temp['url'];?>" title="<?php echo $temp['fields']['fulltitle'];?>">
<div class="twlist_img bg_e"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php if($temp['picflag'] == 0) { ?><?php echo $temp['pic'];?><?php } else { if($temp['picflag'] == 2) { ?><?php echo $_G['setting']['ftp']['attachurl'];?><?php } else { ?><?php echo $_G['setting']['attachurl'];?><?php } if($temp['makethumb'] == 1) { ?><?php echo $temp['thumbpath'];?><?php } else { ?><?php echo $temp['pic'];?><?php } } ?>" width="<?php echo $temp['picwidth'];?>" height="<?php echo $temp['picheight'];?>" alt="<?php echo $temp['fields']['fulltitle'];?>"<?php if($comiis_app_switch['comiis_loadimg']) { ?> class="comiis_loadimages"<?php } ?>
></div>
<div class="twlist_info">
<p><?php if($temp['fields']['views'] > 500) { ?><i class="comiis_xifont f_g"><?php echo $comiis_portal['img06_b'];?></i><?php } ?><?php echo $temp['title'];?></p>
<span>
                        <em class="img06_views f_d"><i class="comiis_mhfont f_e">&#xe604;</i><?php if($temp['fields']['views']) { ?><?php echo $temp['fields']['views'];?><?php } else { ?><?php echo $temp['fields']['viewnum'];?><?php } ?></em>
                        <em class="img06_tximg bg_e"><img <?php if($comiis_app_switch['comiis_loadimg']) { ?>src="./template/comiis_app/pic/none.png" comiis_loadimages=<?php } else { ?>src=<?php } ?>"<?php echo $temp['fields']['avatar'];?>"<?php if($comiis_app_switch['comiis_loadimg']) { ?> class="comiis_loadimages"<?php } ?>
            ></em><font class="f_b"><?php if($temp['fields']['author']) { ?><?php echo $temp['fields']['author'];?><?php } else { ?><?php echo $temp['fields']['username'];?><?php } ?></font>
                        <font class="f_d"><?php echo dgmdate($temp['fields']['dateline'], ($comiis['dateuformat'] == 1 ? 'u' : $comiis['dateformat']));; ?></font>
</span>
</div>
</a>
</li>
<?php } ?>
</ul>
</div><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>