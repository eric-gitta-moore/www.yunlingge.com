<?PHP exit('Access Denied');?>
<!--{eval include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_space_profile.php'}-->
<!--{if $_GET['mycenter'] && !$_G['uid']}-->
	<!--{eval dheader('Location:member.php?mod=logging&action=login');exit;}-->
<!--{/if}-->
<!--{template common/header}-->
<!--{if !$_GET['mycenter']}-->
<!--{template home/space_header}-->
	<div class="comiis_space_profile bg_f b_t b_b mt10 cl">
		<ul>
			<!--{if $_G['setting']['verify']['enabled']}-->
			<li class="b_t">
				<div class="profile_r comiis_verify">
                    <!--{eval $showverify = true;$show_verify = 0;}-->                    
                    <!--{loop $_G['setting']['verify'] $vid $verify}-->
                        <!--{if $verify['available']}-->
                            <!--{if $showverify}-->
                            <!--{eval $showverify = false;}-->
                            <!--{/if}-->
                            <!--{if $space['verify'.$vid] == 1}-->
                                <!--{eval $show_verify = 1;}-->  
                                <a href="home.php?mod=spacecp&ac=profile&op=verify&vid=$vid"><!--{if $verify['icon']}--><img src="$verify['icon']" class="vm" alt="$verify[title]" title="$verify[title]" /><!--{else}-->$verify[title]<!--{/if}--></a>
                            <!--{elseif !empty($verify['unverifyicon'])}-->
                                <!--{eval $show_verify = 1;}--> 
                                <a href="home.php?mod=spacecp&ac=profile&op=verify&vid=$vid"><!--{if $verify['unverifyicon']}--><img src="$verify['unverifyicon']" class="vm" alt="$verify[title]" title="$verify[title]" /><!--{/if}--></a>
                            <!--{/if}-->
                        <!--{/if}-->
                    <!--{/loop}-->
                    <!--{if $show_verify == 0}--><!--{if $space[uid] == $_G['uid']}--><i class="y comiis_font f_d">&#xe60c;</i><a href="home.php?mod=spacecp&ac=profile&op=verify" class="f_wb" style="margin-top:0;">{$comiis_lang['tip301']}</a><!--{else}--><span class="f_c">{$comiis_lang['tip300']}</span><!--{/if}--><!--{/if}-->
				</div>
				<span>{$comiis_lang['tip289']}</span>	
			</li>
			<!--{/if}-->
			<li class="b_t">
				<div class="profile_r profile_face f_c"><!--{if $space[group][maxsigsize] && $space[sightml]}-->$space[sightml]<!--{else}-->{$comiis_lang['tip15']}<!--{/if}--></div>
				<span>{lang personal_signature}</span>	
			</li>
			<li class="b_t">
				<a href="javascript:;" class="profile_a profile_ewmbox">
					<div class="profile_rs"><i class="comiis_font f_d">&#xe60c;</i><i class="comiis_font profile_ewm f_d">&#xe663;</i></div>
					<span>{$comiis_lang['all60']}</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="comiis_user_code" style="display:none;">
		<div class="comiis_user_code_box">
			<div class="comiis_user_code_top">
				<img src="<!--{avatar($space[uid], middle, true)}-->" />
				<h2>$space[username]</h2> 
				<p class="f_d">{$comiis_lang['tip11']}</p>
			</div>
			<div id="comiis_user_code"></div>
		</div>
	</div>
	<script src="template/comiis_app/comiis/js/jquery.qrcode.min.js?{VERHASH}"></script>
	<script>
		jQuery('.profile_ewmbox').on('click', function(e) {
			$('.comiis_user_code').css('display', 'block').on('click', function(e) {
				$(this).css('display', 'none');
			});
			if(jQuery('#comiis_user_code canvas').length == 0){
				jQuery('#comiis_user_code').qrcode({width: 240, height: 240, text: "{$_G[siteurl]}home.php?mod=space&uid={$space[uid]}&do=profile"});
			}
		});
	</script>
	<div class="comiis_space_profileico bg_f b_t b_b mt10 cl">
		<ul>
		<!--{if $_G['setting']['allowviewuserthread'] !== false}-->
		<!--{eval $space['posts'] = $space['posts'] - $space['threads'];}-->
			<li><a href="home.php?mod=space&uid=$space[uid]&do=thread&view=me&type=thread&from=space"><i class="comiis_font" style="color:#a8c500;">&#xe64f;</i><span>{lang thread} $space[threads]</span></a></li>
			<li><a href="home.php?mod=space&uid=$space[uid]&do=thread&view=me&type=reply&from=space"><i class="comiis_font" style="color:#FFB900;">&#xe667;</i><span>{lang reply} $space[posts]</span></a></li>
		<!--{/if}-->
			<li><a href="javascript:;"><i class="comiis_font" style="color:#53bcf5;">&#xe66b;</i><span>{lang friends} $space[friends]</span></a></li>
		<!--{if helper_access::check_module('follow')}-->
			<li><a href="home.php?mod=follow&do=follower&uid=$space[uid]"><i class="comiis_font" style="color:#FD7673;">&#xe650;</i><span>{$comiis_lang['all73']} $space[follower]</span></a></li>
		<!--{/if}-->
		<!--{if helper_access::check_module('blog')}-->
			<li><a href="home.php?mod=space&uid=$space[uid]&do=blog&view=me&from=space"><i class="comiis_font" style="color:#53bcf5;">&#xe64d;</i><span>{lang blog} $space[blogs]</span></a></li>
		<!--{/if}-->
		<!--{if helper_access::check_module('album')}-->
			<li><a href="home.php?mod=space&uid=$space[uid]&do=album&view=me&from=space"><i class="comiis_font" style="color:#a8c500;">&#xe653;</i><span>{lang album} $space[albums]</span></a></li>
		<!--{/if}-->
		<!--{if helper_access::check_module('doing')}-->
			<li><a href="home.php?mod=space&uid=$space[uid]&do=doing&view=me&from=space"><i class="comiis_font" style="color:#FD7673;">&#xe691;</i><span>{$comiis_lang['all56']} $space[doings]</span></a></li>
		<!--{/if}-->
            <li><a href="javascript:;"><i class="comiis_font" style="color:#FFB900;">&#xe65a;</i><span>{$comiis_lang['all74']} $space[views]</span></a></li>
		</ul>
	</div>
	<div class="comiis_space_profilejf bg_f b_t b_b mt10 cl">
		<ul>
			<li class="b_t b_r"><span class="f_0">$space[credits]</span>{lang credits}</li>
			<!--{loop $_G[setting][extcredits] $key $value}-->
			<!--{if $value[title]}-->
			<li class="b_t b_r"><span class="f_0">{$space["extcredits$key"]} $value[unit]</span>$value[title]</span></li>
			<!--{/if}-->
			<!--{/loop}-->
		</ul>
	</div>
	<div class="comiis_space_profile bg_f b_t b_b mt10 cl">
		<ul>
			<li class="b_t"><div class="profile_rs f_c">{$space[uid]}</div><span>{lang share_space}ID</span></li>
			<!--{if in_array($_G[adminid], array(1, 2))}-->
			<li class="b_t"><div class="profile_rs f_c">$space[email]</div><span>Email</span></li>
			<!--{/if}-->
			<!--{loop $profiles $value}-->
			<li class="b_t"><div class="profile_rs f_c">$value[value]</div><span>$value[title]</span></li>
			<!--{/loop}--> 
			<li class="b_t"><div class="profile_rs f_c">$space[oltime] {lang hours}</div><span>{lang online_time}</span></li>
			<li class="b_t"><div class="profile_rs f_c">$space[regdate]</div><span>{lang regdate}</span></li>
			<li class="b_t"><div class="profile_rs f_c">$space[lastvisit]</div><span>{lang last_visit}</span></li>
		</ul>
	</div>
	<!--{if $space[uid] == $_G[uid]}-->
	<div class="cl" style="height:40px;"></div>
	<div class="comiis_space_foot bg_f b_t">
		<ul class="comiis_flex">
			<li class="flex foot_cp"><a href="home.php?mod=spacecp"><i class="comiis_font f_wb">&#xe655;</i><span class="f_b">{lang update_profile}</span></a></li>
			<!--{if $_G['comiis_homestyleid']}--><li class="flex foot_cp"><a href="plugin.php?id=comiis_app_homestyle"><i class="comiis_font f_wb">&#xe612;</i><span class="f_b">{lang dress_space}</span></a></li><!--{/if}-->
		</ul>
	</div>
	<!--{else}-->
	<!--{template home/space_footer}-->
	<!--{/if}-->
<!--{else}-->
    <!--{if $comiis_app_switch['comiis_mystyle'] == 1}-->
        <div class="styli_h bg_e b_t cl"></div>
        <div class="comiis_myinfo bg_f b_t cl">	
            <div class="comiis_styli myinfo_box b_t cl">
                <div class="myinfo_ewm f_d"><i class="comiis_font">&#xe663;</i></div>
                <div class="myinfo_img bg_e f_c"><a href="javascript:;" class="comiis_edit_avatar"><span class="f_f">{lang modify}</span><img src="<!--{avatar($_G[uid], middle, true)}-->" /></a></div>
                <div class="myinfo_data">
                    <a href="home.php?mod=space&uid={$_G[uid]}&do=profile" class="myinfo_user">$_G[username]</a>
                    <a href="home.php?mod=spacecp&ac=profile&op=info" class="myinfo_txt f_c">
                        <!--{if $_G['member_'.$_G[uid].'_field_forum']['sightml']}-->
                            $_G['member_'.$_G[uid].'_field_forum']['sightml']
                        <!--{else}--> 
                           <i class="comiis_font">&#xe62d;</i> {$comiis_lang['all40']}
                        <!--{/if}-->
                    </a>
                </div>
            </div>	
            <div class="styli_h bg_e b_t cl"></div>
            <a href="plugin.php?id=comiis_app_color" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#F37D7D">&#xe612;</i></div><div class="flex">{lang diy_style}{$comiis_lang['post37']}</div><div class="styli_ico"><span class="f_ok">{$comiis_lang['post37']}</span><i class="comiis_font f_d">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&uid={$_G[uid]}&do=thread&view=me&from=space" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#10AEFF">&#xe662;</i></div><div class="flex">{lang my_space}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&do=friend&view=visitor" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#FFB300">&#xe682;</i></div><div class="flex">{lang recent_visit}</div>
                <div class="my_space_img f_d">
                    <!--{loop $comiis_visitor $temp}-->
                        <!--{echo avatar($temp['vuid'],'small');}-->
                    <!--{/loop}-->
                </div>
                <div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{if $_G['setting']['regstatus'] > 1}-->
                <a href="home.php?mod=spacecp&ac=invite" class="comiis_flex comiis_styli b_t cl">
                    <div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA06">&#xe60f;</i></div><div class="flex">{lang invite_friend}</div><div class="styli_ico f_d"><!--{if !($_G['setting']['creditspolicy']['promotion_visit'] || $_G['setting']['creditspolicy']['promotion_register'])}--><span class="f13 f_a">{$comiis_lang['tip293']}</span><!--{/if}--><i class="comiis_font">&#xe60c;</i></div>
                </a>
            <!--{/if}-->
            <!--{if $_G['setting']['creditspolicy']['promotion_visit'] || $_G['setting']['creditspolicy']['promotion_register']}-->
            <a href="home.php?mod=spacecp&ac=promotion" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#DA99DB">&#xe632;</i></div><div class="flex">{lang memcp_promotion}</div><div class="styli_ico f_d"><span class="f13 f_a">{$comiis_lang['tip303']}</span><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <!--{hook/global_comiis_home_space_profile_mobile}-->		
            <div class="styli_h bg_e b_t cl"></div>
            <a href="home.php?mod=spacecp" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#3EBBFD">&#xe66e;</i></div><div class="flex">{lang myprofile}</div><div class="styli_ico"><span class="f_ok">{lang modify}</span><i class="comiis_font f_d">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&uid={$_G[uid]}&do=favorite&view=me&type=all" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#F37D7D">&#xe617;</i></div><div class="flex">{lang myfavorite}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&uid={$_G[uid]}&do=thread&view=me" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA06">&#xe679;</i></div><div class="flex">{lang my_posts}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{if $_G['setting'][groupstatus]}-->
            <a href="group.php?mod=my&view=join" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#DA99DB">&#xe66a;</i></div><div class="flex">{$comiis_lang['all58']}{$comiis_group_lang['001']}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <!--{if $_G['setting'][blogstatus]}-->
            <a href="home.php?mod=space&do=blog&view=me" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#91B9EB">&#xe681;</i></div><div class="flex">{lang my_blog}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <!--{if $_G['setting'][albumstatus]}-->
            <a href="home.php?mod=space&do=album&view=me" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#FFB300">&#xe627;</i></div><div class="flex">{lang my_album}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <!--{if $_G['setting'][doingstatus]}-->
            <a href="home.php?mod=space&do=doing&view=me" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#F37D7D">&#xe638;</i></div><div class="flex">{$comiis_lang['all58']}{$comiis_lang['all56']}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <a href="home.php?mod=space&do=friend" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA06">&#xe629;</i></div><div class="flex">{lang my_friends}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>		
            <!--{if $_G['setting']['taskon']}-->
            <a href="home.php?mod=task" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#91B9EB">&#xe983;</i></div><div class="flex">{lang my}{lang task}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <div class="styli_h bg_e b_t b_b cl"></div>
            <div  name="pm" id="pm">
            <a href="home.php?mod=space&do=pm" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#DA99DB">&#xe665;</i></div><div class="flex"><span class="z">{lang mypm}</span><!--{if $_G[member][newpm]}--><span class="myinfo_tip bg_del f_f">{$_G[member][newpm]}</span><!--{/if}--></div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&do=notice" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#FFB300">&#xe62f;</i></div><div class="flex"><span class="z">{lang my}{lang remind}</span><!--{if $_G[member][newprompt]}--><span class="myinfo_tip bg_del f_f">{$_G[member][newprompt]}</span><!--{/if}--></div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            </div>
            <a href="home.php?mod=spacecp&ac=credit" class="comiis_flex comiis_styli b_t b_b cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA08">&#xe641;</i></div><div class="flex">{lang my_credits}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
        </div>
        <div class="comiis_btnbox cl"><a href="member.php?mod=logging&action=logout&referer=forum.php&formhash={FORMHASH}&handlekey=logout" class="dialog comiis_btn bg_del f_f" />{lang logout_mobile}</a></div>
        <div class="comiis_user_code" style="display:none;">
            <div class="comiis_user_code_box">
                <div class="comiis_user_code_top">
                    <img src="<!--{avatar($_G[uid], middle, true)}-->" />
                    <h2>$_G[username]</h2> 
                    <p class="f_d">{$comiis_lang['tip11']}</p>
                </div>
                <div id="comiis_user_code"></div>
            </div>
        </div>
        <script src="template/comiis_app/comiis/js/jquery.qrcode.min.js?{VERHASH}"></script>
        <script>
            jQuery('.myinfo_ewm').on('click', function(e) {
                $('.comiis_user_code').css('display', 'block').on('click', function(e) {
                    $(this).css('display', 'none');
                });
                if(jQuery('#comiis_user_code canvas').length == 0){
                    jQuery('#comiis_user_code').qrcode({width: 240, height: 240, text: "{$_G[siteurl]}home.php?mod=space&uid={$_G[uid]}&do=profile"});
                }
            });
        </script>
    <!--{else}-->
        <div class="styli_h10 bg_e cl"></div>
        <div class="comiis_myinfo bg_f b_t b_b cl">	
            <div class="comiis_styli myinfo_boxv1 b_t cl">
                <a href="home.php?mod=space&uid={$_G[uid]}&do=profile" class="myinfo_ewm f_d"><i class="comiis_font" style="font-size:14px;">&#xe60c;</i></a>
                <div class="myinfo_imgv1 bg_e f_c"><a href="javascript:;" class="comiis_edit_avatar"><span class="f_f">{lang modify}</span><img src="<!--{avatar($_G[uid], middle, true)}-->" /></a></div>
                <div class="myinfo_data">
                    <div class="myinfo_titv1">
                        <a href="home.php?mod=space&uid={$_G[uid]}&do=profile" class="myinfo_user">$_G[username]</a>
                        {if $space['gender'] == 1}<i class="comiis_font kmlev kmgender bg_boy f_f">&#xe63f</i>{elseif $space['gender'] == 2}<i class="comiis_font kmlev kmgender bg_girl f_f">&#xe637</i>{/if}
                    </div>
                    <div class="myinfo_txtv1 f_c">
                        <a href="home.php?mod=spacecp&ac=usergroup"><span class="bg_0 f_f"{if $_G['cache']['usergroups'][$_G[member]['groupid']]['color']} style="background:$_G['cache']['usergroups'][$_G[member]['groupid']]['color'] !important"{/if}>{if $comiis_app_switch['comiis_lev_txt']}{$comiis_app_switch['comiis_lev_txt']}{else}Lv.{/if}{$_G['cache']['usergroups'][$space['groupid']]['stars']}</span><span class="f_c" style="margin-right:0;">{echo strip_tags($_G['cache']['usergroups'][$space['groupid']]['grouptitle']);}</span></a><a href="home.php?mod=spacecp&ac=credit"><span class="f_c">{lang credits}: $_G[member][credits]</span></a>
                    </div>
                </div>
            </div>           
            <div class="styli_h10 bg_e b_t cl"></div>
            <div class="comiis_myinfo_ico bg_f b_t cl">            
                <ul>
                    <li><a href="home.php?mod=space&uid={$_G[uid]}&do=thread&view=me&from=space"><i class="comiis_font" style="color:#9DCA06">&#xe664;</i><span>{lang my_space}</span></a></li>
                    <li><a href="home.php?mod=space&uid={$_G[uid]}&do=thread&view=me"><i class="comiis_font" style="color:#FFB300">&#xe64f;</i><span>{lang my_posts}</span></a></li>
                    <li><a href="home.php?mod=space&uid={$_G[uid]}&do=favorite&view=me&type=all"><i class="comiis_font" style="color:#53bcf5">&#xe64c;</i><span>{lang myfavorite}</span></a></li>
                    <li><a href="home.php?mod=space&do=friend"><i class="comiis_font" style="color:#F37D7D">&#xe698;</i><span>{lang my_friends}</span></a></li>
                    <!--{if $_G['setting'][blogstatus]}-->
                    <li><a href="home.php?mod=space&do=blog&view=me"><i class="comiis_font" style="color:#53bcf5">&#xe64d;</i><span>{lang my_blog}</span></a></li>
                    <!--{/if}-->
                    <!--{if $_G['setting'][albumstatus]}-->
                    <li><a href="home.php?mod=space&do=album&view=me"><i class="comiis_font" style="color:#a8c500">&#xe653;</i><span>{lang my_album}</span></a></li>
                    <!--{/if}-->
                    <!--{if $_G['setting'][groupstatus]}-->
                    <li><a href="group.php?mod=my&view=join"><i class="comiis_font" style="color:#F37D7D">&#xe66b;</i><span>{$comiis_lang['all58']}{$comiis_group_lang['001']}</span></a></li>
                    <!--{/if}-->
                    <!--{if $_G['setting'][doingstatus]}-->
                    <li><a href="home.php?mod=space&do=doing&view=me"><i class="comiis_font" style="color:#FFB300">&#xe691;</i><span>{$comiis_lang['all58']}{$comiis_lang['all56']}</span></a></li>
                    <!--{/if}--> 
                </ul>
            </div>
            <div class="styli_h10 bg_e b_t cl"></div>
            <a href="plugin.php?id=comiis_app_color" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#F37D7D">&#xe612;</i></div><div class="flex">{lang diy_style}{$comiis_lang['post37']}</div><div class="styli_ico"><span class="f_ok">{$comiis_lang['post37']}</span><i class="comiis_font f_d">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&do=friend&view=visitor" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#91B9EB">&#xe682;</i></div><div class="flex">{lang recent_visit}</div>
                <div class="my_space_img f_d">
                    <!--{loop $comiis_visitor $temp}-->
                        <!--{echo avatar($temp['vuid'],'small');}-->
                    <!--{/loop}-->
                </div>
                <div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{if $_G['setting']['creditspolicy']['promotion_visit'] || $_G['setting']['creditspolicy']['promotion_register']}-->
            <a href="home.php?mod=spacecp&ac=promotion" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#FFB300">&#xe632;</i></div><div class="flex">{lang memcp_promotion}</div><div class="styli_ico f_d"><span class="f13 f_a">{$comiis_lang['tip303']}</span><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
            <!--{if $_G['setting']['regstatus'] > 1}-->
                <a href="home.php?mod=spacecp&ac=invite" class="comiis_flex comiis_styli b_t cl">
                    <div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA08">&#xe60f;</i></div><div class="flex">{lang invite_friend}</div><div class="styli_ico f_d"><!--{if !($_G['setting']['creditspolicy']['promotion_visit'] || $_G['setting']['creditspolicy']['promotion_register'])}--><span class="f13 f_a">{$comiis_lang['tip293']}</span><!--{/if}--><i class="comiis_font">&#xe60c;</i></div>
                </a>
            <!--{/if}-->
            <!--{hook/global_comiis_home_space_profile_mobile}-->            
            <div class="styli_h10 bg_e b_t cl"></div>
            <a href="home.php?mod=spacecp" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#3EBBFD">&#xe66e;</i></div><div class="flex">{lang myprofile}</div><div class="styli_ico"><!--{if $space[profileprogress] <100}--><span class="f13 f_d">{$comiis_lang['tip269']}$space[profileprogress]%</span><!--{else}--><span class="f_ok">{lang modify}</span><!--{/if}--><i class="comiis_font f_d">&#xe60c;</i></div>
            </a>
            <div name="pm" id="pm" class="b_t">            
            <a href="home.php?mod=space&do=pm" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#DA99DB">&#xe665;</i></div><div class="flex"><span class="z">{lang mypm}</span><!--{if $_G[member][newpm]}--><span class="myinfo_tip bg_del f_f">{$_G[member][newpm]}</span><!--{/if}--></div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <a href="home.php?mod=space&do=notice" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#FFB300">&#xe62f;</i></div><div class="flex"><span class="z">{lang my}{lang remind}</span><!--{if $_G[member][newprompt]}--><span class="myinfo_tip bg_del f_f">{$_G[member][newprompt]}</span><!--{/if}--></div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            </div>            
            <a href="home.php?mod=spacecp&ac=credit" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#9DCA08">&#xe641;</i></div><div class="flex">{lang my_credits}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{if $_G['setting']['taskon']}-->
            <a href="home.php?mod=task" class="comiis_flex comiis_styli b_t cl">
                <div class="styli_tit f_c"><i class="comiis_font" style="color:#F37D7D">&#xe983;</i></div><div class="flex">{lang my}{lang task}</div><div class="styli_ico f_d"><i class="comiis_font">&#xe60c;</i></div>
            </a>
            <!--{/if}-->
        </div>
        <div class="comiis_btnbox cl"><a href="member.php?mod=logging&action=logout&referer=forum.php&formhash={FORMHASH}&handlekey=logout" class="dialog comiis_btn bg_del f_f" />{lang logout_mobile}</a></div>
    <!--{/if}-->
<!--{/if}-->
<!--{if !$_GET['mycenter']}--><!--{eval $comiis_foot = 'no';}--><!--{/if}-->
<!--{template common/footer}-->