<?php
/**
 *	开发团队：IT618
 *	it618_copyright 插件设计：<a href="http://www.cnit618.com" target="_blank" title="专业Discuz!应用及周边提供商">IT618</a>
 */
if(!defined('IN_DISCUZ')) {
  exit('Access Denied');
}

class plugin_it618_regsafe_base {
	function common_base() {
		global $_G;
		$it618_regsafe = $_G['cache']['plugin']['it618_regsafe'];

		if($_GET[''.$_G['setting']['reginput']['username']]!=''){
			
			if(strtolower($_GET['it618_regsafe_check_answer'])!=getcookie('validatecode')||$_GET['it618_regsafe_check_answer']==''){
				showmessage($it618_regsafe['checktip'], '', array(), array());
			}
		}
	}
	
	function getit618_regsafe($waptmp){
		global $_G,$wap;
		$it618_regsafe = $_G['cache']['plugin']['it618_regsafe'];
		
		$wap=$waptmp;
		
		if($wap==1){
			$regstr='<li class="bl_none" style="padding-bottom:6px"><img id="checkcodeimg" src="" onclick="getcheckcode()" style="height:35px; margin-right:4px; cursor:pointer;vertical-align:middle"></img><input name="it618_regsafe_check_answer" tabindex="5" class="px" type="text" alt="'.$it618_regsafe_checks['id'].'" value="" placeholder="'.$it618_regsafe['wapchecktitle'].'" style="width:98px;margin-right:5px;" onkeyup="gettip(this)"/><span id="it618_regsafe_tip"></span><a href="javascript:" onclick="getcheckcode()">'.$it618_regsafe['checkchange'].'</a></li>';
		}else{
			$regstr='<div class="rfm"><table><tr><th><span class="rq">*</span>'.$it618_regsafe['pcchecktitle'].'</th><td></td><td class="tipcol"><img id="checkcodeimg" src="" onclick="getcheckcode()" style="height:35px; margin-right:4px; cursor:pointer;vertical-align:middle"></img><input name="it618_regsafe_check_answer" class="px" type="text" alt="'.$it618_regsafe_checks['id'].'" value="" style="width:68px;margin-right:5px;font-size:15px" onkeyup="gettip(this)"/><span id="it618_regsafe_tip"></span><a href="javascript:" onclick="getcheckcode()">'.$it618_regsafe['checkchange'].'</a></td></tr></table></div>';
		}
		
		$tmpmobiletpl=$_G['mobiletpl'][IN_MOBILE];
		$_G['mobiletpl'][IN_MOBILE]='/';
		include template('it618_regsafe:regsafe');
		$_G['mobiletpl'][IN_MOBILE]=$tmpmobiletpl;
		
		
		return $it618_regsafe_block;
	}
}

class plugin_it618_regsafe extends plugin_it618_regsafe_base {
	
	function common() {
		
		$this->common_base();

	}
	
	function global_footer() {
		if($_GET['mod']=='register'||$_GET['mod']=='connect')return $this->getit618_regsafe(0);
	}

}

class mobileplugin_it618_regsafe extends plugin_it618_regsafe_base {
	
	function common() {

		$this->common_base();

	}
	
	function global_footer_mobile(){
		if($_GET['mod']=='register'||$_GET['mod']=='connect')return $this->getit618_regsafe(1);
	}

}

?>