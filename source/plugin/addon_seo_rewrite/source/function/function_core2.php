<?php
function addon_seo_rewrite_rewriteoutput($_arg_0, $_arg_1, $_arg_2)
{
    global $_G;
    if ($_arg_0 == "forum_forumdisplay") {
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
    } else {
        if ($_arg_0 == "forum_viewthread") {
            list(, , , $_var_10, $_var_5, $_var_11, $_var_6) = func_get_args();
            $_var_7 = array();
            if (strpos($_var_5, "&") !== false) {
                parse_str(str_replace("&amp;", "&", $_var_5), $_var_7);
                $_var_5 = $_var_7["page"];
                if (!empty($_var_7["authorid"]) || !empty($_var_7["ordertype"]) || !empty($_var_7["fromuid"]) || !empty($_var_7["from"])) {
                    $_var_9 = "forum.php?mod=viewthread&tid=" . $_var_10 . "&" . http_build_query($_var_7);
                    if (!$_arg_1) {
                        return "<a href=\"" . $_arg_2 . $_var_9 . "\"" . (!empty($_var_6) ? stripslashes($_var_6) : '') . ">";
                    }
                    return $_arg_2 . $_var_9;
                }
            } else {
                if (strpos($_var_5, "%") !== false) {
                    $_var_5 = 1;
                }
            }
            $_var_8 = array("{tid}" => $_var_10, "{page}" => $_var_5 ? $_var_5 : 1, "{prevpage}" => $_var_11 && !IS_ROBOT ? $_var_11 : 1);
            $_arg_0 = $_var_8["{page}"] > 1 && $_G["cache"]["plugin"]["addon_seo_rewrite"][$_arg_0 . "2"] ? $_arg_0 . "2" : $_arg_0;
            if (strpos($_G["cache"]["plugin"]["addon_seo_rewrite"][$_arg_0], "{fid}") !== false) {
                if ($_G["tid2fid"][$_var_10]) {
                    $_var_4 = intval($_G["tid2fid"][$_var_10]);
                } else {
                    if ($_G["forum_thread"]["tid"] == $_var_10) {
                        $_var_4 = $_G["forum_thread"]["fid"];
                    } else {
                        $_var_12 = C::t("forum_thread")->fetch($_var_10);
                        $_var_4 = $_var_12["fid"];
                    }
                    $_G["tid2fid"][$_var_10] = $_var_4;
                }
                $_var_8["{fid}"] = empty($_G["setting"]["forumkeys"][$_var_4]) ? $_var_4 : $_G["setting"]["forumkeys"][$_var_4];
            }
        } else {
            if ($_arg_0 == "forum_forumdisplay_gid") {
                list(, , , $_var_13, $_var_6) = func_get_args();
                $_var_8 = array("{gid}" => $_var_13);
            } else {
                if ($_arg_0 == "forum_tag_view") {
                    list(, , , $_var_14, $_var_6) = func_get_args();
                    $_var_8 = array("{id}" => $_var_14);
                } else {
                    if ($_arg_0 == "forum_tag_list") {
                        list(, , , $_var_14, $_var_15, $_var_5, $_var_6) = func_get_args();
                        $_var_8 = array("{id}" => $_var_14, "{type}" => $_var_15, "{page}" => $_var_5 ? $_var_5 : 1);
                    }
                }
            }
        }
    }
    $_var_9 = str_replace(array_keys($_var_8), $_var_8, $_G["cache"]["plugin"]["addon_seo_rewrite"][$_arg_0]);
    if (!$_arg_1) {
        return "<a href=\"" . $_arg_2 . $_var_9 . "\"" . (!empty($_var_6) ? stripslashes($_var_6) : '') . ">";
    }
    return $_arg_2 . $_var_9;
}
function addon_seo_rewrite_multipage()
{
    global $list;
    addon_seo_rewrite_dispose($list);
    foreach ($list as $_var_1 => $_var_2) {
        if (!empty($_var_2["multipage"])) {
            $list[$_var_1]["multipage"] = '';
        }
    }
}
if (!defined("IN_DISCUZ")) {
    echo "{ADDONVAR:SiteID}";
    return 0;
}