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

$comiis_app_homestyle_lang = array(
	'124' => '<li>�z�i�H�q�L FTP �b <font color=red>source/plugin/comiis_app_homestyle/image/home_bg/</font> �ؿ����ЫحI�������ؿ��äW�ǭI���Ϥ��A�M���s�����C</li><li>�`�N: �I���Ϥ������ؿ��W�u���\�Ʀr�B26 �ӭ^��r���ΤU���u</li><li>����: �Ŀ���˪��Ϥ��N�|�b�I���]�m��������������</li>',
	'125' => '�ϥλ���',
	'126' => '�I���Ϥ��]�m &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="show_all()">�����i�}</a> | <a href="javascript:;" onclick="hide_all()">�������|</a>',
	'127' => '�ϼ�',
	'128' => '����',
	'129' => '��s',
	'130' => '�s�W',
	'64' => '��s���\',
	'65' => '��s�X��',
	'66' => '�Х��n���A�i��]�m',
	'67' => '�O�s',
	'201' => '�еn���A�i��]�m',
);
$comiis_app_homestyle_install_lang = "
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('1','1','����','fengjing','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('2','1','�غ���','fengjing','fj001.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('3','2','�����E�u','fengjing','fj002.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('4','3','�������m','fengjing','fj003.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('5','4','�M�s����','fengjing','fj004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('6','5','�z�Q���W','fengjing','fj005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('7','6','����','fengjing','fj006.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('8','7','�����`��','fengjing','fj007.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('9','8','���N�i��','fengjing','fj008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('10','9','�����R��','fengjing','fj009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('11','10','���a����','fengjing','fj010.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('12','11','�t��','fengjing','fj011.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('13','12','�i�����','fengjing','fj012.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('14','13','�L�{�j�~','fengjing','fj013.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('15','14','�������a','fengjing','fj014.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('16','15','����F��','fengjing','fj015.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('17','3','�R��','jingwu','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('18','25','�ɧv���n','jingwu','jw001.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('19','26','���','jingwu','jw002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('20','27','�~��Ĳ�','jingwu','jw003.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('21','28','��ֳ�','jingwu','jw004.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('22','29','���@����','jingwu','jw005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('23','30','�M�H�p��','jingwu','jw006.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('24','31','���Ʀp��','jingwu','jw007.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('25','32','�˼v','jingwu','jw008.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('26','33','�߬�','jingwu','jw009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('27','6','�d�q','katong','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('28','52','�p���n','katong','kt001.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('29','53','���D','katong','kt002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('68','57','���U�l','katong','kt006.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('66','56','����','katong','kt005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('65','55','�P��','katong','kt004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('64','54','�p�Ὼ��d','katong','kt003.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('34','4','��','meng','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('35','34','���~�ڷQ','meng','m001.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('36','35','���ܩ_�J','meng','m002.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('37','36','�ᵯ��','meng','m003.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('38','37','���~�^��','meng','m004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('39','38','���ʤi��','meng','m005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('40','39','���B�L��','meng','m006.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('41','40','�p�F��','meng','m007.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('42','41','�j�H�q��','meng','m008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('43','42','�s��','meng','m009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('44','2','�ɩ|','shishang','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('45','16','�����k��','shishang','ss001.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('46','17','���B','shishang','ss002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('47','18','����ɫ�','shishang','ss003.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('48','19','���B���b','shishang','ss004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('49','20','�s�a�۫�','shishang','ss005.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('50','21','�}�G�k��','shishang','ss006.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('51','22','���R��','shishang','ss007.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('52','23','�I��','shishang','ss008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('53','24','���v����','shishang','ss009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('54','5','�ж�','tianyuan','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('55','43','�H���᭻','tianyuan','ty001.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('56','44','�M�D�p��','tianyuan','ty002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('57','45','�զ⭸��','tianyuan','ty003.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('58','46','�ᶡ���B','tianyuan','ty004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('59','47','�V����O','tianyuan','ty005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('60','48','�t�筻��','tianyuan','ty006.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('61','49','�B�S�L�D','tianyuan','ty007.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('62','50','�M�s�H��','tianyuan','ty008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('63','51','�K���ƥ�','tianyuan','ty009.jpg','0');
";