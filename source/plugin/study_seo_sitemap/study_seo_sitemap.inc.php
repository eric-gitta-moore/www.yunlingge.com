<?php

/**
 * Copyright 2001-2099 1314 ѧϰ.��.
 * This is NOT a freeware, use is subject to license terms
 * $Id: study_seo_sitemap.inc.php 5963 2019-12-09 02:47:41
 * Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue������ http://t.cn/RU4FEnD��
 * Ӧ����ǰ��ѯ��QQ 153.26.940
 * Ӧ�ö��ƿ�����QQ 64.330.67.97
 * �����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
 * δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��
 */

if(!defined('IN_DISCUZ')) {
exit('Access Denied');
}
loadcache('forums');
$splugin_setting = $_G['cache']['plugin']['study_seo_sitemap'];
$splugin_lang = lang('plugin/study_seo_sitemap');
$study_new_num = $splugin_setting['study_new_num'] ? $splugin_setting['study_new_num'] : '100';//www_discuz_1314study_com
$study_new_blank = $splugin_setting['study_new_blank'] ? 'target="_blank"' : '';
$length = $splugin_setting['title_length'] ? $splugin_setting['title_length'] : '50';#��Ȩ��1314 ѧ ϰ ����δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ
$dot = $splugin_setting['title_dot'] ? $splugin_setting['title_dot'] : '';
$splugin_setting['navtitle'] = $splugin_setting['navtitle'] ? $splugin_setting['navtitle'] : $splugin_lang['slang_003'];
$study_fids = list_array(unserialize($splugin_setting['study_fids']));#https://dwz.cn/aF4yHhDG
$where_fids = $study_fids ? 'AND fid in('.$study_fids.')' : '';
$num = DB::result_first("SELECT count(*) FROM ".DB::table('forum_thread')." WHERE displayorder >=0 AND isgroup <> 1 $where_fids");
$page = intval($_G['page']);//1.3.1.4ѧ.ϰ.��
$limit = $study_new_num ? $study_new_num : 30;
$max = 1000;
$page = ($page-1 > $num / $limit || $page > $max) ? 1 : $page;
$start_limit = ($page - 1) * $limit;
$multipage = sitemap_multi($num, $limit, $page, $max);#1.3.1.4ѧ.ϰ.��
$querys = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE displayorder >=0 AND isgroup <> 1 $where_fids ORDER BY tid DESC LIMIT $start_limit, $limit");/*1.3.1.4ѧ.ϰ.��*/
$content = $splugin_setting['navtitle'];
while($thread = DB::fetch($querys)){
$thread['subject'] = dhtmlspecialchars(cutstr($thread['subject'],$length,$dot));
$thread['highlight'] = sethighlight($thread['highlight']);
if($_G['setting']['heatthread']['iconlevels']) {
foreach($_G['setting']['heatthread']['iconlevels'] as $k => $v) {
if($thread['heats'] > $v) {
$thread['heatlevel'] = $k + 1;//http://suo.im/5qyxLj
break;
}#1.3.14.ѧ.ϰ.��
}/*1.3.1.4ѧ.ϰ.��*/
}
$content .= ','.$thread['subject'];
$threadlist[] = $thread;//1314ѧϰ��
}
$todaytime = strtotime(dgmdate(TIMESTAMP, 'Ymd'));
if($page == 1){
$navtitle = $splugin_setting['navtitle'];# http://t.cn/hbdjxV
}else{
$navtitle = $splugin_setting['navtitle'].' - '.$splugin_lang['slang_001'].$page.$splugin_lang['slang_002'];
}
$content = str_replace('...', '', $content);
$metadescription = dhtmlspecialchars(cutstr($content, 200, ''));
$metakeywords = dhtmlspecialchars(cutstr($metadescription, 100, ''));#http://t.cn/hbdjxV
include template('study_seo_sitemap:sitemap');
function sethighlight($string) {
$colorarray = array('', '#EE1B2E', '#EE5023', '#996600', '#3C9D40', '#2897C5', '#2B65B7', '#8F2A90', '#EC1282');
$string = sprintf('%02d', $string);
$stylestr = sprintf('%03b', $string[0]);#���棺 http://t.cn/hbdjxV
$highlight = ' style="';
$highlight .= $stylestr[0] ? 'font-weight: bold;' : '';//  From Www.1314Study.com
$highlight .= $stylestr[1] ? 'font-style: italic;' : '';
$highlight .= $stylestr[2] ? 'text-decoration: underline;' : '';
$highlight .= $string[1] ? 'color: '.$colorarray[$string[1]].';' : '';/*1.3.14.ѧ.ϰ.��*/
$highlight .= '"';#1.3.1.4ѧ.ϰ.��
return $highlight;
}
function list_array($fids_show) {
global $_G;//  www_discuz_1314study_com
$i = '1314';
foreach ($fids_show as $id=> $fid){
if(!empty($fid) && $fid){
if($i == '1314'){
$result .= $fid;
$i = 'DIY';//http://t.cn/hbdjxV
}else{
$result .= ','.$fid;
}
}
}
return $result;#1314�Wϰ��
}
function sitemap_multi($num, $perpage, $curpage, $maxpages = 0, $page = 10, $autogoto = false, $simple = false) {
global $_G; 
$splugin_setting = $_G['cache']['plugin']['study_seo_sitemap'];#https://dwz.cn/aF4yHhDG
if($splugin_setting['rewrite_radio']){
$rewrite_rule = $splugin_setting['rewrite_rule'] ? $splugin_setting['rewrite_rule'] : 'sitemap-forum-new-{page}.html';
}else{
$rewrite_rule = 'plugin.php?id=study_seo_sitemap&module=forum&type=new&page={page}';/*From Www.1314Study.com*/
}
$lang['prev'] = '&nbsp;&nbsp;';
$lang['next'] = lang('core', 'nextpage');
$dot = '...';
$multipage = ''; 
$realpages = 1;
$_G['page_next'] = 0;//  1314ѧ����
$page -= strlen($curpage) - 1;
if($page <= 0) {
$page = 1;
}
if($num > $perpage) {
$offset = floor($page * 0.5);
$realpages = @ceil($num / $perpage);
$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;#1314�W���W
if($page > $pages) {
$from = 1;
$to = $pages;# 1_3.1.4.ѧ.ϰ.��
}else {
$from = $curpage - $offset;
$to = $from + $page - 1;
if($from < 1) {
$to = $curpage + 1 - $from;
$from = 1;
if($to - $from < $page) {
$to = $page;# www_discuz_1314study_com
}
}elseif($to > $pages) {
$from = $pages - $page + 1;//http://t.cn/hbdjxV
$to = $pages;
}
}
$_G['page_next'] = $to;
      $multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="sitemap.php" class="first">1 ' . $dot . '</a>' : '') .
      ($curpage > 1 && !$simple ? '<a href="' . ($curpage == 2 ? 'sitemap.php' : str_replace('{page}', ($curpage - 1), $rewrite_rule) ). '" class="prev">' . $lang['prev'] . '</a>' : '');
      for($i = $from; $i <= $to; $i++) {
          if($i == 1) {
              $multipage .= $i == $curpage ? '<strong>1</strong>' :
              '<a href="sitemap.php">1</a>';
          }else {
              $multipage .= $i == $curpage ? '<strong>' . $i . '</strong>' :
              '<a href="'.str_replace('{page}', $i, $rewrite_rule).'">' . $i . '</a>';
          }
      }
      $multipage .= ($to < $pages ? '<a href="'.str_replace('{page}', $i, $rewrite_rule).'" class="last">' . $dot . ' ' . $realpages . '</a>' : '') .
      ($curpage < $pages && !$simple ? '<a href="'.str_replace('{page}', ($curpage + 1), $rewrite_rule).'" class="nxt">' . $lang['next'] . '</a>' : '');

      $multipage = $multipage ? '<div class="pg">' . $multipage . '</div>' : '';
  }
  $maxpage = $realpages;
  return $multipage;
}


//Copyright 2001-2099 .1314.ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: study_seo_sitemap.inc.php 6436 2019-12-08 18:47:41
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue ������ http://t.cn/EUPqQW1��
//Ӧ����ǰ��ѯ��QQ 15.3269.40
//Ӧ�ö��ƿ�����QQ 643.306.797
//�����Ϊ 131.4ѧϰ����www.1314Study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��