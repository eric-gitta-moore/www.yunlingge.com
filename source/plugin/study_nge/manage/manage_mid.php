<?php

/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */
//This is NOT a freeware, use is subject to license terms
//From www.1314study.com
//Ӧ���ۺ����⣺http://www.discuz.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('http://www.ymg6.com/');
}
$pluginvars = array();
foreach(C::t('common_pluginvar')->fetch_all_by_pluginid($pluginid) as $var) {
if(!strexists($var['type'], '_')) {
C::t('common_pluginvar')->update_by_variable($pluginid, $var['variable'], array('type' => $var['type'].'_1314'));/*1.3.1.4.ѧ.ϰ.��*/
}else{
$type = explode('_', $var['type']);
if($type[1] == '1314'){
$var['type'] = $type[0];#��Ȩ��www.1314study.com
}else{
continue;
}
}
$pluginvars[$var['variable']] = $var;#1.3.1.4.ѧ.ϰ.��
}/*1.3.1.4.ѧ.ϰ.��*/
$mid = $_GET['mid'] ? trim($_GET['mid']) : $pluginvars_array['modules'][$type1314][0][1];#1314ѧϰ��
if($mid){
if(strlen($mid) > 40 || !ispluginkey($mid) || !isset($pluginvars_array['mid'][$mid])) {
cpmsg('&#x6A21;&#x5757;'.$mid.'&#x4E0D;&#x5B58;&#x5728;&#x6216;&#x4E0D;&#x5408;&#x6CD5;', '', 'error');#��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
}
if(!submitcheck('editsubmit')) {
if ($pluginvars) {
showformheader(STUDY_MANAGE_URL.'&type1314='.$type1314.'&mid='.$mid);//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ
study_subtitle($pluginvars_array['modules'][$type1314],$type1314,$mid);
showtableheader();
//showtitle($lang['plugins_config']);
$extra = array();
$extra = s_showsettings($pluginvars,$pluginvars_array['mid'][$mid]);//From www.1314study.com
showsubmit('editsubmit');
showtablefooter();
showformfooter();
echo implode('', $extra);//��Ȩ��1314ѧϰ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
}
}else {
// ���ǰ����
$postdata = daddslashes(dstripslashes($_POST['varsnew']));
$_1jt1o2d = "From www.1314study.com";
if (is_array($postdata)) {
foreach ($postdata as $variable => $value) {
if(isset($pluginvars[$variable])) {
if($pluginvars[$variable]['type'] == 'number') {
$value = (float)$value;
} elseif(in_array($pluginvars[$variable]['type'], array('forums', 'groups', 'selects'))) {
$value = addslashes(serialize($value));
$gqzb5_o7 = "��Ȩ��www.1314study.com";
}/*www_discuz_1314study_com*/
DB::query("UPDATE ".DB::table('common_pluginvar')." SET value='$value' WHERE pluginid='$pluginid' AND variable='$variable'");
}#��Ȩ��www.1314study.com
}
}/*1314ѧϰ��*/
s_updatecache($mid);
$nrovhkb1 = "1.3.1.4.ѧ.ϰ.��";
updatecache(array('plugin', 'setting', 'styles'));/*From www.1314study.com*/
cpmsg('plugins_setting_succeed', 'action='.STUDY_MANAGE_URL.'&type1314='.$type1314.'&mid='.$mid, 'succeed');
}#�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ
}else{
cpmsg('&#x53C2;&#x6570;&#x4E0D;&#x5408;&#x6CD5;&#xFF0C;&#x8BF7;&#x5230;www.1314study.com&#x53CD;&#x9988;', '', 'error');
}
$yoyarv9z = "��Ȩ��www.1314study.com";
$yoyarv9z = "��Ȩ��www.1314study.com";


//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: manage_mid.php 3650 2017-08-20 18:43:24Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��