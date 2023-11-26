<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
define('P_NAME', 'plugin/boan_glow');
cpheader();
showtips(lang(P_NAME, 'about'));