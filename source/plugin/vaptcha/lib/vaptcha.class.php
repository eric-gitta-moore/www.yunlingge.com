<?php
require_once  dirname(__FILE__).'/config.php';
// require_once dirname(dirname(__FILE__)) . './lib/session.class.php';
session_start();
class Vaptcha
{
    private $vid;
    private $key;
    // private $publicKey;
    private $lastCheckdownTime = 0;
    private $isDown = false;

    //宕机模式通过签证
    private static $passedSignatures = array();

    public function __construct($vid, $key)
    {
        $this->vid = $vid;
        $this->key = $key;
    }

    /**
     * 获取流水号
     *
     * @param string $sceneId 场景id
     * @return void
     */
    public function getChallenge($sceneId = 0) 
    {
        $url = API_URL.GET_CHALLENGE_URL;
        $now = $this->getCurrentTime();
        $query = "id=$this->vid&scene=$sceneId&time=$now&version=".VERSION.'&sdklang='.SDK_LANG;
        $signature = $this->HMACSHA1($this->key, $query);
        if (!$this->isDown)
        {
            $knock = self::readContentFormGet("$url?$query&signature=$signature");
            if ($knock === REQUEST_USED_UP) {
                // $this->lastCheckdownTime = $now;
                // $this->isDown = true;
                self::$passedSignatures = array();
                return $this->getDownTimeCaptcha();
            }
            if (empty($knock)) {
                if ($this->getIsDwon()) {
                    $this->lastCheckdownTime = $now;
                    $this->isDown = true;
                    self::$passedSignatures = array();
                }
                return $this->getDownTimeCaptcha();
            } 
            return json_encode(array(
                "vid" =>  $this->vid,
                "knock" => $knock
            ));
        } else {
        if ($now - $this->lastCheckdownTime > DOWNTIME_CHECK_TIME) {
                $this->lastCheckdownTime = $now;
                $knock = self::readContentFormGet("$url?$query&signature=$signature");
                if ($knock && $knock != REQUEST_USED_UP){
                    $this->isDown = false;
                    self::$passedSignatures = array();
                    return json_encode(array(
                        "vid" =>  $this->vid,
                        "knock" => $knock
                    ));
                }
            }
            return $this->getDownTimeCaptcha();
        }
    }

    /**
     * 二次验证
     *
     * @param [string] $knock 流水号
     * @param [sring] $token 验证信息
     * @param string $sceneId 场景ID 不填则为默认场景
     * @return void
     */
    public function validate($knock, $token, $sceneId = 0)
    {
        $str = 'ffline-';
        if (strpos($token, $str, 0)) {
            return $this->downTimeValidate($token);
        } else {
            return $this->normalValidate($knock, $token, $sceneId);
        }
    }

    private function getPublicKey()
    {
        return self::readContentFormGet(PUBLIC_KEY_PATH);
    }

    public function getChannelData()
    {
        $url = Channel_DownTime . $this->vid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = str_replace('static(', '',  $res);
        $data = str_replace(')', '', $data);
        $data = json_decode($data, true);
        return $data;
    }

    private function getIsDwon()
    {
        $channel = self::getChannelData();
        if($channel['state']== 1) {self::$isDown = false;return true;}
        if($channel['offline'] == 1) {self::$isDown = true;return true;}
        return false;
    }

    public function downTime($data, $callback, $v=null, $knock=null)
    {
        if (!$data)
            return json_encode(array("error" => "params error"));
        $datas = explode(',', $data);
        switch ($datas[0]) {
            case 'get': 
                return $this->getDownTimeCaptcha($callback);
            case 'request':
                return $this->getDownTimeCaptcha();
            case 'getsignature':
                if (count($datas) < 2) {
                    return array("error" => "params error");
                } else {
                    $time = (int) $datas[1];
                    if ((bool) $time) {
                        return $this->getSignature($time);
                    } else {
                        return array("error" => "params error");
                    }

                }
            case 'verify':
                if ($v == null) {
                    return array("error" => "params error");
                } else {
                    // $time1 = (int) $datas[1];
                    // $time2 = (int) $datas[2];
                    // $signature = $datas[3];
                    // $captcha = $datas[4];
                    // if ((bool) $time1 && (bool) $time2) {
                    //     return $this->downTimeCheck($time1, $time2, $signature, $captcha);
                    // }

                    // return array("error" => "parms error");
                    return $this->downTimeCheck($callback ,$v, $knock);
                }
            default:
                return array("error" => "parms error");
        }
    }

