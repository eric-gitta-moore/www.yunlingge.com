<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF


<link rel="stylesheet" type="text/css" href="/source/plugin/iplus_gezi/images/style{$styleid}.css" />

<div class="wp cl">
<div class="GzList" style="margin-bottom: 10px;">
    
EOF;
 if($links) { 
$return .= <<<EOF

    <ul class="hover">
EOF;
 if(is_array($links)) foreach($links as $link) { if(empty($link['url'])) { 
$return .= <<<EOF

<li><a href="plugin.php?id=iplus_gezi:buy" onclick="showWindow('
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
iplus_gezi
EOF;
 } else { 
$return .= <<<EOF
login
EOF;
 } 
$return .= <<<EOF
', this.href);return false;" style="color:{$wzcolor};">{$link['title']}</a></li>

EOF;
 } else { 
$return .= <<<EOF

<li><a rel="nofollow" href="{$link['url']}" target="_blank" {$link['style']}>

EOF;
 if(stripos($link['title'],'http') !== false) { 
$return .= <<<EOF

<img src="{$link['title']}" />

EOF;
 } else { 
$return .= <<<EOF

{$link['title']}

EOF;
 } 
$return .= <<<EOF

</a></li>

EOF;
 } } 
$return .= <<<EOF

    </ul>
    
EOF;
 } 
$return .= <<<EOF

</div>
</div>


EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>