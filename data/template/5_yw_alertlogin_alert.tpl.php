<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<!--<script src="/source/plugin/yw_alertlogin/js/top.js" type="text/javascript"></script>-->
<link rel="stylesheet" href="/source/plugin/yw_alertlogin/css/style.css" />
<style>
.login_alert{animation:{$alertShowType} {$alertShowTime}s;-webkit-animation:{$alertShowType} {$alertShowTime}s;-moz-animation:{$alertShowType} {$alertShowTime}s;}
.login_alert_box{background-color:rgba(0,0,0,{$opacity});height:{$alertHeight}px;}
.login_alert_box:hover{background-color:rgba(0,0,0,{$hoverOpacity});}
.login_alert_box div{color:{$alertTextColor};font-size:{$alertTextSize}px;line-height:{$alertHeight}px;}
.login_alert_box div a{font-size:{$buttonTextSize}px;line-height:{$alertTextSize}px;border-radius:{$buttonRaduis}px;}

</style>


<div class="login_alert" id="login_alert">

EOF;
 if($isShowOff == 1) { 
$return .= <<<EOF

<div class="login_alert_close" onclick="closeAlert()"><img src="/source/plugin/yw_alertlogin/img/icon_close.png"/></div>

EOF;
 } 
$return .= <<<EOF

<div class="login_alert_box">
<div>{$alertText}
<a style="color:{$loginTextColor};background-color:{$loginColor};" href="member.php?mod=logging&amp;action=login" rel="nofollow" onclick="showWindow('login', this.href)">{$loginText}</a>
<span>{$orText}</span>
<a style="color:{$registerTextColor};background-color:{$registerColor};" href="member.php?mod={$_G['setting']['regname']}" rel="nofollow">{$registerText}</a> 
</div>
</div>
</div>

<script>
function closeAlert(){
document.getElementById("login_alert").style.display="none";
}
</script>

<style>
@keyframes show_alert_bottom{
from{bottom:-{$alertHeight}px;}
to{bottom:0px;}
}
@-webkit-keyframes show_alert_bottom{
from{bottom:-{$alertHeight}px;}
to{bottom:0px;}
}
@-moz-keyframes show_alert_bottom{
from{bottom:-{$alertHeight}px;}
to{bottom:0px;}
}
</style>

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>