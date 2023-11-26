<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<div class="exx_mzsm">
<h5>{$title}</h5>
{$txt}
</div>
<style>
.exx_mzsm{font-family:"Microsoft Yahei"; padding:10px 20px 15px 20px;color: {$ysa}; line-height:28px; background:{$bg}; font-size:12px; 
EOF;
 if($exx_mzsm['yj']) { 
$return .= <<<EOF
border-radius:10px;
EOF;
 } 
$return .= <<<EOF
}
.exx_mzsm h5{ font-size:16px;color: {$ys}; line-height:40px;}
</style>

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>