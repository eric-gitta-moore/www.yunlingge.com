<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$return = <<<EOF

<style>
.xhkj5com_dashang{ margin:10px auto; display:block; cursor:pointer;width: 134px;height: 49px; {$bpo} background-image: url('/source/plugin/xhkj5com_dashang/template/img/dsbtn.png');background-repeat: no-repeat;}
.xhkj5com_dashang:hover{ {$bpoh} }
</style>
<a class="xhkj5com_dashang" id="xhkj5com_dashang" onclick="showWindow(this.id, 'plugin.php?id=xhkj5com_dashang:xhkj5com_dashang&zzid={$zzid}&formhash={$__FORMHASH}');" href="javascript:"></a>

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>