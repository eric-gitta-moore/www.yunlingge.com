<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('addlink');
0
|| checktplrefresh('./source/plugin/nimba_linkhelper/template/addlink.htm', './template/quater_6_motion/common/header.htm', 1584693917, 'nimba_linkhelper', './data/template/5_nimba_linkhelper_addlink.tpl.php', './source/plugin/nimba_linkhelper/template', 'addlink')
|| checktplrefresh('./source/plugin/nimba_linkhelper/template/addlink.htm', './template/quater_6_motion/common/footer.htm', 1584693917, 'nimba_linkhelper', './data/template/5_nimba_linkhelper_addlink.tpl.php', './source/plugin/nimba_linkhelper/template', 'addlink')
|| checktplrefresh('./source/plugin/nimba_linkhelper/template/addlink.htm', './template/quater_6_motion/common/header_common.htm', 1584693917, 'nimba_linkhelper', './data/template/5_nimba_linkhelper_addlink.tpl.php', './source/plugin/nimba_linkhelper/template', 'addlink')
|| checktplrefresh('./source/plugin/nimba_linkhelper/template/addlink.htm', './template/quater_6_motion/common/pubsearchform.htm', 1584693917, 'nimba_linkhelper', './data/template/5_nimba_linkhelper_addlink.tpl.php', './source/plugin/nimba_linkhelper/template', 'addlink')
|| checktplrefresh('./source/plugin/nimba_linkhelper/template/addlink.htm', './template/default/common/header_qmenu.htm', 1584693917, 'nimba_linkhelper', './data/template/5_nimba_linkhelper_addlink.tpl.php', './source/plugin/nimba_linkhelper/template', 'addlink')
;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<?php if($_G['config']['output']['iecompatible']) { ?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE<?php echo $_G['config']['output']['iecompatible'];?>" /><?php } ?>
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?>  <?php } if(empty($nobbname)) { ?> <?php echo $_G['setting']['bbname'];?> <?php } ?> </title>

<meta name="keywords" content="<?php if(!empty($metakeywords)) { echo dhtmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { echo dhtmlspecialchars($metadescription); ?> <?php } if(empty($nobbname)) { ?>,<?php echo $_G['setting']['bbname'];?><?php } ?>" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?php echo $_G['siteurl'];?>" />

<script src="/template/quater_6_motion/src/js/jquery.min.js" type="text/javascript"></script>
<script>jQuery.noConflict();</script>
<?php echo $_G['setting']['seohead'];?><link rel="stylesheet" type="text/css" href="//r1.lcwz01.top/data/cache/style_5_common.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle']) && strpos($_G['cookie']['extstyle'], TPLDIR) !== false) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>', CSSPATH = '<?php echo $_G['setting']['csspath'];?>', DYNAMICURL = '<?php echo $_G['dynamicurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    
<?php if(empty($_GET['diy'])) { $_GET['diy'] = '';?><?php } if(!isset($topic)) { $topic = array();?><?php } ?>
    <!--[if IE 6]>
     <script language='javascript' type="text/javascript">   
    function ResumeError() {  
         return true;  
    }  
    window.onerror = ResumeError;   
    </script> 
    <![endif]-->

