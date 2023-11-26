<?php
  /**
 * Created by DisM.
 * User: DisM!应用中心
 * From: DisM.taobao.Com
 * Time: 2019-10-11
 */
if(!defined('IN_DISCUZ')) {
  exit('Access Denied');
}
class plugin_exx_tagrewrite{
	function global_header(){
		global $_G,$post,$tagarray,$id;
		$exx_tagrewrite = $_G['cache']['plugin']['exx_tagrewrite'];
		if($exx_tagrewrite['yk'] && $_G['uid']){
			return;
		}
		$prefix=dhtmlspecialchars($exx_tagrewrite['prefix']);
		if($exx_tagrewrite['off']){
			if($_G['mod']=='tag'){
				$id=$id?$id:intval($_GET['id']);
				$this->sreplace('"misc.php?mod=tag"',$prefix.'.html');
				if($id){
					$this->sreplace('"misc.php?mod=tag&amp;id='.$id.'"',$prefix.'-'.$id.'.html');
					$this->sreplace('"misc.php?mod=tag&amp;id='.$id.'&amp;type=thread"',$prefix.'-'.$id.'-thread.html');
					$this->sreplace('"misc.php?mod=tag&amp;id='.$id.'&amp;type=blog"',$prefix.'-'.$id.'-blog.html');
					if($_GET['type']){
						$count = C::t('common_tagitem')->select($id, 0, 'tid', '', '', 0, 0, 0, 1);
						$pagecount=ceil($count/20);
						for($i=1;$i<=$pagecount; $i++){
							$this->sreplace('"misc.php?mod=tag&id='.$id.'&type=thread&amp;page='.$i.'"',$prefix.'-'.$id.'-thread-'.$i.'.html');
						}
					}
				}else{
					foreach($tagarray as $tk=>$tv){
						$this->sreplace('"misc.php?mod=tag&amp;id='.$tv['tagid'].'"',$prefix.'-'.$tv['tagid'].'.html');	
					}
				}
			}
			if($_G['tid']){
				if(!$post['tags']){
					$posts=DB::fetch_first("select tags from ".DB::table('forum_post')." where tid=".$_G['tid']." AND first=1 Limit 1");
					if($posts){
						$tagarray_all = $posttag_array = array();
						$tagarray_all = explode("\t", $posts['tags']);
						if($tagarray_all) {
							foreach($tagarray_all as $var) {
								if($var) {
									$tag = explode(',', $var);
									$posttag_array[] = $tag;
								}
							}
						}
						$post['tags'] = $posttag_array;
					}
				}
				foreach($post['tags'] as $tks=>$tvs){
					$this->sreplace('"misc.php?mod=tag&amp;id='.$tvs[0].'"',$prefix.'-'.$tvs[0].'.html');	
				}
			}
		}
		return;
	}
	
	function sreplace($s,$r){
		global $_G;
		$rno=rand(11,99999);
		if(!$_G['setting']['rewritestatus']){
			$_G['setting']['rewritestatus'] = true;
		}
		$_G['setting']['output']['str']['search']['exx_tagrewritea'.$rno] = $s;
		$_G['setting']['output']['str']['replace']['exx_tagrewritea'.$rno] = $r;
		return;
	}
}