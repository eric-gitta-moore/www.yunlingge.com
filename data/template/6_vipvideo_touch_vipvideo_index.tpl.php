<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('vipvideo_index');?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="<?php echo $csspath;?>touch/common.css?<?php echo VERHASH;?>" />
<div class="container">
<div class="video_body">
<iframe src="" id="video_player" width="100%" height="100%" allowTransparency="true" allowfullscreen="true" frameborder="0" scrolling="no"></iframe>	
</div>
<div class="video_form mtw">
<form id="viewvideoform" name="viewvideoform" action='plugin.php?id=vipvideo&ac=view&mobile=2&loc=1' method="post" autocomplete="off">
<input type="hidden" name="handlekey" value="viewvideo" />
<div class="v_engine">
<select name="vid" id="video_engine"><?php if(is_array($interfaces)) foreach($interfaces as $key => $value) { ?><option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
<?php } ?>
</select>
</div>
<div class="v_url">
<input name="url" type="text" placeholder="输入需要播放的视频地址，点击“立即播放”即可" id="video_url">
</div>
<div class="v_button">
<?php if($setconfig['allow_user_group'] && !in_array('7', $setconfig['allow_user_group']) && !$_G['uid']) { ?>
<button class="pn pnc" type="button" onclick="popup.open('您还未登录，立即登录?', 'confirm', 'member.php?mod=logging&action=login');"><strong>立即播放</strong></button>
<?php } else { ?>
<button class="formdialog pn pnc" type="submit"><strong>立即播放</strong></button>
<?php } ?>
</div>
</form>
</div>
<div class="video_guide bmw mtw">
<div class="bm_h">操作指南<?php if($credit_tip) { ?><span>( <?php echo $credit_tip;?> )</span><?php } ?></div>	
<div class="bm_c"><?php echo $setconfig['operate_text'];?></div>	
</div>
</div>
<script type="text/javascript">
function succeedhandle_viewvideo(url, msg, values) {
popup.close();
       $("#video_player").attr("src", values['url']);
}
</script><?php include template('common/footer'); ?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>