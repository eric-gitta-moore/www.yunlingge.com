<?php
/**
 * 
 * ��-��-�����ѣ�Ϊ��֤�ݸ�����Դ�ĸ���ά�����ϣ���ֹ�ݸ����׷���Դ�����ⷺ�ģ�
 *             ϣ���������زݸ�����Դ�Ļ�Ա��Ҫ����Ѳݸ����׷���Դ�ṩ��������;
 *             �类���֣���ȡ���ݸ���VIP��Ա�ʸ�ֹͣһ�к��ڸ���֧���Լ����в���BUG����������
 *          
 * ��.��.�ɳ�Ʒ ������Ʒ
 * �ݸ��� ȫ���׷� https://Www.Caogen8.co
 * ������www.Cgzz8.com (���ղر���!)
 * ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 * ����֧��/����ά����QQ 2575 163778
 * лл֧�֣���л���.�ݸ���.�Ĺ�ע������������   
 * 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(is_array($load_var) && count($load_var)){
	$temp_var = array();
	foreach($load_var as $v){
		if(preg_match('/^[a-z0-9_\.]+$/i', $v) && !empty($GLOBALS[$v])){
			$temp_var[$v] = $GLOBALS[$v];
		}
	}
	if(is_array($temp_var) && count($temp_var)){
		extract($temp_var);
		unset($temp_var);
	}
}