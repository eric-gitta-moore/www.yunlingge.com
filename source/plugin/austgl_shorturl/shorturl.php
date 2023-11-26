<?php  
header("content-type:text/html;charset=utf-8");
// error_reporting(0);
if(isset($_POST['sid'])){
	if($_POST['access_token'] == 'austgl.com'){
		$shorturl = returnShort($_POST['longUrl']);
		echo $shorturl;
	}else{
		echo 'error siteurl!';
	}
}
function returnShort($longurl){
	if(preg_match("#^http://(.*?).(com|net|cc|cn|org|tw|jp|us|uk|tv|mobi|info)#i",$longurl,$a)){
		$url = $longurl;
	}else if(preg_match("#([a-z0-9]).(com|net|cc|cn|org|tw|jp|us|uk|tv|mobi|info)#i",$longurl,$a)){
		$url = "http://".$longurl;
	}else{
		return "error address!";
	}
	// $url = addslashes($url);
	$url = htmlspecialchars(str_replace(array('<', '>'), '', str_replace('\\"', '\"', $url)));
	$url = urlencode($url);
	$obj = json_decode(getShort($url),true);
	return $obj['urls'][0]['url_short'];
}
function getShort($url){
	$url_long = "https://api.weibo.com/2/short_url/shorten.json?url_long=".$url."&access_token=2.00xWtw2CYita4Bcd98eb45c625kTyB";
	$ch =curl_init($url_long);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
	var_dum($content);
}
?>