<meta name="application-name" content="<?php echo $_G['setting']['bbname'];?>" />
<meta name="msapplication-tooltip" content="<?php echo $_G['setting']['bbname'];?>" />
<?php if($_G['setting']['portalstatus']) { ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['1']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G['siteurl'].'portal.php'; ?>;icon-uri=<?php echo IMGDIR;?>/portal.ico" />
<?php } ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['2']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G['siteurl'].'forum.php'; ?>;icon-uri=<?php echo IMGDIR;?>/bbs.ico" />
<?php if($_G['setting']['groupstatus']) { ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['3']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G['siteurl'].'group.php'; ?>;icon-uri=<?php echo IMGDIR;?>/group.ico" />
<?php } if(helper_access::check_module('feed')) { ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['4']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G['siteurl'].'home.php'; ?>;icon-uri=<?php echo IMGDIR;?>/home.ico" />
<?php } if($_G['basescript'] == 'forum' && $_G['setting']['archiver']) { ?>
<link rel="archives" title="<?php echo $_G['setting']['bbname'];?>" href="archiver/" />
<?php } if(!empty($rsshead)) { ?>
<?php echo $rsshead;?><?php } if(widthauto()) { ?>

<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>" />
<script type="text/javascript">HTMLNODE.className += ' widthauto';</script>
<?php } if($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>
<link rel="stylesheet" type="text/css" id="diy_common" href="data/cache/style_<?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } ?>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?><?php if($_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)) { ?> <?php echo $cat['bodycss'];?><?php } ?>" onkeydown="if(event.keyCode==27) return false;" data-instant-allow-query-string data-instant-allow-external-links>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { include template('common/header_diy'); } if(check_diy_perm($topic)) { include template('common/header_diynav'); } if(CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)) { ?>
<?php echo $diynav;?>
<?php } if(empty($topic) || $topic['useheader']) { if($_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')) { ?>
<div class="xi1 bm bm_c"> 请选择 <a href="<?php echo $_G['siteurl'];?>forum.php?mobile=yes">进入手机版</a> <span class="xg1">|</span> <a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">继续访问电脑版</a> </div>
<?php } if($_G['setting']['shortcut'] && $_G['member']['credits'] >= $_G['setting']['shortcut']) { ?>
<div id="shortcut"> <span><a href="javascript:;" id="shortcutcloseid" title="关闭">关闭</a></span> 您经常访问 <?php echo $_G['setting']['bbname'];?>，试试添加到桌面，访问更方便！ <a href="javascript:;" id="shortcuttip">添加 <?php echo $_G['setting']['bbname'];?> 到桌面</a> </div>
<script type="text/javascript">setTimeout(setShortcut, 2000);</script>
<?php } ?>

<div id="quater_head_top" <?php if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>class="hides"<?php } ?>>
<div id="quater_bar_line" class="cl">
  <div class="wp cl">
    <?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_top'])) echo $_G['setting']['pluginhooks']['global_cpnav_top'];?>
    <?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header'];?>
    <?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_extra1'])) echo $_G['setting']['pluginhooks']['global_cpnav_extra1'];?>
    <?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_extra2'])) echo $_G['setting']['pluginhooks']['global_cpnav_extra2'];?>
  </div>
  <nav>
    <div class="wp cl">
      <!-- 站点LOGO -->
      <div class="hd_logo">
        <?php $mnid = getcurrentnav();?>        <h2>
          <a href="<?php if($_G['setting']['domain']['app']['default']) { ?>//<?php echo $_G['setting']['domain']['app']['default'];?>/<?php } else { ?>./<?php } ?>" title="<?php echo $_G['setting']['sitename'];?>">
            <img src="<?php echo $_G['style']['boardimg'];?>" title="<?php echo $_G['setting']['sitename'];?>" alt="<?php echo $_G['setting']['sitename'];?>" />
          </a>
        </h2>
      </div>
      <!-- 导航 -->
      <div class="navi">
        <ul>
          <?php if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { ?>          <?php if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
          <li <?php if($mnid == $nav['navid']) { ?>class="a" <?php } ?>
          <?php if(!empty($subnavs)) { ?>class="b" <?php } ?>
          <?php echo $nav['nav'];?>>
          </li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php if(!empty($_G['setting']['pluginhooks']['global_nav_extra'])) echo $_G['setting']['pluginhooks']['global_nav_extra'];?>
      </div>
      <!-- 用户信息 -->
      <?php if($_G['uid']) { ?>
      <div class="quater_user_right logined">
        <div class="quater_user_info">
          <div class="left_user ">
            <div class="avatar"> <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="访问我的空间" id="umnav" onMouseOver="showMenu({'ctrlid':this.id,'ctrlclass':'a'})">
              <?php echo avatar($_G[uid],small);?>            </a></div>
            <span class="nickname"><?php echo $_G['member']['username'];?></span><span class="arrow"></span></div>
          <div class="user_menu">
            <ul>
              <li><a id="nte_menu" href="home.php?mod=space&amp;do=notice" class="notification">提醒<?php if($_G['member']['newprompt']) { ?><span class="unread_num png"><?php echo $_G['member']['newprompt'];?></span><?php } ?></a></li>
              <li><a id="msg_menu" href="home.php?mod=space&amp;do=pm" class="msg">消息<?php if($_G['member']['newpm']) { ?><span class="unread_num png"><?php echo $_G['member']['newpm'];?></span><?php } ?></a></li>
              <?php if(check_diy_perm($topic)) { ?>
              <li><a href="javascript:openDiy();" title="打开 DIY 面板">打开DIY</a></li>
              <?php } ?>
              <li><a href="home.php?mod=spacecp">设置</a></li>
              <?php if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
              <li><a href="portal.php?mod=portalcp"><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a></li>
              <?php } ?>
              <?php if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
              <li><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a></li>
              <?php } ?>
              <?php if($_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']) { ?>
              <li><a href="admin.php?frames=yes&amp;action=cloud&amp;operation=applist" target="_blank">云平台</a></li>
              <?php } ?>
              <?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
              <li><a href="admin.php" target="_blank">管理中心</a></li>
              <?php } ?>
              <li><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?></li>
              <li class="l4"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" data-no-instant>退出</a></li>
              <?php if(!empty($_G['setting']['pluginhooks']['global_myitem_extra'])) echo $_G['setting']['pluginhooks']['global_myitem_extra'];?>
            </ul>
          </div>
        </div>
      </div>
      <ul class="usernav">
      </ul>
      <?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
      <div class="quater_user_right">
        <div class="quater_user_info">
          <div class="left_user ">
            <div class="avatar"> <img src="/template/quater_6_motion/src/noLogin.jpg" alt="" height="32" width="32"></div>
            <span class="nickname"><?php echo $_G['member']['username'];?></span><span class="arrow"></span></div>
          <div class="user_menu">
            <ul>
              <li><a id="loginuser"><?php echo dhtmlspecialchars($_G['cookie']['loginuser']); ?></a></li>
              <li><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href)">激活</a></li>
              <li><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php } elseif(!$_G['connectguest']) { ?>
      <div class="lgbox y cl" style="height: 94px; line-height: 94px; margin-left: 12px;">
        <div class="cl">
          <ul>
            <li class="z"><a href="member.php?mod=logging&amp;action=login" style="font-size: 16px; color: #303030; margin-right: 20px;"><i></i>登录</a></li>
            <li class="z"><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" style="font-size: 16px; color: #303030;"><i></i>注册</a></li>
          </ul>
        </div>
      </div>
      <div style="display:none"><?php include template('member/login_simple'); ?></div>
      <?php } else { ?>
      <div class="quater_user_right">
        <div class="quater_user_info">
          <div class="left_user ">
            <div class="avatar"> <img src="/template/quater_6_motion/src/noLogin.jpg" alt="" height="32" width="32"></div>
            <span class="nickname">用户</span><span class="arrow"></span></div>
          <div class="user_menu">
            <ul>
              <li class="l1"><a href="home.php?mod=spacecp&amp;ac=usergroup"><i></i><?php echo $_G['member']['username'];?></a></li>
              <li class="l2"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php } ?>
      <div href="javascript:void(0)" target="_blank" class="search-li" title="搜索"><i class="icon-search "></i></div>
      <div style="display: none;" class="quater_search">
        <div class="wp cl" style="width: 570px !important; margin: 0 auto; position: relative; z-index: 1000; background: none;">
          <?php if($_G['setting']['search']) { $slist = array();?><?php if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><a href="javascript:;" rel="curforum" fid="{$_G['fid']}" >本版</a></li>
EOF;
?><?php } if($_G['setting']['portalstatus'] && $_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><a href="javascript:;" rel="article">文章</a></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><a href="javascript:;" rel="forum" class="curtype">帖子</a></li>
EOF;
?><?php } if(helper_access::check_module('blog') && $_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><a href="javascript:;" rel="blog">日志</a></li>
EOF;
?><?php } if(helper_access::check_module('album') && $_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><a href="javascript:;" rel="album">相册</a></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><a href="javascript:;" rel="group">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><a href="javascript:;" rel="user">用户</a></li>
EOF;
?>
<?php } if($_G['setting']['search'] && $slist) { ?>
<div id="scbar" class="<?php if($_G['setting']['srchhotkeywords'] && count($_G['setting']['srchhotkeywords']) > 5) { ?>scbar_narrow <?php } ?>cl">
<form id="scbar_form" method="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?>get<?php } else { ?>post<?php } ?>" autocomplete="off" onsubmit="searchFocus($('scbar_txt'))" action="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?><?php echo $searchparams['url'];?><?php } else { ?>search.php?searchsubmit=yes<?php } ?>" target="_blank">
<input type="hidden" name="mod" id="scbar_mod" value="search" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="srhlocality" value="<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
<?php if(!empty($searchparams['params'])) { if(is_array($searchparams['params'])) foreach($searchparams['params'] as $key => $value) { $srchotquery .= '&' . $key . '=' . rawurlencode($value);?><input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>" />
<?php } ?>
<input type="hidden" name="source" value="discuz" />
<input type="hidden" name="fId" id="srchFId" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="q" id="cloudsearchquery" value="" />

<style>
#scbar { overflow: visible; position: relative; }
#sg{ background: #FFF; width:456px; border: 1px solid #B2C7DA; }
.scbar_narrow #sg { width: 316px; }
#sg li { padding:0 8px; line-height:30px; font-size:14px; }
#sg li span { color:#999; }
.sml { background:#FFF; cursor:default; }
.smo { background:#E5EDF2; cursor:default; }
            </style>
            <div style="display: none; position: absolute; top:37px; left:44px;" id="sg">
                <div id="st_box" cellpadding="2" cellspacing="0"></div>
            </div>
<?php } ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="scbar_btn_td"><button type="submit" name="searchsubmit" id="scbar_btn" sc="1" class="pn pnc" value="true"><strong class="xi2">搜索</strong></button></td>   
<td class="scbar_type_td"><a href="javascript:;" id="scbar_type" class="xg1" onclick="showMenu(this.id)" hidefocus="true">搜索</a></td>                         
<td class="scbar_txt_td"><input type="text" name="srchtxt" id="scbar_txt" value="请输入搜索内容" autocomplete="off" x-webkit-speech speech /></td>
</tr>
</table>
</form>
</div>
<div class="scbar_hot_td" style="float: left; width: 570px; padding: 35px 0;">
<div id="scbar_hot" style="height: auto; padding: 0;">
<?php if($_G['setting']['srchhotkeywords']) { ?>
<div class="hot_1 cl" style="font-size: 16px; margin: 0 0 12px 0; color: #BBBBBB; font-weight: 400;">热搜</div>
                            <div class="hot_2 cl"><?php if(is_array($_G['setting']['srchhotkeywords'])) foreach($_G['setting']['srchhotkeywords'] as $val) { if($val=trim($val)) { $valenc=rawurlencode($val);?><?php
$__FORMHASH = FORMHASH;$srchhotkeywords[] = <<<EOF


EOF;
 if(!empty($searchparams['url'])) { 
$srchhotkeywords[] .= <<<EOF

<a href="{$searchparams['url']}?q={$valenc}&source=hotsearch{$srchotquery}" target="_blank" class="xi2 search_a" sc="1">{$val}</a>

EOF;
 } else { 
$srchhotkeywords[] .= <<<EOF

<a href="search.php?mod=forum&amp;srchtxt={$valenc}&amp;formhash={$__FORMHASH}&amp;searchsubmit=true&amp;source=hotsearch" target="_blank" class="xi2 search_a" sc="1">{$val}</a>

EOF;
 } 
$srchhotkeywords[] .= <<<EOF


EOF;
?>
<?php } } ?>
                            </div><?php echo implode('', $srchhotkeywords);; } ?>
</div>
</div>
<ul id="scbar_type_menu" class="p_pop" style="display: none;"><?php echo implode('', $slist);; ?></ul>
<script type="text/javascript">
initSearchmenu('scbar', '<?php echo $searchparams['url'];?>');
</script>
<?php } ?>
          <?php if($_G['setting']['search']) { ?>
          <!-- 搜索筛选 -->
          <ul id="scbar_type_menu" class="p_pop" style="display: none;">
            <?php echo implode('', $slist);; ?>          </ul>
          <script type="text/javascript">
            initSearchmenu('scbar', '<?php echo $searchparams['url'];?>');
          </script>
          <?php } ?>
        </div>
        <i class="close-search headericon-close"></i>
      </div>
      <div class="global-search-mask" style="display: none; background-color: #FFFFFF; width: 100%; height: 100%; position: fixed; top: 0; left: 0px; z-index: 300;"></div>
      <script type="text/javascript">
        jQuery(document).ready(function(jQuery) {
          jQuery('.search-li').click(function(){
            jQuery('.global-search-mask').fadeIn(200);
            jQuery('.quater_search').slideDown(300);
          });
          jQuery('.close-search').click(function(){
            jQuery('.global-search-mask').fadeOut(50);
            jQuery('.quater_search').slideUp(300);
          });

        });
      </script>
    </div>
  </nav>
</div>
<!-- 二级导航 -->
<nav>
  <div class="sub_nav"> <?php echo $_G['setting']['menunavs'];?> </div>
</nav>
<div class="mus_box cl" style="padding-top: 94px; margin-bottom: -94px;">
  <div id="mu" class="wp cl">
    <?php if($_G['setting']['subnavs']) { ?>
    <?php if(is_array($_G['setting']['subnavs'])) foreach($_G['setting']['subnavs'] as $navid => $subnav) { ?>    <?php if($_G['setting']['navsubhover'] || $mnid == $navid) { ?>
    <ul class="cl <?php if($mnid == $navid) { ?>current<?php } ?>" id="snav_<?php echo $navid;?>" style="display:<?php if($mnid != $navid) { ?>none<?php } ?>">
      <?php echo $subnav;?>
    </ul>
    <?php } ?>
    <?php } ?>
    <?php } ?>
  </div>
</div>
</div>

<?php if(!IS_ROBOT) { if($_G['uid']) { ?>
<ul id="myprompt_menu" class="p_pop" style="display: none;">
  <li><a href="home.php?mod=space&amp;do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news<?php if(empty($_G['member']['newpm'])) { ?>_0<?php } ?>"></em>消息</a></li>
  <li><a href="home.php?mod=follow&amp;do=follower"><em class="prompt_follower<?php if(empty($_G['member']['newprompt_num']['follower'])) { ?>_0<?php } ?>"></em>新听众<?php if($_G['member']['newprompt_num']['follower']) { ?>(<?php echo $_G['member']['newprompt_num']['follower'];?>)<?php } ?></a></li>

  <?php if($_G['member']['newprompt'] && $_G['member']['newprompt_num']['follow']) { ?>
  <li><a href="home.php?mod=follow"><em class="prompt_concern"></em>我关注的(<?php echo $_G['member']['newprompt_num']['follow'];?>)</a></li>
  <?php } ?>
  <?php if($_G['member']['newprompt']) { ?>
  <?php if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { ?>  <li><a href="home.php?mod=space&amp;do=notice&amp;view=<?php echo $key;?>"><em class="notice_<?php echo $key;?>"></em><?php echo lang('template', 'notice_'.$key); ?>(<span class="rq"><?php echo $val;?></span>)</a></li>
  <?php } ?>
  <?php } ?>
  <?php if(empty($_G['cookie']['ignore_notice'])) { ?>
  <li class="ignore_noticeli"><a href="javascript:;" onClick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="暂不提醒"><em class="ignore_notice"></em></a></li>
  <?php } ?>
</ul>
<?php } if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?>
<div id="sslct_menu" class="cl p_pop" style="display: none;">
  <?php if(!$_G['style']['defaultextstyle']) { ?><span class="sslct_btn" onClick="extstyle('')" title="默认"><i></i></span><?php } ?>
  <?php if(is_array($_G['style']['extstyle'])) foreach($_G['style']['extstyle'] as $extstyle) { ?>  <span class="sslct_btn" onClick="extstyle('<?php echo $extstyle['0'];?>')" title="<?php echo $extstyle['1'];?>"><i style='background:<?php echo $extstyle['2'];?>'></i></span>
  <?php } ?>
</div>
<?php } ?><div id="qmenu_menu" class="p_pop <?php if(!$_G['uid']) { ?>blk<?php } ?>" style="display: none;">
<?php if(!empty($_G['setting']['pluginhooks']['global_qmenu_top'])) echo $_G['setting']['pluginhooks']['global_qmenu_top'];?>
<?php if($_G['uid']) { ?>
<ul class="cl nav"><?php if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
<li><?php echo $nav['code'];?></li>
<?php } } ?>
</ul>
<?php } elseif($_G['connectguest']) { ?>
<div class="ptm pbw hm">
请先<br /><a class="xi2" href="member.php?mod=connect"><strong>完善帐号信息</strong></a> 或 <a href="member.php?mod=connect&amp;ac=bind" class="xi2 xw1"><strong>绑定已有帐号</strong></a><br />后使用快捷导航
</div>
<?php } else { ?>
<div class="ptm pbw hm">
请 <a href="javascript:;" class="xi2" onclick="lsSubmit()"><strong>登录</strong></a> 后使用快捷导航<br />没有帐号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" class="xi2 xw1"><?php echo $_G['setting']['reglinkname'];?></a>
</div>
<?php } if($_G['setting']['showfjump']) { ?><div id="fjump_menu" class="btda"></div><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_qmenu_bottom'])) echo $_G['setting']['pluginhooks']['global_qmenu_bottom'];?>
</div><?php } if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none">
  <?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?>  <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
  <li><?php echo $module['url'];?></li>
  <?php } ?>
  <?php } ?>
