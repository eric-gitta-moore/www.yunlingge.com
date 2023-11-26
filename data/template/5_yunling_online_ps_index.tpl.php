<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html lang='zh-cn'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0'>
    <title><?php echo $title;?></title>
    <meta name='keywords' content='<?php echo $keywords;?>'>
    <meta name='description' content='<?php echo $desc;?>'>
    <link rel='stylesheet' href='<?php echo $static;?>/style/a.css'>
    <link rel='stylesheet' href='<?php echo $static;?>/style/font.css'>
    <style>
    </style>
    <script>
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
    </script>
</head>

<body class='theme0'>
<div id='cap' style='display:none;'></div>
<div class='topfloat' style='display:none;'></div>
<script src='<?php echo $static;?>/code/a.js'></script>
<script src='<?php echo $static;?>/code/b.js'></script>
<script src='<?php echo $static;?>/code/c.js'></script>
<script src='<?php echo $static;?>/code/d.js'></script>
<script src='<?php echo $static;?>/code/e.js'></script>
<script src='<?php echo $static;?>/code/f.js'></script>

</body>

</html><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>