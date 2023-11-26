<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forum');
0
|| checktplrefresh('./template/comiis_app/touch/search/forum.htm', './template/comiis_app/touch/search/pubsearch.htm', 1584844431, '6', './data/template/6_6_touch_search_forum.tpl.php', './template/comiis_app', 'touch/search/forum')
|| checktplrefresh('./template/comiis_app/touch/search/forum.htm', './template/comiis_app/touch/search/thread_list.htm', 1584844431, '6', './data/template/6_6_touch_search_forum.tpl.php', './template/comiis_app', 'touch/search/forum')
;?>
<?php if(empty($threadlist)) { $comiis_bg = 1;?><?php } include template('common/header'); if(!$_GET['inajax']) { ?>
<form id="searchform" class="searchform" method="post" autocomplete="off" action="search.php?mod=forum">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php $keywordenc = $keyword ? rawurlencode($keyword) : '';?><?php comiis_load('MfFSCuuXF29JZAx2FF', 'srchtype,searchid,threadlist,articlelist,bloglist,albumlist,slist,keyword,comiis_group_lang');?><?php comiis_load('RPmEMW3m6Xi0E8pP3I', 'threadlist,searchid,show_color,searchparams,srchotquery,srchhotkeywords');?><script>
function comiis_search(){
window.location.href = 'search.php?mod='+$('#comiis_ssbox_style').children('option:selected').val()+'<?php if($keyword) { ?>&srchtxt=<?php echo $keywordenc;?>&searchsubmit=yes<?php } ?>';
}
</script><?php $policymsgs = $p = '';?><?php if(is_array($_G['setting']['creditspolicy']['search'])) foreach($_G['setting']['creditspolicy']['search'] as $id => $policy) { ?><?php
$policymsg = <<<EOF

EOF;
 if($_G['setting']['extcredits'][$id]['img']) { 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['img']} 
EOF;
 } 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['title']} {$policy} {$_G['setting']['extcredits'][$id]['unit']}
