<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$return = <<<EOF


EOF;
 if($_G['basescript'] != 'userapp') { 
$return .= <<<EOF

<link rel="stylesheet" type="text/css" href="/source/plugin/jz52_top/template/jz_topbox_header.css" />

EOF;
 if($this->jz52_dfk == 1) { 
$return .= <<<EOF

<link rel="stylesheet" type="text/css" href="/source/plugin/jz52_top/template/jz52_dfk_1.css" />

EOF;
 } else { 
$return .= <<<EOF

<link rel="stylesheet" type="text/css" href="/source/plugin/jz52_top/template/jz52_dfk_0.css" />

EOF;
 } 
$return .= <<<EOF

<style type="text/css"> 
ul#navmenu ul
{ 

EOF;
 if($this->jz52_gjtwz == 1) { if($this->jz52_dfk == 1) { 
$return .= <<<EOF
left: 50px;
EOF;
 } else { 
$return .= <<<EOF
left: 40px;
EOF;
 } } else { 
$return .= <<<EOF
left: -233px;
EOF;
 } 
$return .= <<<EOF

} 

EOF;
 if($this->jz52_temp != 5 && $this->jz52_temp != 7) { 
$return .= <<<EOF

#jz52top a {margin: 6px 0;}

EOF;
 } if($this->jz52_thew == 1) { if($this->jz52_gjtwz == 1) { 
$return .= <<<EOF

#jz52top { z-index: {$this->jz52_zindex}; visibility: visible; left: {$this->jz52_right}px; }

EOF;
 } else { 
$return .= <<<EOF

#jz52top { z-index: {$this->jz52_zindex}; visibility: visible; right: {$this->jz52_right}px; }

EOF;
 } } else { if($this->jz52_gjtwz == 1) { 
$return .= <<<EOF

#jz52top { z-index: {$this->jz52_zindex}; visibility: visible; left: 50%; margin-left: -{$jz52w}px; }

EOF;
 } else { 
$return .= <<<EOF

#jz52top { z-index: {$this->jz52_zindex}; visibility: visible; right: 50%; margin-right: -{$jz52w}px; }

EOF;
 } } 
$return .= <<<EOF

#jz52top{bottom: {$this->jz52_bootcc}px;}

EOF;
 if($this->jz52_dfk == 1) { if($this->jz52_temp == 1) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #f8f8f8 url('/source/plugin/jz52_top/template/djz52top1.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 2) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #00a398 url('/source/plugin/jz52_top/template/djz52top.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 3) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #7f7f7f url('/source/plugin/jz52_top/template/djz52top2.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 4) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #7f7f7f url('/source/plugin/jz52_top/template/djz52top3.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 5) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/djz52top4.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 6) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/djz52top5.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 7) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/djz52top6.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 8) { 
$return .= <<<EOF

#jz52top a { display: block; width: 50px; height: 50px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/djz52top7.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } } else { if($this->jz52_temp == 1) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #f8f8f8 url('/source/plugin/jz52_top/template/jz52top1.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 2) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #00a398 url('/source/plugin/jz52_top/template/jz52top.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 3) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #7f7f7f url('/source/plugin/jz52_top/template/jz52top2.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 4) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #7f7f7f url('/source/plugin/jz52_top/template/jz52top3.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 5) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/jz52top4.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 6) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/jz52top5.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 7) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/jz52top6.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } elseif($this->jz52_temp == 8) { 
$return .= <<<EOF

#jz52top a { display: block; width: 40px; height: 40px; padding: 0; line-height: 12px; text-align: center; color: #787878; text-decoration: none; background: #fff url('/source/plugin/jz52_top/template/jz52top7.png') no-repeat 0 0; border-top: 0px #cdcdcd solid; }

EOF;
 } } 
$return .= <<<EOF

</style> 

<script type="text/javascript">function goTopEx(){var obj=document.getElementById("goTopBtn");function getScrollTop(){return document.documentElement.scrollTop||document.body.scrollTop}function setScrollTop(value){if(document.documentElement.scrollTop){document.documentElement.scrollTop=value}else{document.body.scrollTop=value}}window.onscroll=function(){getScrollTop()>0?obj.style.display="":obj.style.display="none";var h=document.body.scrollHeight-getScrollTop()-obj.offsetTop-obj.offsetHeight;obj.style.bottom=0+"px";if(h<350){obj.style.bottom=340+"px";obj.style.top="auto"}};obj.onclick=function(){var goTop=setInterval(scrollMove,10);function scrollMove(){setScrollTop(getScrollTop()/1.1);if(getScrollTop()<1){clearInterval(goTop)}}}};</script> 

