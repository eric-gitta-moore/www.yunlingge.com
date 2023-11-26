<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_ecode {
	protected static $conf = array();
	public function plugin_ecode() {
		global $_G;
		self::$conf['isopen'] = $_G['cache']['plugin']['ecode']['isopen'];
		self::$conf['isthread'] = $_G['cache']['plugin']['ecode']['isthread'];
		self::$conf['isreply'] = $_G['cache']['plugin']['ecode']['isreply'];
		self::$conf['ispost'] = $_G['cache']['plugin']['ecode']['ispost'];
		self::$conf['forums'] = (array)unserialize($_G['cache']['plugin']['ecode']['forums']);
		self::$conf['usergroups'] = (array)unserialize($_G['cache']['plugin']['ecode']['usergroups']);
		if(empty(self::$conf['usergroups'][0]) || in_array($_G['groupid'], self::$conf['usergroups'])){
			self::$conf['isgroupid'] = TRUE;
		}
		if(empty(self::$conf['forums'][0]) || in_array($_G['fid'], self::$conf['forums'])){
			self::$conf['isfid'] = TRUE;
		}
		self::$conf['extracss'] = $_G['cache']['plugin']['ecode']['extracss'] ? $_G['cache']['plugin']['ecode']['extracss'] : '';
	}
	function discuzcode($param) {
		global $_G;
		$codemod = $_G['cache']['plugin']['ecode']['codemod'] == '' ? 'ecode' : $_G['cache']['plugin']['ecode']['codemod'];		
		if (strpos($_G['discuzcodemessage'], '[/'.$codemod.']') === false) { //如果要兼容之前的其他高亮插件  此处需要新增判断后缀
			return false;
		}
		if($param['caller'] == 'discuzcode') {
			$_G['discuzcodemessage'] = preg_replace('/\s?\['.$codemod.'=(\d{1,3})\][\n\r]*(.+?)[\n\r]*\[\/'.$codemod.'\]\s?/ies', '$this->_show(\'\\1\', \'\\2\')', $_G['discuzcodemessage']);
			//$_G['discuzcodemessage'] = preg_replace('/\s?\['.$codemod.'(=[^\]]*){0,1}\][\n\r]*(.+?)[\n\r]*\[\/'.$codemod.'\]\s?/ies', '$this->_show(0,\'\\2\')', $_G['discuzcodemessage']); //如果之前你的论坛曾用过其他易语言高亮插件,请把这段的注释关掉并修改参数参数自行修改. 适用[前缀][/后缀]格式
			//$_G['discuzcodemessage'] = preg_replace('/\s?\['.$codemod.'=(\d{1,3})\][\n\r]*(.+?)[\n\r]*\[\/'.$codemod.'\]\s?/ies', '$this->_show(\'\\1\', \'\\2\')', $_G['discuzcodemessage']);//如果之前你的论坛曾用过其他易语言高亮插件,请把这段的注释关掉并修改参数参数自行修改. 适用[前缀=数字][/后缀]格式

		} else {
			$_G['discuzcodemessage'] = preg_replace('/\['.$codemod.'=(\d{1,3})\]|\[\/'.$codemod.'\]/ies', '', $_G['discuzcodemessage']);
		}
	}
	function _show($type, $text){
		global $codenum;
		$codenum=$codenum>0? $codenum+1: 1;
		
		require_once DISCUZ_ROOT.'./source/plugin/ecode/code/e.php';
		
		$type = $type==0 ? mt_rand(1,10): $type;		
		$type = $type>0 && $type <11 ? $type : '1';

		return '<div class="frame_out ebackcolor'.$type.'" onmouseover="this.style.border=\'1px dashed red\';codetool'.$codenum.'.style.borderBottom=\'1px dashed red\'" onmouseout="this.style.border=\'1px dashed #CCCCCC\';codetool'.$codenum.'.style.borderBottom=\'1px dashed #CCCCCC\'"><div class="frame_up" id="codetool'.$codenum.'"><input type="button" onclick="copyecode('.$codenum.',\'复制成功，请直接在易语言里粘贴即可\');" value="　复制代码　" class="pn pnc"/>&nbsp;&nbsp;<input type="button" onclick="QhShow('.$codenum.');" id="QhShow'.$codenum.'" value="　纯文本模式　" class="pn pnc"/></div><div id="codetxt'.$codenum.'_a" style="display: " class="frame_show ebackcolor'.$type.'">'.getehtm($text,$type).'</div><div id="codetxt'.$codenum.'_b" style="display: none"><textarea class="codeshow" id="ecode_'.$codenum.'">'.$text.'</textarea></div></div>';

		
		
	}
}

class plugin_ecode_forum extends plugin_ecode {
	function post_editorctrl_left() {
		global $_G;
		
		@extract(self::$conf);
		$return = '';
		if($isopen && $ispost && $isgroupid && $isfid){
			$return = '<link rel="stylesheet" href="/source/plugin/ecode/image/common.css" type="text/css" /><script src="/source/plugin/ecode/image/common.js" type="text/javascript"></script><a href="javascript:;" onClick="showWindow(\'ecode\', \'plugin.php?id=ecode\', \'get\', 0)" id="codecolor" title="易代码">代码</a>';
		}
		$return .= $extracss;
		return $return;
	}
	function viewthread_top() {
		global $_G;
		@extract(self::$conf);
		$return = '<link rel="stylesheet" href="/source/plugin/ecode/image/common.css" type="text/css" /><script src="/source/plugin/ecode/image/common.js" type="text/javascript"></script>';
		$return .= $extracss;
		return $return;
	}
	function viewthread_fastpost_func_extra() {
		global $_G;
		@extract(self::$conf);
		$return = '';
		if($isopen && $isreply && $isgroupid && $isfid){
			$return .= '<a href="plugin.php?id=ecode&fast=1" onClick="showWindow(\'ecode\', this.href, \'get\', 0)" title="易代码"><img src="/source/plugin/ecode/image/e.gif" style="margin-top:2px;"/></a>&nbsp;&nbsp;';
		}
		return $return;
	}
	function forumdisplay_top(){
		global $_G;
		@extract(self::$conf);
		$return = '<link rel="stylesheet" href="/source/plugin/ecode/image/common.css" type="text/css" /><script src="/source/plugin/ecode/image/common.js" type="text/javascript"></script>';
		$return .= $extracss;
		return $return;
	}
	function forumdisplay_fastpost_func_extra(){
		global $_G;
		@extract(self::$conf);
		$return = '';
		if($isopen && $isthread && $isgroupid && $isfid){
			$return = '<a href="plugin.php?id=ecode&fast=1" onClick="showWindow(\'ecode\', this.href, \'get\', 0)" id="codecolor" title="易代码"><img src="/source/plugin/ecode/image/e.gif" style="margin-top:2px;"/></a>&nbsp;&nbsp;';
		}
		return $return;
	}
}

?>