EOF;
?><?php $policymsgs .= $p.$policymsg;$p = ', ';?><?php } if($policymsgs) { ?><div class="ss_kftip f_c">每进行一次搜索将扣除 <?php echo $policymsgs;?></div><?php } ?>
</form>
<?php } if(!empty($searchid) && submitcheck('searchsubmit', 1)) { if(!empty($threadlist) && !$_GET['inajax']) { ?>
<div class="comiis_p12 f14 f_c cl" style="padding-bottom:0px;"><?php if($keyword) { ?>结果: <em>找到 “<span class="emfont"><?php echo $keyword;?></span>” 相关内容 <?php echo $index['num'];?> 个</em> <?php if($modfid) { ?><a href="forum.php?mod=modcp&amp;action=thread&amp;fid=<?php echo $modfid;?>&amp;keywords=<?php echo $modkeyword;?>&amp;submit=true&amp;do=search&amp;page=<?php echo $page;?>" target="_blank">进入管理面板</a><?php } } else { ?>结果: <em>找到相关主题 <?php echo $index['num'];?> 个</em><?php } ?></div>
<?php if($_G['uid']) { ?>
<script>var formhash = '<?php echo FORMHASH;?>', allowrecommend = '<?php echo $_G['group']['allowrecommend'];?>';</script>
<script src="template/comiis_app/comiis/js/comiis_forumdisplay.js?<?php echo VERHASH;?>" type="text/javascript"></script>	<?php } } } if(empty($threadlist) && !$_GET['inajax']) { if(!empty($threadlist) || !empty($searchid)) { ?>
<div class="comiis_forumlist cl">	
<ul>
<li class="comiis_notip mt15 cl">
<i class="comiis_font f_e cl">&#xe613;</i>
<span class="f_d">对不起，没有找到匹配结果。</span>
</li>
</ul>
</div>
<?php } } else { $comiis_list_template = 'default_s_style'; include_once DISCUZ_ROOT.'./template/comiis_app/comiis/php/comiis_list.php';?><?php if(!$_GET['inajax']) { if($comiis_app_list_num != 10) { ?><div id="list_new"></div><?php } $comiis_page = ceil($index['num']/$_G['tpp']);?><div class="comiis_multi_box bg_f b_t" style="margin-top:10px;">
<?php if($multipage && ($comiis_app_switch['comiis_listpage'] == 0 || $page > 1)) { ?>
<?php echo $multipage;?>
<?php } elseif($comiis_app_switch['comiis_listpage'] == 1 && $page < $comiis_page) { ?>
<a href="javascript:;" onclick="comiis_list_page()" class="comiis_loadbtn bg_e f_d"><?php echo $comiis_lang['tip5'];?></a>
<?php } elseif($comiis_app_switch['comiis_listpage'] == 2 && $page < $comiis_page) { ?>
<div class="comiis_loadbtn f_d"><?php echo $comiis_lang['tip6'];?></div>
<?php } elseif($comiis_app_switch['comiis_listpage'] && $comiis_page == 1 && $index['num'] > 4) { ?>
<div class="comiis_loadbtn f_d"><?php echo $comiis_lang['tip31'];?></div>
<?php } ?>
</div>
<script>
<?php if($_G['uid']) { ?>comiis_recommend_addkey();<?php } if($comiis_app_switch['comiis_listpage'] > 0 && $page == 1) { ?>
var comiis_page = <?php echo $page;?>;
var comiis_ispage = 0;
function comiis_list_page(){
comiis_ispage = 1;
if(comiis_page < <?php echo $comiis_page;?>){
$('.comiis_multi_box').html('<div class="comiis_loadbtn f_d"><?php echo $comiis_lang['tip6'];?></div>');
$.ajax({
type:'GET',
url: 'search.php?mod=forum&searchid=<?php echo $searchid;?>&orderby=<?php echo $orderby;?>&ascdesc=<?php echo $ascdesc;?>&searchsubmit=yes&page=' + (comiis_page + 1) + '&inajax=1',
dataType:'xml',
}).success(function(s) {
if(typeof(s.lastChild.firstChild.nodeValue) != "undefined"){
comiis_page++;
$('#list_new').append(s.lastChild.firstChild.nodeValue);
<?php if($comiis_app_list_num == 10) { ?>
var comiis_pic_width = ($(window).width() - 34) / 2;
$(".comiis_waterfall li[class='bg_f b_ok']").css('width', (comiis_pic_width) + 'px');
imagesLoaded($('.comiis_waterfall'),function(){
$('#list_new').masonry('reload');
});
<?php } ?>			
if(comiis_page >= <?php echo $comiis_page;?>){
$('.comiis_multi_box').html('<div class="comiis_loadbtn f_d"><?php echo $comiis_lang['tip31'];?></div>');
}else{
$('.comiis_multi_box').html('<a href="javascript:;" onclick="comiis_list_page()" class="comiis_loadbtn bg_e f_d"><?php echo $comiis_lang['tip5'];?></a>');
}
comiis_redata_function();
}else{
comiis_page--;
$('.comiis_multi_box').html('<a href="javascript:;" onclick="comiis_list_page()" class="comiis_loadbtn bg_e f_d"><?php echo $comiis_lang['tip32'];?></a>');
}
comiis_ispage = 0;
}).error(function() {
comiis_page--;
$('.comiis_multi_box').html('<a href="javascript:;" onclick="comiis_list_page()" class="comiis_loadbtn bg_e f_d"><?php echo $comiis_lang['tip32'];?></a>');
comiis_ispage = 0;
});
}
}
var comiis_regdata_page = 'comiis_page', comiis_regdata_dataid = ['#list_new'];
function comiis_redata_function(){
popup.init();
<?php if($_G['uid']) { ?>comiis_recommend_addkey();<?php } ?>
}


<?php if($comiis_app_switch['comiis_listpage'] == 2) { ?>
var comiis_page_timer;
$(window).scroll(function(){
if(comiis_page_start == 0){
return;
}
clearTimeout(comiis_page_timer);
comiis_page_timer = setTimeout(function() {
var comiis_scroll_bottom = $(window).scrollTop() + $(window).height();
var comiis_list_bottom = $('#list_new').height() + $('#list_new').offset().top - 200;
if(comiis_scroll_bottom >= comiis_list_bottom && comiis_ispage == 0){
comiis_list_page();
}	
}, 200);
});
<?php } } ?>
</script>
<?php } } $comiis_foot = 'no';?><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>