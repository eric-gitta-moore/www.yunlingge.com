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
$comiis_app_find_lang = array(
	'01' => '�·�������',
	'02' => 'ɾ��',
	'03' => '����Ŀ����',
	'04' => 'ע��: �����Ŀͼ���ϴ��� <font color=red>source/plugin/comiis_app_find/ico/</font> Ŀ¼�£�Ȼ�����·�ͼ�����봦ֱ������ͼ���ļ�������',
	'05' => 'ʹ��˵��',
	'06' => 'ͼ��',
	'07' => '��Ҫ˵��',
	'08' => '��ҳ��ʾ',
	'09' => '�ĸ������ʽ',
	'10' => '����������ʽ',
	'11' => '���ӷ���',
	'12' => '������Ŀ',
	'13' => '���³ɹ�',
);
$comiis_app_find_install_lang = "
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('18','10','11','����','http://m.kuaidi100.com','001.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('17','10','12','������','http://mse.360.cn/service/weather.html','036.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('16','10','9','114�绰','#','072.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('15','10','4','�����̳�','#','084.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('14','10','3','�','#','041.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('13','10','2','����','#','033.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('12','10','1','ǩ��','#','068.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('11','0','2','�ȵ��Ƽ�','','','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('10','0','1','�������','','','0','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('19','10','5','������Ϣ','#','087.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('20','10','7','��Ƹ��ְ','#','085.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('21','10','6','��������','#','091.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('22','10','8','�ۻ���','http://m.zhe800.com/m/list/baoyou?url_name=baoyou&category_name=9%E5%9D%979%E5%8C%85%E9%82%AE','054.png','0','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('23','10','10','��Υ��','http://chaweizhang.eclicks.cn/webapp/index?appid=10&sid=4hQKAQpRC5QE','035.png','1','');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('24','11','15','������','#','080.png','1','���ּ�¼������');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('25','11','13','�Ҷ���','#','097.png','1','��Ϧ�ɶ�, ������Say No!');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('26','11','16','����','#','035.png','1','��ȫ���������Ѷ');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('27','11','17','��ʳ����','#','006.png','1','Ѱ�Ҵ��С�����ʳ');
insert into `pre_comiis_app_find` (`id`,`cid`,`displayor`,`name`,`url`,`icon`,`show`,`data`) values('28','11','14','���','#','053.png','1','���С����');
";