<?php
if ( !defined( "IN_DISCUZ" ) ){
    exit( "Access Denied" );
      }
include_once libfile('function/mail');
class mobileplugin_ac9394_postmail {

}

class mobileplugin_ac9394_postmail_forum extends mobileplugin_ac9394_postmail {
private $mailtitle;
function __construct(){
		global $_G;
		$config = $_G['cache']['plugin']['ac9394_postmail'];
		$this->groupid=$_G['groupid'];
		$this->mailtitle = $config['emailtitle'];
		$this->emailcommen = $config['emailcommen'];
		$this->mailtitle2 = $config['emailtitle2'];
		$this->emailcommen2 = $config['emailcommen2'];
		$this->opbj = $config['opbj'];
		$this->forum = unserialize($config['allowforum']);
		$this->reqgroup = unserialize($config['reqgroup']);
		$this->group = unserialize($config['allowgroup']);
		$this->timea = $config['timea'];
}
function post_message($p) {//脚本嵌入点
	
$p = $p['param'];

if($_GET['action'] == 'newthread'||'edit' ) {
	
if($p[0] == 'post_newthread_succeed' ||  'post_edit_succeed') {
if($p[0] ==  'post_edit_succeed' && $this->opbj){
	$this->mailtitle=$this->mailtitle2;
	$this->emailcommen=$this->emailcommen2;
	$is_send=1;
}else if($p[0] == 'post_newthread_succeed'){
	$is_send=1;
}else{
	$is_send=0;
}	
$subject = $_GET['subject'];

$fid=$_GET["fid"];

 if($fid && in_array($fid, $this->forum) && in_array($this->groupid, $this->group)){
	 
$remails=DB::fetch_all("SELECT t.email,p.title,t.groupid FROM ".DB::table("common_member")." t right JOIN ".DB::table("home_favorite")." p on p.uid=t.uid WHERE p.id=".$fid."&& p.idtype='fid'");//表联合查询
$losttime=DB::fetch_first("SELECT dateline FROM ".DB::table("forum_thread")."  WHERE fid=".$fid." ORDER BY dateline DESC");
$jiatime=time()-$losttime['dateline'];
$ctime=$this->timea*60;
if($jiatime>$ctime)$send=1;
for($i=0;$i<count($remails);$i++){
	
    $mailtitle = str_replace(array('{subject}','{forumname}'),array($subject,$remails[$i]['title']), $this->mailtitle);//标题处理
		
    $emailcommen = str_replace(array('{subject}', '{url}','{forumname}'),array($subject, $p[1],$remails[$i]['title']), $this->emailcommen);//内容处理
		 if($is_send && in_array($remails[$i]['groupid'], $this->reqgroup) && $send)sendmail($remails[$i]['email'],$mailtitle,$emailcommen);
	}        
		}					

			}

		}


	}
}
?>