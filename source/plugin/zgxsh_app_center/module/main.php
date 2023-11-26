<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if(!$_G['uid']){
  header("Location:member.php?mod=logging&action=login");
  exit();
}

function co($txt){
  $a = lang('plugin/zgxsh_app_center',$txt);
  return $a;
}

function system_end($txt){
  global $_G;
  $text = co('system_end').$txt;
  include template('zgxsh_app_center:ts/ts');
  exit();
}

$_TRC = $_G['cache']['plugin']['zgxsh_app_center'];
$_TRC['see_bdx_label'] = unserialize($_TRC['see_bdx_label']);
$_TRC['see_cq_label'] = unserialize($_TRC['see_cq_label']);
$_TRC['see_sxsb_label'] = unserialize($_TRC['see_sxsb_label']);
$_TRC['see_custom1_label'] = unserialize($_TRC['see_custom1_label']);
$_TRC['see_custom2_label'] = unserialize($_TRC['see_custom2_label']);
$_TRC['see_custom3_label'] = unserialize($_TRC['see_custom3_label']);
//定义标题
$navtitle = $_TRC['p_name'];


class security {  //安全验证类
	
	function hash_if($get=0){  //get=1开启GET formhash 判断
    if(!submitcheck('formhash',$get)){
      return false;
    }
		return true;
  }
	
	function filter($GB){  //安全过滤
    foreach ($GB as $k=>$v){
      $r[$k] = dhtmlspecialchars($GB[$k]);
    }
    return $r;
  }
	
	function add_aq($GB){
    if(!self::hash_if(1)){  //GET检测
			return false;
		}
		$r = self::filter($GB);
    return $r;
  }
    
  function add_xz_aq($GB){
    if(!self::hash_if()){
			return false;
		}
		$r = self::filter($GB);
    return $r;
  }
  
  function setup_add_sub_aq($GB){
		
		if($GB['name'] == ""){
		  $text = co('main_1');
      include template('zgxsh_app_center:ts/ts');
      exit();
	  }
		if($GB['url'] == ""){
			$text = co('main_2');
      include template('zgxsh_app_center:ts/ts');
      exit();
	  }
		if($GB['ico'] == ""){
		  $text = co('main_3');
      include template('zgxsh_app_center:ts/ts');
      exit();
	  }
		
    if(!self::hash_if()){
			return false;
		}
		$r = self::filter($GB);
    return $r;
  }
	
	function setup_del_aq($GB){
		
    if(!self::hash_if(1)){  //GET
			return false;
		}
		$r = self::filter($GB);
    return $r;
  }
	
  //入库 数值 intval() 文字 daddslashes()
  function setup_add_sub_ins($GB){
    $ins = array(
      'name' => daddslashes($GB['name']),
      'url' => daddslashes($GB['url']),
      'txt' => daddslashes($GB['txt']),
			'ico' => daddslashes($GB['ico'])
    );
    $r = DB::insert('zgxsh_app_center',$ins);
		return $r;
  }
  
}



?>