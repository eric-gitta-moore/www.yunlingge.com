<?php
//Discuz! cache file, DO NOT modify me!
//Created: by ymg6.com {ymg6_time}
//Identify:  {ymg6_md5}

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>
<style>.comiis_fastpost_btn {display:none;}</style>
<div class="comiis_password_top">
<div class="comiis_password_ico"><i class="comiis_font f_0">&#xe67c</i><i class="comiis_font icoa f_f">&#xe61d</i></div>
<p class="f_c"><?php echo $comiis_lang['forum_password_require'];?></p>
</div>
<div class="comiis_password_form cl">
<form method="post" autocomplete="off" action="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;action=pwverify">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="comiis_password_input bg_f b_ok"><input type="password" name="pw" class="comiis_px" placeholder="<?php echo $comiis_lang['reg13'];?>" /></div>
<button type="submit" name="loginsubmit" value="true" class="comiis_btn bg_c f_f"><?php echo $comiis_lang['submit'];?></button>
</form>
</div>