    private function getCurrentTime() {
        return number_format(floor(microtime(true) * 1000), 0, '', '');
    }

    private function getSignature($time)
    {
        $now = $this->getCurrentTime();
        if (($now - $time) > REQUEST_ABATE_TIME)
            return null;
        $signature = md5($now.$this->key);
        return json_encode(array(
            'time' => $now,
            'signature' => $signature
        ));
    }

    public static function set($key, $value, $expire = 600)
    {
        $data = $_SESSION[$key];
        return $_SESSION[$key] = array(
            'value' => $value,
            'create' => time(),
            'readcount' => 0,
            'expire' => $data['expire'] ? $data['expire'] : $expire,
        );
    }

    public static function get($key, $default = null)
    {
        $data = $_SESSION[$key];
        $now = time();
        if (!$data) {
            return $default;
        } else if ($now - $data['create'] > $data['expire']) {
            return $default;
        } else {
            $_SESSION[$key]['readcount']++;
            return $data['value'];
        }
    }

    public function create_uuid($prefix = ""){
        $str = md5(uniqid(mt_rand(), true));   
        $uuid  = substr($str,0,8) . '-';   
        $uuid .= substr($str,8,4) . '-';   
        $uuid .= substr($str,12,4) . '-';   
        $uuid .= substr($str,16,4) . '-';   
        $uuid .= substr($str,20,12);   
        return $prefix . $uuid;
    }

