<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

define("VALIDATE_PASS_TIME", 600);
define("REQUEST_ABATE_TIME", 250);
define("VALIDATE_WAIT_TIME", 2);
define("MAX_LENGTH", 50000);
define("PIC_POST_FIX", ".png");
define("PUBLIC_KEY_PATH", "http://down.vaptcha.com/publickey");
define("IS_DOWN_PATH", "http://down.vaptcha.com/isdown");
define("Channel_DownTime", "https://channel.vaptcha.com/config/");
define("DOWN_TIME_PATH", "offline/");
define("DOWNTIME_URL", 'https://offline.vaptcha.com/');
define("VERSION", '3.0.5');
define("SDK_LANG", 'php');
define("API_URL", 'http://0.vaptcha.com');
define("GET_CHALLENGE_URL", '/knock');
define("VALIDATE_URL", '/verify');
define("REQUEST_USED_UP", '0209');
define("DOWNTIME_CHECK_TIME", 185000);
