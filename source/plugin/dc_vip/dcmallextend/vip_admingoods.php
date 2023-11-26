<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class vip_admingoods extends extend_admingoods{
	public function __construct($goods){
		$this->identify = 'dc_vip';
		parent::__construct($goods);
	}
	public function view(){
		$this->goods['extdata'] = dunserialize($this->goods['extdata']);
		$str = '
<tr>
<th>'.$this->_lang['mall_yxq'].'<font color="#FF0000">*</font></th>
<td colspan="2"><input name="txt_yxq" id="txt_yxq" value="'.$this->goods['extdata']['yxq'].'" class="p_fre" type="text">'.$this->_lang['mall_unit'].'</td>
</tr>
<tr>
<th>'.$this->_lang['mall_maxbuytimes'].'</th>
<td colspan="2"><input name="txt_buytimes" id="txt_buytimes" value="'.$this->goods['buytimes'].'" class="p_fre" type="text">'.$this->_lang['mall_okcount'].'</td>
</tr>
<tr>
<th>'.$this->_lang['mall_kucun'].'</th>
<td colspan="2"><input name="txt_count" id="txt_count" value="'.$this->goods['count'].'" class="p_fre" type="text"></td>
</tr>';
		return $str;
	}
	public function check(){
		$count = dintval($_GET['txt_count']);
		$buytimes = dintval($_GET['txt_buytimes']);
		return array('count'=>$count,'maxbuy'=>1,'buytimes'=>$buytimes);
	}
	public function finish($gid){
		$yxq = dintval($_GET['txt_yxq']);
		$extdata = array(
			'yxq'=>$yxq,
		);
		$data['extdata'] = serialize($extdata);
		C::t('#dc_mall#dc_mall_goods')->update($gid,$data);
	}
}
?>