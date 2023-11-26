<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
</div>
<?php if(empty($topic) || ($topic['usefooter'])) { $focusid = getfocus_rand($_G[basescript]);?><?php if($focusid !== null) { $focus = $_G['cache']['focus']['data'][$focusid];?><?php $focusnum = count($_G['setting']['focus'][$_G[basescript]]);?><div class="focus" id="sitefocus">
    <div class="bm">
        <div class="bm_h cl"> <a href="javascript:;" onclick="setcookie('nofocus_<?php echo $_G['basescript'];?>', 1, <?php echo $_G['cache']['focus']['cookie'];?>*3600);$('sitefocus').style.display='none'" class="y" title="关闭">关闭</a>
            <h2>
                <?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?>
                <span id="focus_ctrl" class="fctrl"><img src="<?php echo IMGDIR;?>/pic_nv_prev.gif" alt="上一条" title="上一条" id="focusprev" class="cur1" onclick="showfocus('prev');" /> <em><span id="focuscur"></span>/<?php echo $focusnum;?></em> <img src="<?php echo IMGDIR;?>/pic_nv_next.gif" alt="下一条" title="下一条" id="focusnext" class="cur1" onclick="showfocus('next')" /></span> </h2>
        </div>
        <div class="bm_c" id="focus_con"> </div>
    </div>
</div><?php $focusi = 0;?><?php if(is_array($_G['setting']['focus'][$_G['basescript']])) foreach($_G['setting']['focus'][$_G['basescript']] as $id) { ?><div class="bm_c" style="display: none" id="focus_<?php echo $focusi;?>">
    <dl class="xld cl bbda">
        <dt><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2" target="_blank"><?php echo $_G['cache']['focus']['data'][$id]['subject'];?></a></dt>
        <?php if($_G['cache']['focus']['data'][$id]['image']) { ?>
        <dd class="m"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" target="_blank"><img src="<?php echo $_G['cache']['focus']['data'][$id]['image'];?>" alt="<?php echo $_G['cache']['focus']['data'][$id]['subject'];?>" /></a></dd>
        <?php } ?>
        <dd><?php echo $_G['cache']['focus']['data'][$id]['summary'];?></dd>
    </dl>
    <p class="ptn cl"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2 y" target="_blank">查看 &raquo;</a></p>
</div><?php $focusi ++;?><?php } ?>
<script type="text/javascript">
    var focusnum = <?php echo $focusnum;?>;
    if(focusnum < 2) {
        $('focus_ctrl').style.display = 'none';
    }
    if(!$('focuscur').innerHTML) {
        var randomnum = parseInt(Math.round(Math.random() * focusnum));
        $('focuscur').innerHTML = Math.max(1, randomnum);
    }
    showfocus();
    var focusautoshow = window.setInterval('showfocus(\'next\', 1);', 5000);
</script>
<?php } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1) { ?>
<div class="focus patch" id="patch_notice"></div>
<?php } ?><?php echo adshow("footerbanner/wp a_f/1");?><?php echo adshow("footerbanner/wp a_f/2");?><?php echo adshow("footerbanner/wp a_f/3");?><?php echo adshow("float/a_fl/1");?><?php echo adshow("float/a_fr/2");?><?php echo adshow("couplebanner/a_fl a_cb/1");?><?php echo adshow("couplebanner/a_fr a_cb/2");?><?php echo adshow("cornerbanner/a_cn");?><div id="footer" class="footer cl">
    <div class="footer-2">
        <footer>
            <div id="ft" class="center-container cl">
                <div class="left">
                    <a class="logo" href="#"></a>
                    <p>云凌阁是一个集资源分享、技术教程、编程探讨、游戏技巧于一体的开放大型论坛</p>
                </div>
                <!--div class="qrcode">
                    <img src="/template/quater_6_motion/src/wx.png" alt="下载壹刻" width="101">
                    <p>关注公众号</p>
                </div-->
                <div class="right">
                    <h6 class="contact-number">云凌阁 资源/教程/工具</h6>
                    <div class="link">
                        <a href="#" rel="nofollow">关于我们</a><span></span>
                        <a href="#" target="_blank" rel="nofollow">咨询客服</a><span></span>
                        <a href="#" rel="nofollow">联系我们</a><span></span>
                        <a href="#" target="_blank" rel="nofollow">网站地图</a>
                    </div>
                    <div class="licence">
                        <p>
                            Powered by <a href="<?php echo $_G['setting']['siteurl'];?>" target="_blank">讯幻网</a>
                            &nbsp;&nbsp;&copy; 2016-<?php echo date('Y');?> <a href="#" target="_blank">云凌工作室</a>

                            <?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?>
                            <?php if($_G['setting']['icp']) { ?> <a href="http://www.miitbeian.gov.cn/" target="_blank"> / <?php echo $_G['setting']['icp'];?></a><?php } ?>
                            <?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink'];?>
                            <?php if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?></p>
                        <p>
                            <?php if($_G['groupid'] == 1) { ?>
                            GMT<?php echo $_G['timenow']['offset'];?>, <?php echo $_G['timenow']['time'];?>
                            <span id="debuginfo">
<?php if(debuginfo()) { ?>, Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries
                                <?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if(C::memory()->type) { ?>, <?php echo C::memory()->type; ?> On<?php } ?>.
                                <?php } ?>
                                <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer'];?>

    <?php updatesession();?>    <?php if($_G['uid'] && $_G['group']['allowinvisible']) { ?>
    <script type="text/javascript">
        var invisiblestatus = '<?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?>';
        var loginstatusobj = $('loginstatusid');
        if(loginstatusobj != undefined && loginstatusobj != null) loginstatusobj.innerHTML = invisiblestatus;
    </script>
    <?php } ?>

    <?php } ?>

    <?php if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry']) { ?>
    <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
    <script type="text/javascript" class="lazy_script" src-data="/home.php?mod=spacecp&amp;ac=pm&amp;op=checknewpm&amp;rand=<?php echo $_G['timestamp'];?>"></script>
    <?php } ?>

    <?php if($_G['uid'] && helper_access::check_module('follow') && !isset($_G['cookie']['checkfollow'])) { ?>
    <script type="text/javascript" class="lazy_script" src-data="/home.php?mod=spacecp&amp;ac=follow&amp;op=checkfeed&amp;rand=<?php echo $_G['timestamp'];?>"></script>
    <?php } ?>

    <?php if(!isset($_G['cookie']['sendmail'])) { ?>
    <script type="text/javascript" class="lazy_script" src-data="/home.php?mod=misc&amp;ac=sendmail&amp;rand=<?php echo $_G['timestamp'];?>"></script>
    <?php } ?>

    <?php } ?>

    <?php if($_GET['diy'] == 'yes') { ?>
    <?php if(check_diy_perm($topic) && (empty($do) || $do != 'index')) { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="<?php echo $_G['setting']['jspath'];?>portal_diy<?php if(!check_diy_perm($topic, 'layout')) { ?>_data<?php } ?>.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <?php } ?>
    <?php if($space['self'] && CURMODULE == 'space' && $do == 'index') { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <?php } ?>
    <?php } ?>
    <?php if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1) { ?>
    <script type="text/javascript">patchNotice();</script>
    <?php } ?>
    <?php if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && empty($_G['cookie']['pluginnotice'])) { ?>
    <div class="focus plugin" id="plugin_notice"></div>
    <script type="text/javascript">pluginNotice();</script>
    <?php } ?>
    <?php if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry'] && $_G['setting']['disableipnotice'] != 1 && $_G['uid'] && !empty($_G['cookie']['lip'])) { ?>
    <div class="focus plugin" id="ip_notice"></div>
    <script type="text/javascript">ipNotice();</script>
    <?php } ?>
    <?php if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_GET['do'] != 'notice') { ?>
    <script type="text/javascript">noticeTitle();</script>
    <?php } ?>

    <?php if(($_G['member']['newpm'] || $_G['member']['newprompt']) && empty($_G['cookie']['ignore_notice'])) { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>html5notification.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script type="text/javascript">
        var h5n = new Html5notification();
        if(h5n.issupport()) {
            <?php if($_G['member']['newpm'] && $_GET['do'] != 'pm') { ?>
            h5n.shownotification('pm', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=pm', '<?php echo avatar($_G[uid],small,true);?>', '新的短消息', '有新的短消息，快去看看吧');
            <?php } ?>
            <?php if($_G['member']['newprompt'] && $_GET['do'] != 'notice') { ?>
            <?php if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { ?>            <?php $noticetitle = lang('template', 'notice_'.$key);?>            h5n.shownotification('notice_<?php echo $key;?>', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=notice&view=<?php echo $key;?>', '<?php echo avatar($_G[uid],small,true);?>', '<?php echo $noticetitle;?> (<?php echo $val;?>)', '有新的提醒，快去看看吧');
            <?php } ?>
            <?php } ?>
        }
    </script>
    <?php } ?>
    <?php userappprompt();?>    <?php if($_G['basescript'] != 'userapp') { ?>

    <!--div id="share">
    <div style="display: block;" class="go-top go-feedback transition">
            <div class="js-show-feedback-box">
                用户反馈
            </div>
        </div>
    <div style="display: block;" class="go-top go-feedback app-feedback js-app-feedback transition">
            <div class="app-footer-guide">
                <img src="/template/quater_6_motion/src/wx115.png" width="108">
                <span style="color: #333;line-height:2;">微信扫一扫</span>
            </div>
            <div class="">
                <i class="icon icon-big-phone"></i>
                公众号
            </div>
        </div>
    <div style="display: block; bottom: 151px;" class="go-top js-go-top transition" id="go-top-btn"><i class="icon icon-top"></i></div>
    </div>
    <script type="text/javascript">
    jQuery.noConflict();
    jQuery(function(){
            //首先将#back-to-top隐藏
            jQuery("#share").hide();
            //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
            jQuery(function () {
                jQuery(window).scroll(function(){
                    if (jQuery(window).scrollTop()>100){
                        jQuery("#share").fadeIn();
                    }
                    else
                    {
                        jQuery("#share").fadeOut();
                    }
                });
                //当点击跳转链接后，回到页面顶部位置
                jQuery("#go-top-btn").click(function(){
                    jQuery('body,html').animate({scrollTop:0},500);
                    return false;
                });
            });
        }); 
    </script -->

    <?php } ?>
    <?php if(isset($_G['makehtml'])) { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>html2dynamic.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script type="text/javascript">
        var html_lostmodify = <?php echo TIMESTAMP;?>;
        htmlGetUserStatus();
        <?php if(isset($_G['htmlcheckupdate'])) { ?>
        htmlCheckUpdate();
        <?php } ?>
    </script>
    <?php } ?>
</div>
<!--</div>--><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output();}?></body></html>