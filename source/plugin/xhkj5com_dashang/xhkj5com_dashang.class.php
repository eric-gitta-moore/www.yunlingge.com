<?php
if(!defined('IN_DISCUZ')) {
exit('Access Denied');}
	
class plugin_xhkj5com_dashang_forum {
	function viewthread_postbottom_output(){
		global $_G, $postlist;
		$xhkj5com_dashang = $_G['cache']['plugin']['xhkj5com_dashang'];
		$section = empty($xhkj5com_dashang['bk']) ? array() : unserialize($xhkj5com_dashang['bk']);
		if(!is_array($section)) $section = array();
		if(!(empty($section[0]) || in_array($_G['fid'],$section))){return;}
		$gro = empty($xhkj5com_dashang['yhz']) ? array() : unserialize($xhkj5com_dashang['yhz']);
		if(!is_array($gro)) $gro = array();
		$bpoh='background-position:-134px 0px';$bpo='';
		if($xhkj5com_dashang['styles']==2){$bpo='background-position:0px -49px;';$bpoh='background-position:-134px -49px;';$zsx='#fca222';}elseif($xhkj5com_dashang['styles']==3){$bpo='background-position:0px -98px;';$bpoh='background-position:-134px -98px;';}elseif($xhkj5com_dashang['styles']==4){$bpo='background-position:0px -147px;';$bpoh='background-position:-134px -147px;';}elseif($xhkj5com_dashang['styles']==5){$bpo='background-position:0px -196px;';$bpoh='background-position:-134px -196px;';}
		if($xhkj5com_dashang['htds']==2){
		foreach($postlist as $key=>$val){
			$zzid=$postlist[$key]['authorid'];
			include template('xhkj5com_dashang:index');
			$autgro=getgroupid($zzid);
			if(!(empty($gro[0]) || in_array($autgro,$gro))){$return='';}
			$ainfo=getainfo($val['pid']);
			if($xhkj5com_dashang['yhewm']==1 && !$ainfo){$return='';}
		 	$return_array[]=$return;					
			}
		}else{
			$zzid=$_G[thread][authorid];
			$ainfo=getainfo($_G[forum_firstpid]);
			include template('xhkj5com_dashang:index');
			$autgro=getgroupid($zzid);
			if(!(empty($gro[0]) || in_array($autgro,$gro))){return;}
			if($xhkj5com_dashang['yhewm']==1 && !$ainfo){$return='';}	
			if($_G['forum_firstpid']) $return_array[0]=$return;		
			}		
		return $return_array;
	}
}

class mobileplugin_xhkj5com_dashang_forum{
	function viewthread_postbottom_mobile_output(){
		global $_G, $postlist;
		$xhkj5com_dashang = $_G['cache']['plugin']['xhkj5com_dashang'];
		$section = empty($xhkj5com_dashang['bk']) ? array() : unserialize($xhkj5com_dashang['bk']);
		if(!is_array($section)) $section = array();
		if(!(empty($section[0]) || in_array($_G['fid'],$section))){return;}
		$zsx='#e74851';$qsbg='#FEF8F5';$autgro='';
	if($xhkj5com_dashang['styles']==2){$zsx='#fca222';$qsbg='#fdf9f3';}elseif($xhkj5com_dashang['styles']==3){$zsx='#5fbf5f';$qsbg='#edfded';}elseif($xhkj5com_dashang['styles']==4){$zsx='#60b4e9';$qsbg='#f3f9fd';}elseif($xhkj5com_dashang['styles']==5){$zsx='#5788aa';$qsbg='#f3f9fd';}
		if($xhkj5com_dashang['mobile']==0){return;}	
		$return="
		<script>	
		function xhkj5com_dashang_get(v){	
			var vv = v;	
			$.ajax({type:'GET',url:'plugin.php?id=xhkj5com_dashang:xhkj5com_dashang_m&dsd=1&dspid=' + vv,})
			.success(function(s) {document.getElementById('xhkj5com_dashangb' + vv).innerHTML=s;})
			.error();return false;}
		function kenull(v){	
			var vv = v;	
			document.getElementById('xhkj5com_dashangb' + vv).innerHTML=null}
		function setTab(name,m,n){ 
			for( var i=1;i<=n;i++){ 
			var menu = document.getElementById(name+i); 
			var showDiv = document.getElementById(\"cont_\"+name+\"_\"+i); 
			menu.className = i==m ? \"on\":\"\"; 
			showDiv.style.display = i==m?\"block\":\"none\"; 
			} 	
		} 
		</script> 
		<style>
		.tab ul li.on{ border:".$zsx." 2px solid; color: #000;} 
		.tabList .one img{ padding:15px; border:3px dashed ".$zsx."; border-radius:20px;}
		#ds .dsbox{ background:".$qsbg."}
		#boxds{position: fixed; width: 100%;height: 100%;background: rgba(0,0,0,0.2);top:0;left:0;z-index:999;}  
        .box1{width: 90%;height: 90%; margin:30px auto;} 
		.dsshow{ width:80px; height:25px; text-align:center; color:#FFF; background:".$zsx."; margin:10px auto; display:block;line-height:25px; border-radius:25px;font-size:14px}
		.dsclose{ width:100%; display:block;height:35px;line-height:35px; color:#FFFFFF; background:".$zsx."; text-align:center;font-size:16px}
		 
    </style>  
		";	
		$return_array='';	
		foreach($postlist as $key=>$val){
			$zzid=$postlist[$key]['authorid'];
			$autgro=getgroupid($zzid);
			
			$gro = empty($xhkj5com_dashang['yhz']) ? array() : unserialize($xhkj5com_dashang['yhz']);
			if(!(empty($gro[0]) || in_array($autgro,$gro))){
				$return_array='';
			}else{
				$return_array='
				<a href="javascript:;" onClick="xhkj5com_dashang_get('.$val['pid'].');"  class="dsshow"> <font color="#fff">'.lang('plugin/xhkj5com_dashang', 'ds').'</font></a>
				<div id="xhkj5com_dashangb'.$val['pid'].'"></div>';
			}
			if($val['first']){
				$postlist[$key]['message']=$postlist[$key]['message'].$return_array.$return;
			}else{
				if($xhkj5com_dashang['htds']==2){
					if(!$val['pid'])return;
					$ainfo=getainfo($val['pid']);
					if($xhkj5com_dashang['yhewm']==1 && !$ainfo){$return_array='';}
					$postlist[$key]['message']=$postlist[$key]['message'].$return_array;
				}
			}
		}
	}
}

function getgroupid($zzid){
	return DB::result_first("select groupid from ".DB::table('common_member')." where uid='".$zzid."'");
}
function getainfo($pid){
	return DB::fetch_first("select s.* from ".DB::table('xhkj5com_dashang')." s,".DB::table('forum_post')." h where s.uid=h.authorid and h.pid=".$pid);
	//return DB::fetch_first("select * from ".DB::table('xhkj5com_dashang')." where uid=authorid and pid=".$pid);
}