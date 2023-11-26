<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');?><?php include template('common/header'); ?><h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>"><?php echo $banquan;?></span></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form id="ecode_form" name="ecode_form" autocomplete="off">
<div class="c cl">
<input type="hidden" id="ecode_id" name="ecode_id" value="<?php echo $current;?>" />
<textarea id="ecode_message" name="ecode_message" cols="60" rows="6" class="pt" onkeyup="istrLenCalc(this, 'ecode_messagelen', <?php echo $long;?>);"></textarea>
<div class="ecode_bar">
<div class="ecode_pager">
<div class="ecode_nav ecode_prev" onclick="ecode_prev()"></div>
<div class="ecode_nav ecode_next" onclick="ecode_next()"></div>
</div> 
<div class="ecode_wrap">
<ul id="ecode_ul" class="cl" style="width: 2090px; left:0px;"><?php if(is_array($font)) foreach($font as $key => $value) { ?><li><a href="javascript:;" id="ecode_<?php echo $key;?>_1"<?php if($current==$key) { ?> class="a"<?php } ?> onclick="ecode_set(<?php echo $key;?>);" title="<?php echo $value;?>"><img src="source/plugin/ecode/image/<?php echo $key;?>.png" /></a><p><?php echo $value;?></p></li>
<?php } $i=0;?><?php if(is_array($font)) foreach($font as $key => $value) { $i++;?><?php if($i<5) { ?>
<li><a href="javascript:;" id="ecode_<?php echo $key;?>_2"<?php if($current==$key) { ?> class="a"<?php } ?> onclick="ecode_set(<?php echo $key;?>);" title="<?php echo $value;?>"><img src="source/plugin/ecode/image/<?php echo $key;?>.png" /></a><p><?php echo $value;?></p></li>
<?php } } ?>
</ul>
</div>
</div>
</div>
<p class="o pns">
<span id="ecode_messagechk" class="z">您还可以输入 <strong id="ecode_messagelen"><?php echo $long;?></strong> 个字符</span>
<button type="button" onClick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="pn"><strong>取消</strong></button>
<button type="button" onclick="ecode_submit(<?php echo $fast;?>, '<?php echo $codemod;?>')" class="pn pnc"><strong>提交</strong></button>
</p>
</form>
<script type="text/javascript">
function ecode_prev(){
var n = <?php echo $max;?>;
var obj = $('ecode_ul');
var objl = obj.offsetLeft + 110;
if(objl==110){
objl = -(n-1)*110;
}
obj.style.left = objl + 'px';
}
function ecode_next(){
var n = <?php echo $max;?>;
var obj = $('ecode_ul');
var objl = obj.offsetLeft - 110;
if(objl == -n*110){
objl = 0;
}
obj.style.left = objl + 'px';
}
function istrLenCalc(obj, checklen, maxlen) {
var v = obj.value, charlen = 0, maxlen = !maxlen ? 200 : maxlen, curlen = maxlen, len = strlen(v);
for(var i = 0; i < v.length; i++) {
if(v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
curlen -= charset == 'utf-8' ? 2 : 1;
}
}
if(curlen >= len) {
$(checklen).innerHTML = curlen - len;
} else {
obj.value = imb_cutstr(v, maxlen, '');
}
}
function imb_cutstr(str, maxlen, dot) {
var len = 0;
var ret = '';
var dot = '';
maxlen = maxlen - dot.length;
for(var i = 0; i < str.length; i++) {
len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
if(len > maxlen) {
ret += dot;
break;
}
ret += str.substr(i, 1);
}
return ret;
}
function ecode_set(n){
$('ecode_id').value = n;
for(var i=0;i<=<?php echo $max;?>;i++){
if($('ecode_'+i+'_1')){
if(i==n){
$('ecode_'+i+'_1').className = 'a';
}else{
$('ecode_'+i+'_1').className = '';
}			
}
if($('ecode_'+i+'_2')){
if(i==n){
$('ecode_'+i+'_2').className = 'a';
}else{
$('ecode_'+i+'_2').className = '';
}			
}
}
$('ecode_message').focus();
}
function ecode_submit(t,mod){
var n = $('ecode_id').value;
var v = $('ecode_message').value;
if(t){
seditor_insertunit('fastpost', '['+mod+'='+n+']'+v, '[/'+mod+']', 10, 1);
<?php if($autopost) { ?>$('fastpostform').submit();<?php } ?>
}else{
<?php if($autopost) { ?>
var message = html2bbcode(getEditorContents());
$('e_textarea').value = message+'['+mod+'='+n+']'+v+'[/'+mod+']';
$('postform').submit();
<?php } else { ?>
v = TransferString(v);
insertText('['+mod+'='+n+']'+v+'[/'+mod+']',0,10);
<?php } ?>
}
hideWindow('<?php echo $_G['gp_handlekey'];?>');
}
function TransferString(content)
{
var string = content;
try{
string=string.replace(/\r\n/g,"<BR>");
    	string=string.replace(/\n/g,"<BR>");
}catch(e) {
alert(e.message);
}
return string;
}
</script><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>