<?php
/**
 *	[插件聚合(zgxsh_app_center.{modulename})] (C)2018-2099 Powered by 日月星辰软件.
 *	Version: 1.0
 *	Date: 2019-08-04 15:00
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//--这个文用来执行$_G逻辑和安全函数以及处理插件变量
include 'module/main.php';


if($_TRC['admin_uid']<>$_G['uid'] and $_G['adminid']<>1){  //非管理
	header("Location:plugin.php?id=zgxsh_app_center:index");
  exit();
}

for($i=0;$i<3;$i++){
  if($_TRC['see_bdx_label'][$i]==1){
    $_TRC['see_bdx_label_css'][$i]="";
  }elseif($_TRC['see_bdx_label'][$i]==2){
    $_TRC['see_bdx_label_css'][$i]="layui-bg-orange";
  }elseif($_TRC['see_bdx_label'][$i]==3){
    $_TRC['see_bdx_label_css'][$i]="layui-bg-green";
  }elseif($_TRC['see_bdx_label'][$i]==4){
    $_TRC['see_bdx_label_css'][$i]="layui-bg-cyan";
  }elseif($_TRC['see_bdx_label'][$i]==5){
    $_TRC['see_bdx_label_css'][$i]="layui-bg-blue";
  }elseif($_TRC['see_bdx_label'][$i]==6){
    $_TRC['see_bdx_label_css'][$i]="layui-bg-black";
  }elseif($_TRC['see_bdx_label'][$i]==7){
    $_TRC['see_bdx_label_css'][$i]="layui-bg-gray";
  } 
}
for($i=0;$i<3;$i++){
  if($_TRC['see_cq_label'][$i]==1){
    $_TRC['see_cq_label_css'][$i]="";
  }elseif($_TRC['see_cq_label'][$i]==2){
    $_TRC['see_cq_label_css'][$i]="layui-bg-orange";
  }elseif($_TRC['see_cq_label'][$i]==3){
    $_TRC['see_cq_label_css'][$i]="layui-bg-green";
  }elseif($_TRC['see_cq_label'][$i]==4){
    $_TRC['see_cq_label_css'][$i]="layui-bg-cyan";
  }elseif($_TRC['see_cq_label'][$i]==5){
    $_TRC['see_cq_label_css'][$i]="layui-bg-blue";
  }elseif($_TRC['see_cq_label'][$i]==6){
    $_TRC['see_cq_label_css'][$i]="layui-bg-black";
  }elseif($_TRC['see_cq_label'][$i]==7){
    $_TRC['see_cq_label_css'][$i]="layui-bg-gray";
  } 
}
for($i=0;$i<3;$i++){
  if($_TRC['see_sxsb_label'][$i]==1){
    $_TRC['see_sxsb_label_css'][$i]="";
  }elseif($_TRC['see_sxsb_label'][$i]==2){
    $_TRC['see_sxsb_label_css'][$i]="layui-bg-orange";
  }elseif($_TRC['see_sxsb_label'][$i]==3){
    $_TRC['see_sxsb_label_css'][$i]="layui-bg-green";
  }elseif($_TRC['see_sxsb_label'][$i]==4){
    $_TRC['see_sxsb_label_css'][$i]="layui-bg-cyan";
  }elseif($_TRC['see_sxsb_label'][$i]==5){
    $_TRC['see_sxsb_label_css'][$i]="layui-bg-blue";
  }elseif($_TRC['see_sxsb_label'][$i]==6){
    $_TRC['see_sxsb_label_css'][$i]="layui-bg-black";
  }elseif($_TRC['see_sxsb_label'][$i]==7){
    $_TRC['see_sxsb_label_css'][$i]="layui-bg-gray";
  } 
}
for($i=0;$i<3;$i++){
  if($_TRC['see_custom1_label'][$i]==1){
    $_TRC['see_custom1_label_css'][$i]="";
  }elseif($_TRC['see_custom1_label'][$i]==2){
    $_TRC['see_custom1_label_css'][$i]="layui-bg-orange";
  }elseif($_TRC['see_custom1_label'][$i]==3){
    $_TRC['see_custom1_label_css'][$i]="layui-bg-green";
  }elseif($_TRC['see_custom1_label'][$i]==4){
    $_TRC['see_custom1_label_css'][$i]="layui-bg-cyan";
  }elseif($_TRC['see_custom1_label'][$i]==5){
    $_TRC['see_custom1_label_css'][$i]="layui-bg-blue";
  }elseif($_TRC['see_custom1_label'][$i]==6){
    $_TRC['see_custom1_label_css'][$i]="layui-bg-black";
  }elseif($_TRC['see_custom1_label'][$i]==7){
    $_TRC['see_custom1_label_css'][$i]="layui-bg-gray";
  } 
}
for($i=0;$i<3;$i++){
  if($_TRC['see_custom2_label'][$i]==1){
    $_TRC['see_custom2_label_css'][$i]="";
  }elseif($_TRC['see_custom2_label'][$i]==2){
    $_TRC['see_custom2_label_css'][$i]="layui-bg-orange";
  }elseif($_TRC['see_custom2_label'][$i]==3){
    $_TRC['see_custom2_label_css'][$i]="layui-bg-green";
  }elseif($_TRC['see_custom2_label'][$i]==4){
    $_TRC['see_custom2_label_css'][$i]="layui-bg-cyan";
  }elseif($_TRC['see_custom2_label'][$i]==5){
    $_TRC['see_custom2_label_css'][$i]="layui-bg-blue";
  }elseif($_TRC['see_custom2_label'][$i]==6){
    $_TRC['see_custom2_label_css'][$i]="layui-bg-black";
  }elseif($_TRC['see_custom2_label'][$i]==7){
    $_TRC['see_custom2_label_css'][$i]="layui-bg-gray";
  } 
}
for($i=0;$i<3;$i++){
  if($_TRC['see_custom3_label'][$i]==1){
    $_TRC['see_custom3_label_css'][$i]="";
  }elseif($_TRC['see_custom3_label'][$i]==2){
    $_TRC['see_custom3_label_css'][$i]="layui-bg-orange";
  }elseif($_TRC['see_custom3_label'][$i]==3){
    $_TRC['see_custom3_label_css'][$i]="layui-bg-green";
  }elseif($_TRC['see_custom3_label'][$i]==4){
    $_TRC['see_custom3_label_css'][$i]="layui-bg-cyan";
  }elseif($_TRC['see_custom3_label'][$i]==5){
    $_TRC['see_custom3_label_css'][$i]="layui-bg-blue";
  }elseif($_TRC['see_custom3_label'][$i]==6){
    $_TRC['see_custom3_label_css'][$i]="layui-bg-black";
  }elseif($_TRC['see_custom3_label'][$i]==7){
    $_TRC['see_custom3_label_css'][$i]="layui-bg-gray";
  } 
}

$db_plugin = DB::fetch_all("SELECT * FROM ".DB::table('zgxsh_app_center'));

//print_r($db_plugin);

include template('zgxsh_app_center:setup/setup');
?>