<?php

/*
 *Դ   ��    ��    y   m g   6    .     c    o  m
 *������ҵ���/ģ��������� ����Դ     ��     ��
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

include 'sitemap.fun.php';

class plugin_taobo_sitemap {

 	function global_footer(){

	    loadcache('plugin');

		global $_G;

		$var = $_G['cache']['plugin']['taobo_sitemap'];

		$auto =$var['auto'];

		if($auto==1){

			$date=intval($var['cycle']);

			$date=empty($date)? 864000:$date;

			$time=time();

			@require_once DISCUZ_ROOT.'./source/discuz_version.php';

			if(DISCUZ_VERSION=='X2'){

				$filepath=DISCUZ_ROOT.'./data/cache/cache_taobo_sitemap_log.php';

			}elseif(DISCUZ_VERSION=='X2.5'||DISCUZ_VERSION=='X3 Beta'||DISCUZ_VERSION=='X3 RC'||DISCUZ_VERSION=='X3'){

				$filepath=DISCUZ_ROOT.'./data/sysdata/cache_taobo_sitemap_log.php';

			}

			if(file_exists($filepath)){

				@require_once $filepath;

				if(($time-intval($last))>$date){//���� ��ʼ�Զ����µ�ͼ

					$data=sitemap_auto();

				}

			}else{//�½���ͼ

				$data=sitemap_auto();

			}

        }

	}

	function global_footerlink() {

	    loadcache('plugin');

		global $_G;

		$link= $_G['cache']['plugin']['taobo_sitemap']['link'];

		if($link){

			$title='��վ��ͼ';

			if(strtolower(CHARSET) == 'utf-8') $title=iconv('GB2312', 'UTF-8',$title);//utf-8		

			return '<span class="pipe">|</span><a href="sitemap.xml" target="_blank" title="'.$title.'">'.$title.'</a>';

		}

	}	

 }



class plugin_taobo_sitemap_forum extends plugin_taobo_sitemap{ 

} 

?>