<div id="jz52top" >
    
EOF;
 if($this->jz52_topwz != 1) { 
$return .= <<<EOF

<span>
<DIV style="DISPLAY: none" id="goTopBtn" ><a title="返回顶部" class="jz52topa" ><b>返回顶部</b></a></DIV>
</span>
    <SCRIPT type="text/javascript">goTopEx();</SCRIPT>

EOF;
 } if($this->jz52_fbztkg == 1) { 
$return .= <<<EOF

    
EOF;
 if($_G['fid'] && $_G['mod'] == 'viewthread' || $_G['mod'] == 'forumdisplay' ) { if(!$_GET['archiveid']) { 
$return .= <<<EOF

<span>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid={$_G['fid']}" class="jzfbzt" title="发布资源"><b>发布资源</b></a>
</span>

EOF;
 } } else { 
$return .= <<<EOF

<span><a class="jzfbzt" href="forum.php?mod=misc&amp;action=nav" title="发布资源" onclick="showWindow('nav', this.href, 'get', 0)" ><b>发布资源</b></a></span>	

EOF;
 } } if($_G['fid'] && $_G['mod'] == 'viewthread') { if($this->jz52_ln == 1) { 
$return .= <<<EOF

<span><a class="jzlast" href="forum.php?mod=redirect&amp;goto=nextoldset&amp;tid={$_G['tid']}" title="上个主题" ><b>上个主题</b></a></span>	
<span><a class="jznext" href="forum.php?mod=redirect&amp;goto=nextnewset&amp;tid={$_G['tid']}" title="下个主题" ><b>下个主题</b></a></span>

EOF;
 } if($this->jz52_kshf == 1) { 
$return .= <<<EOF

<span><a href="forum.php?mod=post&amp;action=reply&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;extra={$_GET['extra']}&amp;page={$page}
EOF;
 if($_GET['from']) { 
$return .= <<<EOF
&amp;from={$_GET['from']}
EOF;
 } 
$return .= <<<EOF
" onclick="showWindow('reply', this.href)" class="replyfast" title="快速回复"><b>快速回复</b></a></span>	

EOF;
 } if($this->jz52_sctz == 1) { 
$return .= <<<EOF

<span><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id={$_G['tid']}&amp;formhash={$__FORMHASH}" data-no-instant id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' 人已收藏'" title="!fav_thread!" class="jzsct" ><b>收藏帖子</b></a></span>

EOF;
 } } 
$return .= <<<EOF
	

