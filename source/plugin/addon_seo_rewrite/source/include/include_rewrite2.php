<?php
?>

<?php 
function study_rewritedata()
{
    global $_G;
    $_var_1 = array();
    $_var_2 = $_G["cache"]["plugin"]["addon_seo_rewrite"];
    $_var_1 = study_rewritedata2();
    if ($_var_2["forum_forumdisplay_gid"]) {
        $_var_1["rulesearch"]["forum_forumdisplay_gid"] = $_var_2["forum_forumdisplay_gid"];
        $_var_1["rulereplace"]["forum_forumdisplay_gid"] = "forum.php?gid={gid}";
        $_var_1["rulevars"]["forum_forumdisplay_gid"]["{gid}"] = "([0-9]+)";
    }
    if ($_var_2["forum_forumdisplay_type_radio"]) {
        $_var_1["rulesearch"]["forum_forumdisplay_type"] = $_var_2["forum_forumdisplay_type"];
        $_var_1["rulereplace"]["forum_forumdisplay_type"] = "forum.php?mod=forumdisplay&fid={fid}&filter=typeid&typeid={typeid}&page={page}";
        $_var_1["rulevars"]["forum_forumdisplay_type"]["{fid}"] = "(\\w+)";
        $_var_1["rulevars"]["forum_forumdisplay_type"]["{typeid}"] = "([0-9]+)";
        if (strpos($_var_2["forum_forumdisplay_type"], "{page}") !== false) {
            $_var_1["rulevars"]["forum_forumdisplay_type"]["{page}"] = "([0-9]+)";
        } else {
            $_var_1["rulereplace"]["forum_forumdisplay_type"] = str_replace("&page={page}", '', $_var_1["rulereplace"]["forum_forumdisplay_type"]);
        }
        if ($_var_2["forum_forumdisplay_type2"]) {
            $_var_1["rulesearch"]["forum_forumdisplay_type2"] = $_var_2["forum_forumdisplay_type2"];
            $_var_1["rulereplace"]["forum_forumdisplay_type2"] = "forum.php?mod=forumdisplay&fid={fid}&filter=typeid&typeid={typeid}&page={page}";
            $_var_1["rulevars"]["forum_forumdisplay_type2"]["{fid}"] = "(\\w+)";
            $_var_1["rulevars"]["forum_forumdisplay_type2"]["{typeid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_type2"]["{page}"] = "([0-9]+)";
        }
    }
    if ($_var_2["forum_forumdisplay_sort_radio"]) {
        $_var_1["rulesearch"]["forum_forumdisplay_sort"] = $_var_2["forum_forumdisplay_sort"];
        $_var_1["rulereplace"]["forum_forumdisplay_sort"] = "forum.php?mod=forumdisplay&fid={fid}&filter=sortid&sortid={sortid}&page={page}";
        $_var_1["rulevars"]["forum_forumdisplay_sort"]["{fid}"] = "(\\w+)";
        $_var_1["rulevars"]["forum_forumdisplay_sort"]["{sortid}"] = "([0-9]+)";
        if (strpos($_var_2["forum_forumdisplay_sort"], "{page}") !== false) {
            $_var_1["rulevars"]["forum_forumdisplay_sort"]["{page}"] = "([0-9]+)";
        } else {
            $_var_1["rulereplace"]["forum_forumdisplay_sort"] = str_replace("&page={page}", '', $_var_1["rulereplace"]["forum_forumdisplay_sort"]);
        }
        if ($_var_2["forum_forumdisplay_sort2"]) {
            $_var_1["rulesearch"]["forum_forumdisplay_sort2"] = $_var_2["forum_forumdisplay_sort2"];
            $_var_1["rulereplace"]["forum_forumdisplay_sort2"] = "forum.php?mod=forumdisplay&fid={fid}&filter=sortid&sortid={sortid}&page={page}";
            $_var_1["rulevars"]["forum_forumdisplay_sort2"]["{fid}"] = "(\\w+)";
            $_var_1["rulevars"]["forum_forumdisplay_sort2"]["{sortid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_sort2"]["{page}"] = "([0-9]+)";
        }
    }
    if ($_var_2["forum_forumdisplay_type_sort_radio"]) {
        if (strpos($_var_2["forum_forumdisplay_type_sort"], "{page}") === false) {
            $_var_1["rulesearch"]["forum_forumdisplay_type_sort"] = $_var_2["forum_forumdisplay_type_sort"];
            $_var_1["rulereplace"]["forum_forumdisplay_type_sort"] = "forum.php?mod=forumdisplay&fid={fid}&filter=sortid&sortid={sortid}&typeid={typeid}";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{fid}"] = "(\\w+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{typeid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{sortid}"] = "([0-9]+)";
        } else {
            $_var_1["rulesearch"]["forum_forumdisplay_type_sort"] = $_var_2["forum_forumdisplay_type_sort"];
            $_var_1["rulereplace"]["forum_forumdisplay_type_sort"] = "forum.php?mod=forumdisplay&fid={fid}&filter=sortid&sortid={sortid}&typeid={typeid}&page={page}";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{fid}"] = "(\\w+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{typeid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{sortid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort"]["{page}"] = "([0-9]+)";
        }
        if ($_var_2["forum_forumdisplay_type_sort2"]) {
            $_var_1["rulesearch"]["forum_forumdisplay_type_sort2"] = $_var_2["forum_forumdisplay_type_sort2"];
            $_var_1["rulereplace"]["forum_forumdisplay_type_sort2"] = "forum.php?mod=forumdisplay&fid={fid}&filter=sortid&sortid={sortid}&typeid={typeid}&page={page}";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort2"]["{fid}"] = "(\\w+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort2"]["{typeid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort2"]["{sortid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_forumdisplay_type_sort2"]["{page}"] = "([0-9]+)";
        }
    }
    if (in_array("group_group", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["group_group"] = $_G["setting"]["rewriterule"]["group_group"] ? $_G["setting"]["rewriterule"]["group_group"] : "group-{fid}-{page}.html";
        $_var_1["rulereplace"]["group_group"] = "forum.php?mod=group&fid={fid}&page={page}";
        $_var_1["rulevars"]["group_group"]["{fid}"] = "([0-9]+)";
        $_var_1["rulevars"]["group_group"]["{page}"] = "([0-9]+)";
    }
    if (in_array("home_space", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["home_space"] = $_G["setting"]["rewriterule"]["home_space"] ? $_G["setting"]["rewriterule"]["home_space"] : "space-{user}-{value}.html";
        $_var_1["rulereplace"]["home_space"] = "home.php?mod=space&{user}={value}";
        $_var_1["rulevars"]["home_space"]["{user}"] = "(username|uid)";
        $_var_1["rulevars"]["home_space"]["{value}"] = "(.+)";
    }
    if (in_array("home_blog", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["home_blog"] = $_G["setting"]["rewriterule"]["home_blog"] ? $_G["setting"]["rewriterule"]["home_blog"] : "blog-{uid}-{blogid}.html";
        $_var_1["rulereplace"]["home_blog"] = "home.php?mod=space&uid={uid}&do=blog&id={blogid}";
        $_var_1["rulevars"]["home_blog"]["{uid}"] = "([0-9]+)";
        $_var_1["rulevars"]["home_blog"]["{blogid}"] = "([0-9]+)";
    }
    if (in_array("forum_archiver", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["forum_archiver"] = $_G["setting"]["rewriterule"]["forum_archiver"] ? $_G["setting"]["rewriterule"]["forum_archiver"] : "{action}-{value}.html";
        $_var_1["rulereplace"]["forum_archiver"] = "index.php?action={action}&value={value}";
        $_var_1["rulevars"]["forum_archiver"]["{action}"] = "(fid|tid)";
        $_var_1["rulevars"]["forum_archiver"]["{value}"] = "([0-9]+)";
    }
    if ($_var_2["forum_tag_radio"]) {
        $_var_1["rulesearch"]["forum_tag_list"] = $_var_2["forum_tag_list"] ? $_var_2["forum_tag_list"] : "tag-{type}-{id}-{page}.html";
        $_var_1["rulereplace"]["forum_tag_list"] = "misc.php?mod=tag&id={id}&type={type}&page={page}";
        $_var_1["rulevars"]["forum_tag_list"]["{type}"] = "(thread|blog)";
        $_var_1["rulevars"]["forum_tag_list"]["{id}"] = "([0-9]+)";
        $_var_1["rulevars"]["forum_tag_list"]["{page}"] = "([0-9]+)";
        $_var_1["rulesearch"]["forum_tag_view"] = $_var_2["forum_tag_view"] ? $_var_2["forum_tag_view"] : "tag-{id}.html";
        $_var_1["rulereplace"]["forum_tag_view"] = "misc.php?mod=tag&id={id}";
        $_var_1["rulevars"]["forum_tag_view"]["{id}"] = "([0-9]+)";
        $_var_1["rulesearch"]["forum_tag_index"] = $_var_2["forum_tag_index"] ? $_var_2["forum_tag_index"] : "tag.html";
        $_var_1["rulereplace"]["forum_tag_index"] = "misc.php?mod=tag";
    }
    if (in_array("plugin", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["plugin"] = $_G["setting"]["rewriterule"]["plugin"] ? $_G["setting"]["rewriterule"]["plugin"] : "{pluginid}-{module}.html";
        $_var_1["rulereplace"]["plugin"] = "plugin.php?id={pluginid}:{module}";
        $_var_1["rulevars"]["plugin"]["{pluginid}"] = "([a-z]+[a-z0-9_]*)";
        $_var_1["rulevars"]["plugin"]["{module}"] = "([a-z0-9_\\-]+)";
    }
    return $_var_1;
}
if (!defined("IN_DISCUZ") || !defined("IN_ADMINCP")) {
    echo "{ADDONVAR:SiteUrl}";
    return 0;
}
require_once libfile("include/rewrite3", "plugin/addon_seo_rewrite/source");