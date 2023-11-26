<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<%plugin_path%>/template/libs/mwt/4.0/mwt.min.css" type="text/css">
  <link rel="stylesheet" href="<%plugin_path%>/template/views/misadmin.css" type="text/css">
  <script src="<%plugin_path%>/template/libs/jquery/1.11.2/jquery.min.js" charset="utf-8"></script>
  <script src="<%plugin_path%>/template/libs/requirejs/2.1.9/require.js" charset="utf-8"></script>
  <%js_script%>
  <script>
    var jq=jQuery.noConflict();
    jq(document).ready(function($){
	});
  </script>
</head>
<body>
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">使用说明</th></tr>
    <tr><td class="tipsblock" s="1">
      <ul id="lis">
        <li>插件安装启用后，会在 <a href="admin.php?frames=yes&action=nav&operation=headernav" target="_blank">主导航</a> 自动添加菜单项 <a href="plugin.php?id=mdown:index" target="_blank">下载</a></li>
		<li>如果主导航没有添加成功，或者已被删除，可以手动添加导航项，链接地址填：<a href="plugin.php?id=mdown:index" target="_blank">plugin.php?id=mdown:index</a></li>
		<li>插件使用过程中有任何问题，可联系客服QQ: 47485443</li>
        <li>对插件有任何产品建议可到 <a href="http://www.mawentao.com" target="_blank">此网站</a> 发帖留言</li>
      </ul>
    </td></tr>
    <tr><th colspan="15" class="partition">功能说明</th></tr>
    <tr><td class="tipsblock" s="1">
      <ul id="lis">
		<li>支持资源分类，<a href="admin.php?action=plugins&operation=config&identifier=mdown&pmod=z_category" target="_blank">点此进行设置</a>，只支持一级分类；</li>
		<li>支持资源管理，<a href="admin.php?action=plugins&operation=config&identifier=mdown&pmod=z_resource" target="_blank">点此进行设置</a>，在管理后台管理您站点的资源；</li>
	    <li>资源下载需要用户登录，点此可查看和导出资源的<a href="admin.php?action=plugins&operation=config&identifier=mdown&pmod=z_downlog" target="_blank">下载记录</a></li>
      </ul>
    </td></tr>
  </table>
</body>
</html>
