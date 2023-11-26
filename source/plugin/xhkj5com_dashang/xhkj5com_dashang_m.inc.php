<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
global $_G;
$xhkj5com_dashang = $_G['cache']['plugin']['xhkj5com_dashang'];

$dspid=intval($_GET['dspid']);
$ainfo=DB::fetch_first("select s.* from ".DB::table('xhkj5com_dashang')." s,".DB::table('forum_post')." h where s.uid=h.authorid and h.pid=".$dspid);
if($ainfo && !$xhkj5com_dashang['zz']){
	if($ainfo['picurl']){$alipay="data/xhkj5com_dashang/".$ainfo['picurl'];}else{$alipay=$xhkj5com_dashang['alipay'];}
	if($ainfo['picurla']){$wechat="data/xhkj5com_dashang/".$ainfo['picurla'];}else{$wechat=$xhkj5com_dashang['wechat'];}
}else{
$alipay=$xhkj5com_dashang['alipay'];
$wechat=$xhkj5com_dashang['wechat'];
}


if($ainfo['text'] && !$xhkj5com_dashang['zz']){$dsy=$ainfo['text'];}else{$dsy=$xhkj5com_dashang['dsy'];}

$setewm='';
if($_G['uid']){
	$setewm='<p class="setewm"><a href="home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds" target="_blank">'.lang('plugin/xhkj5com_dashang', 'dssz').'</a></p>';
}
	$ooo='<div id="boxds">  
        <div class="box1">  

          <div style=" padding:10px; width:270px; height:390px;margin:0px auto;position:relative;" id="ds">
		 
<div class="dsbox">
<div class="tabList">
<p class="setewm" style="margin-bottom:-20px;"><a href="home.php?mod=spacecp&ac=plugin&id=xhkj5com_dashang:keke_myds" target="_blank">'.$dsy.'</a></p>
<div id="cont_one_1" class="one block" > 
<img src="'.$wechat.'" width="150" height="150" /></div> 
<div id="cont_one_2" class="one" style="display:none"> 
<img src="'.$alipay.'" width="150" height="150" /></div> 
</div> 
<p class="oooa">'.$xhkj5com_dashang['mtsa'].'</p>

<div class="tab" style="margin:20px auto 0px auto"> 
<ul> 
<li id="one1" class="on" onmouseover=\'setTab("one",1,2)\' style="background:url(source/plugin/xhkj5com_dashang/template/img/wechat.jpg);background-repeat:no-repeat;background-position:center; "></li> 
<li id="one2" onmouseover=\'setTab("one",2,4)\' style="background:url(source/plugin/xhkj5com_dashang/template/img/alipay.jpg);background-repeat:no-repeat;background-position:center;"></li> 
</ul> 
</div> 



<p class="ooo">'.$xhkj5com_dashang['tsb'].'</p>
'.$setewm.'
<a href="javascript:;" onClick="kenull('.$dspid.');" class="dsclose"><font color="#FFFFFF">'.lang('plugin/xhkj5com_dashang', 'gb').'</font></a>

</div> 
</div>
<style>
#ds .dstt{ color:#FFF;padding-left:10px;line-height:35px; height:35px; background:#e74851;text-align:center}
.ooo{font-size:12px;  text-align:center; line-height:45px; height:45px;width:100%;color:#999; font-family:"Microsoft Yahei"}
.setewm{font-size:12px;color:#999; font-family:"Microsoft Yahei";text-align:right;line-height:25px; margin:10px auto 0px auto;width:100%;text-align: center; color:#FFF; background:#EFEFEF }
.ttitle{text-align:center}
.tab UL LI {border:2px solid #CCC;width: 110px; float: left; height: 30px; margin:0px 10px;border-radius:20px;text-align: center;}
.tabList .block {display: block;} 
.tabList .one{padding:40px 0px 0px 47px; margin:0px; }
.tab UL:after{display: block;height: 0px;visibility: hidden; clear: both; content: ""; } 
.tab UL {zoom: 1;clear: both; } 
.oooa{font-size:12px;  text-align:center; line-height:30px; height:30px;width:100%;color:#333; font-family:"Microsoft Yahei"}
</style>
        </div>  
		
    </div>';
	
echo $ooo;