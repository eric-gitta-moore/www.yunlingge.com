<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$html = <<<EOF

<style>
#comiis_up_video_keys {background:url("./source/plugin/comiis_app_video/static/video.png") no-repeat 5px 2px;overflow:hidden;}
.b2r #comiis_up_video_keys {background-position:bottom left;}
</style>
<a id="comiis_up_video_keys" title="{$comiis_app_video_lang['001']}" href="javascript:;" onclick='showWindow("comiis_up_video_box", "plugin.php?id=comiis_app_video:comiis_uploadvideo", "get", 0);'>{$comiis_app_video_lang['016']}</a>

EOF;
?>
<?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>