<?php
/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$license = dfsockopen('http://www.ymg6.com/gg/addon.php?siteurl='.rawurlencode($_G['siteurl']).'&identifier='.$identifier, 0, '', '', false, '', 999);
echo $license ;
?>
