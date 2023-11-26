<?php
if (!defined('IN_DISCUZ') || !defined('IN_MDOWN_API')) {
    exit('Access Denied');
}
function getRootCategoryListAction() { return C::t('#mdown#mdown_category')->fetchAllByParentyId(0); }
function queryAction() { return C::t('#mdown#mdown_resource')->query(); }
function topNewAction() { return C::t('#mdown#mdown_resource')->fetchTop('mtime'); }
function topHotAction() { return C::t('#mdown#mdown_resource')->fetchTop('downnum'); }
?>