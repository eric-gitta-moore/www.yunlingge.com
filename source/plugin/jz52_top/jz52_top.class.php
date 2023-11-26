<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

loadcache('plugin');

class plugin_jz52_top {

    function plugin_jz52_top() {
		global $_G;
		
		$this->jz52_topwz = $_G['cache']['plugin']['jz52_top']['jz52_topwz'];
		$this->jz52_gjtwz = $_G['cache']['plugin']['jz52_top']['jz52_gjtwz'];
		$this->jz52_dfk = $_G['cache']['plugin']['jz52_top']['jz52_dfk'];
		$this->jz52_kf = $_G['cache']['plugin']['jz52_top']['jz52_kf'];
		$this->jz52_kfzx = $_G['cache']['plugin']['jz52_top']['jz52_kfzx'];
		$this->jz52_fbztkg = $_G['cache']['plugin']['jz52_top']['jz52_fbztkg'];
		$this->jz52_kfurl = $_G['cache']['plugin']['jz52_top']['jz52_kfurl'];
        $this->jz52_fenxiang = $_G['cache']['plugin']['jz52_top']['jz52_fenxiang'];
        $this->jz52_fenxidm = $_G['cache']['plugin']['jz52_top']['jz52_fenxidm'];
		$this->jz52_qr = $_G['cache']['plugin']['jz52_top']['jz52_qr'];
		$this->jz52_qrimg = $_G['cache']['plugin']['jz52_top']['jz52_qrimg'];
		$this->jz52_tzqr = $_G['cache']['plugin']['jz52_top']['jz52_tzqr'];
		$this->jz52_tzqrsm = $_G['cache']['plugin']['jz52_top']['jz52_tzqrsm'];
		$this->jz52_tzqrlo = $_G['cache']['plugin']['jz52_top']['jz52_tzqrlo'];
		$this->jz52_gzwx = $_G['cache']['plugin']['jz52_top']['jz52_gzwx'];
		$this->jz52_gzwxdm = $_G['cache']['plugin']['jz52_top']['jz52_gzwxdm'];
		$this->jz52_thew = $_G['cache']['plugin']['jz52_top']['jz52_thew'];
		$this->jz52_right = $_G['cache']['plugin']['jz52_top']['jz52_right'];
		$this->jz52_mw = $_G['cache']['plugin']['jz52_top']['jz52_mw'];
		$this->jz52_wzwt = $_G['cache']['plugin']['jz52_top']['jz52_wzwt'];
		$this->jz52_bootcc = $_G['cache']['plugin']['jz52_top']['jz52_bootcc'];
		$this->jz52_ln = $_G['cache']['plugin']['jz52_top']['jz52_ln'];
		$this->jz52_xyy = $_G['cache']['plugin']['jz52_top']['jz52_xyy'];
		$this->jz52_kshf = $_G['cache']['plugin']['jz52_top']['jz52_kshf'];
		$this->jz52_fhzy = $_G['cache']['plugin']['jz52_top']['jz52_fhzy'];
		$this->jz52_fhlb = $_G['cache']['plugin']['jz52_top']['jz52_fhlb'];
		$this->jz52_sctz = $_G['cache']['plugin']['jz52_top']['jz52_sctz'];
		$this->jz52_scbk = $_G['cache']['plugin']['jz52_top']['jz52_scbk'];
		$this->jz52_qqqan = $_G['cache']['plugin']['jz52_top']['jz52_qqqan'];
		$this->jz52_zdy = $_G['cache']['plugin']['jz52_top']['jz52_zdy'];
		$this->jz52_zdybt = $_G['cache']['plugin']['jz52_top']['jz52_zdybt'];		
		$this->jz52_grzx = $_G['cache']['plugin']['jz52_top']['jz52_grzx'];
		$this->jz52_temp = $_G['cache']['plugin']['jz52_top']['jz52_temp'];
		$this->jz52_grzxbjs = $_G['cache']['plugin']['jz52_top']['jz52_grzxbjs'];
		$this->jz52_grzxbjthe = $_G['cache']['plugin']['jz52_top']['jz52_grzxbjthe'];
		$this->jz52_grzxxtb = $_G['cache']['plugin']['jz52_top']['jz52_grzxxtb'];
		$this->jz52_grzxtbkz = $_G['cache']['plugin']['jz52_top']['jz52_grzxtbkz'];
		$this->jz52_grzxtxkg = $_G['cache']['plugin']['jz52_top']['jz52_grzxtxkg'];
		$this->jz52_grzxxxxkg = $_G['cache']['plugin']['jz52_top']['jz52_grzxxxxkg'];
		$this->jz52_grzfktxkg = $_G['cache']['plugin']['jz52_top']['jz52_grzfktxkg'];
		$this->jz52_grzxbjsckg = $_G['cache']['plugin']['jz52_top']['jz52_grzxbjsckg'];
		$this->jz52_uc = $_G['cache']['plugin']['jz52_top']['jz52_uc'];
		$this->jz52_sokg = $_G['cache']['plugin']['jz52_top']['jz52_sokg'];
		$this->jz52_qrsc = $_G['cache']['plugin']['jz52_top']['jz52_qrsc'];
		$this->jz52_qrcss = $_G['cache']['plugin']['jz52_top']['jz52_qrcss'];
		$this->jz52_zindex = $_G['cache']['plugin']['jz52_top']['jz52_zindex'];

	}



	function global_footer(){
	global $_G;
	
if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0') == true )
{
    // ie 6 
	include template('jz52_top:jz_topboxie6');
	return $return;
 
}
else
{

//not ie 6

if($this->jz52_dfk == 1) 
{
$jz52w = $this->jz52_mw/2+$this->jz52_wzwt+50;	//大按钮
} 
else 
{
$jz52w = $this->jz52_mw/2+$this->jz52_wzwt+40;  //小按钮
}

//选项卡内按钮开关
$jz52grzxtb = unserialize($this->jz52_grzxtbkz);
if(in_array("sc",$jz52grzxtb))
{
$sc = 1;
}
if(in_array("tz",$jz52grzxtb))
{
$tz = 2;
}
if(in_array("hy",$jz52grzxtb))
{
$hy = 3;
}
if(in_array("xx",$jz52grzxtb))
{
$xx = 4;
}
if(in_array("sz",$jz52grzxtb))
{
$sz = 5;
}
if(in_array("xz",$jz52grzxtb))
{
$xz = 6;
}
if(in_array("rw",$jz52grzxtb))
{
$rw = 7;
}
if(in_array("tx",$jz52grzxtb))
{
$tx = 8;
}
if(in_array("tc",$jz52grzxtb))
{
$tc = 9;
}
//。。。。。

    $jz52_url = $_G['siteurl']. (in_array('forum_viewthread', $_G['setting']['rewritestatus']) ? 'thread-'. $_G['tid']. '-1-1.html' : 'forum.php%3Fmod=viewthread%26tid='. $_G['tid'] );
	include template('jz52_top:jz_topbox');
	return $return;
}
	

	}
	
}

?>