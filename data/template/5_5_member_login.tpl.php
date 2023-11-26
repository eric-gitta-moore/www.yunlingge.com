<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('login');
0
|| checktplrefresh('./template/quater_6_motion/member/login.htm', './template/quater_6_motion/common/seccheck.htm', 1584691907, '5', './data/template/5_5_member_login.tpl.php', './template/quater_6_motion', 'member/login')
;?><?php include template('common/header'); ?><!--<link rel="stylesheet" type="text/css" href="/template/quater_6_motion/src/member.css" />--><?php $loginhash = 'L'.random(4);?><?php if(empty($_GET['infloat'])) { ?>
<div id="background" class="background">
    <div class="filter"></div>
</div>
<div class="mheight" style="width: 400px; margin: 0 auto;">
<div id="ct" class="wp w cl" style="padding: 100px 0 100px 0;">
<div class="nfl" id="main_succeed" style="display: none">
<div class="f_c altw">
<div class="alert_right">
<p id="succeedmessage"></p>
<p id="succeedlocation" class="alert_btnleft"></p>
<p class="alert_btnleft"><a id="succeedmessage_href">如果您的浏览器没有自动跳转，请点击此链接</a></p>
</div>
</div>
</div>
<div class="mn" id="main_message">
        <div class="ldLoginIntro cl" style="float: left; width: 450px;">
           <div class="login-content cl" style="display: none;">
  <div class="l intro">
    <h1>Join us!</h1>
    <p>搜集国内一手新鲜资讯，<br>
      共同打造大型完整互助休闲社区！<br>
    </p>
    <a href="portal.php">进入首页</a></div>
</div>
        </div>
<div class="login_ie comForm cl" style="float: right; width: auto; border: 0; padding: 20px 40px; box-shadow: 0 5px 15px rgba(0,0,0,.5);">
           <div class="hd cl" style="padding-top: 20px;">
            <span>登录账号</span><?php if(!empty($_G['setting']['pluginhooks']['logging_side_top'])) echo $_G['setting']['pluginhooks']['logging_side_top'];?>
            </div>
<div style="text-align: center;">
<?php } ?>

