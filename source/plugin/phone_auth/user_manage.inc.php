<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
  exit('Access Denied');
}
require_once dirname(__FILE__) . '/lib/function.php';

$static_path  = get_static_path();
$site_url = get_site_url();
$members = C::t('#phone_auth#common_vphone')->fetch_all();
include template('phone_auth:user_manage');
?>

