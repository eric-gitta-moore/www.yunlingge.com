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
class mobileplugin_comiis_app{
	function common() {
		global $_G, $connect_guest;
		if(CURSCRIPT == 'member' && CURMODULE == 'connect' && ($_GET['auth_hash'] || $_G['cookie']['con_auth_hash'])) {
			$connect_guest = array();
			if(!$_GET['auth_hash']) {
				$_GET['auth_hash'] = $_G['cookie']['con_auth_hash'];
			}
			$conopenid = authcode($_GET['auth_hash']);
			$connect_guest = C::t('#qqconnect#common_connect_guest')->fetch($conopenid);
		}
		if(CURSCRIPT == 'home' && CURMODULE == 'spacecp' && $_GET['gid']){
			$_G['comiis_homegid'] = $_GET['gid'];
		}else{
			$_G['comiis_homegid'] = 0;
		}
	}
}