</ul>
<?php } ?>


<!-- 用户菜单 -->
<ul class="sub_menu" id="m_menu" style="display: none;">
  <?php if(check_diy_perm($topic)) { ?>
  <li><a href="javascript:openDiy();" title="打开 DIY 面板">打开DIY</a></li>
  <?php } ?>
  <?php if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { ?>  <?php if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
  <li style="display: none;"><?php echo $nav['code'];?></li>
  <?php } ?>
  <?php } ?>
  <li><a href="home.php?mod=spacecp">设置</a></li>
  <?php if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
  <li><a href="portal.php?mod=portalcp"><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a></li>
  <?php } ?>
  <?php if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
  <li><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a></li>
  <?php } ?>
  <li><a href="home.php?mod=space&amp;do=favorite&amp;view=me">我的收藏</a></li>
  <?php if($_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']) { ?>
  <li><a href="admin.php?frames=yes&amp;action=cloud&amp;operation=applist" target="_blank">云平台</a></li>
  <?php } ?>
  <?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
  <li><a href="admin.php" target="_blank">管理中心</a></li>
  <?php } ?>
  <li><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?></li>
  <li><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?></li>
  <li><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra3'])) echo $_G['setting']['pluginhooks']['global_usernav_extra3'];?></li>
  <li><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra4'])) echo $_G['setting']['pluginhooks']['global_usernav_extra4'];?></li>
  <li><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a></li>