<div id="main_messaqge_<?php echo $loginhash;?>"<?php if($auth) { ?> style="width: auto"<?php } ?>>
<div id="layer_login_<?php echo $loginhash;?>">
<h3 class="flb">
<em id="returnmessage_<?php echo $loginhash;?>">
<?php if(!empty($_GET['infloat'])) { if(!empty($_GET['guestmessage'])) { ?>您需要先登录才能继续本操作<?php } elseif($auth) { ?>请补充下面的登录信息<?php } else { ?>用户登录<?php } } ?>
</em>
<span><?php if(!empty($_GET['infloat']) && !isset($_GET['frommessage'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_GET['handlekey'];?>', 0, 1);" title="关闭">关闭</a><?php } ?></span>
</h3>
<?php if(!empty($_G['setting']['pluginhooks']['logging_top'])) echo $_G['setting']['pluginhooks']['logging_top'];?>
<form method="post" autocomplete="off" name="login" id="loginform_<?php echo $loginhash;?>" class="cl" onsubmit="<?php if($this->setting['pwdsafety']) { ?>pwmd5('password3_<?php echo $loginhash;?>');<?php } ?>pwdclear = 1;ajaxpost('loginform_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>', 'onerror');return false;" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes<?php if(!empty($_GET['handlekey'])) { ?>&amp;handlekey=<?php echo $_GET['handlekey'];?><?php } if(isset($_GET['frommessage'])) { ?>&amp;frommessage<?php } ?>&amp;loginhash=<?php echo $loginhash;?>">
<div class="pg_login c cl" style="overflow: hidden;">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
<?php if($auth) { ?>
<input type="hidden" name="auth" value="<?php echo $auth;?>" />
<?php } if($invite) { ?>
<div class="rfm">
<table>
<tr>
<th>推荐人</th>
<td><a href="home.php?mod=space&amp;uid=<?php echo $invite['uid'];?>" target="_blank"><?php echo $invite['username'];?></a></td>
</tr>
</table>
</div>
<?php } if(!$auth) { ?>
<div class="rfm">
<table>
<tr>
<td><input type="text" name="username" id="username_<?php echo $loginhash;?>" autocomplete="off" size="30" class="form-control px p_fre" tabindex="1" value="<?php echo $username;?>" placeholder="邮箱或账号" title="邮箱或账号"/></td>
<td class="tipcol" style="display: none;"><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><?php echo $_G['setting']['reglinkname'];?></a></td>
</tr>
</table>
</div>
<div class="rfm">
<table>
<tr>
<td><input type="password" id="password3_<?php echo $loginhash;?>" name="password" onfocus="clearpwd()" size="30" class="form-control px p_fre" tabindex="1" placeholder="密码" title="密码"/></td>
<td class="tipcol" style="display: none;"></td>
</tr>
</table>
</div>

<?php } if(empty($_GET['auth']) || $questionexist) { ?>
<div class="rfm">
<table>
<tr>
<td><select id="loginquestionid_<?php echo $loginhash;?>" width="213" name="questionid"<?php if(!$questionexist) { ?> onchange="if($('loginquestionid_<?php echo $loginhash;?>').value > 0) {$('loginanswer_row_<?php echo $loginhash;?>').style.display='';} else {$('loginanswer_row_<?php echo $loginhash;?>').style.display='none';}"<?php } ?>>
<option value="0"><?php if($questionexist) { ?>安全提问<?php } else { ?>安全提问(未设置请忽略)<?php } ?></option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">您其中一位老师的名字</option>
<option value="5">您个人计算机的型号</option>
<option value="6">您最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select></td>
</tr>
</table>
</div>
<div class="rfm" id="loginanswer_row_<?php echo $loginhash;?>" <?php if(!$questionexist) { ?> style="display:none"<?php } ?>>
<table>
<tr>
<td><input type="text" name="answer" id="loginanswer_<?php echo $loginhash;?>" autocomplete="off" size="30" class="px p_fre" tabindex="1" /></td>
</tr>
</table>
</div>
<?php } if($seccodecheck) { ?><?php
$sectpl = <<<EOF
<div class="rfm"><table><tr><th><sec>: </th><td><sec><br /><sec></td></tr></table></div>
EOF;
?><?php $sechash = !isset($sechash) ? 'S'.($_G['inajax'] ? 'A' : '').$_G['sid'] : $sechash.random(3);
$sectpl = str_replace("'", "\'", $sectpl);?><?php if($secqaacheck) { ?>
<span id="secqaa_q<?php echo $sechash;?>" class="secqaa_1"></span>		
<script type="text/javascript" reload="1">updatesecqaa('q<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
<?php } if($seccodecheck) { ?>
<span id="seccode_c<?php echo $sechash;?>" class="seccode_1"></span>		
<script type="text/javascript" reload="1">updateseccode('c<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
<?php } } ?>

<?php if(!empty($_G['setting']['pluginhooks']['logging_input'])) echo $_G['setting']['pluginhooks']['logging_input'];?>
                
<div class="rfm <?php if(!empty($_GET['infloat'])) { ?> bw0<?php } ?> cl">
<table style="float: left;">
<tr>
<td><label for="cookietime_<?php echo $loginhash;?>"><input type="checkbox" class="pc" name="cookietime" id="cookietime_<?php echo $loginhash;?>" tabindex="1" value="2592000" <?php echo $cookietimecheck;?> />自动登录</label></td>
</tr>
</table>
                    <a href="javascript:;" onclick="display('layer_login_<?php echo $loginhash;?>');display('layer_lostpw_<?php echo $loginhash;?>');" title="找回密码" style="float: right; padding: 9px 0 0 3px; color: #BBBBBB; font-size: 12px;">忘记登录密码</a>
</div>
                
                <div class="rfm bw0 cl">
<div class="login_btn cl" style="float: left; margin: 10px 0;">
<button class="pn pnc" type="submit" name="loginsubmit" value="true" tabindex="1">提交</button>
</div>
<div style="display: none;">
<?php if($this->setting['sitemessage']['login'] && empty($_GET['infloat'])) { ?><a href="javascript:;" id="custominfo_login_<?php echo $loginhash;?>" class="y">&nbsp;<img src="<?php echo IMGDIR;?>/info_small.gif" alt="帮助" class="vm" /></a><?php } if(!$this->setting['bbclosed'] && empty($_GET['infloat'])) { ?><a href="javascript:;" onclick="ajaxget('member.php?mod=clearcookies&formhash=<?php echo FORMHASH;?>', 'returnmessage_<?php echo $loginhash;?>', 'returnmessage_<?php echo $loginhash;?>');return false;" title="清除痕迹" class="y">清除痕迹</a><?php } ?>
</div>
</div>
                
                <div class="rfm" style="padding: 5px 0 0 0; text-align: center;">
                   <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" style="float: none; height: 44px; line-height: 44px; color: #333333; font-size: 16px;">极速注册</a>
                </div>
                
<div class="third-box">
                   <div class="tits"><span>第三方登录</span></div>
                   <a href="connect.php?mod=login&amp;op=init&amp;referer=forum.php&amp;statfrom=login"><i class="icon-modal icon-login-qq"></i></a>
                   <a href="plugin.php?id=wechat:login" class="js-login-switch"><i class="icon-modal icon-login-wx"></i></a>
                   <a href="#" style="display: none;"><i class="icon-modal icon-login-wb"></i></a>
                   <a href="#" style="display: none;"><i class="icon-modal icon-login-zfb"></i></a>
                </div>
                <div class="other_login">
                   <?php if(!empty($_G['setting']['pluginhooks']['logging_method'])) echo $_G['setting']['pluginhooks']['logging_method'];?>
                </div>
</div>
</form>
</div>
<?php if($_G['setting']['pwdsafety']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>md5.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<?php } ?>
<div id="layer_lostpw_<?php echo $loginhash;?>" style="display: none;">
<h3 class="flb">
<em id="returnmessage3_<?php echo $loginhash;?>">找回密码</em>
<span><?php if(!empty($_GET['infloat']) && !isset($_GET['frommessage'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a><?php } ?></span>
</h3>
<form method="post" autocomplete="off" id="lostpwform_<?php echo $loginhash;?>" class="cl" onsubmit="ajaxpost('lostpwform_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', 'onerror');return false;" action="member.php?mod=lostpasswd&amp;lostpwsubmit=yes&amp;infloat=yes">
<div class="c cl">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="lostpwform" />
<div class="rfm">
<table>
<tr title="Email/邮箱">
<th><span class="rq">*</span><label for="lostpw_email">Email:</label></th>
<td><input type="text" name="email" id="lostpw_email" size="30" value=""  tabindex="1" class="px p_fre" placeholder="Email/邮箱"/></td>
</tr>
</table>
</div>
<div class="rfm">
<table>
<tr title="用户名">
<th><label for="lostpw_username">用户名:</label></th>
<td><input type="text" name="username" id="lostpw_username" size="30" value=""  tabindex="1" class="px p_fre" placeholder="用户名"/></td>
</tr>
</table>
</div>

<div class="rfm mbw bw0">
<table>
<tr>
<th></th>
<td><button class="pn pnc" type="submit" name="lostpwsubmit" value="true" tabindex="100"><span>提交</span></button></td>
</tr>
</table>
</div>
</div>
</form>
</div>
</div>

<div id="layer_message_<?php echo $loginhash;?>"<?php if(empty($_GET['infloat'])) { ?> class="f_c blr nfl"<?php } ?> style="display: none;">
<h3 class="flb" id="layer_header_<?php echo $loginhash;?>">
<?php if(!empty($_GET['infloat']) && !isset($_GET['frommessage'])) { ?>
<em>用户登录</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a></span>
<?php } ?>
</h3>
<div class="c"><div class="alert_right">
<div id="messageleft_<?php echo $loginhash;?>"></div>
<p class="alert_btnleft" id="messageright_<?php echo $loginhash;?>"></p>
</div>
</div>


<script type="text/javascript" reload="1">
<?php if(!isset($_GET['viewlostpw'])) { ?>
var pwdclear = 0;
function initinput_login() {
document.body.focus();
<?php if(!$auth) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
$('loginform_<?php echo $loginhash;?>').username.focus();
}
<?php if(!$this->setting['autoidselect']) { ?>
simulateSelect('loginfield_<?php echo $loginhash;?>');
<?php } } elseif($seccodecheck && !(empty($_GET['auth']) || $questionexist)) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
safescript('seccodefocus', function() {$('loginform_<?php echo $loginhash;?>').seccodeverify.focus()}, 500, 10);
}			
<?php } ?>
}
initinput_login();
<?php if($this->setting['sitemessage']['login']) { ?>
showPrompt('custominfo_login_<?php echo $loginhash;?>', 'mouseover', '<?php echo trim($this->setting['sitemessage']['login'][array_rand($this->setting['sitemessage']['login'])]); ?>', <?php echo $this->setting['sitemessage']['time'];?>);
<?php } ?>

function clearpwd() {
if(pwdclear) {
$('password3_<?php echo $loginhash;?>').value = '';
}
pwdclear = 0;
}
<?php } else { ?>
display('layer_login_<?php echo $loginhash;?>');
display('layer_lostpw_<?php echo $loginhash;?>');
$('lostpw_email').focus();
<?php } ?>
</script><?php updatesession();?><?php if(empty($_GET['infloat'])) { ?>
</div></div></div></div>
</div>
</div>
<?php } include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>