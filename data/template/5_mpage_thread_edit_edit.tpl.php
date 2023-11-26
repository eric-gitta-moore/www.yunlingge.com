<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

EOF;
 if(is_array($postlist)) foreach($postlist as $post) { if($post['first']) { if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && ($post['authorid'] == $_G['uid'] && $_G['forum_thread']['closed'] == 0) && !(!$alloweditpost_status && $edittimelimit && TIMESTAMP - $post['dbdateline'] > $edittimelimit)))) { 
$return .= <<<EOF

<a href="forum.php?mod=post&amp;action=edit&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}&amp;pid={$post['pid']}
EOF;
 if(!empty($_GET['modthreadkey'])) { 
$return .= <<<EOF
&amp;modthreadkey={$_GET['modthreadkey']}
EOF;
 } 
$return .= <<<EOF
" class="xg1">[
EOF;
 if($_G['forum_thread']['special'] == 2 && !$post['message']) { 
$return .= <<<EOF
!post_add_aboutcounter!
EOF;
 } else { 
$return .= <<<EOF
编辑]</a>
EOF;
 } } elseif($_G['uid'] && $post['authorid'] == $_G['uid'] && $_G['setting']['postappend']) { 
$return .= <<<EOF

<a href="forum.php?mod=misc&amp;action=postappend&amp;tid={$post['tid']}&amp;pid={$post['pid']}&amp;extra={$_GET['extra']}" onClick="showWindow('postappend', this.href, 'get', 0)" class="xg1">[!postappend!]</a>

EOF;
 } } } 
$return .= <<<EOF


EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>