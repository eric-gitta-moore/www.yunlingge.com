<?php
/**
 * 
 * 讯幻网提醒：为保证讯幻网资源的更新维护保障，防止讯幻网首发资源被恶意泛滥，
 *             希望所有下载讯幻网资源的会员不要随意把讯幻网首发资源提供给其他人;
 *             如被发现，将取消讯幻网VIP会员资格，停止一切后期更新支持以及所有补丁BUG等修正服务；
 *          
 * 讯幻网出品 必属精品
 * 讯幻网 全网首发 http://Www.xhkj5.com
 * 官网：www.xhkj5.com (请收藏备用!)
 * 技术支持/更新维护：QQ 154606914
 * 谢谢支持，感谢你对讯幻网的关注和信赖！！！   
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