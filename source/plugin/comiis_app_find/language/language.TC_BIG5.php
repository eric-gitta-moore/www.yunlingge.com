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
$comiis_app_find_lang = array(
	'01' => '�s�o�{�W��',
	'02' => '�R��',
	'03' => '�s��ئW��',
	'04' => '�`�N: �Ч���عϼФW�Ǩ� <font color=red>source/plugin/comiis_app_find/ico/</font> �ؿ��U�A�M��b�U��ϼп�J�B������J�ϼФ��W�Y�i',
	'05' => '�ϥλ���',
	'06' => '�ϼ�',
	'07' => '²�n����',
	'08' => '�������',
	'09' => '�|���Ƽ˦�',
	'10' => '��C�ݱƼ˦�',
	'11' => '�W�[�o�{',
	'12' => '�W�[���',
	'13' => '��s���\',
);
$comiis_app_find_install_lang = "
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('18','10','11','�d�ֻ�','http://m.kuaidi100.com','001.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('17','10','12','�d�Ѯ�','http://mse.360.cn/service/weather.html','036.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('16','10','9','114�q��','#','072.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('15','10','4','�n���ӫ�','#','084.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('14','10','3','����','#','041.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('13','10','2','�s�D','#','033.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('12','10','1','ñ��','#','068.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('11','0','2','���I����','','','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('10','0','1','�ͬ��A��','','','0','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('19','10','5','�ЫΫH��','#','087.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('20','10','7','�۸u�D¾','#','085.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('21','10','6','�G��~�m','#','091.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('22','10','8','�E����','http://m.zhe800.com/m/list/baoyou?url_name=baoyou&category_name=9%E5%9D%979%E5%8C%85%E9%82%AE','054.png','0','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('23','10','10','�d�H��','http://chaweizhang.eclicks.cn/webapp/index?appid=10&sid=4hQKAQpRC5QE','035.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('24','11','15','�H���','#','080.png','1','�H��O���ͬ��I�w');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('25','11','13','���H','#','097.png','1','�C�i����, ��樭Say No!');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('26','11','16','�T��','#','035.png','1','�̥������T����T');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('27','11','17','�����p��','#','006.png','1','�M��j��p�Ѫ�����');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('28','11','14','���P','#','053.png','1','���P�p��}');
";