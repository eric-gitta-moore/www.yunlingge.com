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

$comiis_app_homestyle_lang = array(
	'124' => '<li>������ͨ�� FTP �� <font color=red>source/plugin/comiis_app_homestyle/image/home_bg/</font> Ŀ¼�д�����������Ŀ¼���ϴ�����ͼƬ��Ȼ��ˢ�±�ҳ��</li><li>ע��: ����ͼƬ����Ŀ¼��ֻ�������֡�26 ��Ӣ����ĸ���»���</li><li>�Ƽ�: ��ѡ�Ƽ���ͼƬ�����ڱ�������ҳ���Ƽ���Ŀ��ʾ</li>',
	'125' => 'ʹ��˵��',
	'126' => '����ͼƬ���� &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="show_all()">ȫ��չ��</a> | <a href="javascript:;" onclick="hide_all()">ȫ���۵�</a>',
	'127' => 'ͼ��',
	'128' => '�Ƽ�',
	'129' => '����',
	'130' => '����',
	'64' => '���³ɹ�',
	'65' => '���³���',
	'66' => '���ȵ�¼�ٽ�������',
	'67' => '����',
	'201' => '���¼�ٽ�������',
);
$comiis_app_homestyle_install_lang = "
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('1','1','�羰','fengjing','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('2','1','������','fengjing','fj001.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('3','2','��������','fengjing','fj002.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('4','3','���ǹ��','fengjing','fj003.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('5','4','�����糿','fengjing','fj004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('6','5','�������','fengjing','fj005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('7','6','��ϼ','fengjing','fj006.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('8','7','���н���','fengjing','fj007.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('9','8','��ӥչ��','fengjing','fj008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('10','9','��ɫ����','fengjing','fj009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('11','10','�ȴ�����','fengjing','fj010.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('12','11','����','fengjing','fj011.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('13','12','Ϧ������','fengjing','fj012.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('14','13','΢�ݹž�','fengjing','fj013.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('15','14','�������','fengjing','fj014.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('16','15','���ն���','fengjing','fj015.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('17','3','����','jingwu','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('18','25','��������','jingwu','jw001.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('19','26','��ݮ','jingwu','jw002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('20','27','Ʒλ����','jingwu','jw003.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('21','28','���ֳ�','jingwu','jw004.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('22','29','��Ũ����','jingwu','jw005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('23','30','�嵭���','jingwu','jw006.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('24','31','��������','jingwu','jw007.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('25','32','��Ӱ','jingwu','jw008.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('26','33','Ψ��','jingwu','jw009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('27','6','��ͨ','katong','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('28','52','С��Ѽ','katong','kt001.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('29','53','��Ծ','katong','kt002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('68','57','��ñ��','katong','kt006.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('66','56','����','katong','kt005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('65','55','�ǿ�','katong','kt004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('64','54','С������ǧ','katong','kt003.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('34','4','��','meng','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('35','34','ͯ������','meng','m001.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('36','35','ͯ������','meng','m002.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('37','36','������','meng','m003.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('38','37','ͯ�����','meng','m004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('39','38','����Ϧ��','meng','m005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('40','39','��������','meng','m006.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('41','40','С���','meng','m007.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('42','41','����˾��','meng','m008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('43','42','����','meng','m009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('44','2','ʱ��','shishang','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('45','16','����Ů��','shishang','ss001.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('46','17','�촽','shishang','ss002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('47','18','�չ����','shishang','ss003.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('48','19','�촽�ջ�','shishang','ss004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('49','20','�ư�����','shishang','ss005.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('50','21','�ǹ�Ů��','shishang','ss006.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('51','22','Ѥ���־�','shishang','ss007.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('52','23','��׺','shishang','ss008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('53','24','��Ӱ����','shishang','ss009.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('54','5','��԰','tianyuan','0','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('55','43','���Ż���','tianyuan','ty001.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('56','44','����С��','tianyuan','ty002.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('57','45','��ɫ����','tianyuan','ty003.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('58','46','��������','tianyuan','ty004.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('59','47','���ջ���','tianyuan','ty005.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('60','48','Ѭ�����','tianyuan','ty006.jpg','1');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('61','49','��¶΢��','tianyuan','ty007.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('62','50','���µ���','tianyuan','ty008.jpg','0');
insert  into `pre_comiis_app_home`(`id`,`displayorder`,`name`,`dir`,`img`,`recommend`) values ('63','51','�������','tianyuan','ty009.jpg','0');
";