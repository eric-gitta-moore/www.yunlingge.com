<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF


<div class="rfm">
<table>
<tr>
<th><span class="rq"></span>{$grouptitle}</th>
<td id="yeehot_reg_qgroup">
 {$qnum}
</td>
</tr>
</table>
</div>


EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>