EOF;
 if($_G['fid']) { if($_G['mod'] == 'viewthread') { if($this->jz52_fhlb == 1) { 
$return .= <<<EOF

<span>		
<a href="forum.php?mod=forumdisplay&amp;fid={$_G['fid']}" hidefocus="true" class="returnlist" title="返回列表"><b>返回列表</b></a>
</span>

EOF;
 } } else { 
$return .= <<<EOF
	
    
EOF;
 if($this->jz52_xyy == 1) { 
$return .= <<<EOF

<span id="jz_next_t" >
          <a id="jz_next_N" href="#" title="下一页"  class="jzxyy"><b>下一页</b></a>
    </span>	
        <script type="text/javascript">function jz_c(n){var d=document.getElementsByTagName("a");for(i=0;i<d.length;i++){if(d[i].className==n){return d[i];}}return false;}var nxt=jz_c("nxt");if(nxt){
$("jz_next_N").href=nxt.href;}else{
$("jz_next_t").style.display="none";}</script>

EOF;
 } if($this->jz52_fhzy == 1) { 
$return .= <<<EOF

<span>	
<a  href="index.php" hidefocus="true" class="returnboard" title="返回首页"><b>返回首页</b></a>
</span>
    
EOF;
 } 
$return .= <<<EOF

    
EOF;
 if($this->jz52_scbk == 1 && CURMODULE!='group') { 
$return .= <<<EOF

<span><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id={$_G['fid']}&amp;handlekey=favoriteforum&amp;formhash={$__FORMHASH}" id="a_favorite" title="收藏板块"  class="jzscb" onclick="showWindow(this.id, this.href, 'get', 0);"><b>收藏板块</b></a></span>
    
EOF;
 } } } if($this->jz52_kfzx == 1) { 
$return .= <<<EOF

<link rel="stylesheet" rev="stylesheet" href="/source/plugin/jz52_top/template/imc_access_pop.css" type="text/css" media="screen"/>
<span><a href="javascript:;" onclick="showWindow('jz52_kf','plugin.php?id=jz52_top:jz52_kfzx')" title="客服中心" class="jzkfzx" target="_blank" ><b>客服中心</b></a></span>

EOF;
 } if($this->jz52_kf == 1) { 
$return .= <<<EOF

    <span><a href="{$this->jz52_kfurl}" title="联系我们" class="jzkf" target="_blank" ><b>联系我们</b></a></span>
    
EOF;
 } if($this->jz52_sokg == 1) { 
$return .= <<<EOF

<span><a rel="nofollow" title="搜索" class="jzsoso" href="javascript:;" onclick="showWindow('jzso','plugin.php?id=jz52_top:jz52_so')"><b>搜索</b></a></span>	

EOF;
 } if($this->jz52_qqqan == 1) { 
$return .= <<<EOF

    <span><a rel="nofollow" title="官方QQ群" class="jzqqq" href="javascript:;" onclick="showWindow('qqgroup','plugin.php?id=jz52_top:qqgroup')"><b>官方QQ群</b></a></span>	
    
EOF;
 } 
