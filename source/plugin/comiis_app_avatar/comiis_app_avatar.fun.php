<?php
/**
 * 
 * 克米出品 必属精品
 * 克米设计工作室 版权所有 http://www.Comiis.com
 * 专业论坛首页及风格制作, 页面设计美化, 数据搬家/升级, 程序二次开发, 网站效果图设计, 页面标准DIV+CSS生成, 各类大中小型企业网站设计...
 * 我们致力于为企业提供优质网站建设、网站推广、网站优化、程序开发、域名注册、虚拟主机等服务，
 * 一流设计和解决方案为企业量身打造适合自己需求的网站运营平台，最大限度地使企业在信息时代稳握无限商机。
 *
 *   电话: 0668-8810200
 *   手机: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作时间: 周一到周五早上09:00-11:00, 下午03:00-05:00, 晚上08:30-10:30(周六、日休息)
 * 克米设计用户交流群: ①群83667771 ②群83667772 ③群83667773 ④群110900020 ⑤群110900021 ⑥群70068388 ⑦群110899987
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