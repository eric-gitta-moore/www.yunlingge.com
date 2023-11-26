<?php
function addon_seo_rewrite_cleardir($_arg_0) {
    if (is_dir($_arg_0)) {
        addon_seo_rewrite_deltree($_arg_0);
    }
}

function addon_seo_rewrite_deltree($_arg_0) {
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
if (!defined("IN_DISCUZ") || !defined("IN_ADMINCP")) {
    echo "{ADDONVAR:SiteUrl}";
    return 0;
}

global $_G;
global $plugin;
global $splugin_setting;
global $splugin_lang;
global $type1314;
global $_statInfo;
global $pluginid;
global $pluginvars;
global $lang;
$pluginvars = array();
foreach (C::t("common_pluginvar")->fetch_all_by_pluginid($pluginid) as $_var_9) {
    if (!strexists($_var_9["type"], "_")) {
        C::t("common_pluginvar")->update_by_variable($pluginid, $_var_9["variable"], array("type" => $_var_9["type"] . "_1314"));
    } else {
        $_var_10 = explode("_", $_var_9["type"]);
        if ($_var_10[1] == "1314") {
            $_var_9["type"] = $_var_10[0];
        } else {
            continue;
        }
    }
    $pluginvars[$_var_9["variable"]] = $_var_9;
}
require_once libfile("function/var", "plugin/addon_seo_rewrite/source");
if (!submitcheck("editsubmit")) {
    $_var_11 = '';
    if ($pluginvars) {
        showformheader("plugins&operation=config&do=" . $pluginid . '');
        showtableheader();
        echo "<div id=\"my_addonlist\"></div>";
        showtitle($lang["plugins_config"]);
        $_var_12 = array();
        foreach ($pluginvars as $_var_9) {
            if (!strexists($_var_9["type"], "_")) {
                if ($_var_9["variable"] == "forum_forumdisplay") {
                    showtablefooter();
                    showtableheader("&#x8BBA;&#x575B;&#x4E3B;&#x9898;&#x5217;&#x8868;&#x9875;");
                } else {
                    if ($_var_9["variable"] == "forum_viewthread_unify") {
                        showtablefooter();
                        showtableheader("&#x8BBA;&#x575B;&#x4E3B;&#x9898;&#x5185;&#x5BB9;&#x9875;");
                    } else {
                        if ($_var_9["variable"] == "forum_forumdisplay_type_radio") {
                            showtablefooter();
                            showtableheader("&#x4E3B;&#x9898;&#x5206;&#x7C7B;&#x5217;&#x8868;&#x9875;");
                        } else {
                            if ($_var_9["variable"] == "forum_forumdisplay_sort_radio") {
                                showtablefooter();
                                showtableheader("&#x5206;&#x7C7B;&#x4FE1;&#x606F;&#x5217;&#x8868;&#x9875;");
                            } else {
                                if ($_var_9["variable"] == "forum_forumdisplay_type_sort_radio") {
                                    showtablefooter();
                                    showtableheader("&#x4E3B;&#x9898;&#x5206;&#x7C7B;+&#x5206;&#x7C7B;&#x4FE1;&#x606F;&#x5217;&#x8868;&#x9875;");
                                } else {
                                    if ($_var_9["variable"] == "forum_tag_radio") {
                                        showtablefooter();
                                        showtableheader("&#x6807;&#x7B7E;&#x4F2A;&#x9759;&#x6001;");
                                    }
                                }
                            }
                        }
                    }
                }
                $_var_9["variable"] = "varsnew[" . $_var_9["variable"] . "]";
                if ($_var_9["type"] == "number") {
                    $_var_9["type"] = "text";
                } else {
                    if ($_var_9["type"] == "select") {
                        $_var_9["type"] = "<select name=\"" . $_var_9["variable"] . "\">\n";
                        foreach (explode("
", $_var_9["extra"]) as $_var_13 => $_var_14) {
                            $_var_14 = trim($_var_14);
                            if (strpos($_var_14, "=") === false) {
                                $_var_13 = $_var_14;
                            } else {
                                $_var_15 = explode("=", $_var_14);
                                $_var_13 = trim($_var_15[0]);
                                $_var_14 = trim($_var_15[1]);
                            }
                            $_var_9["type"] = $_var_9["type"] . ("<option value=\"" . dhtmlspecialchars($_var_13) . "\" " . ($_var_9["value"] == $_var_13 ? "selected" : '') . ">" . $_var_14 . "</option>\n");
                        }
                        $_var_9["type"] = $_var_9["type"] . "</select>\n";
                        $_var_9["variable"] = $_var_9["value"] = '';
                    }
                }
                s_showsetting(isset($lang[$_var_9["title"]]) ? $lang[$_var_9["title"]] : dhtmlspecialchars($_var_9["title"]), $_var_9["variable"], $_var_9["value"], $_var_9["type"], '', 0, isset($lang[$_var_9["description"]]) ? $lang[$_var_9["description"]] : nl2br(dhtmlspecialchars($_var_9["description"])), dhtmlspecialchars($_var_9["extra"]), '', true);
            }
        }
        showsubmit("editsubmit");
        showtablefooter();
        showformfooter();
        echo implode('', $_var_12);
        $_var_16 = array();
        $_var_16["pluginName"] = $plugin["identifier"];
        $_var_16["pluginVersion"] = $plugin["version"];
        $_var_16["bbsVersion"] = DISCUZ_VERSION;
        $_var_16["bbsRelease"] = DISCUZ_RELEASE;
        $_var_16["timestamp"] = TIMESTAMP;
        $_var_16["bbsUrl"] = $_G["siteurl"];
        $_var_16["SiteUrl"] = $_statInfo["SiteUrl"];
        $_var_16["ClientUrl"] = $_statInfo["ClientUrl"];
        $_var_16["SiteID"] = $_statInfo["SiteID"];
        $_var_16["bbsAdminEMail"] = $_G["setting"]["adminemail"];
        $_var_16["genuine"] = splugin_genuine($plugin["identifier"]);
        echo '<div id="my_addonlist_temp" style="display:
            none;
            "><script id="my_addonlist_js" src="http://www.ymg6.com/addon.php"></script></div>\r\n\t\t<script type=\"text/javascript\">\$(\"my_addonlist_js\").src= \"\";\$(\"my_addonlist\").innerHTML = \$(\"my_addonlist_temp\").innerHTML;</script>';
            }
        } else {
            
            if (is_array($_GET["varsnew"])) {
                foreach ($_GET["varsnew"] as $_var_17 => $_var_18) {
                    if (isset($pluginvars[$_var_17])) {
                        if ($pluginvars[$_var_17]["type"] == "number") {
                            $_var_18 = (double)$_var_18;
                        } else {
                            if (in_array($pluginvars[$_var_17]["type"], array("forums", "groups", "selects"))) {
                                $_var_18 = serialize($_var_18);
                            }
                        }
                        $_var_18 = (string)$_var_18;
                        C::t("common_pluginvar")->update_by_variable($pluginid, $_var_17, array("value" => $_var_18));
                    }
                }
            }
            updatecache(array("plugin", "setting", "styles"));
            cleartemplatecache();
            cpmsg("plugins_setting_succeed", "action=plugins&operation=config&do=" . $pluginid . "&anchor=" . $_var_19, "succeed");
        }
        