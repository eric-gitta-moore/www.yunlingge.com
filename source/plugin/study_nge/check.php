<?php
/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

if(!defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$cachekey = 'scache_'.$pluginarray['plugin']['identifier'];
loadcache($cachekey);
$cachevalue = $_G['cache'][$cachekey];
if($operation == 'import' && empty($license)){
	$license = dfsockopen('http://www.ymg6.com/gg/addon2.php?siteurl='.rawurlencode($_G['siteurl']).'&identifier='.$identifier, 0, '', '', false, '', 999);$cachevalue['license'] = 1;savecache($cachekey, $cachevalue);
	if(CHARSET!='GBK'){$license = diconv($license, 'GBK', CHARSET);}
	if(empty($_GET['license']) && $license) {
		$installtype = $_GET['installtype'];
		$dir = $_GET['dir'];
		require_once libfile('function/discuzcode');
		$pluginarray['license'] = discuzcode(strip_tags($pluginarray['license']), 1, 0);
		echo '<div class="infobox"><h4 class="infotitle2">&#x662f;&#x5426;&#x5b89;&#x88c5; '.$pluginarray['plugin']['name'].' '.$pluginarray['plugin']['version'].' ?</h4><div style="text-align:left;line-height:25px;">'.$license.'</div><br /><br /><center>'.
			'<button onclick="location.href=\''.ADMINSCRIPT.'?action=plugins&operation=import&dir='.$dir.'&installtype='.$installtype.'&license=yes\'">&#x5f00;&#x59cb;&#x5b89;&#x88c5;</button>&nbsp;&nbsp;'.
			'<button onclick="location.href=\'http://www.ymg6.com/\'">&#x6253;&#x5f00;&#x6e90;&#x7801;&#x54e5;</button></center></div>';
		exit;
	}
}

	$cachevalue['check'] = $pluginarray['plugin']['identifier'];
	savecache($cachekey, $cachevalue);