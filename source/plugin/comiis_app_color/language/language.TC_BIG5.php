<?php
/**
 * 
 * �J�̥X�~ ���ݺ�~
 * �J�̳]�p�u�@�� ���v�Ҧ� http://www.Comiis.com
 * �M�~�׾­����έ����@, �����]�p����, �ƾڷh�a/�ɯ�, �{�ǤG���}�o, �����ĪG�ϳ]�p, �����з�DIV+CSS�ͦ�, �U���j���p�����~�����]�p...
 * �ڭ̭P�O�_�����~�����u������س]�B�������s�B�����u�ơB�{�Ƕ}�o�B��W�`�U�B�����D�����A�ȡA
 * �@�y�]�p�M�ѨM��׬����~�q�����y�A�X�ۤv�ݨD�������B�祭�x�A�̤j���צa�ϥ��~�b�H���ɥNí���L���Ӿ��C
 *
 *   �q��: 0668-8810200
 *   ���: 13450110120  15813025137
 *    Q Q: 21400445  8821775  11012081  327460889
 * E-mail: ceo@comiis.com
 *
 * �u�@�ɶ�: �P�@��P�����W09:00-11:00, �U��03:00-05:00, �ߤW08:30-10:30(�P���B���)
 * �J�̳]�p�Τ��y�s: ơ�s83667771 Ƣ�s83667772 ƣ�s83667773 Ƥ�s110900020 ƥ�s110900021 Ʀ�s70068388 Ƨ�s110899987
 * 
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$comiis_app_color_lang = array(
	'02' => '�]�m',
	'66' => '<li>�q�{: ���e�t��]�m����������q�{�����C��</li><li>�i��: �]�m��e�t��O�_�}�񵹥Τ�����ϥ�</li>',
	'67' => '��������',
	'68' => '�t��',
	'69' => '�q�{',
	'70' => '�s��',
	'71' => '�W�[',
	'72' => '�t��W��',
	'73' => '�s�W�t��_',
	'74' => '��X�]�m',
	'75' => '�D���',
	'76' => '�]�m�t�⪺�D�n���',
	'77' => '�����I����',
	'78' => '�D��դ�r�C��',
	'79' => '���G���',
	'80' => '���G���, �Τ_�Τᵥ�ťH�Ψ�L���n���s�t��',
	'81' => '�S�O���',
	'82' => '�S�O�C��I��, �D�n�Τ_������s�I���t��',
	'83' => '�L��I��',
	'84' => ', ���U�ϥ��C��',
	'85' => '�ǲL��I��',
	'86' => '�զ�I��',
	'87' => '�f�t�D��ժ��L��I��',
	'88' => '�f�t���G��ժ��L��I��',
	'89' => '�f�t�S�O��ժ��L��I��',
	'90' => ', �D�n�Τ_�S��D�D���ܤ��e�ϥ�',
	'91' => '�ʧO�k�ϼ��C��',
	'92' => '�ʧO�k�ϼ��C��',
	'93' => 'ĵ���C��',
	'94' => 'ĵ���C��A�D�n�Τ_�R���ίS�O���������t��ϥ�',
	'95' => '��r�C��]�m',
	'96' => '�q�{��r�C��',
	'97' => '�f�t�D��ժ���r�C��',
	'98' => '�f�t�D��ժ���r�C��, �D�n�Τ_�����W�챵��r�p�d��ϥ�',
	'99' => '���G��r�C��',
	'100' => '���G��r�C��, �D�n�Τ_�S�O���e���ܨϥ�',
	'101' => '���q��r',
	'102' => '�L���r',
	'103' => '���L���r',
	'104' => '�̲L���r',
	'105' => ', ���e�f�t���[�C��',
	'106' => '�զ��r',
	'107' => '�զ��r, �Τ_���s�Ϊ̲`��I���U����r�t��',
	'108' => '���I���D��r',
	'109' => '���I���D��r, �Τ_���I���D����r�t��',
	'110' => '�n����������, �@�뤣��ĳ�ק�',
	'111' => 'QQ�n���ϼ��C��',
	'112' => '�L�յn���ϼ��C��',
	'113' => '�L�H�n���ϼ��C��',
	'114' => '����C��]�m',
	'115' => '�`�W����C��',
	'116' => '���l���ä��e�Ҷ�����C��',
	'117' => '�ޥ�����C��',
	'118' => '�f�t�D��ժ��L��I������C��',
	'119' => '�f�t���G�I�����L��I������C��',
	'120' => ', �D�n�Τ_�S��D�D���ܤ��e�ϥ�',
	'121' => '���[CSS',
	'122' => '�K�[CSS�i��өʤƼ˦��]�m',
	'123' => '�]�m����',
	'201' => '�еn���A�i��]�m',
	'202' => '��s���\',
	'203' => '��s�X��',
);
$comiis_app_color_install_lang = "
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('1','1','��l��','1','1','','#53bcf5','#f3f3f3','#53bcf5','#fcad30','#99db5e','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#507daf','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('2','2','19�Ӹg���','0','1','','#A8C500','#f3f3f3','#A8C500','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#334f67','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('3','3','19��APP��','0','1','','#FF705E','#f3f3f3','#FF705E','#FFAE0E','#FF705E','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF6600','#FFAE0E','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF705E','#5cb3eb','#f66c75','#8fd353','#efefef','#FF705E','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('4','4','�p�̾�','0','1','','#FF6600','#f3f3f3','#FF6600','#FFB901','#FF6600','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#90CBE3','#F69595','#dd0000','#333333','#FF6600','#ff9900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF6600','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('5','5','360�H���C','0','1','','#00C5C7','#f3f3f3','#00C5C7','#F7AD3C','#00C5C7','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#00C5C7','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('6','6','���Ŷ�','0','1','.comiis_foot_memu li.f_0, .comiis_foot_memu li.f_0 a {color:#FFB900 !important;}\r\n.view_one .comiis_bianlun_t div.f_a span, .view_one .comiis_bianlun_t div.f_a em {color:#FF705E !important;}','#FFB900','#f3f3f3','#FFB900','#FF705E','#FFB900','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#FF705E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FFB900','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('7','7','������','0','1','','#FF5073','#f3f3f3','#FF5073','#FFB901','#FF5073','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#FF5073','#333333','#FF496D','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#FF5073','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('8','8','�@�ئ�','0','1','','#A09989','#f3f3f3','#A09989','#F7AD3C','#A09989','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#97311c','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#A09989','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('9','9','�H����','0','1','','#6C9BD3','#f3f3f3','#6C9BD3','#F7AD3C','#6C9BD3','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#51749A','#F7AD3C','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('11','10','�M�s��','0','1','','#43BE4A','#f3f3f3','#43BE4A','#FFB901','#43BE4A','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#43BE4A','#FFB901','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('12','11','�Ӱ���','0','1','','#5C687E','#f3f3f3','#5C687E','#FFB900','#F75A53','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#dd0000','#333333','#5C687E','#FFB900','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#f66c75','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');
insert  into `pre_comiis_app_style`(`id`,`displayorder`,`name`,`default`,`show`,`css`,`color1`,`color2`,`color3`,`color4`,`color5`,`color6`,`color7`,`color8`,`color9`,`color10`,`color11`,`color12`,`color13`,`color14`,`color15`,`color16`,`color17`,`color18`,`color19`,`color20`,`color21`,`color22`,`color23`,`color24`,`color25`,`color26`,`color27`,`color28`,`color29`,`color30`,`color31`) values ('13','12','�Y����','0','1','','#D43D3D','#f3f3f3','#D43D3D','#FEBA00','#D43D3D','#f1f1f1','#f8f8f8','#ffffff','#e8f5f9','#fffdef','#edffcc','#87d0f5','#ffa3a3','#D43D3D','#333333','#5C687E','#FEBA00','#777777','#999999','#bbbbbb','#dddddd','#ffffff','#D43D3D','#5cb3eb','#f66c75','#8fd353','#efefef','#f66c75','#e3e3e3','#b2dceb','#e7e1cd');";
