<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('vipvideo_index');
block_get('111,110');?><?php include template('common/header'); ?><style id="diy_style" type="text/css"></style>
<link rel="stylesheet" type="text/css" href="<?php echo $csspath;?>common.css?<?php echo VERHASH;?>" />
<div class="container mbw">
<div class="mtw">
<!--[diy=vipvideo1]--><div id="vipvideo1" class="area"><div id="frame4V6S6b" class="frame move-span cl frame-1"><div id="frame4V6S6b_left" class="column frame-1-c"><div id="frame4V6S6b_left_temp" class="move-span temp"></div><?php block_display('111');?></div></div></div><!--[/diy]-->
</div>
<div class="video_body mtw" style="display:none;" id="video_player_div">
<iframe src="" id="video_player" width="100%" height="100%" allowTransparency="true" allowfullscreen="true" frameborder="0" scrolling="no"></iframe>	
</div>
<div class="mtw">
<!--[diy=vipvideo2]--><div id="vipvideo2" class="area"></div><!--[/diy]-->
</div>
<div class="video_form mtw">
<form id="viewvideoform" name="viewvideoform" onsubmit="ajaxpost('viewvideoform', 'return_viewvideo', 'return_viewvideo', 'onerror');return false;" action='plugin.php?id=vipvideo&ac=view' method="post" autocomplete="off">
<input type="hidden" name="handlekey" value="viewvideo" />
<div class="v_engine">
<select name="vid" id="video_engine"><?php if(is_array($interfaces)) foreach($interfaces as $key => $value) { if($value['status']) { ?>
<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
<?php } } ?>
</select>
</div>
<div class="v_url">
<input name="url" type="text" placeholder="输入需要播放的视频地址，点击“立即播放”即可" id="video_url">
</div>
<div class="v_button">
<button id="video_btn" class="pn pnc"<?php if($setconfig['allow_user_group'] && !in_array('7', $setconfig['allow_user_group']) && !$_G['uid']) { ?> type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')"<?php } else { ?> type="submit"<?php } ?>>立即播放</button>
</div>
</form>
</div>
<div class="mtw">
<!--[diy=vipvideo3]--><div id="vipvideo3" class="area"></div><!--[/diy]-->
</div>
<div class="video_guide bmw mtw">
<div class="bm_h">操作指南<?php if($credit_tip) { ?><span>( <?php echo $credit_tip;?> )</span><?php } ?></div>	
<div class="bm_c"><?php echo $setconfig['operate_text'];?></div>	
</div>
<div class="mtw">
<!--[diy=vipvideo4]--><div id="vipvideo4" class="area"><div id="frameeI9223" class="frame move-span cl frame-1"><div id="frameeI9223_left" class="column frame-1-c"><div id="frameeI9223_left_temp" class="move-span temp"></div><?php block_display('110');?></div></div></div><!--[/diy]-->
</div>
</div>
<script type="text/javascript">
function succeedhandle_viewvideo(url, msg, values) {
$("video_player").src = values['url'];
jQuery("#video_player_div").css('display','block');
}
</script><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>