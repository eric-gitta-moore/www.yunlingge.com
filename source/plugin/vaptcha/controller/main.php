<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once dirname(dirname(__FILE__)) . '/lib/helper.class.php';
require_once dirname(dirname(__FILE__)) . '/lib/vaptcha.class.php';


class Main {
    
    private $vaptcha;

    public function __construct(){
        global $_G;
        $vid = Helper::config('nvid');
        $key = Helper::config('nkey');
        $this->vaptcha = new Vaptcha($vid, $key);
    }

    public function knock() {
        return $this->vaptcha->getknock($_REQUEST['scene']);
    }

    public function offline() {
        return $this->vaptcha->downTime($_GET['offline_action'], $_GET['callback'], $_GET['v'], $_GET['knock']);
    }
}