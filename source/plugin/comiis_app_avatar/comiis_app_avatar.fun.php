<?php
/**
 * 
 * ���׳�Ʒ ������Ʒ
 * ������ƹ����� ��Ȩ���� http://www.Comiis.com
 * רҵ��̳��ҳ���������, ҳ���������, ���ݰ��/����, ������ο���, ��վЧ��ͼ���, ҳ���׼DIV+CSS����, �������С����ҵ��վ���...
 * ����������Ϊ��ҵ�ṩ������վ���衢��վ�ƹ㡢��վ�Ż������򿪷�������ע�ᡢ���������ȷ���
 * һ����ƺͽ������Ϊ��ҵ��������ʺ��Լ��������վ��Ӫƽ̨������޶ȵ�ʹ��ҵ����Ϣʱ�����������̻���
 *
 *   �绰: 0668-8810200
 *   �ֻ�: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * ����ʱ��: ��һ����������09:00-11:00, ����03:00-05:00, ����08:30-10:30(����������Ϣ)
 * ��������û�����Ⱥ: ��Ⱥ83667771 ��Ⱥ83667772 ��Ⱥ83667773 ��Ⱥ110900020 ��Ⱥ110900021 ��Ⱥ70068388 ��Ⱥ110899987
 * 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(file_put_contents($tmpavatar, base64_decode(str_replace($result[1], '', $base64)))){
	list($width, $height, $type, $attr) = getimagesize($tmpavatar);
	$imgtype = array(1 => '.gif', 2 => '.jpg', 3 => '.png');
	$filetype = $imgtype[$type];
	if(!$filetype) $filetype = '.jpg';
	if($width < 10 || $height < 10 || $type == 4){
		@unlink($tmpavatar);
	}
	require_once libfile('class/image');
	$image = new image;
	$tmpavatarbig = './temp/upload'.$_G['uid'].'big'.$filetype;
	$tmpavatarmiddle = './temp/upload'.$_G['uid'].'middle'.$filetype;
	$tmpavatarsmall = './temp/upload'.$_G['uid'].'small'.$filetype;
	$image->Thumb($tmpavatar, $tmpavatarbig, 200, 200, 1);
	$image->Thumb($tmpavatar, $tmpavatarmiddle, 120, 120, 1);
	$image->Thumb($tmpavatar, $tmpavatarsmall, 48, 48, 2);
	loaducenter();
	$tmpavatarbig = $avatarpath.$tmpavatarbig;
	$tmpavatarmiddle = $avatarpath.$tmpavatarmiddle;
	$tmpavatarsmall = $avatarpath.$tmpavatarsmall;
	$extra = '&avatar1='.comiis_app_avatar_byte2hex(file_get_contents($tmpavatarbig)).'&avatar2='.comiis_app_avatar_byte2hex(file_get_contents($tmpavatarmiddle)).'&avatar3='.comiis_app_avatar_byte2hex(file_get_contents($tmpavatarsmall));
	$postdata = uc_api_requestdata('user', 'rectavatar', 'uid='. $_G['uid'], $extra);
	$result = uc_fopen2(UC_API.'/index.php', 500000, $postdata, '', TRUE, UC_IP, 20);
	@unlink($tmpavatar);
	@unlink($tmpavatarbig);
	@unlink($tmpavatarmiddle);
	@unlink($tmpavatarsmall);
	if(empty($space['avatarstatus']) && uc_check_avatar($_G['uid'], 'middle')) {
		C::t('common_member')->update($_G['uid'], array('avatarstatus'=>'1'));
		updatecreditbyaction('setavatar');
		manyoulog('user', $_G['uid'], 'update');
	}
}
function comiis_app_avatar_byte2hex($string){
	$buffer = '';
	$value = unpack('H*', $string);
	$value = str_split($value[1], 2);
	$b = '';
	foreach($value as $k => $v){
		$b .= strtoupper($v);
	}
	return $b;
}