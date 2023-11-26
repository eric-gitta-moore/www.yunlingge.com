<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$croppath = DISCUZ_ROOT.'/source/plugin/dc_vip/data/cron.php';
$cronupdate = @include $croppath;
if(dgmdate(TIMESTAMP,'Y-m-d')!=dgmdate($cronupdate['timestamp'],'Y-m-d')){
	$uvs = C::t('#dc_vip#dc_vip')->updaterange(100);
	if(!empty($uvs)){
		foreach($uvs as $u){
			$_G['dc_plugin']['vip']['obj']->update($u,'data');
		}
	}else{
		$configdata = 'return '.var_export(array('timestamp'=>strtotime(dgmdate(TIMESTAMP,'Y-m-d'))), true).";\n\n";
		if($fp = @fopen($croppath, 'wb')) {
			fwrite($fp, "<?php\n//plugin VIP temp upgrade check file, DO NOT modify me!\n//Identify: ".md5($configdata)."\n\n$configdata?>");
			fclose($fp);
		}
	}

}
?>