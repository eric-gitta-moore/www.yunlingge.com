<?php
define("IN_MDOWN_API", 1);
define("MDOWN_PLUGIN_PATH", dirname(__FILE__));
chdir("../../../");
require_once('./source/class/class_core.php');
$discuz = C::app();
$discuz->init();
require_once(MDOWN_PLUGIN_PATH.'/class/env.class.php');
$module = isset($_GET['module']) ? $_GET['module'] : ''; 
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$retcode = 0;
try {
    $modules = array ('admin','resource');
    if(!in_array($_GET['module'], $modules)) {
        throw new Exception("module not found[$module]");
    }
	$apifile = MDOWN_PLUGIN_PATH."/api/$module.php";
	if(file_exists($apifile)) {
		require_once $apifile;
		$actionFun = $action."Action";
		if (!function_exists($actionFun)) {
			throw new Exception("unkown action[$action] in api module[$module]");
		}   
		$res = $actionFun();
		apiOutput(array("data"=>$res));
		exit(0);
	}
    throw new Exception("module not found[$module]");
} catch (Exception $e) {
	if ($retcode==0) $retcode = 1001;
	$retmsg = decodeUnicode($e->getMessage());
    apiOutput(array('retcode'=>$retcode,'retmsg'=>$retmsg));
}
function decodeUnicode($str) 
{
	$arr = json_decode("{\"str\":\"".$str."\"}",true);
	return $arr['str'];
}
function authLogin()
{
    global $_G,$retcode;
    if ($_G['uid']==0) {
        $retcode = 1002;
        throw new Exception("please login");
    }
}
function authUsergroup(array $groupids)
{
    global $_G,$retcode;
    $groupid = $_G["groupid"];
    if (!empty($groupids) && !in_array($groupid,$groupids)) {
        $retcode = 1003;
        throw new Exception('Illegal Request [groupid:'.$groupid.' is forbidden]');
    }
}
function apiOutput(array $result, $json_header=true)
{
    if (!isset($result['retcode'])) {
        $result['retcode'] = 0;
    }
    if (!isset($result['retmsg'])) {
        $result['retmsg'] = 'succ';
    }
    if ($json_header) {
        dheader("Content-type: application/json");
    }
    echo json_encode($result);
    exit;
}
?>