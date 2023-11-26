<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<script type="text/javascript">
document.body.oncopy = function(){ 
setTimeout( function(){ 
var text = clipboardData.getData("text");
if (text){ 
text = text + '{$study_origin}'; 
clipboardData.setData("text", text);
} 
}, 100)
}
</script>

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>