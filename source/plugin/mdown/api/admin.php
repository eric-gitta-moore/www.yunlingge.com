<?php
if (!defined('IN_DISCUZ') || !defined('IN_MDOWN_API')) {
    exit('Access Denied');
}
authUsergroup(array(1));
function saveAction(){ return C::t('#mdown#mdown_category')->save(); }
function queryAction() { return C::t('#mdown#mdown_category')->query(); }
function removeAction() { return C::t('#mdown#mdown_category')->remove(); }
function setDisplayorderAction() { return C::t('#mdown#mdown_category')->setDisplayorder(); }
function getOptionsAction() {
    $res = array();
    $key = mdown_validate::getNCParameter('key','key','string',1024);
    switch ($key) {
        case 'category': $res=C::t("#mdown#mdown_category")->getOptions(); break;
        default: break;
    }
    return $res;
}
function queryResourceAction() { return C::t('#mdown#mdown_resource')->queryByAdmin(); }
function saveResourceAction() { return C::t('#mdown#mdown_resource')->save(); }
function removeResourceAction() { return C::t('#mdown#mdown_resource')->remove(); }
function setStatusAction() { return C::t('#mdown#mdown_resource')->setStatus(); }
function queryDownlogAction() { return C::t('#mdown#mdown_log')->query(); }
?>