$return .= <<<EOF

    
EOF;
 if($this->jz52_zdy == 1) { 
$return .= <<<EOF

    <span>
{$this->jz52_zdybt}
</span>	

EOF;
 } if($this->jz52_fenxiang == 1) { 
$return .= <<<EOF

<span><ul id="navmenu"> <li><a title="分享"  class="jzfx" ><b>分享</b></a> <ul> <div class="jzfxn" id="jzfxn">
{$this->jz52_fenxidm}
</div> </ul></li></ul> </span>
    
EOF;
 } if($this->jz52_gzwx == 1) { 
$return .= <<<EOF

<span><ul id="navmenu"><li><a title="关注微信"  class="jzwx" href="javascript:void(0)"><b>关注微信</b></a> <ul> <div id="jzqrn">
{$this->jz52_gzwxdm}
</div> </ul></li></ul></span>	

EOF;
 } if($this->jz52_qr == 1) { 
$return .= <<<EOF

<span><ul id="navmenu"> <li><a title="QR Code"  class="jzqr" href="forum.php?mobile=yes"><b>QR Code</b></a> <ul> <div id="jzqrn">

EOF;
 if($_G['fid'] && $_G['mod'] == 'viewthread' && $this->jz52_tzqr == 1 ) { if($this->jz52_qrsc == 1) { 
$return .= <<<EOF

<style type="text/css">
#jzqrn .ltqr { margin: 24px 0 10px 0; }
</style>
<img  class="ltqr" src="http://qr.liantu.com/api.php?w=183&amp;m=0&amp;text={$jz52_url}" />
<img style="{$this->jz52_qrcss}" src="{$this->jz52_tzqrlo}" />

EOF;
 } elseif($this->jz52_qrsc == 2) { 
$return .= <<<EOF

<style type="text/css">
#jzqrn .googqr { margin: 16px 0 10px 0; }
</style>
<img class="googqr" src="http://chart.apis.google.com/chart?chs=200x200&amp;cht=qr&amp;chld=H|0&amp;chl={$jz52_url}" />
<img style="{$this->jz52_qrcss}" src="{$this->jz52_tzqrlo}" />

EOF;
 } elseif($this->jz52_qrsc == 3) { 
$return .= <<<EOF

<style type="text/css">
#jzqrn .ydqr { margin: 24px 0 10px 0; }
</style>
<img class="ydqr" src="http://qr.udee.cn/index.php?m=Qrcode&amp;a=aip&amp;t={$jz52_url}&amp;f=%23000000&amp;b=%23FFFFFF&amp;pt=%23000000&amp;inpt=%23000000&amp;st=1&amp;level=H&amp;wh=183" />
<img style="{$this->jz52_qrcss}" src="{$this->jz52_tzqrlo}" />

EOF;
 } 
$return .= <<<EOF

<p>{$this->jz52_tzqrsm}</p>

EOF;
 } else { 
$return .= <<<EOF

{$this->jz52_qrimg}

EOF;
 } 
$return .= <<<EOF

</div></ul></li></ul> </span>	

EOF;
 } if($this->jz52_grzx == 1) { 
$return .= <<<EOF

<span>
<ul id="navmenu"> 
<li><a title="个人中心" class="jzwo" >

EOF;
 if($this->jz52_grzfktxkg == 1) { if($_G['member']['newprompt']) { 
$return .= <<<EOF

<div id="jzmms" >
<span class="navbar-unread">
{$_G['member']['newprompt']}
</span>
</div>

EOF;
 } else { if(empty($_G['member']['newpm'])) { } else { 
$return .= <<<EOF

<div id="jzmms" >
<span class="navbar-unreadn">
<b>n</b>
</span>
</div>

EOF;
 } } } 
$return .= <<<EOF

<b>个人中心</b></a> 
<ul> <div id="jzwon">
<link rel="stylesheet" type="text/css" href="/source/plugin/jz52_top/template/jz_topbox_footer.css" />
<style type="text/css">
.navbar-unread {

EOF;
 if($this->jz52_temp == 8) { 
$return .= <<<EOF
background-color: #00A597;
EOF;
 } else { 
$return .= <<<EOF
background-color: #E74C3C;
EOF;
 } 
$return .= <<<EOF
}
.navbar-unreadn {background: url("
EOF;
 if($this->jz52_temp == 8) { 
$return .= <<<EOF
/source/plugin/jz52_top/template/mmsn1.png
EOF;
 } else { 
$return .= <<<EOF
/source/plugin/jz52_top/template/mmsn.png
EOF;
 } 
$return .= <<<EOF
") no-repeat scroll 0px 0px ;
}	
#jzgrzxkp .jzgrzxkptop {
background:  
EOF;
 if($this->jz52_grzxbjthe == 1) { } elseif($this->jz52_grzxbjthe == 2) { 
$return .= <<<EOF
url("/source/plugin/jz52_top/template/1.jpg") no-repeat 0 0
EOF;
 } elseif($this->jz52_grzxbjthe == 3) { 
$return .= <<<EOF
url("/source/plugin/jz52_top/template/2.jpg") no-repeat 0 0
EOF;
 } elseif($this->jz52_grzxbjthe == 4) { 
$return .= <<<EOF
url("/source/plugin/jz52_top/template/3.jpg") no-repeat 0 0
EOF;
 } elseif($this->jz52_grzxbjthe == 5) { 
$return .= <<<EOF
url("/source/plugin/jz52_top/template/4.jpg") no-repeat 0 0
EOF;
 } 
$return .= <<<EOF
 {$this->jz52_grzxbjs} ;
}
#jzgrzxkp .jzgrzxkpbox a { 
EOF;
 if($this->jz52_grzxxtb == 1) { 
$return .= <<<EOF
background:url("/source/plugin/jz52_top/template/gr.png") no-repeat 0 0  ; 
EOF;
 } elseif($this->jz52_grzxxtb == 2) { 
$return .= <<<EOF
background:url("/source/plugin/jz52_top/template/gr1.png") no-repeat 0 0  ; 
EOF;
 } elseif($this->jz52_grzxxtb == 3) { 
$return .= <<<EOF
background:url("/source/plugin/jz52_top/template/gr2.png") no-repeat 0 0  ; 
EOF;
 } 
$return .= <<<EOF
 width:57px;height:60px;float:left; margin: 0px;}
</style>
<div id="jzgrzxkp" class="jzgrzxkp">

EOF;
 if($this->jz52_grzxbjsckg == 1) { 
$return .= <<<EOF

<div id="jz52-grzx-skin">
<a href="#" target="_blank" id="jz52-grzx-skin" title="zdybj"></a>
</div>

EOF;
 } 
$return .= <<<EOF

<div class="jzgrzxkptop">
<div class="jzgrzxkpthtle">
<h3>个人中心</h3>
</div>  
<div class="jzgrzxkpimg">
<div class="jzgrzxkpimgn">
EOF;
 global $_G;
