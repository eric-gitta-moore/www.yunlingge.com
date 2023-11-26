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
class mobileplugin_comiis_app_avatar{
	function global_footer_mobile(){
		global $_G;
		if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'profile' & $_GET['mycenter'] == '1'){
			$__FORMHASH = FORMHASH;
			loadcache('plugin');
			$comiis_app_avatar_add_css = strip_tags($_G['cache']['plugin']['comiis_app_avatar']['css']);
			$return = <<<EOF
<style>
.comiis_app_avflexktxo {display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;}.app_avflex {-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;}.comiis_app_avloading {background-color:#000;width:28px;padding:10px;border-radius:5px;filter:alpha(opacity=85);-moz-opacity:0.85;-khtml-opacity:0.85;opacity:0.85;}.comiis_PhotoClip{position:fixed;width:100%;height:100%;overflow:hidden;top:0;left:0;z-index:200;background:{$_G['cache']['plugin']['comiis_app_avatar']['bgcolor']};}#comiis_Clip_file_zgqi{display:none}#clipArea{height:100%;}.comiis_clip_load {position:fixed;width:100%;height:100%;overflow:hidden;top:0;left:0;z-index:201;background:rgba(0,0,0,0.5);}.comiis_clip_load img{position:fixed;top:50%;left:50%;z-index:202;margin:-20px 0 0 -20px;}.comiis_clip_topkey {position:fixed;width:100%;height:50px;line-height:50px;text-align:center;font-size:16px;color:{$_G['cache']['plugin']['comiis_app_avatar']['color']};overflow:hidden;top:0;left:0;z-index:201;background:{$_G['cache']['plugin']['comiis_app_avatar']['hbcolor']};}.comiis_clip_topkey button {background:{$_G['cache']['plugin']['comiis_app_avatar']['save_bgcolor']};border:none !important;color:{$_G['cache']['plugin']['comiis_app_avatar']['color']};height:30px;margin:10px;padding:0 15px;outline:none;border-radius:1.5px;}.comiis_clip_topkey button.kmqx {background:{$_G['cache']['plugin']['comiis_app_avatar']['close_bgcolor']};}.comiis_clip_bottomkeyvqpu button {background:none;border:none !important;height:40px;margin:5px;outline:none;}.comiis_clip_bottomkeyvqpu button img {height:28px;margin-top:6px;}.comiis_clip_bottomkeyvqpu {position:fixed;width:100%;height:52px;overflow:hidden;bottom:0;left:0;z-index:201;background:{$_G['cache']['plugin']['comiis_app_avatar']['hbcolor']};}.comiis_clip_bottomkeyvqpu button {background:none;border:none !important;height:40px;line-height:40px;margin:5px;outline:none;}.comiis_clip_bottomkeyvqpu button i {font-size:28px;}{$comiis_app_avatar_add_css}
</style>
<script src="source/plugin/comiis_app_avatar/style/iscroll-zoom.js" type="text/javascript"></script>
<script src="source/plugin/comiis_app_avatar/style/hammer.js" type="text/javascript"></script>
<script src="source/plugin/comiis_app_avatar/style/lrz.all.bundle.js" type="text/javascript"></script>
<script src="source/plugin/comiis_app_avatar/style/jquery.photoClip.min.js" type="text/javascript"></script>
<div class="comiis_clip_load" style="display:none">
<img src="source/plugin/comiis_app_avatar/style/imageloading.gif" class="comiis_app_avloading">
</div>
<input type="file" id="comiis_Clip_file_zgqi" style="display:none;">
<div class="comiis_PhotoClip" style="display:none">
<div class="comiis_clip_topkey">
<div class="comiis_app_avflexktxo">				
<button id="comiis_closeBtn" class="kmqx">{$_G['cache']['plugin']['comiis_app_avatar']['close']}</button>
<div class="app_avflex"> </div>
<button id="comiis_clipBtn">{$_G['cache']['plugin']['comiis_app_avatar']['save']}</button>
</div>
</div>	
<div class="comiis_clip_bottomkeyvqpu">
<div class="comiis_app_avflexktxo">
<button id="comiis_rightBtn" class="app_avflex"><img src="source/plugin/comiis_app_avatar/style/comiis_rbtn.png"></button>
<button id="comiis_leftBtn" class="app_avflex"><img src="source/plugin/comiis_app_avatar/style/comiis_lbtn.png"></button>	
<button id="comiis_narrowBtn" class="app_avflex"><img src="source/plugin/comiis_app_avatar/style/comiis_xbtn.png"></button>			
<button id="comiis_enlargeBtn" class="app_avflex"><img src="source/plugin/comiis_app_avatar/style/comiis_dbtn.png"></button>				
</div>		
</div>	
<div id="clipArea"></div>
<script>
var comiis_app_avatar_imgaiig = $('.comiis_edit_avatar,.avatar_m');
var Comiis_clipAreawguq = new Comiis.PhotoClip("#clipArea", {
size: [200, 200],
outputSize: [200, 200],
file: "#comiis_Clip_file_zgqi",
ok: "#comiis_clipBtn",
loadStart: function() {
$('.comiis_clip_load').css('display','block');
},
loadComplete: function() {
$('.comiis_clip_load').css('display','none');
$('.comiis_PhotoClip').css('display','block');
},
loadError: function() {
$('.comiis_clip_load').css('display','none');
popup.open('{$_G['cache']['plugin']['comiis_app_avatar']['error']}', 'alert');
},
clipFinish: function(dataURL) {
Comiis_Touch_on = 0;
$.ajax({
url: 'plugin.php?id=comiis_app_avatar&inajax=1&mobile=2', 
data: {str: dataURL, formhash:'{$__FORMHASH}', comiis_submit:'yes'}, 
type: 'post', 
dataType: 'html', 
}).success(function(s) {
comiis_app_avatar_imgaiig.find('img').attr('src', dataURL);
$('.comiis_PhotoClip').css('display','none');
popup.open('{$_G['cache']['plugin']['comiis_app_avatar']['yes']}', 'alert');
setTimeout(function() {
	location.reload();
},1500);
});
}
});
comiis_app_avatar_imgaiig.click(function(){
Comiis_Touch_on = 0;
$('#comiis_Clip_file_zgqi').click();
});
$('#comiis_closeBtn').click(function(){
Comiis_Touch_on = 1;
$('.comiis_PhotoClip').css('display','none');
});
</script>
</div>
EOF;
			return $return;
		}
	}
}