<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('buy');?><?php include template('common/header'); ?><script type="text/javascript"> 
    function adstylecheck(){ 
        var ob= document.getElementById("styletip"); 
var style= document.getElementById("adstyle").value;
if(style==1){
ob.innerHTML='每天<?php echo $dcredits;?><?php echo $jfname;?>';
}
if(style==2){
ob.innerHTML='每月<?php echo $mcredits;?><?php echo $jfname;?>';
}
totalcheck();
    }
function totalcheck(){
var ob= document.getElementById("styletip"); 
var adlong=document.getElementById("adlong").value;
var style= document.getElementById("adstyle").value;
if(style==1){
total=<?php echo $dcredits;?>*adlong;
ob.innerHTML='每天<?php echo $dcredits;?><?php echo $jfname;?>';
}
if(style==2){
total=<?php echo $mcredits;?>*adlong;
ob.innerHTML='每月<?php echo $mcredits;?><?php echo $jfname;?>';
}
document.getElementById("howmuch").innerHTML=total;
if(total><?php echo $jf;?>){
document.getElementById("tpsdd").innerHTML='您的积分不足，请重新选择广告投放时长！或<a href="<?php echo $lcredits;?>">点击充值</a>';
document.getElementById("adlong").focus();
}else{
document.getElementById("tpsdd").innerHTML='广告租期结束后系统将会自动删除';
}
}
function adcheck(){
var adlong=document.getElementById("adlong").value;
var style= document.getElementById("adstyle").value;
if(style==1){
total=<?php echo $dcredits;?>*adlong;
}
if(style==2){
total=<?php echo $mcredits;?>*adlong;
}		
if(document.getElementById("title").value==''){
document.getElementById("tpsdd").innerHTML='链接文字不能为空';
document.getElementById("title").focus();
return false;
}
if(document.getElementById("title").value.length><?php echo $wzlen;?>){
document.getElementById("tpsdd").innerHTML='链接文字长度不能大于<?php echo $wzlen;?>个字符';
document.getElementById("title").focus();
return false;
}
if(document.getElementById("links").value=='http://'||document.getElementById("links").value.substring(0,4)!='http'||document.getElementById("links").value.substring(0,14)=='http://http://'){
document.getElementById("tpsdd").innerHTML='您输入的链接有误，请检查！';
document.getElementById("links").focus();
return false;
}		
if(document.getElementById("adlong").value==0){
document.getElementById("tpsdd").innerHTML='请选择广告投放时长！';
document.getElementById("adlong").focus();
return false;
}
if(total><?php echo $jf;?>){
document.getElementById("tpsdd").innerHTML='您的积分不足，请重新选择广告投放时长！或<a href="<?php echo $lcredits;?>">点击充值</a>';
document.getElementById("adlong").focus();
return false;
}else return true;		
}
function switchhl(obj, v) {
if(parseInt($('highlight_style_' + v).value)) {
$('highlight_style_' + v).value = 0;
obj.className = obj.className.replace(' cnt', '');
}else{
$('highlight_style_' + v).value = 1;
obj.className += ' cnt';
}
}
</script>
<div class="GzList">
<div class="Buy">
<h2>
<em id="return_<?php echo $_GET['handlekey'];?>">链接格子自助广告</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h2>
    
    <ol>
<form method="post" autocomplete="off" id="addform" name="addform" action="plugin.php?id=iplus_gezi:buy&amp;applysubmit=true" onsubmit="return adcheck();">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>
        	 <table border="1" class="" width="98%" style="margin:0 auto 5px;table-layout:fixed;">
             
         <tr> 
        <td class="tb2s">账户信息</td>
       	<td style="text-align:left">&nbsp;您的账户累积：<em><?php echo $jf;?></em> <?php echo $jfname;?></td>
        </tr>
        
        <tr> 
        <td width="20%" class="tb2s">文字/图片链接</td>
       	<td style="text-align:left">&nbsp;<input style="width: 97%;" type="text" name="title" size="<?php echo $wzlen;?>" id="title" maxlength="<?php echo $Stitles;?>" /></td>
        </tr>
        <tr> 
        <td width="20%" class="tb2s">链接地址</td>
       	<td style="text-align:left">&nbsp;<input type="text" name="links" id="links" value="http://" style="width: 97%;"/></td>
        </tr>
        <tr> 
        <td width="20%" class="tb2s">显示样式</td>
       	<td style="text-align:left">
<div class="dopt" style="visibility: visible;">
<p class="hasd">
<input type="hidden" value="0" name="info[highlight_style][1]" id="highlight_style_1" fwin="mods">
<input type="hidden" value="0" name="info[highlight_style][2]" id="highlight_style_2" fwin="mods">
<input type="hidden" value="0" name="info[highlight_style][3]" id="highlight_style_3" fwin="mods">
<input type="hidden" name="info[Gzfontcolor]" id="Gzfontcolor">
<input type="button" id="cGzfontcolor_ctrl" onclick="createPalette('Gzfontcolor_ctrl', 'Gzfontcolor');" class="pn colorwd" title="字体颜色">
<a id="highlight_op_1" class="dopt_b" title="文字加粗" style="text-indent:0;text-decoration:none;font-weight:700;" onclick="switchhl(this, 1)" href="javascript:;" fwin="mods">B</a>
<a id="highlight_op_2" class="dopt_i" title="文字斜体" style="text-indent:0;text-decoration:none;font-style:italic;" onclick="switchhl(this, 2)" href="javascript:;" fwin="mods">I</a>
<a id="highlight_op_3" class="dopt_l" title="文字加下划线" style="text-indent:0;text-decoration:underline;" onclick="switchhl(this, 3)" href="javascript:;" fwin="mods">U</a>
</p>
</div>		
</td>
        </tr>		
        <tr>
        <td width="20%" class="tb2s">投放时间</td>
        <td style="text-align:left">&nbsp;
<select class="ps0" name="adlong" id="adlong" onchange="totalcheck()">
<option value="0">请选择时长</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
</select>		
<select class="ps0" id="adstyle" name="adstyle" onchange="adstylecheck()">
<?php if($timetype==1||$timetype==2) { ?>
<option value="1">天</option>
<?php } if($timetype==1||$timetype==3) { ?>
<option value="2">月</option>
<?php } ?>
</select>
<span id="styletip" style="padding-left:2px;color:red;">请选择广告投放方式！</span>
</td>
        </tr>        
        <tr> 
           <td width="20%" class="tb2s">租金结算</td>
           <td style="text-align:left">&nbsp;<span style="color:#F30" id="howmuch"><?php echo $tadayzj;?></span> <?php echo $jfname;?></td>
        </tr>
        </table>		
        <p id="tpsdd"><?php echo $mytips;?></p>
<p class="o pns" id="one_btn" style="text-align:center;margin-top:20px;">
<button type="submit" name="applysubmit" id="applysubmit" class="pn pnc" value="true"><strong style="font-weight:normal;">确认购买</strong></button>
</p>
</form>
    </ol>

</div>
</div><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>