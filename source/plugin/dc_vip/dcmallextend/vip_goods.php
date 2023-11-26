<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class vip_goods extends extend_goods{
	public function __construct($goods){
		$this->identify = 'dc_vip';
		parent::__construct($goods);
	}
	public function view(){
		$extdata = dunserialize($this->goods['extdata']);
		$return = '<div>'.$this->_lang['mall_yxq'].'<strong style="color:#FF0000; font-size:16px;">'.$extdata['yxq'].'</strong> '.$this->_lang['tian'].'</div>';
		$return .= '<div>'.$this->_lang['goods_maxbuy'].'<strong style="color:#FF0000; font-size:16px;">'.$this->goods['maxbuy'].'</strong> '.$this->_lang['goods_jian'].'</div>';
		$return .= '<div>'.$this->_lang['goods_allow'].($this->goods['buytimes']?$this->_lang['goods_buy'].'<strong style="color:#FF6600; font-size:16px;">'.$this->goods['buytimes'].'</strong> '.$this->_lang['goods_ci']:$this->_lang['goods_nolimit']).'</div>';
		$return .= parent::view();
		return $return;
	}
	public function paycheck(){
		$extdata = dunserialize($this->goods['extdata']);
		return array('yxq'=>$extdata['yxq']);
	}
	
	public function finish($order){
		global $_G;
		C::t('#dc_mall#dc_mall_orders')->update($order['id'],array('status'=>1,'finishtime'=>TIMESTAMP));
		$vip = C::t('#dc_vip#dc_vip')->fetch($order['uid']);
		$data = array();
		if(empty($vip)){
			$data['exptime'] = strtotime('+'.$order['extdata']['yxq'].' day',strtotime(dgmdate(TIMESTAMP, 'd')))+86399;
			if($data['exptime']<10000000||$data['exptime']>2147454847)$data['exptime'] = '2147454847';
			if($order['extdata']['yxq']>=365){
				$data['isyear']=1;
				$data['yearend']=$data['exptime'];
			}
			$data['jointime'] = TIMESTAMP;
			$data['uptime'] = TIMESTAMP;
			$data['growth'] = 0;
			$data['uid'] = $order['uid'];
			$vgid = C::t('#dc_vip#dc_vip_group')->getvgid($data['growth']);
			$data['vgid'] = $vgid['id'];
			C::t('#dc_vip#dc_vip')->insert($data);
			$user = getuserbyuid($order['uid']);
			notification_add($order['uid'], 'system', $_G['cache']['plugin']['dc_vip']['openmsg'], array('uid' => $order['uid'], 'username' => $user['username']), 1);
		}else{
			if($vip['exptime']>TIMESTAMP){
				$data['exptime'] = strtotime('+'.$order['extdata']['yxq'].' day',$vip['exptime']);
			}else{
				$data['exptime'] = strtotime('+'.$order['extdata']['yxq'].' day',strtotime(dgmdate(TIMESTAMP, 'd')))+86399;
			}
			if($data['exptime']<10000000||$data['exptime']>2147454847)$data['exptime'] = '2147454847';
			$nowtime = strtotime('+12 month',strtotime(dgmdate(TIMESTAMP, 'd')));
			if($data['exptime']>$nowtime){
				$data['isyear']=1;
				$data['yearend']=$data['exptime'];
			}
			C::t('#dc_vip#dc_vip')->update($order['uid'],$data);
			if($vip['exptime']<TIMESTAMP){
				$user = getuserbyuid($order['uid']);
				notification_add($order['uid'], 'system', $_G['cache']['plugin']['dc_vip']['openmsg'], array('uid' => $order['uid'], 'username' => $user['username']), 1);
			}
		}
	}
}
?>