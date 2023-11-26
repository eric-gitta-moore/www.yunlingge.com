<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if($_GET['formhash'] != FORMHASH)
{
	exit('formhash is ERROR');
}
$dataArr=array();
if(empty($_GET['tid']) && empty($_GET['aid']))
{
	$dataArr['hzwcount']=1;
	$dataArr['err']='tid error';
	$returnData=json_encode($dataArr);
	echo $_GET['zhiwu55callback'] . '(' . $returnData . ')';
	exit;

}
require './source/plugin/zhiwu55com_autoreply/function_common.php';
$hzw_appid = zhiwu55com_autoreply_appid();
if(empty($_GET['keyword']) && !empty($_GET['tid']))
{
	$subject = DB::result_first('SELECT subject FROM %t WHERE tid=%d',array('forum_thread',$_GET['tid']));
	$subject = diconv($subject,CHARSET,'UTF-8');

}elseif(empty($_GET['keyword']) && !empty($_GET['aid'])) {

	$subject = DB::result_first('SELECT title FROM %t WHERE aid=%d',array('portal_article_title',$_GET['aid']));
	$subject = diconv($subject,CHARSET,'UTF-8');

} else {

	$subject = $_GET['keyword'];

}
$subject = urlencode($subject);
$commentUrl = dfsockopen("http://discuz.csdn123.net/plugin/zhiwu55com_autoreply/v100/?k=".$subject.'&hzw_appid='.$hzw_appid);
if(empty($commentUrl) || strlen($commentUrl)<10)
{
	$dataArr['hzwcount']=1;
	$dataArr['err']='result empty';
	$returnData=json_encode($dataArr);
	echo $_GET['zhiwu55callback'] . '(' . $returnData . ')';
	exit;

}
$htmlcode = dfsockopen($commentUrl);
$htmlcode = diconv($htmlcode,'UTF-8');
$htmlcode = preg_replace('/\s+/','',$htmlcode);
preg_match('/<ul.+?><li>(.+?)<\/li><\/ul>/',$htmlcode,$commentArr);
$commentArrStr=$commentArr[1];
$commentArr=explode('</li><li>',$commentArrStr);
shuffle($commentArr);
foreach($commentArr as $k=>$v)
{
	$kk=$k+1;
	$v=preg_replace('/\[.+?\]/','',$v);
	$v=str_replace('<br>',"\r\n",$v);
	$v=str_replace('</br>',"\r\n",$v);
	$dataArr['hzw'.$kk]=diconv($v,CHARSET,'UTF-8');
}
$dataArr['hzwcount']=count($dataArr);
$returnData=json_encode($dataArr);
echo $_GET['zhiwu55callback'] . '(' . $returnData . ')';