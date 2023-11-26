<?php
/**
 * Copyright 2001-2099 DisM!应用中心.
 * This is NOT a freeware, use is subject to license terms
 * 应用更新支持：https://dism.taobao.com
 * 本插件为 Discuz!应用中心 正版采购的应用, DisM.Taobao.Com提供更新支持。
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
global $_G;
loadcache('plugin'); 
$exx_tagrewrite = $_G['cache']['plugin']['exx_tagrewrite'];
$prefix=dhtmlspecialchars($exx_tagrewrite['prefix']);
if(!$prefix){
	cpmsg(lang('plugin/exx_tagrewrite', 'f07'), 'action=plugins&operation=config&do='.$plugin["pluginid"], 'error');
}
showtips(lang('plugin/exx_tagrewrite', 'f06'));
$strtmp= '<br><h1>'.lang('plugin/exx_tagrewrite', 'f01').'</h1>
<pre class="colorbox">
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^(.*)/'.$prefix.'-([0-9]+)\.html$ $1/misc.php\?mod=tag&id=$2
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^(.*)/'.$prefix.'-([0-9]+)-(thread|blog)\.html$ $1/misc.php\?mod=tag&id=$2&type=$3
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^(.*)/'.$prefix.'-([0-9]+)-(thread|blog)-([0-9]+)\.html$ $1/misc.php\?mod=tag&id=$2&type=$3&page=$4
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^(.*)/'.$prefix.'\.html$ $1/misc.php\?mod=tag
</pre>

<h1>'.lang('plugin/exx_tagrewrite', 'f02').'</h1>
<pre class="colorbox">

RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^'.$prefix.'-([0-9]+)\.html$ misc.php?mod=tag&id=$1
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^'.$prefix.'-([0-9]+)-(thread|blog)\.html$ misc.php?mod=tag&id=$1&type=$2%1
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^'.$prefix.'-([0-9]+)-(thread|blog)-([0-9]+)\.html$ misc.php?mod=tag&id=$1&type=$2&page=$3%1
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ^'.$prefix.'\.html$ misc.php?mod=tag

</pre>

<h1>Nginx Web Server</h1>
<pre class="colorbox">

rewrite ^([^\.]*)/'.$prefix.'-([0-9]+)\.html$ $1/misc.php?mod=tag&id=$2 last;
rewrite ^([^\.]*)/'.$prefix.'-([0-9]+)-(thread|blog)\.html$ $1/misc.php?mod=tag&id=$2&type=$3 last;
rewrite ^([^\.]*)/'.$prefix.'-([0-9]+)-(thread|blog)-([0-9]+)\.html$ $1/misc.php?mod=tag&id=$2&type=$3&page=$4 last;
rewrite ^([^\.]*)/'.$prefix.'\.html$ $1/misc.php?mod=tag last;

</pre>

<h1>'.lang('plugin/exx_tagrewrite', 'f03').'</h1>
<pre class="colorbox">

RewriteRule ^(.*)/'.$prefix.'-([0-9]+)\.html(\?(.*))*$ $1/misc\.php\?mod=tag&id=$2&$3
RewriteRule ^(.*)/'.$prefix.'-([0-9]+)-(thread|blog)\.html(\?(.*))*$ $1/misc\.php\?mod=tag&id=$2&type=$3&$4
RewriteRule ^(.*)/'.$prefix.'-([0-9]+)-(thread|blog)-([0-9]+)\.html(\?(.*))*$ $1/misc\.php\?mod=tag&id=$2&type=$3&page=$4&$5
RewriteRule ^(.*)/'.$prefix.'\.html(\?(.*))*$ $1/misc\.php\?mod=tag

</pre>

<h1>'.lang('plugin/exx_tagrewrite', 'f05').'</h1>
<pre class="colorbox">

&lt;rule name="tag_id"&gt;
	&lt;match url="^(.*/)*'.$prefix.'-([0-9]+).html\?*(.*)$" /&gt;
	&lt;action type="Rewrite" url="{R:1}/misc.php\?mod=tag&amp;amp;id={R:2}&amp;amp;{R:3}" /&gt;
&lt;/rule&gt;
&lt;rule name="tag_type">
	&lt;match url="^(.*/)*'.$prefix.'-([0-9]+)-(thread|blog).html\?*(.*)$" /&gt;
	&lt;action type="Rewrite" url="{R:1}/misc.php\?mod=tag&amp;amp;id={R:2}&amp;amp;type={R:3}&amp;amp;{R:4}" /&gt;
&lt;/rule&gt;
&lt;rule name="tag_type_page">
	&lt;match url="^(.*/)*'.$prefix.'-([0-9]+)-(thread|blog)-([0-9]+).html\?*(.*)$" /&gt;
	&lt;action type="Rewrite" url="{R:1}/misc.php\?mod=tag&amp;amp;id={R:2}&amp;amp;type={R:3}&amp;amp;page={R:4}&amp;amp;{R:5}" /&gt;
&lt;/rule&gt;
&lt;rule name="tag"&gt;
	&lt;match url="^(.*/)*'.$prefix.'.html\?*(.*)$" /&gt;
	&lt;action type="Rewrite" url="{R:1}/misc.php\?mod=tag&amp;amp;{R:2}" /&gt;
&lt;/rule&gt;

</pre>';
echo $strtmp;