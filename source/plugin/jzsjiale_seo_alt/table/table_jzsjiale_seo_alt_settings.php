<?php
/**
 * 
 * Ѷ�������ѣ�Ϊ��֤Ѷ������Դ�ĸ���ά�����ϣ���ֹѶ�����׷���Դ�����ⷺ�ģ�
 *             ϣ����������Ѷ������Դ�Ļ�Ա��Ҫ�����Ѷ�����׷���Դ�ṩ��������;
 *             �类���֣���ȡ��Ѷ����VIP��Ա�ʸ�ֹͣһ�к��ڸ���֧���Լ����в���BUG����������
 *          
 * Ѷ������Ʒ ������Ʒ
 * Ѷ���� ȫ���׷� http://Www.xhkj5.com
 * ������www.xhkj5.com (���ղر���!)
 * ����֧��/����ά����QQ 154606914
 * лл֧�֣���л���Ѷ�����Ĺ�ע������������   
 * 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_jzsjiale_seo_alt_settings extends discuz_table
{
	public function __construct() {
		$this->_table = 'jzsjiale_seo_alt_settings';
		$this->_pk    = 'id';
		parent::__construct();
	}
	public function getone(){
		return DB::fetch_first('SELECT * FROM %t ORDER BY id DESC limit 0,1',array($this->_table));
		
	}
	
	public function getall(){
		return DB::fetch_all('SELECT * FROM %t ORDER BY id DESC',array($this->_table));
	
	}
}
//WWW.xhkj5.com
?>