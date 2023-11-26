<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_menu');
0
|| checktplrefresh('./template/quater_6_motion/home/space_menu.htm', './template/quater_6_motion/home/follow_user_header.htm', 1584698328, '5', './data/template/5_5_home_space_menu.tpl.php', './template/quater_6_motion', 'home/space_menu')
;?>
<link rel="stylesheet" type="text/css" href='/template/quater_6_motion/home/home.css' />
<?php if($space['uid']) { ?>
</div>
<div id="uhd">
<div class="space_h cl">
<div class="icn cl"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo avatar($space[uid],big);?></a></div>
<h2 class="mt">
<?php echo $space['username'];?>
<?php if(isset($flag[$_G['uid']])) { ?>
<span style="font-size: 12px; color: #FFFFFF; font-weight: 400;">
<span id="followbkame_<?php echo $uid;?>"><?php if($flag[$_G['uid']]['bkname']) { ?><?php echo $flag[$_G['uid']]['bkname'];?><?php } ?></span>
<a href="home.php?mod=spacecp&amp;ac=follow&amp;op=bkname&amp;fuid=<?php echo $uid;?>&amp;handlekey=followbkame_<?php echo $uid;?>" id="fbkname_<?php echo $uid;?>" onclick="showWindow('followbkame_<?php echo $uid;?>', this.href, 'get', 0);" style="color: #FFFFFF;"><?php if($flag[$_G['uid']]['bkname']) { ?>[修改备注]<?php } else { ?>[添加备注]<?php } ?></a>
</span>
<?php } ?>
</h2>
        	<?php if(CURMODULE == 'follow') { ?><p class="follow_us">
<?php if(helper_access::check_module('follow')) { ?>
<a href="home.php?mod=follow&amp;uid=<?php echo $uid;?>&amp;do=view" class="xi2 new1"><?php echo $space['feeds'];?> 广播</a>
<a href="home.php?mod=follow&amp;do=following&amp;uid=<?php echo $uid;?>" class="xi2 new1"><?php echo $space['following'];?> 收听</a>
<a href="home.php?mod=follow&amp;do=follower&amp;uid=<?php echo $uid;?>" id="followernum_<?php echo $uid;?>" class="xi2 old1"><?php echo $space['follower'];?> 听众</a>
<?php } if(!$viewself) { ?>
<div class="o cl">
<div class="follow_us" id="followflag" <?php if(!isset($flag[$_G['uid']])) { ?>style="display: none"<?php } ?>>
<?php if(helper_access::check_module('follow')) { ?>
<a href="home.php?mod=spacecp&amp;ac=follow&amp;op=add&amp;hash=<?php echo FORMHASH;?>&amp;special=<?php if($flag[$_G['uid']]['status'] == 1) { ?>2<?php } else { ?>1<?php } ?>&amp;fuid=<?php echo $uid;?>&amp;from=head" class="<?php if($flag[$_G['uid']]['status'] == 1) { ?>new1<?php } else { ?>old1<?php } ?>" id="specialflag_<?php echo $uid;?>" onclick="ajaxget(this.href);doane(event);" title="<?php if($flag[$_G['uid']]['status'] == 1) { ?>取消特别收听<?php } else { ?>添加特别收听<?php } ?>"><?php if($flag[$_G['uid']]['status'] == 1) { ?><?php echo langfollow_del_special_following;?><?php } else { ?>添加特别收听<?php } ?></a>
<?php } if($flag[$_G['uid']]['mutual']) { ?>
<a class="new1">互相收听</a>
<?php } else { ?>
<a class="new1">已收听</a>
<?php } ?>
<a id="a_followmod_<?php echo $uid;?>" href="home.php?mod=spacecp&amp;ac=follow&amp;op=del&amp;fuid=<?php echo $uid;?>&amp;from=head" onclick="ajaxget(this.href);doane(event);" class="xi2 new1">取消收听</a>
</div>
<div class="follow_us" id="unfollowflag" <?php if(isset($flag[$_G['uid']])) { ?>style="display: none"<?php } ?>>
<?php if(isset($flag[$uid])) { ?>
<span class="z flw_status_1">TA已收听您</span>
<?php } if(helper_access::check_module('follow')) { ?>
<a id="a_followmod_<?php echo $uid;?>" href="home.php?mod=spacecp&amp;ac=follow&amp;op=add&amp;hash=<?php echo FORMHASH;?>&amp;fuid=<?php echo $uid;?>&amp;from=head" onclick="ajaxget(this.href);doane(event);" class="new1">收听</a>
<?php } ?>
</div>
</div>
<?php } ?>
</p>
<?php } elseif(!$space['self']) { ?>
<p class="follow_us">
<?php if(helper_access::check_module('follow')) { if(!ckfollow($space['uid'])) { ?>
<a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=follow&amp;op=add&amp;hash=<?php echo FORMHASH;?>&amp;fuid=<?php echo $space['uid'];?>" class="new1">收听TA</a>
<?php } else { ?>
<a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=follow&amp;op=del&amp;fuid=<?php echo $space['uid'];?>" class="old1">取消收听</a>
<?php } } if(!$isfriend) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=addfriendhk_<?php echo $space['uid'];?>" id="a_friend_li_<?php echo $space['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2 new1">加为好友</a>
<?php } else { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=ignorefriendhk_<?php echo $space['uid'];?>" id="a_ignore_<?php echo $space['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="xi2 old1">解除好友</a>
<?php } ?>
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $space['uid'];?>&amp;touid=<?php echo $space['uid'];?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?php echo $space['uid'];?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)" title="发送消息" class="old1">发送消息</a>
<?php if(helper_access::check_module('follow')) { ?>
<script type="text/javascript">
function succeedhandle_followmod(url, msg, values) {
var fObj = $('followmod');
if(values['type'] == 'add') {
fObj.innerHTML = '取消收听';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid='+values['fuid'];
} else if(values['type'] == 'del') {
fObj.innerHTML = '收听TA';
fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash=<?php echo FORMHASH;?>&fuid='+values['fuid'];
}
}
</script>
<?php } ?>
</p>
<?php } ?>
    <p class="manage cl">
<a href="<?php echo $_G['siteurl'];?>?<?php echo $uid;?>" class="xg1" style="display: none;"><?php echo $_G['siteurl'];?>?<?php echo $uid;?></a>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<span class="pipe" style="display: none;">|</span>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { if(checkperm('allowbanuser')) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?php echo $encodeusername;?>&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?php echo $space['uid'];?><?php } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<?php } else { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?php echo $encodeusername;?>&submit=yes&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $space['uid'];?><?php } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<?php } } if($_G['adminid'] == 1) { ?>
<a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?php echo $encodeusername;?>" id="umanageli" onmouseover="showMenu(this.id)" class="showmenu">内容管理</a>
<?php } if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<ul id="usermanageli_menu" class="p_pop" style="width: 80px; display:none;">
<?php if(checkperm('allowbanuser')) { ?>
<li><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?php echo $encodeusername;?>&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?php echo $space['uid'];?><?php } ?>" target="_blank">禁止用户</a></li>
<?php } if(checkperm('allowedituser')) { ?>
<li><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?php echo $encodeusername;?>&submit=yes&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $space['uid'];?><?php } ?>" target="_blank">编辑用户</a></li>
<?php } ?>
</ul>
<?php } if($_G['adminid'] == 1) { ?>
<ul id="umanageli_menu" class="p_pop" style="width: 80px; display:none;">
<li><a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;searchsubmit=1&amp;do=search&amp;users=<?php echo $encodeusername;?>" target="_blank">管理帖子</a></li>
<?php if(helper_access::check_module('doing')) { ?>
<li><a href="admin.php?action=doing&amp;searchsubmit=1&amp;detail=1&amp;search=true&amp;fromumanage=1&amp;users=<?php echo $encodeusername;?>" target="_blank">管理记录</a></li>
<?php } if(helper_access::check_module('blog')) { ?>
<li><a href="admin.php?action=blog&amp;searchsubmit=1&amp;detail=1&amp;search=true&amp;fromumanage=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理日志</a></li>
<?php } if(helper_access::check_module('feed')) { ?>
<li><a href="admin.php?action=feed&amp;searchsubmit=1&amp;detail=1&amp;fromumanage=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理动态</a></li>
<?php } if(helper_access::check_module('album')) { ?>
<li><a href="admin.php?action=album&amp;searchsubmit=1&amp;detail=1&amp;search=true&amp;fromumanage=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理相册</a></li>
<li><a href="admin.php?action=pic&amp;searchsubmit=1&amp;detail=1&amp;search=true&amp;fromumanage=1&amp;users=<?php echo $encodeusername;?>" target="_blank">管理图片</a></li>
<?php } if(helper_access::check_module('wall')) { ?>
<li><a href="admin.php?action=comment&amp;searchsubmit=1&amp;detail=1&amp;fromumanage=1&amp;authorid=<?php echo $space['uid'];?>" target="_blank">管理评论</a></li>
<?php } if(helper_access::check_module('share')) { ?>
<li><a href="admin.php?action=share&amp;searchsubmit=1&amp;detail=1&amp;search=true&amp;fromumanage=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理分享</a></li>
<?php } if(helper_access::check_module('group')) { ?>
<li><a href="admin.php?action=threads&amp;operation=group&amp;searchsubmit=1&amp;detail=1&amp;search=true&amp;fromumanage=1&amp;users=<?php echo $encodeusername;?>" target="_blank">群组主题</a></li>
<li><a href="admin.php?action=prune&amp;searchsubmit=1&amp;detail=1&amp;operation=group&amp;fromumanage=1&amp;users=<?php echo $encodeusername;?>" target="_blank">群组帖子</a></li>
<?php } ?>
</ul>
<?php } } ?>
</p>
 </div>
    </div>
    <div class="wp cl">

