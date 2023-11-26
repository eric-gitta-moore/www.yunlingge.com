<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$list = <<<EOF


EOF;
 if($threads) { 
$list .= <<<EOF

<div class="forumdev" id="forumdev_{$fid}">
  <ul>
EOF;
 if(is_array($threads)) foreach($threads as $thread) { $thread['subject']=dhtmlspecialchars($thread['subject']);
$list .= <<<EOF

EOF;
 $thread['highlight']=$this->devGetHighlight($thread['highlight']);
$list .= <<<EOF

EOF;
 if($this->style==6) { 
$list .= <<<EOF

<li><span>{$thread['replies']}</span><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}" {$thread['highlight']} title="{$thread['subject']}" target="_blank">{$thread['subject']}</a></li>

EOF;
 } elseif($this->style==5) { 
$list .= <<<EOF

<li><span>{$thread['views']}</span><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}" {$thread['highlight']} title="{$thread['subject']}" target="_blank">{$thread['subject']}</a></li>

EOF;
 } elseif($this->style==4) { $thread['lastposter']=dhtmlspecialchars($thread['lastposter']);
$list .= <<<EOF
<li>
EOF;
 if($thread['lastposter']) { 
$list .= <<<EOF
<span><a href="home.php?mod=space&amp;username={$thread['lastposter']}" target="_blank">{$thread['lastposter']}</a></span>
EOF;
 } 
$list .= <<<EOF
<a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}" {$thread['highlight']} title="{$thread['subject']}" target="_blank">{$thread['subject']}</a></li>

EOF;
 } elseif($this->style==3) { $thread['author']=dhtmlspecialchars($thread['author']);
$list .= <<<EOF
<li><span><a href="home.php?mod=space&amp;uid={$thread['authorid']}" target="_blank">{$thread['author']}</a></span><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}" title="{$thread['subject']}" target="_blank">{$thread['subject']}</a></li>

EOF;
 } elseif($this->style==2) { $thread['lastpost']=$thread['lastpost']? dgmdate($thread['lastpost'],'m-d/H:i'):dgmdate($thread['dateline'],'m-d/H:i');
$list .= <<<EOF
<li><span>{$thread['lastpost']}</span><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}" {$thread['highlight']} title="{$thread['subject']}" target="_blank">{$thread['subject']}</a></li>

EOF;
 } else { $thread['dateline']=dgmdate($thread['dateline'],'m-d/H:i');
$list .= <<<EOF
<li><span>{$thread['dateline']}</span><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}" {$thread['highlight']} title="{$thread['subject']}" target="_blank">{$thread['subject']}</a></li>

EOF;
 } } 
$list .= <<<EOF
     
  </ul>
</div>

EOF;
 } 
$list .= <<<EOF


EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>