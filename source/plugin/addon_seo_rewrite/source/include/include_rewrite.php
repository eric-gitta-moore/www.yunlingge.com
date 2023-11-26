<?php
?>

<?php 
function study_pvsort($_arg_0, $_arg_1, $_arg_2)
{
    $_var_3 = "/";
    $_var_4 = '';
    foreach ($_arg_0 as $_var_5) {
        $_var_3 = $_var_3 . ($_var_4 . preg_quote($_var_5));
        $_var_4 = "|";
    }
    $_var_3 = $_var_3 . "/";
    preg_match_all($_var_3, $_arg_1, $_var_6);
    $_var_6 = $_var_6[0];
    $_var_6 = array_flip($_var_6);
    foreach ($_var_6 as $_arg_0 => $_var_7) {
        $_arg_2 = str_replace($_arg_0, "\$" . ($_var_7 + 1), $_arg_2);
    }
    return $_arg_2;
}
function study_pvadd($_arg_0, $_arg_1 = 0)
{
    $_arg_0 = str_replace(array("\$3", "\$2", "\$1"), array("~4", "~3", "~2"), $_arg_0);
    if (!$_arg_1) {
        return str_replace(array("~4", "~3", "~2"), array("\$4", "\$3", "\$2"), $_arg_0);
    }
    return str_replace(array("~4", "~3", "~2"), array("{R:4}", "{R:3}", "{R:2}"), $_arg_0);
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
if (!defined("IN_DISCUZ") || !defined("IN_ADMINCP")) {
    echo "{ADDONVAR:SiteUrl}";
    return 0;
}
require_once libfile("function/var", "plugin/addon_seo_rewrite/source");
require_once libfile("include/rewrite2", "plugin/addon_seo_rewrite/source");
global $_G;
global $plugin;
global $splugin_setting;
global $splugin_lang;
global $type1314;
global $_statInfo;
global $pluginid;
global $pluginvars;
global $lang;
loadcache("plugin");
$splugin_setting = $_G["cache"]["plugin"]["addon_seo_rewrite"];
$splugin_lang = lang("plugin/addon_seo_rewrite");
$_var_9 = array();
$_var_10 = study_rewritedata();
$_var_9["{apache1}"] = $_var_9["{apache2}"] = $_var_9["{iis}"] = $_var_9["{iis7}"] = $_var_9["{zeus}"] = $_var_9["{nginx}"] = '';
foreach ($_var_10["rulesearch"] as $_var_11 => $_var_12) {
    $_var_13 = count($_var_10["rulevars"][$_var_11]) + 2;
    $_var_14 = array_keys($_var_10["rulevars"][$_var_11]);
    $_var_10["rulereplace"][$_var_11] = study_pvsort($_var_14, $_var_12, $_var_10["rulereplace"][$_var_11]);
    $_var_12 = str_replace($_var_14, $_var_10["rulevars"][$_var_11], addcslashes($_var_12, "?*+^\$.[]()|"));
    if (strpos($_var_12, ".") === false) {
        $_var_9["{apache1}"] = $_var_9["{apache1}"] . ("\t" . "RewriteCond %{REQUEST_FILENAME} !-f" . "\n\t" . "RewriteCond %{REQUEST_FILENAME} !-d" . "\n");
        $_var_9["{apache2}"] = $_var_9["{apache2}"] . ("RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f" . "\n" . "RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-d" . "\n");
    }
    $_var_9["{apache1}"] = $_var_9["{apache1}"] . ("\t" . "RewriteCond %{QUERY_STRING} ^(.*)\$" . "\n\t" . "RewriteRule ^(.*)/" . $_var_12 . "\$ \$1/" . study_pvadd($_var_10["rulereplace"][$_var_11]) . "&%1\n");
    if ($_var_11 != "forum_archiver") {
        $_var_9["{apache2}"] = $_var_9["{apache2}"] . ("RewriteCond %{QUERY_STRING} ^(.*)\$" . "\n" . "RewriteRule ^" . $_var_12 . "\$ " . $_var_10["rulereplace"][$_var_11] . "&%1\n");
    } else {
        $_var_9["{apache2}"] = $_var_9["{apache2}"] . ("RewriteCond %{QUERY_STRING} ^(.*)\$" . "\n" . "RewriteRule ^archiver/" . $_var_12 . "\$ archiver/" . $_var_10["rulereplace"][$_var_11] . "&%1\n");
    }
    $_var_9["{iis}"] = $_var_9["{iis}"] . ("RewriteRule ^(.*)/" . $_var_12 . "(\\?(.*))*\$ \$1/" . addcslashes(study_pvadd($_var_10["rulereplace"][$_var_11]) . "&\$" . ($_var_13 + 1), ".?") . "\n");
    $_var_9["{iis7}"] = $_var_9["{iis7}"] . ("\t\t" . "&lt;rule name=\"" . $_var_11 . "\"&gt;" . "\n\t\t\t" . "&lt;match url=\"^(.*/)*" . str_replace("\\.", ".", $_var_12) . "\\?*(.*)\$\" /&gt;" . "\n");
    if (strpos($_var_12, ".") === false) {
        $_var_9["{iis7}"] = $_var_9["{iis7}"] . ("\t\t\t" . "&lt;conditions&gt;" . "\n\t\t\t\t" . "&lt;add input=\"{REQUEST_FILENAME}\" matchType=\"IsFile\" ignoreCase=\"false\" negate=\"true\" /&gt;" . "\n\t\t\t\t" . "&lt;add input=\"{REQUEST_FILENAME}\" matchType=\"IsDirectory\" ignoreCase=\"false\" negate=\"true\" /&gt;" . "\n\t\t\t" . "&lt;/conditions&gt;" . "\n");
    }
    $_var_9["{iis7}"] = $_var_9["{iis7}"] . ("\t\t\t" . "&lt;action type=\"Rewrite\" url=\"{R:1}/" . str_replace(array("&", "page\\%3D"), array("&amp;amp;", "page%3D"), addcslashes(study_pvadd($_var_10["rulereplace"][$_var_11], 1) . "&{R:" . $_var_13 . "}", "?")) . "\" /&gt;" . "\n\t\t" . "&lt;/rule&gt;" . "\n");
    $_var_9["{zeus}"] = $_var_9["{zeus}"] . ("match URL into \$ with ^(.*)/" . $_var_12 . "\\?*(.*)\$" . "\n" . "if matched then" . "\n\t" . "set URL = \$1/" . study_pvadd($_var_10["rulereplace"][$_var_11]) . "&\$" . $_var_13 . "\nendif\n");
    if (strpos($_var_12, ".") === false) {
        $_var_9["{nginx}"] = $_var_9["{nginx}"] . ("if (!-e \$request_filename) {" . "\n\t" . "rewrite ^([^\\.]*)/" . $_var_12 . "\$ \$1/" . stripslashes(study_pvadd($_var_10["rulereplace"][$_var_11])) . " last;" . "\t\n" . "}" . "\n");
    } else {
        $_var_9["{nginx}"] = $_var_9["{nginx}"] . ("rewrite ^([^\\.]*)/" . $_var_12 . "\$ \$1/" . stripslashes(study_pvadd($_var_10["rulereplace"][$_var_11])) . " last;\n");
    }
}
$_var_9["{nginx}"] = $_var_9["{nginx}"] . "if (!-e \$request_filename) {\n\treturn 404;\n}";

$_var_15 = '';
if ($_SERVER["HTTP_HOST"] == "www.ceshi.com") {
    $_var_15 = $splugin_lang["rewrite_message_apache1"] . $splugin_lang["rewrite_message_apache2"] . $splugin_lang["rewrite_message_iis1"] . $splugin_lang["rewrite_message_iis2"] . $splugin_lang["rewrite_message_zeus"] . $splugin_lang["rewrite_message_nginx"];
} else {
    if (stripos($_SERVER["SERVER_SOFTWARE"], "apache") !== false) {
        $_var_15 = $splugin_lang["rewrite_message_apache1"] . $splugin_lang["rewrite_message_apache2"];
    } else {
        if (stripos($_SERVER["SERVER_SOFTWARE"], "iis") !== false) {
            if (stripos($_SERVER["SERVER_SOFTWARE"], "6.0") !== false) {
                $_var_15 = $splugin_lang["rewrite_message_iis1"];
            } else {
                $_var_15 = $splugin_lang["rewrite_message_iis2"];
            }
        } else {
            if (stripos($_SERVER["SERVER_SOFTWARE"], "zeus") !== false) {
                $_var_15 = $splugin_lang["rewrite_message_zeus"];
            } else {
                if (stripos($_SERVER["SERVER_SOFTWARE"], "nginx") !== false) {
                    $_var_15 = $splugin_lang["rewrite_message_nginx"];
                } else {
                    echo "&#x6682;&#x65E0;&#xFF1A;" . $_SERVER["SERVER_SOFTWARE"] . " &#x5BF9;&#x5E94;&#x7684;&#x4F2A;&#x9759;&#x6001;&#x89C4;&#x5219;&#xFF0C;&#x8054;&#x7CFB;QQ&#xFF1A;15326940 &#x54A8;&#x8BE2;";
                    return 0;
                }
            }
        }
    }
}
echo str_replace(array("{prevpage}", "{page}", "{typeid}", "{sortid}", "{siteroot}"), array(1, 1, 0, 0, $_G["siteroot"] ? $_G["siteroot"] : "/"), str_replace(array_keys($_var_9), $_var_9, $_var_15));