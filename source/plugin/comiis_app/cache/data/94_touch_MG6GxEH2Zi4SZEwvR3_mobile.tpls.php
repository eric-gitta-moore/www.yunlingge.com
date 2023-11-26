<?php
//Discuz! cache file, DO NOT modify me!
//Created: by ymg6.com {ymg6_time}
//Identify:  {ymg6_md5}

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>
<?php if($_G['forum_thread']['price'] > 0) { ?>
<div class="comiis_xstop bg_h cl">	
<div class="f_a cl">
<i class="comiis_font">&#xe641</i><?php echo $comiis_lang['tip195'];?><em><?php echo $rewardprice;?></em> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> 
</div>
<?php if(!$_G['forum_thread']['is_archived']) { ?>
<div class="comiis_xsbtn cl">
<button class="xs_btn bg_a f_f comiis_openrebox"><?php echo $comiis_lang['tip196'];?></button>
<span class="f_c"><?php echo $comiis_lang['view28'];?><?php echo $rewardprice;?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?></span>
</div>
<?php } ?>
</div>
<?php } elseif($_G['forum_thread']['price'] < 0) { ?>
<div class="comiis_xsover f_g"><?php echo $comiis_lang['view29'];?> ( <?php echo $rewardprice;?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> )</div>
<?php } ?>