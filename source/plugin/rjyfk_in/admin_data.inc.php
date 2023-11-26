<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
cpheader();
loadcache("plugin");
$dlang = $scriptlang['rjyfk_in'];
$rjyfk_in = $_G['cache']['plugin']['rjyfk_in'];
$xdo = dhtmlspecialchars($_GET['xdo']);
if(submitcheck('cnyinglan_info_dele')){
	$deledate = $_GET['delete'];
	$vars_operation = $_GET['vars_operation'];
	if($vars_operation){
		switch($vars_operation){
			case 'delete':
			    C::t('#rjyfk_in#rjy_inlog')->delete_by_id($deledate);
			break;
		}
	}
	cpmsg($dlang['cnyinglan_success'], "action=plugins&operation=config&do=".$pluginid."&identifier=rjyfk_in&pmod=admin_data", 'succeed');
}else{
	$usergroup = C::t('common_usergroup')->fetch_all_by_type();
	$order_status =  intval($_GET['order_status']);
	$username =  trim(daddslashes($_GET['username']));
	$submitdatebegin = trim(daddslashes($_GET['submitdatebegin']));
	$submitdateend = trim(daddslashes($_GET['submitdateend']));
	$paydatebegin = trim(daddslashes($_GET['paydatebegin']));
	$paydateend = trim(daddslashes($_GET['paydateend']));
	$sjcldata = array('rjy_inlog');
	$where = 'where uid>0';
	if($order_status){
		$sjcldata[] = $order_status;
		$where .= ' and status=%d';
	}
	if($username){
	   $username = str_replace(array('%','_'),'',$username);	
	   $sjcldata[] = daddslashes('%'.$username.'%');
	   $where .= " and username LIKE %s";
	}		
	if($submitdatebegin && $submitdateend){
		$sjcldata[] = strtotime($submitdatebegin.' 00:00:00');
		$sjcldata[] = strtotime($submitdateend.' 23:59:59');
		$where .=' and (paytime>=%d and paytime<=%d)';
	}
	if($submitdatebegin && !$submitdateend){
		$sjcldata[] = strtotime($submitdatebegin.' 00:00:00');
		$where .=' and paytime>=%d';
	}
	if($paydatebegin && $paydateend){
		$sjcldata[] = strtotime($paydatebegin.' 00:00:00');
		$sjcldata[] = strtotime($paydateend.' 23:59:59');
		$where .=' and (paydate>=%d and paydate<=%d)';
	}
	
	if($paydatebegin && !$paydateend){
		$sjcldata[] = strtotime($paydatebegin.' 00:00:00');
		$where .' and paydate>=%d';
	}
	$order = " order by paytime desc";
	echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
	showtips(lang('plugin/rjyfk_in', 'Prompt3'));
	showtableheader(lang('plugin/rjyfk_in', 'Prompt2'));
	showformheader('plugins&operation=config&do='.$pluginid.'&pmod=admin_data', 'testhd');
	showsetting(lang('plugin/rjyfk_in', 'Prompt4'), array('order_status', array(
	array(0,lang('plugin/rjyfk_in', 'Prompt5')),
	array(10,lang('plugin/rjyfk_in', 'Prompt6')),
	array(1, lang('plugin/rjyfk_in', 'Prompt7')),
	)), $order_status, 'select');
	showsetting( lang('plugin/rjyfk_in', 'Prompt8'),'username',$username,'text');
	showsetting( lang('plugin/rjyfk_in', 'Prompt9'), array('submitdatebegin', 'submitdateend'), array($submitdatebegin, $submitdateend), 'daterange');
	showsetting( lang('plugin/rjyfk_in', 'Prompt10'), array('paydatebegin', 'paydateend'), array($paydatebegin, $paydateend), 'daterange');
	showsubmit('searchsubmit');
	showformfooter();
	showtablefooter();
	$page = $_G['page'];
	if(empty($page)){
		$page = 1;
	}
	$perpage = 20;
	$start_limit = ($page-1)*$perpage;
	$search = intval($_G['gp_search']);
	$cnyinglan_list = C::t('#rjyfk_in#rjy_inlog')->fetch_all_list($sjcldata,$where,$order,$start_limit,$perpage);
	$total_num =  C::t('#rjyfk_in#rjy_inlog')->fetch_all_listnums($sjcldata,$where);
	$pageurl = ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=rjyfk_in&pmod=admin_data";
	$multipage = multi($total_num,$perpage,$page,$pageurl,1000);
	showformheader("plugins&operation=config&do=".$pluginid."&identifier=rjyfk_in&pmod=admin_data");
	showtableheader();
	showtitle($dlang['Prompt1']);
	showsubtitle(array($dlang['Prompt11'],$dlang['Prompt12'],$dlang['Prompt13'],$dlang['Prompt14'],$dlang['Prompt20'],$dlang['Prompt16'],$dlang['Prompt17'],$dlang['Prompt18'],$dlang['Prompt19'],$dlang['Prompt15'],$dlang['Prompt22'],$dlang['Prompt21']));
	foreach($cnyinglan_list as $k => $v){
		$nums = $start_limit+$k+1;
		$listtype = $v['listtype']==1?$dlang['Prompt27']:$dlang['Prompt26'];
		$groupenddate = $v['groupenddate']?$v['groupenddate'].$dlang['Prompt25']:$dlang['Prompt47'];
		$czmiaoshu = $v['listtype']==1?$dlang['Prompt23'].Handle($v['extcredits']):$dlang['Prompt24'].$usergroup[$v['groupid']]['grouptitle'].",".$groupenddate.$jifeng.Handle($v['extcredits']);
		$status = $v['status']==1?"<em style='color:green'>".$dlang['Prompt7']."</em>":"<em style='color:blue'>".$dlang['Prompt6']."</em>";
		if($v['status']==1){
			$status = "<em style='color:green'>".$dlang['Prompt7']."</em>";
		}elseif($v['status']==5){
			$status = "<em style='color:red'>".$dlang['Prompt45']."</em>";
		}else{
			$status = "<em style='color:blue'>".$dlang['Prompt6']."</em>";
		}
		showtablerow('',array('class="td30"','class="td25"'),array('<input type="checkbox" name="delete[]" class="checkbox" value="'.$v['gid'].'">',$nums,'<a href="home.php?mod=space&uid='.$v['uid'].'&do=profile" target="_blank">'.$v['username'].'</a>',$v['sdorderno']?$v['sdorderno']:"-",$v['sdpayno']?$v['sdpayno']:"-",$v['total_fee']>0?$v['total_fee']:"-",dgmdate($v['paytime'],'u','9999'),$v['paydate']?dgmdate($v['paydate'],'u','9999'):"-",$v['paytype']?$v['paytype']:"-",$listtype,$czmiaoshu,$status),false);
	}
		
	$ops = cplang('operation').': '
	."<input type='checkbox' name='chkall' id='chkall' class='checkbox' onclick='checkAll(\"prefix\", this.form, \"delete\")' />&nbsp;&nbsp;"
	."<input type='radio' class='radio' name='vars_operation' onclick=\"alert('".$dlang['Prompt28']."');\" value='delete' id='op_delete' /><label for='op_delete'>".cplang('delete')."</label>&nbsp;&nbsp;";
	showsubmit('', '', '', $ops.'<input type="submit" class="btn" name="cnyinglan_info_dele" value="'.cplang('submit').'" />', $multipage);
	showtablefooter();
	showformfooter();
	
}

function Handle($data){
	global $_G;
	if(!$data) return;
	$nums = 0;
	$data = explode(",",$data);
	foreach($data as $value){
		$tmpArray = explode(":",$value);
		$m = "";
		$nums++;
		$result .= ",&nbsp;"."+".$tmpArray[1].$_G['setting']['extcredits'][intval(str_replace('extcredits','',$tmpArray[0]))]['title'];
	}
	return $result;
}