</ul>
<ul class="sub_menu" id="l_menu" style="display: none;">

  <!-- 第三方登录 -->
  <li class="user_list app_login"><a href="connect.php?mod=login&amp;op=init&amp;referer=forum.php&amp;statfrom=login"><i class="i_qq"></i>腾讯QQ</a></li>
  <li class="user_list app_login"><a href="plugin.php?id=wechat:login"><i class="i_wb"></i>微信登录</a></li>
</ul><?php echo adshow("headerbanner/wp a_h");?><?php echo adshow("subnavbanner/a_mu");?><?php } ?>

<div id="wp" class="wp quater_wp cl" style="padding-top: 94px;<?php if(@$_GET['mod']!='spacecp') { ?> padding-bottom: 0;<?php } ?>">
<div id="pt" class="bm cl">
<div class="z"><a href="./" class="nvhm"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em><a href="./"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em><a href="plugin.php?id=nimba_linkhelper:addlink">友链管家</a> <em>&rsaquo;</em><?php echo $plugin_nav;?></div>
</div>
<div id="ct" class="ct2 wp cl">
<div class="mn">
    	<div class="bm bw0">
            <div class="bm bw0">
<ul class="tb cl">
<li <?php if($_GET['mod']== 'apply' || empty($_GET['mod'])) { ?>class="a"<?php } ?>><a href="plugin.php?id=nimba_linkhelper:addlink&amp;mod=apply">友链申请</a></li>
<?php if(!empty($_G['uid'])) { ?><li <?php if($_GET['mod']== 'log') { ?>class="a"<?php } ?>><a href="plugin.php?id=nimba_linkhelper:addlink&amp;mod=log">申请记录</a></li><?php } ?>
</ul>
<div class="datalist" style="margin:10px 0 0 0;">
<?php if($_GET['mod']== 'apply' || empty($_GET['mod'])) { ?>
<div style="border:1px dashed #f60; background-color:#FFC" class="notice">请务必做好本站链接：<br>关键词：<?php echo $vars['ailab_wz'];?><br>超链接：<?php echo $vars['ailab_url'];?></div>
<form method="post" action="plugin.php?id=nimba_linkhelper:addlink&amp;mod=apply&amp;applysubmit=true" name="applyform">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<table width="100%" border="1" bordercolor="#cccccc">
<tr>
<td width="100" height="35" bgcolor="#F2F2F2" align="center"><span style="color:red;">*</span> 网站名称</td>
<td colspan="2">&nbsp;&nbsp;&nbsp;<input type="text" name="sitename" style="width:220px; height:22px; line-height22px;" /> <?php echo $site_name;?></td>
</tr>
<tr>
<td height="35" bgcolor="#F2F2F2" align="center"><span style="color:red;">*</span>网站地址</td>
<td colspan="2">&nbsp;&nbsp;&nbsp;<input type="text" id="siteurl" name="siteurl" value="http://" style="width:220px; height:22px; line-height22px;"/> <?php echo $site_url;?></td>
</tr>
<tr>
<td height="35" bgcolor="#F2F2F2" align="center">LOGO地址</td>
<td colspan="2">&nbsp;&nbsp;&nbsp;<input type="text" name="logo" style="width:220px; height:22px; line-height22px;" /> <?php echo $site_logo;?></td>
</tr>
<tr>
<td bgcolor="#F2F2F2" align="center">网站简介</td>
<td colspan="2">
<div class="tedt" style="width:96%;margin:5px auto;">
<div class="area">
<textarea rows="5" cols="20" name="description" class="pt" id="replymessage"></textarea>
</div>
</div>
</td>
</tr>
</table>
<div style="text-align:center; margin-top:20px;">
<button type="submit" name="applysubmit" id="applysubmit" value="true" class="pn pnp" /><strong>提交申请</strong></button>
<button type="reset" name="sendreset" class="pn pnp" /><strong>重新填写</strong></button>
</div>
</form>
<?php } elseif($_GET['mod']== 'log' && $_G['uid']!='') { ?>
<div style="border:1px dashed #f60; background-color:#FFC" class="notice">请务必做好本站链接：<br>关键词：<?php echo $vars['ailab_wz'];?><br>超链接：<?php echo $vars['ailab_url'];?></div>
<table width="100%" border="1" bordercolor="#cccccc">
<tr bgcolor="#F2F2F2" align="center">
<td width="140">网站名称</td>
<td height="35">网站地址</td>
<td width="60">网站LOGO</td>
<td width="80">网站简介</td>
<td width="100">申请时间</td>
<td width="60">状态</td>
</tr><?php if(is_array($loglists)) foreach($loglists as $loglist) { ?><tr align="center">
<td height="35"><?php echo $loglist['sitename'];?></td>
<td><?php echo $loglist['siteurl'];?></td>
<td><?php echo $loglist['logo'];?></td>
<td><span id="viewmsg_<?php echo $loglist['id'];?>" onmouseover="showMenu(this.id);"><a href="javascript:;" class="red">查看简介</a></span>
<div id="viewmsg_<?php echo $loglist['id'];?>_menu" style="display:none; border:1px solid #ccc; background-color:#F2F2F2; padding:10px; text-align:left"><?php echo $loglist['description'];?></div></td>
<td><?php echo $loglist['dateline'];?></td>
<td><?php echo $loglist['status'];?></td>
</tr>
<?php } ?>
</table>
<div style="clear:both"></div>
<div style="margin-top:20px;"><?php echo $multipage;?></div>
<?php } ?>

