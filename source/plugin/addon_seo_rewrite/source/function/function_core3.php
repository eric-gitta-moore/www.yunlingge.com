<?php 
function addon_seo_rewrite_forum_forumdisplay($_arg_0, $_arg_1, $_arg_2)
{
    global $_G;
    list(, , , $_var_4, $_var_5, $_var_6) = func_get_args();
    $_var_7 = array();
    if (strpos($_var_5, "&") !== false) {
        parse_str(str_replace("&amp;", "&", $_var_5), $_var_7);
        $_var_5 = $_var_7["page"];
    }
    $_var_8 = array("{fid}" => empty($_G["setting"]["forumkeys"][$_var_4]) ? $_var_4 : $_G["setting"]["forumkeys"][$_var_4], "{page}" => $_var_5 ? $_var_5 : 1);
    if (empty($_var_7["forumdefstyle"]) && empty($_var_7["searchsort"])) {
        if (in_array($_var_7["filter"], array("typeid", "sortid"))) {
            if ($_var_7["typeid"] > 0) {
                $_arg_0 = $_arg_0 . "_type";
                $_var_8["{typeid}"] = $_var_7["typeid"];
            }
            if ($_var_7["sortid"] > 0) {
                $_arg_0 = $_arg_0 . "_sort";
                $_var_8["{sortid}"] = $_var_7["sortid"];
            }
        }
        if ($_arg_0 != "forum_forumdisplay" && !$_G["cache"]["plugin"]["addon_seo_rewrite"][$_arg_0 . "_radio"] || $_arg_0 == "forum_forumdisplay" && !empty($_var_7["filter"])) {
            $_var_9 = "forum.php?mod=forumdisplay&fid=" . $_var_4 . (!empty($_var_7) ? "&" . http_build_query($_var_7) : ($_var_5 > 1 ? "&page=" . $_var_5 : ''));
            if (!$_arg_1) {
                return "<a href=\"" . $_arg_2 . $_var_9 . "\"" . (!empty($_var_6) ? stripslashes($_var_6) : '') . ">";
            }
            return $_arg_2 . $_var_9;
        }
        $_arg_0 = $_var_8["{page}"] > 1 && $_G["cache"]["plugin"]["addon_seo_rewrite"][$_arg_0 . "2"] ? $_arg_0 . "2" : $_arg_0;
    } else {
        $_var_9 = "forum.php?mod=forumdisplay&fid=" . $_var_4 . (!empty($_var_7) ? "&" . http_build_query($_var_7) : '');
        if (!$_arg_1) {
            return "<a href=\"" . $_arg_2 . $_var_9 . "\"" . (!empty($_var_6) ? stripslashes($_var_6) : '') . ">";
        }
        return $_arg_2 . $_var_9;
    }
    $_var_9 = str_replace(array_keys($_var_8), $_var_8, $_G["cache"]["plugin"]["addon_seo_rewrite"][$_arg_0]);
    if (!$_arg_1) {
        return "<a href=\"" . $_arg_2 . $_var_9 . "\"" . (!empty($_var_6) ? stripslashes($_var_6) : '') . ">";
    }
    return $_arg_2 . $_var_9;
}
if (!defined("IN_DISCUZ")) {
    echo "{ADDONVAR:SiteID}";
    return 0;
}