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
 * 克米設計用戶交流群: 群83667771 群83667772 群83667773 群110900020 群110900021 群70068388 群110899987
 * 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$comiis_app_color_lang = array(
	'02' => '設置',
	'66' => '<li>默認: 把當前配色設置為手機版的默認風格顏色</li><li>可用: 設置當前配色是否開放給用戶切換使用</li>',
	'67' => '相關說明',
	'68' => '配色',
	'69' => '默認',
	'70' => '編輯',
	'71' => '增加',
	'72' => '配色名稱',
	'73' => '新增配色_',
	'74' => '綜合設置',
	'75' => '主色調',
	'76' => '設置配色的主要色調',
	'77' => '頁面背景色',
	'78' => '主色調文字顏色',
	'79' => '高亮色調',
	'80' => '高亮色調, 用于用戶等級以及其他次要按鈕配色',
	'81' => '特別色調',
	'82' => '特別顏色背景, 主要用于提交按鈕背景配色',
	'83' => '淺色背景',
	'84' => ', 輔助使用顏色',
	'85' => '灰淺色背景',
	'86' => '白色背景',
	'87' => '搭配主色調的淺色背景',
	'88' => '搭配高亮色調的淺色背景',
	'89' => '搭配特別色調的淺色背景',
	'90' => ', 主要用于特殊主題提示內容使用',
	'91' => '性別男圖標顏色',
	'92' => '性別女圖標顏色',
	'93' => '警示顏色',
	'94' => '警示顏色，主要用于刪除或特別提醒類型配色使用',
	'95' => '文字顏色設置',
	'96' => '默認文字顏色',
	'97' => '搭配主色調的文字顏色',
	'98' => '搭配主色調的文字顏色, 主要用于頁面超鏈接文字小範圍使用',
	'99' => '高亮文字顏色',
	'100' => '高亮文字顏色, 主要用于特別內容提示使用',
	'101' => '普通文字',
	'102' => '淺色文字',
	'103' => '中淺色文字',
	'104' => '最淺色文字',
	'105' => ', 內容搭配附加顏色',
	'106' => '白色文字',
	'107' => '白色文字, 用于按鈕或者深色背景下的文字配色',
	'108' => '熱點標題文字',
	'109' => '熱點標題文字, 用于熱點標題的文字配色',
	'110' => '登錄頁面相關, 一般不建議修改',
	'111' => 'QQ登錄圖標顏色',
	'112' => '微博登錄圖標顏色',
	'113' => '微信登錄圖標顏色',
	'114' => '邊框顏色設置',
	'115' => '常規邊框顏色',
	'116' => '帖子隱藏內容模塊邊框顏色',
	'117' => '引用邊框顏色',
	'118' => '搭配主色調的淺色背景邊框顏色',
	'119' => '搭配高亮背景的淺色背景邊框顏色',
	'120' => ', 主要用于特殊主題提示內容使用',
	'121' => '附加CSS',
	'122' => '添加CSS進行個性化樣式設置',
	'123' => '設置完成',
	'201' => '請登錄再進行設置',
	'202' => '更新成功',
	'203' => '更新出錯',
);
$comiis_app_color_install_lang = "
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('1','1','西子藍','1','1','','#53bcf5','#f3f3f3','#53bcf5','#fcad30','#99db5e','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#507daf','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('2','2','19樓經典綠','0','1','','#A8C500','#f3f3f3','#A8C500','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#334f67','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('3','3','19樓APP紅','0','1','','#FF705E','#f3f3f3','#FF705E','#FFAE0E','#FF705E','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF6600','#FFAE0E','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF705E','#5cb3eb','#f66c75','#8fd353','#efefef','#FF705E','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('4','4','小米橙','0','1','','#FF6600','#f3f3f3','#FF6600','#FFB901','#FF6600','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#90CBE3','#F69595','#dd0000','#333333','#FF6600','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF6600','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('5','5','360淡雅青','0','1','','#00C5C7','#f3f3f3','#00C5C7','#F7AD3C','#00C5C7','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#00C5C7','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('6','6','站酷黃','0','1','.comiis_foot_memu li.f_0, .comiis_foot_memu li.f_0 a {color:#FFB900 !important;}\r\n.view_one .comiis_bianlun_t div.f_a span, .view_one .comiis_bianlun_t div.f_a em {color:#FF705E !important;}','#FFB900','#f3f3f3','#FFB900','#FF705E','#FFB900','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF705E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FFB900','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('7','7','母嬰粉','0','1','','#FF5073','#f3f3f3','#FF5073','#FFB901','#FF5073','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#FF5073','#333333','#FF496D','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF5073','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('8','8','咖啡色','0','1','','#A09989','#f3f3f3','#A09989','#F7AD3C','#A09989','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#97311c','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#A09989','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('9','9','淡雅藍','0','1','','#6C9BD3','#f3f3f3','#6C9BD3','#F7AD3C','#6C9BD3','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#51749A','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('11','10','清新綠','0','1','','#43BE4A','#f3f3f3','#43BE4A','#FFB901','#43BE4A','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#43BE4A','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('12','11','商務藍','0','1','','#5C687E','#f3f3f3','#5C687E','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#5C687E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('13','12','頭條紅','0','1','','#D43D3D','#f3f3f3','#D43D3D','#FEBA00','#D43D3D','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#D43D3D','#333333','#5C687E','#FEBA00','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#D43D3D','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');";
