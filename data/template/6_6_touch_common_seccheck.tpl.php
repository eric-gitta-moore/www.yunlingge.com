<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');	
$ran = random(5, 1);?><?php if($secqaacheck) { $message = '';
$question = make_secqaa();
$secqaa = lang('core', 'secqaa_tips').$question;?><?php } if($sectpl) { if($secqaacheck) { ?>
<div class="comiis_sec_txt b_b f_c cl">
验证问答:
        <?php echo $secqaa;?>
<input name="secqaahash" type="hidden" value="<?php echo $sechash;?>" />
        &nbsp;<input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="comiis_px b_ok" />
        </div>
<?php } if($seccodecheck) { ?>
<div class="comiis_sec_code b_t cl">
<input name="seccodehash" type="hidden" value="<?php echo $sechash;?>" class="sechash" />
<img src="misc.php?mod=seccode&amp;update=<?php echo $ran;?>&amp;idhash=<?php echo $sechash;?>&amp;mobile=2" class="sec_code_img" />
<input type="text" class="comiis_px vm" style="ime-mode:disabled;" autocomplete="off" value="" id="seccodeverify_<?php echo $sechash;?>" name="seccodeverify" placeholder="验证码" fwin="seccode">        
</div>
<?php } } ?>
<script type="text/javascript">
(function() {
$('.sec_code_img').on('click', function() {
$('#seccodeverify_<?php echo $sechash;?>').attr('value', '');
var tmprandom = 'S' + Math.floor(Math.random() * 1000);
$('.sechash').attr('value', tmprandom);
$(this).attr('src', 'misc.php?mod=seccode&update=<?php echo $ran;?>&idhash='+ tmprandom +'&mobile=2');
});
})();
</script>
<?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>