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

$comiis_app_color_lang = array(
	'02' => '����',
	'66' => '<li>Ĭ��: �ѵ�ǰ��ɫ����Ϊ�ֻ����Ĭ�Ϸ����ɫ</li><li>����: ���õ�ǰ��ɫ�Ƿ񿪷Ÿ��û��л�ʹ��</li>',
	'67' => '���˵��',
	'68' => '��ɫ',
	'69' => 'Ĭ��',
	'70' => '�༭',
	'71' => '����',
	'72' => '��ɫ����',
	'73' => '������ɫ_',
	'74' => '�ۺ�����',
	'75' => '��ɫ��',
	'76' => '������ɫ����Ҫɫ��',
	'77' => 'ҳ�汳��ɫ',
	'78' => '��ɫ��������ɫ',
	'79' => '����ɫ��',
	'80' => '����ɫ��, �����û��ȼ��Լ�������Ҫ��ť��ɫ',
	'81' => '�ر�ɫ��',
	'82' => '�ر���ɫ����, ��Ҫ�����ύ��ť������ɫ',
	'83' => 'ǳɫ����',
	'84' => ', ����ʹ����ɫ',
	'85' => '��ǳɫ����',
	'86' => '��ɫ����',
	'87' => '������ɫ����ǳɫ����',
	'88' => '�������ɫ����ǳɫ����',
	'89' => '�����ر�ɫ����ǳɫ����',
	'90' => ', ��Ҫ��������������ʾ����ʹ��',
	'91' => '�Ա���ͼ����ɫ',
	'92' => '�Ա�Ůͼ����ɫ',
	'93' => '��ʾ��ɫ',
	'94' => '��ʾ��ɫ����Ҫ����ɾ�����ر�����������ɫʹ��',
	'95' => '������ɫ����',
	'96' => 'Ĭ��������ɫ',
	'97' => '������ɫ����������ɫ',
	'98' => '������ɫ����������ɫ, ��Ҫ����ҳ�泬��������С��Χʹ��',
	'99' => '����������ɫ',
	'100' => '����������ɫ, ��Ҫ�����ر�������ʾʹ��',
	'101' => '��ͨ����',
	'102' => 'ǳɫ����',
	'103' => '��ǳɫ����',
	'104' => '��ǳɫ����',
	'105' => ', ���ݴ��丽����ɫ',
	'106' => '��ɫ����',
	'107' => '��ɫ����, ���ڰ�ť������ɫ�����µ�������ɫ',
	'108' => '�ȵ��������',
	'109' => '�ȵ��������, �����ȵ�����������ɫ',
	'110' => '��¼ҳ�����, һ�㲻�����޸�',
	'111' => 'QQ��¼ͼ����ɫ',
	'112' => '΢����¼ͼ����ɫ',
	'113' => '΢�ŵ�¼ͼ����ɫ',
	'114' => '�߿���ɫ����',
	'115' => '����߿���ɫ',
	'116' => '������������ģ��߿���ɫ',
	'117' => '���ñ߿���ɫ',
	'118' => '������ɫ����ǳɫ�����߿���ɫ',
	'119' => '�������������ǳɫ�����߿���ɫ',
	'120' => ', ��Ҫ��������������ʾ����ʹ��',
	'121' => '����CSS',
	'122' => '���CSS���и��Ի���ʽ����',
	'123' => '�������',
	'201' => '���¼�ٽ�������',
	'202' => '���³ɹ�',
	'203' => '���³���',
);
$comiis_app_color_install_lang = "
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('1','1','������','1','1','','#53bcf5','#f3f3f3','#53bcf5','#fcad30','#99db5e','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#507daf','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('2','2','19¥������','0','1','','#A8C500','#f3f3f3','#A8C500','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#334f67','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('3','3','19¥APP��','0','1','','#FF705E','#f3f3f3','#FF705E','#FFAE0E','#FF705E','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF6600','#FFAE0E','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF705E','#5cb3eb','#f66c75','#8fd353','#efefef','#FF705E','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('4','4','С�׳�','0','1','','#FF6600','#f3f3f3','#FF6600','#FFB901','#FF6600','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#90CBE3','#F69595','#dd0000','#333333','#FF6600','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF6600','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('5','5','360������','0','1','','#00C5C7','#f3f3f3','#00C5C7','#F7AD3C','#00C5C7','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#00C5C7','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('6','6','վ���','0','1','.comiis_foot_memu li.f_0, .comiis_foot_memu li.f_0 a {color:#FFB900 !important;}\r\n.view_one .comiis_bianlun_t div.f_a span, .view_one .comiis_bianlun_t div.f_a em {color:#FF705E !important;}','#FFB900','#f3f3f3','#FFB900','#FF705E','#FFB900','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF705E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FFB900','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('7','7','ĸӤ��','0','1','','#FF5073','#f3f3f3','#FF5073','#FFB901','#FF5073','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#FF5073','#333333','#FF496D','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF5073','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('8','8','����ɫ','0','1','','#A09989','#f3f3f3','#A09989','#F7AD3C','#A09989','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#97311c','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#A09989','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('9','9','������','0','1','','#6C9BD3','#f3f3f3','#6C9BD3','#F7AD3C','#6C9BD3','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#51749A','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('11','10','������','0','1','','#43BE4A','#f3f3f3','#43BE4A','#FFB901','#43BE4A','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#43BE4A','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('12','11','������','0','1','','#5C687E','#f3f3f3','#5C687E','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#5C687E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('13','12','ͷ����','0','1','','#D43D3D','#f3f3f3','#D43D3D','#FEBA00','#D43D3D','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#D43D3D','#333333','#5C687E','#FEBA00','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#D43D3D','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');";
