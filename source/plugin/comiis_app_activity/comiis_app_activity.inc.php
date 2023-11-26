<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$comiis_bg = 1;
$plugin_id = 'comiis_app_activity';
$comiis_upload = 0;
$comiis_info = array();
$comiis_system_config = array();
$comiis_md5file = array();
$siteuniqueid = $_G['setting']['siteuniqueid'] ? $_G['setting']['siteuniqueid'] : C::t('common_setting')->fetch('siteuniqueid');
if (file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php')) {
    include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php';
    if (md5(md5($plugin_id) . $comiis_time['dateline'] . 'comiis' . $siteuniqueid) != $comiis_time['md5'] || !($comiis_time['dateline'] - 30 * 86400 >= time())) {
        $comiis_upload = 1;
    }
} else {
    $comiis_upload = 1;
}
if ($_GET['comiis_up_sn'] === 'yes') {
    $comiis_upload = 1;
}
if ($comiis_upload == 1) {
    loadcache($plugin_id . '_up');
    if ($_G['cache'][$plugin_id . '_up']['up'] != 1) {
        save_syscache($plugin_id . '_up', array('up' => 1));
        if (!function_exists('comiis_app_load_app_activity_data')) {
            if (!file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis.php')) {
                return false;
            }
            include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis.php';
        }
        if (!function_exists('comiis_app_load_app_activity_data')) {
            return false;
        }
        comiis_app_load_app_activity_data($plugin_id);
        save_syscache($plugin_id . '_up', array('up' => 0));
    }
}
if (!file_exists(DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php')) {
    return false;
}
include DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/comiis_info/comiis_md5file.php';

require DISCUZ_ROOT . './source/plugin/' . $plugin_id . '/language/language.' . currentlang() . '.php';
loadcache('plugin');
$comiis_app_activity_set = $_G['cache']['plugin']['comiis_app_activity'];
$mpp = $comiis_app_activity_set['list_num'];
$page = max(1, intval($_GET['page']));
$startlimit = ($page - 1) * $mpp;
$activitytypelist = $_G['setting']['activitytype'] ? explode("\n", trim($_G['setting']['activitytype'])) : array();
$comiis_app_activityclass = !in_array($_GET['class'], $activitytypelist) ? '' : $_GET['class'];
$comiis_app_activitytype = !in_array($_GET['type'], array('start', 'end', 'participate', 'launched')) ? '' : $_GET['type'];
$comiis_head = array('left' => '', 'center' => $comiis_app_activity_set['name'], 'right' => $comiis_app_activity_set['post_url'] ? '<a href="' . $comiis_app_activity_set['post_url'] . '"><i class="comiis_font">&#xe62d;</i></a>' : '');
$navtitle = $comiis_app_activity_set['name'];
$fids = array();
$list_ad = array();
if ($comiis_app_activity_set['list_ad']) {
    $ad_line = explode("\n", $comiis_app_activity_set['list_ad']);
    if (is_array($ad_line)) {
        foreach ($ad_line as $ad_array) {
            $ad = explode('|', $ad_array);
            $list_ad[$ad[0]][] = $ad;
        }
    }
}
$fids = unserialize($comiis_app_activity_set['fids']);
if (!(isset($fids[0]) && ($fids[0] == '0' || $fids[0] == ''))) {
}
$maxwhere = '';
if ($_G['setting']['blockmaxaggregationitem']) {
    $maxid = comiis_getmaxid() - $_G['setting']['blockmaxaggregationitem'];
    $maxwhere = comiis_getmaxid() - $_G['setting']['blockmaxaggregationitem'] > 0 ? 't.tid > ' . $maxid . ' AND ' : '';
}
$where = ($comiis_app_activityclass ? ' AND a.class=\'' . trim($comiis_app_activityclass) . '\'' : '') . ($fids ? ' AND t.fid IN (' . dimplode($fids) . ')' : '');
if ($comiis_app_activitytype == 'participate') {
    $from = DB::table('forum_activityapply') . ' aa INNER JOIN ' . DB::table('forum_activity') . ' a ON aa.tid=a.tid INNER JOIN ' . DB::table('forum_thread') . ' t ON t.tid=a.tid';
    $where .= ' AND aa.uid=\'' . $_G['uid'] . '\'';
} else {
    $from = DB::table('forum_activity') . ' a INNER JOIN ' . DB::table('forum_thread') . ' t ON t.tid=a.tid';
    if ($comiis_app_activitytype == 'start' || $comiis_app_activitytype == 'end') {
        $where .= ' AND (case when a.starttimeto>\'0\' then a.starttimeto' . ($comiis_app_activitytype == 'start' ? '>' : '<') . '\'' . TIMESTAMP . '\' else a.starttimefrom' . ($comiis_app_activitytype == 'start' ? '>' : '<') . '\'' . TIMESTAMP . '\' end)';
    } elseif ($comiis_app_activitytype == 'launched') {
        $where .= ' AND uid=\'' . $_G['uid'] . '\'';
    }
}
$comiis_pl = !in_array($comiis_app_activity_set['timeoder'], array('tid', 'cost', 'starttimefrom', 'starttimeto', 'number', 'applynumber', 'expiration', 'credit')) ? 'tid' : $comiis_app_activity_set['timeoder'];
$comiis_plss = intval($comiis_app_activity_set['oder']) ? ' DESC ' : ' ASC ';
$num = DB::result_first('SELECT COUNT(*) FROM ' . $from . ' WHERE ' . $maxwhere . 't.displayorder>=\'0\'' . $where);
$multipage = multi($num, $mpp, $page, 'plugin.php?id=comiis_app_activity' . ($comiis_app_activityclass ? '&class=' . urlencode($comiis_app_activityclass) : '') . ($comiis_app_activitytype ? '&type=' . $comiis_app_activitytype : ''));
$comiis_app_activity = DB::fetch_all('SELECT t.subject, t.views, t.tid, a.starttimefrom, a.starttimeto, a.class, a.aid FROM ' . $from . ' WHERE ' . $maxwhere . 't.displayorder>=\'0\'' . $where . ' ORDER BY a.' . $comiis_pl . $comiis_plss . DB::limit($startlimit, $mpp));
include_once template('comiis_app_activity:comiis_html');
function comiis_getmaxid()
{
    loadcache('databasemaxid');
    $data = getglobal('cache/databasemaxid');
    if (!isset($data['thread']) || TIMESTAMP - $data['thread']['dateline'] >= 86400) {
        $data['thread']['dateline'] = TIMESTAMP;
        $data['thread']['id'] = DB::result_first('SELECT MAX(tid) FROM ' . DB::table('forum_thread'));
        savecache('databasemaxid', $data);
    }
    return $data['thread']['id'];
}