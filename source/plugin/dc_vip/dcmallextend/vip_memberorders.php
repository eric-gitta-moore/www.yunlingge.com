<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class vip_memberorders extends extend_memberorders{
	public function __construct($order){
		$this->identify = 'dc_vip';
		parent::__construct($order);
	}
	public function view(){
		$str = '
	<table width="100%" cellpadding="0" cellspacing="0" class="orderinfo">
<tr>
<th style="width:80px;">'.$this->_lang['vipyxq'].'</th>
<td>'.$this->order['extdata']['yxq'].$this->_lang['tian'].'</td>
</tr>';
$str .= '</table>';
		return $str;
	}
}
?>