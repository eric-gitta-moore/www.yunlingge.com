<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('http://localhost/discuz_x3.2_sc_gbk/upload/');
}
if(!$_G[setting][version]) {
    require_once DISCUZ_ROOT . './source/discuz_version.php';
    $_G[setting][version] = DISCUZ_VERSION;
}
if(in_array($_G[setting][version], array('X1.5', 'X2'))) {
    $data_dir = 'cache';
}else {
    $data_dir = 'sysdata';
}
@include_once(DISCUZ_ROOT . './data/' . $data_dir . '/cache_study_contentorigin.php');
$splugin_lang = lang('plugin/study_contentorigin');
if(submitcheck('submit')) {
    // ´¦Àí
    $postdata = daddslashes(dstripslashes($_POST));
    $splugin_config['study_iflink'] = $postdata['study_iflink'];
    $splugin_config['study_ifbg'] = $postdata['study_ifbg'];
    $splugin_config['study_transparent'] = $postdata['study_transparent'];
    $splugin_config['study_dispic'] = $postdata['study_dispic'];
    $splugin_config['study_wordcolor'] = $postdata['study_wordcolor'];
    $splugin_config['study_overcolor'] = $postdata['study_overcolor'];
    $cache_content .= '
//This is NOT a freeware, use is subject to license terms
//Powered by www.1314study.com
if(!defined(\'IN_DISCUZ\')) {
	exit(\'Access Denied Powered by www.1314study.com \');
}
$splugin_config = ' . var_export($splugin_config, true) . ";\n";
    if(!function_exists('writetocache')) {
        require_once libfile('function/cache');
    }
    writetocache('study_contentorigin', $cache_content);
    cpmsg($splugin_lang['study_saved'], 'action=plugins&operation=config&identifier=study_contentorigin&pmod=contentlink', 'succeed');
}

echo('
<style>.pc_l{line-height:56px;width:29px;background:url(static/image/common/popupcredit_bg.gif) no-repeat 0px 0px;height:56px}.pc_c{line-height:56px;width:29px;background:url(static/image/common/popupcredit_bg.gif) no-repeat 0px 0px;height:56px}.pc_inner{line-height:56px;width:29px;background:url(static/image/common/popupcredit_bg.gif) no-repeat 0px 0px;height:56px}.pc_r{line-height:56px;width:29px;background:url(static/image/common/popupcredit_bg.gif) no-repeat 0px 0px;height:56px}.pc_c{width:200px;background-repeat:repeat-x;background-position:0px -56px}.pc_inner{text-align:center;width:auto;white-space:nowrap;background-position:50% -112px}.pc_r{background-position:-30px 0px}</style>

<script language="javascript">
function show(){
document.getElementById("study_preview").style.display="";
}
function hidden(){
document.getElementById("study_preview").style.display="none";
}
function checklink(form) {
	if(form.study_iflink.checked)
		form.study_iflink.value="1";
	else
		form.study_iflink.value="0"; 
}
function checkbg(form) {
	if(form.study_ifbg.checked) {
		form.study_ifbg.value="1";
	}
	else {
		form.study_ifbg.value="0"; 
	}
}
function checktransparent(form) {
	if(form.study_transparent.checked)
		form.study_transparent.value="1";
	else
		form.study_transparent.value="0"; 
}
</script>
<div style="height:397px;background:url(source/plugin/study_contentorigin/images/adminbg.jpg) no-repeat;">
<div style="padding: 10px 20px;">
	<form action="" method="post">
	<input type="hidden" name="formhash" value="' . $_G['formhash'] . '" />
	<table cellpadding="5"><th><b>' . $splugin_lang['study_argset'] . '</b></th><th><b>' . $splugin_lang['study_argexp'] . '</b></th>
	<tr>
		<td>');
if($splugin_config['study_iflink'] == 0){
    echo '<input style="background:transparent;" type="checkbox" name="study_iflink" value="0" onclick="checklink(form);">';
}else{
    echo '<input style="background:transparent;" type="checkbox" name="study_iflink" value="1" onclick="checklink(form);" checked>';
}
echo $splugin_lang['study_iflink'] . '</td><td style="align:right;">' . $splugin_lang['study_iflink_exp'] . '</td></tr><tr><td>';
if($splugin_config['study_ifbg'] == 0) {
		echo '<input style="background:transparent;" type="checkbox" name="study_ifbg" value="0" onclick="checkbg(form);">';
}else {
		echo '<input style="background:transparent;" type="checkbox" name="study_ifbg" value="1" onclick="checkbg(form);" checked>';
}
echo $splugin_lang['study_ifbg'] . '</td><td>' . $splugin_lang['study_ifbg_exp'] . '</td></tr><tr><td>';
if($splugin_config['study_transparent'] == 0){
		echo '<input style="background:transparent;" type="checkbox" name="study_transparent" value="0" onclick="checktransparent(form);">';
}else{
		echo '<input style="background:transparent;" type="checkbox" name="study_transparent" value="1" onclick="checktransparent(form);" checked>';
}
echo $splugin_lang['study_transparent'] . '</td><td style="align:right;">' . $splugin_lang['study_transparent_exp'] . '</td>
</tr>
<tr>
	<td>' . $splugin_lang['study_dispic'] . '<br><input style="background:transparent;" type="text" name="study_dispic" size=36 maxLength=64 value="' . dhtmlspecialchars($splugin_config[study_dispic]) . '"></td><td>' . $splugin_lang['study_dispic_exp'] . '</td>
</tr>
<tr>
	<td>' . $splugin_lang['study_wordcolor'] . '<br><input style="background:transparent;" type="text" name="study_wordcolor" size=36 maxLength=64 value="' . dhtmlspecialchars($splugin_config[study_wordcolor]) . '"></td><td>' . $splugin_lang['study_wordcolor_exp'] . '</td>
</tr>
<tr>
	<td>' . $splugin_lang['study_overcolor'] . '<br><input style="background:transparent;" type="text" name="study_overcolor" size=36 maxLength=64 value="' . dhtmlspecialchars($splugin_config[study_overcolor]) . '"></td><td>' . $splugin_lang['study_overcolor_exp'] . '</td>
</tr>
</table>
<br />
&nbsp;&nbsp;<input style="background:transparent;cursor: hand;" type="submit" name="submit" value= "' . $splugin_lang['study_saveset'] . '">
&nbsp;&nbsp;<input style="background:transparent;color:green;cursor: hand;" type="button" onclick="location.reload()"  value= "' . $splugin_lang['study_preview'] . '">
</form>
<div style="height:10px"></div>';

if($splugin_config['study_iflink'] == '1') {
		if($splugin_config['study_ifbg'] == '1') {
				$study_dispic = explode(",", $splugin_config['study_dispic']);
				$count_dispic = count($study_dispic);
				$count_dispic = $count_dispic - 1;
				if(!empty($study_dispic[0])) {
				    $picshow = 'background:url(source/plugin/study_contentorigin/images/' . $study_dispic[rand(0, $count_dispic)] . '.gif) no-repeat center top;';
				}else {
				    $picshow = 'background:url(source/plugin/study_contentorigin/images/study.gif) no-repeat center top;';
				}
				$overcolor = $splugin_config['study_overcolor'];
				if(!empty($splugin_config['study_wordcolor'])) {
				    $wordcolor = $splugin_config['study_wordcolor'];
				}else {
				    $wordcolor = "#000";
				}
				if($splugin_config['study_transparent'] == '1') {
				    $transparent = "transparent";
				}else {
				    $transparent = "#FFF";
				}
				if(!empty($overcolor)) {
				    $mouseover = 'onmouseover=\'this.style.backgroundColor="' . $overcolor . '";\' onmouseout=\'this.style.backgroundColor="' . $transparent . '";\'';
				}
		}
		$copytitle = $splugin_lang['study_addon'];
		$copyurl = 'http://addon.1314study.com/';
		echo('<div id="study_preview" style="' . $picshow . ' no-repeat center top; border:#CAD9EA solid 0px; height: 60px; width:760px; text-align:center;">
				<p style="height:10px;"></p>
				<p class="mtm pns"><b><font style="color:' . $wordcolor . '">' . $splugin_lang['study_tieziloc'] . '</font></b>
				<input ' . $mouseover . ' style=" COLOR: #666; FONT-SIZE: 14px; BORDER-TOP: #707070 1px solid; BORDER-RIGHT: #cecece 1px solid; PADDING-TOP: 2px;color:' . $wordcolor . ';vertical-align:middle;background:' . $transparent . ';"  type="text" onclick="this.select();setCopy(\'' . $copytitle . '\n' . $copyurl . '\', \'' . $splugin_lang['study_lert'] . '\');" value="' . $copyurl . '" size="40" class="px"/>
				&nbsp;<button ' . $mouseover . ' style="PADDING-LEFT: 20px; PADDING-RIGHT: 20px;margin-right: 3px; _margin: 0px 3px 1px 0; _padding: 0; height: 24px;font-weight: 700; border: 1px solid;line-height: 24px; font-size: 13px;vertical-align: top; cursor: pointer; overflow: visible; " type="submit" style="color:' . $wordcolor . ';background:' . $transparent . '"  onclick="setCopy(\'' . $copytitle . '\n' . $copyurl . '\', \'' . $splugin_lang['study_lert'] . '\')"><font style="color:' . $wordcolor . '"><em>' . $splugin_lang['study_button'] . '</em></font></button></p>
				</div>');
}

echo('</div></div>');

?>