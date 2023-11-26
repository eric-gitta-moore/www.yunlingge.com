<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
define('P_NAME', 'plugin/boan_glow');
cpheader();

$table = C::t('forum_bbcode')->getTable();
$edit = DB::fetch_first('SELECT * FROM '.DB::table($table).' WHERE '.DB::field('tag', 'glow'));
$bbcode = C::t('forum_bbcode')->fetch($edit['id']);
if(!$bbcode) {
    cpmsg('bbcode_not_found', '', 'error');
}

if(!submitcheck('editsubmit')) {
    showtips(lang(P_NAME, 'remember'));
    $bbcode['perm'] = explode("\t", $bbcode['perm']);
    $query = C::t('common_usergroup')->range_orderby_credit();
    $groupselect = array();
    foreach($query as $group) {
        $group['type'] = $group['type'] == 'special' && $group['radminid'] ? 'specialadmin' : $group['type'];
        $groupselect[$group['type']] .= '<option value="'.$group['groupid'].'"'.(@in_array($group['groupid'], $bbcode['perm']) ? ' selected' : '').'>'.$group['grouptitle'].'</option>';
    }
    $select = '<select name="permnew[]" size="10" multiple="multiple"><option value=""'.(@in_array('', $var['value']) ? ' selected' : '').'>'.cplang('plugins_empty').'</option>'.
        '<optgroup label="'.$lang['usergroups_member'].'">'.$groupselect['member'].'</optgroup>'.
        ($groupselect['special'] ? '<optgroup label="'.$lang['usergroups_special'].'">'.$groupselect['special'].'</optgroup>' : '').
        ($groupselect['specialadmin'] ? '<optgroup label="'.$lang['usergroups_specialadmin'].'">'.$groupselect['specialadmin'].'</optgroup>' : '').
        '<optgroup label="'.$lang['usergroups_system'].'">'.$groupselect['system'].'</optgroup></select>';

    $bbcode['prompt'] = str_replace("\t", "\n", $bbcode['prompt']);
    showformheader("plugins&operation=config&do=$pluginid");
    showtableheader();
    showsetting('misc_bbcode_edit_example', 'examplenew', $bbcode['example'], 'text');
    showsetting('misc_bbcode_edit_explanation', 'explanationnew', $bbcode['explanation'], 'text');
    showsetting('misc_bbcode_edit_usergroup', '', '', $select);
    showsubmit('editsubmit');
    showtablefooter();
    showformfooter();
} else {
			$permnew = implode("\t", $_GET['permnew']);
			C::t('forum_bbcode')->update($edit['id'], array('perm'=>$permnew));
			updatecache(array('bbcodes', 'bbcodes_display'));
			cpmsg('dzcode_edit_succeed', 'action=plugins&operation=config&do='.$pluginid, 'succeed');
}