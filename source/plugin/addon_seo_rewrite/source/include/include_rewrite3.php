<?php
?>

<?php 
function study_rewritedata2()
{
    global $_G;
    $_var_1 = array();
    $_var_2 = $_G["cache"]["plugin"]["addon_seo_rewrite"];
    if (in_array("portal_topic", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["portal_topic"] = $_G["setting"]["rewriterule"]["portal_topic"] ? $_G["setting"]["rewriterule"]["portal_topic"] : "topic-{name}.html";
        $_var_1["rulereplace"]["portal_topic"] = "portal.php?mod=topic&topic={name}";
        $_var_1["rulevars"]["portal_topic"]["{name}"] = "(.+)";
    }
    if (in_array("portal_article", $_G["setting"]["rewritestatus"])) {
        $_var_1["rulesearch"]["portal_article"] = $_G["setting"]["rewriterule"]["portal_article"] ? $_G["setting"]["rewriterule"]["portal_article"] : "article-{id}-{page}.html";
        $_var_1["rulereplace"]["portal_article"] = "portal.php?mod=view&aid={id}&page={page}";
        $_var_1["rulevars"]["portal_article"]["{id}"] = "([0-9]+)";
        $_var_1["rulevars"]["portal_article"]["{page}"] = "([0-9]+)";
    }
    if ($_var_2["forum_forumdisplay2"]) {
        $_var_1["rulesearch"]["forum_forumdisplay2"] = $_var_2["forum_forumdisplay2"];
        $_var_1["rulereplace"]["forum_forumdisplay2"] = "forum.php?mod=forumdisplay&fid={fid}&page={page}";
        $_var_1["rulevars"]["forum_forumdisplay2"]["{fid}"] = "(\\w+)";
        $_var_1["rulevars"]["forum_forumdisplay2"]["{page}"] = "([0-9]+)";
    }
    if ($_var_2["forum_forumdisplay"]) {
        $_var_1["rulesearch"]["forum_forumdisplay"] = $_var_2["forum_forumdisplay"];
        $_var_1["rulereplace"]["forum_forumdisplay"] = "forum.php?mod=forumdisplay&fid={fid}&page={page}";
        $_var_1["rulevars"]["forum_forumdisplay"]["{fid}"] = "(\\w+)";
        if (strpos($_var_2["forum_forumdisplay"], "{page}") !== false) {
            $_var_1["rulevars"]["forum_forumdisplay"]["{page}"] = "([0-9]+)";
        } else {
            $_var_1["rulereplace"]["forum_forumdisplay"] = str_replace("&page={page}", '', $_var_1["rulereplace"]["forum_forumdisplay"]);
        }
    } else {
        if (in_array("forum_forumdisplay", $_G["setting"]["rewritestatus"])) {
            $_var_1["rulesearch"]["forum_forumdisplay"] = $_G["setting"]["rewriterule"]["forum_forumdisplay"] ? $_G["setting"]["rewriterule"]["forum_forumdisplay"] : "forum-{fid}-{page}.html";
            $_var_1["rulereplace"]["forum_forumdisplay"] = "forum.php?mod=forumdisplay&fid={fid}&page={page}";
            $_var_1["rulevars"]["forum_forumdisplay"]["{fid}"] = "(\\w+)";
            $_var_1["rulevars"]["forum_forumdisplay"]["{page}"] = "([0-9]+)";
        }
    }
    if ($_var_2["forum_viewthread2"]) {
        $_var_1["rulesearch"]["forum_viewthread2"] = $_var_2["forum_viewthread2"];
        $_var_1["rulereplace"]["forum_viewthread2"] = "forum.php?mod=viewthread&tid={tid}&extra=page\\%3D{prevpage}&page={page}";
        if (strpos($_var_2["forum_viewthread2"], "{fid}") !== false) {
            $_var_1["rulevars"]["forum_viewthread2"]["{fid}"] = "(\\w+)";
        }
        $_var_1["rulevars"]["forum_viewthread2"]["{tid}"] = "([0-9]+)";
        $_var_1["rulevars"]["forum_viewthread2"]["{page}"] = "([0-9]+)";
        if (strpos($_var_2["forum_viewthread2"], "{prevpage}") !== false) {
            $_var_1["rulevars"]["forum_viewthread2"]["{prevpage}"] = "([0-9]+)";
        } else {
            $_var_1["rulereplace"]["forum_viewthread2"] = str_replace("&extra=page\\%3D{prevpage}", '', $_var_1["rulereplace"]["forum_viewthread2"]);
        }
    }
    if ($_var_2["forum_viewthread"]) {
        $_var_1["rulesearch"]["forum_viewthread"] = $_var_2["forum_viewthread"];
        $_var_1["rulereplace"]["forum_viewthread"] = "forum.php?mod=viewthread&tid={tid}&extra=page\\%3D{prevpage}&page={page}";
        $_var_1["rulevars"]["forum_viewthread"]["{tid}"] = "([0-9]+)";
        if (strpos($_var_2["forum_viewthread"], "{fid}") !== false) {
            $_var_1["rulevars"]["forum_viewthread"]["{fid}"] = "(\\w+)";
        }
        if (strpos($_var_2["forum_viewthread"], "{page}") !== false) {
            $_var_1["rulevars"]["forum_viewthread"]["{page}"] = "([0-9]+)";
        } else {
            $_var_1["rulereplace"]["forum_viewthread"] = str_replace("&page={page}", '', $_var_1["rulereplace"]["forum_viewthread"]);
        }
        if (strpos($_var_2["forum_viewthread"], "{prevpage}") !== false) {
            $_var_1["rulevars"]["forum_viewthread"]["{prevpage}"] = "([0-9]+)";
        } else {
            $_var_1["rulereplace"]["forum_viewthread"] = str_replace("&extra=page\\%3D{prevpage}", '', $_var_1["rulereplace"]["forum_viewthread"]);
        }
    } else {
        if (in_array("forum_viewthread", $_G["setting"]["rewritestatus"])) {
            $_var_1["rulesearch"]["forum_viewthread"] = $_G["setting"]["rewriterule"]["forum_viewthread"] ? $_G["setting"]["rewriterule"]["forum_viewthread"] : "thread-{tid}-{page}-{prevpage}.html";
            $_var_1["rulereplace"]["forum_viewthread"] = "forum.php?mod=viewthread&tid={tid}&extra=page\\%3D{prevpage}&page={page}";
            $_var_1["rulevars"]["forum_viewthread"]["{tid}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_viewthread"]["{page}"] = "([0-9]+)";
            $_var_1["rulevars"]["forum_viewthread"]["{prevpage}"] = "([0-9]+)";
        }
    }
    return $_var_1;
}
if (!defined("IN_DISCUZ") || !defined("IN_ADMINCP")) {
    echo "{ADDONVAR:SiteUrl}";
    return 0;
}