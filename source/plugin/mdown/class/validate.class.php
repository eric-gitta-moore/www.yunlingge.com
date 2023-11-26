<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class mdown_validate
{
    public static function post_decode($value) 
    {
        $value = htmlspecialchars_decode($value);
        $value = preg_replace("/&apos;/i", "'", $value);
        $value = preg_replace("/&lk;/i", "(", $value);
        $value = preg_replace("/&gk;/i", ")", $value);
        return $value;
    }
	public static function getNCParameter($key, $name, $valueType='string', $maxlen=1024)
	{
		if (!isset($_REQUEST[$key]) && !isset($_FILES[$key])) {
			$msg = $key." is not set.";
			throw new Exception($msg);
			return null;
		}
        if (isset($_REQUEST[$key])) {
		    $value = trim($_REQUEST[$key]);
            $value = self::post_decode($value); 
		    $_REQUEST[$key] = $value;
        }
		$res = true;
		switch($valueType) {
			case "string"  : $res = self::checkString($value, $maxlen); break;
			case "number"  : $res = self::checkNumber($value); break;
			case "integer" : $res = self::checkInteger($value); break;
			case "url"     : $res = self::checkUrl($key, $maxlen); break;
			case "email"   : $res = self::checkEmail($key); break;
            case "file"    : return self::checkUploadFile($key,$maxlen); break;
			default:
				if (preg_match($valueType, $value)) {
					$res = true;
				} else {
					$res = "\u683c\u5f0f\u4e0d\u6b63\u786e";
				}
				break;
		}
		if ($res !== true) {
			$msg = $name.$res;
			throw new Exception($msg);
		}
        return $_REQUEST[$key];
	}
	public static function getOPParameter($key, $name, $valueType='string', $maxlen=1024, $dafaultValue="")
	{
		if (!isset($_REQUEST[$key]) || $_REQUEST[$key]==="") {
			$_REQUEST[$key] = $dafaultValue;
			return $dafaultValue;
		}
		return self::getNCParameter($key, $name, $valueType, $maxlen);
	}
	private static function checkString($str_utf8, $maxlen)
	{
		if (mb_strlen($str_utf8, "UTF-8") > $maxlen) {
			return "\u4e0d\u80fd\u8d85\u8fc7 ".$maxlen." \u4e2a\u5b57";
		}
		$illegalCharacters = array('delete', 'null', '||');
		foreach ($illegalCharacters as &$wd) {
			if (stristr($str_utf8, $wd)) {
				return "\u4e0d\u80fd\u5305\u542b\u5b57\u7b26 $wd";
			}
		}
		return true;
	}
	private static function checkNumber($value)
	{
		if (!is_numeric($value)) {
			return "\u5fc5\u987b\u662f\u6570\u5b57";
		}
		return true;
	}
	private static function checkInteger($value)
	{
		$regex = "/^-?\d+$/";
		if (!preg_match($regex, $value)) {
			return "\u5fc5\u987b\u662f\u6574\u6570";
		}
		return true;
	}
	private static function checkUrl($key, $maxlen)
	{
		$value = trim($_REQUEST[$key]);
		$res = self::checkString($value, $maxlen);
		if ($res !== true) {
			return $res;
		}
		$regex = "/^(https?:\/\/)?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-z_!~*'()-]+\.)*([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.[a-z]{2,6})(:[0-9]{1,4})?((\/?)|(\/[^\s]+)+\/?)$/i";
		if (!preg_match($regex, $value)) {
			return "\u4e0d\u7b26\u5408\u6807\u51c6\u0055\u0052\u004c\u683c\u5f0f";
		}
		$initial = substr($value, 0, 4);
        if (strcmp($initial, "http") != 0) {
            $_REQUEST[$key] = "http://" . $value;
		}
		return true;
	}
	private static function checkEmail($value, $maxlen)
	{
		$regex = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
		if (!preg_match($regex, $value)) {
			return "\u5fc5\u987b\u662f Email";
		}
		return true;
	}
    private static function checkUploadFile($fileid,$maxsize)
    {
		$upfile = $_FILES[$fileid];
		if ($upfile["error"]!==0) {
			$err = $upfile["error"];
			$errMap = array(
				'1' => '\u6587\u4ef6\u5927\u5c0f\u8d85\u51fa\u670d\u52a1\u5668\u7a7a\u95f4\u5927\u5c0f',
				'2' => '\u6587\u4ef6\u8d85\u51fa\u6d4f\u89c8\u5668\u9650\u5236\u5927\u5c0f',
				'3' => '\u6587\u4ef6\u4ec5\u90e8\u5206\u88ab\u4e0a\u4f20',
				'4' => '\u672a\u627e\u5230\u8981\u4e0a\u4f20\u7684\u6587\u4ef6',
				'5' => '\u670d\u52a1\u5668\u4e34\u65f6\u6587\u4ef6\u4e22\u5931',
				'6' => '\u6587\u4ef6\u5199\u5165\u5230\u4e34\u65f6\u6587\u4ef6\u51fa\u9519',
			);
			$errMsg = isset($errMap[$err]) ? $errMap[$err] : "\u6587\u4ef6\u672a\u4e0a\u4f20\u6216\u4e0a\u4f20\u5931\u8d25";
			throw new Exception($errMsg);
		}
		if ($maxsize>0 && $upfile['size'] > $maxsize) {
			throw new Exception('\u6587\u4ef6\u5927\u5c0f\u4e0d\u80fd\u8d85\u8fc7 '.self::get_file_size_string($maxsize));
		}
		return $upfile;
    }
    public static function get_file_size_string($size)
    {
        if ($size<1024) return $size." B";
        if ($size<1024*1024) {
            $s = floatval($size) / 1024;
            return number_format($s, 2)." KB";
        }
        if ($size<1024*1024*1024) {
            $s = floatval($size) / (1024*1024);
            return number_format($s, 2)." MB";
        }
        $s = floatval($size) / (1024*1024*1024);
        return number_format($s, 2)." GB";
    }
}
?>