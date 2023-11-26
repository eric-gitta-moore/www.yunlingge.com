<?php 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


function updateadlist(){
	global $_G;
	loadcache('plugin');
	$vars=$_G['cache']['plugin']['iplus_gezi'];
	$maxnum=5*intval($vars['rows']);
	$wzcolor=$vars['wzcolor'];
	$adcolor=$vars['adcolor'];
	$wzlen=intval($vars['wzlen']);
	$query = DB::query( "SELECT title,url,style FROM ".DB::table('iplus_gezi')." where lastdate>".$_G['timestamp']." ORDER BY id ASC LIMIT $maxnum");
	$links=array();
	$i=0;
	while($value=DB::fetch($query)){
		if($value){
			$style='style="';
			$fontarr=unserialize($value['style']);
			if($fontarr['fontcolor']) $style.='color:'.$fontarr['fontcolor'].';';
			else $style.='color:'.$adcolor.';';
			if($fontarr['fontweight']==1) $style.='font-weight: bold;';
			if($fontarr['fontstyle']==1) $style.='font-style: italic;';
			if($fontarr['textdecoration']==1) $style.='text-decoration: underline;';
			$style.='"';
			$value['style'] = $style;		
			$value['title'] = dhtmlspecialchars(strip_tags(cutstr($value['title'],$wzlen,'')));
			$links[]=$value;
			$i+=1;
		}
	}
	$default=$maxnum-$i;
	if($default){//Ä¬ÈÏ²¹Æë
		for($i=1;$i<=$default;$i++){
			$links[]=array('title'=>$vars['wztitle'],'url'=>'');
		}
	}
	@require_once libfile('function/cache');
	$cacheArray .= "\$links=".arrayeval($links).";\n\$lasttime=".$_G['timestamp'].";\n";
	writetocache('iplus_gezi', $cacheArray);			
}

?>