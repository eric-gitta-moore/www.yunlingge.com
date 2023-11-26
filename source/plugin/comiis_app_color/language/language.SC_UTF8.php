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

$comiis_app_color_lang = array(
	'02' => '设置',
	'66' => '<li>默认: 把当前配色设置为手机版的默认风格颜色</li><li>可用: 设置当前配色是否开放给用户切换使用</li>',
	'67' => '相关说明',
	'68' => '配色',
	'69' => '默认',
	'70' => '编辑',
	'71' => '增加',
	'72' => '配色名称',
	'73' => '新增配色_',
	'74' => '综合设置',
	'75' => '主色调',
	'76' => '设置配色的主要色调',
	'77' => '页面背景色',
	'78' => '主色调文字颜色',
	'79' => '高亮色调',
	'80' => '高亮色调, 用于用户等级以及其他次要按钮配色',
	'81' => '特别色调',
	'82' => '特别颜色背景, 主要用于提交按钮背景配色',
	'83' => '浅色背景',
	'84' => ', 辅助使用颜色',
	'85' => '灰浅色背景',
	'86' => '白色背景',
	'87' => '搭配主色调的浅色背景',
	'88' => '搭配高亮色调的浅色背景',
	'89' => '搭配特别色调的浅色背景',
	'90' => ', 主要用于特殊主题提示内容使用',
	'91' => '性别男图标颜色',
	'92' => '性别女图标颜色',
	'93' => '警示颜色',
	'94' => '警示颜色，主要用于删除或特别提醒类型配色使用',
	'95' => '文字颜色设置',
	'96' => '默认文字颜色',
	'97' => '搭配主色调的文字颜色',
	'98' => '搭配主色调的文字颜色, 主要用于页面超链接文字小范围使用',
	'99' => '高亮文字颜色',
	'100' => '高亮文字颜色, 主要用于特别内容提示使用',
	'101' => '普通文字',
	'102' => '浅色文字',
	'103' => '中浅色文字',
	'104' => '最浅色文字',
	'105' => ', 内容搭配附加颜色',
	'106' => '白色文字',
	'107' => '白色文字, 用于按钮或者深色背景下的文字配色',
	'108' => '热点标题文字',
	'109' => '热点标题文字, 用于热点标题的文字配色',
	'110' => '登录页面相关, 一般不建议修改',
	'111' => 'QQ登录图标颜色',
	'112' => '微博登录图标颜色',
	'113' => '微信登录图标颜色',
	'114' => '边框颜色设置',
	'115' => '常规边框颜色',
	'116' => '帖子隐藏内容模块边框颜色',
	'117' => '引用边框颜色',
	'118' => '搭配主色调的浅色背景边框颜色',
	'119' => '搭配高亮背景的浅色背景边框颜色',
	'120' => ', 主要用于特殊主题提示内容使用',
	'121' => '附加CSS',
	'122' => '添加CSS进行个性化样式设置',
	'123' => '设置完成',
	'201' => '请登录再进行设置',
	'202' => '更新成功',
	'203' => '更新出错',
);
$comiis_app_color_install_lang = "
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('1','1','西子蓝','1','1','','#53bcf5','#f3f3f3','#53bcf5','#fcad30','#99db5e','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#507daf','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('2','2','19楼经典绿','0','1','','#A8C500','#f3f3f3','#A8C500','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#334f67','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('3','3','19楼APP红','0','1','','#FF705E','#f3f3f3','#FF705E','#FFAE0E','#FF705E','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF6600','#FFAE0E','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF705E','#5cb3eb','#f66c75','#8fd353','#efefef','#FF705E','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('4','4','小米橙','0','1','','#FF6600','#f3f3f3','#FF6600','#FFB901','#FF6600','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#90CBE3','#F69595','#dd0000','#333333','#FF6600','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF6600','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('5','5','360淡雅青','0','1','','#00C5C7','#f3f3f3','#00C5C7','#F7AD3C','#00C5C7','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#00C5C7','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('6','6','站酷黄','0','1','.comiis_foot_memu li.f_0, .comiis_foot_memu li.f_0 a {color:#FFB900 !important;}\r\n.view_one .comiis_bianlun_t div.f_a span, .view_one .comiis_bianlun_t div.f_a em {color:#FF705E !important;}','#FFB900','#f3f3f3','#FFB900','#FF705E','#FFB900','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF705E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FFB900','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('7','7','母婴粉','0','1','','#FF5073','#f3f3f3','#FF5073','#FFB901','#FF5073','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#FF5073','#333333','#FF496D','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF5073','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('8','8','咖啡色','0','1','','#A09989','#f3f3f3','#A09989','#F7AD3C','#A09989','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#97311c','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#A09989','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('9','9','淡雅蓝','0','1','','#6C9BD3','#f3f3f3','#6C9BD3','#F7AD3C','#6C9BD3','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#51749A','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('11','10','清新绿','0','1','','#43BE4A','#f3f3f3','#43BE4A','#FFB901','#43BE4A','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#43BE4A','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('12','11','商务蓝','0','1','','#5C687E','#f3f3f3','#5C687E','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#5C687E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('13','12','头条红','0','1','','#D43D3D','#f3f3f3','#D43D3D','#FEBA00','#D43D3D','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#D43D3D','#333333','#5C687E','#FEBA00','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#D43D3D','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');";