$uid = sprintf("%09d", $_G['uid']);
$dir1 = substr($uid, 0, 3);
$dir2 = substr($uid, 3, 2);
$dir3 = substr($uid, 5, 2);
$file = '/'.$this->jz52_uc.'/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).'_avatar_big.jpg';
$flag = false;
if(is_file($file))$flag=true;
$return .= <<<EOF
<!--onerror="this.onerror=null;this.src='/uc_server/images/noavatar_small.gif'"-->


EOF;
 if($flag) { 
$return .= <<<EOF

<img src="{$file}" width="54" height="54">

EOF;
 } else { 
$return .= <<<EOF

<img src="/uc_server/images/noavatar_small.gif" width="54" height="54">

EOF;
 } 
$return .= <<<EOF


</div>
</div>

EOF;
 if($_G['uid']) { 
$return .= <<<EOF
    
<div class="jzyhm"><a href="home.php?mod=space&amp;uid={$_G['uid']}" target="_blank" title="访问我的空间" >{$_G['member']['username']}</a></div>

EOF;
 } else { 
$return .= <<<EOF
   
<div class="jzyhm"><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href)">登录或注册</a></div>

EOF;
 } 
$return .= <<<EOF
 
</div>
<div class="jzgrzxkpbox">

EOF;
 if($sc == 1) { 
$return .= <<<EOF

<a href="home.php?mod=space&amp;do=favorite&amp;view=me" class="box01" target="_blank"  title="收藏" ></a>

EOF;
 } if($tz == 2) { 
$return .= <<<EOF

<a href="forum.php?mod=guide&amp;view=my" class="box02" target="_blank"  title="帖子" ></a>

EOF;
 } if($hy == 3) { 
$return .= <<<EOF

<a href="home.php?mod=space&amp;do=friend" class="box03" class="box04" target="_blank"  title="好友" ></a>

EOF;
 } if($tx == 8) { 
$return .= <<<EOF

<a href="home.php?mod=space&amp;do=notice" class="box09" target="_blank"  title="提醒" >

EOF;
 if($this->jz52_grzxtxkg == 1) { if($_G['member']['newprompt']) { 
$return .= <<<EOF

<div id="jzmms" >
<span class="navbar-unread">
{$_G['member']['newprompt']}
</span>
</div>

EOF;
 } } 
$return .= <<<EOF

</a>

EOF;
 } if($xx == 4) { 
$return .= <<<EOF

<a href="home.php?mod=space&amp;do=pm" class="box04" target="_blank"  title="消息" >

EOF;
 if($this->jz52_grzxxxxkg == 1) { if(empty($_G['member']['newpm'])) { } else { 
$return .= <<<EOF

<div id="jzmms" >
<span class="navbar-unreadn">
<b>n</b>
</span>
</div>

EOF;
 } } 
$return .= <<<EOF

</a>

EOF;
 } if($sz == 5) { 
$return .= <<<EOF

<a href="home.php?mod=spacecp" class="box05" target="_blank" title="设置" ></a>

EOF;
 } if($xz == 6) { 
$return .= <<<EOF

<a href="home.php?mod=medal" class="box06" target="_blank" title="勋章" ></a>

EOF;
 } if($rw == 7) { 
$return .= <<<EOF

<a href="home.php?mod=task" class="box07" target="_blank" title="任务" ></a>

EOF;
 } if($tc == 9) { if($_G['uid']) { 
$return .= <<<EOF

<a href="member.php?mod=logging&amp;action=logout&amp;formhash={$__FORMHASH}" data-no-instant class="box08" title="退出" ></a>

EOF;
 } } 
$return .= <<<EOF

</div>
</div>
</div>
</ul>
</li>
</ul>
</span>	

EOF;
 } if($this->jz52_topwz == 1) { 
$return .= <<<EOF

<span>
<DIV style="DISPLAY: none" id="goTopBtn" ><a title="返回顶部" class="jz52topa" ><b>返回顶部</b></a></DIV>
</span>
    <SCRIPT type="text/javascript">goTopEx();</SCRIPT>

EOF;
 } 
$return .= <<<EOF

</div>

EOF;
 } 
$return .= <<<EOF


EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>