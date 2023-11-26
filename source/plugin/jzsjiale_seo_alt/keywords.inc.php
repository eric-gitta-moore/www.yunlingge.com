<?php
/*
 * CopyRight  : [xhkj5.com!] (C)2014-2016
 * Document   : 讯幻网：www.xhkj5.com，www.xhkj5.com
 * Created on : 2016-01-06,09:53:15
 * Author     : 讯幻网(QQ：154606914) wWw.xhkj5.com $
 * Description: This is NOT a freeware, use is subject to license terms.
 *              讯幻网出品 必属精品。
 *              讯幻网 全网首发 http://www.xhkj5.com；
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$act = $_GET['act'];
global $_G, $lang;


if($act=='add'){
	if(submitcheck('submit')){
	
		$tz = $_GET['tz'];
		$dtz = array('dateline'=>TIMESTAMP);
		$dtz['keywords'] = addslashes(trim($tz['keywords']));
		if(empty($dtz['keywords'])){
		    cpmsg('jzsjiale_seo_alt:nokeywords', '', 'error');
		}elseif(strlen($dtz['keywords']) > 40) {
		    cpmsg('jzsjiale_seo_alt:d_keywords_more', '', 'error');
		}
		
		if(C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->insert($dtz,true)){
			cpmsg('jzsjiale_seo_alt:addok', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&recache=true', 'succeed');
		}else{
			cpmsg('jzsjiale_seo_alt:error', '', 'error');
		}
	
	}
	
	echo '<div class="colorbox"><h4>'.plang('aboutkeywords').'</h4>'.
		 '<table cellspacing="0" cellpadding="3"><tr>'.
	     '<td valign="top">'.plang('description').'</td></tr></table>'.
		 '<div style="width:95%" align="right">'.plang('copyright').'</div></div>';

	
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=add', 'enctype');
	showtableheader(plang('addkeywords'), '');
	showsetting(plang('dkeywords'),'tz[keywords]','','text','','',plang('dkeywords_msg'));
	
	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
	
	
	dexit();
}elseif($act=='delete'){
	$id = dintval($_GET['id']);
	$tz = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->fetch($id);
	if(empty($tz))
		cpmsg('jzsjiale_seo_alt:empty', '', 'error');
	if(submitcheck('submit')){
		C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->delete($id);
		cpmsg('jzsjiale_seo_alt:delok', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&recache=true', 'succeed');
	
	}
	cpmsg('jzsjiale_seo_alt:ddel','action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=delete&id='.$id.'&submit=yes','form',array('keywords' => $tz['keywords']));
}elseif($act=='details'){
	$id = dintval($_GET['id']);
	$tz = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->fetch($id);
	if(empty($tz))
		cpmsg('jzsjiale_seo_alt:empty', '', 'error');
	echo "<strong>".plang("dkeywords").":</strong>".$tz['keywords']."<br/>"
		 ."<strong>".plang("ddateline").":</strong>".dgmdate($tz['dateline'])."<br/>";
	
	
	dexit();
}elseif($act=='edit'){
	$id = dintval($_GET['id']);
	$tz = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->fetch($id);
	if(empty($tz))
		cpmsg('jzsjiale_seo_alt:empty', '', 'error');
	if(submitcheck('submit')){
	    $tz = $_GET['tz'];
		$dtz = array('dateline'=>TIMESTAMP);
		$dtz['keywords'] = addslashes(trim($tz['keywords']));
		
		if(empty($dtz['keywords'])){
		    cpmsg('jzsjiale_seo_alt:nokeywords', '', 'error');
		}elseif(strlen($dtz['keywords']) > 40) {
		    cpmsg('jzsjiale_seo_alt:d_keywords_more', '', 'error');
		}
		
		if(C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->update($id,$dtz)){
			cpmsg('jzsjiale_seo_alt:editok', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&recache=true', 'succeed');
		}else{
			cpmsg('jzsjiale_seo_alt:error', '', 'error');
		}
		
	
	
	}
	echo '<div class="colorbox"><h4>'.plang('aboutkeywords').'</h4>'.
		 '<table cellspacing="0" cellpadding="3"><tr>'.
	     '<td valign="top">'.plang('description').'</td></tr></table>'.
		 '<div style="width:95%" align="right">'.plang('copyright').'</div></div>';
	
	
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=edit', 'enctype');
	echo'<input type="hidden" value="'.$tz['id'].'" name="id"/>';
	showtableheader(plang('editkeywords'), '');
	showsetting(plang('dkeywords'),'tz[keywords]',$tz['keywords'],'text','','',plang('dkeywords_msg'));
	
	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
	dexit();
}elseif($act=='cache'){
    //if(!@include_once DISCUZ_ROOT.'./data/sysdata/cache_jzsjiale_seo_alt_keywords.php'){
    
            $allkeywords = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->getall();
      
            require_once libfile('function/cache');
            writetocache('jzsjiale_seo_alt_keywords', getcachevars(array('keywords' => $allkeywords)));
        
            if(count($allkeywords) > 0){
                cpmsg('jzsjiale_seo_alt:cache_success', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords', 'succeed');
            }else{
                cpmsg('jzsjiale_seo_alt:cache_error', '', 'error');
            }
            
        
        dexit();
    //}
}

if($_GET['recache']){
    $allkeywords = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->getall();
    
    require_once libfile('function/cache');
    writetocache('jzsjiale_seo_alt_keywords', getcachevars(array('keywords' => $allkeywords)));
    
    if(count($allkeywords) > 0){
        cpmsg('jzsjiale_seo_alt:cache_success', 'action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords', 'succeed');
    }else{
        cpmsg('jzsjiale_seo_alt:cache_error', '', 'error');
    }
}

loadcache('plugin');

$page = intval($_GET['page']);
$page = $page > 0 ? $page : 1;
$pagesize = 15;
$start = ($page - 1) * $pagesize;

$allkeywords = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->range($start,$pagesize,'DESC');
$count = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->count();
showtableheader(plang('keywordslist').'(  <a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=add" style="color:red;">'.plang('add').'</a>  |  <a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=cache" style="color:red;">'.plang('cachekeywords').'</a>)', '');
showsubtitle(plang('keywordslisttitle'));
foreach($allkeywords as $d){
	showtablerow('', array('width="160"'), array(
	$d['id'],
	'<span title="'.$d['keywords'].'">'.substr($d['keywords'],0,40).'</span>',
	dgmdate($d['dateline']),
	'<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=details&id='.$d['id'].'">'.plang('details').'</a>&nbsp;<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=edit&id='.$d['id'].'">'.plang('edit').'</a>&nbsp;<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords&act=delete&id='.$d['id'].'">'.plang('delete').'</a>')
	);
}
$mpurl = ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=jzsjiale_seo_alt&pmod=keywords';
$multipage = multi($count, $pagesize, $page, $mpurl);
showsubmit('', '', '', '', $multipage);
showtablefooter();

function plang($str) {
	return lang('plugin/jzsjiale_seo_alt', $str);
}
//From:www_xhkj5_com
?>