<?php if(!empty($_G['setting']['pluginhooks']['space_menu_extra'])) echo $_G['setting']['pluginhooks']['space_menu_extra'];?>
    <div class="space_nav cl">
 <ul class="tb_1 cl">
        <li<?php if($do==profile) { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=profile&amp;from=space"><img src="/template/quater_6_motion/src/space_profile.png" class="vm"></img>TA的资料</a></li>
<?php if(helper_access::check_module('follow')) { ?>
<li<?php if(CURMODULE == 'follow') { ?> class="a"<?php } ?>><a href="home.php?mod=follow&amp;uid=<?php echo $space['uid'];?>&amp;do=view&amp;from=space"><img src="/template/quater_6_motion/src/space_follow.png" class="vm"></img>广播</a></li>
<?php } ?>
        <li<?php if($do=='thread') { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me&amp;from=space"><img src="/template/quater_6_motion/src/space_thread.png" class="vm"></img>主题</a></li>
<?php if(helper_access::check_module('blog')) { ?>
<li<?php if($do=='blog') { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=blog&amp;view=me&amp;from=space"><img src="/template/quater_6_motion/src/space_blog.png" class="vm"></img>日志</a></li>
<?php } if(helper_access::check_module('album')) { ?>
<li<?php if($do=='album') { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me&amp;from=space"><img src="/template/quater_6_motion/src/space_album.png" class="vm"></img>相册</a></li>
<?php } if(helper_access::check_module('doing')) { ?>
<li<?php if($do=='doing') { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=doing&amp;view=me&amp;from=space"><img src="/template/quater_6_motion/src/space_doing.png" class="vm"></img>记录</a></li>
<?php } if(helper_access::check_module('home')) { ?>
<li<?php if($do=='home') { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=home&amp;view=me&amp;from=space"><img src="/template/quater_6_motion/src/space_feed.png" class="vm"></img>动态</a></li>
<?php } if(helper_access::check_module('share')) { ?>
<li<?php if($do=='share') { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=share&amp;view=me&amp;from=space"><img src="/template/quater_6_motion/src/space_share.png" class="vm"></img>分享</a></li>
<?php } if(helper_access::check_module('wall')) { ?>
<li<?php if($do==wall) { ?> class="a"<?php } ?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=wall&amp;from=space"><img src="/template/quater_6_motion/src/space_message.png" class="vm"></img>留言板</a></li>
<?php } ?>
 </ul>
    </div>
</div>
<?php } ?>
<?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>