    /**
     * 宕机模式验证
     * 
     * @param [int] $time1
     * @param [int] $time2
     * @param [string] $signature
     * @param [string] $captcha
     * @return void
     */
    private function downTimeCheck($callback, $v, $knock)
    {
        $data = $this->getChannelData();
        $dtkey = $data['offline_key'];
        $imgs = $this->get($knock);
        unset($_SESSION[$knock]);
        $address = md5($v.$imgs);
        $url = DOWNTIME_URL.$dtkey.'/'.$address;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $res = curl_exec($ch);
        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpCode == 200) {
            $token = 'offline-'.$knock.'-'.$this->create_uuid().'-'.$this->getCurrentTime();;
            $this->set($token, $this->getCurrentTime());
            return $callback.'('.json_encode(array(
                "code" => '0103',
                "msg" => "",
                "token" => $token
            )).')';
        }
        else {
            return $callback.'('.json_encode(array(
                "code" => '0104',
                "msg" => "0104",
                "token" => "",
                // "v" => $v,
                // "imgs" => $imgs,
                // "md5" => $url
            )).')';
        }
        
    }

    private function normalValidate($knock, $token, $sceneId)
    {
        if (!$token)
            return false;
        $ip = $this->getClientIp();
        $query = "id=$this->vid&scene=$sceneId&secretkey=$this->key&token=$token&ip=$ip";
        $url = API_URL.VALIDATE_URL.'?' . $query;
        $now = $this->getCurrentTime();
        $response = json_decode(self::postValidate($url, $query));
        return $response->success == 1;
    }

    public function getClientIp()
    {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            $ips = explode(',', $ip);
            $ip = $ips[0];
        } else if (getenv('HTTP_X_REAL_IP')) {
            $ip = getenv('HTTP_X_REAL_IP');
        } else if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = '127.0.0.1';
        }

        return $ip;
    }

    private function downTimeValidate($token)
    {
        $strs = explode('-', $token);
        if (count($strs) < 2) {
            return false;
        } else {
            $time = (int) $strs[count($strs) - 1];
            // $signature = $strs[1];
            $storageTIme = $this->get($token);
            $now = $this->getCurrentTime();
            // return $time.'  '.($strs[count($strs)]);
            if ($now - $time > VALIDATE_PASS_TIME) {
                return false;
            } else {
                if ($storageTIme && $storageTIme==$time) {
                    return true;
                    // if (in_array($signature, self::$passedSignatures)) {
                    //     return false;
                    // } else {
                    //     array_push(self::$passedSignatures, $signature);
                    //     $length = count(self::$passedSignatures);
                    //     if ($length > MAX_LENGTH) {
                    //         array_splice(self::$passedSignatures, 0, $length - MAX_LENGTH + 1);
                    //     }

                    //     return true;
                    // }
                } else {
                    return false;
                }

            }
        }
    }

    private function getDownTimeCaptcha($callback = null)
    {
        $time = $this->getCurrentTime();
        $md5 = md5($time . $this->key);
        $captcha = substr($md5, 0, 3);
        // if (!self::$publicKey) {
        //     self::$publicKey = $this->getPublicKey();
        // }
        $data = $this->getChannelData();
        $knock = md5($captcha . $$time . $data['offline_key']);
        $ul = $this->getImgUrl();
        $url = md5($data['offline_key'] . $ul);
        // self::$imgid = $url;
        $this->set($knock, $url);
        // Session::set($knock, $url);
        return $callback===null?array(
            "time" => $time,
            "url" => $url,
        ): $callback.'('.json_encode(array(
            "time" => $time,
            "imgid" => $url,
            "code" => '0103',
            "knock" => $knock,
            "msg" => "",
        )).')';
    }

    private function getImgUrl()
    {
        $str = '0123456789abcdef';
        $data = '';
        for ($i=0; $i < 4; $i++) { 
            # code...
            $data = $data.$str[rand(0, 15)];
        }
        return $data;
    }

    private static function postValidate($url, $data)
    {
        if (function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);  
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HEADER, false);  
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType:application/x-www-form-urlencoded'));  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);  
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5*1000);  
            $errno = curl_errno($ch);
            $response = curl_exec($ch);
            curl_close($ch);
            return $errno > 0 ? 'error' : $response;
        } else {
            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header'=> "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n",
                    'content' => $data,
                    'timeout' => 5*1000
                ),
                'content' => $data
            );
            $context = stream_context_create($opts);
            $response = @file_get_contents($url, false, $context);
            return $response ? $response : 'error';
        }
        
    }

    private static function readContentFormGet($url)
    {
        if (function_exists('curl_exec')) {
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);  
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5*1000);  
            $errno = curl_errno($ch);
            $response = curl_exec($ch);
            curl_close($ch);
            return $errno > 0 ? false : $response;
        } else {
            $opts = array(
                'http' => array(
                    'method' => 'GET',
                    'timeout' => 5*1000
                )
            );
            $context = stream_context_create($opts);
            $response = @file_get_contents($url, false, $context);
            return $response ? $response : false;
        }
    }

    private function HMACSHA1($key, $str)
    {
        $signature = "";  
        if (function_exists('hash_hmac')) {
            $signature = hash_hmac("sha1", $str, $key, true);
        } else {
            $blocksize = 64;  
            $hashfunc = 'sha1';  
            if (strlen($key) > $blocksize) {  
                $key = pack('H*', $hashfunc($key));  
            }  
            $key = str_pad($key, $blocksize, chr(0x00));  
            $ipad = str_repeat(chr(0x36), $blocksize);  
            $opad = str_repeat(chr(0x5c), $blocksize);  
            $signature = pack(  
                    'H*', $hashfunc(  
                            ($key ^ $opad) . pack(  
                                    'H*', $hashfunc(  
                                            ($key ^ $ipad) . $str  
                                    )  
                            )  
                    )  
            );  
        }  
        $signature = str_replace(array('/', '+', '='), '', base64_encode($signature));
        return $signature;  
    }
}