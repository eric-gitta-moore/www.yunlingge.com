<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$table1 = DB::table("xhkj5com_dashang");
$basedir = DISCUZ_ROOT.'./data/xhkj5com_dashang/';
deldir($basedir);
$sql = <<<EOF
DROP TABLE IF EXISTS `$table1`;
EOF;
runquery($sql);
$finish = true;

function deldir($dir) {
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }
  closedir($dh);
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}
?>