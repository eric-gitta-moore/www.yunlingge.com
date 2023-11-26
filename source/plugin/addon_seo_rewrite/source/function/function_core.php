<?php
function addon_seo_rewrite_dispose($_arg_0)
{
    global $_G;
    foreach ($_arg_0 as $_var_2) {
        $_G["tid2fid"][$_var_2["tid"]] = $_var_2["fid"];
    }
}
function addon_seo_rewrite_rewrite()
{
    global $_G;
    $_var_1 = $_G["cache"]["plugin"]["addon_seo_rewrite"];
    if ($_var_1["study_radio"]) {
        if ($_G["adminid"] == 1 && $_GET["action"] == "newthread" || $_GET["check"] == "yes") {
        }
        if (is_array($_G["setting"]["domain"]["app"])) {
            $_var_2 = empty($_G["setting"]["domain"]["app"]["default"]) ? "{CURHOST}" : $_G["setting"]["domain"]["app"]["default"];
            $_var_3 = $_G["setting"]["domain"]["app"];
            $_var_4 = $_var_3["portal"] || $_var_3["forum"] || $_var_3["group"] || $_var_3["home"] || $_var_3["default"];
            foreach ($_var_3 as $_var_5 => $_var_6) {
                if (!in_array($_var_5, array("default", "mobile"))) {
                    $_var_7 = '' . $_var_5 . ".php";
                    if (!$_var_6) {
                        $_var_6 = $_var_2;
                    }
                    if ($_var_6 != "{CURHOST}") {
                        $_var_6 = "http" . ($_G["isHTTPS"] ? "s" : '') . "://" . $_var_6 . $_G["siteport"] . "/";
                    }
                    if ($_var_4) {
                        $_G["setting"]["output"]["str"]["search"][$_var_5] = "<a href=\"" . $_var_5 . ".php";
                        $_G["setting"]["output"]["str"]["replace"][$_var_5] = "<a href=\"" . $_var_6 . $_var_7;
                        $_G["domain"]["pregxprw"][$_var_5] = "<a href\\=\"(" . preg_quote($_var_6, "/") . ")" . $_var_7;
                    } else {
                        $_G["domain"]["pregxprw"][$_var_5] = "<a href\\=\"()" . $_var_7;
                    }
                }
            }
        }
        if (!in_array("forum_forumdisplay", $_G["setting"]["rewritestatus"])) {
            $_G["setting"]["rewritestatus"][] = "forum_forumdisplay";
        }
        if (!in_array("forum_viewthread", $_G["setting"]["rewritestatus"])) {
            $_G["setting"]["rewritestatus"][] = "forum_viewthread";
        }
        $_G["setting"]["rewriterule"]["forum_forumdisplay"] = $_var_1["forum_forumdisplay"];
        $_G["setting"]["rewriterule"]["forum_viewthread"] = $_G["fid"] ? str_replace("{fid}", empty($_G["setting"]["forumkeys"][$_G["fid"]]) ? $_G["fid"] : $_G["setting"]["forumkeys"][$_G["fid"]], $_var_1["forum_viewthread"]) : $_var_1["forum_viewthread"];
        $_G["setting"]["output"]["preg"]["search"]["forum_forumdisplay"] = "/" . $_G["domain"]["pregxprw"]["forum"] . "\\?mod\\=forumdisplay&(amp;)?fid\\=(\\w+)([^\"]*)\"([^\\>]*)\\>/";
        $_G["setting"]["output"]["preg"]["replace"]["forum_forumdisplay"] = "addon_seo_rewrite_forum_forumdisplay('forum_forumdisplay', 0, '\\1', '\\3', '\\4', '\\5')";
        if ($_G["cache"]["plugin"]["addon_seo_rewrite"]["forum_viewthread_unify"]) {
            $_G["setting"]["output"]["preg"]["search"]["forum_viewthread"] = "/" . $_G["domain"]["pregxprw"]["forum"] . "\\?mod\\=viewthread&(amp;)?tid\\=(\\d+)(&amp;extra\\=(page\\%3D(\\d+))?)?([^\"]*)\"([^\\>]*)\\>/";
            $_G["setting"]["output"]["preg"]["replace"]["forum_viewthread"] = "addon_seo_rewrite_rewriteoutput('forum_viewthread', 0, '\\1', '\\3', '\\7', '\\6', '\\8')";
        } else {
            $_G["setting"]["output"]["preg"]["search"]["forum_viewthread"] = "/" . $_G["domain"]["pregxprw"]["forum"] . "\\?mod\\=viewthread&(amp;)?tid\\=(\\d+)(&amp;extra\\=(page\\%3D(\\d+))?)?(&amp;page\\=(\\d+))?\"([^\\>]*)\\>/";
            $_G["setting"]["output"]["preg"]["replace"]["forum_viewthread"] = "addon_seo_rewrite_rewriteoutput('forum_viewthread', 0, '\\1', '\\3', '\\8', '\\6', '\\9')";
        }
        if ($_var_1["forum_forumdisplay_gid"]) {
            $_G["setting"]["output"]["preg"]["search"]["forum_forumdisplay_gid"] = "/" . $_G["domain"]["pregxprw"]["forum"] . "\\?gid\\=(\\d+)\"([^\\>]*)\\>/";
            $_G["setting"]["output"]["preg"]["replace"]["forum_forumdisplay_gid"] = "addon_seo_rewrite_rewriteoutput('forum_forumdisplay_gid', 0, '\\1', '\\2', '\\3')";
        }
        if ($_var_1["forum_tag_radio"]) {
            $_G["setting"]["output"]["preg"]["search"]["forum_tag_list"] = "/<a([^\\>]*)href\\=\"(https?:\\/\\/[^\"]*\\/)?misc.php\\?mod\\=tag&(amp;)?id\\=(\\d+)&(amp;)?type\\=(thread|blog)(&amp;page\\=(\\d+))?\"([^\\>]*)\\>/";
            $_G["setting"]["output"]["preg"]["replace"]["forum_tag_list"] = "addon_seo_rewrite_rewriteoutput('forum_tag_list', 0, '\\2', '\\4', '\\6', '\\8', '\\9')";
            $_G["setting"]["output"]["preg"]["search"]["forum_tag_view"] = "/<a([^\\>]*)href\\=\"(https?:\\/\\/[^\"]*\\/)?misc.php\\?mod\\=tag&(amp;)?id\\=(\\d+)\"([^\\>]*)\\>/";
            $_G["setting"]["output"]["preg"]["replace"]["forum_tag_view"] = "addon_seo_rewrite_rewriteoutput('forum_tag_view', 0, '\\2', '\\4', '\\5')";
            $_G["setting"]["output"]["str"]["search"]["forum_tag_index"] = "\"misc.php?mod=tag\"";
            $_G["setting"]["output"]["str"]["replace"]["forum_tag_index"] = "\"" . $_var_1["forum_tag_index"] . "\"";
        }
        $_G["setting"]["output"]["str"]["search"]["dirbugdix"] = "'forum.php";
        $_G["setting"]["output"]["str"]["replace"]["dirbugdix"] = "'" . $_G["siteurl"] . "forum.php";
        $_var_8 = array("forum_forumdisplay", "forum_viewthread", "forum_forumdisplay_gid", "forum_tag_view", "forum_tag_list");
        if ($_var_1["dz_version"] <= 1) {
            if (in_array(substr($_G["setting"]["version"], 0, 1), array("F", "L"))) {
                $_var_9 = true;
            } else {
                if (substr($_G["setting"]["version"], 0, 1) == "X" && version_compare($_G["setting"]["version"], "X3.3", ">=")) {
                    $_var_9 = true;
                }
            }
        } else {
            if ($_var_1["dz_version"] == 3) {
                $_var_9 = true;
            }
        }
        if ($_var_9) {
            foreach ($_var_8 as $_var_10 => $_var_11) {
                if (isset($_G["setting"]["output"]["preg"]["replace"][$_var_11])) {
                    $_G["setting"]["output"]["preg"]["replace"][$_var_11] = preg_replace("/'\\\\([0-9]+)'/", "\$matches[\${1}]", $_G["setting"]["output"]["preg"]["replace"][$_var_11]);
                }
            }
        } else {
            foreach ($_var_8 as $_var_10 => $_var_11) {
                if (isset($_G["setting"]["output"]["preg"]["search"][$_var_11])) {
                    $_G["setting"]["output"]["preg"]["search"][$_var_11] = $_G["setting"]["output"]["preg"]["search"][$_var_11] . "e";
                }
            }
        }
    }
}
function addon_seo_rewrite_check()
{
    /*addon_seo_rewrite_validator();
    $_var_0 = '';
    $_var_1 = DISCUZ_ROOT . "./source/plugin/addon_seo_rewrite/demo.php";
    if (!file_exists($_var_1)) {
        return 0;
    }
    if ($_var_2 = @fopen($_var_1, "r")) {
        $_var_0 = fread($_var_2, filesize($_var_1));
        fclose($_var_2);
    }
    if (1 != 1) {
        
    } else {
        $_var_1 = DISCUZ_ROOT . "./source/plugin/addon_seo_rewrite/pluginvar.func.php";
        if (!file_exists($_var_1)) {
            return 0;
        }
        if ($_var_2 = @fopen($_var_1, "r")) {
            $_var_0 = fread($_var_2, filesize($_var_1));
            fclose($_var_2);
        }
        
    }*/
    $_var_0 = NULL;
}
function addon_seo_rewrite_cleardir($_arg_0)
{
    if (is_dir($_arg_0)) {
        addon_seo_rewrite_deltree($_arg_0);
    }
}
function addon_seo_rewrite_deltree($_arg_0)
{
    if ($_var_1 = @dir($_arg_0)) {
        while ($_var_2 = $_var_1->read()) {
            if ($_var_2 == "." || $_var_2 == "..") {
                continue;
            }
            $_var_3 = $_arg_0 . "/" . $_var_2;
            if (is_file($_var_3)) {
                @unlink($_var_3);
            } else {
                addon_seo_rewrite_deltree($_var_3);
            }
        }
        $_var_1->close();
        @rmdir($_arg_0);
    }
}
function addon_seo_rewrite_validator()
{
    /*global $_G;
    if (!defined("DISCUZ_VERSION")) {
        include_once DISCUZ_ROOT . "./source/discuz_version.php";
    }
    $_var_1 = array();
    $_var_1["pluginName"] = "addon_seo_rewrite";
    $_var_1["pluginVersion"] = $_G["setting"]["plugins"]["version"]["addon_seo_rewrite"];
    $_var_1["bbsVersion"] = DISCUZ_VERSION;
    $_var_1["bbsRelease"] = DISCUZ_RELEASE;
    $_var_1["timestamp"] = TIMESTAMP;
    $_var_1["bbsUrl"] = $_G["siteurl"];
    $_var_1["bbsAdminEMail"] = $_G["setting"]["adminemail"];*/
   
}
if (!defined("IN_DISCUZ")) {
    echo "{ADDONVAR:SiteID}";
    return 0;
}
include_once libfile("function/core2", "plugin/addon_seo_rewrite/source");
include_once libfile("function/core3", "plugin/addon_seo_rewrite/source");
global $_G;
if (!defined("IN_ADMINCP")) {
    addon_seo_rewrite_rewrite();
//    if ($_GET["download_check"]) {
//        addon_seo_rewrite_check();
//    }
}
//if ($_G["adminid"] > 0 || $_G["uid"] == 1) {
//    if (!getcookie("security_created") || abs($_G["timestamp"] - getcookie("security_created")) > 86400) {
//        dsetcookie("security_created", $_G["timestamp"], "86400");
////        addon_seo_rewrite_check();
//    }
//}