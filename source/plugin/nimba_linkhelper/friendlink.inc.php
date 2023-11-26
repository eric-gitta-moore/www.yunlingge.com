<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

loadcache('plugin');
$splugin_setting = $_G['cache']['plugin']['nimba_linkhelper'];

if(!submitcheck('linksubmit')){
?>
<script type="text/JavaScript">
var rowtypedata = [
	[
		[1,'', 'td25'],
		[1,'<input type="text" class="txt" name="newdisplayorder[]" size="3">', 'td28'],
		[1,'<input type="text" class="txt" name="newname[]" size="15">'],
		[1,'<input type="text" class="txt" name="newurl[]" size="20">'],
		[1,'<input type="text" class="txt" name="newdescription[]" size="30">'],
		[1,'<input type="text" class="txt" name="newlogo[]" size="20">'],
		[1,'<input class="checkbox" type="checkbox" value="1" name="newportal[]" checked>'],
		[1,'<input class="checkbox" type="checkbox" value="1" name="newforum[]" checked>'],
		[1,'<input class="checkbox" type="checkbox" value="1" name="newgroup[]" checked>'],
		[1,'<input class="checkbox" type="checkbox" value="1" name="newhome[]" checked>']
	]
]
</script>
<?php
    shownav('extended', 'misc_link');
    showsubmenu('nav_misc_links');
    showtips('misc_link_tips');
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=friendlink');
    showtableheader();
    showsubtitle(array('', 'display_order', 'misc_link_edit_name', 'misc_link_edit_url', 'misc_link_edit_description', 'misc_link_edit_logo', $splugin_setting['friendlink_group0'] ? $splugin_setting['friendlink_group0'] : 'misc_link_group1', $splugin_setting['friendlink_group1'] ? $splugin_setting['friendlink_group1'] : 'misc_link_group2', $splugin_setting['friendlink_group2'] ? $splugin_setting['friendlink_group2'] : 'misc_link_group3', $splugin_setting['friendlink_group3'] ? $splugin_setting['friendlink_group3'] : 'misc_link_group4'));
    showsubtitle(array('', '', '', '', '', '', '<input class="checkbox" type="checkbox" name="portalall" onclick="checkAll(\'prefix\', this.form, \'portal\', \'portalall\')">',
            '<input class="checkbox" type="checkbox" name="forumall" onclick="checkAll(\'prefix\', this.form, \'forum\', \'forumall\')">',
            '<input class="checkbox" type="checkbox" name="groupall" onclick="checkAll(\'prefix\', this.form, \'group\', \'groupall\')">',
            '<input class="checkbox" type="checkbox" name="homeall" onclick="checkAll(\'prefix\', this.form, \'home\', \'homeall\')">'));
    $query = DB::query("SELECT * FROM ".DB::table('common_friendlink')." ORDER BY displayorder");
    while ($forumlink = DB::fetch($query)) {
        $type = sprintf('%04b', $forumlink['type']);
        showtablerow('', array('class="td25"', 'class="td28"', '', '', ''), array('<input type="checkbox" class="checkbox" name="delete[]" value="' . $forumlink['id'] . '" />',
                '<input type="text" class="txt" name="displayorder[' . $forumlink[id] . ']" value="' . $forumlink['displayorder'] . '" size="3" />',
                '<input type="text" class="txt" name="name[' . $forumlink[id] . ']" value="' . dhtmlspecialchars($forumlink['name']) . '" size="15" />',
                '<input type="text" class="txt" name="url[' . $forumlink[id] . ']" value="' . dhtmlspecialchars($forumlink['url']) . '" size="20" />',
                '<input type="text" class="txt" name="description[' . $forumlink[id] . ']" value="' . dhtmlspecialchars($forumlink['description']) . '" size="30" />',
                '<input type="text" class="txt" name="logo[' . $forumlink[id] . ']" value="' . dhtmlspecialchars($forumlink['logo']) . '" size="20" />',
                '<input class="checkbox" type="checkbox" value="1" name="portal[' . $forumlink[id] . ']" ' . ($type[0] ? "checked" : '') . '>',
                '<input class="checkbox" type="checkbox" value="1" name="forum[' . $forumlink[id] . ']" ' . ($type[1] ? "checked" : '') . '>',
                '<input class="checkbox" type="checkbox" value="1" name="group[' . $forumlink[id] . ']" ' . ($type[2] ? "checked" : '') . '>',
                '<input class="checkbox" type="checkbox" value="1" name="home[' . $forumlink[id] . ']" ' . ($type[3] ? "checked" : '') . '>',
                ));
    }
    echo '<tr><td></td><td colspan="3"><div><a href="#" onclick="addrow(this, 0)" class="addtr">' . $lang['misc_link_add'] . '</a></div></td></tr>';
    showsubmit('linksubmit', 'submit', 'del');
    showtablefooter();
    showformfooter();
}else {
    // 入库前处理
    $postdata = daddslashes(dstripslashes($_POST));
    if($postdata['delete']) {
        DB::delete('common_friendlink', "id IN (" . dimplode($postdata['delete']) . ")");
    }
    if(is_array($postdata['name'])) {
        foreach($postdata['name'] as $id => $val) {
            $type_str = intval($postdata['portal'][$id]) . intval($postdata['forum'][$id]) . intval($postdata['group'][$id]) . intval($postdata['home'][$id]);
            $type_str = intval($type_str, '2');
            DB::update('common_friendlink', array('displayorder' => $postdata['displayorder'][$id],
                    'name' => $postdata['name'][$id],
                    'url' => $postdata['url'][$id],
                    'description' => $postdata['description'][$id],
                    'logo' => $postdata['logo'][$id],
                    'type' => $type_str,
                    ), array('id' => intval($id),
                    ));
        }
    }
    if(is_array($postdata['newname'])) {
        foreach($postdata['newname'] as $key => $value) {
            if($value) {
                $type_str = intval($postdata['newportal'][$key]) . intval($postdata['newforum'][$key]) . intval($postdata['newgroup'][$key]) . intval($postdata['newhome'][$key]);
                $type_str = intval($type_str, '2');
                DB::insert('common_friendlink', array('displayorder' => $postdata['newdisplayorder'][$key],
                        'name' => $value,
                        'url' => $postdata['newurl'][$key],
                        'description' => $postdata['newdescription'][$key],
                        'logo' => $postdata['newlogo'][$key],
                        'type' => $type_str,
                        ));
            }
        }
    }
    updatecache('forumlinks');
    cpmsg('forumlinks_succeed','action=plugins&operation=config&do='.$pluginid.'&identifier=nimba_linkhelper&pmod=friendlink', 'succeed');
}



?>