<?php
/**
 * 
 * 克米出品 必屬精品
 * 克米設計工作室 版權所有 http://www.Comiis.com
 * 專業論壇首頁及風格制作, 頁面設計美化, 數據搬家/升級, 程序二次開發, 網站效果圖設計, 頁面標準DIV+CSS生成, 各類大中小型企業網站設計...
 * 我們致力于為企業提供優質網站建設、網站推廣、網站優化、程序開發、域名注冊、虛擬主機等服務，
 * 一流設計和解決方案為企業量身打造適合自己需求的網站運營平台，最大限度地使企業在信息時代穩握無限商機。
 *
 *   電話: 0668-8810200
 *   手機: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * 工作時間: 周一到周五早上09:00-11:00, 下午03:00-05:00, 晚上08:30-10:30(周六、日休息)
 * 克米設計用戶交流群: ヾ群83667771 ゝ群83667772 ゞ群83667773 々群110900020 ぁ群110900021 あ群70068388 ぃ群110899987
 * 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$comiis_app_find_lang = array(
	'01' => '新發現名稱',
	'02' => '刪除',
	'03' => '新欄目名稱',
	'04' => '注意: 請把欄目圖標上傳到 <font color=red>source/plugin/comiis_app_find/ico/</font> 目錄下，然後在下方圖標輸入處直接輸入圖標文件名即可',
	'05' => '使用說明',
	'06' => '圖標',
	'07' => '簡要說明',
	'08' => '首頁顯示',
	'09' => '四格橫排樣式',
	'10' => '單列豎排樣式',
	'11' => '增加發現',
	'12' => '增加欄目',
	'13' => '更新成功',
);
$comiis_app_find_install_lang = "
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('18','10','11','查快遞','http://m.kuaidi100.com','001.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('17','10','12','查天氣','http://mse.360.cn/service/weather.html','036.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('16','10','9','114電話','#','072.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('15','10','4','積分商城','#','084.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('14','10','3','活動','#','041.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('13','10','2','新聞','#','033.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('12','10','1','簽到','#','068.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('11','0','2','熱點推薦','','','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('10','0','1','生活服務','','','0','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('19','10','5','房屋信息','#','087.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('20','10','7','招聘求職','#','085.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('21','10','6','二手閑置','#','091.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('22','10','8','聚劃算','http://m.zhe800.com/m/list/baoyou?url_name=baoyou&category_name=9%E5%9D%979%E5%8C%85%E9%82%AE','054.png','0','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('23','10','10','查違章','http://chaweizhang.eclicks.cn/webapp/index?appid=10&sid=4hQKAQpRC5QE','035.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('24','11','15','隨手拍','#','080.png','1','隨手記錄生活點滴');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('25','11','13','找對象','#','097.png','1','七夕派對, 跟單身Say No!');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('26','11','16','汽車','#','035.png','1','最全面的汽車資訊');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('27','11','17','美食廚房','#','006.png','1','尋找大街小巷的美食');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('28','11','14','情感','#','053.png','1','情感小樹洞');
";