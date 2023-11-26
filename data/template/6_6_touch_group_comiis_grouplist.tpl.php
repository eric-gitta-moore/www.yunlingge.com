<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($sgid) { $_GET['hot'] = 'yes';?><?php } include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_grouplist.php'?><script>
comiis_group = 1;
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
<script src="template/comiis_app/comiis/js/comiis_forum.js?<?php echo VERHASH;?>" type="text/javascript" charset="<?php echo CHARSET;?>"></script>
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
<div class="comiis_bbslist bg_f cl">
<div class="comiis_bbslist_gid bg_e cl">
<ul>
<li class="<?php if($_GET['hot'] == 'yes' || !$gid) { ?>bg_f <?php } ?>b_b" id="comiis_grouplist_l_0"><span class="bg_0"></span><a href="group.php?hot=yes"><?php echo $comiis_app_switch['comiis_group_jxtj_name'];?></a></li><?php if(is_array($first)) foreach($first as $groupid => $group) { ?><li class="<?php if($gid == $groupid && !$_GET['hot']) { ?>bg_f <?php } ?>b_b" id="comiis_grouplist_l_<?php echo $groupid;?>"><span class="bg_0"></span><a href="group.php?gid=<?php echo $groupid;?>"><?php echo $group['name'];?></a></li>
<?php } ?>		
</ul>
</div>
<div class="comiis_bbslist_fid cl">
<?php if($_GET['hot'] == 'yes' || !$gid) { ?>
<ul id="comiis_grouplist_0">
<?php if($_G['setting']['group_recommend'] && count(dunserialize($_G['setting']['group_recommend']))) { if(($comiis_app_switch['comiis_header_show'] == 2 || ($comiis_app_switch['comiis_header_show'] == 3 && $comiis_isweixin == 1))) { ?><h2 class="b_b"><span class="y f_0"><a href="forum.php?mod=group&amp;action=create">+ <?php echo $comiis_group_lang['033'];?></a></span></h2><?php } if(is_array(dunserialize($_G['setting']['group_recommend']))) foreach(dunserialize($_G['setting']['group_recommend']) as $val) { ?><li class="b_b">				
<?php if(in_array($val['fid'], $user_fid)) { ?>
<span class="kmgroup f_e"><a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $val['fid'];?>"><i class="comiis_font">&#xe60c</i></a></span>
<?php } else { ?>
<span class="bg_c f_f"><a href="forum.php?mod=group&amp;action=join&amp;fid=<?php echo $val['fid'];?>" class="dialog">+ <?php echo $comiis_group_lang['041'];?></a></span>
<?php } ?>				
<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $val['fid'];?>" class="bbslist_v2ico"><img src="<?php if($val['icon']) { ?><?php echo $val['icon'];?><?php } else { ?>static/image/common/groupicon.gif<?php } ?>" class="comiis_noloadimage"></a>
<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $val['fid'];?>" class="post_tit"><em><?php echo $val['name'];?></em><?php if($val['todayposts']) { ?><i class="bg_a f_f"><?php echo $val['todayposts'];?></i><?php } ?></a>
<p class="f_d"><?php echo $val['description'];?></p>
</li>
<?php } } else { ?>
            <div class="comiis_notip cl">
                <i class="comiis_font f_e cl">&#xe613</i>
                <span><em class="f_d"><?php echo $comiis_group_lang['042'];?></em><br><a href="forum.php?mod=group&amp;action=create" class="bg_c f_f"><?php echo $comiis_group_lang['030'];?><?php echo $comiis_group_lang['001'];?></a></span>   
            </div>
<?php } ?>
</ul>	
<?php } else { ?>
<ul id="comiis_grouplist_<?php echo $groupid;?>">
<?php if($list) { if(($comiis_app_switch['comiis_header_show'] == 2 || ($comiis_app_switch['comiis_header_show'] == 3 && $comiis_isweixin == 1))) { ?><h2 class="b_b"><span class="y f_0"><a href="forum.php?mod=group&amp;action=create">+ <?php echo $comiis_group_lang['033'];?></a></span><span class="f_c"><?php echo $curtype['name'];?></span></h2><?php } if(is_array($list)) foreach($list as $fid => $val) { ?><li class="b_b">					
                    <?php if(in_array($fid, $user_fid)) { ?>
                        <span class="kmgroup f_e"><a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $fid;?>"><i class="comiis_font">&#xe60c</i></a></span>
                    <?php } else { ?>
                        <span class="bg_c f_f"><a href="forum.php?mod=group&amp;action=join&amp;fid=<?php echo $fid;?>" class="dialog">+ <?php echo $comiis_group_lang['041'];?></a></span>
                    <?php } ?>
<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $fid;?>" class="bbslist_v2ico"><img src="<?php if($val['icon']) { ?><?php echo $val['icon'];?><?php } else { ?>static/image/common/groupicon.gif<?php } ?>" class="comiis_noloadimage"></a>
<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $fid;?>" class="post_tit"><em><?php echo $val['name'];?></em><?php if($val['todayposts']) { ?><i class="bg_a f_f"><?php echo $val['todayposts'];?></i><?php } ?></a>
<p class="f_d"><?php echo $val['description'];?></p>
</li>
<?php } if($list) { ?><?php echo $multipage;?><?php } } else { ?>
            <div class="comiis_notip cl">
                <i class="comiis_font f_e cl">&#xe613</i>
                <span><em class="f_d"><?php echo $comiis_group_lang['042'];?></em><br><a href="forum.php?mod=group&amp;action=create" class="bg_c f_f"><?php echo $comiis_group_lang['030'];?><?php echo $comiis_group_lang['001'];?></a></span>                
            </div>
<?php } ?>
</ul>
<?php } ?>	
</div>
</div><?php $comiis_app_wx_share['img'] = './template/comiis_app/pic/icon152.png';
$comiis_app_wx_share['title'] = $comiis_group_lang['001'].' - '.$comiis_app_switch['comiis_sitename'];?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>