</div>
</div>
</div>
</div>

<div class="sd"><!--��ʾ��Ϣ-->
<div class="bm">
<div class="bm_h cl">
<h2>温馨提示</h2>
</div>
<div class="bm_c">
<ul class="xl" style="line-height:25px;">
<?php echo $tips;?>
</ul>
</div>
</div>

</div>
</div></div>
<?php if(empty($topic) || ($topic['usefooter'])) { $focusid = getfocus_rand($_G[basescript]);?><?php if($focusid !== null) { $focus = $_G['cache']['focus']['data'][$focusid];?><?php $focusnum = count($_G['setting']['focus'][$_G[basescript]]);?><div class="focus" id="sitefocus">
    <div class="bm">
        <div class="bm_h cl"> <a href="javascript:;" onclick="setcookie('nofocus_<?php echo $_G['basescript'];?>', 1, <?php echo $_G['cache']['focus']['cookie'];?>*3600);$('sitefocus').style.display='none'" class="y" title="关闭">关闭</a>
            <h2>
                <?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?>
                <span id="focus_ctrl" class="fctrl"><img src="<?php echo IMGDIR;?>/pic_nv_prev.gif" alt="上一条" title="上一条" id="focusprev" class="cur1" onclick="showfocus('prev');" /> <em><span id="focuscur"></span>/<?php echo $focusnum;?></em> <img src="<?php echo IMGDIR;?>/pic_nv_next.gif" alt="下一条" title="下一条" id="focusnext" class="cur1" onclick="showfocus('next')" /></span> </h2>
        </div>
        <div class="bm_c" id="focus_con"> </div>
    </div>
</div><?php $focusi = 0;?><?php if(is_array($_G['setting']['focus'][$_G['basescript']])) foreach($_G['setting']['focus'][$_G['basescript']] as $id) { ?><div class="bm_c" style="display: none" id="focus_<?php echo $focusi;?>">
    <dl class="xld cl bbda">
        <dt><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2" target="_blank"><?php echo $_G['cache']['focus']['data'][$id]['subject'];?></a></dt>
        <?php if($_G['cache']['focus']['data'][$id]['image']) { ?>
        <dd class="m"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" target="_blank"><img src="<?php echo $_G['cache']['focus']['data'][$id]['image'];?>" alt="<?php echo $_G['cache']['focus']['data'][$id]['subject'];?>" /></a></dd>
        <?php } ?>
        <dd><?php echo $_G['cache']['focus']['data'][$id]['summary'];?></dd>
    </dl>
    <p class="ptn cl"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2 y" target="_blank">查看 &raquo;</a></p>
</div><?php $focusi ++;?><?php } ?>
<script type="text/javascript">
    var focusnum = <?php echo $focusnum;?>;
    if(focusnum < 2) {
        $('focus_ctrl').style.display = 'none';
    }
    if(!$('focuscur').innerHTML) {
        var randomnum = parseInt(Math.round(Math.random() * focusnum));
        $('focuscur').innerHTML = Math.max(1, randomnum);
    }
    showfocus();
    var focusautoshow = window.setInterval('showfocus(\'next\', 1);', 5000);
</script>
<?php } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1) { ?>
<div class="focus patch" id="patch_notice"></div>
<?php } ?><?php echo adshow("footerbanner/wp a_f/1");?><?php echo adshow("footerbanner/wp a_f/2");?><?php echo adshow("footerbanner/wp a_f/3");?><?php echo adshow("float/a_fl/1");?><?php echo adshow("float/a_fr/2");?><?php echo adshow("couplebanner/a_fl a_cb/1");?><?php echo adshow("couplebanner/a_fr a_cb/2");?><?php echo adshow("cornerbanner/a_cn");?><div id="footer" class="footer cl">
    <div class="footer-2">
        <footer>
            <div id="ft" class="center-container cl">
                <div class="left">
                    <a class="logo" href="#"></a>
                    <p>云凌阁是一个集资源分享、技术教程、编程探讨、游戏技巧于一体的开放大型论坛</p>
                </div>
                <!--div class="qrcode">
                    <img src="/template/quater_6_motion/src/wx.png" alt="下载壹刻" width="101">
                    <p>关注公众号</p>
                </div-->
                <div class="right">
                    <h6 class="contact-number">云凌阁 资源/教程/工具</h6>
                    <div class="link">
                        <a href="#" rel="nofollow">关于我们</a><span></span>
                        <a href="#" target="_blank" rel="nofollow">咨询客服</a><span></span>
                        <a href="#" rel="nofollow">联系我们</a><span></span>
                        <a href="#" target="_blank" rel="nofollow">网站地图</a>
                    </div>
                    <div class="licence">
                        <p>
                            Powered by <a href="<?php echo $_G['setting']['siteurl'];?>" target="_blank">讯幻网</a>
                            &nbsp;&nbsp;&copy; 2016-<?php echo date('Y');?> <a href="#" target="_blank">云凌工作室</a>

                            <?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?>
                            <?php if($_G['setting']['icp']) { ?> <a href="http://www.miitbeian.gov.cn/" target="_blank"> / <?php echo $_G['setting']['icp'];?></a><?php } ?>
                            <?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink'];?>
                            <?php if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?></p>
                        <p>
                            <?php if($_G['groupid'] == 1) { ?>
                            GMT<?php echo $_G['timenow']['offset'];?>, <?php echo $_G['timenow']['time'];?>
                            <span id="debuginfo">
<?php if(debuginfo()) { ?>, Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries
                                <?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if(C::memory()->type) { ?>, <?php echo C::memory()->type; ?> On<?php } ?>.
                                <?php } ?>
                                <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer'];?>

    <?php updatesession();?>    <?php if($_G['uid'] && $_G['group']['allowinvisible']) { ?>
    <script type="text/javascript">
        var invisiblestatus = '<?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?>';
        var loginstatusobj = $('loginstatusid');
        if(loginstatusobj != undefined && loginstatusobj != null) loginstatusobj.innerHTML = invisiblestatus;
    </script>
    <?php } ?>

    <?php } ?>

    <?php if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry']) { ?>
    <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
    <script type="text/javascript" class="lazy_script" src-data="/home.php?mod=spacecp&amp;ac=pm&amp;op=checknewpm&amp;rand=<?php echo $_G['timestamp'];?>"></script>
    <?php } ?>

    <?php if($_G['uid'] && helper_access::check_module('follow') && !isset($_G['cookie']['checkfollow'])) { ?>
    <script type="text/javascript" class="lazy_script" src-data="/home.php?mod=spacecp&amp;ac=follow&amp;op=checkfeed&amp;rand=<?php echo $_G['timestamp'];?>"></script>
    <?php } ?>

    <?php if(!isset($_G['cookie']['sendmail'])) { ?>
    <script type="text/javascript" class="lazy_script" src-data="/home.php?mod=misc&amp;ac=sendmail&amp;rand=<?php echo $_G['timestamp'];?>"></script>
    <?php } ?>

    <?php } ?>

    <?php if($_GET['diy'] == 'yes') { ?>
    <?php if(check_diy_perm($topic) && (empty($do) || $do != 'index')) { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="<?php echo $_G['setting']['jspath'];?>portal_diy<?php if(!check_diy_perm($topic, 'layout')) { ?>_data<?php } ?>.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <?php } ?>
    <?php if($space['self'] && CURMODULE == 'space' && $do == 'index') { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <?php } ?>
    <?php } ?>
    <?php if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1) { ?>
    <script type="text/javascript">patchNotice();</script>
    <?php } ?>
    <?php if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && empty($_G['cookie']['pluginnotice'])) { ?>
    <div class="focus plugin" id="plugin_notice"></div>
    <script type="text/javascript">pluginNotice();</script>
    <?php } ?>
    <?php if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry'] && $_G['setting']['disableipnotice'] != 1 && $_G['uid'] && !empty($_G['cookie']['lip'])) { ?>
    <div class="focus plugin" id="ip_notice"></div>
    <script type="text/javascript">ipNotice();</script>
    <?php } ?>
    <?php if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_GET['do'] != 'notice') { ?>
    <script type="text/javascript">noticeTitle();</script>
    <?php } ?>

    <?php if(($_G['member']['newpm'] || $_G['member']['newprompt']) && empty($_G['cookie']['ignore_notice'])) { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>html5notification.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script type="text/javascript">
        var h5n = new Html5notification();
        if(h5n.issupport()) {
            <?php if($_G['member']['newpm'] && $_GET['do'] != 'pm') { ?>
            h5n.shownotification('pm', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=pm', '<?php echo avatar($_G[uid],small,true);?>', '新的短消息', '有新的短消息，快去看看吧');
            <?php } ?>
            <?php if($_G['member']['newprompt'] && $_GET['do'] != 'notice') { ?>
            <?php if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { ?>            <?php $noticetitle = lang('template', 'notice_'.$key);?>            h5n.shownotification('notice_<?php echo $key;?>', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=notice&view=<?php echo $key;?>', '<?php echo avatar($_G[uid],small,true);?>', '<?php echo $noticetitle;?> (<?php echo $val;?>)', '有新的提醒，快去看看吧');
            <?php } ?>
            <?php } ?>
        }
    </script>
    <?php } ?>
    <?php userappprompt();?>    <?php if($_G['basescript'] != 'userapp') { ?>

    <!--div id="share">
    <div style="display: block;" class="go-top go-feedback transition">
            <div class="js-show-feedback-box">
                用户反馈
            </div>
        </div>
    <div style="display: block;" class="go-top go-feedback app-feedback js-app-feedback transition">
            <div class="app-footer-guide">
                <img src="/template/quater_6_motion/src/wx115.png" width="108">
                <span style="color: #333;line-height:2;">微信扫一扫</span>
            </div>
            <div class="">
                <i class="icon icon-big-phone"></i>
                公众号
            </div>
        </div>
    <div style="display: block; bottom: 151px;" class="go-top js-go-top transition" id="go-top-btn"><i class="icon icon-top"></i></div>
    </div>
    <script type="text/javascript">
    jQuery.noConflict();
    jQuery(function(){
            //首先将#back-to-top隐藏
            jQuery("#share").hide();
            //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
            jQuery(function () {
                jQuery(window).scroll(function(){
                    if (jQuery(window).scrollTop()>100){
                        jQuery("#share").fadeIn();
                    }
                    else
                    {
                        jQuery("#share").fadeOut();
                    }
                });
                //当点击跳转链接后，回到页面顶部位置
                jQuery("#go-top-btn").click(function(){
                    jQuery('body,html').animate({scrollTop:0},500);
                    return false;
                });
            });
        }); 
    </script -->

    <?php } ?>
    <?php if(isset($_G['makehtml'])) { ?>
    <script src="<?php echo $_G['setting']['jspath'];?>html2dynamic.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script type="text/javascript">
        var html_lostmodify = <?php echo TIMESTAMP;?>;
        htmlGetUserStatus();
        <?php if(isset($_G['htmlcheckupdate'])) { ?>
        htmlCheckUpdate();
        <?php } ?>
    </script>
    <?php } ?>
</div>
<!--</div>--><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output();}?></body></html>