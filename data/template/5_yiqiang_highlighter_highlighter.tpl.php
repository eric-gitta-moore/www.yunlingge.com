<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); function viewthread_title_extra_highlighter (){
global $_G;
$style_name = $_G['cache']['plugin']['yiqiang_highlighter']['style_name'];
$list_style = $_G['cache']['plugin']['yiqiang_highlighter']['list_style'];
$width = $_G['cache']['plugin']['yiqiang_highlighter']['width'];
$width = $width?$width."px":"auto";
$copy_code = $_G['cache']['plugin']['yiqiang_highlighter']['copy_code'];?><?php
$return = <<<EOF

<link rel="stylesheet" href="./source/plugin/yiqiang_highlighter/template/style/{$style_name}.css">
<script src="./source/plugin/yiqiang_highlighter/template/js/highlight.min.js" type="text/javascript"></script>
<script>
    let style = "cursor:pointer;" +
        "font-size: 12px;" +
        "margin-left: 2em;";
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.blockcode').forEach((block) => {
            block.className = "newblockcode";
            block.setAttribute("style","width:{$width}");
            let ol = block.firstElementChild.firstElementChild;
            let id = block.firstElementChild.getAttribute("id");
            let newCopy = block.lastChild.cloneNode(true);
            if (!{$list_style}) {
                ol.setAttribute("style", "list-style:none;");
            }
            ol.setAttribute("id", id + "ol");
            block.lastElementChild.remove();
            newCopy.setAttribute("style", style);
            newCopy.setAttribute("class", "hljs xml");
            newCopy.setAttribute("onclick", "copycode($('" + id + "ol'))");
            if ({$copy_code}){
                block.getElementsByTagName('div')[0].appendChild(newCopy)
            }
        });
        document.querySelectorAll('div.newblockcode div').forEach((block) => {
            hljs.highlightBlock(block);
        });
    });
</script>

EOF;
?><?php return $return;?><?php }?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>